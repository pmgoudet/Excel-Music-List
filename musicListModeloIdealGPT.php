<?php

$path = "D:/Musica";

$minhaListaDeMusicas = [];
$musicasIgnoradas = [];
$jaExiste = [];

function processarMusica(string $arquivo): array
{
  $partes = explode(" - ", $arquivo);

  return [
    "artista" => $partes[0],
    "faixa" => $partes[1]
  ];
}

function percorrer(string $path, array &$musicas, array &$ignoradas, array &$jaExiste): void
{
  $itens = scandir($path);

  foreach ($itens as $item) {
    if ($item === '.' || $item === '..') continue;

    $caminhoCompleto = $path . "/" . $item;

    // 🔁 se for pasta → desce nela
    if (is_dir($caminhoCompleto)) {
      percorrer($caminhoCompleto, $musicas, $ignoradas, $jaExiste);
      continue;
    }

    // 🎵 se for mp3 → processa
    if (str_contains($item, ".mp3")) {

      $nome = pathinfo($item, PATHINFO_FILENAME);

      if (!isset($jaExiste[$caminhoCompleto])) {

        if (str_contains($nome, " - ")) {
          $musicas[] = processarMusica($nome);
        } else {
          $ignoradas[] = $nome;
        }

        $jaExiste[$caminhoCompleto] = true;
      }
    }
  }
}

percorrer($path, $minhaListaDeMusicas, $musicasIgnoradas, $jaExiste);

print_r($minhaListaDeMusicas);
print_r($musicasIgnoradas);
