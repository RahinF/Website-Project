<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?></title>
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ac5a47f042.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav>
            <h1>logo</h1>
            <ul>
                <li><a href="index.php">Index</a></li>
                <li>link</li>
                <li>link</li>
                <li>link</li>
            </ul>

            <div>
                <?php
                // if the user is logged in
                if(isset($_SESSION['loggedin'])) {
                ?>
                <a href="home.php">Home</a>
                <a href="logout.php">Logout</a>
                <?php
                } 
                else {
                // if the user is not logged in
                ?>
                <a href="login.php"><button>login</button></a>
                <a href="register.php"><button>register</button></a>
                <?php
                }?>
            </div>
        </nav>
    </header>