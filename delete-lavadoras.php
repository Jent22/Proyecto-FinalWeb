<?php
require_once "conn.php";
if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $query = "DELETE FROM lavadoras WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        header("location: dashboard.php");
    } else {
         echo "Hubo un error, intente de nuevo.";
    }


} else {
    if (empty(trim($_GET["id"]))) {
        echo "Hubo un error, intente de nuevo.";
        header("location: dashboard.php");
        exit();
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
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
                        <h1>Borrar registro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Seguro que borrara el registro?</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="dashboard.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>