<?php
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])){

        #if book ID is not set
        if (!isset($_GET['id'])){

            # Redirect to admin.php page
            header("Location: admin.php");
            exit;
        }

        $id = $_GET['id'];

        # Database Connnection File
        include "db_conn.php";

        # Book helper function
        include "php/func-book.php";
        $books = get_book($conn, $id);

        if ($books == 0) {

            header("Location: admin.php");
            exit;
        }

        include "php/func-category.php";
        $categories = get_all_categories($conn);

        include "php/func-author.php";
        $authors = get_all_author($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Books</title>
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
    <form action="php/edit-book.php" method="post" enctype="multipart/form-data"
            class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem;">
        <h1 class="text-center pb-5 display-4 fs-3">
            Edit Book
        </h1>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_GET['error']);?>
            </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($_GET['success']);?>
            </div>
        <?php } ?>

        <div class="mb-3">
            <label class="form-label">Book Title</label>
            <input type="text" hidden value="<?=$books['id']?>" name="book_id">
            <input type="text" class="form-control" value="<?=$books['title']?>" name="book_title">
        </div>

        <div class="mb-3">
            <label class="form-label">Book Description</label>
            <input type="text" class="form-control" value="<?=$books['description']?>" name="book_description">
        </div>

        <div class="mb-3">
            <label class="form-label">Book Author</label>
            <select class="form-control" name="book_author">
                <option value="0">
                    Select Author
                </option>
                <?php
                        if ($authors == 0) {

                        }else{
                        foreach ($authors as $author) { 
                            if ($books['author_id'] == $author['id']){
                            ?>
                    <option 
                        selected
                        value="<?=$author['id']?>">
                        <?=$author['name']?>
                    </option>
                <?php
                }else { ?>

                    <option 
                        selected
                        value="<?=$author['id']?>">
                        <?=$author['name']?>
                    </option>
            <?php
                }
                }
            } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Book Category</label>
            <select class="form-control" name="book_category">
                <option value="0">
                    Select Category
                </option>
                <?php
                if ($author == 0) {

                }else{
                    foreach ($categories as $category) { 
                        if ($books['category_id'] == $category['id']){
                        ?>
                <option 
                    selected
                    value="<?=$category['id']?>">
                    <?=$category['name']?>
                </option>
            <?php
            }else { ?>

                <option 
                    selected
                    value="<?=$category['id']?>">
                    <?=$category['name']?>
                </option>
        <?php
            }
            }
        } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Book Cover</label>
            <input type="file" class="form-control" name="book_cover">
            <input type="text" hidden value="<?=$books['cover']?>" name="current_cover">
            
            <a href="uploads/covers/<?=$books["cover"]?>" class="link-dark">Current Cover</a>
        </div>

        <div class="mb-3">
            <label class="form-label">File</label>
            <input type="file" class="form-control" name="file">
            <input type="text" hidden value="<?=$books['file']?>" name="current_file">
            <a href="uploads/files/<?=$books["file"]?>" class="link-dark">Current File</a>
        </div>

         <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
</body>
</html>

<?php 
}else{
    header("Location: login.php");
    exit;
}
?>