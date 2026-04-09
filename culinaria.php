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
$duracao_prova_1 = (int)readline("Teu tempo de duração no preparo do prato " . PRATO_1 . ": "); // int
$percentual_livre_1 = (DURACAO_PRATO_1 - $duracao_prova_1) / DURACAO_PRATO_1;

// pontuação de qualidade de cada prova
$ponto_qualidade_prova_2 = (float)readline("Tua pontuação de qualidade no prato " . PRATO_2 . ": "); // float
// pontuação de apresentação de cada prova
$ponto_apresentacao_prova_2 = (float)readline("Tua pontuação de apresentação do prato " . PRATO_2 . ": "); // float
// tempo de realização de cada prova
$duracao_prova_2 = (int)readline("Teu tempo de duração no preparo do prato " . PRATO_2 . ": "); // int
$percentual_livre_2 = (DURACAO_PRATO_2 - $duracao_prova_2) / DURACAO_PRATO_2;

// pontuação de qualidade de cada prova
$ponto_qualidade_prova_3 = (float)readline("Tua pontuação de qualidade no prato " . PRATO_3 . ": "); // float
// pontuação de apresentação de cada prova
$ponto_apresentacao_prova_3 = (float)readline("Tua pontuação de apresentação do prato " . PRATO_3 . ": "); // float
// tempo de realização de cada prova
$duracao_prova_3 = (int)readline("Teu tempo de duração no preparo do prato " . PRATO_3 . ": "); // int
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
