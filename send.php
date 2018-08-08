<?php
	require 'db.php'; 
	//for superviser
	$user_table = $_POST['user-table-data'];
	$tax_table = $_POST['tax-table-data'];
	$tax_list_table = $_POST['tax-list-table-data'];
	$size = $_POST['size'];

	//for saving data
	$segment = $_POST['segment'];
	$fare_val = $_POST['fare-val'];
	$tax_val = $_POST['tax-val'];
	$percentage_val = $_POST['percentage-val'];
	$number_val = $_POST['number-val'];

	$sql = "INSERT INTO save_data (segment, fare_basis, tax_nature, penalty, penalty_price) VALUES ('$segment', '$fare_val', '$tax_val', '$percentage_val', '$number_val')";
	$conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AviaAgent</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<style>
		body, html {
			padding: 0;
			margin: 0;
			font-size: 12px;
			padding-top: .5rem;
		}
		.tax-container {
			margin-bottom: 2rem;
		}
		h1 {
			margin-bottom: 1rem;
			padding-bottom: .5rem;
			border-bottom: 2px solid #000;
		}
		.btn {
			margin-bottom: 1rem;
		}
		#tax-table .ref-non-input {
		}
		.id:first-child,
		.id:name-surname,
		.id:price
		.farerule {
			border: 1px solid #000;
			padding: 2rem;
			margin: 1rem 0;
		}
		.tax-number {
			font-weight: bold;
		}
		table .difference {
			font-weight: bold;
		}
		table .penalty-tax {
			font-weight: bold;
		}
		table th,
		table td {
			padding:0.3rem 1rem!important;
		}
		table tr {
			padding: 0;
		}
		.dif {
			color: green;
		}
		.pen {
			color: red;
		}
		.dif, .pen {
			font-weight: bold;
		}
		.farerule p {
			height: 300px;
			max-width: 250px;
			overflow-y: scroll;

		}
	</style>

</head>
<body>
	<div class="user-info">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<h1>User Info</h1>
					<form>
						<table class="table table-bordered">
						<?php
							echo $user_table;
						?>
						</table>		
					</form>
				</div>
				<div class="col-md-3" id="div-tax-ist-table">
					<h1>Tax list</h1>
					<table class="table table-bordered">
						<?=$tax_list_table?>
					</table>
					<button class="btn btn-success btn-ref-non">Add</button>
				</div>
			</div>
		</div>
	</div>
		<div class="tax-list">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<h1>Tax</h1>
					<form id="tax-form">
						<table class="table table-bordered">
						<?php
							echo $tax_table;
						?>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="rule-wrapper">
		<div class="container">
			<div class="row">
				<h1 class="w-100">Rule</h1>
				<div class="col-md-12 rulee">
					<?php foreach($rule as $key => $arr):?>
					<div class="farerule d-flex flex-wrap mb-3">
						<div class="fare-text mr-3">
							<h4><?php echo $arr['fare']?></h4>	
							<p class="mr-2"><?=nl2br($arr['rule_text'])?></p>	
						</div>
						<div class="rule-wrapper">
							<table class="table table-bordered">
							<?php echo $_POST['data-table-farerule-' . $key]?>			
							</table>
						</div>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>