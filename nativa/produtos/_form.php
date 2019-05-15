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
    <h1> <?= TITULO_MODULO ?></h1>
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

<form method="post" action="<?= _ROUTE_ACTION_ ?>/admin.php" enctype="multipart/form-data">

    <table style="margin-top: 10px" id="sample-table-1" class="table table-striped table-bordered table-hover">
        
        <tr>
            <td width="9%"> <span class="red"> * </span> Categoria: <br />
                <select name="categoria_id">
                    <?php while ($categoria = $categorias->fetch()) { ?>
                        <?php if(field_form($obj['categoria_id'])) {?>
                            <option value="<?= $categoria['id'] ?>"<?php if($obj['categoria_id'] == $categoria['id']) {?> selected="selected" <?php }?> ><?= $categoria['titulo'] ?></option>
                        <?php } else {?>
                            <option value="<?= $categoria['id'] ?>"><?= $categoria['titulo'] ?></option>
                        <?php }?>
                        
                    <?php } ?>
                    
                </select>
            </td>
        </tr>
        <tr>
            <td width="9%"> <span class="red"> * </span> Marca: <br />
                <select name="marca_id">
                    <?php while ($marca = $marcas->fetch()) { ?>
                        <?php if(field_form($obj['marca_id'])) {?>
                            <option value="<?= $marca['id'] ?>"<?php if($obj['marca_id'] == $marca['id']) {?> selected="selected" <?php }?> ><?= $marca['titulo'] ?></option>
                        <?php } else {?>
                            <option value="<?= $marca['id'] ?>"><?= $marca['titulo'] ?></option>
                        <?php }?>
                        
                    <?php } ?>
                    
                </select>
            </td>
        </tr>

        
        <tr>
            <td width="9%"> <span class="red"> * </span> Nome:<br />
                <input type="text" name="titulo" size="65" required="true" value="<?= field_form($obj['titulo']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'titulo' , $style = false); ?>
            </td>
        </tr>

        <tr>
            <td width="9%">Valor locação: <br />
                <input type="text" name="valor" onkeyup="moeda(this)" size="65" value="<?= field_form($obj['valor']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'valor' , $style = false); ?>
            </td>
        </tr>
        <tr>
            <td width="9%">Valor original: <br />
                <input type="text" name="valor_original" onkeyup="moeda(this)" size="65" value="<?= field_form($obj['valor_original']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'valor_original' , $style = false); ?>
            </td>
        </tr>


        <tr>
            <td width="9%"><span class="red"> * </span>  Texto:<br />
                <textarea rows="5" cols="10" name="texto" required="true" class="ckeditor"><?= field_form($obj['texto']) ?></textarea>
                <br><br> <?php echo getCampos($conn, $obj['id'], 'texto' , $style = 'ckeditor'); ?>
            </td>
        </tr>

        <tr>
            <td width="9%">Foto frente:<br /><input name="imagem" id="imagem" type="file" /></td>
        </tr>

        <?php if (field_form($obj['imagem'])) { ?>
            <tr>
                <td width="91%"><img src="<?= _MEDIA_FILES_ ?>/produtos/<?= $obj['imagem'] ?>" width="150"/></td>
            </tr>
        <?php } ?>
        <tr>
            <td width="9%">Foto costas:<br /><input name="imagem2" id="imagem2" type="file" /></td>
        </tr>

        <?php if (field_form($obj['imagem2'])) { ?>
            <tr>
                <td width="91%"><img src="<?= _MEDIA_FILES_ ?>/produtos/<?= $obj['imagem2'] ?>" width="150"/></td>
            </tr>
        <?php } ?>




        <tr>
            <td width="9%"> <span class="red"> * </span> Cor: <br />
                <select name="cor_id">
                    <?php while ($cor = $cores->fetch()) { ?>
                        <?php if(field_form($obj['marca_id'])) {?>
                            <option style="background-color:<?= $cor['cor'] ?>" value="<?= $cor['id'] ?>"<?php if($obj['cor_id'] == $cor['id']) {?> selected="selected" <?php }?> ><?= $cor['titulo'] ?></option>
                        <?php } else {?>
                            <option value="<?= $cor['id'] ?>"><?= $cor['titulo'] ?></option>
                        <?php }?>
                        
                    <?php } ?>
                    
                </select>
            </td>
        </tr>


        <tr>
            <td width="9%">  Parcelamento:<br />
                <input type="text" name="parcelamento" size="65" value="<?= field_form($obj['parcelamento']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'parcelamento' , $style = false); ?>
            </td>
        </tr>

        <tr>
            <td width="9%"> Palavras de busca:<br />
                <input type="text" name="pbusca" size="65" value="<?= field_form($obj['pbusca']) ?>" />
                <br><br> <?php echo getCampos($conn, $obj['id'], 'pbusca' , $style = false); ?>
            </td>
        </tr>



        <tr>
            <td width="9%">Publicar?<br /><input type="checkbox" name="status" value="1" <?php if (field_form($obj['status'])) echo 'checked'; ?> /></td>
        </tr>

        <tr>
            <td width="9%">Destaque na home?<br /><input type="checkbox" name="destaque" value="1" <?php if (field_form($obj['destaque'])) echo 'checked'; ?> /></td>
        </tr>


        <tr>
            <td width="91%"></td>
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









<?php
include("../layout/block_end.php");
?>