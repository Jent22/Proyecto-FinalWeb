<?php
require_once "conn.php";

$Modelo = $Marca = $Valor = $Peso = $Comentario = $Lavadoras= $Color= "";
$ModeloError = $MarcaError = $ValorError = $PesoError = $ColorError= $ComentarioError= $LavadorasError= "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $Modelo = trim($_POST["Modelo"]);
    if (empty($Modelo)) {
        $ModeloError = "Se requiere de un nombre.";
    } else {
        $Modelo = $Modelo;
    }

    $Marca = trim($_POST["Marca"]);

    if (empty($Marca)) {
        $MarcaError = "Marca requerida.";
    } else {
        $Marca = $Marca;
    }

    $Valor = trim($_POST["Valor"]);
    if (empty($Valor)) {
        $ValorError = "La Valor es requerido.";
    } else {
        $Valor = $Valor;
    }

    $Peso = trim($_POST["Peso"]);
    if (empty($Peso)) {
        $ValorError = "El Peso es requerido.";
    } else {
        $Peso = $Peso;
    }
    $Color = trim($_POST["Color"]);
    if (empty($Color)) {
        $ColorError = "El Color es requerido.";
    } else {
        $Color = $Color;
    }

    $Comentario = trim($_POST["Comentario"]);
    if (empty($Comentario)) {
        $ComentarioError = "El Comentario es requerido.";
    } else {
        $Comentario = $Comentario;
    }
    $Lavadoras = trim($_POST["Lavadoras"]);
    if (empty($Lavadoras)) {
        $LavadorasError = "Las lavadoras son requeridas.";
    } else {
        $Lavadoras = $Lavadoras;
    }

   
    if (empty($ModeloError_err) && empty($MarcaError) && empty($ValorError) && empty($PesoError)&& empty($ColorError)&& empty($ComentarioError)&& empty($LavadorasError)) 
    {
          $sql = "UPDATE `camiones` SET `Modelo`= '$Modelo', `Marca`= '$Marca', `Valor`= '$Valor', `Peso`= '$Peso', `Color`= '$Color', `Comentario`= '$Comentario', `Lavadoras`= '$Lavadoras' WHERE id='$id'";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
              echo "Algo salio mal, intentelo de nuevo.";
          }

    }

    mysqli_close($conn);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM camiones WHERE id = '$id'");

        if ($user = mysqli_fetch_assoc($query)) {
            $Modelo  = $user["Modelo"];
            $Marca  = $user["Marca"];
            $Valor  = $user["Valor"];
            $Peso  = $user["Peso"];
            $Color = $user["Color"];
            $Comentario  = $user["Comentario"];
        } else {
            echo "Algo salio mal intentelo nuevamente.";
            header("location: edit-lavadoras.php");
            exit();
        }
        mysqli_close($conn);
    }  else {
        echo "Algo salio mal intentelo nuevamente.";
        header("location: edit-lavadoras.php");
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
                        <h2>Actualizar camion</h2>
                        </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="form-group <?php echo (!empty($ModeloError)) ? 'has-error' : ''; ?>">
                            <label>Modelo</label>
                            <input type="text" name="Modelo" class="form-control" value="<?php echo $Modelo; ?>">
                            <span class="help-block"><?php echo $ModeloError;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($MarcaError)) ? 'has-error' : ''; ?>">
                            <label>Marca</label>
                            <input type="text" name="Marca" class="form-control" value="<?php echo $Marca; ?>">
                            <span class="help-block"><?php echo $MarcaError;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($ValorError)) ? 'has-error' : ''; ?>">
                            <label>Valor</label>
                            <input type="text" name="Valor" class="form-control" value="<?php echo $Valor; ?>">
                            <span class="help-block"><?php echo $ValorError;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($PesoError)) ? 'has-error' : ''; ?>">
                            <label>Peso</label>
                            <input type="text" name="Peso" class="form-control" value="<?php echo $Peso; ?>">
                            <span class="help-block"><?php echo $PesoError;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($ColorError)) ? 'has-error' : ''; ?>">
                            <label>Color</label>
                            <input type="text" name="Color" class="form-control" value="<?php echo $Color; ?>">
                            <span class="help-block"><?php echo $ColorError;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($ComentarioError)) ? 'has-error' : ''; ?>">
                            <label>Comentario</label>
                            <textarea type="text" name="Comentario" class="form-control" value=""></textarea>
                            <span class="help-block"><?php echo $ComentarioError;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($LavadorasError)) ? 'has-error' : ''; ?>">
                            <label>Lavadoras</label>
                            <input type="text" name="Lavadoras" class="form-control" value="">
                            <span class="help-block"><?php echo $LavadorasError;?></span>
                        </div>


                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>