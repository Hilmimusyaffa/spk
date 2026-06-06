<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'");
    $d = mysqli_fetch_assoc($data);

    if($d && password_verify($password,$d['password'])){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
    }else{
        $error = "Username atau Password Salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background-image: url('logo_login.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
}

.card{
    background: rgba(255,255,255,0.9);
    border-radius: 15px;
}
</style>

</head>

<body>

<div class="container">
<div class="row justify-content-center align-items-center vh-100">
<div class="col-md-4">

<div class="card shadow">
<div class="card-header bg-primary text-white text-center">
<h4>Login Admin</h4>
</div>

<div class="card-body">

<?php if(isset($error)){ ?>
<div class="alert alert-danger"><?= $error; ?></div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-primary w-100" name="login">
Login
</button>

</form>

</div>
</div>

</div>
</div>
</div>

</body>
</html>