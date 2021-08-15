<?php
$mensaje = '';
session_start();
if(!empty($_SESSION['active'])){header('location: /index');}
else{
    if(!empty($_POST))
    {

        if(empty($_POST['usuario'])||(empty($_POST['clave']))){
            $mensaje = "Llene ambos campos";
        }
        else{
            require_once "conn.php";
            $usuario =$_POST['usuario'];
            $clave =$_POST['clave'];

            $query = mysqli_query($conn,"SELECT * FROM usuarios WHERE Usuario= '$usuario' AND Clave= '$clave'");
            $num = mysqli_num_rows($query);

            if($num > 0){
                $data = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['ID'];
                $_SESSION['user'] = $data['Usuario'];
                $_SESSION['rol'] = $data ['Tipo'];
                header('location: /index');

            }

            else{
                $mensaje = "Ingrese el usuario y clave correctas";
                session_destroy();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style type="text/css">
    .wrapper {
              width: 1200px;
              margin: 0 auto;
          }
      </style>
      <link rel="stylesheet" type="text/css" href="style.css">
      <title>Login</title>
      
</head>
<body>
    
  <div class="wrapper">
    <div class="container-fluid">
        <section id="container">
            <form action="" method="post">
                <h3>Iniciar Sesion</h3>
                <img src="Recursos/loginimg.png" alt="Login">
                <input type="text" name="usuario" placeholder="Usuario">
                <input type="password" name="clave" placeholder="Clave">
                <div class="mensaje"><?php echo isset($mensaje) ? $mensaje: ''; ?></div>
                <input type="submit" value="Entrar">
            </form>
        </section>
    </div>
</div>
</body>
</html>