<?php
include("../layout/block.php");
$lista = lista($conn, (int) $_GET['id'], $_GET['tipo']);

?>

<div class="page-header">
    <h1> Enviar Imagens </h1>
</div>

<a href="<?= _SITE_URL_ . '/' . _ADMIN_URL_ . '/' . $_GET['tipo'] ?>" class="red add_new">
    <i class="ace-icon bigger-130"></i>
    <strong> « Voltar</strong>
</a>
<br>
<br>
<!--[if !IE]> -->
<script type="text/javascript">
    var _SITE_URL = "<?= _SITE_URL_ ?>";
    var _ADMIN_URL_ = "<?= _ADMIN_URL_ ?>";
    window.jQuery || document.write("<script src='<?php echo _STATIC_FILES_; ?>assets/js/jquery.min.js'>" + "<" + "/script>");
</script>
<script src="<?= _STATIC_FILES_; ?>js/jquery.uploadifive.min.js"></script>
<!-- <![endif]-->
<script type="text/javascript">
    $(document).ready(function() {
        
        $('.position_control').on('focusout', function() {
            
            var pk = $(this).attr('pk');
            var value = $(this).val();

            $.ajax({
                type: 'POST',
                url: 'admin.php',
                dataType: 'json',
                data: {'pk': pk, 'posicao': value, 'ordenar': true},
                success: function(response) {
                }
            });
        });

        $(function() {
            
            
            $('#file_upload').uploadifive({
                'formData': {
                    'entity_id': '<?= $_GET['id'] ?>',
                    'tipo': '<?= $_GET['tipo'] ?>'
                },
                'onQueueComplete': function(queueData) {
                    window.location.reload();
                },
                'folder': '/public/',
                'buttonText': 'Selecione',
                'uploadScript'     : 'uploadify.php'
            });
        });
    });
</script>

<div id="load"></div>
<div id="queue"></div>
<input id="file_upload" name="file_upload" type="file" multiple="true">

<?php
include("../layout/_lista.php");
include("../layout/block_end.php");
