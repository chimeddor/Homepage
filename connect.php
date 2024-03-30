<?php
# FileName="connect.php"
$hostname = "localhost";
$username = "root";
$database = "konkuk_u_intelling_things_lab3";
$password = "321";
$connect = mysqli_connect($hostname, $username,$password ,$database )
or die('Could not connect: ' . mysql_error());
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	     <link rel="stylesheet" href="../jqwidgets/styles/jqx.base.css" type="text/css">
            <link rel="stylesheet" href="../jqwidgets/styles/jqx.classic.css" type="text/css">
            <script type="text/javascript" src="../scripts/jquery-1.11.1.min.js"></script>
            <script type="text/javascript" src="../jqwidgets/jqxcore.js"></script>
            <script type="text/javascript" src="../jqwidgets/jqxbuttons.js"></script>
            <script type="text/javascript" src="../jqwidgets/jqxscrollbar.js"></script>
            <script type="text/javascript" src="../jqwidgets/jqxdata.js"></script>
            <script type="text/javascript" src="../jqwidgets/jqxlistbox.js"></script>
            <script type="text/javascript" src="../jqwidgets/jqxdropdownlist.js"></script>
</head>

<body oncontextmenu="return false">
<?php
#Include the connect.php file
// include('connect.php');
#Connect to the database
//connection String

//select database
mysql_select_db($connect,$query);
//Select The database
$bool = mysql_select_db( $connect,$query);
if ($bool === False){
   print "can't find $database";
}
// get data and store in a json array
$query = "SELECT * FROM customers";
$from = 0;
$to = 30;
$query .= " LIMIT ".$from.",".$to;
 
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $customers[] = array(
        'CompanyName' => $row['CompanyName'],
        'ContactName' => $row['ContactName'],
    'ContactTitle' => $row['ContactTitle'],
    'Address' => $row['Address'],
    'City' => $row['City']
      );
}
 
echo json_encode($customers);
?>

<div id="dropdownlist"></div>

<script type="text/javascript">
    $(document).ready(function () {
        // prepare the data
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'CompanyName' },
                { name: 'ContactName' },
                { name: 'ContactTitle' },
                { name: 'Address' },
                { name: 'City' },
            ],
            url: 'data.php'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#dropdownlist").jqxDropDownList(
        {
            source: dataAdapter,
            theme: 'classic',
            width: 200,
            height: 25,
            selectedIndex: 0,
            displayMember: 'CompanyName',
            valueMember: 'ContactName'
        });
    });
</script>
</body>
</html>
