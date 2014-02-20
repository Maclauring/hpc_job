<html>
<head>
	<title>HPC Job Details</title>
	<link href='http://fonts.googleapis.com/css?family=Alef:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
	<link href='hpc_job.css' rel='stylesheet' type='text/css'>
	<script src='jquery-1.10.2.min.js'></script>
	<script src='hpc_job.js'></script>
</head>
<body>
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
	<div id='wrap'>
	<div id='tabmenu'>
		<h1>HPC Jobs</h1>
		<ul class='menu'>
			<li><a href='#job-count'>Job Count</a></li>
			<li><a href='#job-list'>Job List</a></li>
			<li><a href='#about'>About</a></li>
		</ul>
		<div class='separator'></div>
		<div id='footer'>
			Follow me at twitter: <a href='https://twitter.com/wojiefu'>@wojiefu</a> :)
		</div>
	</div>
	<div id='container'>
		<div id='job-count'>
			<h2>Job Count</h2>
			<p class='count'><?php echo $num ?></p>
			<div class='container-section'>
				<span>This count show the total number of jobs that had been submitted.</span>
			</div>
		</div>

		<div id='job-list'>
			<h2>Job List</h2>
			<div>
				<table class='list'>
				<tr class='list-head'>
					<td>NO.</td>
					<td>Job ID</td>
					<td>Job Name</td>
					<td>Begin Date</td>
					<td>End Date</td>
					<td>Used Time</td>
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
					<tr class='list-content'>
						<td><?php echo $f0; ?></td>
						<td><?php echo $f1; ?></td>
						<td><?php echo $f2; ?></td>
						<td><?php echo $f3; ?></td>
						<td><?php echo $f4; ?></td>
						<td><?php echo $f5; ?></td>
					</tr>
					<?php
					$i++;
				}?>
			</div>
		</div>

		<div id='about'>
			<h2>About</h2>
			<div class='container-section'>
				<span>This page records jobs that had been submitted by Jianfeng on HPC.</span>
			</div>
		</div>
	</div>
</div>
</body>
</html>
