<?php
include 'condb.php';

// see if acc exists
if ($stmt = $con->prepare('SELECT id FROM stats WHERE id = ?')){
	$stmt->bind_param('i', $_SESSION['id']);
	$stmt->execute();
    $stmt->store_result();
    
    echo $_SESSION['id'];
	echo $stmt->num_rows;
    // if acc stats exist; update stats of that acc
	if ($stmt->num_rows > 0){
		if($stmt = $con->prepare('UPDATE stats SET age=?, gender=?, height=?, weight=? WHERE id=?')){
            $stmt->bind_param('isiii', $_POST['age'],$_POST['gender'], $_POST['height'], $_POST['weight'], $_SESSION['id']);
            $stmt->execute();
           header('Location: home.php');  
        }
	} else {
        // if no stats are exist; create from user input
		$stmt = $con->prepare('INSERT INTO stats (id, age, gender, height, weight) VALUES (?,?,?,?,?)');
            $stmt->bind_param('iisii', $_SESSION['id'], $_POST['age'], $_POST['gender'], $_POST['height'], $_POST['weight']);
            $stmt->execute();
           header('Location: home.php');
       
        
	}
	$stmt->close();
}
?>