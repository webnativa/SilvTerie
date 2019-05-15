<?php
session_start();
include_once('../../configs/configs.php');
if (!empty($_SESSION['id']) && !empty($_SESSION['logado'])) {
    header("location:" . _SITE_URL_ . '/' . _ADMIN_URL_ . '/inicio/');
}

include_once('../../configs/funcoes.php');
include_once('../' . _MODULE_REFERENCE_ . '/admin.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title><?= _NOME_SITE_ ?></title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?= _STATIC_FILES_; ?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= _STATIC_FILES_; ?>assets/css/font-awesome.min.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="<?= _STATIC_FILES_; ?>assets/css/ace-fonts.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?= _STATIC_FILES_; ?>assets/css/ace.min.css" />

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="<?= _STATIC_FILES_; ?>assets/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?= _STATIC_FILES_; ?>assets/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?= _STATIC_FILES_; ?>assets/css/ace-ie.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?= _STATIC_FILES_; ?>assets/css/ace.onpage-help.css" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="<?= _STATIC_FILES_; ?>assets/js/html5shiv.js"></script>
        <script src="<?= _STATIC_FILES_; ?>assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">                                
                                <h4 class="blue" id="id-company-text">&copy; <?= _NOME_SITE_ ?></h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="ace-icon fa fa-coffee green"></i>
                                                Informe seus dados
                                            </h4>

                                            <div class="space-6"></div>

                                            <form id="form_cadastro">
                                                <div class="response_cadastro" style="color: red"></div>

                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" class="form-control" name="email" placeholder="e-mail" />
                                                            <i class="ace-icon fa fa-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="senha" class="form-control" placeholder="senha" />
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>

                                                    <div class="space"></div>

                                                    <div class="clearfix">


                                                        <button type="button" class="width-35 pull-right btn btn-sm btn-primary btn_login">
                                                            <i class="ace-icon fa fa-key"></i>
                                                            <span class="bigger-110">Login</span>
                                                        </button>
                                                    </div>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>



                                            <div class="space-6"></div>


                                        </div><!-- /.widget-main -->

                                        <div class="toolbar clearfix">
                                            <div>
                                                <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                                    <i class="ace-icon fa fa-arrow-left"></i>
                                                    Recuperar senha
                                                </a>
                                            </div>

                                            <!--                                                                        <div>
                                                                                                                        <a href="#" data-target="#signup-box" class="user-signup-link">
                                                                                                                            I want to register
                                                                                                                            <i class="ace-icon fa fa-arrow-right"></i>
                                                                                                                        </a>
                                                                                                                    </div>-->
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->

                                <div id="forgot-box" class="forgot-box widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header red lighter bigger">
                                                <i class="ace-icon fa fa-key"></i>
                                                Recuperar senha
                                            </h4>

                                            <div class="space-6"></div>
                                            <p>
                                                Informe seu e-mail
                                            </p>

                                            <form id="form_recuperar">
                                                <div id="mensagem_recuperar"></div>
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input id="email_recuperar" name="email" type="email" class="form-control" placeholder="Email" />
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <div class="clearfix">
                                                        <button type="button" class="btn_recuperar width-35 pull-right btn btn-sm btn-danger">
                                                            <i class="ace-icon fa fa-lightbulb-o"></i>
                                                            <span class="bigger-110">Enviar!</span>
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /.widget-main -->

                                        <div class="toolbar center">
                                            <a href="#" data-target="#login-box" class="back-to-login-link">
                                                Voltar para login
                                                <i class="ace-icon fa fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.forgot-box -->

                                <div id="signup-box" class="signup-box widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header green lighter bigger">
                                                <i class="ace-icon fa fa-users blue"></i>
                                                New User Registration
                                            </h4>

                                            <div class="space-6"></div>
                                            <p> Enter your details to begin: </p>

                                            <form>
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" class="form-control" placeholder="Email" />
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" placeholder="Username" />
                                                            <i class="ace-icon fa fa-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" class="form-control" placeholder="Password" />
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" class="form-control" placeholder="Repeat password" />
                                                            <i class="ace-icon fa fa-retweet"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block">
                                                        <input type="checkbox" class="ace" />
                                                        <span class="lbl">
                                                            I accept the
                                                            <a href="#">User Agreement</a>
                                                        </span>
                                                    </label>

                                                    <div class="space-24"></div>

                                                    <div class="clearfix">
                                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                                            <i class="ace-icon fa fa-refresh"></i>
                                                            <span class="bigger-110">Reset</span>
                                                        </button>

                                                        <button type="button" class="width-65 pull-right btn btn-sm btn-success">
                                                            <span class="bigger-110">Register</span>

                                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>

                                        <div class="toolbar center">
                                            <a href="#" data-target="#login-box" class="back-to-login-link">
                                                <i class="ace-icon fa fa-arrow-left"></i>
                                                Back to login
                                            </a>
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.signup-box -->
                            </div><!-- /.position-relative -->


                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?= _STATIC_FILES_; ?>assets/js/jquery.min.js'>" + "<" + "/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?= _STATIC_FILES_; ?>assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='<?= _STATIC_FILES_; ?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>



        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {

                $(document).on('click', '.toolbar a[data-target]', function(e) {
                    e.preventDefault();
                    var target = $(this).data('target');
                    $('.widget-box.visible').removeClass('visible');//hide others
                    $(target).addClass('visible');//show target
                });

                $('.btn_recuperar').click(function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?= _SITE_URL_ . '/' . _ADMIN_URL_ ?>/login/recuperar.php',
                        dataType: 'json',
                        data: $("#form_recuperar").serialize(),
                        beforeSend: function() {
                            $("#mensagem_recuperar").html('');
                        },
                        success: function(response) {

                            if (response.sucesso) {
                                $('#email_recuperar').val('');
                                alert("Uma nova senha foi enviada para seu e-mail.");
                                return false;
                            }
                            $("#mensagem_recuperar").html(response.mensagem);

                        }
                    });
                });


                $('.btn_login').click(function() {
                    $.ajax({
                        type: 'POST',
                        url: '<?= _SITE_URL_ . '/' . _ADMIN_URL_ ?>/login/admin.php',
                        dataType: 'json',
                        data: $("#form_cadastro").serialize(),
                        beforeSend: function() {
                            $(".response_cadastro").html('');
                        },
                        success: function(response) {

                            if (response.sucesso) {
                                window.location.href = "<?= _SITE_URL_ . '/' . _ADMIN_URL_ ?>/inicio";
                                return false;
                            }

                            $(".response_cadastro").html(response.mensagem);
                        }
                    });
                });

            });

            //you don't need this, just used for changing background
            jQuery(function($) {
                $('#btn-login-dark').on('click', function(e) {
                    $('body').attr('class', 'login-layout');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-light').on('click', function(e) {
                    $('body').attr('class', 'login-layout light-login');
                    $('#id-text2').attr('class', 'grey');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-blur').on('click', function(e) {
                    $('body').attr('class', 'login-layout blur-login');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'light-blue');

                    e.preventDefault();
                });

            });
        </script>
    </body>
</html>