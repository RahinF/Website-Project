<?php
include 'condb.php';

if (!isset($_SESSION['loggedin'])){
    header('Location: index.php');
    exit;
}

   if($stmt = $con->prepare('SELECT accounts.username, stats.* FROM `accounts` LEFT JOIN `stats` ON accounts.id = stats.id WHERE accounts.id=?')){
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($username, $id, $age, $gender, $height, $weight);
    $stmt->fetch();
    $stmt->close();
    
    
   } else {
       echo 'query failed';
   }
?>


<?php $pageTitle = "Home";
include 'header.php';
?>


<a href="logout.php">Logout</a>
<a href="index.php">Index</a>

<div>
    <?php 
        echo 'Welcome '.$_SESSION['name'].'!'; 
        echo 'Welcome '.$_SESSION['id'].'!'; 
        ?>
</div>
<div>
    <h3>Stats</h3>
    <p>name: <?php echo $username; ?></p>
    <p>age: <?php echo $age; ?></p>
    <p>gender: <?php echo $gender; ?></p>
    <p>height: <?php echo $height; ?></p>
    <p>weight: <?php echo $weight; ?></p>
</div>

<form action="addstat.php" method="post">
    <input type="number" id='age' name="age" placeholder="age" required>
    <input type="number" id="height" name="height" placeholder="height" required>
    <input type="number" id="weight" name="weight" placeholder="weight" required>
    <select name="gender" id="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
    <input type="submit" value="save">
</form>

<?php 
include 'footer.php';
?>