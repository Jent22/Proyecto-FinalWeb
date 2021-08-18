<?php

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    require_once "conn.php";
    require_once "FPDF/fpdf.php";
    $id = $_POST["id"];

    $query = "SELECT * FROM camiones WHERE id = '$id'";
    $a = mysqli_query($conn, $query);
    if (mysqli_query($conn, $query)) {
      $pdf = new FPDF('p','mm','a4' );
      $pdf->SetFont('arial','b','14');
      $pdf->AddPage();
      // $pdf->cell('40','10','ID','1','0','C');
      // $pdf->cell('40','10','Modelo','1','0','C');
      // $pdf->cell('40','10','Marca','1','0','C');
      // $pdf->cell('40','10','Color','1','0','C');
      // $pdf->cell('40','10','Comentario','1','0','C');
      // $pdf->cell('40','10','Lavadoras','1','0','C');
      // $pdf->cell('40','10','Valor','1','0','C');
      // $pdf->cell('40','10','Peso','1','0','C');
      
      
      $row = mysqli_fetch_array($a);
         $pdf->cell('40','10',$row['ID'],'1','0','C');
         $pdf->cell('40','10',$row['Modelo'],'1','0','C');
         $pdf->cell('40','10',$row['Marca'],'1','0','C');
         $pdf->cell('40','10',$row['Color'],'1','0','C');
         $pdf->cell('40','10',$row['Comentario'],'1','0','C');
         $pdf->cell('40','10',$row['Lavadoras'],'1','0','C');
         $pdf->cell('40','10',$row['Valor'],'1','0','C');
         $pdf->cell('40','10',$row['Peso'],'1','0','C');
       
       $pdf->Output();
    } else {
         echo "Hubo un error, intente de nuevo.";
    }

    mysqli_close($conn);
} else {
    if (empty(trim($_GET["id"]))) {
        echo "Hubo un error, intente de nuevo.";
        header("location: index.php");
        exit();
    }
}
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
                        <h1>Imprimir registro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Seguro que imprimira el registro?</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-success">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
