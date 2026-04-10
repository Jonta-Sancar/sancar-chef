<?php
define('PRATO_1', 'Macarronada');
define('PRATO_2', 'Vaca atolada');
define('PRATO_3', 'Ove poche');

define('DURACAO_PRATO_1', 40);
define('DURACAO_PRATO_2', 120);
define('DURACAO_PRATO_3', 6);

define('ALVO_QUALIDADE', 6.5);
define('ALVO_TEMPO_LIVRE', 0.15); // 15%
define('ALVO_APRESENTACAO', 7);

// CRITÉRIOS REPESCAGEM
define('CONTAGEM_DE_PERDAS_MAXIMA', 2);
define('PERCENTUAL_DIFERENCA_MAXIMO', 0.2);

// nome do competidor
$nome_competidor = readline("Digite o teu nome: "); // string
// idade do competidor
$idade_competidor = (int)readline("Digite a tua idade: "); // int
// especialidade do competidor
$especialidade_competidor = readline("Digite a tua especialidade: "); // string

// pontuação de qualidade de cada prova
$ponto_qualidade_prova_1 = (float)readline("Tua pontuação de qualidade no prato " . PRATO_1 . ": "); // float
// pontuação de apresentação de cada prova
$ponto_apresentacao_prova_1 = (float)readline("Tua pontuação de apresentação do prato " . PRATO_1 . ": "); // float
// tempo de realização de cada prova
$duracao_prova_1 = (float)readline("Teu tempo de duração no preparo do prato " . PRATO_1 . ": "); // int
$percentual_livre_1 = (DURACAO_PRATO_1 - $duracao_prova_1) / DURACAO_PRATO_1;

// pontuação de qualidade de cada prova
$ponto_qualidade_prova_2 = (float)readline("Tua pontuação de qualidade no prato " . PRATO_2 . ": "); // float
// pontuação de apresentação de cada prova
$ponto_apresentacao_prova_2 = (float)readline("Tua pontuação de apresentação do prato " . PRATO_2 . ": "); // float
// tempo de realização de cada prova
$duracao_prova_2 = (float)readline("Teu tempo de duração no preparo do prato " . PRATO_2 . ": "); // int
$percentual_livre_2 = (DURACAO_PRATO_2 - $duracao_prova_2) / DURACAO_PRATO_2;

// pontuação de qualidade de cada prova
$ponto_qualidade_prova_3 = (float)readline("Tua pontuação de qualidade no prato " . PRATO_3 . ": "); // float
// pontuação de apresentação de cada prova
$ponto_apresentacao_prova_3 = (float)readline("Tua pontuação de apresentação do prato " . PRATO_3 . ": "); // float
// tempo de realização de cada prova
$duracao_prova_3 = (float)readline("Teu tempo de duração no preparo do prato " . PRATO_3 . ": "); // int
$percentual_livre_3 = (DURACAO_PRATO_3 - $duracao_prova_3) / DURACAO_PRATO_3;

$media_qualidade = ($ponto_qualidade_prova_1 + $ponto_qualidade_prova_2 + $ponto_qualidade_prova_3)/3;
$media_apresentacao = ($ponto_apresentacao_prova_1 + $ponto_apresentacao_prova_2 + $ponto_apresentacao_prova_3) / 3;
$media_percentual_livre = ($percentual_livre_1 + $percentual_livre_2 + $percentual_livre_3) / 3;

$aprovado_qualidade = $media_qualidade >= ALVO_QUALIDADE;
$aprovado_aparencia = $media_apresentacao >= ALVO_APRESENTACAO;
$aprovado_duracao = $media_percentual_livre >= ALVO_TEMPO_LIVRE;

$aprovado = $aprovado_qualidade && $aprovado_aparencia && $aprovado_duracao;

$cabecalho_mensagem = "resultado parcial da classificação do competidor $nome_competidor, de $idade_competidor anos, especialista em $especialidade_competidor.";

$mensagem_aprovado = "É com muito prazer que informamos que o candidato foi APROVADO para participar do concurso de culinária🥳🥳. PARA BÉNS!!!";
$mensagem_reprovado = "Infelizmente, não foi dessa vez, mas este não é o fim da sua jornada. Você ainda pode tentar na próxima temporada.🥲🥲";


$apresentacao_impressao = number_format($media_apresentacao, 1, ',', '.');
$qualidade_impressao = number_format($media_qualidade, 1, ',', '.');
$percentual_impressao = number_format(($media_percentual_livre * 100), 1, ',', '.');


