<?php
function get_total_registros()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM product");
	$statement->execute();
	$resultado = $statement->fetchAll();
	return $statement->rowCount();
}
include('db.php');
$query = '';
$PDdata = array();
$query .= "SELECT * FROM product ";


	if(isset($_POST["search"]["value"]))
	{
		$query .= 'WHERE pname LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR p_detail LIKE "%'.$_POST["search"]["value"].'%" ';
	}
	if(isset($_POST["order"]))
	{
		$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
	$query .= 'ORDER BY pid DESC ';
	}
	if($_POST["length"] != -1)
	{
		$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}	

// echo $query;
	$statement = $connection->prepare($query);
	$statement->execute();	
	$resultado = $statement->fetchAll();
	
	$data = array();
	$contar_rows = $statement->rowCount();
	
	foreach($resultado as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["sid"];
		$sub_array[] = $row["pt_id"];
		$sub_array[] = $row["re_id"];
		$sub_array[] = $row["pname"];
		$sub_array[] = $row["p_detail"];
		$sub_array[] = $row["qty"];
		$sub_array[] = $row["p_price"];
		$sub_array[] = '<button type="button" name="update" id="'.$row["pid"].'" class="btn btn-warning btn-xs update">Update</button>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["pid"].'" class="btn btn-danger btn-xs delete">Delete</button>';
		$data[] = $sub_array;
		
	}


	$PDdata = array(
	 	"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"		=> 	$contar_rows,
		"recordsFiltered"	=>	get_total_registros(),
		"data"				=>	$data
	);
	echo json_encode($PDdata);
