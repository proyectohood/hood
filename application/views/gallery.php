<!DOCTYPE html>
<html>
<head>
<title>Galeria</title>
</head>

<body>
	<div id="gallery"></div>
	<div id="upload">
		<?php
			echo form_open_multipart(base_url().'index.php/gallery');
			echo form_upload('userfile');
			echo form_hidden('hoodid');
			echo form_submit('upload', 'Cargar');
			echo form_close();
		?>
	</div>
</body>

</html> 