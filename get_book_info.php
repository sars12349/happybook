<?php
require_once("dbtools.inc.php");

$book_id=$_GET["book_id"];
$mode=$_GET["mode"];
$link=create_connection();

if($mode=="prev")
{
	$sql="SELECT * FROM product WHERE book_id<$book_id ORDER BY book_id DESC LIMIT 1";
	$result=excute_sql($link,"demoDB",$sql);
	$total_records=mysqli_num_rows($result);

	if($total_records==1)
	{
		$row=mysqli_fetch_assoc($result);

		echo json_encode(array("book_id"=>$row["book_id"],"image_name"=>$row["image_name"],"description"=>$row["description"]));
	}else
	{
		$sql="SELECT * FROM product WHERE book_id=(SELECT max(book_id)FROM product)";
		$result=excute_sql($link,"demoDB",$sql);
		$row=mysqli_fetch_assoc($result);
		echo json_encode(array("book_id"=>$row["book_id"],"image_name"=>$row["image_name"],"description"=>$row["description"]));
	}


}
else if($mode=="next")
{
	$sql="SELECT * FROM product WHERE book_id>$book_id ORDER BY book_id LIMIT 1";
	$result=excute_sql($link,"demoDB",$sql);
	$total_records=mysqli_num_rows($result);

	if($total_records==1)
	{
		$row=mysqli_fetch_assoc($result);

		echo json_encode(array("book_id"=>$row["book_id"],"image_name"=>$row["image_name"],"description"=>$row["description"]));
	}else
	{
		$sql="SELECT * FROM product WHERE book_id=(select min(book_id)FROM product)";
		$result=excute_sql($link,"demoDB",$sql);
		$row=mysqli_fetch_assoc($result);
		echo json_encode(array("book_id"=>$row["book_id"],"image_name"=>$row["image_name"],"description"=>$row["description"]));
	}
}

mysqli_free_result($result);
mysqli_close($link);

?>