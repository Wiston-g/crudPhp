<?php include("template/header.php"); ?>
<?php include("administrator/setting/bd.php"); 
  $sentencia = $conexion->prepare("SELECT * FROM `productos`");
  $sentencia->execute();
  $mostrarPorductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
  
?>

<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://sbapi.bancolombia.com/v2/security/oauth-otp/oauth2/authorize?",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "accept: text/html",
    "response_type: code",
    "scope: Transfer-Intention:write:app",
    "redirect_uri: http://localhost/bixxus/products.php",
    "state: false"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
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