<?php
define('PRATOS', [
  [
    "nome" => 'Macarronada',
    "duracao" => 40,
  ],
  [
    "nome" => 'Vaca atolada',
    "duracao" => 120,
  ],
  [
    "nome" => 'Ovo poche',
    "duracao" => 6,
  ]
]);

define('ALVOS', [
  "qualidade" => 6.5,
  "apresentacao" => 7,
  "tempo_livre" => 0.15,
]);

// CRITÉRIOS REPESCAGEM
define('CRITERIOS_REPESCAGEM', [
  'perdas' => 2,
  'percentual_diferenca_maximo' => 0.2
]);

$competidor = [
  "nome" => readline("Digite o teu nome: "),
  "idade" => (int)readline("Digite a tua idade: "),
  "especialidade" => readline("Digite a tua especialidade: ")
];

$pontuacoes_prova_1 = [
  "qualidade" => (float)readline("Tua pontuação de qualidade no prato " . PRATOS[0]['nome'] . ": "),
  "apresentacao" => (float)readline("Tua pontuação de apresentação do prato " . PRATOS[0]['nome'] . ": "),
  "tempo_livre" => (float)readline("Teu tempo de duração no preparo do prato " . PRATOS[0]['nome'] . ": ")
];
$pontuacoes_prova_1['percentual_livre'] = (PRATOS[0]['duracao'] - $pontuacoes_prova_1['tempo_livre']) / PRATOS[0]['duracao'];

$pontuacoes_prova_2 = [
  "qualidade" => (float)readline("Tua pontuação de qualidade no prato " . PRATOS[1]['nome'] . ": "),
  "apresentacao" => (float)readline("Tua pontuação de apresentação do prato " . PRATOS[1]['nome'] . ": "),
  "tempo_livre" => (float)readline("Teu tempo de duração no preparo do prato " . PRATOS[1]['nome'] . ": ")
];
$pontuacoes_prova_2['percentual_livre'] = (PRATOS[1]['duracao'] - $pontuacoes_prova_2['tempo_livre']) / PRATOS[1]['duracao'];

$pontuacoes_prova_3 = [
  "qualidade"        => (float)readline("Tua pontuação de qualidade no prato " . PRATOS[2]['nome'] . ": "),
  "apresentacao"     => (float)readline("Tua pontuação de apresentação do prato " . PRATOS[2]['nome'] . ": "),
  "tempo_livre"      => (float)readline("Teu tempo de duração no preparo do prato " . PRATOS[2]['nome'] . ": ")
];
$pontuacoes_prova_3['percentual_livre'] = (PRATOS[2]['duracao'] - $pontuacoes_prova_3['tempo_livre']) / PRATOS[2]['duracao'];

$medias = [
  "qualidade"        => ($pontuacoes_prova_1['qualidade'] + $pontuacoes_prova_2['qualidade'] + $pontuacoes_prova_3['qualidade']) / count(PRATOS),
  "apresentacao"     => ($pontuacoes_prova_1['apresentacao'] + $pontuacoes_prova_2['apresentacao'] + $pontuacoes_prova_3['apresentacao']) / count(PRATOS),
  "percentual_livre" => ($pontuacoes_prova_1['percentual_livre'] + $pontuacoes_prova_2['percentual_livre'] + $pontuacoes_prova_3['percentual_livre']) / count(PRATOS),
];

$aprovacoes = [
  "qualidade"        => $medias['qualidade'] >= ALVOS['qualidade'],
  "apresentacao"     => $medias['apresentacao'] >= ALVOS['apresentacao'],
  "percentual_livre" => $medias['percentual_livre'] >= ALVOS['tempo_livre']
];

$aprovado = $aprovacoes['qualidade'] && $aprovacoes['apresentacao'] && $aprovacoes['percentual_livre'];

$impressoes = [
  "qualidade"        => number_format($medias['qualidade'], 2, ',', '.'),
  "apresentacao"     => number_format($medias['apresentacao'], 2, ',', '.'),
  "percentual_livre" => number_format($medias['percentual_livre'], 2, ',', '.')
];

