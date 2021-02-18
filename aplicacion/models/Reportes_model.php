<?php
class Reportes_model extends CI_Model
{
	public function __construct() {
		parent::__construct();

	}
	public function obtener_registros($fini,$ffin) {
		return $this->db->query("SELECT a.id_investigador,a.ci_investigador,a.pnombre,a.snombre,a.papellido,a.sapellido,a.nombre_genero,a.fecha_nac,a.nombre_estado,a.estado,a.municipio,a.parroquia,a.codigo_postal,a.telefono,a.celular,a.correo,a.profesion,a.tipo_institucion,a.nombre_institucion,a.modo_investigacion,UPPER(b.linea_inv1) AS linea_inv1,UPPER(b.linea_inv2) AS linea_inv2,UPPER(b.linea_inv3) AS linea_inv3,UPPER(c.linea_act1) AS linea_act1,UPPER(c.linea_act2) AS linea_act2,UPPER(c.linea_act3) AS linea_act3,a.activo,a.fecha_creacion FROM v_investigadores a LEFT JOIN vinteres_investigacion b ON b.ci_investigador = a.ci_investigador LEFT JOIN vinvestigacion_actual1 c on c.ci_investigador = a.ci_investigador WHERE a.activo = 'ACTIVO' AND fecha_creacion::date >=to_date('$fini','YYYY-MM-DD') and fecha_creacion::date <= to_date('$ffin','YYYY-MM-DD')")->result();
	}
	public function obtener_investigador($fini,$ffin) {
		return $this->db->query("SELECT a.ci_investigador,a.pnombre,a.snombre,a.papellido,a.sapellido,a.rif_investigador,a.nivel_academico,a.estatus_academico,a.nombre_institucion_educativa,a.nombre_especialidad_salud,a.area_conocimiento,a.sub_area,a.consigno_cedula,a.consigno_rif,a.consigno_foto,a.consigno_titulo,a.activo,a.fecha_creacion FROM vperfil_investigador a WHERE a.activo = 'SI' AND fecha_creacion::date >=to_date('$fini','YYYY-MM-DD') and fecha_creacion::date <= to_date('$ffin','YYYY-MM-DD')")->result();
	}
	public function obtener_investigacion($fini,$ffin) {
		return $this->db->query("SELECT a.ci_investigador,a.impacto_politica_publica,a.politica_publica,a.linea_investigacion,a.tipo_investigacion,a.fase,a.tipo_institucion,a.centro,a.titulo_investigacion,a.fecha_culminacion,a.objetivo_investigacion,a.resultado_investigacion,a.publicada,a.link_publicacion,a.tiempo_investigacion,a.activo,a.fecha_registro FROM vperfil_investigacion a WHERE a.activo = 'SI' AND fecha_registro::date >=to_date('$fini','YYYY-MM-DD') and fecha_registro::date <= to_date('$ffin','YYYY-MM-DD')")->result();
	}	
	public function obtener_actual($fini,$ffin) {
		$sql = "SELECT a.id_investigacion_actual,a.ci_investigador,a.titulo_investigacion,a.tipo_institucion,a.centro,a.linea_investigacion,a.resultado_investigacion,a.tipo_investigacion,a.fase,a.tiempo_investigacion,a.objetivo_investigacion,a.institucion_etica,a.impacto_investigacion,a.publicado,a.enlace_publicacion,a.activo,a.fecha_registro FROM vinvestigacion_actual a WHERE a.activo = 'SI' AND fecha_registro::date >=to_date('$fini','YYYY-MM-DD') and fecha_registro::date <= to_date('$ffin','YYYY-MM-DD')";
		return $this->db->query($sql)->result();
	}
}