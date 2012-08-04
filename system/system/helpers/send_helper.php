<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function send_email($arreglo){
	$CI =& get_instance();
	$config=array(
	'protocol'=>'smtp',
	'smtp_host'=>'ssl://smtp.gmail.com',
	'smtp_port'=> 465,
	'smtp_user'=>'proyectohood@gmail.com',
	'smtp_pass'=>'proyectohood1234',
	'mailtype' => 'html', 
	'charset'  => 'iso-8859-1'
	);
	$CI->load->library('email', $config);
	$CI->email->set_newline("\r\n");
	$CI->email->from('proyectohood@gmail.com', 'Administrador');
	$CI->email->to($arreglo[1]);
	$asunto=html_entity_decode ('Confirmaci&oacute;n de Activaci&oacute;n de Cuenta.');
	$CI->email->subject($asunto);
	$username= $arreglo[0]; 
	$username= urlencode(base64_encode($username));
	$CI->email->message('Hola '. $arreglo[0] . ', este es un correo de confirmaci&oacute;n para validar su cuenta en Hood. Por favor haga click a esta direcci&oacute;n: ' .base_url().'/index.php/login/activate_account/first_activation/'. $username);
	if($CI->email->send()){
		return true;
	}else{
		//show_error($CI->email->print_debugger());
		return false;
	}
}