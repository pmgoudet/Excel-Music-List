<?php

// Carrega automaticamente as classes instaladas pelo Composer
require 'vendor/autoload.php';


// Importa as classes que vamos usar da biblioteca
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Cria uma nova planilha vazia na memória
$spreadsheet = new Spreadsheet();


// Pega a primeira aba da planilha (Sheet1)
$activeWorksheet = $spreadsheet->getActiveSheet();


// Escreve um valor na célula A1
$activeWorksheet->setCellValue('A1', 'Hello World !');


// Cria um "exportador" no formato Excel (.xlsx)
// Ele recebe a planilha que criamos
$writer = new Xlsx($spreadsheet);


// Salva o arquivo no disco
// Vai criar um arquivo chamado "hello world.xlsx"
$writer->save('hello world.xlsx');
