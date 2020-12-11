$(document).ready(function(){
  // Validate Name
  $('#firstName').on('blur', validateFirstName);
  $('#lastName').on('blur', validateLastName);
  //$('#mobile').on('blur', validateMobile);
  //$('#email').on('blur', validateEmail);
  $('#password').on('blur', validatePassword);
  $('#confirmPassword').on('blur', validateConfirmPassword);
  $('#securityAnser').on('blur', validateSecurityAnser);
 
  // Validate First Name
  function validateFirstName(){
    let value = $(this).val();
    let pattern = new RegExp('^[^ 0-9]+[a-zA-Z ]+[^ ]$');
    if(value == '') {
      displayError(this,'#firstNameHelp');
      swal("OOPs!", "First Name is empty!", "error");
    } else {
      if(!pattern.test(value)) {
        displayError(this,'#firstNameHelp');
        swal("OOPs!", "Invalid First Name!", "error");
      } else {
        noError(this,'#firstNameHelp');
        swal("Good job!", "You Entered First Name Correctly!", "success");
      }
    }
  }

  // Validate Last Name.
  function validateLastName(){
    let value = $(this).val();
    let pattern = new RegExp('^[^ 0-9]+[a-zA-Z ]+[^ ]$');
    if(!pattern.test(value)) {
      displayError(this,'#lastNameHelp','Invalid Last Name!');
      swal("OOPs!", "Invalid Last Name!", "error");
    } else {
      noError(this,'#lastNameHelp');
    }
  }

  // Validate mobile number
  function validateMobile(){
    let value = $(this).val();
    // let pattern = ;
    if(!pattern.test(value)) {
      displayError(this,'#mobileHelp','Invalid Mobile Number!');
    } else {
      noError(this,'#mobileHelp');
    }
  }

  // Validate Email.
  function validateEmail(){
    let value = $(this).val();
    let pattern =  /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if(!pattern.test(value)) {
      displayError(this,'#emailHelp','Invalid Email Address!');
    } else {
      noError(this,'#emailHelp');
    }
  }

  // Validate Password
  function validatePassword(){
    let value = $(this).val();
    let pattern = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$');
    if (value.length < 5) {
      displayError(this,'#passwordHelp','Password is too week!');
    } else if(!pattern.test(value)) {
      displayError(this,'#passwordHelp','Week Password!');
    } else {
      noError(this,'#passwordHelp','Strong Password!');
    }
  }

  // Validate Confirm Password
  function validateConfirmPassword(){
    let value = $(this).val();
    let pass = $('#password').val();
    if(value != pass) {
      displayError(this,'#confirmPasswordHelp','Password didn\'t match!');
    } else {
      noError(this,'#confirmPasswordHelp','Password matched!');
    }
  }

  // Validate Security Anser
  function validateSecurityAnser(){
    let value = $(this).val();
    let pattern = new RegExp('^[^ 0-9]+[a-zA-Z ]+[^ ]$');
    if(!pattern.test(value)) {
      displayError(this,'#securityAnserHelp','Invalid Anser!');
    } else {
      noError(this,'#securityAnserHelp');
    }
  }

  function displayError(elem,id,msg) {
    // $(id).text(msg);
    $(id).css({color:'#d9534f'});
    $(elem).css({border: '1px solid #d9534f'});
  }

  function noError(elem, id, msg = '') {
    $(id).text(msg);
    $(id).css({color:'#5f8c4a'});
    $(elem).css({border: '1px solid #5f8c4a'});
  }

});

// Name pattern       =   '/^[^\s]+[a-zA-Z ]+[^\s]+$/';
// Mobile pattern     =   '/^[0]{0,1}[6-9][0-9]{9}$/';
// Email pattern      =   '/^[a-zA-Z0-9_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
// Password pattern   =   '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/';