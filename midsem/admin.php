<?php
session_start();


if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])){

        include "db_conn.php";


        include "php/func-book.php";
        $books = get_all_books($conn);


        include "php/func-author.php";
        $authors = get_all_author($conn);

        
        include "php/func-category.php";
        $categories = get_all_categories($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link"
                    aria-current="page" href="index.php">Store</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="add-book.php">Add Book</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="add-category.php">Add Category</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="add-author.php">Add Author</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </ul>
                </div>
            </div>
        </nav>
        <form action="search.php" method="get" style= "width: 100%; max-width: 30rem;">
            <div class="input-group my-5">
                <input type="text" class="form-control" name="key" placeholder="Search Book..." aria-label="Search Book..." aria-describedby="basic-addon2">
                <button class="input-group-text btn btn-primary" id="basic-addon2"> <img src="./img/search.png" width="30"> </button>
            </div>
        </form>

        <?php

        if ($books == 0){ ?>
            <div class="alert alert-warning text-center p-5" role="alert">
            <img src="./img/emptiness.png" width="100"><br>
                There is no book in the database!
            </div>
        <?php }else {?>

        <h4 class="mt-5">All Books</h4>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach($books as $book) {
                    $i++;    
                ?>

                <tr>
                    <td><?=$i?></td>
                    <td>
                        <img width="100%" src="uploads/covers/<?=$book['cover']?>" >

                        <a class="link-dark d-block text-center" href="uploads/files/<?=$book['file']?>">
                            <?=$book['title']?>
                        </a>
                        
                    </td>

                    <td>
                        <?php
                        if ($authors == 0) {
                            echo "Undefined";}else{
                                
                                foreach ($authors as $author) {
                                    if ($author['id'] == $book['author_id']) {
                                        echo $author['name'];
                                }
                            }
                        }
                        ?></td>
                    <td><?=$book['description']?></td>
                    <td>
                    <?php
                        if ($categories == 0) {
                            echo "Undefined";}else{

                                foreach ($categories as $category) {
                                    if ($category['id'] == $book['category_id']) {
                                        echo $category['name'];
                                }
                            }
                        }
                        ?>
                    </td>

                    <td>
                        <a href="edit-book.php?id=<?=$book['id']?>" class="btn btn-warning">Edit</a>
                        <a href="php/delete-book.php?id=<?=$book['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                
                <?php } ?>
            </tbody>
        </table>
        <?php }?>

        <?php 
        if ($categories == 0) { ?>
            <div class="alert alert-warning text-center p-5" role="alert"><br>
            <img src="./img/empty.png" width="100"><br>
                There is no category in the database!
            </div>
        <?php }else {?>

        <h4 class="mt-5">All categories</h4>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>categories</th>
                    <th>Action</th>
                </tr>
            </thead>
            <thead>
                <?php
                $j = 0;
                foreach ($categories as $category) {
                    $j++;
                ?>
                <tr>
                   <td><?=$j?></td>
                   <td><?=$category['name']?></td>
                   <td>
                    <a href="edit-category.php?id=<?=$category['id']?>" class="btn btn-warning">Edit</a>
                    <a href="php/delete-category.php?id=<?=$category['id']?>" class="btn btn-danger">Delete</a>
                   </td>
                </tr>
                <?php } ?>
            </thead>
        </table>
        <?php } ?>

        <?php 
         if ($authors == 0) { ?>
           <!-- <?php if (isset($_GET['error'])) { ?>
        //     <div class="alert alert-danger" role="alert">
        //         <?= htmlspecialchars($_GET['error']);?>
        //     </div>
            <?php } ?> -->
        <?php if ($books == 0) { ?>
            <div class="alert alert-warning text-center p-5" role="alert"><br>
            <img src="./img/empty.png" width="100"><br>
                There is no author in the database!
            </div>
        <?php } ?>
        <?php }else {?>

            <!-- List of all books -->
        <h4 class="mt-5">All Authors</h4>

        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Authors Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <thead>
                <?php
                $k = 0;
                foreach ($authors as $author) {
                    $k++;
                ?>
                <tr>
                   <td><?=$k?></td>
                   <td><?=$author['name']?></td>
                   <td>
                    <a href="edit-author.php?id=<?=$author['id']?>" class="btn btn-warning">Edit</a>
                    <a href="php/delete-author.php?id=<?=$author['id']?>" class="btn btn-danger">Delete</a>
                   </td>
                </tr>
                <?php } ?>
            </thead>
        </table>
        <?php } ?>
    </div>

    <a href="#top" class="btn btn-primary">
        <img src="./img/top-arrow.png" width="40">
    </a><br>
</body>
</html>

<?php 
}else{
    header("Location: login.php");
    exit;
}
?>