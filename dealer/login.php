<?php include 'connect.php' ?>
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include 'logout.php';
}
$username = $password = $error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM dealer WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password']) && $row['approved'] == 1) {
            $_SESSION['dealer'] = $row['id'];
            echo '<script type="text/javascript">
                window.location = "dashboard.php"
                 </script>';
        } else {
            $error = "Wrong password or you're not approved.";
        }
    } else {
        $error = "Wrong username.";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>
        Dealer sign in
    </title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Online Watch Store</a>
        <a href="signup.php" class="ml-auto mr-3"><button class="btn btn-outline-info">Sign up</button></a>
        <a href="../user/" class="mr-3"><button class="btn btn-outline-primary">I'm a user</button></a>
        <a href="../admin/" class="mr-3"><button class="btn btn-outline-primary">Login as admin</button></a>
    </nav>
    <div class="container">
        <h2 class=" col-md-4 mx-auto mt-2 text-center">Sign-in as dealer</h2>
        <form action="" method="POST" class="col-md-8 mx-auto mt-5 px-2 py-2 border border-dark rounded">
            <span class="error"><?php echo $error; ?></span>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <input type="submit" value="Sign in" class="btn btn-primary">
        </form>
    </div>
</body>

</html>