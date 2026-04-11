<?php

// ARRAYS
// indexado
$frutas = ["banana", "maçã", "laranja", "abacate", "abacaxi"];
/**
 * 0 => "banana"
 * 1 => "maça"
 * 2 => "laranja"
 * 3 => "abacate"
 * 4 => "abacaxi"
*/
echo $frutas[1] . "\n";

// associativo
$competidor = [
  "nome" => "João",
  "idade" => 20,
  "especialidade" => "Culinária"
];

echo $competidor["nome"] . "\n";

$competidores = [
  $competidor,
  [
    "nome" => "Maria",
    "idade" => 21,
    "especialidade" => "Culinária"
  ],
  [
    "nome" => "Pedro",
    "idade" => 22,
    "especialidade" => ["Culinária", "Informática", "Matemática", "Português", "Geografia"]
  ]
];

echo $competidores[2]["idade"] . "\n";
echo $competidores[2]["especialidade"][3] . "\n";