$rodape_mensagem  = "Qualidade dos pratos |  Tempo de entrega  | Apresentação\n";
$rodape_mensagem .= "         $qualidade_impressao         |       $percentual_impressao%        |       $apresentacao_impressao";

echo "\n\n" . $cabecalho_mensagem . "\n";
echo  ($aprovado ? $mensagem_aprovado : $mensagem_reprovado) . "\n";
echo "\n\n" . $rodape_mensagem . "\n";


if(!$aprovado){
  // perdeu em no máximo 2 critérios
  $contador_perdas = 0;
  $percentual_maximo_diferenca = 0;
  if(!$aprovado_qualidade){
    // $contador_perdas = $contador_perdas + 1;
    // $contador_perdas+=1;
    // ++$contador_perdas;
  
    $diferenca_qualidade        = ALVO_QUALIDADE - $media_qualidade;
    $percentual_diferenca_qualidade           = $diferenca_qualidade / ALVO_QUALIDADE;
  
    $percentual_maximo_diferenca = $percentual_diferenca_qualidade;
  
    // $contador_perdas++; // soma 1
  }
  if(!$aprovado_aparencia){
    $diferenca_apresentacao     = ALVO_APRESENTACAO - $media_apresentacao;
    $percentual_diferenca_apresentacao        = $diferenca_apresentacao / ALVO_APRESENTACAO;
  
    if($percentual_diferenca_apresentacao > $percentual_maximo_diferenca){
      $percentual_maximo_diferenca = $percentual_diferenca_apresentacao;
    }
    
    // $contador_perdas++; // soma 1
  }
  if(!$aprovado_duracao){
    $diferenca_percentual_livre = ALVO_TEMPO_LIVRE - $media_percentual_livre;
    $percentual_diferenca_percentual_livre    = $diferenca_percentual_livre / ALVO_TEMPO_LIVRE;
    
    if($percentual_diferenca_percentual_livre > $percentual_maximo_diferenca){
      $percentual_maximo_diferenca = $percentual_diferenca_percentual_livre;
    }
  
    // $contador_perdas++; // soma 1
  }

  $contador_perdas = (int)!$aprovado_qualidade + (int)!$aprovado_aparencia + (int)!$aprovado_duracao;
  
  // a maior diferença tem que ser no máximo 20%
  if ($contador_perdas <= CONTAGEM_DE_PERDAS_MAXIMA && $percentual_maximo_diferenca <= PERCENTUAL_DIFERENCA_MAXIMO){
    $classificacao = "REPESCAGEM";
  } else {
    $classificacao = "REPROVADO";
  }

  // $faz_repescagem && $percentual_maximo_diferenca
} else {
  $na_media_qualidade    = $media_qualidade == ALVO_QUALIDADE; // boolean
  $na_media_apresentacao = $media_apresentacao == ALVO_APRESENTACAO; // boolean
  $na_media_duracao      = (float)number_format($media_percentual_livre, 2) == ALVO_TEMPO_LIVRE; // boolean

  // PASSADOR
  $na_media = $na_media_qualidade && $na_media_apresentacao && $na_media_duracao;

  $fechou_qualidade    = $media_qualidade == 10; // boolean
  $fechou_apresentacao = $media_apresentacao == 10; // boolean
  $fechou_duracao      = $media_percentual_livre > ALVO_TEMPO_LIVRE;

  // CHEFE
  $fechou = $fechou_qualidade && $fechou_apresentacao;

  if($na_media){
    $classificacao = "PASSADOR";
    // echo
  } else if ($fechou){
    $classificacao = "CHEFE";
  } else {
    $classificacao = "TIROU ONDA";
  }
}


switch($classificacao){
  case "PASSADOR":
    echo "\n\nO candidato possui classificação PASSADOR e realizará a próxima etapa\n";
    break;
  case "TIROU ONDA":
    echo "\n\nO candidato possui classificação TIROU ONDA e passará direto para a segunda etapa do campeonato\n";
    break;
  case "CHEFE":
    echo "\n\nO candidato possui classificação CHEFE e passará direto para a terceira etapa do campeonato\n";
    break;
    
  case "REPESCAGEM":
    echo "\n\n Baseado na análise do candidato, informamos, com prazer, que ele poderá realizar a repescagem.\n";
    break;
  
  case "REPROVADO":
    echo "\n\n Infelizmente o candidato não está apto a realizar a repescagem.\n";
    break;
}