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

	$yes = false;

	if($percentage_val != '' || $tax_val != '' || $number_val != ''){
		$sql = "INSERT INTO save_data (segment, fare_basis, country_code , penalty, penalty_price) VALUES ('$segment', '$fare_val', '$tax_val', '$percentage_val', '$number_val')";
		$conn->query($sql);	
	}
	else {
		$yes = true;
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AviaAgent</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="style.css"> -->
	<style>
		body, html {
			padding: 0;
			margin: 0;
			font-size: 12px;
			padding-top: .5rem;
			background: url(img/background.jpg) repeat-y center 0;
			color: #212c5b;
		}
		h1 {
			margin-bottom: 1rem;
			padding-bottom: .5rem;
			color: #212c5b;
		}
		.yes {
			display: none;
		}
		.btn {
			margin-bottom: 1rem;
		}
		.btn-orange {
			background: #fe9922;
			color: #fff;
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
			color: #353535;
			border-color: #9ea3b7!important;
		}
		table tr {
			padding: 0;
		}
		#tax-table .ref-non-input {
			display: none;
		}
		.td-remove {
			display: none;
			border: none!important;
		}
		.table-farerule td {
			padding: 0!important;
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
		form .input-result-wrapper {
			display: none;
		}
	</style>
	
</head>
<body>
	<header>
		<img src="img/logo.png" alt="choco logo" class="d-block mx-auto">
	</header>
	<p class="yes"><?=$yes?></p>
	<div class="user-info">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>User Info</h1>
					<form>
						<table class="table" id="user-table">
							<?=$user_table?>
						</table>		
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="tax-list">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Tax</h1>
					<form id="tax-form">
						<table class="table table-bordered" id="tax-table">
							<?=$tax_table?>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="rule-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="w-100">Rule</h1>
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
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<form action="send.php" id="send_form" method="POST">
						<div class="w-100">
							<div class="input-result-wrapper">
								<input type="text" class="" name="segment" value="<?=$data[0]['loc']?>" >
								<input type="text" class="tax-val" name="tax-val">
								<input type="text" class="fare-val" name="fare-val">
								<input type="text" class="percentage-val" name="percentage-val">
								<input type="text" class="number-val" name="number-val">
								<input type="text" class="fare">
			
								<input type="hidden" value="" id="user-table-data" name="user-table-data">
								<input type="hidden" value="" id="tax-list-table-data" name="tax-list-table-data">
								<input type="hidden" value="" id="tax-table-data" name="tax-table-data">
								<?php foreach($rule as $key => $arr):
									$size += 1;
								?>
								<input type="hidden" value="" id="" class="table-farerule-data" name=<?='data-table-farerule-' . $key?>>
								<?php endforeach;?>
								<input type="hidden" value="<?=$size?>" name="size">
								
							</div>
							<input type="submit" class="btn btn-submit mb-5 d-block ml-auto btn-orange" value="Send">
						</div>	
					</form>
				</div>
			</div>
		</div>
	</footer>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<!-- <script src="js/main.js"></script> -->
	<script>
		$(document).ready(function() {
			console.log($('.yes'));
			if($('.yes').text() == 1) {
				$('.tax-list').css({'display': 'none'});
				$('.rule-wrapper').css({'display': 'none'});
			}
		});
	</script>
	
</body>
</html>