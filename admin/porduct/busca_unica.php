<?php
include('db.php');
if(isset($_POST["pid"]))
{
	$PDdata = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM product 
		WHERE pid = '".$_POST["pid"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultado = $statement->fetchAll();
	
	foreach($resultado as $item)
	{
		$PDdata["pid"] = $item["pid"];
		$PDdata["sid"] = $item["sid"];
		$PDdata["pt_id"] = $item["pt_id"];
		$PDdata["re_id"] = $item["re_id"];
		$PDdata["pname"] = $item["pname"];
		$PDdata["p_detail"] = $item["p_detail"];
		$PDdata["qty"] = $item["qty"];
		$PDdata["p_price"] = $item["p_price"];

	}
	echo json_encode($PDdata);
}
?>