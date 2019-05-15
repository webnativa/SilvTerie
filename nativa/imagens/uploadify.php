<?php

include_once('../../configs/configs.php');

if (!empty($_FILES)) {

    $entity_id = $_POST['entity_id'];
    $tipo = $_POST['tipo'];

    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = "../../public/uploads/imagens/$entity_id/";

    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $_FILES['Filedata']['name'], $ext);

    $imagemNome = md5(time()) . "." . $ext[1];

    $targetFile = str_replace('//', '/', $targetPath) . $imagemNome;

    $sql = "INSERT INTO imagens (imagem, tipo, entity_id) "
            . "VALUES "
            . "(:imagem, :tipo, :entity_id)";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':imagem', $imagemNome);
    $stmt->bindValue(':tipo', $tipo);
    $stmt->bindValue(':entity_id', $entity_id);

    $stmt->execute();
    move_uploaded_file($tempFile, $targetFile);
}
