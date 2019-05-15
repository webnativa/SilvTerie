<?php
include("../layout/block.php");
$obj = find($conn, @$_GET['id']);
$tipo_id = $_SESSION['tipo_id'];
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
            <td width="9%"> <span class="red"> * </span> Nome: </td>
            <td width="91%"> 
                <input type="text" name="nome" size="65" required="true" value="<?= field_form($obj['nome']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'nome' , $style = false); ?>
            </td>
        </tr>

        <tr>
            <td width="9%"><br /></td>
            <td width="91%"></td>
        </tr>

        <tr>
            <td width="9%"><br /></td>
            <td width="91%">
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