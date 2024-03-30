
<?php
$host = "localhost";
$user = ""; #username
$database = ""; #database name
$password = ""; #password
$log_connect = mysqli_connect($host,$user,$password,$database);

if(mysqli_connect_errno()){
	echo "Failed to connect!";
	exit();  
}
#echo "Connection success!";
$sql = ("SELECT *FROM admin_log");
$query = mysqli_query($log_connect,$sql);
?>

