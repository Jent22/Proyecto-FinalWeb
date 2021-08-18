<?php
if(!empty($_POST))
{
    $alert='';
    if(empty($_POST['Marca'])||empty($_POST['Modelo'])||empty($_POST['Valor'])||empty($_POST['Peso'])||empty($_POST['IDcamion'])){
        $alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
    }
    else{
        include "conn.php";
        $Marca = $_POST['Marca'];
        $Modelo = $_POST['Modelo'];
        $Valor = $_POST['Valor'];
        $Peso = $_POST['Peso'];
        $IDcamion = $_POST['IDcamion'];
        $query = mysqli_query($conn,"INSERT INTO lavadoras(Marca,Modelo,Valor,Peso,IDcamion)VALUES('$Marca','$Modelo','$Valor','$Peso','$IDcamion')");
        if($query){
            $alert='<p class="msg_save">Usuario creado correctamente</p>';
        }
        else{
            $alert='<p class="msg_error">Error</p>';
        }
    }
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
                    <div class="alert"><?php echo isset($alert)?$alert:'' ?></div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Modelo</label>
                            <input type="text" name="Modelo" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label>Marca</label>
                            <input type="text" name="Marca" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label>Peso</label>
                            <input type="text" name="Peso" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label>Valor</label>
                            <input name="Valor" class="form-control">
                        </div>
                        <div class="form-group">
                            <label form="Camiones">Camion</label>
                            <?php

                            $query = mysqli_query($conn,"SELECT * FROM camiones");
                            $result = mysqli_num_rows($query);
                            

                            ?>
                            <select class="form-select" name="IDcamion" id="">
                            <?php
                            if($result>0){
                                while($IDcamion2 = mysqli_fetch_array($query_rol)){
                            ?>
                            <option value="<?php echo $IDcamion2["ID"];?>"><?php echo $IDcamion2["Marca"]?></option>
                            <?php
                            
                                }
                            }
                            ?>
                            </select>
                        </div>
                        <div class="wrapper">
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>