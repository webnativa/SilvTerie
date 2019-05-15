<?php
include("../layout/block.php");
$obj = find($conn, @$_GET['id']);

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
            <td width="9%">T&iacute;tulo: <br> 
                <input type="text" name="titulo" size="65"  value="<?= field_form($obj['titulo']) ?>" />
            </td>
        </tr>
         <tr>
            <td width="9%">Link: <br> 
                <input type="text" name="link" size="65"  value="<?= field_form($obj['link']) ?>" />
            </td>
        </tr>
         <tr>
            <td width="9%">Tipo <br> 
                <select name="tipo" required="true">    
                    <option value="principal"<?php if ($obj['tipo'] == 'principal') { ?> selected="selected" <?php } ?> >
                        Principal
                    </option>
                    <option value="secundario"<?php if ($obj['tipo'] == 'secundario') { ?> selected="selected" <?php } ?> >
                        Secundário
                    </option>
                </select>
            </td>
        </tr>
 

        <tr>
            <td width="9%">Imagem:<br><input name="imagem" id="imagem" type="file" /></td>
        </tr>

        <?php if (field_form($obj['imagem'])) { ?>
            <tr>
                <td width="9%"><br><img src="<?= _MEDIA_FILES_ ?>/banner/<?= $obj['imagem'] ?>" width="150" height="110" /></td>
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