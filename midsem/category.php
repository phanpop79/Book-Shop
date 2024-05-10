<?php 

session_start();

#If not category ID is set
        if (!isset($_GET['id'])) {
            header("Location: index.php");
            exit;
        }

        $id = $_GET['id'];

        # Database connection File
        include "db_conn.php";


        include "php/func-book.php";
        $books = get_books_by_category($conn, $id);


        include "php/func-author.php";
        $authors = get_all_author($conn);

        
        include "php/func-category.php";
        $categories = get_all_categories($conn);
        $current_category = get_category($conn, $id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$current_category['name']?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Ferdi Stationary</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active"
                    aria-current="page" href="index.php">Store</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['user_id'])) {
                        ?>
                        <a class="nav-link" href="admin.php">Admin</a>
                       <?php }else { ?>
                        <a class="nav-link" href="login.php">Login</a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <h1 class="display-4 p-3 fs-3">
            <a href="index.php" class="nd">
                <img src="./img/back-arrow.png" width="35">
                <?=$current_category['name']?>
            </a>
        </h1>
        <div class="d-flex pt-3">
            <?php if ($books == 0){ ?>
                <div class="alert alert-warning text-center p-5" role="alert">
                <img src="./img/emptiness.png" width="100"><br>
                    There is no book in the database!
                </div>
            <?php }else{ ?>
            <div class="pdf-list d-flex flex-wrap">
                <?php foreach ($books as $book) { ?>
                
                <div class="card m-1">
                    <img src="uploads/covers/<?=$book['cover']?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><i><b>By:
                            <?php foreach($authors as $author){ 
                                if ($author['id'] == $book['author_id'])
                                    {
                                        echo $author['name'];
                                        break;
                                    }
                                ?>
                            
                            <?php } ?>
                        </b></i><?=$book['title']?></h5>
                        <p class="card-text"><?=$book['description']?></p>
                        <i><b>Category:
                            <?php foreach($categories as $category){ 
                                if ($category['id'] == $book['category_id'])
                                    {
                                        echo $category['name'];
                                        break;
                                    }
                                ?>
                            
                            <?php } ?>
                        </b></i><br>
                        <a href="uploads/files/<?=$book['file']?>" class="btn btn-success">Open</a>
                        <a href="uploads/files/<?=$book['file']?>" class="btn btn-primary" download="<?=$book['title']?>">Download</a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            <div class="category">
                <!-- List of categories -->
                <div class="list-group">
                    <?php if ($categories == 0){
                        // do nothing
                    }else ?>
                    <a href="#" class="list-group-item list-group-item-action active">
                        Category
                        <?php foreach ($categories as $category) {?>
                    </a>
                    <a href="category.php?id=<?=$category['id']?>" class="list-group-item list-group-item-action">
                        <?=$category['name']?>
                    </a>
                    <?php } ?>
                </div>

                 <!-- List of authors -->
                 <div class="list-group mt-5">
                    <?php if ($authors == 0){
                        // do nothing
                    }else ?>
                    <a href="#" class="list-group-item list-group-item-action active">
                        Author
                        <?php foreach ($authors as $author) {?>
                    </a>
                    <a href="author.php?id=<?=$author['id']?>" class="list-group-item list-group-item-action">
                        <?=$author['name']?>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <a href="#top" class="btn btn-primary">
        <img src="./img/top-arrow.png" width="40">
    </a><br>
</body>
</html>