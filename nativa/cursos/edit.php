<?php
include('../../conn/Conn.php');

include('configs_modulo.php');

$id = $_GET['id'];

$action = 'update';
include('../permissao_grupo.php');
$query = mysql_query('SELECT * FROM conteudo WHERE id =' . $id);
$row = mysql_fetch_assoc($query);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <?php include("../layout/doctype.php"); ?>

       <script type="text/javascript">
    $(document).ready(function() {
            $("#commentForm").validate();
    });
    </script>


    <body>
        <div id="geral">

            <?php include("../layout/topo.php"); ?>

            <div id="conteudo_geral">

                <div id="container_secundarias">

                    <h1>| <?php echo TITULO_MODULO ; ?></h1>

                    <div id="form_geral">
                        <a href="javascript:history.go(-1)">
                            <img src="../../public/imgs/admin/cancelar_voltar.gif" alt="Voltar" />
                        </a>
                        
                        <div id="error">
                               <?php include('_form.php');?>
                        </div>

                    </div>

                </div>

            </div>
        </div>
         <?php include('../layout/rodape.php') ?>
    </body>
</html>