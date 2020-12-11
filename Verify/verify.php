<?php
include "../class/user.php";

$id = $_GET['id'];

$ob = new Query();
$result = $ob->updateData('tbl_user', ['email_approved' => '1'], ['id' => $id]);

if ($result) {
	echo "verification successful. you can log in now<br><a href='../login.php'>Click to index</a>";
} else {
	echo "verification failed";
}

?>