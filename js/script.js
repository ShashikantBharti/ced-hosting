$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});

function manageCart(elem='', id='', sku='', type='', html='') {
	data = {id:id, sku:sku, type:type}
	console.log(data);
	$.ajax({
		url: "manage-cart.php",
		method: "POST",
		data: data,
		// dataType: "json",
		success: function(res) {
			$('#totalProduct').text(res);
			$(elem).text('Added');
			location.href = html;
		}
	});
}

function removeProduct(id='', type='') {
	data = {id:id, type:type}
	console.log(data);
	$.ajax({
		url: "manage-cart.php",
		method: "POST",
		data: data,
		success: function(res){
			console.log(res);
			location.href = 'cart.php';
		}
	});
}

