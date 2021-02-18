<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model("menu_model","menu");
		// $this->load->model("inicio_model","inicio");
		$this->load->model("registro_model","registro");
		$this->load->helper("captcha");
	}
	public function index() {
		$this->session->set_userdata('direccion',base_url());
		$this->entrar();
	}
	public function entrar() {
		if($this->session->userdata('usuario')) {
			redirect(base_url().'inicio');
		}
		if (isset($_POST['usuario'])) {	
			if ($this->login_model->login($_POST['usuario'],$_POST['clave'])) {
				$caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*/#-+$%&@';
				$id_sesion = $this->generar_cadena($caracteres_permitidos,32);
				$captcha = strtoupper($_POST['captcha']);
				$this->session->set_userdata('id_sesion',$id_sesion);		
				$this->session->set_userdata('usuario',$_POST['usuario']);
				if($this->session->userdata('activo')=='t' && $this->session->userdata('verificado')=='t' ) {
					$this->login_model->registrar_ingreso($id_sesion,$_POST['usuario'],'true','INGRESO EXITOSO');
					if (($this->login_model->clave_default() != md5($_POST['clave'])) && $captcha == $this->session->userdata('valuecaptchaCode')) {
						redirect(base_url().'inicio');
					} else {
						if ($captcha != $this->session->userdata('valuecaptchaCode')) {
							?>
							<script type="text/javascript">
								alert("EL CAPTCHA NO COINCIDE CON EL CÓDIGO INTRODUCIDO");
							</script>
							<?php
						} else if ($this->login_model->clave_default() == md5($_POST['clave'])) {
							redirect(base_url().'registro/confirmar_correo');
						} else {
							die();
						}
					}
				} else if ( $this->session->userdata('verificado')=='f') {
					$this->login_model->registrar_ingreso($id_sesion,$_POST['usuario'],'false','NO VERIFICADO');
					redirect(base_url().'registro/confirmar_correo');
				}  else {
					$this->login_model->registrar_ingreso($id_sesion,$_POST['usuario'],'false','SUSPENDIDO');
					redirect(base_url().'login/suspendido');
				}
			} else {
				$this->login_model->registrar_ingreso($id_sesion,$_POST['usuario'],'false','INGRESO FALLIDO');
				redirect(base_url().'login/error');
			}
		}
		$empresa = $this->login_model->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$data['scripts'] = array('<script type="text/javascript" src="'.base_url().'assets/js/funciones.js"></script>');
		$config = array(
			'img_url' => base_url() . 'assets/captcha/',
			'img_path' => 'assets/captcha/',
			'img_height' => 45,
			'word_length' => 6,
			'img_width' => '150',
			'font_path' => base_url().'assets/fuentes/gadugi-bold.ttf',
			'font_size' => 48,
			'expiration'    => 7200,
			'colors' => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			),
			'pool'=> '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'
		);
		$captcha = create_captcha($config);
		$this->session->unset_userdata('valuecaptchaCode');
		$this->session->set_userdata('valuecaptchaCode', $captcha['word']);
		$data['captchaImg'] = $captcha['image'];
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('login/login',$data);
		$this->load->view('plantillas/pie',$pie);
	}
	/////////
	public function mantenimiento() {
		$empresa = $this->login_model->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('errors/mantinimiento_view');
		$this->load->view('plantillas/pie',$pie);		
	}
	public function refresh() {
		$config = array(
			'img_url' => base_url() . 'assets/captcha/',
			'img_path' => 'assets/captcha/',
			'img_height' => 45,
			'word_length' => 6,
			'img_width' => '150',
			'font_path' => base_url().'assets/fuentes/gadugi-bold.ttf',
			'font_size' => 48,
			'expiration'    => 7200,
			'colors' => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			),
			'pool'=> '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'			
		);
		$captcha = create_captcha($config);
		$this->session->unset_userdata('valuecaptchaCode');
		$this->session->set_userdata('valuecaptchaCode', $captcha['word']);
		echo $captcha['image'];
	}
	public function suspendido() {
		$menu1['buscar'] = false;
		$migas["migas"][0]["migas"]="";
		$titulo["titulo"] = $this->menu->get_titulo_aplicacion();
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/inicio_contenido',$migas);
		$this->load->view('errors/usuario_suspendido_view');
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');	
	}
	public function error() {
		$menu1['buscar'] = false;
		$migas["migas"][0]["migas"]="Error de Identificación";
		$titulo["titulo"] = $this->menu->get_titulo_aplicacion();
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo',$titulo);
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('registros/error_credenciales_view',$data);
		$this->load->view('plantillas/pie',$pie);
	}
	public function recuperar_clave() {
		$menu1['buscar'] = false;
		$migas["migas"][0]["migas"]="Reiniciar clave";
		$titulo["titulo"] = $this->menu->get_titulo_aplicacion();
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('registros/recuperacion_clave_view');
		$this->load->view('plantillas/pie_pagina2',$pie);
		$this->load->view('plantillas/pie');
	}
	public function verificar_correo($correo) {
		$data=$this->registro->verificar_correo("'".$correo."'");
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	public function recuperacion_clave() {
		$marca = $this->uri->segment(3);
		$this->registro->reiniciar_clave($marca);
		$menu1['buscar'] = false;
		$migas["migas"][0]["migas"]="Reinicio de clave";
		$titulo["titulo"] = $this->menu->get_titulo_aplicacion();
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view('plantillas/inicio_contenido',$migas);
		$this->load->view('registros/recuperacion_clave_view');
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function generar_cadena($entrada, $fortaleza = 16) {
		$longitud_entrada = strlen($entrada);
		$cadena_aleatoria = '';
		for($i = 0; $i < $fortaleza; $i++) {
			$caracter_aleatorio = $entrada[mt_rand(0, $longitud_entrada - 1)];
			$cadena_aleatoria .= $caracter_aleatorio;
		}
		return $cadena_aleatoria;
	}
	public function salir($camb=false) {
		if(!$camb) {
			$this->login_model->registrar_salida();
			$this->login_model->salir();
		}
		$this->session->sess_destroy();
		delete_cookie("ci_session");
		redirect(base_url().'login');
	}
}
