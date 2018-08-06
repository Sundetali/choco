$(document).ready(function() {
			//validation for empty to each input
			$.fn.isEmpty = function(formInput) {
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

			var ticket_price = 0;	

			//check ref or non-ref, sum penalty and difference
			var user_data = [];
			var i = 1;
			$.each($('.id'), function() {
				var id = parseInt($(this).html());
				var parent = $(this).closest('tr');
				if(id == i) {
					var dict = {};
					dict['id'] = parent.find('.id').html();
					dict['name_surname'] = parent.find('.name-surname').html();
					dict['price_ticket'] = parseInt(parent.find('.price-ticket').html());
					dict['sum_penalty'] = 0;
					
					//blaaaaaaaaaaaaaaaaaaaaaaaa pipez
					if($('.tax-id')[i-1].innerHTML == id ){
						dict['sum_tax'] = $('.tax-id').next()[i-1].innerHTML;
					}
					ticket_price+=parseInt(parent.find('.price-ticket').html());
					
					user_data.push(dict);
					i++;
				}

			});
			var price_after_tax = ticket_price; 		
			//sum total tax price
			var sum_penalty_tax = 0;
			$.each($('.tax_price'), function() {
				var penalty_tax = parseInt($(this).html());
				sum_penalty_tax+=penalty_tax;
			});
			// ticket price after tax
			price_after_tax = ticket_price - sum_penalty_tax; 
			
			$('.price-ticket').html(ticket_price + ' ТГ');
			$('.price-ticket-v').val(ticket_price + ' ТГ');

			$('.sum-penalty-tax').html(sum_penalty_tax + ' ТГ');
			$('.sum-penalty-tax-v').val(sum_penalty_tax + ' ТГ');
			
			$('.price-ticket-1').html(price_after_tax + ' ТГ');
			
			var total_price = price_after_tax;

			$('.btn-calculate').click(function() {
				var fare_type = $('#fare-type').val();
				var percentage = parseInt($('#percentage').val());
				var penalty_farerule = parseInt((percentage/100) * price_after_tax);
				
				var sum_penalty_fare = 0;
				if(!$(this).isEmpty($('.rule'))) {
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
				// result without fare prices
				$('.total-result').html(total_price + ' ТГ');
				//sum penalty fare 
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