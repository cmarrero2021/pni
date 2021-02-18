<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auditoria extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			delete_cookie("ci_session");
			redirect(base_url().'login');
		}
		$this->load->model('login_model','login');
		$this->load->model("menu_model","menu");
		$this->load->model("audit_model");
		$this->load->model("bitacora_model","bitacora");
	}
	public function ingreso() {
		$cedula = $this->session->userdata('cedula');
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$this->session->set_userdata('titulo_url'," &nbsp;Auditoria de Ingresos");		
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
		$this->load->view('auditoria/auditoria_ingreso_view.php');
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function eventos() {
		$cedula = $this->session->userdata('cedula');
		$this->session->set_userdata('titulo_url'," &nbsp;Auditoria de Eventos");
		$this->session->set_userdata('icono_url',"icon-list-numbered");
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
		$this->load->view('auditoria/auditoria_evento_view.php');
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function get_auditoria_ingreso(){
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$query = $this->bitacora->listar_auditoria_ingreso();
		$data = [];
		foreach($query->result() as $r) {
			$data[] = array(
				$r->acciones='
				<a class="btn btn-xs bgc-success clight" href="javascript:void(0)" title="Ver ficha" onclick="ficha_auditoria('."'".$r->id_auditoria_acceso."'".')"><i class="fa fa-eye fa-2x"></i></a>',
				$r->id_auditoria_acceso,
				$r->login_usuario,
				$r->ingreso,
				$r->ingresado,
				$r->salida,
				$r->expirado,
				$r->status
			);
		}
		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);
		echo json_encode($result);
	}
	public function get_auditoria_evento(){
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$query = $this->bitacora->listar_auditoria_eventos();
		$data = [];
		foreach($query->result() as $r) {
			$data[] = array(
				$r->acciones='
				<a class="btn btn-xs bgc-success clight" href="javascript:void(0)" title="Ver ficha" onclick="ficha_auditoria('."'".$r->event_id."'".')"><i class="fa fa-eye fa-2x"></i></a>',
				$r->event_id,
				$r->action_tstamp_tx,
				$r->ci_usuario,
				$r->session_user_name,
				$r->nombre_usuario,
				$r->table_name,
				$r->client_addr,
				$r->client_port,
				$r->client_query,
				$r->row_data,
				$r->action,
				$r->changed_fields
			);
		}
		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);
		echo json_encode($result);
	}
	public function ficha_ingreso($id){
		$data = $this->bitacora->get_ingreso_by_id($id);
		echo json_encode($data);
	}
	public function ficha_evento($id){
		$data = $this->bitacora->get_evento_by_id($id);
		echo json_encode($data);
	}
	
}