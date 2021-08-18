<?php
require_once "addonlyphp.php";
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

                        <div class="form-group <?php echo (!empty($ValorError)) ? 'has-error' : ''; ?>">
                            <label>Valor</label>
                            <input name="Valor" class="form-control">
                            <span class="help-block"><?php echo $ValorError;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($PesoError)) ? 'has-error' : ''; ?>">
                            <label>Peso</label>
                            <input name="Peso" class="form-control">
                            <span class="help-block"><?php echo $PesoError;?></span>
                        </div>
                        
                        <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
              <h2 class="text-center">Seleccione las lavadoras a agregar</h2>
                <div class="col-md-12">
                    <?php
                     $rowSQL = mysqli_query( $conn,"SELECT MAX( ID ) AS max FROM `camiones`;" );
                     if (mysqli_query($conn, $sql)) {
                        $last_id = mysqli_insert_id($conn);
                    }
                    //  $row = mysqli_fetch_array( $rowSQL );
                    //  $LastID = $row['max'];
                    // $idcamion=($LastID+1);
                    require_once "addonlyphp.php";
                    $data = "SELECT * FROM lavadoras WHERE ID = $idcamion";
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