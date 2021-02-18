<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('login_model','login');
		$this->load->model("menu_model","menu");
		$this->load->model("registro_model","registro");
		$this->load->model("usuarios_model","usuarios");
	}
	public function roles() {
		$cedula = $this->session->userdata('cedula');
		$this->session->set_userdata('titulo_url'," &nbsp;Administración de Usuarios");
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$menu1["grupo_usuario"] = $grupo_usuario;
		$menu1['buscar'] = false;
		$menu1["menu"] = $this->menu->get_full_menu($grupo_usuario);
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$data['usuarios']=$this->usuarios->listar_usuarios();
		$data['roles']=$this->usuarios->obtener_roles();
		$roles = print_r($this->usuarios->obtener_roles(),true);
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view('plantillas/inicio_contenido');
		$this->load->view('usuarios/usuarios_view.php',$data);
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function get_usuarios() {
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$query = $this->usuarios->listar_usuarios();
		$data = [];
		foreach($query->result() as $r) {
			$data[] = array(
				$r->acciones='			
				<a class="btn btn-xs bgc-success clight" href="javascript:void(0)" title="Editar" onclick="editar('."'".$r->id_usuario."'".')"><i class="fa fa-edit fa-2x"></i></a>
				<a class="btn btn-xs bgc-danger clight" href="javascript:void(0)" title="Eliminar" onclick="suspender('."'".$r->id_usuario."'".')"><i class="fa fa-trash fa-2x"></i></a>',
				$r->id_usuario,
				$r->ci_usuario,
				$r->nombre_usuario,
				$r->apellido_usuario,
				$r->login_usuario,
				$r->telefono_usuario,
				$r->id_grupo,
				$r->activo,
				$r->fecha_creacion
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
	public function agregar_usuarios() {
		$ced = $this->input->post('cedula');
		$nom = $this->input->post('nombres');
		$ape = $this->input->post('apellidos');
		$cor = $this->input->post('correo');
		$tel = $this->input->post('telefono');
		$rol = $this->input->post('roles');
		$cla = $this->input->post('clave');
		if ($this->input->post('activo')) {
			$act = 't';
		} else {
			$act = 'f';
		}
		$data = array(
			'ci_usuario' => $ced,
			'nombre_usuario' => $nom,
			'apellido_usuario' => $ape,
			'login_usuario' => $cor,
			'clave_usuario' => $cla,
			'status' => $act,
			'correo' => $cor,
			'telefono' => $tel,
			'id_grupo' => $rol,
			'activo' => $act,
			'verificado' => 't'
		);
		$insert = $this->usuarios->guardar($data);
		echo json_encode(array("status" => $insert));	
		// echo json_encode(array("status" => TRUE));	
	}
	public function suspender_usuario($id){
		$suspender = $this->usuarios->suspender_por_id($id);
		echo json_encode(array("status" => $suspender));
	}
	public function obtener_usuario($id){
		$query=$this->usuarios->obtener_usuario($id);
		echo json_encode($query, JSON_UNESCAPED_UNICODE);
	}
	public function actualizar_usuario(){
		$id = $this->uri->segment(3);
		$nom = $this->input->post('nombres');
		$ape = $this->input->post('apellidos');
		$tel = $this->input->post('telefono');
		$rol = $this->input->post('roles');
		$cla = $this->input->post('clave');
		if ($this->input->post('activo')) {
			$act = 't';
		} else {
			$act = 'f';
		}
		$data = array(
			'id_usuario' => $id,
			'nombre_usuario' => $nom,
			'apellido_usuario' => $ape,
			'clave_usuario' => $cla,
			'status' => $act,
			'telefono' => $tel,
			'id_grupo' => $rol,
			'activo' => $act,
			'verificado' => 't'
		);
		$update = $this->usuarios->actualizar_usuario($data);
		echo json_encode(array("status" => $update));	
	}
}