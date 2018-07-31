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
		
	</style>
</head>
<body>
	<div class="tax-container">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Tax</h1>
					<form>
						<!-- <div class="tax-wrapper">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="type-tax">Type Tax</label>
										<input type="text" class="form-control tax tax-1" id="type-tax">	
									</div>		
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="sum-tax">Sum Tax</label>
										<input type="text" class="form-control tax tax-2" id="sum-tax">	
									</div>		
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="first">refundable/non</label>
										<select class="form-control" id="ref">
											<option value="refundable">refundable</option>
											<option value="non-refundable">non-refundable</option>
										</select>	
									</div>		
								</div>
							</div>
							<button class="btn btn-success btn-add btn-tax">Add tax</button>
						</div> -->
						<table class="table table-bordered" id="tax-table">
							<tr>
								<th>ID</th>
								<th>Name Surname</th>
								<th>Segment</th>
								<th>Status</th>
								<th>Price ticket</th>
								<th>Tax</th>
								<th>Tax type</th>
								<th>Tax nature</th>
							</tr>
							<?php foreach($data as $value):?>
							<tr>
								<td class="id"><?php echo $value['id']?></td>
								<td class="name_surname"><?php echo $value['name_surname']?></td>
								<td class="segment"><?php echo $value['segment']?></td>
								<td class="status"><?php echo $value['status']?></td>
								<td class="price_ticket"><?php echo $value['total_price'] . ' ТГ'?></td>
								<td class="tax_price pen"><?php echo $value['tax_price'] . ' ТГ'?></td>
								<td class="tax_type"><?php echo $value['tax_type']?></td>
								<td class="tax_nature"><?php echo $value['tax_nature']?></td>
								
							</tr>
							<?php endforeach; ?>
						</table>
						<div class="d-flex justify-content-between">
							<div class="tax-result">
								<p class="ticket-sum-wrapper">
									<span>Ticket sum:</span>
									<span class="ticket-sum tax-number"></span>	
								</p>
								<!-- <p class="tax-non-wrapper">
									<span>Sum Difference(non-ref):</span>
									<span class="sum-non-ref tax-number"></span>	
								</p> -->
								<p class="">
									<span>Sum tax:</span>
									<span class="sum-penalty-tax pen tax-number"></span>	
								</p>
								<!-- <p class="tax-ref-wrapper">
									<span class="">Sum Difference(ref):</span>
									<span class="sum-ref dif tax-number"></span>	
								</p> -->
								<p class="total-tax-wrapper">
									<span class="desc-tax">Sum without tax:</span>
									<span class="total-price tax-number"></span>
								</p>	
							</div>
								
						</div>			
					</form>
				</div>

				<div class="col-md-12 rulee">
					<h1>Rule</h1>
					<div class="farerule">
						FOR SOWKZ TYPE FARES CHANGES ANY TIME CHARGE 10 PERCENT FOR REISSUE/REVALIDATION. WAIVED FOR DEATH OF PASSENGER OR FAMILY MEMBER. CHARGE 20 PERCENT FOR NO-SHOW. WAIVED FOR DEATH OF PASSENGER OR FAMILY MEMBER. NOTE - - CHARGE 5 PERCENT FOR REISSUE/REVALIDATION IN CASE OF UPGRADE OUTBOUND AND INBOUND FARE COMPONENTS OF PRICING UNIT FROM RBD E TO Y/J RBD. - CHARGE 10 PERCENT FOR REISSUE/REVALIDATION IN CASE OF UPGRADE OUTBOUND FARE COMPONENT FROM RBD E TO Y/J RBD AND INBOUND FARE COMPONENT RBD E IS KEPT WITHOUT CHANGES. - CHARGE 10 PERCENT FOR REISSUE/REVALIDATION IN CASE OF UPGRADE INBOUND FARE COMPONENT FROM RBD E TO Y/J RBD AND OUTBOUND FARE COMPONENT RBD E IS KEPT WITHOUT CHANGES. - CHARGE 10 PERCENT FOR REISSUE/REVALIDATION IN CASE OF UPGRADE INBOUND OR OUTBOUND FARE COMPONENT FROM RBD E TO ANY OTHER RBDS /EXCEPT ABOVE/. ------ IN CASE OF E PLUS Y/J COMBINATION - CHARGE 5 PERCENT FOR REISSUE/REVALIDATION IN CASE OF UPGRADE OUTBOUND FARE COMPONENT FROM RB
					</div>
					
					<div class="rule-wrapper">
						
						<p class="total-tax-wrapper mb-5">
							<span class="desc-tax">Sum without taxes:</span>
							<span class="total-price tax-number"></span>
						</p>
						<div class="row align-items-end">

							<div class="col-md-3">
								<div class="form-group">
									<label for="fare_price">Choose id:</label>
									<select id="id-select" class="form-control">
									<?php foreach($sum_tax as $arr):?>
										<option value=<?php echo $arr['id']?>><?=$arr['id']?></option>
									<?php endforeach;?>
									</select>										
								</div>		
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="fare_price">Fare type:</label>
									<input type="text" class="form-control rule" id="fare-type">	
								</div>		
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="percentage">Percentage: </label>
									<input type="text" class="form-control rule" id="percentage">	
								</div>		
							</div>
							<div class="col-md-3">
								<button class="btn btn-success btn-calculate">Add</button>		
							</div>							
						</div>
						<table class="table table-bordered" id="table-farerule">
							<tr>
								<th>ID</th>
								<th>Name Surname</th>
								<th>Fare price</th>
								<th>Fare type</th>
								<th>Percentage</th>
								<th>Penalty</th>
							</tr>
						</table>
					</div>
					<form>
						<div class="result-wrapper">
							<p>
								<span>Farerule penalty: </span>
								<span class="sum-penalty-farerule tax-number pen">0 ТГ</span>
							</p>
							<p  class="mb-0">
								<span>Result: </span>
								<span class="total-result tax-number"></span>
							</p>
						</div>
						<div class="input-wrapper" style="display: block">
							<!-- <input type="text" name ="sum-ticket" class="ticket-sum-v">
							<input type="text" name = "sum-penalty-tax" class="sum-penalty-tax-v">
							<input type="text" name = "sum-penalty-farerule" class="sum-penalty-farerule-v">
							<input type="text" name = "sum-total-result" class="total-result-v"> -->

						</div>
						<div class="w-100  d-flex justify-content-end">
							<input type="button" class="btn btn-success btn-submit mb-5 ml-auto" value="Send">
						</div>	
					</form>

					<?php foreach($sum_tax as $arr):?>
						<div class="" style="display: none">
								<p class="tax-id"><?=$arr['id']?></p>
								<p><?=$arr['sum_tax']?></p>
						</div>
					<?php endforeach;?>
				</div>
				<div class="col-md-12 mt-3">
					<div class="resultt">
						<table class="table table-bordered" id="table-result">
							<tr class="header">
								<th>ID</th>
								<th>name-surname</th>
								<th>price-ticket</th>
								<th>sum-penalty</th>
								<th>sum-tax</th>
								<th>Refund</th>
							</tr>
						</table>
					</div>
					<div id="output_r">
						<?php foreach($sum_tax as $arr):?>
							<p>
								<span class="s"><?=$arr['id']?>:</span>
								<span class="tax-number"></span>		
							</p>
						<?php endforeach; ?>
					</div>	
				</div>
				
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!-- <script src="js/main.js"></script> -->
	<script>
		$(document).ready(function() {
			//validation for empty to each input
			$.fn.getEmpty = function(formInput) {
				var empty = false;
				$.each($(formInput), function() {
					if($(this).val() == '') {
						return empty = $(this).val() == '';
					}
				});
				return empty;
			}
/*			$.fn.remove = function() {
				var tr = $(this).closest('tr');
				console.log($(this).closest('tr'));
				tr.css({'display': 'none'});
			}
*/
			var price_sum = 0;	

			//check ref or non-ref, sum penalty and difference
			var user_data = [];
			var i = 1;
			$.each($('.id'), function() {
				var id = parseInt($(this).html());
				var parent = $(this).closest('tr');
				if(id == i) {
					var dict = {};
					dict['id'] = parent.find('.id').html();
					dict['name_surname'] = parent.find('.name_surname').html();
					dict['price_ticket'] = parseInt(parent.find('.price_ticket').html());
					dict['sum_penalty'] = 0;
					
					//blaaaaaaaaaaaaaaaaaaaaaaaa pipez
					if($('.tax-id')[i-1].innerHTML == id ){
						dict['sum_tax'] = $('.tax-id').next()[i-1].innerHTML;
					}
					price_sum+=parseInt(parent.find('.price_ticket').html());
					
					user_data.push(dict);
					i++;
				}

			});
			var price_after_tax = price_sum; 		
			
			var sum_penalty_tax = 0;
			$.each($('.tax_price'), function() {
				var penalty_tax = parseInt($(this).html());
				sum_penalty_tax+=penalty_tax;
			});
			price_after_tax = price_sum - sum_penalty_tax; 
			
			$('.ticket-sum').html(price_sum + ' ТГ');
			$('.ticket-sum-v').val(price_sum + ' ТГ');

			$('.sum-penalty-tax').html(sum_penalty_tax + ' ТГ');
			$('.sum-penalty-tax-v').val(sum_penalty_tax + ' ТГ');
			
			$('.total-price').html(price_after_tax + ' ТГ');
			
			var total_price = price_after_tax;
			
			$('.total-result').html(total_price + ' ТГ');

			$('.btn-calculate').click(function() {
				var fare_type = $('#fare-type').val();
				var percentage = parseInt($('#percentage').val());
				var penalty_farerule = parseInt((percentage/100) * price_after_tax);
				
				var sum_penalty_fare = 0;
				if(!$(this).getEmpty($('.rule'))) {
					for(var i=0; i<user_data.length; i++) {
						if(user_data[i].id == $('#id-select option:checked').val()){
							$('table#table-farerule').append("<tr><td class='user_id'>"+ user_data[i].id +"</td>><td class='name'>"+ 
							user_data[i].name_surname+"</td><td class='price'>"+user_data[i].price_ticket+"</td><td class='fare-type'>"+ 
							fare_type +"</td><td class='percentage'>"+ 
							percentage +"</td><td class='penalty-farerule pen'>"+ parseInt((percentage/100) * user_data[i].price_ticket)+"</td></tr>");
							

							var sum_penalty = 0;
							$.each($('.penalty-farerule'), function() {
								if($(this).closest('tr').find('.user_id').html() == user_data[i].id) {
									sum_penalty+=parseInt($(this).html());
								}	
							});
							user_data[i].sum_penalty = sum_penalty;
							
						}
					}
					
				}
				var sum_penalty_fare = 0;
				
				$.each($('.penalty-farerule'), function() {
					sum_penalty_fare+=parseInt($(this).html());
				});
				$('.sum-penalty-farerule').html(sum_penalty_fare + ' ТГ');
				$('.sum-penalty-farerule-v').val(sum_penalty_fare + ' ТГ');
				$('.total-result').html(total_price - sum_penalty_fare + ' ТГ');
				$('.total-result-v').val(total_price - sum_penalty_fare + ' ТГ');
			
				return false;
			});
			$('.btn-submit').click(function() {
				$('#table-result .body').remove();
				for(var i=0; i<=user_data.length; i++) {
					var td = "";
					for(var key in user_data[i]){
						td+="<td>"+user_data[i][key]+"</td>";
						console.log(user_data[i][key]);
					}
					var total = (parseInt(user_data[i].price_ticket) - (parseInt(user_data[i].sum_penalty)+parseInt(user_data[i].sum_tax)));
					td+="<td>"+total+"</td>"
					$('#table-result').append("<tr class='body'>"+td+"</tr>");
					$.each($('p .s'), function() {
						if(parseInt($(this).html()) == user_data[i].id) {
							$(this).next().html(total);
						}
					});

				}
				return false;
			});

					console.log(user_data);
	});
	</script>
</body>
</html>