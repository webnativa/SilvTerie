<!DOCTYPE html>
<html lang="en">
<head>
<?php include ("head.php"); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

	<!-- Primary Meta Tags -->
	<title>Vestidos de Festa para Locação Rio de Janeiro RJ</title>
	<meta name="title" content="Vestidos de Festa para Locação Rio de Janeiro RJ">
	<meta name="description" content="Venha ao nosso atelier, experimentar todos os modelos que desejar. Temos todos os estilos de vestidos: curtos, longos, lisos, e bordados. Estamos na Barra da Tijuca, Rio de Janeiro.">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://www.silvterie.com.br/">
	<meta property="og:title" content="Vestidos de Festa para Locação Rio de Janeiro RJ">
	<meta property="og:description" content="Venha ao nosso atelier, experimentar todos os modelos que desejar. Temos todos os estilos de vestidos: curtos, longos, lisos, e bordados. Estamos na Barra da Tijuca, Rio de Janeiro.">
	<meta property="og:image" content="https://www.silvterie.com.br/images/quem-somos1.jpg">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="https://www.silvterie.com.br/">
	<meta property="twitter:title" content="Vestidos de Festa para Locação Rio de Janeiro RJ">
	<meta property="twitter:description" content="Venha ao nosso atelier, experimentar todos os modelos que desejar. Temos todos os estilos de vestidos: curtos, longos, lisos, e bordados. Estamos na Barra da Tijuca, Rio de Janeiro.">
	<meta property="twitter:image" content="https://www.silvterie.com.br/images/quem-somos1.jpg">


    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/chosen.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
    <link rel="stylesheet" type="text/css" href="css/pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400italic,400,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,100,100italic,300italic,400,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <?php 


	    $categoria = null;
	    $cor = null;
	    $marca = null;

        if (!empty($_GET['categoria'])) {
            $query_busca .= ' AND categoria_id = ' . (int) $_GET['categoria'];
            $categoria = (int) $_GET['categoria'];
        }
        if (!empty($_GET['cor'])) {
            $query_busca .= ' AND cor_id = ' . (int) $_GET['cor'];
            $cor = (int) $_GET['cor'];
        }
        if (!empty($_GET['marca'])) {
            $query_busca .= ' AND marca_id = ' . (int) $_GET['marca'];
            $marca = (int) $_GET['marca'];
        }

        $sqlDestaques = $conn->prepare("SELECT * FROM produtos Where status = '1'  $query_busca  ");
        $sqlDestaques->execute();
        $destaques = $sqlDestaques;


	
		$stmt = $conn->prepare("SELECT * FROM categorias Where id = '$categoria' ");
		$stmt->execute();
		$categoriaProduto = $stmt->fetch();

        $sqlDestaques = $conn->prepare("SELECT * FROM categorias ");
        $sqlDestaques->execute();
        $categorias = $sqlDestaques;

        $sqlDestaques = $conn->prepare("SELECT * FROM marcas ");
        $sqlDestaques->execute();
        $marcas = $sqlDestaques;

        $sqlDestaques = $conn->prepare("SELECT * FROM cores ");
        $sqlDestaques->execute();
        $cores = $sqlDestaques;




    ?>

	
</head>
<body class="home">
<div id="box-mobile-menu" class="box-mobile-menu full-height full-width">
	<div class="box-inner">
		<span class="close-menu"><span class="icon pe-7s-close"></span></span>
	</div>
</div>

<?php include ("header.php"); ?>






