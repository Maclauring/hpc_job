<html>
<head>
	<title>HPC Job Details</title>
	<link href='http://fonts.googleapis.com/css?family=Alef:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
	<link href='hpc_job.css' rel='stylesheet' type='text/css'>
</head>
<center>
<body style="background-color: 7FC6BC">
<h1>A Birdview of Your Day</h1>
<?php
$username="hpc_job_user";
$password="hpc_job_pwd";
$database="hpc_job";

mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM job_detail";
$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();
?>
<div><table border="0" cellspacing="2" cellpadding="2" style="background-color: 4BB5C1">
<!--thead><span style="font-family: 'Dancing Script', cursive;;font-weight:700; font-size:40">A Birdview of Your Day</span></thead-->
<tr>
<td><font face="Alef">NO.</font></td>
<td><font face="Alef">Job ID</font></td>
<td><font face="Alef, Helvetica, sans-serif">Job Name</font></td>
<td><font face="Alef, Helvetica, sans-serif">Begin Date</font></td>
<td><font face="Alef, Helvetica, sans-serif">End Date</font></td>
<td><font face="Alef, Helvetica, sans-serif">Used Time</font></td>
</tr>

<?php
$i=0;
$j=0;
while ($i < $num) {
$j=$num-$i-1;
$f0=$j;
$f1=mysql_result($result,$j,"job_id");
$f2=mysql_result($result,$j,"job_name");
$f3=mysql_result($result,$j,"begin_date");
$f4=mysql_result($result,$j,"end_date");
$f5=mysql_result($result,$j,"used_time");
?>

<tr>
<td><font face="Alef"><?php echo $f0; ?></font></td>
<td><font face="Alef"><?php echo $f1; ?></font></td>
<td><font face="Alef"><?php echo $f2; ?></font></td>
<td><font face="Alef"><?php echo $f3; ?></font></td>
<td><font face="Alef"><?php echo $f4; ?></font></td>
<td><font face="Alef"><?php echo $f5; ?></font></td>
</tr>

<?php
$i++;
}
?>
</div>
</body>
</center>
</html>
