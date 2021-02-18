<?php
class Vistas_model extends CI_Model
{
	public function __construct() {
		parent::__construct();

	}
	public function obtener_vistas() {
		return $this->db->query("SELECT DISTINCT vista,alias_vista,trim(color) AS color FROM vistas_reportes ORDER BY alias_vista")->result_array();
	}
	public function obtener_campos($vista = '') {
		if ($vista == '') {
			$sql = "SELECT vista,alias_vista,campo,alias_campo,trim(color) AS color FROM vistas_reportes ORDER BY alias_vista,alias_campo";
		} else {
			"SELECT vista,alias_vista,campo,alias_campo FROM vistas_reportes ORDER BY alias_vista,alias_campo WHERE vista = '$vista'";
		}
		return $this->db->query($sql)->result_array();
	}
	public function generar_reportes($sql) {
		return $this->db->query($sql)->result_array();
	}
	/*
	public function obtener_si_no() {
		return $this->db->query("SELECT * FROM (VALUES ('SI'),('NO'))  AS si_no (si_no)")->result_array();
	}
	public function obtener_tipo_institucion() {
		return $this->db->query("SELECT tipo_institucion FROM tipo_institucion WHERE activo ORDER BY tipo_institucion");
	}
	public function obtener_tipo_comuna() {
		return $this->db->query("SELECT tipo_comuna FROM tipo_comuna WHERE activo ORDER BY tipo_comuna");
	}
	public function obtener_comuna() {
		return $this->db->query("SELECT comuna FROM comuna WHERE activo ORDER BY comuna");
	}
	public function obtener_areas_conocimiento() {
		return $this->db->query("SELECT area_conocimiento FROM areas_conocimiento WHERE activo ORDER BY area_conocimiento");
	}
	public function obtener_sub_areas_conocimiento() {
		return $this->db->query("SELECT sub_area FROM sub_areas WHERE activo ORDER BY sub_area");
	}
	public function obtener_fases() {
		return $this->db->query("SELECT fase FROM fases WHERE activo ORDER BY fase");
	}
	public function obtener_genero() {
		return $this->db->query("SELECT nombre_genero FROM genero WHERE activo ORDER BY nombre_genero");
	}
	public function obtener_estado_civil() {
		return $this->db->query("SELECT nombre_estado FROM estado_civil WHERE activo ORDER BY nombre_estado");
	}
	public function obtener_lineas_investigacion() {
		return $this->db->query("SELECT linea_investigacion FROM lineas_investigacion WHERE activo ORDER BY linea_investigacion");
	}
	public function obtener_lineas_investigacion_presidenciales() {
		return $this->db->query("SELECT nombre_lineas_presidenciales FROM lineas_presidenciales WHERE activo ORDER BY nombre_lineas_presidenciales");
	}
	public function obtener_tipo_investigacion() {
		return $this->db->query("SELECT tipo_investigacion FROM tipo_investigacion WHERE activo ORDER BY tipo_investigacion");
	}
	public function obtener_centro_salud() {
		return $this->db->query("SELECT nombre_centro FROM centro_salud WHERE activo ORDER BY nombre_centro");
	}
	public function obtener_instituto_investigacion() {
		return $this->db->query("SELECT nombre_institucion_investigacion FROM instituciones_investigacion WHERE activo ORDER BY nombre_institucion_investigacion");
	}
	public function obtener_instituto_educativo() {
		return $this->db->query("SELECT nombre_institucion_educativa FROM instituciones_educativas WHERE activo ORDER BY nombre_institucion_educativa");
	}
	public function obtener_profesion() {
		return $this->db->query("SELECT profesion FROM profesiones WHERE activo ORDER BY profesion");
	}
	public function obtener_modo_investigacion {
		return $this->db->query("SELECT modo_investigacion FROM modo_investigacion WHERE activo ORDER BY modo_investigacion");
	}
	public function obtener_politica_publica {
		return $this->db->query("SELECT politica_publica FROM politicas_publicas WHERE activo ORDER BY politica_publica");
	}
*/	
}