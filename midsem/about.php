<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferdi Stationary</title>
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
                        <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['user_id'])) {
                                ?>
                            <a class="nav-link" href="admin.php">Admin</a>
                            <?php }else { ?>
                            <a class="nav-link" href="login.php">Login</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <h1><b>About Ferdi Stationary</b></h1>
        <br>

        <p>The Ferdi Stationary is the custodian of South Africa’s collective programming materials in the country. The Ferdi Stationary is mandated by the National Library of South Africa Act 92 of 1998 to collect and preserve published documents and make them accessible to all; ensuring that knowledge is not lost to posterity.

The Ferdi Stationary, as we know it today, was formed on
1 November 1999. The Ferdi Stationary was formed by Ferdinand Annan Sackey from Takoradi. He was a student of Takoradi Technical University (TTU).

The Ferdi Stationary has two core programmes which are Business Development and Public Engagement.
<br>
 <br>
<br>
The Business Development Programme is responsible for the following sub-programmes: Bibliographic Services and Collections Management and Preservation and Conservation Services.
<br>
The Public Engagement Programme is responsible for the following sub-programmes: Information Access Services and Centre for the Book. <br>Information Access Services promotes and facilitates information access to the collection. Centre for the Book, the Ferdi Stationary’s outreach unit promotes the culture of reading, writing and publishing.
<br>
The collections of the Ferdi Stationary contain a wealth of information, including rare manuscripts, books published in South Africa, periodicals, government publications, official foreign publications, maps, technical reports, Africana, Programming and newspapers.
</p>
    </div>
</body>
</html>