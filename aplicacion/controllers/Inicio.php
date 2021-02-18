<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inicio extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			delete_cookie("ci_session");
			redirect(base_url().'login');
		}		
		$this->load->model("inicio_model","inicio");
		$this->load->model("login_model","login");
		$this->load->model("menu_model","menu");
		$this->load->library('pdf');
		ini_set('date.timezone', 'America/Caracas');
		$this->load->helper('form'); 
	}
	public function index() {
		if(!$this->session->userdata('empresa')) {
			$emp = $this->menu->get_empresa();
			$this->session->set_userdata('empresa',$emp[0]['empresa']);
			$this->session->set_userdata('titulo',$emp[0]['titulo']);
			$this->session->set_userdata('denominacion',$emp[0]['denominacion']);
			$this->session->set_userdata('rif',$rif[0]['denominacion']);
			$this->session->set_userdata('telefono',$emp[0]['telefono']);
			$this->session->set_userdata('correo',$emp[0]['correo']);
		}
		$cedula = $this->session->userdata('cedula');
		$this->session->set_userdata('titulo_url',"");
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$menu1['buscar'] = false;
		$menu1["menu"] = $this->menu->get_full_menu($grupo_usuario);
		$empresa = $this->menu->get_empresa();
		$data["registro"]=$this->inicio->verificar_registro();
		$data["investigador"]=$this->inicio->verificar_investigador();
		$data["investigacion"]=$this->inicio->verificar_investigacion();
		$data["actual"]=$this->inicio->verificar_investigacion_actual();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view('plantillas/inicio_contenido');
		$this->load->view('inicio/inicio_view',$data);
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
}
