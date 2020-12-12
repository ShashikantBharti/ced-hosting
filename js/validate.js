$(document).ready(function(){
  // Validate Name.
  $('#firstName').on('blur', validateText);
  $('#lastName').on('blur', validateText);
  $('#mobile').on('blur', validateMobile);
  $('#email').on('blur', validateEmail);
  $('#password').on('blur', validatePassword);
  $('#confirmPassword').on('blur', validateConfirmPassword);
  $('#securityAnser').on('blur', validateText);
  $('#reg-form').on('submit', validateForm);


  // Validate Form.
  function validateForm(e){
    let input = $('#reg-form input,select');
    $.each(input, function(index, item){
      if($(item).val() == ''){
        e.preventDefault();
        displayError(this,'Fill this field');
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

  // Validate any text field.
  function validateText() {
    let value = $(this).val();
    let pattern = /^[a-zA-Z ]+$/;
    if(value != '') {
      if(value.length < 3 || value.length > 20) {
        displayError(this,'Length must be between 3 and 20 charecter!');
      } else {
          if(value[0] == ' ') {
          displayError(this,'No Space Allowed at beginning!');
        } else {
          if(value[value.length-1] == ' ') {
            displayError(this,'No Space Allowed at end!');
          } else {
            if(!pattern.test(value)) {
              displayError(this,'only alphabates allowed');
            } else {
              noError(this);
            }
          }
        }
      }
    } else {
      displayError(this,'Fill details');
    }
  }

  // Validate Mobile Number.
  function validateMobile() {
    let value = $(this).val();
    let pattern = /^[0]{0,1}[6-9][0-9]{9}$/;
    if(value != '') {
      if(!pattern.test(value)) {
        displayError(this,'Invalid Mobile Number');
      } else {
        let count = 0;
        for(let i=0;i<value.length-1; i++){
          let digit = value[i];
          for(let j=i+1; j<value.length; j++) {
            if(digit == value[j]) {
              count++;
            }
          }
        }
        console.log(count);
        if(count > 10) {
          displayError(this,'Invalid Mobile Number!');
        } else {
          noError(this);
        }
      }
    } else {
      displayError(this,'Fill Mobile Number');
    }
  }

  // Validate Email Address.
  function validateEmail() { 
    let value = $(this).val();
    let pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(value != '') {
      if(!pattern.test(value)) {
        displayError(this,"Invalid Email Address!");
      } else {
        noError(this);
      }
    } else {
      displayError(this,'Fill this field!');
    }
  }

  // Validate Password.
  function validatePassword() {
    let value = $(this).val();
    let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/;
    if (value != '') {
      if (value.length < 8) {
        displayError(this,'Password length must be minimum 8'); 
      } else {
        if (!pattern.test(value)) {
          displayError(this,'Password must contain at least (1 upper case, 1 lower case, 1 special charecter and 1 number)');
        } else {
          noError(this);
        }
      }
    } else {
      displayError(this,'Fill details');
    }

  }

  // Validate Confirm Password.
  function validateConfirmPassword() {
    let value = $(this).val();
    let password = $('#password').val();
    if(password != value) {
      displayError(this,"Password didn't match!");
    } else {
      noError(this);
    }
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



// Name pattern       =   '/^[^\s]+[a-zA-Z ]+[^\s]+$/';
// Mobile pattern     =   '/^[0]{0,1}[6-9][0-9]{9}$/';
// Email pattern      =   '/^[a-zA-Z0-9_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
// Password pattern   =   '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/';