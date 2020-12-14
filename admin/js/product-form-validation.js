$(document).ready(function(){

	$('#prod-form').on('submit',validateForm);
	$('#category').on('change', validateSelectField);
	$('#isAvailable').on('change', validateSelectField);
	$('#prodName').on('blur',validateProductName);
	$('#monthlyPrice').on('blur', validatePrice);
	$('#annualPrice').on('blur', validatePrice);
	$('#sku').on('blur', validateSKU);
	$('#webSpace').on('blur', validateGB);
	$('#bandWidth').on('blur', validateGB);
	$('#freeDomain').on('blur', validateNumber);
	$('#mailBox').on('blur', validateNumber);
	$('#technology').on('blur', validateTechnology);
	

	// Validate Technology.
	function validateTechnology(){
		let value = $(this).val();
		let pattern = /^[a-zA-Z0-9, ]+$/;
		if(value != '') {
			if(value[0] == ' ' || value[value.length-1] == ' ') {
				displayError(this,'No space allowed at start and end!');
			} else {
				if(!pattern.test(value)) {
					displayError(this,'Invalid input!');
				} else {
					noError(this);
				}
			}
		} else {
			displayError(this, 'Field Required!');
		}
	}

	// Validate Number.
	function validateNumber() {
		let value = $(this).val();
		let pattern = /^[0-9]$/;
		if(value != '') {
			if(!pattern.test(value)) {
				displayError(this, 'Invalid Input!');
			} else {
				noError(this);
			}
		} else {
			displayError(this, 'Field Required!');
		}
	}

	// Validate GB
	function validateGB(){
		let value = $(this).val();
		let pattern = /^([0-9]+(\.[0-9]+)?)$/;
		if(value != '') {
			if(value.length > 5) {
				displayError(this, 'Max length 5 allowed!');
			} else {
				if(!pattern.test(value)) {
					displayError(this, 'Invalid Input!');
				} else {
					noError(this);
				}
			}
		} else {
			displayError(this, 'Field required!');
		}
	}

	// Validate SKU
	function validateSKU(){
		let value = $(this).val();
		let pattern =  /^[^0-9#-][a-zA-Z0-9#-]+$/;
		if(value != '') {
			if(value.length > 20) {
				displayError(this,'Max length 20 charecter allowed!');
			} else {
				if(!pattern.test(value)) {
					displayError(this,'Invalid Input!');
				} else {
					noError(this);
				}
			}
		} else {
			displayError(this,'Field required!');
		}
	}

	// Validate Price
	function validatePrice(){
		let value = $(this).val();
		let pattern = /^([0-9]+(\.[0-9]+)?)$/;
		if(value != '') {	
			if(value.length > 15) {
				displayError(this, 'Invalid input!');
			} else {
				if(!pattern.test(value)){
					displayError(this, 'Invalid input!');
				} else {
					noError(this);
				}
			}
		} else {
			displayError(this, 'Fields required!');
		}
	}

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