<?php
class menu_model extends CI_Model
{
	public function __construct() {
		parent::__construct();
		$this->load->model('Audit_model', 'auditoria');
		$this->auditoria->auditar();
	}
	public function get_full_menu($grupo_usuario) {
		return $this->db->query("SELECT icono,cod_menu,titulo_menu,precedencia,destino,nivel,orden,grupo,jerarquia FROM menus WHERE  nivel >= ".$grupo_usuario." AND activo ORDER BY orden,jerarquia")->result_array();
	}
	public function get_empresa() {
		return $this->db->query("SELECT id_empresa,empresa,denominacion,rif,telefono,correo,titulo FROM empresa")->result_array();
	}
	public function get_grupo_usuario() {
		$cedula = $this->session->userdata("cedula");
		$grp = $this->db->query("SELECT id_grupo FROM usuarios WHERE ci_usuario = $cedula")->result_array();
		$grupo = $grp[0]["id_grupo"];
		return $grupo;
	}
	public function get_titulo_aplicacion() {
		return  $this->db->query("SELECT titulo FROM empresa")->result_array();
	}
	public function get_pie_aplicacion() {
		return  $this->db->query("SELECT pie FROM empresa")->result_array();
	}
}