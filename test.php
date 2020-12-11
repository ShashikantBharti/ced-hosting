<?php

require 'functions.inc.php';

$query = new Query;

$email = 'surya.indian321@gmail.com';
$name = 'Shashikant Bharti';
$mobile = '7080281021';
$password = md5('Surya@123');
$securityQuestion = 'How are you?';
$securityAnser = "I am Fine";

echo $query->insertData('tbl_user',["email"=>$email,"name"=>$name,"mobile"=>$mobile,"email_approved"=>0,"phone_approved"=>0,"active"=>0,"is_admin"=>0,"password"=>$password, "security_question"=>$securityQuestion,"security_answer"=>$securityAnser]);