<?php
	require 'connect.php';

	$get_client_ticket = "SELECT * FROM agent JOIN agent_client on agent_client.agent_name = agent.username JOIN tickets_data ON agent_client.ticket_id = tickets_data.ticket_id";
	$result_select_agent = $conn->query($get_client_ticket);
	
	$agent = [];

	if($result_select_agent->num_rows > 0) {
	    $i = 0;
	    while($row = $result_select_agent->fetch_assoc()) {
	      $agent[$i]['agent_id'] = $row['agent_id'];
	      $agent[$i]['username'] = $row['username'];
	      $agent[$i]['client_name'] = $row['client_name'];
	      $agent[$i]['total_price'] = $row['total_price'];
	      $agent[$i]['sum_tax'] = $row['sum_tax'];
	      $agent[$i]['sum_penalty'] = $row['sum_penalty'];
	      $agent[$i]['refund'] = $row['refund'];
	      $agent[$i]['ticket_id'] = $row['ticket_id'];
	      $i++;
	    }
	}

	$get_agent = "SELECT * FROM agent";
	$result_select_agent_1 = $conn->query($get_agent);
	
	$agent_1 = [];

	if($result_select_agent_1->num_rows > 0) {
	    $i = 0;
	    while($row = $result_select_agent_1->fetch_assoc()) {
	      $agent_1[$i]['agent_id'] = $row['agent_id'];
	      $agent_1[$i]['username'] = $row['username'];
	      $i++;
	    }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AviaAgent</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	
</head>
<body>
	<header class="mb-5">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<img src="img/logo.png" alt="choco logo">		
			</div>
		</div>
	</header>
	<div class="ticket-result">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<ul class="nav nav-tabs" id="myTab_1" role="tablist">	
						<?php foreach ($agent_1 as $key => $value):?>
							<li class="nav-item">
						    	<a class="nav-link" id="tab-<?=$value['agent_id']?>-tab" data-toggle="tab" href="#tab-<?=$value['agent_id']?>" role="tab" aria-controls="tab-<?=$value['agent_id']?>" aria-selected="true"><?=$value['username']?></a>
						  	</li>
						<?php endforeach;?>
					</ul>

					<div class="tab-content" id="myTabContent">
						<?php foreach ($agent_1 as $key_1 => $value_1):?>		
						  <div class="tab-pane fade show" id="tab-<?=$value_1['agent_id']?>" role="tabpanel" aria-labelledby="tab-<?=$value_1['agent_id']?>-tab">
						  	<table class="table">
						  		<tr>
						  			<th>Client's name</th>
						  			<th>Id_ticket</th>
						  			<th>Ticket price</th>
						  			<th>Sum tax</th>
						  			<th>Sum penalty</th>
						  			<th>Refund price</th>
						  		</tr>
						  	<?php foreach($agent as $key => $value):?>
						  				<?php if($value['agent_id'] == $value_1['agent_id']):?>
						  				<tr>
						  					<td><?=$value['client_name']?></td>
						  					<td><?=$value['ticket_id']?></td>
						  					<td><?=$value['total_price']?></td>
						  					<td><?=$value['sum_tax']?></td>
						  					<td><?=$value['sum_penalty']?></td>
						  					<td><?=$value['refund']?></td>
						  			
						  				</tr>
						  				<?php endif;?>
						  	<?php endforeach;?>
						  	</table>
						  </div>
						<?php endforeach;?>
					</div>
				</div>
				<div class="col-md-10">
					<a href="superviser.php"><input type="button" value="Back" class="btn btn-blue"></a>
				</div>		
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="js/main.js"></script>
	
</body>
</html>