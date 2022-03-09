<?php include("template/header.php"); ?>
<?php include("administrator/setting/bd.php"); 
  $sentencia = $conexion->prepare("SELECT * FROM `productos`");
  $sentencia->execute();
  $mostrarPorductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
  
?>
<div class="row row-cols-1 row-cols-md-3 g-4">
<?php foreach($mostrarPorductos as $producto){?>

  <div class="col">
    <div class="card h-100">
      <img src="img/<?php echo $producto['IMAGEN'];?>" width="50px" alt="imagen producto" class="card-img-top">  
      <div class="card-body">
        <h5 class="card-title"><?php echo $producto['NAME']; ?></h5>
        <p class="card-text"><?php echo $producto['DESCRIPTION']; ?></p>
        <p class="card-text">$<?php echo $producto['PRICE']; ?></p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>

<?php }?>
</div>
<?php include("template/footer.php"); ?>