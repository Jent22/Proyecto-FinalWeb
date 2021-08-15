<?php
require_once "conn.php";

$Usuario= $Clave = $Rol = "";
$UsuarioError = $ClaveError = $RolError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Usuario= trim($_POST["Usuario"]);
    if (empty($Usuario)) {
        $UsuarioError = "Se requiere de un Usuario.";
    } elseif (!filter_var($Usuario, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $UsuarioError = "Usuario no valido.";
    } else {
        $Usuario= $Usuario;
    }

    $Clave = trim($_POST["Clave"]);
    if (empty($Clave)) {
        $ClaveError = "Clave requerido.";
    } else {
        $Clave = $Clave;
    }

    $Rol = trim($_POST["Rol"]);
    if (empty($Rol)) {
        $RolError = "Rol requerido.";
    } else {
        $Rol = $Rol;
    }
    
    $ver = mysqli_query($conn,"SELECT * FROM usuarios WHERE Usuario = '$Usuario'");
    $res = mysqli_fetch_array($ver);
    //ERROR AQUI
    if ($res === FALSE){
        echo "El usuario ya esta en uso, intentelo de nuevo.";
    }
    else{
        if (empty($UsuarioError_err) && empty($ClaveError)) {
            $sql = "INSERT INTO `usuarios` (`Usuario`, `Clave`,`Tipo`) VALUES ('$Usuario', '$Clave','$Rol')";
  
            if (mysqli_query($conn, $sql)) {
                header("location: usuarios.php");
            } else {
                 echo "Algo salio mal, intentelo de nuevo.";
            }
        }

    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Crear usuario</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($UsuarioError)) ? 'has-error' : ''; ?>">
                            <label>Usuario</label>
                            <input type="text" name="Usuario" class="form-control" value="">
                            <span class="help-block"><?php echo $UsuarioError;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($ClaveError)) ? 'has-error' : ''; ?>">
                            <label>Clave</label>
                            <input type="password" name="Clave" class="form-control" value="">
                            <span class="help-block"><?php echo $ClaveError;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($RolError)) ? 'has-error' : ''; ?>">
                            <label>Rol</label>
                           <select name="Rol" id="Rol">
                               <option value="1">Administrador</option>
                               <option value="2">Normal</option>
                           </select>
                            <span class="help-block"><?php echo $RolError;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="usuarios.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>