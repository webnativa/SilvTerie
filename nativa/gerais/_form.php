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

<form method="post" action="<?= _ROUTE_ACTION_ ?>/admin.php" enctype="multipart/form-data">

    <table style="margin-top: 10px" id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tr>
            <td width="9%">Telefones:<br>
                
                <input type="text" name="telefones" size="65" value="<?= field_form($obj['telefones']) ?>" /> <br><br>
                <input type="text" name="telefones2" size="65" value="<?= field_form($obj['telefones2']) ?>" />
            </td>
        </tr>
        <tr>
            <td width="9%">Endereço:<br>
                <textarea rows="5" cols="10" name="texto" required="true" class="ckeditor"><?= field_form($obj['texto']) ?></textarea>
                <br><br> <?php echo getCampos($conn, $obj['id'], 'texto' , $style = 'ckeditor'); ?>
            </td>
        </tr>
        <tr>
            <td width="9%">E-mail geral:<br>
                
                <input type="text" name="email" size="65" value="<?= field_form($obj['email']) ?>" />
            </td>
        </tr>
        <tr>
            <td width="9%">Facebook:<br>
                
                <input type="text" name="facebook" size="65" value="<?= field_form($obj['facebook']) ?>" />
            </td>
        </tr>
        <tr>
            <td width="9%">Instagram:<br>
                
                <input type="text" name="instagram" size="65" value="<?= field_form($obj['instagram']) ?>" />
            </td>
        </tr>
        <tr>
            <td width="9%">Linkedin:<br>
                
                <input type="text" name="linkedin" size="65" value="<?= field_form($obj['linkedin']) ?>" />
            </td>
        </tr>


        <!-- <tr>
            <td width="100%" colspan="2">SEO - Otimização para buscadores</td>
        </tr>

        <tr>
            <td width="9%">Título<br>
                
                <input type="text" name="seo_titulo" size="65" value="<?= field_form($obj['seo_titulo']) ?>" />
            </td>
        </tr>
        <tr>
            <td width="9%"> Palavras-chave<br>
                
              <input type="text" name="seo_palavras" size="65" value="<?= field_form($obj['seo_palavras']) ?>" />
            </td>
        </tr>

        <tr>
            <td width="9%">Descrição<br>
                
                <input type="text" name="seo_descricao" size="65" value="<?= field_form($obj['seo_descricao']) ?>" />
            </td>
        </tr>

 -->

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
        <input type="hidden" name="__imagem" value="<?= field_form($obj['imagem']) ?>" />
    <?php } ?>

    <input type="hidden" name="__send_form" value="form" />

</form>

<?php
include("../layout/block_end.php");
?>