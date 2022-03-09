<!doctype html>
<html lang="en">
  <head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>

    <?php $url = "http://".$_SERVER['HTTP_HOST']."/bixxus" ?>  
    
    <nav class="navbar navbar-expand navbar-light bg-primary">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador <span class="visually-hidden">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrator/Admin.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrator/section/products.php">Administrar producto</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>">Ver Sitio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrator/section/close.php">Cerrar</a>
        </div>
    </nav>

        <div class="container">
            <div class="row">