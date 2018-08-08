<?php
require 'connect.php';
//require 'db.php';
$count = 0;
foreach ($_POST as $key => $value) {
	$sql = "UPDATE tax_data Set Refund='$value' WHERE id='$count'";
	$conn->query($sql);
	$count++;
}

$get_tax_price = "SELECT tax_data.user_id, SUM(tax_data.price) as sum_tax FROM `tax_data` 
				  WHERE tax_data.Refund = 'non-refundable' GROUP BY tax_data.user_id";

$result_tax_price = $conn->query($get_tax_price);

$data = [];
if($result_tax_price->num_rows > 0) {
    $i=0;
    while($row = $result_tax_price->fetch_assoc()) {
      $data[$i]['user_id'] = $row['user_id'];	
      $data[$i]['sum_tax'] = $row['sum_tax']; 
      $i++;
      echo($row['user_id'] . "-"); 
      echo($row['sum_tax'] . "-");
    }
  }
?>
