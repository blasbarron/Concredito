<?php
    require_once('../Models/logear.php');
    require_once "../conexion.php";
    $boton=$_POST['boton'];

    switch ($boton) {
        case 'cerrar':
                session_start();
                session_destroy();
            break;
        case 'ingresar':
                $usuario = $_POST['usuario'];

                $ins = new Entrar();
                $array=$ins->Identificar($usuario);
                if ($array[0]==0) 
                {
                    echo '0';
                }
                else
                {   //var_dump("entro");
                    session_start();
                    $_SESSION['cliente']=$array[0];
                    $_SESSION['jerarquia']= $array[1];
                    if($_SESSION['jerarquia'] == '0')
                    {
                        echo '1';
                    }elseif($_SESSION['jerarquia'] == '1')
                    {
                        echo '2';
                    }
                }
            break;
        default:
            break;
    }        
?>