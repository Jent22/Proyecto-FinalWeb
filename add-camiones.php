<?php
require_once "conn.php";

$Modelo = $Color = $Comentario = $Lavadoras = $Valor = $Peso = $Marca = "";
$ModeloError = $ColorError = $ComentarioError = $LavadorasError = $ValorError = $PesoError = $MarcaError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Modelo = trim($_POST["Modelo"]);
    if (empty($Modelo)) {
        $ModeloError = "Se requiere de un Modelo.";
    } elseif (!filter_var($Modelo, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $ModeloError = "Modelo no valido.";
    } else {
        $Modelo = $Modelo;
    }

    $Color = trim($_POST["Color"]);

    if (empty($Color)) {
        $ColorError = "Color requerido.";
    } elseif (!filter_var($Color, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $ColorError = "Color no valido.";
    } else {
        $Color = $Color;
    }

    $Comentario = trim($_POST["Comentario"]);
    if (empty($Comentario)) {
        $ComentarioError = "El Comentario es requerido.";
    } elseif (!filter_var($Comentario, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $ComentarioError = "Digite un Comentario valido.";
    } else {
        $Comentario = $Comentario;
    }

    $Lavadoras = trim($_POST["Lavadoras"]);
    if(empty($Lavadoras)){
        $LavadorasError = "Lavadoras es requerida.";
    } else {
        $Lavadoras = $Lavadoras;
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
          $sql = "INSERT INTO `camiones` (`Modelo`, `Color`, `Comentario`, `Lavadoras`, `Valor`,`Peso`,`Marca`) VALUES ('$Modelo', '$Color', '$Comentario', '$Lavadoras', '$Valor','$Peso','$Marca')";
          $mas = "SELECT *
          FROM 'lavadoras'
          ORDER by ID DESC
          LIMIT 1";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
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
                        <h2>Crear registro de camion</h2>
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

                        <div class="form-group <?php echo (!empty($ColorError)) ? 'has-error' : ''; ?>">
                            <label>Color</label>
                            <input type="text" name="Color" class="form-control" value="">
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

                        <div class="form-group <?php echo (!empty($ValorError)) ? 'has-error' : ''; ?>">
                            <label>Valor</label>
                            <input name="Valor" class="form-control">
                            <span class="help-block"><?php echo $ValorError;?></span>
                        </div>
                        <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
              <h2 class="text-center">Seleccione las lavadoras a agregar</h2>
                <div class="col-md-12">
                    <?php

                    $data = "SELECT * FROM lavadoras WHERE  ";
                    if($users = mysqli_query($conn, $data)){
                        if(mysqli_num_rows($users) > 0){
                            echo "<table class='table table-bordered table-striped'>
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Valor</th>
                                        <th>Peso</th>
                                      </tr>
                                    </thead>
                                    <tbody>";
                                while($user = mysqli_fetch_array($users)) {
                                    echo "<tr>
                                            <td>" . $user['ID'] . "</td>
                                            <td>" . $user['Marca'] . "</td>
                                            <td>" . $user['Modelo'] . "</td>
                                            <td>" . $user['Valor'] . "</td>
                                            <td>" . $user['Peso'] . "</td>
                                            <td>
                                              <a href='edit.php?id=". $user['ID'] ."' title='Edit User' data-toggle='tooltip'><span class='glyphicon glyphicon-plus'></span></a>
                                            </td>
                                          </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            mysqli_free_result($users);
                        } else{
                            echo "<p class='lead'><em>No hay registros.</em></p>";
                        }
                    } else{
                        echo "ERROR: No se pudo ejecutar el $sql. " . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
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