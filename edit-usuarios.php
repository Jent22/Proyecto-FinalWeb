<?php
require_once "conn.php";

$Usuario = $Clave = $Rol = "";
$UsuarioError = $ClaveError = $RolError = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $Usuario = trim($_POST["Usuario"]);
    if (empty($Usuario)) {
        $UsuarioError = "Se requiere de un nombre.";
    } else {
        $Usuario = $Usuario;
    }

    $Clave = trim($_POST["Clave"]);

    if (empty($Clave)) {
        $ClaveError = "Clave requerida.";
    } else {
        $Clave = $Clave;
    }

    $Rol = trim($_POST["Rol"]);
    if (empty($Rol)) {
        $RolError = "La Rol es requerido.";
    } else {
        $Rol = $Rol;
    }

   
    if (empty($UsuarioError_err) && empty($ClaveError) && empty($RolError) ) 
    {
          $sql = "UPDATE `usuarios` SET `Usuario`= '$Usuario', `Clave`= '$Clave', `Tipo`= '$Rol' WHERE id='$id'";

          if (mysqli_query($conn, $sql)) {
              header("location: usuarios.php");
          } else {
              echo "Algo salio mal, intentelo de nuevo.";
          }

    }

    mysqli_close($conn);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = '$id'");

        if ($user = mysqli_fetch_assoc($query)) {
            $Usuario  = $user["Usuario"];
            $Clave  = $user["Clave"];
            $Rol  = $user["Tipo"];
        } else {
            echo "Algo salio mal intentelo nuevamente.";
            header("location: edit-usuarios.php");
            exit();
        }
        mysqli_close($conn);
    }  else {
        echo "Algo salio mal intentelo nuevamente.";
        header("location: edit-usuarios.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar registro</title>
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
                        <h2>Actualizar usuario</h2>
                        </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="form-group <?php echo (!empty($UsuarioError)) ? 'has-error' : ''; ?>">
                            <label>Usuario</label>
                            <input type="text" name="Usuario" class="form-control" value="<?php echo $Usuario; ?>">
                            <span class="help-block"><?php echo $UsuarioError;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($ClaveError)) ? 'has-error' : ''; ?>">
                            <label>Clave</label>
                            <input type="password" name="Clave" class="form-control" value="<?php echo $Clave; ?>">
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