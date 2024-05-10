<?php
session_start();


if (!isset($_SESSION['user_id']) &&
    !isset($_SESSION['user_email'])){

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferdi Stationary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="d-flex justify-content-center align-item-center" style= "min-height: -100vh;">
        <form class="p-5 round shadow" style="max-width: 30rem; width: 100%" method="POST" action="php/auth.php">

            <h1 class="text-center display-4 pb-5">LOGIN</h1>
            <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_GET['error']);?>
            </div>
            <?php } ?>
            
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="index.php">Store</a>
        </form>
    </div>
</body>
</html>

<?php 
}else{
    header("Location: admin.php");
    exit;
}
?>