<?php
 	require 'db.php';
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
						<table class="table table-bordered" id="user-table">
							<tr>
								<th>ID</th>
								<th>Name Surname</th>
								<th>tiket-id</th>
								<th>Status</th>
								<th>Segment</th>
								<th>Fare-basis</th>
								<th>Total price</th>
								<th>Sum Tax</th>
								<th>Without tax</th>
								<th>Sum penalty</th>
								<th>refund</th>
								
							</tr>
							<?php foreach($data as $value):?>
							<tr>
								<td class="id"><?php echo $value['id']?></td>
								<td class="name-surname"><?php echo $value['name_surname']?></td>
								<td class="ticket-id"><?=$value['ticket_id']?></td>
								<td class="status"><?=$value['status']?></td>
								<td class="segment"><?=$value['loc']?></td>
								<td class="fare-basis"><?=$value['fare_basis']?></td>
								<td class="ticket-price"><?=$value['total_price']?></td>
								<td class="sum_tax pen"><?=$value['sum_tax']?></td>
								<td class="without_tax dif"><?=$value['without_tax']?></td>
								<td class="sum_penalty pen"><?=$value['sum_penalty']?></td>
								<td class="refund dif"><?=$value['refund']?></td>
							</tr>
							<?php endforeach; ?>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td class="total-price-ticket tax-number"></td>
								<td class="total-penalty-tax pen"></td>
								<td class="total-price-ticket-1 dif"></td>
								<td class="total-penalty-farerule pen"></td>
								<td class="result dif"></td>
								
							</tr>
						</table>		
					</form>
				</div>
				<div class="col-md-3">
					<h1>Tax list</h1>
					<table class="table table-bordered" id="tax-list-table">
						<tr>
							<th>Tax nature</th>
							<th>Ref / Non</th>
						</tr>
						<?php foreach($tax_nature as $arr):?>
						<tr>
							<td class="ref-non"><?=$arr['tax_nature']?></td>
							<td class="ref-non-select">
								<select name=<?=$arr['tax_nature']?> id="">
									<option value="non-refundable">non-refundable</option>
									<option value="refundable">refundable</option>
								</select>
							</td>
						</tr>
						<?php endforeach; ?>
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
						<table class="table table-bordered" id="tax-table">
							<tr>
								<th>User_id</th>
								<th>Name</th>
								<th>Price</th>
								<th>Tax_nature</th>
								<th>Country_code</th>
								<th>Ref-result</th>
							</tr>
							<?php foreach($tax as $arr):?>
							<tr>
								<td class="user-id"><?=$arr['user_id']?></td>
								<td class="name-surname-1"><?=$arr['name_surname']?></td>
								<td class="price"><?=$arr['price']?></td>
								<td class="tax-nature"><?=$arr['tax_nature']?></td>
								<td class="country-code"><?=$arr['country_code']?></td>
								<td class="ref-result"><?=$arr['Refund']?></td>
							</tr>
							<?php endforeach;?>
						</table>
						<!-- <input type="submit" class="btn btn-secondary btn-count" value="Count"> -->
					</form>
					<!-- <div class="d-flex justify-content-between">
							<div class="tax-result">
								<p class="total-price-ticket-wrapper">
									<span>Ticket sum:</span>
									<span class="total-price-ticket tax-number"></span>	
								</p>
								<p class="tax-non-wrapper">
									<span>Sum Difference(non-ref):</span>
									<span class="sum-non-ref tax-number"></span>	
								</p>
								<p class="">
									<span>Sum tax:</span>
									<span class="total-penalty-tax pen tax-number">0</span>	
								</p>
								<p class="tax-ref-wrapper">
									<span class="">Sum Difference(ref):</span>
									<span class="sum-ref dif tax-number"></span>	
								</p>
								<p class="total-tax-wrapper">
									<span class="desc-tax">Sum without tax:</span>
									<span class="total-price-ticket-1 dif"></span>
								</p>	
							</div>	
					</div>	 -->
				</div>
			</div>
		</div>
	</div>
	<div class="rule-wrapper">
		<div class="container">
			<div class="row">
				<h1 class="w-100">Rule</h1>
				<div class="col-md-12 rulee">
					<div class="farerule d-flex flex-wrap">
						<?php foreach($rule as $arr):?>
						<p class="mr-2"><?=nl2br($arr['rule_text'])?></p>
						<?php endforeach;?>
					</div>
				</div>
				<div class="col-md-12">
					
					<div class="rule-wrapper mt-3">
							<div class="row align-items-end mb-2">

								<div class="col-md-3">
									<div class="form-group">
										<label for="fare_price">Choose User:</label>
										<select id="id-select" class="form-control">
										<?php foreach($data as $arr):?>
											<option value=<?php echo $arr['id']?>><?=$arr['name_surname']?></option>
										<?php endforeach;?>
										</select>										
									</div>		
								</div>
								<!-- <div class="col-md-3">
									<div class="form-group">
										<label for="fare_price">Fare text:</label>
										<input type="text" class="form-control rule" id="fare-type">	
									</div>		
								</div> -->
								<div class="col-md-3">
									<div class="form-group">
										<label for="percentage">Percentage: </label>
										<input type="text" class="form-control rule" id="percentage">	
									</div>		
								</div>
								<div class="col-md-3">
									<button class="btn btn-success btn-calculate">Calculate</button>		
								</div>							
							</div>
							<div class="row">
								<div class="col-md-7">
									<table class="table table-bordered" id="table-farerule">
										<tr>
											<th>ID</th>
											<th>Name Surname</th>
											<th>Price ticket(without tax)</th>
											<th>Percentage</th>
											<th>Penalty</th>
										</tr>
									</table>		
								</div>
							</div>
							
					</div>
				
					<div class="result-wrapper">
						<p>
							<span>Farerule penalty: </span>
							<span class="total-penalty-farerule tax-number pen">0</span>
						</p>
						<p  class="mb-0">
							<span>Result: </span>
							<span class="result dif"></span>
						</p>
					</div>
					<div class="w-100  d-flex justify-content-end">
						<input type="button" class="btn btn-success btn-submit mb-5 ml-auto" value="Send">
					</div>	
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<!-- <script src="js/main.js"></script> -->
	<script src="js/main_1.js"></script>
</body>
</html>