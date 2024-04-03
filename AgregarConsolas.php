<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <?php include("menu/admin.html"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Nueva Consola</h3>
                <?php
                include ("logica/database.php");
                $consolas= new Database();
                if(isset($_POST)&& ! empty($_POST)){
                    $id = $consolas->sanitize($_POST['id']);
                    $nombre = $consolas->sanitize($_POST['nombre']);
                    $fechalanzamiento = $consolas->sanitize($_POST['fecha']);
                    $descripcion = $consolas->sanitize($_POST['descripcion']);

                    $res = $consolas->insertarConsolas($id, $nombre, $fechalanzamiento, $descripcion);
                    if($res){
                        $mensaje = "'<div class='alert alert-success'>Registro guardado</div>";
                    }else{
                        $mensaje = "'<div class= 'alert alert-danger'>No se pudo guardar el registro</div>";
                    }
                    echo $mensaje;
            }
                ?>
                <form action="agregarConsolas.php" method="POST">
                    <div class="form-group">
                        <label for="id">ID consolas</label>
                        <input id="id" name="id" type="text" required="required" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" cols="40" rows="3" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha de lanzamiento:</label>
                        <input id="fecha" name="fecha" type="date" class="form-control" required="required">
                    </div>
    
                        </div>
                    </div>
                    <div class="form-group">
                        <button name="submit" type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                <div class="form-group">
                                <?php
                                 if (isset($_GET["mod"])){
                                    ?>
                                     <button name="submit" type="submit" class="btn btn-primary">Modificar</button>
                                    <?php
                                 }
                                ?>
                            </div>
                        </form>
                         <?php
                         if ((isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["mod"])) || isset($_GET["del"])){
                            ?>
                            <form action= "modificarConsolas.php" method=  "POST">
                            <div class="form-group">
                            <input id= "id" name= "id" type= "text" required= "required" readonly= "" class= "form-control"
                                value= "<?php echo $res->id; ?>" hidden="">
                                <button name= "delete" type= "submit" class= "btn btn-danger">Eliminar</button>
                            </div>
                        </form>
                        <?php
                         }
                        ?>
                    <?php
                ?>
            </div>
        </div>
    </div>
</body>

</html>