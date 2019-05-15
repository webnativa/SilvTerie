<?php
ini_set('display_errors', 'on');
require_once '../../lib/ThumbLib.inc.php';

$largura = $_GET['x'];
$altura = $_GET['y'];
$imagem = $_GET['imagem'];

$folder = '../../public/uploads';

$thumb = PhpThumbFactory::create($folder . '/' . $imagem);
$thumb->adaptiveResize($largura, $altura);
$thumb->show();
