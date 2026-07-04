<?php

// $path = "./teste";
$path = "D:/Musica";
$filesAndDirectories = scandir($path);
$jaExiste = [];

$minhaListaDeMusicas = [];
$musicasIgnoradas = [];

function processarMusica(string $arquivo): array
{
  $partes = explode(" - ", $arquivo);

  return [
    "artista" => $partes[0],
    "faixa" => $partes[1]
  ];
}

function isMp3(string $path, string $musica, array &$minhaListaDeMusicas, array &$musicasIgnoradas, array &$jaExiste): void
{
  $nomeDaMusica = pathinfo($musica, PATHINFO_FILENAME);
  // echo $path . "\n";

  if (str_contains($nomeDaMusica, " - ")) {
    $chave = $path;

    if (!isset($jaExiste[$chave])) {
      $minhaListaDeMusicas[] = processarMusica($nomeDaMusica);
      $jaExiste[$chave] = true;
    }
  } else {
    $chave = $nomeDaMusica;

    if (!isset($jaExiste[$chave])) {
      $musicasIgnoradas[] = $nomeDaMusica;
      $jaExiste[$chave] = true;
    }
  }
}

function percorrerPastas(string $path, string $dirOrFile, array &$minhaListaDeMusicas, array &$musicasIgnoradas, array &$jaExiste): array
{
  $path = $path . "/" . $dirOrFile;

  if (str_contains($dirOrFile, ".mp3")) {
    // echo $path . "\n"; //? echo da raiz
    isMp3($path, $dirOrFile, $minhaListaDeMusicas, $musicasIgnoradas, $jaExiste);
  }

  if (is_dir($path)) { //? AQUI ELE VÊ SE NO ROOT É PASTA
    $dirROOT = scandir($path);

    foreach ($dirROOT as $itemROOT) {
      if ($itemROOT !== '.' && $itemROOT !== '..') {
        $path2 = $path . "/" . $itemROOT;

        if (str_contains($itemROOT, ".mp3")) {
          // echo $path2 . "\n"; //? echo do n1
          isMp3($path2, $itemROOT, $minhaListaDeMusicas, $musicasIgnoradas, $jaExiste);
        }


        if (is_dir($path2)) { //? AQUI ELE VÊ SE NO N1 É PASTA
          $dirN2 = scandir($path2);

          foreach ($dirN2 as $itemN2) { //? AQUI ELE REPETE EM LOOP O PROCESSO ATÉ NÃO TER MAIS PASTA
            if ($itemN2 !== '.' && $itemN2 !== '..') {
              if (str_contains($itemN2, ".mp3")) {
                $path3 = $path2 . '/' . $itemN2;
                // echo $path2 . '/' . $itemN2 . "\n"; //? echo n2
                isMp3($path3, $itemN2, $minhaListaDeMusicas, $musicasIgnoradas, $jaExiste);
              }
              percorrerPastas($path2, $itemN2, $minhaListaDeMusicas, $musicasIgnoradas, $jaExiste);
            }
          }
        }
      }
    }
  }
  return [$minhaListaDeMusicas, $musicasIgnoradas];
}

// print_r($filesAndDirectories); //? print array da raiz

foreach ($filesAndDirectories as $item) {
  if ($item !== '.' && $item !== '..') {
    percorrerPastas($path, $item, $minhaListaDeMusicas, $musicasIgnoradas, $jaExiste);
  }
}

// print_r($minhaListaDeMusicas);
// print_r($musicasIgnoradas);
return [$minhaListaDeMusicas, $musicasIgnoradas];
