<?php

// Carrega automaticamente as classes instaladas pelo Composer
require 'vendor/autoload.php';
$musicListExported = require './music-list.php';

$listaDeMusicas = $musicListExported[0];
$musicasIgnoradas = $musicListExported[1];

// Importa as classes que vamos usar da biblioteca
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Cria uma nova planilha vazia na memória
$spreadsheet = new Spreadsheet();


// Pega a primeira aba da planilha (Sheet1)
$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle('Músicas OK');



// Escreve um valor nas células A1
$sheet1->setCellValue('A1', 'Nom du Fichier');
$sheet1->setCellValue('B1', 'Artiste');
$sheet1->setCellValue('C1', 'Morceau');

foreach ($listaDeMusicas as $i => $item) {
  $sheet1->setCellValue('A' . $i + 2, $item['artista'] . " - " . $item['faixa']);
  $sheet1->setCellValue('B' . $i + 2, $item['artista']);
  $sheet1->setCellValue('C' . $i + 2, $item['faixa']);
}


// segunda aba

$sheet2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Ignoradas');
$spreadsheet->addSheet($sheet2);

$sheet2->setCellValue('A1', 'Path');

foreach ($musicasIgnoradas as $i => $item) {
  $sheet2->setCellValue('A' . $i + 2, $item);
}

// Cria um "exportador" no formato Excel (.xlsx)
// Ele recebe a planilha que criamos
$writer = new Xlsx($spreadsheet);


echo 'Arquivo criado com sucesso.';


//? ESTILO PARA A TABELA:

//primeira linha em negrito + cor
$sheet1->getStyle('A1:C1')->applyFromArray([
  'font' => [
    'bold' => true,
    'color' => ['rgb' => 'FFFFFF']
  ],
  'fill' => [
    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    'startColor' => ['rgb' => '4F81BD']
  ]
]);

$sheet2->getStyle('A1')->applyFromArray([
  'font' => [
    'bold' => true,
    'color' => ['rgb' => 'FFFFFF']
  ],
  'fill' => [
    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    'startColor' => ['rgb' => '4F81BD']
  ]
]);



//bordas em todas as células com texto

$lastRow = count($listaDeMusicas) + 1;

$sheet1->getStyle("A1:C$lastRow")->applyFromArray([
  'borders' => [
    'allBorders' => [
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      'color' => ['rgb' => '000000']
    ]
  ]
]);



// o mesmo na segunda aba
$lastRow2 = count($musicasIgnoradas) + 1;

$sheet2->getStyle("A1:A$lastRow2")->applyFromArray([
  'borders' => [
    'allBorders' => [
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      'color' => ['rgb' => '000000']
    ]
  ]
]);


//ajuste automatico na largura das colunas
foreach (range('A', 'C') as $coluna) {
  $sheet1->getColumnDimension($coluna)->setAutoSize(true);
}

// para a segunda aba
foreach (range('A', 'A') as $coluna) {
  $sheet2->getColumnDimension($coluna)->setAutoSize(true);
}



// Salva o arquivo no disco
// Vai criar um arquivo chamado "hello world.xlsx"
$writer->save('Minhas-músicas.xlsx');