$mensagem = [
  "cabecalho"    => "resultado parcial da classificação do competidor " . $competidor['nome'] . ", de " . $competidor['idade'] ." anos, especialista em ". $competidor['especialidade'] . ".",
  "rodape"       => "Qualidade dos pratos |  Tempo de entrega  | Apresentação\n",
  "dados_rodape" => "         ".$impressoes['qualidade']."         |       ". $impressoes['percentual_livre'] ."%        |       ". $impressoes['apresentacao'] ."\n",
  "aprovado"     => "É com muito prazer que informamos que o candidato foi APROVADO para participar do concurso de culinária🥳🥳. PARA BÉNS!!!",
  "reprovado"    => "Infelizmente, não foi dessa vez, mas este não é o fim da sua jornada. Você ainda pode tentar na próxima temporada.🥲🥲",

  "PASSADOR" => "\n\nO candidato possui classificação PASSADOR e realizará a próxima etapa\n",
  "TIROU-ONDA" => "\n\nO candidato possui classificação TIROU-ONDA e passará direto para a segunda etapa\n",
  "CHEFE" => "\n\nO candidato possui classificação CHEFE e passará direto para a terceira etapa\n",
  "REPESCAGEM" => "\n\n Baseado na análise do candidato, informamos, com prazer, que ele poderá realizar a repescagem.\n",
  "_REPROVADO" => "\n\n Infelizmente o candidato não está apto a realizar a repescagem.\n"
];

echo "\n\n" . $mensagem['cabecalho'] . "\n";
echo  ($aprovado ? $mensagem['aprovado'] : $mensagem["reprovado"]) . "\n";
echo "\n\n" . $mensagem['rodape'] . $mensagem['dados_rodape'] . "\n";


if(!$aprovado){
  // perdeu em no máximo 2 critérios
  $contador_perdas = (int)!$aprovacoes['qualidade'] + (int)!$aprovacoes['apresentacao'] + (int)!$aprovacoes['percentual_livre'];
  $percentual_maximo_diferenca = 0;

  if(!$aprovacoes['qualidade']){
    $diferenca = ALVOS['qualidade'] - $medias['qualidade'];
    $percentual_diferenca           = $diferenca / ALVOS['qualidade'];
  
    $percentual_maximo_diferenca = $percentual_diferenca;
  }
  if(!$aprovacoes['apresentacao']){
    $diferenca = ALVOS['apresentacao'] - $medias['apresentacao'];
    $percentual_diferenca           = $diferenca / ALVOS['apresentacao'];

    if($percentual_diferenca > $percentual_maximo_diferenca){
      $percentual_maximo_diferenca = $percentual_diferenca;
    }
  }
  if(!$aprovacoes['percentual_livre']){
    $diferenca = ALVOS['tempo_livre'] - $medias['percentual_livre'];
    $percentual_diferenca           = $diferenca / ALVOS['tempo_livre'];
    
    if($percentual_diferenca > $percentual_maximo_diferenca){
      $percentual_maximo_diferenca = $percentual_diferenca;
    }
  }

  
  // a maior diferença tem que ser no máximo 20%
  if ($contador_perdas <= CRITERIOS_REPESCAGEM['perdas'] && $percentual_maximo_diferenca <= CRITERIOS_REPESCAGEM['percentual_diferenca_maximo']) {
    $classificacao = "REPESCAGEM";
  } else {
    $classificacao = "REPROVADO";
  }

  // $faz_repescagem && $percentual_maximo_diferenca
} else {
  $na_media_qualidade    = $medias['qualidade'] == ALVOS['qualidade']; // boolean
  $na_media_apresentacao = $medias['apresentacao'] == ALVOS['apresentacao']; // boolean
  $na_media_duracao      = (float)number_format($medias['percentual_livre'], 2) == ALVOS['tempo_livre']; // boolean

  // PASSADOR
  $na_media = $na_media_qualidade && $na_media_apresentacao && $na_media_duracao;

  $fechou_qualidade    = $medias["qualidade"] == 10; // boolean
  $fechou_apresentacao = $medias["apresentacao"] == 10; // boolean
  $fechou_duracao      = $medias["percentual_livre"] > ALVOS["tempo_livre"]; // boolean

  // CHEFE
  $fechou = $fechou_qualidade && $fechou_apresentacao && $fechou_duracao;

  if($na_media){
    $classificacao = "PASSADOR";
  } else if ($fechou){
    $classificacao = "CHEFE";
  } else {
    $classificacao = "TIROU ONDA";
  }
}


switch($classificacao){
  case "PASSADOR":
    echo $mensagem['PASSADOR'];
    break;
  case "TIROU ONDA":
    echo $mensagem['TIROU-ONDA'];
    break;
  case "CHEFE":
    echo $mensagem['CHEFE'];
    break;
    
  case "REPESCAGEM":
    echo $mensagem['REPESCAGEM'];
    break;
  
  case "REPROVADO":
    echo $mensagem['_REPROVADO'];
    break;
}
