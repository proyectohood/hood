<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>Area de Miembros</title>
</head>
<body>
	<h2>Welcome Back User Id # <?php echo $this->session->userdata('id'); ?>!</h2>
     <p>This section represents the area that only logged in members can access.</p>
	<h4><?php echo anchor('login/logout', 'Logout'); ?></h4>
</body>
</html>	
