<?php
echo  "Bem vindo ao screen match!";
$nomeFilme = "Top Gun";

$notasFilme = [8.5, 9.0, 7.5, 8.0];
$media = array_sum($notasFilme) / count($notasFilme);
$aluno = [
    'nome' => 'João',
    'notas' => [8.5, 9.0, 7.5, 8.0]
];
echo "O filme $nomeFilme tem a média de $media.";
echo "O aluno {$aluno['nome']} tem a média de {$aluno['notas'][0]}.";
echo "O aluno {$aluno['nome']} tem a média de " . array_sum($aluno['notas']) / count($aluno['notas']) . ".";
?>