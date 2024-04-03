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
                <h3>Modificar Juego</h3>
                <?php
                include("logica/database.php");
                $juegos = new Database();

                //Modificar :D
                if(!empty($_POST) && isset($_POST["submit"])){
                    $id = $juegos->sanitize($_POST["id"]);
                    $nombre = $juegos->sanitize($_POST['nombre']);
                    $fechalanzamiento = $juegos->sanitize($_POST['fecha']);
                    $descripcion = $juegos->sanitize($_POST['descripcion']);
                    $consola = $juegos->sanitize($_POST['consola']);

                   $res = $juegos->actualizarJuego($id, $nombre, $fechalanzamiento, $descripcion, $consola);
                   if($res){
                    $mensaje = "<div class= 'alert alert-success'>Registro actualizado</div>";
                   }else{
                    $mensaje = "<div class= 'alert alert-danger'>No se pudo actualizar el registrador</div>";
                   }
                
                   echo $mensaje;
                }

                //Eliminar
                if(!empty($_POST["id"]) && isset($_POST["delete"])){
                    $id = $juegos->sanitize($_POST["id"]);
                    $res = $juegos->eliminarJuego($id);
                    if($res){
                        $mensaje = "<div class='alert alert-success'>Registro eliminado</div>";
                    }else{
                        $mensaje = "<div class= 'alert alert-danger'>No se pudo eliminar el registro</div>";
                    }
                    echo $mensaje;
                }
                  
                //Cargar datos del juegoo:D
                  if(isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["mod"]) || isset($_GET["del"])){
                    $id = $juegos->sanitize($_GET["id"]);
                    $res = $juegos->buscarJuegos($id);
                    if($res){
                      ?>
                       <form action="modificarJuego.php" method="POST">
                            <div class="form-group">
                                <label for="id">ID Juego</label>
                                <input id="id" name="id" type="text" required="required" readonly="" class="form-control" 
                                value ="<?php echo $res->id; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" required="required" 
                                value ="<?php echo $res->nombre; ?>">
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha de lanzamiento:</label>
                                <input id="fecha" name="fecha" type="date" class="form-control" required="required" 
                                value ="<?php echo $res->fechalanzamiento; ?>">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea id="descripcion" name="descripcion" cols="40" rows="3" class="form-control" required="required"><?php echo $res->descripcion;?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="consola">Consola:</label>
                                <div>
                                    <select id="consola" name="consola" class="custom-select" required="required">
                                    <?php 
                                      $res2 = $juegos->mostrarConsolas();
                                      if(!$res){
                                      }else{
                                        while($row = mysqli_fetch_object($res2)){
                                            if($row->id == $res->consola){
                                                ?>
                                             <option value="<?php echo $row->id; ?>" selected=""><?php echo $row->nombre;?></option>
                                             <?php
                                            }else{
                                                ?>
                                                <option value= "<?php echo $row->id; ?>"><?php echo $row->nombre; ?></option>
                                                <?php
                                            }
                                         }
                                       }
                                     } 
                                    ?>
                                    </select>
                                </div>
                            </div>
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
                            <form action= "modificarJuego.php" method=  "POST">
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
                 } else {
                    echo "<div class='alert alert-danger'>Registro no encontrado</div>";
                }
            
        
            ?>
    
            </div>
        </div>
    </div>
</body>

</html>