<!DOCTYPE html>
<html>
<head>
<title>Galeria</title>
</head>

<body>
	<div>
		<?php
			echo form_open_multipart(base_url().'index.php/editar/cargar_upload');
			echo form_upload('userfile');
			echo form_submit('upload', 'Cargar');
			echo form_close();
		?>
	</div>
</body>

</html> 