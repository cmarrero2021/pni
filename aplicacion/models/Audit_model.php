<?php
class Audit_model extends CI_Model
{
	public function __construct() {
		parent::__construct();
	}
	public function auditar() {
		if (null != $this->session->userdata('usuario')) {
			$usuario = $this->session->userdata('usuario');
			$ci_usuario = $this->session->userdata('cedula');
			$nombre_usuario = $this->session->userdata('nombre');
			$titulo = $this->session->userdata('titulo');
			$this->db->query("SET application_name TO '".$titulo."'");
			$this->db->query('SET session "pni.user" = "'.$usuario.'" ');
			$this->db->query('SET session "pni.ci_usuario" = "'.$ci_usuario.'"');
			$this->db->query('SET session "pni.nombre_usuario" = "'.$nombre_usuario.'"');
		} else {
			$this->db->query("SET application_name TO 'Aplicacion'");
			$this->db->query('SET session "pni.user" = "anónimo" ');
			$this->db->query('SET session "pni.ci_usuario" = 0');
			$this->db->query('SET session "pni.nombre_usuario" = "ANÓNIMO" ');
		}
		$this->db->query('SET session "pni.ip" = "'.$_SERVER['REMOTE_ADDR'].'" ');		
	}
}
?>
