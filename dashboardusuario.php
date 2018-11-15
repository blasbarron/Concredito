<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();
if(!isset($_SESSION['cliente']) or $_SESSION['jerarquia'] == 0)
{
    echo "
    <script>
        window.location='index.php';
    </script>
    ";
}
else
{   
    $id_cliente = $_SESSION['cliente'];
    require "conexion.php";   
    require "funciones.php";  
    //Perfil 
    $Consulta = $Conexion ->query("
        SELECT  username as nombre1 FROM web_usuarios where id_usuario =$id_cliente;
    ");
    //Solicitud de Usuario 
    $Consulta2 = $Conexion ->query("
        SELECT wu.username as nombre,ws.id_solicitud as id_solicitud,ws.comentarios as comentarios,ws.plazo as plazo,ws.monto as monto,ws.fecha_solicitud as fecha
    FROM web_usuarios wu
    LEFT JOIN web_solicitudes ws
    ON wu.id_usuario = ws.id_usuario
        where wu.id_usuario =$id_cliente AND ws.id_status = 0;
    ");
    //Historial
    $Consulta3 = $Conexion ->query("SELECT wu.username as nombre,ws.id_solicitud as id_solicitud,ws.comentarios as comentarios,i.valor as plazo,ws.monto as monto,ws.fecha as fecha
            FROM web_usuarios wu
            LEFT JOIN web_solicitudes ws
            ON wu.id_usuario = ws.id_usuario
            INNER JOIN interes i
                ON ws.plazo = i.id 
            WHERE wu.id_usuario =$id_cliente AND ws.id_status = 1 AND comentarios IS NOT NULL;
    ");
    //Solicitudes de otros usuarios
    $Consultas4 = $Conexion ->query("
        SELECT wu.id_usuario as idUsuario,wu.username as nombre,ws.id_solicitud as id_solicitud,ws.plazo as plazo,ws.monto as monto,h.comentarios as comentarios,ws.fecha_solicitud as fecha
    FROM web_usuarios wu
    LEFT JOIN web_solicitudes ws
    ON wu.id_usuario = ws.id_usuario
    LEFT JOIN historial h
    ON h.id_usuario = ws.id_usuario
        where wu.id_usuario != $id_cliente AND ws.id_status = 0;
    ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Concredito</title>
    <link rel="icon" type="img/png" href="img/ico.ico" />

    <link href="diseno/css/bootstrap.min.css" rel="stylesheet">
    <link href="diseno/css/grayscale.css" rel="stylesheet">
    <link href="diseno/css/default.css" rel="stylesheet">
    <link href="diseno/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="diseno/Tablas/jquery.dataTables.css">

    <script src="diseno/js/jquery.js"></script>
</head>
<body>
    <?php include "app/menu.php"; ?>
    <!-- CONTAINER -->
    <div class="container content-section">
        <div class="row"> 
            <div class="col-md-4">
                <h3>Perfil</h3>
                <table id="tabla1" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    while($Fila = $Consulta->fetch_assoc())
                    {
                        $nombre = $Fila['nombre1'];
                        ?>
                        <tr>
                            <td><?php echo $nombre;?></td>
                        </tr>

                        <?php
                    }
                    ?>
                    </tbody>
                </table >
                    <h3>Solicitud</h3>
                <table id="tabla2" class="table table-hover">
                    <thead>
                            <th>Solicitud</th>
                            <th>Plazo</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                    </thead>
                    <tbody>
                    <?php  
                    while($Fila = $Consulta2->fetch_assoc())
                    {
                        $id_solicitud = $Fila['id_solicitud'];
                        $plazo = $Fila['plazo'];
                        $monto = $Fila['monto'];
                        $fecha = $Fila['fecha'];
                        //$fechaFormato = date("Y-m-d",$fecha);
                        ?>
                        <tr>
                            <td><?php echo $id_solicitud;?></td>
                            <td><?php echo $plazo; ?></td>
                            <td><?php echo $monto; ?></td>
                            <td><?php echo $fecha; ?></td>
                        </tr>

                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        <div class="col-md-4">
                <h3>Historial</h3>
                <table id="tabla3" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Solicitud</th>
                            <th>Plazo</th>
                            <th>Monto</th>
                            <th>Comentarios</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    while($Fila = $Consulta3->fetch_assoc())
                    {
                        $id_solicitud = $Fila['id_solicitud'];
                        $plazo = $Fila['plazo'];
                        $monto = $Fila['monto'];
                        $comentarios = $Fila['comentarios'];
                        $fecha = $Fila['fecha'];
                        //$fechaFormato = date("Y-m-d",$fecha);
                        ?>
                        <?php 
                        //Se asigna el color al tr dependiendo de si esta autorizada o rechazada la solicitud
                        if ($comentarios == 'aceptada') {
                            echo '<tr style="background-color: green;color: white;"><td>'.$id_solicitud.'</td><td>'.$plazo.'</td><td>'.$monto.'</td><td>'.$comentarios.'</td><td>'.$fecha.'</td></tr>';
                        }
                        if ($comentarios == 'rechazada') {
                            echo '<tr style="background-color: red;color: white;"><td>'.$id_solicitud.'</td><td>'.$plazo.'</td><td>'.$monto.'</td><td>'.$comentarios.'</td><td>'.$fecha.'</td></tr>';
                        } 
                    }
                    ?>
                    </tbody>
                </table>
                <td><button type="button" class="btn btn-primary pull-right mbot" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i>
                    Nueva Solicitud
                </button></td>
            </div> 
            <div class="col-md-4">
                <h3>Solicitudes</h3>
                <table id="tabla4" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Solicitud</th>
                            <th>Plazo</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    while($Fila = $Consultas4->fetch_assoc())
                    {   
                        $id_usuario= $Fila['idUsuario'];
                        $comentarios = $Fila['comentarios'];
                        $nombre = $Fila['nombre'];
                        $id_solicitud = $Fila['id_solicitud'];
                        $plazo = $Fila['plazo'];
                        $monto = $Fila['monto'];
                        $fecha = $Fila['fecha'];
                        echo '<input type="hidden" id="usuario" value='.$id_usuario.'>';
                        echo '<input type="hidden" id="solicitud" value='.$id_solicitud.'>';
                        ?>
                        <tr>
                            <?php 
                            if ($comentarios == '') {
                                echo '<td data-toggle="popover" data-container="body" data-placement="top" title="'.$nombre.'" data-content="No tiene solicitudes Votadas '.$comentarios.'">'.$id_solicitud.'</td>';
                            }
                            if ($comentarios != '') {
                                echo '<td data-toggle="popover" data-container="body" data-placement="top" title="'.$nombre.'" data-content="Ultima solicitud '.$comentarios.'">'.$id_solicitud.'</td>';
                            }
                            ?>
                            <td><?php echo $plazo; ?></td>
                            <td><?php echo $monto; ?></td>
                            <td><?php echo $fecha; ?></td>
                            <td></td>
                            <td><button type="button" onclick="aceptar()" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i></button><button type="button" value="rechazar" onclick="rechazar()" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-plus"></i></button></td>
                        </tr>

                        <?php
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Solicitud</h5>
          </div>
          <form id="form_edit">
          <div class="modal-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="col-sm-3" style="padding-top: 6px;">Monto:</div>
                        <div class="col-sm-9">
                            <input class="form-control input-sm" id="monto" name="monto" type="text" placeholder="Monto" required="required">
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-sm-3" style="padding-top: 6px;">Plazo:</div>
                        <div class="col-sm-9">
                            <select id="plazo" name="plazo" class="form-control input-sm">
                            <?php
                                require "conexion.php"; 
                               $Consulta = $Conexion ->query("SELECT * FROM interes");
                              while($Fila = $Consulta->fetch_assoc())
                              echo "<option value=".$Fila['id'].">".$Fila['id']."</option>";
                          ?>
                          </select>
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-sm-3" style="padding-top: 6px;">Total:</div>
                        <div id="Total" class="col-sm-9">
                        </div>
                </div>
                <div style="padding-left: 73px;padding-bottom: 31px;padding-top: 61px;">
                  <button type="summit" class="btn btn-success">Calcular</button>  
                </div>
          </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button onclick="registrar()" class="btn btn-primary">Registrar</button>
          </div>
        
        </div>
      </div>
    </div>
    <script type="text/javascript" src="diseno/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="diseno/js/jquery.min.js"></script>
    <script type="text/javascript" src="diseno/js/concredito.js"></script>
    <script type="text/javascript" src="diseno/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="diseno/js/bootstrap.bundle.min.js"></script>
    
    <script type="text/javascript" language="javascript" src="diseno/Tablas/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="diseno/Tablas/dataTables.bootstrap.min.js"></script>

</body>
</html>
<?php  
}
?>