<div class="container">




	<div class="margin-top-50">

	<form name="buscaGeral" id="buscaGeral" action="vestidos.php" method="get">

			<div class="col-sm-4 col-md-3 sidebar">
                <!-- Product category -->
                <div class="widget widget_product_categories">
                    <h2 class="widget-title">Categorias</h2>


					<select style="width:100%;" name="categoria" id="categoria">
						<option value="">Todas</option>
						<?php while ($lista = $categorias->fetch()) { ?>
							<option value="<?= l($lista, 'id'); ?>"  <?php if ($lista['id'] == $_GET['categoria']) {?>selected<?php } ?>>
								<?= l($lista, 'titulo'); ?>
							</option>
						<?php } ?>
					</select>



                </div>
                <!-- ./Product category -->
                <div class="widget widget_product_categories">
                    <h2 class="widget-title">Marca</h2>


					<select style="width:100%;" name="marca" id="marca">
						<option value="">Todas</option>
						<?php while ($lista = $marcas->fetch()) { ?>
							<option value="<?= l($lista, 'id'); ?>"  <?php if ($lista['id'] == $_GET['marca']) {?>selected<?php } ?>>
								<?= l($lista, 'titulo'); ?>
							</option>
						<?php } ?>
					</select>



                </div>
                <!-- ./Product category -->
                <!-- By color -->
                <div class="widget widget_layered_nav">
                    <h2 class="widget-title">Cor</h2>
                    <!-- <ul class="product-categories" style="max-height:240px;     overflow-y: scroll;"> -->

						<!-- < ?php while ($lista = $cores->fetch()) { ?> -->
							<!-- <input type="checkbox" value="< ?= l($lista, 'id'); ?>"> < ?= l($lista, 'id'); ?> < ?= l($lista, 'titulo'); ?><br> -->
                        	<!-- <li style="background-color:< ?= l($lista, 'cor'); ?>; padding:5px;"><a href="https://< ?php echo $_SERVER['HTTP_HOST'] ?>&cor=< ?= l($lista, 'id'); ?>">< ?= l($lista, 'titulo'); ?></a></li> -->
						<!-- < ?php } ?> -->

                    <!-- </ul> -->

					<select style="width:100%;" name="cor" id="cor">
						<option value="">Todas</option>
						<?php while ($lista = $cores->fetch()) { ?>
							<option value="<?= l($lista, 'id'); ?>" <?php if ($lista['id'] == $_GET['cor']) {?>selected<?php } ?>>
								
								<?= l($lista, 'titulo'); ?>
							</option>
						<?php } ?>
					</select>
					
                </div>
                 <!-- ./By color -->
                 <!-- Filter price -->
                <div class="widget widget_price_filter">
						<button class="button">FILTRAR</button>
						<br>
						<br>
						<br>
						<br>
                </div>



            </div>
	</form>



<div class="col-sm-8 col-md-9 main-content">



		<div class="col-md-12">
			<div class="section-title text-center margin-top-40 margin-bottom-30">
				<h3><?= l($categoriaProduto, 'titulo'); ?></h3>
				<!-- <span class="sub-title">Uma seleção dos queridinhos da semana!</span> -->
			</div>
		</div>
		<div class="tab-product">

			<div class="visible-xs col-md-12 text-center"><img src="images/role.png" alt="" class="img-responsive"></div>


			<ul class="product-list-grid2 tab-list row owl-carousel-mobile" data-nav="false" data-dots="false" data-margin="0" data-loop="true"  data-items="1">
				<?php while ($lista = $destaques->fetch()) { ?>
				n <?php echo $destaques->fetchColumn() ?>
					<li class="product-item style3 mobile-slide-item col-sm-4 col-md-3">
						<div class="product-inner">
							<div class="product-thumb has-back-image">
								<a href="detalhe.php?id=<?= l($lista, 'id'); ?>&categoria=<?= l($lista, 'categoria_id'); ?>"><img src="https://www.silvterie.com.br/thumb.php?imagem=<?= l($lista, 'imagem'); ?>&folder=produtos&x=400&y=600" alt=""></a>
								<a class="back-image" href="detalhe.php?id=<?= l($lista, 'id'); ?>&categoria=<?= l($lista, 'categoria_id'); ?>"><img src="thumb.php?imagem=<?= l($lista, 'imagem2'); ?>&folder=produtos&x=400&y=600" alt=""></a>
							</div>
							<div class="product-info">
								<h3 class="product-name"><a href="detalhe.php?id=<?= l($lista, 'id'); ?>&categoria=<?= l($lista, 'categoria_id'); ?>"><?= l($lista, 'titulo'); ?></a></h3>
								<span class="price">
									<ins>R$ <?= l($lista, 'valor'); ?></ins><br>
									<small><?= l($lista, 'parcelamento'); ?><br>


                	Tam.<?php
					
					$queryCaracteristicas = "Select * from tamanho as C join tamanho_produto as CI "
							. "on CI.caracteristisca_id = C.id where CI.produto_id = $lista[id]";

					$stmt = $conn->prepare($queryCaracteristicas);
					$stmt->execute();
					$rsCaracteristicas = $stmt;
					
					while ($obj = $rsCaracteristicas->fetch(PDO::FETCH_OBJ)) { ?>

                    | <?php echo $obj->nome ?>
                    <?php } ?>
					</small>



								</span>
								<a href="detalhe.php?id=<?= l($lista, 'id'); ?>&categoria=<?= l($lista, 'categoria_id'); ?>" class="button add_to_cart_button">EU QUERO</a>
							</div>
						</div>
					</li>
				<?php } ?>
			</ul>

			<div class="visible-xs col-md-12 text-center"><img src="images/role.png" alt="" class="img-responsive"></div>


		</div>
	</div>
	</div>



</div>
<?php include ("rodape.php"); ?>