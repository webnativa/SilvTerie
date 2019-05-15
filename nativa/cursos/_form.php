<?php
include("../layout/block.php");
$obj = find($conn, @$_GET['id']);

        $sqlCategorias = $conn->prepare("SELECT * FROM categorias Where status = '1'");
        $sqlCategorias->execute();
        $categorias = $sqlCategorias;

?>


		<link rel="stylesheet" href="jquery.checkbox.css" />
		<link rel="stylesheet" href="jquery.safari-checkbox.css" />
		<!--<script type="text/javascript" src="jquery.js"></script>-->
		<script type="text/javascript" src="jquery.checkbox.min.js"></script>
		<script type="text/javascript">
			
    
    $(document).ready(function() {
				$('input:checkbox:not([safari])').checkbox();
				$('input[safari]:checkbox').checkbox({cls:'jquery-safari-checkbox'});
				$('input:radio').checkbox();
                                
                                
                                
			});

			displayForm = function (elementId)
			{
				var content = [];
				$('#' + elementId + ' input').each(function(){
					var el = $(this);
					if ( (el.attr('type').toLowerCase() == 'radio'))
					{
						if ( this.checked )
							content.push([
								'"', el.attr('name'), '": ',
								'value="', ( this.value ), '"',
								( this.disabled ? ', disabled' : '' )
							].join(''));
					}
					else
						content.push([
							'"', el.attr('name'), '": ',
							( this.checked ? 'checked' : 'not checked' ), 
							( this.disabled ? ', disabled' : '' )
						].join(''));
				});
				alert(content.join('\n'));
			}
			
			changeStyle = function(skin)
			{
				jQuery('#myform :checkbox').checkbox((skin ? {cls: skin} : {}));
			}
			
		</script>



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
            <td width="9%"> <span class="red"> * </span> Categoria: <br>
                <select name="tipo_id" required="true">
                <?php while ($lista = $categorias->fetch()) { ?>
                    <option value="<?= l($lista, 'id'); ?>" <?php if ($obj['tipo_id'] == $lista['id']) { ?> selected="selected" <?php } ?>>
                        <?= l($lista, 'titulo'); ?>
                    </option>
                <?php } ?>
                </select>

            </td>
        </tr>
        <tr>
            <td width="9%"> <span class="red"> * </span> T&iacute;tulo: <br>
                <input type="text" name="titulo" size="65" required="true" value="<?= field_form($obj['titulo']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'titulo' , $style = false); ?>
            </td>
        </tr>
        <tr>
            <td width="9%"><span class="red"> * </span>  S&iacute;ntese:<br>
                
                <input type="text" name="sintese" size="65" value="<?= field_form($obj['sintese']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'sintese' , $style = false); ?>
            </td>
        </tr>
        <tr>
            <td width="9%"><span class="red"> * </span>  Texto:<br>
                <textarea rows="5" cols="10" name="texto" required="true" class="ckeditor"><?= field_form($obj['texto']) ?></textarea>
                <br><br> <?php echo getCampos($conn, $obj['id'], 'texto' , $style = 'ckeditor'); ?>
            </td>
        </tr>
        <tr>
            <td width="9%">LINK PAGAMENTO TURISTOOL:<br>
                <input type="text" name="pagamento" value="<?= field_form($obj['pagamento']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'pagamento' , $style = false); ?>
            </td>
        </tr>
         <tr>
            <td width="9%">Imagem:<br><input name="imagem" id="imagem" type="file" /></td>
        </tr> 
        <tr>
            <td width="9%">Destaque?<br><input type="checkbox" name="destaque" value="1" <?php if (field_form($obj['destaque'])) echo 'checked'; ?> /></td>
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