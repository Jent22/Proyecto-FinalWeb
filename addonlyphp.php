<?php
require_once "conn.php";
$a=1;
$Modelo = $Color = $Comentario = $Valor = $Peso = $Marca = "";
$ModeloError = $ColorError = $ComentarioError = $ValorError = $PesoError = $MarcaError = "";

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

    $Valor = trim($_POST["Valor"]);
    $Valor = $Valor;
 

    $Peso = trim($_POST["Peso"]);
    $Peso = $Peso;
    

    $Marca = trim($_POST["Marca"]);
    if(empty($Marca)){
        $MarcaError = "La Marca es requerida.";
    } else {
        $Marca = $Marca;
    }
    
    if (empty($ModeloError_err) && empty($ColorError) && empty($ComentarioError) && empty($ValorError) && empty($PesoError) && empty($MarcaError)) {
          $sql = "INSERT INTO `camiones` (`Modelo`, `Color`, `Comentario`, `Valor`,`Peso`,`Marca`) VALUES ('$Modelo', '$Color', '$Comentario', '$Valor','$Peso','$Marca')";
          
          if (mysqli_query($conn, $sql)) {
            $idcamion= mysqli_insert_id($conn);
          } else {
               echo "Algo salio mal, intentelo de nuevo.";
          }
      }

}
?>
