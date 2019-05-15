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

        $busca = $_GET['palavra'];

        $sqlProdutos = $conn->prepare("
        SELECT PRODUTOS.*, PRODUTOS.titulo as titulo, CATEGORIA.id as categoria_id, CATEGORIA.titulo as nome_categoria, MARCA.titulo as marca 
        FROM produtos PRODUTOS 
        Inner Join categorias CATEGORIA on CATEGORIA.id = PRODUTOS.categoria_id 
        Inner Join marcas MARCA on MARCA.id = PRODUTOS.marca_id 
        Where PRODUTOS.status = '1' and (PRODUTOS.titulo LIKE '%$busca%' or PRODUTOS.pbusca LIKE '%$busca%' or MARCA.titulo LIKE '%$busca%' or CATEGORIA.titulo LIKE '%$busca%') Order By PRODUTOS.id Desc limit 100
        ");
        $sqlProdutos->execute();
        $produtos = $sqlProdutos;

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
            <div class="col-md-12">
                <div class="section-title text-center margin-top-40 margin-bottom-30">
                    <h3>Resultado da busca para "<u><?php echo($_GET['palavra']); ?></u>"</h3>
                </div>
            </div>
            <div class="tab-product">

			<div class="visible-xs col-md-12 text-center"><img src="images/role.png" alt="" class="img-responsive"></div>


                <ul class="product-list-grid2 tab-list row owl-carousel-mobile" data-nav="false" data-dots="false" data-margin="0" data-loop="true"  data-items="1">




                    <?php while ($lista = $produtos->fetch()) { ?>
                        <li class="product-item style3 mobile-slide-item col-sm-4 col-md-3">
                            <div class="product-inner">
                                <div class="product-thumb has-back-image">
                                    <a href="detalhe.php?id=<?= l($lista, 'id'); ?>&categoria=<?= l($lista, 'categoria_id'); ?>"><img src="thumb.php?imagem=<?= l($lista, 'imagem'); ?>&folder=produtos&x=400&y=600" alt=""></a>
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

<?php include ("rodape.php"); ?>


