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
            <td width="9%"> <span class="red"> * </span> Nome <br> <input type="text" name="nome" size="65" required="true" value="<?= field_form($obj['nome']) ?>" /></td>
        </tr>

        <tr>
            <td width="9%"> <span class="red"> * </span> e-mail <br> <input type="email" name="email" size="65" required="true" value="<?= field_form($obj['email']) ?>" /></td>
        </tr>

        <tr>
            <td width="9%"> <span class="red"> * </span> senha <br> 
                Deixe em branco caso não queira editar. <br>
                <input type="password" name="senha" size="65" />
            </td>
        </tr>

        <tr>
            <td width="9%"><br /><br></td>
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
    <?php } ?>

    <input type="hidden" name="__send_form" value="form" />

</form>

<?php
include("../layout/block_end.php");
?>