<div class="page-header">
    <h1> <?= TITULO_MODULO ?></h1>
</div>

<?php if (array_key_exists('sucesso', $_GET)) { ?>
    <div class="alert alert-block alert-success">
        <i class="ace-icon fa fa-check green"></i>
        Ação realizada com sucesso!
    </div>
<?php } ?>

<?php if (in_array('add', $acoes)) { ?>
    <a href="<?= _ROUTE_ACTION_ ?>/add.php" class="red add_new">
        <i class="ace-icon fa fa-pencil-square-o bigger-130"></i>
        <strong>Novo</strong>
    </a>
<?php } ?>
<table style="margin-top: 10px" id="sample-table-1" class="table table-striped table-bordered table-hover">

    <thead>
        <tr>
            <?php foreach ($campos as $key => $value) { ?>
                <th class="<?= $value['class'] ?>"> <?= $value['label'] ?> </th>
            <?php } ?>
        </tr>
    </thead>

    <tbody>
        <?php while ($obj = $lista->fetch()) { ?>
            <tr id="<?= $obj['id'] ?>">

                <?php foreach ($campos as $key => $value) { ?>
                    <td class="<?= $value['class'] ?>">
                        <?php echo tipo_fiel($obj[$key], $value['tipo'], $obj['id'], @$value['pasta']); ?>
                    </td>
                <?php } ?>

            </tr>
        <?php } ?>
    </tbody>
</table>