<?php

session_start();

include_once('../../configs/configs.php');
define('TITULO_MODULO', 'Lofig');
define('_TABLE_', 'usuarios');
define('_MODULE_', 'login');
define('_ROUTE_ACTION_', _SITE_URL_ . '/' . _ADMIN_URL_ . '/' . _MODULE_);

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    $response = array('sucesso' => false);

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (empty($email)) {
        $response['mensagem'] = "Informe seu e-mail";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['mensagem'] = "e-mail inválido.";
        echo json_encode($response);
        exit;
    }

    $table = _TABLE_;

    $stmt = $conn->prepare("SELECT * FROM $table WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();

    if (!$result) {
        $response['mensagem'] = "Dados incorretos.";
        echo json_encode($response);
        exit;
    }

    //$senhaTemp = "" . rand(100, 800);
    $senhaTemp = "eco787";
    $senha = sha1(_SALT_ . $senhaTemp);

    $stmt = $conn->prepare("UPDATE usuarios SET senha=:senha WHERE id = :id");
    $stmt->bindValue(':senha', $senha);
    $stmt->bindParam(':id', $result['id'], PDO::PARAM_INT);

    $stmt->execute();

    $nome = _NOME_SITE_;
    $email_site = _EMAIL_CONTATO_;

    $headers = "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: $nome <$email_site>\r\n";

    $html = '<html>
                <table style="width: 480px;" cellpadding="1" cellspacing="1">
                    <tr style="background:#fff">
                        <td><h3> Sua nova senha: </h3></td>
                    </tr>
                    <tr style="background:#fff">
                        <td>' . $senhaTemp . '</td>
                    </tr>';
    $html .= '<tr style="background:#26669d">
                        <td><br></td>
                    </tr>
                    
                </table>
            </body>
        </html>';

    mail($email, 'Nova senha ' . _NOME_SITE_, $html, $headers);

    $response['sucesso'] = true;
    echo json_encode($response);
    exit;
}
