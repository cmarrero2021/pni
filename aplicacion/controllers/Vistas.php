<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vistas extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('login_model','login');
		$this->load->model("menu_model","menu");
		$this->load->model("vistas_model","vistas");
	}
	public function index() {
		$data["vistas"] = $this->vistas->obtener_vistas();
		$data["campos"] = $this->vistas->obtener_campos();
		$this->session->set_userdata('titulo_url'," &nbsp;Vistas");
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$menu1["grupo_usuario"] = $grupo_usuario;
		$menu1['buscar'] = false;
		$menu1["menu"] = $this->menu->get_full_menu($grupo_usuario);
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view('plantillas/inicio_contenido');
		$this->load->view('vistas/vistas_view.php',$data);
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function generar_reporte() {
		$sql = $this->input->post("sql");
		echo json_encode($this->vistas->generar_reportes($sql),JSON_UNESCAPED_UNICODE);
	}
}
