<?php
require_once "conn.php";

$Modelo  = $Valor = $Peso = $Marca = "";
$ModeloError = $ValorError = $PesoError = $MarcaError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Modelo = trim($_POST["Modelo"]);
    if (empty($Modelo)) {
        $ModeloError = "Se requiere de un Modelo.";
    } elseif (!filter_var($Modelo, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $ModeloError = "Modelo no valido.";
    } else {
        $Modelo = $Modelo;
    }

    $Valor = trim($_POST["Valor"]);
    if(empty($Valor)){
        $ValorError = "El Valor es requerido.";
    } else {
        $Valor = $Valor;
    }

    $Peso = trim($_POST["Peso"]);
    if(empty($Peso)){
        $PesoError = "El Peso es requerido.";
    } else {
        $Peso = $Peso;
    }

    $Marca = trim($_POST["Marca"]);
    if(empty($Peso)){
        $PesoError = "La Marca es requerida.";
    } else {
        $Marca = $Marca;
    }
    
    if (empty($ModeloError_err) && empty($ColorError) && empty($ComentarioError) && empty($ValorError) && empty($LavadorasError) && empty($PesoError) && empty($MarcaError)) {
          $sql = "INSERT INTO `lavadoras` (`Modelo`,`Valor`,`Peso`,`Marca`) VALUES ('$Modelo','$Valor','$Peso','$Marca')";

          if (mysqli_query($conn, $sql)) {
              header("location: dashboard.php");
          } else {
               echo "Algo salio mal, intentelo de nuevo.";
          }
      }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear producto</title>
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
                        <h2>Crear registro de lavadoras</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($ModeloError)) ? 'has-error' : ''; ?>">
                            <label>Modelo</label>
                            <input type="text" name="Modelo" class="form-control" value="">
                            <span class="help-block"><?php echo $ModeloError;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($MarcaError)) ? 'has-error' : ''; ?>">
                            <label>Marca</label>
                            <input type="text" name="Marca" class="form-control" value="">
                            <span class="help-block"><?php echo $MarcaError;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($PesoError)) ? 'has-error' : ''; ?>">
                            <label>Peso</label>
                            <input type="text" name="Peso" class="form-control" value="">
                            <span class="help-block"><?php echo $PesoError;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($ValorError)) ? 'has-error' : ''; ?>">
                            <label>Valor</label>
                            <input name="Valor" class="form-control">
                            <span class="help-block"><?php echo $ValorError;?></span>
                        </div>
                        <div class="wrapper">
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="dashboard.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>