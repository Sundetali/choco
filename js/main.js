$(document).ready(function() {
			//validation for empty to each input
			console.log(11);
			$.fn.getEmpty = function(formInput) {
				var empty = false;
				$.each($(formInput), function() {
					if($(this).val() == '') {
						return empty = $(this)[0].value == '';
					}

				});
				console.log(empty);
				return empty;
			}
			$.fn.remove = function() {
				var tr = $(this).closest('tr');
				console.log($(this).closest('tr'));
				tr.css({'display': 'none'});
			}



			var price_ticket = parseInt($('.price_ticket').html());
			var sum_rule = price_ticket; 		
			
			//add form of inputTaxes to table
			/*$('.btn-tax').click(function(){
				var empty = $(this).getEmpty($('.tax'));
				console.log(empty);
				//add row in table
				if(!empty) {
					$('table#tax-table').append("<tr><td>" + "name surname" + "</td><td>"+ "ala-est" +"</td><td class='type-tax-show'>" + 
						$('#type-tax').val() +  "</td><td class='sum-tax-show'>" + 
						$('#sum-tax').val() + "</td><td class =" + 
						$('#ref').val() + "-show>" + 
						$('#ref').val() + "</td><td><input type='button' class='btn btn-danger' value='Delete'></td></tr>");
				}
				//delete row	
				$('.btn-danger').click(function() {
					$(this).remove();
					if(tr.find('.non-refundable-show')) {
						var tax = parseInt(tr.find('.sum-tax-show')[0].innerHTML);
						total_tax = parseInt($('.total-price')[0].innerHTML);
						console.log(tax + " " + total_tax);
					} 
				});
				//total sum without non-refundable taxes
				var sumNonRef = 0;
				var nonRef = $('.non-refundable-show');
				$.each($(nonRef), function() {
					sumNonRef+=parseInt($(this).closest('tr').find('.sum-tax-show')[0].innerHTML);
				});
				$('.tax-non-refundable').html(sumNonRef);
				$('.total-price').html(total_tax - sumNonRef);
				sum_rule = total_tax - sumNonRef;
				return false;
			});*/


			//check ref or non-ref, sum penalty and difference
			var sum_tax = 0;
			var sum_tax_ref = 0;
			var sum_penalty_tax = 0;

			$.each($('.tax_price'), function() {
				var penalty_tax = parseInt($(this).html());
				sum_penalty_tax+=penalty_tax;
			});
			console.log(sum_penalty_fare);
			sum_rule = price_ticket - sum_penalty_tax; 
			$('.ticket-sum').html(price_ticket + ' ТГ');
			$('.total-price').html(sum_rule + ' ТГ');
			$('.sum-penalty-tax').html(sum_penalty_tax + ' ТГ');
			
			var sum_penalty_fare = 0;
			var output = price_ticket - sum_penalty_fare + sum_penalty_tax; 	
			
			$('.sum-penalty-fare').html(sum_penalty_fare+ ' ТГ');
			$('.total-result').html(price_ticket - (sum_penalty_fare + sum_penalty_tax) + ' ТГ');

			$('.btn-calculate').click(function() {
				var fare_price = parseInt($('#fare_price').val());
				var percentage = parseInt($('#percentage').val());
				var per_result = (percentage/100)*fare_price;
				var result = fare_price - per_result;
				

				var empty = $(this).getEmpty($('.rule'));
				if(!empty) {
					$('#table-farerule').append("<tr><td class='fare-type-show'>"+ $('#fare-type').val() 
						+"</td><td class='fare-price-show'>" + fare_price + "</td><td class='percentage-show'>"+ 
						percentage + "</td><td class='penalty-farerule pen'>"+ per_result +"</td></tr>");		
				}
				$.each($('.penalty-farerule'), function(){
					sum_penalty_fare+= parseInt($(this).html());
				});
				$('.sum-penalty-fare').html(sum_penalty_fare + ' ТГ');
				$('.total-result').html(price_ticket - (sum_penalty_fare + sum_penalty_tax) + ' ТГ');
				return false;
			});
			/*$('.btn-rule').click(function(){
				var empty = $(this).getEmpty($('.rule'));
				if(!empty) {
					var percentage = parseInt($('#percentage-rule').val());
					var text = $('#text-rule').val();
					$('table#rule-table').append("<tr><td class='perc-rule-show'>" + 
						percentage +  "</td><td class = 'result-perc-show'>" + ((percentage/100)*parseInt(sum_rule)) +  
						"</td><td><input type='button' class='btn btn-danger' value='Delete'></td></tr>");
				}
				$('.btn-danger').click(function() {
					$(this).remove();
				});

				//sum of all percentage
				var percNumList = $('.result-perc-show');
				var sumPercNumber = 0;
				$.each($(percNumList), function() {
					sumPercNumber+=parseInt($(this).html());
				}); 

				$('.percentage-sum').html(sumPercNumber);
				$('.total-sum').html(sum_rule - sumPercNumber);
				console.log(sumPercNumber); 
				return false;
			});*/
});