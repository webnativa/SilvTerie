

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
        <i class="ace-icon fas fa-plus-square bigger-130"></i>
        <strong>Novo</strong>
    </a>
<?php } ?>
<table style="margin-top: 10px" id="sample-table-1" class="table table-striped table-bordered table-hover">

    <thead>
        <tr>
            <?php foreach ($campos as $key => $value) { ?>
                <th class="<?= $value['class'] ?>"> <?= $value['label'] ?> </th>
            <?php } ?>
			<?php if (in_array('editar', $acoes)) { ?>
            <th class="center" style="width: 5%">Editar</th>
            <?php } ?>
			<?php if (in_array('visualizar', $acoes)) { ?>
            <th class="center" style="width: 5%">Visualizar</th>
            <?php } ?>

            <th class="center" style="width: 5%">Tam.</th>

			<?php if (in_array('fotos', $acoes)) { ?>
            <th class="center" style="width: 5%">Imagens</th>
            <?php } ?>
			<?php if (in_array('remover', $acoes)) { ?>
            <th class="center" style="width: 5%">Excluir</th>
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
                        <?php if (in_array('editar', $acoes)) { ?>
                <td class="center" onClick='javascript:location.href="add.php?id=<?= $obj['id'] ?>"' style="cursor:pointer;">
                    <div class="hidden- hidden- action-" style="padding:5px 0 0 0;">
                             <a class="green" href="add.php?id=<?= $obj['id'] ?>" style="margin:8px;">
                                <i class="ace-icon fas fa-pencil-alt bigger-130"></i>
                            </a>
					</div>
                </td>
                        <?php } ?>
                        <?php if (in_array('visualizar', $acoes)) { ?>
                <td class="center" style="cursor:pointer;">
                    <div class="hidden- hidden- action-" style="padding:5px 0 0 0;">
                             <a class="green" href="<?= _SITE_URL_ ?>/detalhe.php?id=<?= $obj['id'] ?>" style="margin:8px;" target="_blank">
                                <i class="ace-icon fas fa-search bigger-130"></i>
                            </a>
					</div>
                </td>
                        <?php } ?>


                <td class="center" onClick='javascript:location.href="edit_tamanho.php?id=<?= $obj['id'] ?>"' style="cursor:pointer;">
                    <div class="hidden- hidden- action-" style="padding:5px 0 0 0;">
                             <a class="green" href="edit_tamanho.php?id=<?= $obj['id'] ?>" style="margin:8px;">
                                <i class="ace-icon fas fa-pencil-alt bigger-130"></i>
                            </a>
					</div>
                </td>



                        <?php if (in_array('fotos', $acoes)) { ?>
                <td class="center" onClick='javascript:location.href="<?= _SITE_URL_ . '/' . _ADMIN_URL_ . '/imagens/' ?>?tipo=<?= _MODULE_ ?>&id=<?= $obj['id'] ?>"' style="cursor:pointer;">
                    <div class="hidden- hidden- action-" style="padding:5px 0 0 0;">

                            <a class="blue" href="<?= _SITE_URL_ . '/' . _ADMIN_URL_ . '/imagens/' ?>?tipo=<?= _MODULE_ ?>&id=<?= $obj['id'] ?>" style="margin:8px;">
                                <i class="ace-icon fas fa-camera bigger-130"></i>
                            </a>
					</div>
                </td>
                        <?php } ?>
                        <?php if (in_array('remover', $acoes)) { ?>
                <td class="center">
                    <div class="hidden- hidden- action-" style="padding:5px 0 0 0;">
                            <a href="#" id_entity="<?= $obj['id'] ?>" class="red btn_remove" module="<?= _MODULE_ ?>" entity="<?= _TABLE_ ?>" style="margin:8px;">
                                <i class="ace-icon fas fa-trash bigger-130"></i>
                            </a>
                    </div>
                </td>
                        <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>

