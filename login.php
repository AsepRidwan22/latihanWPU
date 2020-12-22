<?php
session_start();

require 'function.php';

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, " SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

   if(mysqli_num_rows($result) === 1 ){

       $row = mysqli_fetch_assoc($result);
       if( password_verify($password, $row["password"])){
            $_SESSION["login"] = true;
            if(isset($_POST['remember'])){

                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
            }
            $level = $_SESSION['level'];
            if($level == 1){
                header("Location: index-user.php");
                exit;
            }
            if($level == 2){
                header("Location: index.php");
                exit;
            }
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <title>login</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color: red; font-style: italic">username / password salah</p>
    <?php endif; ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="username">username :</label>
            <input type="text" name="username" id="username" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">password :</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="form-check">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">remember me</label>
        </div>
            <button type="submit" name="login" class="btn btn-primary">login</button>
    </form>
</body>
</html>