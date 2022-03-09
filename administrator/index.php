<?php
    session_start();
    if($_POST){
        if($_POST['user']=="wiston" && $_POST['password']=="1234"){
            $_SESSION['user']="ok";
            $_SESSION['nameUser']="wiston";
            header('Location:admin.php');
        }else{
            $mensagge = "Usuario o Contraseña no valida";
        }
        
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
        <div class="container mt-5">
            <div class="row">


                <div class="card text-start|center|end" style="width: 300px;">
                    <div class="container">
                        <div class="card-body">
                            <h4 class="card-title text-center">Acceso</h4>
                        </div>
                        <?php if(isset($mensagge)){ ?>
                            <div class="alert alert-warning" role="alert">
                                <?php echo $mensagge; ?>
                            </div>
                        <?php }?>
                        <form action="index.php" method="POST">
                            <div class="mb-3 row">
                                <label for="user" class="col-sm-1-12 col-form-label">Usuario:</label>
                                <div class="col-sm-1-12">
                                    <input type="text" class="form-control" name="user" id="user" placeholder="Escribe tu usuario">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-sm-1-12 col-form-label">Contraseña:</label>
                                <div class="col-sm-1-12">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Escribe tu contraseña">
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    




    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
