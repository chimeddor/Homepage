
<?php
$host = ""; #localhost
$user = ""; #root
$database = ""; #database name
$password = ""; #database password
$connect = mysqli_connect($host,$user,$password,$database);
 
if(mysqli_connect_errno()){
	echo "Failed to connect!!";
	exit();  
}
#echo "Connection success!";


$resultSet = ("SELECT *FROM research_areas");
$resultsel = mysqli_query($connect,$resultSet);

$serch2 = ("SELECT phone ,phone2,name,greeting, profile_image, email FROM professor WHERE `id` = 1");
$result = mysqli_query($connect, $serch2);

$professor_history = ("SELECT * FROM professor_history");
$history_pro = mysqli_query($connect, $professor_history);

$student_query = ("SELECT * FROM student WHERE status = 'student'");
$sql = mysqli_query($connect, $student_query);


$alumni = ("SELECT * FROM student WHERE status = 'Alumni'");
$check = mysqli_query($connect, $alumni);

$members = ("SELECT *FROM student");
$member = mysqli_query($connect,$members);

$projects = ("SELECT *FROM projects");
$project = mysqli_query($connect, $projects);

$news = ("SELECT *FROM news");
$newss = mysqli_query($connect, $news);


$intro = ("SELECT *FROM introduction");
$introduc = mysqli_query($connect, $intro);

?>

