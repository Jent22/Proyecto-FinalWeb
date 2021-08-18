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
                        <input type="submit" class="btn btn-primary" value="Agregar registro">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>