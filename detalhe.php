<!DOCTYPE html>
<html lang="en">
<head>
<?php include ("head.php"); 

    $id = (int) $_GET['id'];
    $categoria = $_GET['categoria'];
	$stmt = $conn->prepare("
    
    SELECT * FROM produtos
    Where id = $id    
    ");
	$stmt->execute();
	$conteudo = $stmt->fetch();

    $stmt = $conn->prepare("SELECT * FROM imagens Where entity_id = $id");
    $stmt->execute();
    $imagens = $stmt;

    $stmt = $conn->prepare("SELECT * FROM imagens Where entity_id = $id");
    $stmt->execute();
	$imagens2 = $stmt;


    $sqlMaisConteudo = $conn->prepare("SELECT * FROM produtos Where status = '1' and id != '$id' and categoria_id = '$categoria' ");
    $sqlMaisConteudo->execute();
    $maisConteudo = $sqlMaisConteudo;
    
    $sqlCategoria = $conn->prepare("SELECT * FROM categorias Where status = '1' and id != '$categoria' ");
    $sqlCategoria->execute();
    $categoriaProduto = $sqlCategoria;
	
	$stmt = $conn->prepare("SELECT * FROM categorias Where id = '$categoria' ");
	$stmt->execute();
	$categoriaProduto = $stmt->fetch();


    $queryCaracteristicas = "Select * from tamanho as C join tamanho_produto as CI "
            . "on CI.caracteristisca_id = C.id where CI.produto_id = $id";

    $stmt = $conn->prepare($queryCaracteristicas);
    $stmt->execute();
    $rsCaracteristicas = $stmt;




?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">


	<!-- Primary Meta Tags -->
	<title><?= l($categoriaProduto, 'titulo'); ?> <?= l($conteudo, 'titulo'); ?></title>
	<meta name="title" content="<?= l($categoriaProduto, 'titulo'); ?> <?= l($conteudo, 'titulo'); ?>">
	<meta name="description" content="<?= l($categoriaProduto, 'titulo'); ?> <?= l($conteudo, 'texto'); ?> - SilvTerie, Barra da Tijuca, Rio de Janeiro.">




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

	
</head>
<body class="home">


<?php include ("header.php"); ?>


<div class="product-details-full">                            
  <div class="container">
      <div class="row">
          <div class="col-md-7 col-lg-7 col-sm-12">
              <div class="product-detail-image">
                  <div class="thumbnails">

                      <a data-url="thumb.php?imagem=<?= l($conteudo, 'imagem'); ?>&folder=produtos&x=400&y=600" class="active" href="#"><img src="thumb.php?imagem=<?= l($conteudo, 'imagem'); ?>&folder=produtos&x=400&y=600" alt=""></a>
                      <a data-url="thumb.php?imagem=<?= l($conteudo, 'imagem2'); ?>&folder=produtos&x=400&y=600" class="" href="#"><img src="thumb.php?imagem=<?= l($conteudo, 'imagem2'); ?>&folder=produtos&x=400&y=600" alt=""></a>                      





				  
                  </div>
                  <div class="main-image-wapper">
                      <img class="main-image" src="thumb.php?imagem=<?= l($conteudo, 'imagem'); ?>&folder=produtos&x=400&y=600" alt="">
                  </div>
              </div>
          </div>
          <div class="col-md-5 col-lg-5 col-sm-12">
              <div class="product-details-right">
                  <div class="breadcrumbs">
                        <a href="index.html">Home</a>
                         <a href="index.html"><?= l($categoriaProduto, 'titulo'); ?></a>
                        <span><?= l($conteudo, 'titulo'); ?></span>
                  </div>
                  <h3 class="product-name"><?= l($conteudo, 'titulo'); ?></h3>

                  <span class="price">
                    <ins>
                    <small>ALUGUE POR R$ <?= l($conteudo, 'valor'); ?><br>
                    </small>
                    <strong><?= l($conteudo, 'parcelamento'); ?></strong>
                    <br>
                    Tam.: 
                    

						
                	<?php while ($obj = $rsCaracteristicas->fetch(PDO::FETCH_OBJ)) { ?>
                    <?php echo $obj->nome ?> |
                    <?php } ?>



                    </ins>


                  </span>

                  <div class="short-descript">
                      <p>
                        <?= l($conteudo, 'texto'); ?>
                      </p>
                  </div>  
                  <form class="cart" enctype="multipart/form-data" method="post">
                      <a class="button button-add-cart" data-quantity="1"  href="https://api.whatsapp.com/send?phone=5521995117171" target="_blank">EU QUERO</a>
                  </form>  
              </div>
          </div>
      </div>
    </div>
<br>
<br>
<br>
</div>

<?php include ("rodape.php"); ?>