$(document).ready(function(){

	$('#cat-form').on('submit',validateForm);
	$('#category').on('change', validateSelectField);
	$('#isAvailable').on('change', validateSelectField);
	$('#prodName').on('blur',validateProductName);
	

	// Validate Product Name.
	function validateProductName(){
		let value = $(this).val();
		let pattern = /^[^0-9][a-zA-Z0-9-]+$/;
		if(value != '') {
			if(value[0]==' ' || value[value.length-1] == ' ') {
					displayError(this,'Space not allowed at start and end!');
			} else {
				if(!pattern.test(value)){
					displayError(this,'This Product Name not allowed!');
				} else {
					noError(this);
				}
			}
		} else {
			displayError(this, 'Field required');
		}
	}

	// Validate Select Fields.
	function validateSelectField(){
		let value = $(this).val();
		if(value == '') {
			displayError(this, 'Field required!');
		} else {
			noError(this);
		}
	}

	// Validate Product Form.
	function validateForm(e){
		let fields = $('#prod-form input,select');
		$.each(fields, function(index, item){
			if ($(item).val() == '') {
				e.preventDefault();
				displayError(this, 'Field required!');
			} else {
				if($(item).hasClass('has-error')){
					e.preventDefault();
					displayError(this, 'Invalid Field!');
				} else {
					noError(this);
				}
			}
		});
	}




	// Function to display errors.
  function displayError(elem,message) {
    $(elem).css({border:'1px solid tomato'});
    $(elem).next('span').text(message);
    $(elem).next('span').css({color:'tomato'});
    $(elem).addClass('has-Error');
  }

  // Function to remove errors.
  function noError(elem) {
    $(elem).css({border:'1px solid green'});
    $(elem).next('span').text('');
  }
});