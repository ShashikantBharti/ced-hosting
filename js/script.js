function manageCart(elem='',id='',sku='',type='') {
	data = {id:id, sku:sku, type:type}
	console.log(data);
	$.ajax({
		url: "manage-cart.php",
		method: "POST",
		data: data,
		dataType: "json",
		success: function(res) {
			$('#totalProduct').text(res);
			$(elem).text('Added');
			console.log(res);
		}
	});
}