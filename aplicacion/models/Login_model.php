<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function get_empresa() {
		return $this->db->query("SELECT titulo FROM empresa")->result_array();
	}
	public function clave_default() {
		$clave = $this->db->query("SELECT clave FROM empresa")->result_array();
		return  md5($clave[0]["clave"]);

	}	
	public function login($usuario,$clave) {
		$clv = $clave;
		$clave = md5($clave);
		$this->db->where('login_usuario',$usuario);
		$this->db->where('clave_usuario',$clave);
		$ip = $_SERVER['REMOTE_ADDR'];
		$resultados = $this->db->get('usuarios');
		$sql = "SELECT * FROM usuarios WHERE login_usuario = '$usuario' AND clave_usuario = '$clave'";
		if($resultados->num_rows()>0) {
			$datos = $resultados->row_array();
			if (!($this->session->userdata("anio_ant"))) {
				$this->session->unset_userdata("anio_ant");
			}
			if (!($this->session->userdata("usuario"))) {
				$this->session->unset_userdata("usuario");
			}
			if (!($this->session->userdata("activo"))) {
				$this->session->unset_userdata("activo");
			}
			if (!($this->session->userdata("cedula"))) {
				$this->session->unset_userdata("cedula");
			}
			if (!($this->session->userdata("verificado"))) {
				$this->session->unset_userdata("verificado");
			}
			if (!($this->session->userdata("nombre"))) {
				$this->session->unset_userdata("nombre");
			}
			if (!($this->session->userdata("id_usuario"))) {
				$this->session->unset_userdata("id_usuario");
			}
			if (!($this->session->userdata("rol_usuario"))) {
				$this->session->unset_userdata("rol_usuario");
			}
			$this->session->set_userdata('usuario',$usuario);
			$this->session->set_userdata('activo',$datos['activo']);
			$this->session->set_userdata('cedula',$datos['ci_usuario']);
			$this->session->set_userdata('verificado',$datos['verificado']);
			$this->session->set_userdata('nombre',$datos['nombre_usuario'].' '.$datos['apellido_usuario']);
			$this->session->set_userdata('id_usuario',$datos['id_usuario']);
			$this->session->set_userdata('rol_usuario',$datos['id_grupo']);
			return true;
		} else {
			$this->db->where('login_usuario',$usuario);
			$res = $this->db->get('usuarios');
			$this->db->query($sql);			
			return false;
		}
	}
	public function obtener_usuario() {
		$usuario = $this->session->userdata('usuario');
		$consulta = $this->db->query("SELECT ci_usuario,nombre_usuario FROM usuarios WHERE login_usuario = '$usuario'");
		$fila = $consulta->row_array();
		return $fila["nombre_usuario"];
	}
	public function registrar_ingreso($id_sesion,$login_usuario,$ingresado,$status) {
		$sql = "INSERT INTO audit.auditoria_acceso (id_sesion,login_usuario,ingresado,status) VALUES ('$id_sesion','$login_usuario','$ingresado','$status')";	
		$this->db->query($sql);
		return true;
	}
	public function registrar_salida() {
		$id_sesion = "'".$this->session->userdata('id_sesion')."'";
		$salida = date('Y-m-d H:i:s');
		$sql = "UPDATE audit.auditoria_acceso SET salida = '$salida'  WHERE id_sesion = $id_sesion";	
		$this->db->query($sql);
		return true;
	}

	public function salir() {
		// $usuario = $this->session->userdata('usuario');
		// $ci_usuario = $this->session->userdata('cedula');
		// $nombre_usuario = $this->session->userdata('nombre_usuario');		
		// $ip = $_SERVER['REMOTE_ADDR'];
		// $sql = "INSERT INTO login (ip,ci_usuario,login_usuario,nombre_usuario,accion,exito) VALUES ('".$ip."',".$ci_usuario.",'".$usuario."','".$nombre_usuario."','S','t')";
		// $this->db->query($sql);
		return true;
	}
}

/* End of file usuario_model.php */
/* Location: .//C/xampp/htdocs/tema/aplicacion/models/usuario_model.php */