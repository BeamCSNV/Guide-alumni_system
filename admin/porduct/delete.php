<?php

include('db.php');

if(isset($_POST["pid"]))
{

	$statement = $connection->prepare(
		"DELETE FROM product WHERE pid = :pid"
	);
	$resultado = $statement->execute(
		array(
			':pid'	=>	$_POST["pid"]
		)
	);
	echo $_POST["pid"];

}



?>