<?php
include("../layout/block.php");
$obj = find($conn, @$_GET['id']);
$categorias = getCategorias($conn);
$marcas = getMarcas($conn);
$cores = getCores($conn);
$tamanhos = getTamanho($conn);

if($obj != false){
    
    $arrTamanhoMarcado = getTamanhoMarcado($obj['id'], $conn);
    
}


?>
<div class="page-header">
    <h1>Tamanhos - <?= field_form($obj['titulo']) ?></h1>
</div>
<a href="<?= _ROUTE_ACTION_ ?>" class="red add_new">
    <i class="ace-icon bigger-130"></i>
    <strong> « Voltar</strong>
</a>
		<link rel="stylesheet" href="jquery.checkbox.css" />
		<link rel="stylesheet" href="jquery.safari-checkbox.css" />
		<script type="text/javascript" src="jquery.checkbox.min.js"></script>
		
        
        
        
        
        
        <script type="text/javascript">
      function moeda(z){
        v = z.value;
        v=v.replace(/\D/g,"") //permite digitar apenas n?meros
        v=v.replace(/[0-9]{12}/,"inváido") //limita pra m?ximo 999.999.999,99
        //v=v.replace(/(\d{1})(\d{8})$/,"$1.$2") //coloca ponto antes dos ?ltimos 8 digitos
        //v=v.replace(/(\d{1})(\d{5})$/,"$1.$2") //coloca ponto antes dos ?ltimos 5 digitos
        v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2") //coloca virgula antes dos ?ltimos 2 digitos
        z.value = v;
    }
  



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

<form method="post" action="<?= _ROUTE_ACTION_ ?>/admin_tamanho.php" enctype="multipart/form-data">

    <table style="margin-top: 10px" id="sample-table-1" class="table table-striped table-bordered table-hover">
        
        


        <tr>
            <td width="91%">Tamanhos<br><br>

                <table class="table table-striped table-bordered table-hover">
                    <?php while ($carac = $tamanhos->fetch()) { ?>
                        <tr>
                            <td width="1%"><input id="carac_<?= $carac['id'] ?>" name="tamanho[]" type="checkbox" value="<?= $carac['id'] ?>" /></td>
                            <td width="34%"> <label for="carac_<?= $carac['id'] ?>"> <?= $carac['nome'] ?> </label> </td>
                        </tr>
                    <?php } ?>
                </table>
            </td>
        </tr>



        <tr>
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
        <input type="hidden" name="__imagem" value="<?= field_form($obj['imagem']) ?>" />
        <input type="hidden" name="__imagem2" value="<?= field_form($obj['imagem2']) ?>" />
    <?php } ?>

    <input type="hidden" name="__send_form" value="form" />

</form>





<script>

    $(document).ready(function() {

    <?php if ($obj != false) { ?>
            
            <?php while ($item = $arrTamanhoMarcado->fetch()) { ?>
                        $('#carac_<?php echo $item['caracteristisca_id']; ?>').attr('checked', true);
            <?php } ?>

    <?php } ?>
    });
</script>




<?php
include("../layout/block_end.php");
?>