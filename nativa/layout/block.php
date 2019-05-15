<?php
    session_start();
    include_once('../../configs/funcoes.php');
    include_once('../' ._MODULE_REFERENCE_. '/admin.php');
    include_once('../../configs/idiomas.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta charset="utf-8"/>

        <title><?php echo _NOME_SITE_; ?> | <?php echo _CREDITOS_; ?></title>
        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">


        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/jquery-ui.custom.min.css"/>
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/chosen.css"/>
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/datepicker.css"/>
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/bootstrap-timepicker.css"/>
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/daterangepicker.css"/>
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/bootstrap-datetimepicker.css"/>
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/colorpicker.css"/>

        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>css/custom.css"/>

        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/ace-fonts.css"/>

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/ace.min.css"/>

        <!--[if lte IE 9]>
                            <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
                    <![endif]-->
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/ace-skins.min.css"/>
        <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/ace-rtl.min.css"/>

        <!--[if lte IE 9]>
                      <link rel="stylesheet" href="<?php echo _STATIC_FILES_ ;?>assets/css/ace-ie.min.css" />
                    <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="<?php echo _STATIC_FILES_ ;?>assets/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lte IE 8]>
                    <script src="<?php echo _STATIC_FILES_ ;?>assets/js/html5shiv.js"></script>
                    <script src="<?php echo _STATIC_FILES_ ;?>assets/js/respond.min.js"></script>
                    <![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript">
            var _SITE_URL = "<?= _SITE_URL_ ?>";
            var _ADMIN_URL_ = "<?= _ADMIN_URL_ ?>";
            window.jQuery || document.write("<script src='<?php echo _STATIC_FILES_ ;?>assets/js/jquery.min.js'>" + "<" + "/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
            <script type="text/javascript">
             window.jQuery || document.write("<script src='<?php echo _STATIC_FILES_ ;?>assets/js/jquery1x.min.js'>"+"<"+"/script>");
            </script>
            <![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='<?php echo _STATIC_FILES_ ;?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <script src="<?php echo _STATIC_FILES_ ;?>assets/js/bootstrap.min.js"></script>


    </head>

    <body class="no-skin">
        <!-- #section:basics/navbar.layout -->

        <?php include("menu_navbar.php"); ?>
        <!-- /section:basics/navbar.layout -->

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch (e) {
                }
            </script>

            <!-- #section:basics/sidebar -->
            <?php include("menu_left.php"); ?>

            <!-- /section:basics/sidebar -->
            <div class="main-content">

                <!-- #section:basics/content.breadcrumbs -->
                <!-- /section:basics/content.breadcrumbs -->
                <div class="page-content">

                    <div class="col-xs-12">
                        <div class="row">

