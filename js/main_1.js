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


	//sum total price of ticket
	var total_price = 0;
	$.each($('.ticket-price'), function() {
		var ticket_price = parseInt($(this).html());
		total_price+=ticket_price;
	});
	$('.price-ticket').html(total_price);
	
	//price without tax in initial situation
	var sum_without_tax = total_price;
	$('.price-ticket-1').html(sum_without_tax);

	//tax-list result
	$('.btn-ref-non').click(function() {
		ref_non_list = [];
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
			for(var i=0; i<ref_non_list.length; i++) {
				if(ref_non_list[i].name == thiss.html()) {
					thiss.closest('tr').find('.ref-result').html(ref_non_list[i].value);
					thiss.closest('tr').find('.ref-result').append("<input type=text class='ref-non-input' name=ref-non-"+count+" value="+ref_non_list[i].value+">");
				}
			}
			count++;
		});

		//sum all non-refundable taxes
		var sum_tax = 0;

		//non refundable array
		var non_ref = [];
		$.each($('.ref-result'), function() {
			var non_ref_dict = {};
			if($(this).html().includes('non-refundable')) {
				var tax_price = parseInt($(this).closest('tr').find('.price').html()); 
				console.log(tax_price);
				sum_tax+=tax_price;
				$(this).closest('tr').find('.price').removeClass('dif');
				$(this).closest('tr').find('.price').addClass('pen');
			}
			else {
				$(this).closest('tr').find('.price').removeClass('pen');
				$(this).closest('tr').find('.price').addClass('dif');

			}
		});
		console.log(sum_tax);
		$('.sum-penalty-tax').html(sum_tax);
		//price without tax after select tax list
		sum_without_tax = total_price - sum_tax;
		$('.price-ticket-1').html(sum_without_tax);
		console.log(sum_tax);

		return false; 
		
	});
	$('#tax-form').submit(function() {
		$.ajax({
			url: 'some.php',
			type: 'post',
			data: $('#tax-form').serialize(),
			success: function(data) {
				var arr = data.split('-'); 
				for(var i=0; i<=arr.length-2; i+=2) {
					$.each($('.id'), function() {
						if($(this).html() == arr[i]) {
							$(this).closest('tr').find('.sum_tax').html(arr[i+1]);
						}
					});
				}
			}
		});
		return false;
	});
	
	//last result of all price
	var result = sum_without_tax;
	$('.result').html(result);

	//add farerule and percent
	$('.btn-calculate').click(function() {
		if(!$(this).isEmpty($('.rule'))) {

			var fare_type = $('#fare-type').val();
			var percentage = parseInt($('#percentage').val());
			//add table for penalty
			$.each($('.id'), function() {
				var thiss = $(this); 
				if(thiss.html() == $('select#id-select').val()) {
					var id = thiss.closest('tr').find('.id').html();
					var name_surname = thiss.closest('tr').find('.name-surname').html();
					var sum_tax_1 = parseInt(thiss.closest('tr').find('.sum_tax').html());
					var price_ticket = parseInt(thiss.closest('tr').find('.ticket-price').html());
					var price_tax_1 = price_ticket - sum_tax_1;
					$('table#table-farerule').append("<tr><td class='user_id'>"+ id +"</td>><td class='name'>"+ 
					name_surname+"</td><td class='ticket_price'>"+price_tax_1+"</td><td class='fare-type'>"+ 
					fare_type +"</td><td class='percentage'>"+ 
					percentage +"</td><td class='penalty-farerule pen'>"+ parseInt((percentage/100) * price_tax_1)
					+"</td><td><button class='btn btn-danger m-0'>Delete</button></td></tr>");
				}
			});
			var sum_penalty = 0;
			//sum all user's penalty
			$.each($('.penalty-farerule'), function() {
				sum_penalty+=parseInt($(this).html());
			});
			$('.sum-penalty-farerule').html(sum_penalty);

			result = sum_without_tax - sum_penalty;
			$('.result').html(result);

		}
		return false;
	});

	//remove row for click event
	$('body').on('click', '.btn-danger', function() {
		$(this).closest('tr').remove();
		var sum_penalty = 0;
		//sum all user's penalty
		$.each($('.penalty-farerule'), function() {
			sum_penalty+=parseInt($(this).html());
		});
		$('.sum-penalty-farerule').html(sum_penalty);

		result = sum_without_tax - sum_penalty;
		$('.result').html(result);


	});
});