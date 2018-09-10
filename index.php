<?php
  	session_start();

 	require 'db.php';

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
					<?php if(isset($_SESSION['username'])):?>
						<div class="sign-wrapper">
							<span class="mr-3 px-2 agent-name"><?=$_SESSION['username']?></span>
							<a class="btn btn-blue" href="logout.php">logout</a>
						</div>
					<?php endif;?>		
			</div>
		</div>
	</header>
	<?php if(isset($yes) and $yes):?>
		<form action="senddata.php" method="POST">
			<div class="user-info">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1>User Info</h1>
								<table class="table" id="user-table">
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
										<td class="id"><?php echo $value['id']?></td><input type="hidden" name='id[]' value="<?=$value['id']?>"></td>
										<td class="name-surname"><?php echo $value['name_surname']?></td>
										<td class="ticket-id"><?=$value['ticket_id']?></td>
										<td class="status"><?=$value['status']?></td>
										<td class="segment"><?=$value['loc']?></td>
										<td class="fare-basis"><?=$value['fare_basis']?></td>
										<td class="ticket-price"><?=$value['total_price']?></td>
										<td class="sum_tax pen"><?=$value['sum_tax']?></td><input type="hidden" name='sum_tax[]' value="<?=$value['sum_tax']?>">
										<td class="without_tax dif"><?=$value['without_tax']?></td><input type="hidden" name='without_tax[]' value="<?=$value['without_tax']?>">
										<td class="sum_penalty pen"><?=$value['sum_penalty']?></td><input type="hidden" name='sum_penalty[]' value="<?=$value['sum_penalty']?>">
										<td class="refund dif"><?=$value['refund']?></td><input type="hidden" name='refund[]' value="<?=$value['refund']?>">
									</tr>
									<?php endforeach; ?>
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
						</div>
					</div>
				</div>
			</div>
			<div class="tax-list">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1>Tax</h1>
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
										<input type="hidden" value="<?=$arr['Refund']?>" name="ref_result[]">
									</tr>
									<?php endforeach;?>
								</table>
								<!-- <input type="submit" class="btn btn-secondary btn-count" value="Count"> -->
							
						</div>
					</div>
				</div>
			</div>
			<div class="rule-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<h1 class="w-100">Rule</h1>
							<?php foreach($rule as $key => $arr):?>
							<div class="farerule d-flex flex-wrap mb-3">
								<div class="fare-text mr-3">
									<h4><?php echo $arr['fare']?></h4>	
									<p class="mr-2"><?=nl2br($arr['rule_text'])?></p>	
								</div>
								<div class="rule-wrapper">
									<div class="row align-items-center mb-2">
										<div class="col-md-3">
											<div class="form-group">
												<label for="percentage">Percentage: </label>
												<input type="text" class="form-control rule percentage">	
											</div>		
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="number">Price: </label>
												<input type="text" class="form-control rule number">	
											</div>		
										</div>
										<div class="col-md-3 mt-3">
											<button class="btn btn-calculate btn-orange">Calculate</button>		
										</div>							
									</div>
									<table class="table table-bordered table-farerule" id=<?='table-farerule-' . $key?>>
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
							<?php endforeach;?>
						</div>
						<div class="col-md-2" id="div-tax-ist-table">
							<h1>Tax list</h1>
							<table class="table table-bordered" id="tax-list-table">
								<tr>
									<th>Country code</th>
									<th>Ref / Non</th>
								</tr>
								<?php foreach($country_code as $arr):?>
								<tr>
									<td class="ref-non"><?=$arr['country_code']?></td>
									<td class="ref-non-select">
										<select class="tax-select" name=<?=$arr['country_code']?> id="">
											<option value="non-refundable">non-refundable</option>
											<option value="refundable">refundable</option>
										</select>
									</td>
								</tr>
								<?php endforeach; ?>
							</table>
							<button class="btn btn-ref-non btn-orange">Add</button>
						</div>
					</div>
				</div>
			</div>
			<footer>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							
								<div class="w-100">
									<div class="input-result-wrapper">
										<input type="text" class="" name="segment" value="<?=$data[0]['loc']?>" >
										<input type="text" class="tax-val" name="tax-val">
										<input type="text" class="fare-val" name="fare-val">
										<input type="text" class="percentage-val" name="percentage-val">
										<input type="text" class="number-val" name="number-val">
										
									</div>
									<input type="submit" class="btn btn-submit mb-5 d-block ml-auto btn-blue" value="Send">
								</div>	
						
						</div>
					</div>
				</div>
			</footer>
		</form>
	<?php else:?>
		
	<div class="user-info">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>User Info</h1>
						<table class="table" id="user-table">
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
								<td class="id"><?php echo $value['id']?></td><input type="hidden" name='id[]' value="<?=$value['id']?>"></td>
								<td class="name-surname"><?php echo $value['name_surname']?></td><input type="hidden" name='name_surname[]' value="<?=$value['name_surname']?>">
								<td class="ticket-id"><?=$value['ticket_id']?></td><input type="hidden" name='ticket_id[]' value="<?=$value['ticket_id']?>">
								<td class="status"><?=$value['status']?></td><input type="hidden" name='status[]' value="<?=$value['status']?>">
								<td class="segment"><?=$value['loc']?></td><input type="hidden" name='segment[]' value="<?=$value['segment']?>">
								<td class="fare-basis"><?=$value['fare_basis']?></td><input type="hidden" name='fare_basis[]' value="<?=$value['fare_basis']?>">
								<td class="ticket-price"><?=$value['total_price']?></td><input type="hidden" name='total_price[]' value="<?=$value['total_price']?>">
								<td class="sum_tax pen"><?=$value['sum_tax']?></td><input type="hidden" name='sum_tax[]' value="<?=$value['sum_tax']?>">
								<td class="without_tax dif"><?=$value['without_tax']?></td><input type="hidden" name='without_tax[]' value="<?=$value['without_tax']?>">
								<td class="sum_penalty pen"><?=$value['sum_penalty']?></td><input type="hidden" name='sum_penalty[]' value="<?=$value['sum_penalty']?>">
								<td class="refund dif"><?=$value['refund']?></td><input type="hidden" name='refund[]' value="<?=$value['refund']?>">
							</tr>
							<?php endforeach; ?>
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
					
				</div>
			</div>
		</div>
	</div>
	<div class="tax-list">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Tax</h1>
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
								<input type="hidden" value="<?=$arr['Refund']?>" name="ref_result[]">
							</tr>
							<?php endforeach;?>
						</table>
						<!-- <input type="submit" class="btn btn-secondary btn-count" value="Count"> -->
					
				</div>
			</div>
		</div>
	</div>
	<div class="rule-wrapper mt-4">
		<div class="container">
			<div class="row">
				<div class="col-md-12 d-flex">
					<div class="farerule d-flex">
					<?php foreach($rule as $key => $arr):?>
						<div class="fare-text mr-3">
							<h4><?php echo $arr['fare']?></h4>	
							<p class="mr-2"><?=nl2br($arr['rule_text'])?></p>	
						</div>
						
					<?php endforeach;?>
					</div>
					<div class="result-penalty-wrapper pt-4" style="display: block">

						<?php foreach ($penalty as $key => $value):?>
						<div class="result-penalty">
							<span>Penalty percentage:</span>
							<span class="tax-number"><?=$value['penalty']?>%</span>
						</div>
						<div class="result-penalty">
							<span>Penalty price:</span>
							<span class="tax-number"><?=$value['penalty_price']?></span>
						</div>
						<?php endforeach;?>
					</div>
				</div>
				<div class="col-md-12">
					<form action="checkdata.php" method="POST" class="d-flex justify-content-end">
						<input type="hidden" value="<?=$_SESSION['username']?>" name="agent_name">
						<input type="submit" class="btn btn-orange btn-cancel mr-3" value="Edit" name = "edit">
						<input type="submit" class="btn btn-blue"  value="Send" name= "approve">
					</form>	
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="js/main.js"></script>
	
</body>
</html>