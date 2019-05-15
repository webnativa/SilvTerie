<?php
include("../layout/block.php");
$obj = find($conn, @$_GET['id']);
?>

		<link rel="stylesheet" href="../banner/jquery.checkbox.css" />
		<link rel="stylesheet" href="../banner/jquery.safari-checkbox.css" />
		<!--<script type="text/javascript" src="jquery.js"></script>-->
		<script type="text/javascript" src="../banner/jquery.checkbox.min.js"></script>
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
            <td width="9%"> <span class="red"> * </span> Nome: </td>
            <td width="91%"> 
                <input type="text" name="titulo" size="65" required="true" value="<?= field_form($obj['titulo']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'titulo' , $style = false); ?>
            </td>
        </tr>

        <tr>
            <td width="9%"> Ativo? </td>
            <td width="91%"><input type="checkbox" name="status" value="1" <?php if (field_form($obj['status'])) echo 'checked'; ?> /></td>
        </tr>

        <tr>
            <td width="9%"></td>
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