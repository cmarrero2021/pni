<?php
class Usuarios_model extends CI_Model
{
	public function __construct() {
		// parent::__construct();
		// $this->load->model('Audit_model', 'auditoria');
		// $this->auditoria->auditar();
	}
	public function listar_usuarios() {
		return $this->db->query("SELECT a.id_usuario,a.ci_usuario,a.nombre_usuario,a.apellido_usuario,a.login_usuario,a.telefono_usuario,case when a.id_grupo = 1 then 'ADMINISTRADOR' when a.id_grupo = 2 then 'SUPERVISOR' when a.id_grupo = 3 then 'USUARIO' end as id_grupo ,case when a.activo then 'SI' else 'NO' end as activo,a.fecha_creacion FROM usuarios a ORDER BY a.id_usuario");
	}
	public function obtener_roles() {
		$query = $this->db->query("SELECT id_rol,nombre_rol FROM roles ORDER BY id_rol DESC")->result_array();
		$roles=array();
		foreach ($query as $r) {
			$roles[$r["id_rol"]] = $r['nombre_rol'];	
		}
		return $roles;
	}
	public function guardar($data)	{
		$ced = $data["ci_usuario"];
		$nom = "'".$data["nombre_usuario"]."'";
		$ape = "'".$data["apellido_usuario"]."'";
		$cor = "'".$data["login_usuario"]."'";
		$cla = "'".md5($data["clave_usuario"])."'";
		$act = "'".$data["status"]."'";
		$cor = "'".$data["correo"]."'";
		$tel = "'".$data["telefono"]."'";
		$rol = $data["id_grupo"];
		$act = "'".$data["activo"]."'";
		$ver = "'".$data["verificado"]."'";
		$sql = "INSERT INTO usuarios (ci_usuario,nombre_usuario,apellido_usuario,login_usuario,clave_usuario,status,correo_usuario,telefono_usuario,id_grupo,activo,verificado) VALUES ($ced,$nom,$ape,$cor,$cla,$act,$cor,$tel,$rol,$act,$ver)";
		if ($nom !='') {
			$query = $this->db->query($sql);
		}
		if ($query) {
			return true;
		} else {
			return true;
		}
	}
	public function actualizar_usuario($data)	{
		$pepe = print_r($data,true);
		$id = $data["id_usuario"];
		$nom = "'".$data["nombre_usuario"]."'";
		$ape = "'".$data["apellido_usuario"]."'";
		$act = "'".$data["status"]."'";
		$tel = "'".$data["telefono"]."'";
		$rol = $data["id_grupo"];
		$act = "'".$data["activo"]."'";
		$ver = "'".$data["verificado"]."'";
		$sql = "UPDATE usuarios SET nombre_usuario=$nom,apellido_usuario=$ape,status=$act,telefono_usuario=$tel,id_grupo=$rol,activo=$act,verificado=$ver WHERE id_usuario = $id";
		if ($nom !='') {
			$query = $this->db->query($sql);
		}
		if ($query) {
			return true;
		} else {
			return true;
		}
	}
	public function suspender_por_id($id) {
		$query = $this->db->query("UPDATE usuarios SET activo = 'f',status = 'f' WHERE id_usuario = $id");
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	public function obtener_usuario($id) {
		$query = $this->db->query("SELECT a.id_usuario,a.ci_usuario,a.nombre_usuario,a.apellido_usuario,a.login_usuario,a.telefono_usuario,a.id_grupo,a.activo FROM usuarios a WHERE a.id_usuario = $id ORDER BY a.id_usuario")->row();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}
	public function actualizar($where, $data) {
		$this->db->update("destinos", $data, $where);
		return true;
	}
	public function auditoria() {
		$usuario = $this->session->userdata('usuario');
		$this->db->query("SET application_name TO 'Sistema de Control de Visitas'");
		$this->db->query('SET session "scv.user" = "'.$usuario.'" ');
		$this->db->query('SET session "scv.ip" = "'.$_SERVER['REMOTE_ADDR'].'" ');		

	}	
}