<?php
class Bitacora_model extends CI_Model
{
	public function __construct() {
		parent::__construct();
	}
	public function listar_auditoria_ingreso() {
		return $this->db->query("SELECT id_auditoria_acceso,login_usuario,ingreso,CASE WHEN ingresado THEN 'SI' else 'NO' END AS ingresado,salida,CASE WHEN expirado THEN 'SI' ELSE 'NO' END as expirado,status FROM audit.auditoria_acceso ORDER BY id_auditoria_acceso DESC  ");
	}

	public function listar_auditoria_eventos() {
		return $this->db->query("SELECT event_id,schema_name,table_name,relid,session_user_name,ci_usuario,nombre_usuario,action_tstamp_tx,action_tstamp_stm,action_tstamp_clk,transaction_id,application_name,client_addr,client_port,client_query,CASE WHEN action = 'U' THEN 'ACTUALIZAR' WHEN action = 'I' THEN 'INSERTAR' WHEN action = 'D' THEN 'ELIMINAR' END AS action,row_data,changed_fields FROM audit.logged_actions ORDER BY event_id DESC");
	}
	public function get_ingreso_by_id($id) {
		$q=1;
		$query = $this->db->query("SELECT id_auditoria_acceso,id_sesion,login_usuario,ingreso,CASE WHEN ingresado THEN 'SI' ELSE 'NO' END AS ingresado,salida,CASE WHEN expirado THEN 'SI' ELSE 'NO' END AS expirado,status FROM audit.auditoria_acceso WHERE id_auditoria_acceso =  $id")->row();
		return $query;
	}
	public function get_evento_by_id($id) {
		$q=1;
		$query = $this->db->query("SELECT event_id,schema_name,table_name,relid,session_user_name,ci_usuario,nombre_usuario,action_tstamp_tx,action_tstamp_stm,action_tstamp_clk,transaction_id,application_name,client_addr,client_port,client_query,CASE WHEN action = 'U' THEN 'ACTUALIZAR' WHEN action = 'I' THEN 'INSERTAR' WHEN action = 'D' THEN 'ELIMINAR' END AS action,row_data,changed_fields FROM audit.logged_actions WHERE event_id = $id")->row();
		return $query;
	}
}
