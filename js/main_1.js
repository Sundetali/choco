$(document).ready(function() {
	//validation for empty to each input
		$.fn.isEmpty = function(formInput) {
			var empty = false;
			$.each(formInput, function() {
				if($(this).val() == '') {
					return empty = $(this).val() == '';
				}
			});
			return empty;
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
		$.each($('.ref-non-select'),function() {
			var select = $(this).find('select');
			
			dict = {};
			dict['name'] = select.attr('name');
			dict['value'] = select.val();
			
			ref_non_list.push(dict);
		});

		//insert result to table for each ref-result
		var count = 0;
		
		$.each($('.tax-nature'), function() {
			var thiss = $(this);
			//sometimes to tax-nature added exrtra spaces !!!! problem 
			str = thiss.html().replace(/\s/g, '');
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

		return false; 
					
		
	});
	//last result of all price

	//add farerule and percent
	$('.btn-calculate').click(function() {
		if(!$(this).isEmpty($('.rule'))) {

			//var fare_type = $('#fare-type').val();
			var percentage = parseInt($('#percentage').val());
			//add table for penalty
			$.each($('.id'), function() {
				var thiss = $(this); 
				if(thiss.html() == $('select#id-select').val()) {
					var id = thiss.closest('tr').find('.id').html();
					var name_surname = thiss.closest('tr').find('.name-surname').html();
					var sum_tax = parseInt(thiss.closest('tr').find('.without_tax').html());

					$('table#table-farerule').append("<tr><td class='user_id'>"+ id +"</td>><td class='name'>"+ 
					name_surname+"</td><td class='ticket_price'>"+sum_tax+"</td><td class='percentage'>"+ 
					percentage +"</td><td class='penalty-farerule pen'>"+ parseInt((percentage/100) * sum_tax)
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
});