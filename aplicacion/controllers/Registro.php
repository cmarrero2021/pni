<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registro extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("registro_model","registro");
		$this->load->model("menu_model","menu");
		$this->load->model("login_model","login");
	}
	public function index() {
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo2');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('registros/registro_view',$data);
		//$this->load->view('plantillas/pie_pagina2',$pie);
		$this->load->view('plantillas/pie');
	}
	public function get_investigador() {
		$cedula = $this->input->post("cedula");
		echo json_encode($this->registro->get_investigador($cedula), JSON_UNESCAPED_UNICODE);
	}
	public function buscar_cne($ci) {
		$ci = $this->uri->segment(3);
		$data=$this->registro->buscar_cne($ci);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_genero() {
		$genero = $this->registro->obtener_genero();
		echo json_encode($genero, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_edociv() {
		$edociv = $this->registro->obtener_edociv();
		echo json_encode($edociv, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_estado() {
		$estado = $this->registro->obtener_estado();
		echo json_encode($estado, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_profesion() {
		$profesion = $this->registro->obtener_profesion();
		echo json_encode($profesion, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_tipo_institucion() {
		$tipo_inst = $this->registro->obtener_tipo_institucion();
		echo json_encode($tipo_inst, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_linea_investigacion() {
		$linea = $this->registro->obtener_linea_investigacion();
		echo json_encode($linea, JSON_UNESCAPED_UNICODE);
	}
	public function inv() {
		$linea = $this->registro->inv();
		echo json_encode($linea, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_modo_investigacion() {
		$modo = $this->registro->obtener_modo_investigacion();
		echo json_encode($modo, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_sector_empleo() {
		$sector = $this->registro->obtener_sector_empleo();
		echo json_encode($sector, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_tipo_investigador() {
		$tipo = $this->registro->obtener_tipo_investigador();
		echo json_encode($tipo, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_municipios() {
		$estado = $this->uri->segment(3);
		$municipio = $this->registro->obtener_municipios($estado);
		echo json_encode($municipio, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_parroquias() {
		$municipio = $this->uri->segment(3);
		$parroquia = $this->registro->obtener_parroquias($municipio);
		echo json_encode($parroquia, JSON_UNESCAPED_UNICODE);
	}
	public function obtener_zonas() {
		$parroquia = $this->uri->segment(3);
		$zona = $this->registro->obtener_zonas($parroquia);
		echo json_encode($zona, JSON_UNESCAPED_UNICODE);
	}
	public function insertar_investigador() {
		$datos = $this->input->post();
		$cedula = $this->input->post("cedula");
		$pnombre = $this->input->post("pnombre");
		$snombre = $this->input->post("snombre");
		$papellido = $this->input->post("papellido");
		$sapellido = $this->input->post("sapellido");
		$genero = $this->input->post("genero");
		$fnac = $this->input->post("fnac");
		$ecivil = $this->input->post("ecivil");
		$estado = $this->input->post("estado");
		$municipio = $this->input->post("municipio");
		$parroquia = $this->input->post("parroquia");
		$cpostal = $this->input->post("cpostal");
		$telefono = $this->input->post("telefono");
		$celular = $this->input->post("celular");
		$correo = $this->input->post("correo");
		$profesion = $this->input->post("profesion");
		$tinst = $this->input->post("tinst");
		$institucion = $this->input->post("institucion");
		$intinv = $this->input->post("intinv");
		$invact = $this->input->post("invact");
		$invcolind = $this->input->post("invcolind");
		$clave = $this->input->post("clave");
		$navegador1 = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($navegador1,"Firefox")) {
			$navegador="Firefox";
		} else if (strpos($navegador1,"Chrome") &&(!strpos($navegador1,"Edg") && !strpos($navegador1,"OPR"))){
			$navegador="Chrome";
		} else if (strpos($navegador1,"MSIE")){
			$navegador="Internet Explorer";
		} else if (strpos($navegador1,"WOW64") && !strpos($navegador1,"MSIE")){
			$navegador="Safari";
		} else if (strpos($navegador1,"Edg") ){
			$navegador="Edge";
		} else if (strpos($navegador1,"OPR")){
			$navegador="Ópera";
		}
		date_default_timezone_set("America/Caracas");  
		$fecha_hora = date('Y-m-d_H:i:s');
		$inv.print_r($intinv,true);
		$act.print_r($invact,true);
		file_put_contents("aplicacion/logs/registro.log", 
			"-fecha: ".$fecha_hora.
			" navegador: ".$navegador.
			" cedula: ".$cedula.
			" pnombre: ".$pnombre.
			" snombre: ".$snombre.
			" papellido: ".$papellido.
			" sapellido: ".$sapellido.
			" genero: ".$genero.
			" fnac: ".$fnac.
			" ecivil: ".$ecivil.
			" estado: ".$estado.
			" municipio: ".$municipio.
			" parroquia: ".$parroquia.
			" cpostal: ".$cpostal.
			" telefono: ".$telefono.
			" celular: ".$celular.
			" correo: ".$correo.
			" profesion: ".$profesion.
			" tinst: ".$tinst.
			" institucion: ".$institucion.
			" intinv: ".print_r($intinv,true).
			" invact: ".print_r($invact,true).
			" invcolind: ".$invcolind.
			" clave: ".$clave.
			PHP_EOL."-----------------".PHP_EOL,FILE_APPEND);
		if ($this->registro->verificar_registro($cedula)==1) {
			$res = $this->registro->insertar_investigador($datos);
			if ($res) {
				$cedula = $datos["cedula"];
				$pnombre = $datos["pnombre"];
				$snombre = $datos["snombre"];
				$papellido = $datos["papellido"];
				$sapellido = $datos["sapellido"];
				$correo = $datos["correo"];
				$telefono = $datos["telefono"];
				$celular = $datos["celular"];
				$genero = $datos["genero"];		
				$nombre_usuario=$pnombre." ".$snombre." ".$papellido." ".$sapellido;
				// $this->correo_registro_usuario($nombre_usuario,$correo,$cedula,$telefono,$celular,$genero);
				// echo json_encode(array("status" => TRUE));
				if ($this->correo_registro_usuario($nombre_usuario,$correo,$cedula,$telefono,$celular,$genero)) {
					echo json_encode(array("status" => TRUE,"registro" => TRUE,"correo" => TRUE, "existente" =>FALSE ));
				} else {
					$this->registro->eliminar_investigador($cedula);
					echo json_encode(array("status" => TRUE,"registro" => TRUE,"correo" => FALSE, "existente" =>FALSE ));
				}
			} else {
				echo json_encode(array("status" => FALSE,"registro" => FALSE,"correo" => FALSE, "existente" =>FALSE));
			}
		} else {
			echo json_encode(array("status" => TRUE,"registro" => TRUE,"correo" => TRUE, "existente" => TRUE));
		}
	}
	public function actualizar_investigador() {
		$datos = $this->input->post();
		$this->registro->actualizar_investigador($datos);
		$pnombre = $datos["pnombre"];
		$snombre = $datos["snombre"];
		$papellido = $datos["papellido"];
		$sapellido = $datos["sapellido"];
		$correo = $datos["correo"];
		$genero = $datos["genero"];
		$nombre_usuario=$pnombre." ".$snombre." ".$papellido." ".$sapellido;
		echo json_encode(array("status" => TRUE));
	}
	public function revisar_cedula($usuario) {
		$cedula = $this->uri->segment(3);
		echo $this->registro->revisar_cedula($cedula);
	}
	public function revisar_correo($correo) {
		$coreo = $this->uri->segment(3);
		echo $this->registro->revisar_correo($correo);
	}
	public function registrar_usuario() {
		$data = array(
			'ci_usuario' => $this->input->post('cedula'),
			'nombre_usuario' => "'".$this->input->post('nombre')."'",
			'login_usuario'  => "'".$this->input->post('usuario')."'",
			'clave_usuario' => $this->input->post('clave'),
			'correo_usuario' => "'".$this->input->post('correo')."'",
			'celular_usuario' => $this->input->post('celular')
		);
		$insert=$this->registro->registrar_usuario($data);
		$nombre_usuario = $this->input->post('nombre');
		$login_usuario  =  $this->input->post('usuario');
		$correo_usuario = $this->input->post('correo');
		$celular_usuario = $this->input->post('celular');
		$this->correo_registro_usuario($nombre_usuario,$login_usuario,$celular_usuario,$correo_usuario);	
		echo json_encode(array("status" => TRUE));
	}
	public function verificar_cedula($ci) {
		$data=$this->registro->verificar_cedula($ci);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}	
	public function verificar_correo($correo) {
		$correo = "'".$correo."'";
		$caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$clave_temp =$this->generar_cadena($caracteres_permitidos, 8);
		$data=$this->registro->verificar_correo($correo,$clave_temp);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	public function correo_registro_usuario($nombre_usuario,$correo,$cedula,$telefono,$celular,$genero) {
		$this->load->library('email');
		if($genero == 1) {
			$gen = " la ciudadana ";
		} else {
			$gen = " el ciudadano ";
		}
		switch (date('m')) {
			case '01':
			$mes = "enero";
			break;
			case '02':
			$mes = "febrero";
			break;
			case '03':
			$mes = "marzo";
			break;
			case '04':
			$mes = "abril";
			break;
			case '05':
			$mes = "mayo";
			break;
			case '06':
			$mes = "junio";
			break;
			case '07':
			$mes = "julio";
			break;
			case '08':
			$mes = "agosto";
			break;
			case '09':
			$mes = "septiembre";
			break;
			case '10':
			$mes = "octubre";
			break;
			case '11':
			$mes = "noviembre";
			break;
			case '12':
			$mes = "diciembre";
			break;
		}
		$semestre = date('n') <= 6 ? "primer" : "segundo";
		$subject = 'Confirmación de su inclusión en el Registro de Investigadores de Venezuela - Correo de confirmación de registro del usuario';
		$message = "<img src='".base_url()."assets/img/logo_pni-01.png' width='100px'/><p style='text-align:justify;'>El Observatorio Nacional de Ciencia, Tecnología e Innovación (ONCTI), por medio de la presente hace constar que, ".$gen." <strong>".$nombre_usuario."</strong>, titular de la Cédula de Identidad <strong>".$cedula."</strong>, Teléfono <strong>".$telefono.",</strong> Celular <strong>".$celular."</strong>, correo <strong>".$correo."</strong>, cumplió con la fase de inclusión en el <strong>Registro Nacional de Investigadores e Investigadoras</strong>, actividad realizada por el Ministerio del Poder Popular de Ciencia, Tecnología e Innovación , en el ".$semestre." semestre del año ".date('Y').", de acuerdo con lo establecido en la Gaceta Oficial número 41.864.<p style='text-align:justify;'>Constancia que se expide en Caracas, a los ".date('d')." días del mes de ".$mes." del año ".date('Y').".<p><p style='text-align:center;'>Dra. Grisel Romero<p>Presidenta del Observatorio Nacional de Ciencia, Tecnología e Innovación.<p><p><img src='".base_url()."assets/img/logo_pie.png' width='150px'/>";
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
		<title>' . html_escape($subject) . '</title>
		<style type="text/css">
		body {
			font-family: Arial, Verdana, Helvetica, sans-serif;
			font-size: 16px;
		}
		</style>
		</head>
		<body>
		' . $message . '
		</body>
		</html>';
		if (base_url()=="https://pni.oncti.gob.ve") {
			/////////////////////PRODUCCION/////////////////////////////
			$this->email->from('pni.oncti@gmail.com','NO CONTESTAR - Registro en el Plan Nacional de Investigadores e Investigadoras');
			$this->email->cc('investigacioncovidvzla@gmail.com');
			$this->email->reply_to('pni.oncti@gmail.com'); 
		} else {
			/////////////////////DESARROLLO/////////////////////////////
			$this->email->from('respaldomarreroc@gmail.com','NO CONTESTAR - Registro en el Plan Nacional de Investigadores e Investigadoras');
			$this->email->cc('tiroloco17@gmail.com,carlosrafaelmarrerom@gmail.com');
			$this->email->reply_to('riv.oncti@gmail.com'); 
			}
			$this->email->to($correo);
			$this->email->subject($subject);
			$this->email->message($message);
		//$this->email->send();
			if ($this->email->send() ) {
				return TRUE;
			} else {
				return FALSE;
			}

		}	
		public function enviar_correo_verificacion($correo) {
			$this->load->library('email');
			$data = $this->registro->datos_correo($correo);
			$nombre = $data["nombre_usuario"];
			$clave = $data["temporal"];
			$subject = 'Solicitud de reinicio de clave del Registro de Investigadores de Venezuela - Correo de confirmación';
			$message = "<img src='".base_url()."assets/img/logo_pni-01.png' width='100px'/><p style='text-align:justify;'>$nombre Ha recibido el presente correo debido a que realizó una solicitud de reinicio de clave.<p>La clave temporal asignada es: <strong>$clave</strong>; le recordamos que por razones de seguridad ingrese al sistema y cambie dicha clave temporal.<p><p><img src='".base_url()."assets/img/logo_pie.png' width='150px'/>";
			$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
			<title>' . html_escape($subject) . '</title>
			<style type="text/css">
			body {
				font-family: Arial, Verdana, Helvetica, sans-serif;
				font-size: 16px;
			}
			</style>
			</head>
			<body>
			' . $message . '
			</body>
			</html>';
		//////////PRODUCCION//////////
			$this->email->from('pni.oncti@gmail.com','NO CONTESTAR - Cambio de clave en el Plan Nacional de Investigadores e Investigadoras');
			$this->email->reply_to('pni.oncti@gmail.com'); 
			$this->email->cc('pni.oncti@gmail.com');		
		//////////PRODUCCION//////////
		//////////DESARROLLO//////////
		// $this->email->from('riv.oncti@gmail.com','NO CONTESTAR - Cambio de clave en el Plan Nacional de Investigadores e Investigadoras');
		// $this->email->reply_to('riv.oncti@gmail.com');
		// $this->email->cc('riv.oncti@gmail.com,carlosrafaelmarrerom@gmail.com');		
		//////////DESARROLLO//////////
			$this->email->to($correo);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
		}	
		public function recuperar_clave() {
			$empresa = $this->login->get_empresa();
			$titulo["titulo"] = $this->menu->get_titulo_aplicacion();
			$titulo["titulo"] = $this->menu->get_titulo_aplicacion();
			$pie["pie"] = $this->menu->get_pie_aplicacion();
			$this->load->view('plantillas/cintillo2');
			$this->load->view('plantillas/encabezado',$titulo);
			$this->load->view('registros/recuperacion_clave_view');
			$this->load->view('plantillas/pie_pagina2',$pie);
			$this->load->view('plantillas/pie');
		}
		public function cambiar_clave() {
			$data["controlador"]=$this;
			$menu1['buscar'] = false;
			$migas["migas"][0]["migas"]="Actualizar clave";
			$titulo["titulo"] = $this->menu->get_titulo_aplicacion();
			$pie["pie"] = $this->menu->get_pie_aplicacion();
			$this->load->view('plantillas/cintillo');
			$this->load->view('plantillas/encabezado',$titulo);
			$this->load->view('plantillas/cuerpo');
			$this->load->view('plantillas/superior');
			$this->load->view('plantillas/menu_izquierdo',$menu1);
			$this->load->view('plantillas/inicio_contenido',$migas);
			$this->load->view('registros/cambio_clave_view',$data);
			$this->load->view('plantillas/pie_pagina',$pie);
			$this->load->view('plantillas/pie');	
		}
		public function confirmar_correo() {
			$data["controlador"]=$this;
			$menu1['buscar'] = false;
			$migas["migas"][0]["migas"]="Confirmar correo";
			$titulo["titulo"] = $this->menu->get_titulo_aplicacion();
			$pie["pie"] = $this->menu->get_pie_aplicacion();
			$this->load->view('plantillas/cintillo');
			$this->load->view('plantillas/encabezado',$titulo);
			$this->load->view('plantillas/cuerpo');
			$this->load->view('plantillas/superior');
			$this->load->view('plantillas/menu_izquierdo',$menu1);
			$this->load->view('plantillas/inicio_contenido',$migas);
			$this->load->view('registros/confirmar_correo',$data);
			$this->load->view('plantillas/pie_pagina',$pie);
			$this->load->view('plantillas/pie');	
		}
		public function confirmacion_correo($marca_temporal){
			if ($marca_temporal != 'assets') {
				$marca =$this->registro->marca_verificada($marca_temporal);
				$data["controlador"]=$this;
				$menu1['buscar'] = false;
				$migas["migas"][0]["migas"]="Correo confirmado";
				$titulo["titulo"] = $this->menu->get_titulo_aplicacion();
				$pie["pie"] = $this->menu->get_pie_aplicacion();
				$this->load->view('plantillas/cintillo');
				$this->load->view('plantillas/encabezado',$titulo);
				$this->load->view('plantillas/cuerpo');
				$this->load->view('plantillas/superior');
				$this->load->view('plantillas/menu_izquierdo',$menu1);
				$this->load->view('plantillas/inicio_contenido',$migas);
				if ($marca){
					$this->load->view('registros/confirmacion_correo',$data);
				} else {
					?>
					<script type="text/javascript">
						alert('EL LINK QUE ESTÁ TRATANDO DE VERIFICAR NO EXISTE');
					</script>
					<?php 
				}
				$this->load->view('plantillas/pie_pagina',$pie);
				$this->load->view('plantillas/pie');	
			} 
		}
		public function completar_datos($datos) {
			$dat = explode("-------",$datos);
			$data = array(
				'clave_usuario' => $dat[0],
				'usuario' => $dat[1],
				'celular' => $dat[2]
			);
			$actualizar=$this->registro->completar_datos($data);
			$login_usuario = $actualizar[0]["login_usuario"];
			$nombre_usuario = $actualizar[0]["nombre_usuario"];
			$correo = $actualizar[0]["correo_usuario"];
			$message = $nombre_usuario. " se ha completado el registro de sus datos; a partir de este momento, puede ingresar en la Intranet de Bolivariana e Aeropuertos, S.A. (BAER) utilizando como usuario ".$login_usuario." y la clave que proporcionó en el proceso de registro de datos.";
			$subject = 'Se ha registrado exitosamente en la Intranet de BAER';
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'correo.baer.gob.ve',
				'smtp_port' => 25,
				'smtp_user' => 'intranet@baer.gob.ve',
				'smtp_pass' => '**BAer2020+',
				'mailtype'  => 'html', 
				'charset' => 'utf-8',
				'wordwrap' => TRUE
			);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$email_setting  = array('mailtype'=>'html');
			$this->email->initialize($email_setting);
			$email_body ="<div>hello world</div>";
			$this->email->from('sira@baer.gob.ve', 'Administración de Intranet BAER');
			$list = array($correo);
			$this->email->to($list);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
			echo true;
		}
		function generar_cadena($entrada, $fortaleza = 16) {
			$longitud_entrada = strlen($entrada);
			$cadena_aleatoria = '';
			for($i = 0; $i < $fortaleza; $i++) {
				$caracter_aleatorio = $entrada[mt_rand(0, $longitud_entrada - 1)];
				$cadena_aleatoria .= $caracter_aleatorio;
			}
			return $cadena_aleatoria;
		}
	}