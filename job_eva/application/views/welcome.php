<!DOCTYPE html>
<html>
<head>
	<title>Membuat login dengan codeigniter | www.malasngoding.com</title>
</head>
<body>
	<h1>Login berhasil !</h1>
	<h2>Hai, <?php echo $userlogin; ?></h2>
	<h3><?php echo $userdetail['employeename'];?></h3>
	<h3><?php echo $userdetail['positiontitle'];?></h3>
	<h3><?php echo $userdetail['EmpJoinDAte'];?></h3>
	<h3><?php echo $userdetail['orggroup'];?></h3>
	<h3><?php echo $userdetail['nipatasan'];?></h3>
	<h3><?php echo $userdetail['namaatasan'];?></h3>
	
	<ul class="employee-list employee-list-in-box">
		<?php foreach($listposisi as $e): ?>
		<li class="item">
			
			
			<!-- <p><?php echo $e->job_title;?></p> -->
			<p><a href="#"><?php echo $e->position_id;?> &nbsp; - &nbsp;<?php echo $e->position_name;?></a></p>
			
		</li>
		<?php endforeach; ?>  
		<!-- /.Employee -->
	</ul>
	<a href="<?php echo base_url();?>index.php/verifylogin/logout">Logout</a>
</body>
</html>