<?php
include("../layout/block.php");
$obj = find($conn, @$_GET['id']);
?>
<div class="page-header">
    <h1> <?= TITULO_MODULO ?></h1>
</div>
<a href="<?= _ROUTE_ACTION_ ?>" class="red add_new">
    <i class="ace-icon bigger-130"></i>
    <strong> « Voltar</strong>
</a>

<form method="post" action="<?= _ROUTE_ACTION_ ?>/admin.php" enctype="multipart/form-data">

    <table style="margin-top: 10px" id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tr>
            <td width="9%"> <span class="red"> * </span> T&iacute;tulo: <br>
                <input type="text" name="titulo" size="65" required="true" value="<?= field_form($obj['titulo']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'titulo' , $style = false); ?>
            </td>
        </tr>
        
        <!-- <tr>
            <td width="9%"><span class="red"> * </span>  S&iacute;ntese:<br>
                
                <input type="text" name="sintese" size="65" value="<?= field_form($obj['sintese']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'sintese' , $style = false); ?>
            </td>
        </tr> -->

        <tr>
            <td width="9%"><span class="red"> * </span>  Texto:<br>
                <textarea rows="5" cols="10" name="texto" required="true" class="ckeditor"><?= field_form($obj['texto']) ?></textarea>
                <br><br> <?php echo getCampos($conn, $obj['id'], 'texto' , $style = 'ckeditor'); ?>
            </td>
        </tr>

        <tr>
            <td width="9%">Foto:<br><input name="imagem" id="imagem" type="file" /></td>
        </tr>

        <?php if (field_form($obj['imagem'])) { ?>
            <tr>
                <td width="9%"><br><img src="<?= _MEDIA_FILES_ ?>/conteudo/<?= $obj['imagem'] ?>" width="150" height="110" /></td>
            </tr>
        <?php } ?>
        <tr>
            <td width="9%"><br /><br></td>
        </tr>
        <tr>
            <td width="9%">Publicar?<br><input type="checkbox" name="status" value="1" <?php if (field_form($obj['status'])) echo 'checked'; ?> /></td>
        </tr>
        <tr>
            <td width="9%"><br>
                <button type="submit" class="btn btn-white btn-info btn-bold">
                    <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>
                    Gravar
                </button>
            </td>
        </tr>
    </table>

    <?php if ($obj) { ?>
        <input type="hidden" name="id" value="<?= field_form($obj['id']) ?>" />
        <input type="hidden" name="__imagem" value="<?= field_form($obj['imagem']) ?>" />
    <?php } ?>

    <input type="hidden" name="__send_form" value="form" />

</form>

<?php
include("../layout/block_end.php");
?>