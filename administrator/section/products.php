<?php include("../template/header.php"); ?>

<?php 
    $id = (isset($_POST['id']))?$_POST['id']:"" ;
    $name = (isset($_POST['name']))?$_POST['name']:"" ;
    $description = (isset($_POST['description']))?$_POST['description']:"" ;
    $price = (isset($_POST['precio']))?$_POST['precio']:"" ;
    $imagen = (isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"" ;
    $action = (isset($_POST['accion']))?$_POST['accion']:"" ;

    include("../setting/bd.php");

    switch ($action) {
        case 'crear':
            $sentencia = $conexion->prepare("INSERT INTO `productos` (`ID`, `NAME`, `DESCRIPTION`, `PRICE`, `IMAGEN`) VALUES (NULL, :NAMES, :DESCRIPTIONS, :PRICE, :IMAGEN);");
            
            $sentencia->bindParam(':NAMES', $name);
            $sentencia->bindParam(':DESCRIPTIONS', $description);
            $sentencia->bindParam(':PRICE', $price);

            $fecha = new DateTime();
            $nameFile = ($imagen!="")?$fecha->getTimestamp()."_".$_FILES['txtImagen']['name']:"imagen.jpg";

            $temImagen = $_FILES['txtImagen']['tmp_name'];
            if($temImagen!=""){
                move_uploaded_file($temImagen, "../../img/".$nameFile);
            }

            $sentencia->bindParam(':IMAGEN', $nameFile);
            $sentencia->execute();
            header("Location:products.php");
            break;
        case 'editar':
            $sentencia = $conexion->prepare("UPDATE `productos` SET `NAME`=:NAMES WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':NAMES', $name);
            $sentencia->execute();
            
            $sentencia = $conexion->prepare("UPDATE `productos` SET `DESCRIPTION`=:DESCRIPTIONS WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':DESCRIPTIONS', $description);
            $sentencia->execute();
            
            $sentencia = $conexion->prepare("UPDATE `productos` SET `PRICE`=:PRICE WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':PRICE', $price);
            $sentencia->execute();

            if($imagen!=""){
                $fecha = new DateTime();
                $nameFile = ($imagen!="")?$fecha->getTimestamp()."_".$_FILES['txtImagen']['name']:"imagen.jpg";
                
                $temImagen = $_FILES['txtImagen']['tmp_name'];
                move_uploaded_file($temImagen, "../../img/".$nameFile);

                $sentencia = $conexion->prepare("SELECT IMAGEN FROM `productos` WHERE ID=:ID");
                $sentencia->bindParam(':ID', $id);
                $sentencia->execute();
                $selectProduct = $sentencia->fetch(PDO::FETCH_LAZY);

                if(isset($selectProduct["IMAGEN"]) && ($selectProduct["IMAGEN"]!="imagen.jpg")){
                    if(file_exists("../../img/".$selectProduct["IMAGEN"])){
                        unlink("../../img/".$selectProduct["IMAGEN"]);
                    }
                }

                $sentencia = $conexion->prepare("UPDATE `productos` SET `IMAGEN`=:IMAGEN WHERE ID=:ID");
                $sentencia->bindParam(':ID', $id);
                $sentencia->bindParam(':IMAGEN', $nameFile);
                $sentencia->execute();
            };
            header("Location:products.php");
            break;
        case 'cancelar':
            header("Location:products.php");
            break;
        case 'Seleccionar':
            $sentencia = $conexion->prepare("SELECT * FROM `productos` WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->execute();
            $selectProduct = $sentencia->fetch(PDO::FETCH_LAZY);

            $id = $selectProduct['ID'];
            $name = $selectProduct['NAME'];
            $description = $selectProduct['DESCRIPTION'];
            $price = $selectProduct['PRICE'];
            $imagen = $selectProduct['IMAGEN'];

            break;
        case 'Eliminar':
            $sentencia = $conexion->prepare("SELECT IMAGEN FROM `productos` WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->execute();
            $selectProduct = $sentencia->fetch(PDO::FETCH_LAZY);

            if(isset($selectProduct["IMAGEN"]) && ($selectProduct["IMAGEN"]!="imagen.jpg")){
                if(file_exists("../../img/".$selectProduct["IMAGEN"])){
                    unlink("../../img/".$selectProduct["IMAGEN"]);
                }
            }

            $sentencia = $conexion->prepare("DELETE FROM `productos` WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->execute();
            header("Location:products.php");
            break;
        
        default:
            echo "instruccion no valida";
            break;
    };

    $sentencia = $conexion->prepare("SELECT * FROM `productos`");
    $sentencia->execute();
    $mostrarPorductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="col-md-4 mt-5">
    
    <div class="card">
        <div class="card-header">
            <h3>Agregar Producto</h3>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="id" class="form-label">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo $id; ?>" placeholder="ID" required readonly>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Nombre del producto" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $description; ?>"placeholder="Description del producto" required>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $price; ?>"placeholder="Precio del producto" required>
                </div>

                <div class="mb-3">
                    <label for="txtImagen" class="form-label">Imagen:</label>
                    
                    <?php if($imagen!=""){ ?> 
                        <img src="../../img/<?php echo $imagen;?>" width="50px" alt="imagen producto">  
                    <?php     }?>    

                    <input class="form-control" type="file" id="txtImagen" name="txtImagen" >
                </div>
                
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="crear" class="btn btn-success">Crear</button>
                    <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                    <button type="submit" name="accion" value="cancelar" class="btn btn-danger">Cancelar</button>
                </div>

            </form>

        </div> 
    </div>
</div>

<div class="col-md-7 mt-5">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($mostrarPorductos as $producto) { ?>
            
            <tr>
                <td><?php echo $producto['ID']; ?></td>
                <td><?php echo $producto['NAME']; ?></td>
                <td><?php echo $producto['DESCRIPTION']; ?></td>
                <td><?php echo $producto['PRICE']; ?></td>
                <td>
                    <img src="../../img/<?php echo $producto['IMAGEN'];?>" width="50px" alt="imagen producto">    
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo $producto['ID']; ?>">
                        <input class="btn btn-primary" type="submit" name="accion" value="Seleccionar" >
                        <br>
                        <input class="btn btn-danger" type="submit" name="accion" value="Eliminar" >
                    </form>
                </td>
            </tr>

        <?php } ?>    
        </tbody>
    </table>
    
</div>

<?php include("../template/footer.php"); ?>