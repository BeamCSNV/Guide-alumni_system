<?php
include('db.php');
echo $pid = $_POST['pid'];
echo $sid = $_POST['sid'];
echo $pt_id = $_POST['pt_id'];
echo $re_id = $_POST['re_id'];
echo $pname = $_POST['pname'];
echo $p_detail = $_POST['p_detail'];
echo $qty = $_POST['qty'];
echo $p_price = $_POST['p_price'];
if(isset($_POST["operacao"]))
{
	if($_POST["operacao"] == "Add")
	{
		$statement = $connection->prepare("
		INSERT INTO product(sid, pt_id, re_id, pname, p_detail, qty, p_price) 
		VALUES(:sid, :pt_id, :re_id, :pname, :p_detail, :qty, :p_price)
		");
		
		$resultado = $statement->execute(
			array(
				':sid' => $sid,
				':pt_id' => $pt_id,
				':re_id' => $re_id,
				':pname' => $pname,
				':p_detail' => $p_detail,
				':qty' => $qty,
				':p_price' => $p_price
			)
		);
		if(!empty($resultado))
		{
			echo $resultado;
			echo 'inser sucess !';
		}
	}
	if($_POST["operacao"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE product 
			SET sid = :sid,pt_id = :pt_id,re_id = :re_id,pname = :pname,p_detail = :p_detail,qty = :qty,p_price = :p_price 
			WHERE pid  = :pid
			"
		);
		$resultado = $statement->execute(
			array(
				':pid' => $pid,
				':sid' => $sid,
				':pt_id' => $pt_id,
				':re_id' => $re_id,
				':pname' => $pname,
				':p_detail' => $p_detail,
				':qty' => $qty,
				':p_price' => $p_price
			)
		);
		if(!empty($resultado))
		{
			echo 'Update sucess';
		}
	}
}
