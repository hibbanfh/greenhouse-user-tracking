<?php 
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <a href="#" class="navbar-brand">Monitoring User</a>
    <ul class="navbar-nav w-100">
        <li class="nav-item"><a href="index.php" class="nav-link">Beranda</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Perihal</a></li>
    </ul>
    <ul class="navbar-nav w-100 justify-content-end">
        <li class="nav-item justify-content-end mr-5"><a href="login.php" class="nav-link">Masuk</a></li>
    </ul>
</nav>

<div class="container mt-5">
    <div class="row">
        <?php if(isset($_GET['error'])) {?>
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissable show fade" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                Login Gagal! Username atau Password Salah
            </div>
        </div>
        <?php }?>
        <div class="col-md-6">    
            <form action="query/cek_login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" placeholder="Username"/>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Password"/>
                </div>
                <div class="col-md-4">
                <input type="submit" class="btn btn-success btn-block" name="login" value="Masuk">    
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

</body>

</html>
