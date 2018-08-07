<?php 
  
  require 'connect.php';

  //select user_data with tax
  $query_select = "Select * From user_data Join dep_data 
                    On user_data.id = dep_data.user_id";
  
  $result_select = $conn->query($query_select);
  $data = [];
  if($result_select->num_rows > 0) {
    $i=0;
    while($row = $result_select->fetch_assoc()) {
      $data[$i]['id'] = $row['user_id']; 
      $data[$i]['name_surname'] = $row['name'] . ' ' . $row['surname'];
      $data[$i]['ticket_id'] = $row['ticket_id'];
      $data[$i]['total_price'] = $row['total_price'];
      $data[$i]['status'] = $row['status'];
      $data[$i]['loc'] = $row['loc'];
      $data[$i]['fare_basis'] = $row['fare_basis'];
      $data[$i]['sum_tax'] = $row['sum_tax'];
      $data[$i]['without_tax'] = $row['without_tax'];
      $data[$i]['sum_penalty'] = $row['sum_penalty'];
      $data[$i]['refund'] = $row['refund'];
      
      $i++;
    }
  }

  //select tax nature  
  $get_tax_nature = "Select DISTINCT tax_nature From tax_data";
  $result_select_1 = $conn->query($get_tax_nature);
  $tax_nature = [];
  if($result_select_1->num_rows > 0) {
    $i = 0;
    while($row = $result_select_1->fetch_assoc()) {
      $tax_nature[$i]['tax_nature'] = $row['tax_nature'];
      $i++;
    }
  }

  // user and tax data
  $get_tax = "Select * From tax_data Join user_data On user_data.id = tax_data.user_id";
  $result_select_2 = $conn->query($get_tax);
  $tax = [];
  if($result_select_2->num_rows > 0) {
    $i = 0;
    while($row = $result_select_2->fetch_assoc()) {
      $tax[$i]['user_id'] = $row['user_id'];
      $tax[$i]['name_surname'] = $row['name'] . ' ' . $row['surname'];
      $tax[$i]['price'] = $row['price'];
      $tax[$i]['tax_nature'] = $row['tax_nature'];
      $tax[$i]['country_code'] = $row['country_code'];
      $tax[$i]['Refund'] = $row['Refund'];
      $i++;
    }
  }


  // user and tax data
  $get_rule = "Select * From rule_data";
  $result_select_3 = $conn->query($get_rule);
  $rule = [];
  if($result_select_3->num_rows > 0) {
    $i = 0;
    while($row = $result_select_3->fetch_assoc()) {
      $rule[$i]['rule_text'] = $row['rule_text'];
      $i++;
    }
  }

  //$conn->close();

?>