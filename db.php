<?php 
  
  require 'connect.php';

  //select user_data with tax
  $query_select = "Select * From user_data Join tax_data 
                    On user_data.id = tax_data.id
                    Join dep_data On user_data.id = dep_data.id";
  
  $result_select = $conn->query($query_select);
  $data = [];
  if($result_select->num_rows > 0) {
    $i=0;
    while($row = $result_select->fetch_assoc()) {
      $data[$i]['id'] = $row['id']; 
      $data[$i]['name_surname'] = $row['name'] . ' ' . $row['surname'];
      $data[$i]['total_price'] = $row['total_price'];
      $data[$i]['ticket_id'] = $row['ticket_id'];
      $data[$i]['tax_price'] = $row['price'];
      $data[$i]['tax_nature'] = $row['tax_nature'];
      $data[$i]['tax_type'] = $row['tax_type'];
      $data[$i]['status'] = $row['status'];
      $data[$i]['segment'] = $row['from_loc'] . " " . $row['to_loc'];
      $i++;
    }
  }

  //sum each person tax
  $query_select_1 = "Select user_data.id, SUM(price) as sum_tax From user_data  
                    Join tax_data On user_data.id = tax_data.id
                    Group By user_data.id";
  $result_select_1 = $conn->query($query_select_1);
  $sum_tax = [];
  if($result_select_1->num_rows > 0) {
    $i=0;
    while($row = $result_select_1->fetch_assoc()) {
      $sum_tax[$i]['id'] = $row['id'];
      $sum_tax[$i]['sum_tax'] = $row['sum_tax'];
      $i++;
    }
  }

  $user_data = [];
  
  $conn->close();

?>