<?php
 	require 'db.php';
 	$size = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AviaAgent</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	
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
				<div class="col-md-3" id="div-tax-ist-table">
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
							<div class="row align-items-end mb-2">
								<div class="col-md-3">
									<div class="form-group">
										<label for="fare_price">Choose User:</label>
										<select class="form-control user-select">
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
								<div class="col-md-2">
									<div class="form-group">
										<label for="percentage">Percentage: </label>
										<input type="text" class="form-control rule percentage">	
									</div>		
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="number">Price: </label>
										<input type="text" class="form-control rule number">	
									</div>		
								</div>
								<div class="col-md-3">
									<button class="btn btn-success btn-calculate">Calculate</button>		
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
				<div class="col-md-12">
					<form action="send.php" id="send_form" method="POST">
						<div class="w-100  d-flex justify-content-end">
							<input type="text" class="" name="segment" value="<?=$data[0]['loc']?>" >
							<input type="text" class="tax-val" name="tax-val">
							<input type="text" class="fare-val" name="fare-val">
							<input type="text" class="percentage-val" name="percentage-val">
							<input type="text" class="number-val" name="number-val">


							<input type="hidden" value="" id="user-table-data" name="user-table-data">
							<input type="hidden" value="" id="tax-list-table-data" name="tax-list-table-data">
							<input type="hidden" value="" id="tax-table-data" name="tax-table-data">
							<?php foreach($rule as $key => $arr):
								$size += 1;
								?>
								<input type="hidden" value="" id="" class="table-farerule-data" name=<?='data-table-farerule-' . $key?>>
							<?php endforeach;?>
							<input type="hidden" value="<?=$size?>" name="size">
							<input type="submit" class="btn btn-success btn-submit mb-5 ml-auto" value="Send">
						</div>	
					</form>
						
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<!-- <script src="js/main.js"></script> -->
	<script src="/main.js">
		
	</script>
	<script>
		$(document).ready(function() {
			//validation for empty to each input
			$.fn.isEmpty = function(formInput) {
				var empty = false;
				$.each(formInput, function() {
					if($(this).val() == '') {
						return empty = $(this).val() == '';
					}
				});
				return false; //empty;
			}
			$.fn.getTotal = function(sum) {
				var total = 0;
				$.each(sum, function() {
					total+=parseInt($(this).html());
				})
				return total;
			}

			//sum total all in initial situation
			var total_price = 0;
			var total_tax = 0;
			var total_penalty = 0;
			$.each($('.ticket-price'), function() {
				var ticket_price = parseInt($(this).html());
				total_price+=ticket_price;
			});
			var total_without_tax = total_price;
			var total_refund_price = total_price;

			$('.total-price-ticket').html(total_price);
			$('.total-penalty-tax').html(total_tax);
			$('.total-price-ticket-1').html(total_without_tax);
			$('.total-penalty-farerule').html(total_penalty);
			$('.result').html(total_refund_price);


			//tax-list result
			$('.btn-ref-non').click(function() {
				var ref_non_list = [];
				//save all tax-list as array
				var str ='';
				$.each($('select.tax-select'),function() {
					
					dict = {};
					dict['name'] = $(this).attr('name');
					dict['value'] = $(this).val();
					
					ref_non_list.push(dict);
					//saving data
					if($(this).val() == 'non-refundable') {
						str = str + $(this).attr('name') + ' '; 
					}
				});
				$('.tax-val').val(str);

				//insert result to table for each ref-result
				var count = 0;
				
				$.each($('.country-code'), function() {
					var thiss = $(this);
					//sometimes to tax-nature added exrtra spaces !!!! problem 
					str = thiss.html().replace(/\s/g, '');
					console.log(str);
					for(var i=0; i<ref_non_list.length; i++) {
						if(ref_non_list[i].name == str) {
							thiss.closest('tr').find('.ref-result').html(ref_non_list[i].value);
							thiss.closest('tr').find('.ref-result').append("<input type=text class='ref-non-input' name=ref-non-"+count+" value="+ref_non_list[i].value+">");
						
						}
					}
					count++;
				});

				
				//sum non-refundable tax
				var non_ref = [];
				$.each($('.ref-result'), function() {
					var non_ref_dict = {};
					if($(this).html().includes('non-refundable')) {
						$(this).closest('tr').find('.price').removeClass('dif');
						$(this).closest('tr').find('.price').addClass('pen');
					}
					else {
						$(this).closest('tr').find('.price').removeClass('pen');
						$(this).closest('tr').find('.price').addClass('dif');

					}
				});
				$.ajax({
					url: 'some.php',
					type: 'post',
					data: $('#tax-form').serialize(),
					success: function(data) {

						var arr = data.split('-'); 
						for(var i=0; i<=arr.length-2; i+=2) {
							$.each($('.id'), function() {
								if($(this).html() == arr[i]) {
									var tr = $(this).closest('tr');
									var price_ticket = parseInt(tr.find('.ticket-price').html());
									var sum_tax = parseInt(arr[i+1]);
									var sum_without_tax = price_ticket - sum_tax;
									var sum_penalty = parseInt(tr.find('.sum_penalty').html());
									
									tr.find('.sum_tax').html(sum_tax);
									tr.find('.without_tax').html(sum_without_tax);
									tr.find('.refund').html(sum_without_tax-sum_penalty);
												
								}
							});
						};
						//total result after ajax request
						total_tax = $(this).getTotal($('.sum_tax'));
						total_without_tax = $(this).getTotal($('.without_tax'));
						total_penalty = $(this).getTotal($('.sum_penalty'));
						total_refund_price = $(this).getTotal($('.refund'));
						
						$('.total-penalty-tax').html(total_tax);
						$('.total-price-ticket-1').html(total_without_tax);
						$('.total-penalty-farerule').html(total_penalty);
						$('.result').html(total_refund_price);
					}
				});
				//send updated user data with

				
				return false; 
							
				
			});
			
			//percent to number
			$('.percentage').on('input', function() {
				
				var thiss = $(this);
				var rule_wrapper = thiss.closest('.rule-wrapper');
					
				if(thiss.val() != '') {
					var percentage = parseInt($(this).val());
					var user_select = rule_wrapper.find('.user-select').val();
					
					$.each($('.id'), function() {
						if($(this).html() == user_select) {
							var tr = $(this).closest('tr');
							var sum_without_tax = parseInt(tr.find('.without_tax').html());
							var number = parseInt((sum_without_tax * (percentage / 100)));
							rule_wrapper.find('.number').val(number);		
						};	

					});
				}
				else {
					rule_wrapper.find('.number').val('');	
				}
			});

			$('.btn-calculate').click(function() {
				var rule_wrapper = $(this).closest('.rule-wrapper');
				if(!$(this).isEmpty(rule_wrapper.find('input.rule'))) {
					
					//get value from form
					var percentage = rule_wrapper.find('.percentage').val();
					var user_select = rule_wrapper.find('.user-select').val();
					//var id = rule_wrapper.find('.id');
					//add table for penalty
					$.each($('.id'), function() {
						var thiss = $(this); 
						var tr = thiss.closest('tr');
						if(thiss.html() == user_select) {
							var id = tr.find('.id').html();
							var name_surname = tr.find('.name-surname').html();
							var sum_tax = tr.find('.without_tax').html();
							
							var number = rule_wrapper.find('.number').val();

							rule_wrapper.find('table').append("<tr><td class='user_id'>"+ id +"</td>><td class='name'>"+ 
							name_surname+"</td><td class='ticket_price'>"+sum_tax+"</td><td class='percentage-1'>"+ 
							percentage +"</td><td class='penalty-farerule pen'>"+ number
							+"</td><td><button class='btn btn-danger m-0'>Delete</button></td></tr>");
						}
					});


					$.each($('.id'), function() {
						var this_user = $(this);
						var sum_penalty = 0;
						
						$.each($('.user_id'), function() {
							if($(this).html() == this_user.html()) {
								sum_penalty+=parseInt($(this).closest('tr').find('.penalty-farerule').html());
							}
						});
						var sum_without_tax = parseInt(this_user.closest('tr').find('.without_tax').html()); 
						
						this_user.closest('tr').find('.sum_penalty').html(sum_penalty);
						this_user.closest('tr').find('.refund').html(sum_without_tax - sum_penalty);
					});

					total_tax = $(this).getTotal($('.sum_tax'));
					total_without_tax = $(this).getTotal($('.without_tax'));
					total_penalty = $(this).getTotal($('.sum_penalty'));
					total_refund_price = $(this).getTotal($('.refund'));
					
					$('.total-penalty-tax').html(total_tax);
					$('.total-price-ticket-1').html(total_without_tax);
					$('.total-penalty-farerule').html(total_penalty);
					$('.result').html(total_refund_price);

				};


				
				var sum_percentage = 0;
				var sum_number = 0;
				var size = 0;
				$.each($('.percentage-1'), function(){	
					var value = $(this).html();
					if(value != '') {
						sum_percentage+=parseInt(value);
						size++;
					}
					else {
						var number = parseInt($(this).closest('tr').find('.penalty-farerule').html());
						console.log(number);
						sum_number+=number;
					}
				});
				$('.percentage-val').val(sum_percentage + '%');
				$('.number-val').val(sum_number);

				return false;
			});

			//remove row for click event
			$('body').on('click', '.btn-danger', function() {
				var tr_penalty = $(this).closest('tr');
				//change each user's sum penalty
				$.each($('.id'), function() {
					var tr_user = $(this).closest('tr');
					if($(this).html() == tr_penalty.find('.user_id').html()) {

						var penalty_price = parseInt(tr_penalty.find('.penalty-farerule').html());

						var prev_sum_pen = parseInt(tr_user.find('.sum_penalty').html());
						var sum_without_tax = parseInt(tr_user.find('.without_tax').html());
						
						var sum_penalty = prev_sum_pen - penalty_price;
						tr_user.find('.sum_penalty').html(sum_penalty);
						tr_user.find('.refund').html(sum_without_tax - sum_penalty);
					}
				});
				$(this).closest('tr').remove();

				total_tax = $(this).getTotal($('.sum_tax'));
				total_without_tax = $(this).getTotal($('.without_tax'));
				total_penalty = $(this).getTotal($('.sum_penalty'));
				total_refund_price = $(this).getTotal($('.refund'));
				
				$('.total-penalty-tax').html(total_tax);
				$('.total-price-ticket-1').html(total_without_tax);
				$('.total-penalty-farerule').html(total_penalty);
				$('.result').html(total_refund_price);
				
				return false;	
			});


			$('body').on('click', '.btn-submit', function(){
				//page for superviser
				$('#user-table-data').val($('#user-table').html());
				$('#tax-table-data').val($('#tax-table').html());
				$('#tax-list-table-data').val($('#tax-list-table').html());
				
				
				$.each($('.table-farerule-data'), function() {
					var input_id = $(this).attr('name').split('data-')[1];
					
					$(this).val($('#'+input_id).html());
				});
				//form for saving data	
			});
			var str_fare = '';
			$.each($('h4'), function() {
				str_fare+=$(this).text() + " ";
			});
			console.log(str_fare);
			$('.fare-val').val(str_fare);
});		
	</script>
</body>
</html>