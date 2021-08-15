<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Dashboard</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <style type="text/css">
          .wrapper {
              width: 1200px;
              margin: 0 auto;
          }
      </style>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Tarea 8</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Lavadoras y camiones <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="usuarios.php">Usuarios</a>
      </li>
      
  </div>
</nav>
  </head>
  <body>
  <a href="exit.php">
            <span class="glyphicon glyphicon-off" id= "exit"></span>
        </a>
  <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
              <h2 class="text-center">Camiones</h2>
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Registros</h2>
                        <a href="add-camiones.php" class="btn btn-success pull-right">Agregar nuevo Camion</a>
                    </div>
                    <?php
                    require_once "conn.php";
                    $data = "SELECT * FROM camiones";
                    if($users = mysqli_query($conn, $data)){
                        if(mysqli_num_rows($users) > 0){
                            echo "<table class='table table-bordered table-striped'>
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Color</th>
                                        <th>Peso</th>
                                        <th>Lavadoras</th>
                                        <th>Valor</th>
                                        <th>Comentario</th>
                                      </tr>
                                    </thead>
                                    <tbody>";
                                while($user = mysqli_fetch_array($users)) {
                                    echo "<tr>
                                            <td>" . $user['ID'] . "</td>
                                            <td>" . $user['Marca'] . "</td>
                                            <td>" . $user['Modelo'] . "</td>
                                            <td>" . $user['Color'] . "</td>
                                            <td>" . $user['Peso'] . "</td>
                                            <td>" . $user['Lavadoras'] . "</td>
                                            <td>" . $user['Valor'] . "</td>
                                            <td>" . $user['Comentario'] . "</td>
                                            <td>
                                              <a href='edit-camiones.php?id=". $user['ID'] ."' title='Edit User' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                                              <a href='delete-camiones.php?id=". $user['ID'] ."' title='Delete User' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
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
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
              <h2 class="text-center">Lavadoras</h2>
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Registros</h2>
                        <a href="add-lavadoras.php" class="btn btn-success pull-right">Agregar nueva lavadora</a>
                    </div>
                    <?php

                    $data = "SELECT * FROM lavadoras";
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
                                              <a href='edit-lavadoras.php?id=". $user['ID'] ."' title='Edit User' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                                              <a href='delete-lavadoras.php?id=". $user['ID'] ."' title='Delete User' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
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

  </body>
</html>