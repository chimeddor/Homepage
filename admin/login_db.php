
<?php
$host = "localhost";
$user = "root";
$database = "konkuk_u_intelling_things_lab";
$password = "new_password";
$log_connect = mysqli_connect($host,$user,$password,$database);

if(mysqli_connect_errno()){
	echo "Failed to connect!";
	exit();  
}
#echo "Connection success!";
$sql = ("SELECT *FROM admin_log");
$query = mysqli_query($log_connect,$sql);
?>

