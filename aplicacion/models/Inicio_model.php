<?php
class inicio_model extends CI_Model
{
	public function __construct() {
		parent::__construct();
		$this->load->model('Audit_model', 'auditoria');
		$this->auditoria->auditar();
	}
	public function verificar_registro() {
		$cedula=$this->session->userdata("cedula");
		$sql = "SELECT count(*) AS cant FROM investigadores WHERE ci_investigador = $cedula";
		$query = $this->db->query($sql)->row_array();
		return $query;
	}
	public function verificar_investigador() {
		$cedula=$this->session->userdata("cedula");
		$sql = "SELECT count(*) AS cant FROM perfil_investigador WHERE ci_investigador = $cedula";
		$query = $this->db->query($sql)->row_array();
		return $query;
	}	
	public function verificar_investigacion() {
		$cedula=$this->session->userdata("cedula");
		$sql = "SELECT count(*) AS cant FROM trayectoria WHERE ci_investigador = $cedula";
		$query = $this->db->query($sql)->row_array();
		return $query;
	}
	public function verificar_investigacion_actual() {
		$cedula=$this->session->userdata("cedula");
		$sql = "SELECT count(*) AS cant FROM investigacion_actual WHERE ci_investigador = $cedula";
		$query = $this->db->query($sql)->row_array();
		return $query;
	}
}