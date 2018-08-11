<?php
	require 'db.php';


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    	
		foreach ($data as $key => $value) {
			$id = $value['id'];
			$total_price = $value['total_price'];
			
			$drop_user = "UPDATE user_data SET without_tax = $total_price, refund = $total_price
			WHERE id = '$id'";

			$conn->query($drop_user);
		}

    	if(isset($_POST['approve']) or isset($_POST['cancel'])) {

    		$agent_name = $_POST['agent_name'];
    		foreach ($data as $i => $value) {
	    		$send_data = "INSERT INTO tickets_data (name_surname, ticket_id, loc, total_price, sum_tax, without_tax, sum_penalty, refund) VALUES ('".$value['name_surname']."', '".$value['ticket_id']."', '".$value['loc']."', '".$value['total_price']."', '".$value['sum_tax']."', '".$value['without_tax']."', '".$value['sum_penalty']."', '".$value['refund']."')";	
	    		
	    		$conn->query($send_data);	


	    		$send_agent_client = "INSERT INTO agent_client (agent_name, client_name, ticket_id) VALUES ('".$agent_name."', '".$value['name_surname']."', '".$value['ticket_id']."')";	
	    		$conn->query($send_agent_client);	
    		}


    		/////////////////////////////////////////////////////////////////////////////////////
			$send_save = "INSERT INTO save_data (segment, fare_basis, country_code , penalty, penalty_price) 
						VALUES ('".$penalty[0]['segment']."',  '".$penalty[0]['fare_basis']."', '".$penalty[0]['country_code']."', '".$penalty[0]['penalty']."', '".$penalty[0]['penalty_price']."')";
			$conn->query($send_save);

			$drop_pen = "truncate penalty_data";
			$conn->query($drop_pen);

			$drop_user = "truncate user_data";
			$conn->query($drop_user);


			$drop_last = "truncate last_data";
			$conn->query($drop_last);

			$drop_tax = "truncate tax_data";
			$conn->query($drop_tax);

			$drop_rule = "truncate rule_data";
			$conn->query($drop_rule);

			header('Location:superviser_1.php');
    		exit;
    	}

    	else if(isset($_POST['edit'])) {
    		$yes = TRUE;
			header('Location:index.php');

    	}	
	}

?>