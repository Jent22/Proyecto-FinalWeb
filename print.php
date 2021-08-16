<?php
 include 'conn.php';

 if ($_SERVER['REQUESST_METHOD'] == 'POST'){

    $title=$_POST['title'];
    $description =$_POST['description'];

    $file_name = $_FILES['file']['name'];

    $file_type = $_FILES['file']['type'];
 }