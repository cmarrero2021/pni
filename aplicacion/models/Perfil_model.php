<?php
class perfil_model extends CI_Model
{
	public function __construct() {
		parent::__construct();
		$this->load->model('Audit_model', 'auditoria');
		$this->auditoria->auditar();
	}
	public function get_niveles() {
		$sql = "SELECT id_nivel_academico,nivel_academico FROM nivel_academico WHERE activo ORDER BY id_nivel_academico ASC";
		return $this->db->query($sql)->result_array();
	}
	public function get_estatus() {
		$sql = "SELECT id_estatus_academico,estatus_academico FROM estatus_academico WHERE activo ORDER BY id_estatus_academico ASC";
		return $this->db->query($sql)->result_array();
	}
	public function get_institucion_educativa() {
		$sql = "SELECT id_institucion_educativa,nombre_institucion_educativa FROM instituciones_educativas WHERE activo ORDER BY nombre_institucion_educativa ASC";
		return $this->db->query($sql)->result_array();
	}
	public function get_edo_mun_par_por_centro($centro) {
		$sql = "SELECT a.cod_estado,a.cod_municipio,a.cod_parroquia,b.nombre_estado,c.nombre_municipio,d.nombre_parroquia FROM centros_salud a LEFT JOIN estados_salud b ON b.cod_estado = a.cod_estado AND a.cod_centro_salud = $centro LEFT JOIN municipios_salud c ON c.cod_estado = a.cod_estado AND c.cod_municipio = a.cod_municipio AND a.cod_centro_salud = $centro LEFT JOIN parroquias_salud d ON d.cod_estado = a.cod_estado AND d.cod_municipio = a.cod_municipio AND d.cod_parroquia = a.cod_parroquia AND a.cod_centro_salud = $centro WHERE a.cod_centro_salud = $centro";
		return $this->db->query($sql)->result_array();
	}
	public function listar_investigaciones_actuales($cedula) {
		$sql = "SELECT * FROM vinvestigacion_actual WHERE ci_investigador = $cedula ORDER BY id_investigacion_actual";
		return $this->db->query($sql);
	}
	public function get_nombre_salud($cod_centro) {
		$sql = "SELECT nombre_centro FROM centros_salud WHERE cod_centro_salud = $cod_centro";
		return $this->db->query($sql)->result_array();
	}
	public function get_datos_comuna($id_comuna) {
		$sql = "SELECT id_tipo_comuna FROM comunas WHERE id_comuna = $id_comuna";
		return $this->db->query($sql)->result_array();
	}
	public function suspender_investigacion($id) {
		$sql = "UPDATE perfil_investigacion SET activo = 'f' WHERE id_perfil_investigacion = $id";
		$query = $this->db->query($sql);
		if ($query) {
			return true;
		} else {
			return flase;
		}
	}
	public function get_especialidad_salud() {
		$sql = "SELECT id_especialidad_salud,nombre_especialidad_salud FROM especialidades_salud WHERE activo ORDER BY nombre_especialidad_salud ASC";
		return $this->db->query($sql)->result_array();
	}
	public function get_areas() {
		$sql = "SELECT id_area_conocimiento,area_conocimiento FROM areas_conocimiento WHERE activo ORDER BY area_conocimiento ASC";
		return $this->db->query($sql)->result_array();
	}
	public function get_sub_areas($id_area) {
		$sql = "SELECT * FROM ((SELECT * FROM sub_areas WHERE id_area = $id_area AND sub_area LIKE 'OTRAS%') UNION (SELECT * FROM sub_areas WHERE id_area = $id_area AND sub_area not LIKE 'OTRAS%' ORDER BY sub_area) ) AS t ORDER BY CASE WHEN sub_area LIKE 'OTRAS%' THEN 1 ELSE 2 END";
		return $this->db->query($sql)->result_array();
	}
	public function get_tiempo_investigacion() {
		$sql = "SELECT id_tiempo_investigacion,tiempo_investigacion FROM tiempo_investigacion ORDER BY id_tiempo_investigacion ASC";
		return $this->db->query($sql)->result_array();
	}
	public function get_munsalud($estado) {
		$sql = "SELECT cod_municipio,nombre_municipio FROM municipios_salud WHERE cod_estado = $estado ORDER BY nombre_municipio ASC";
		return $this->db->query($sql)->result_array();
	}
	public function get_ficha_proyecto($id) {
		$sql = "SELECT a.id_perfil_investigacion,a.ci_investigador,CASE WHEN a.politica_publica THEN 'SI' ELSE 'NO' END AS pol_pub,b.politica_publica,c.linea_investigacion,d.tipo_investigacion,e.fase,g.tipo_institucion,h.nombre_centro,i.nombre_institucion_educativa,j.nombre_institucion_investigacion,k.comuna,a.titulo_investigacion,a.fecha_culminacion,a.objetivo_investigacion,a.resultado_investigacion,cASE WHEN a.publicada THEN 'SI' ELSE 'NO' END AS publicada,a.link_publicacion,a.tiempo_investigacion,f.unidad_tiempo FROM perfil_investigacion a LEFT JOIN politicas_publicas b ON b.id_politica_publica = a.id_politica_publica LEFT JOIN lineas_investigacion c ON c.id_linea_investigacion = a.id_linea_investigacion LEFT JOIN tipo_investigacion d ON d.id_tipo_investigacion = a.id_tipo_investigacion LEFT JOIN fases e ON e.id_fase = a.id_fase LEFT JOIN unidades_tiempo f ON f.id_unidad_tiempo = a.id_unidad_tiempo LEFT JOIN tipo_institucion g ON g.id_tipo_institucion = a.id_tipo_institucion LEFT JOIN centros_salud h ON h.cod_centro_salud = a.id_centro LEFT JOIN instituciones_educativas i ON i.id_institucion_educativa = a.id_centro LEFT JOIN instituciones_investigacion j ON j.id_institucion_investigacion = a.id_centro LEFT JOIN comunas k ON k.id_comuna = a.id_centro WHERE a.activo AND a.id_perfil_investigacion = $id";
		return $this->db->query($sql)->result_array();
	}
	public function get_responsables_investigacion($id) {
		$sql = "SELECT DISTINCT ci_responsable_investigacion,nombre_responsable_investigacion,apellido_responsable_investigacion FROM responsables_investigacion WHERE activo AND id_investigacion = $id ORDER BY ci_responsable_investigacion";
		return $this->db->query($sql)->result_array();
	}
	public function get_parsalud($estado,$municipio) {
		$sql = "SELECT cod_parroquia,nombre_parroquia FROM parroquias_salud WHERE cod_estado = $estado AND cod_municipio = $municipio ORDER BY nombre_parroquia ASC";
		return $this->db->query($sql)->result_array();
	}
	public function get_censalud($estado,$municipio,$parroquia) {
		$sql = "SELECT cod_centro_salud,nombre_centro FROM centros_salud WHERE cod_estado = $estado AND cod_municipio = $municipio AND cod_parroquia = $parroquia ORDER BY nombre_centro ASC";
		return $this->db->query($sql)->result_array();
	}
	public function get_comuna($tipo) {
		$sql = "SELECT id_comuna,comuna FROM comunas WHERE id_tipo_comuna = $tipo ORDER BY comuna ASC";
		return $this->db->query($sql)->result_array();
	}
	public function select_sencillo($tabla,$id,$valor,$orden=0) {
		if ($orden == 0) {
			$sql = "SELECT $id,$valor FROM $tabla ORDER BY $id ASC";
		} else {
			$sql = "SELECT $id,$valor FROM $tabla ORDER BY $valor ASC";
		}
		return $this->db->query($sql)->result_array();
	}
	public function buscar_investigador($cedula,$campo = "") {
		if ($campo=="") {
			return $this->db->query("SELECT a.ci_investigador,a.pnombre,a.snombre,a.papellido,a.sapellido,a.id_genero,a.fecha_nac,a.id_civil,a.id_estado,a.id_municipio,a.id_parroquia,a.id_zona,a.telefono,a.celular,a.correo,a.id_profesion,a.id_tipo_institucion,a.nombre_institucion,a.id_modo_investifgacion,a.interes_inv,a.inv_actual FROM investigadores a WHERE ci_investigador = '$cedula'")->row_array();
		} else {
			return $this->db->query("SELECT $campo FROM investigadores a WHERE ci_investigador = '$cedula'")->row_array();				
		}
	}
	public function buscar_usuario($cedula) {
		$sql = "SELECT ci_usuario as ci_investigador,nombre_usuario as pnombre,'' as snombre,apellido_usuario as papellido,'' as sapellido,0 as id_genero,'' as fecha_nac,0 as id_civil,0 as id_estado,0 as id_municipio,0 as id_parroquia,0 as id_zona,'' as telefono,'' as celular,login_usuario as correo,0 as id_profesion,0 as id_tipo_institucion,'' as nombre_institucion,0 as id_modo_investifgacion,'' as interes_inv,'' as inv_actual FROM usuarios WHERE ci_usuario = '$cedula'";
		return $this->db->query($sql)->row_array();
	}
	public function get_profesion_salud($cedula) {
		$query = $this->db->query("SELECT COUNT(ci_investigador) AS cant FROM investigadores WHERE ci_investigador = $cedula AND id_profesion IN (SELECT id_profesion FROM profesiones WHERE salud)")->row_array();
		if ($query["cant"]!= 0) {
			return 1;
		} else {
			return 0;
		}
	}
	public function verificar_rif($arif) {
		$rif = $arif["rif"];
		$sql = "SELECT COUNT(rif_investigador) AS cant FROM perfil_investigador WHERE rif_investigador = '$rif' AND activo";
		$query = $this->db->query($sql)->row_array();
		return $query["cant"];
	}
	public function buscar_tiempo(){
		$cedula = $this->session->userdata("cedula");
		$sql = "SELECT id_tiempo_investigacion FROM trayectoria WHERE ci_investigador = $cedula";
		return $this->db->query($sql)->result_array();
	}
	public function buscar_cantidad(){

		$cedula = $this->session->userdata("cedula");
		$sql = "SELECT id_cantidad_investigacion FROM trayectoria WHERE ci_investigador = $cedula";
		return $this->db->query($sql)->result_array();
	}
	public function buscar_grupo(){
		$cedula = $this->session->userdata("cedula");
		$sql = "SELECT DISTINCT a.ci_investigador,b.grupo FROM investigadores a,lineas_presidenciales b WHERE b.id_lineas_presidenciales=ANY(interes_inv::integer[]) AND  ci_investigador = $cedula";
		return $this->db->query($sql)->result_array();
	}
	public function get_perfil_investigador($cedula) {
		$sql = "SELECT id_perfil_investigador,ci_investigador,rif_investigador,id_nivel_academico,id_estatus_academico,id_institucion_educativa,id_especialidad_salud,id_area_conocimiento,id_sub_area FROM perfil_investigador WHERE activo and ci_investigador = $cedula";
		return $this->db->query($sql)->row_array();
	}
	public function get_perfil_profesional($cedula) {
		$sql = "SELECT id_perfil_investigador,ci_investigador,rif_investigador,id_nivel_academico,id_estatus_academico,id_institucion_educativa,id_especialidad_salud,id_area_conocimiento,id_sub_area FROM perfil_investigador WHERE activo and ci_investigador = $cedula";
		return $this->db->query($sql)->row_array();
	}
	public function listar_investigaciones() {
		$cedula = $this->session->userdata("cedula");
		$sql = "SELECT a.id_perfil_investigacion,a.titulo_investigacion,a.fecha_culminacion,a.resultado_investigacion,CASE WHEN a.politica_publica THEN 'SI' ELSE 'NO' END AS cpolitica_publica,b.politica_publica,c.linea_investigacion,a.objetivo_investigacion,d.tipo_investigacion,e.fase,a.tiempo_investigacion || ' ' || f.unidad_tiempo as tiempo FROM Perfil_investigacion a LEFT JOIN politicas_publicas b ON b.id_politica_publica = a.id_politica_publica LEFT JOIN lineas_investigacion c ON c.id_linea_investigacion = a.id_linea_investigacion LEFT JOIN tipo_investigacion d ON d.id_tipo_investigacion = a.id_tipo_investigacion LEFT JOIN fases e ON e.id_fase = a.id_fase LEFT JOIN unidades_tiempo f ON f.id_unidad_tiempo = a.id_unidad_tiempo WHERE a.activo AND a.ci_investigador = $cedula";
		return $this->db->query($sql);
	}
	public function buscar_responsables($cedula) {
		$sql = "SELECT pnombre,papellido FROM investigadores WHERE activo AND ci_investigador = $cedula";
		$query = $this->db->query($sql)->row_array();
		if ($query) {
			return $query;
		} else {
			$sql = "SELECT cedula,primer_nombre as pnombre,primer_apellido as papellido FROM renac WHERE cedula = $cedula";
			$cons = $this->db->query($sql)->row_array();
			$fil = count($cons);
			if ($fil!= 0) {
				return $cons;
			} else {
				$sql = "SELECT '' AS cedula,'' AS pnombre,'' AS papellido";
				$cons1 = $this->db->query($sql)->row_array();
				return $cons1;
			}

		}
	}
	public function agregar_perfl_investigador($perfil) {
		$cedula=$perfil["cedula"];
		$rif=$perfil["rif"];
		$niveles=$perfil["niveles"];
		$estatus=$perfil["estatus"];
		$institucion_educativa=$perfil["institucion_educativa"];
		if (array_key_exists("especialidad", $perfil) && strlen($perfil["especialidad"] > 0)) {
			$especialidad=$perfil["especialidad"];	
		} else {
			$especialidad=0;
		}
		$areas=$perfil["areas"];
		$sub_areas=$perfil["sub_areas"];
		$area_conocimiento_tsu=$perfil["area_conocimiento_tsu"];
		$img_cedula = $perfil["img_cedula"]==1 ? 't' : 'f';
		$img_rif = $perfil["img_rif"] == 1 ? 't' : 'f';
		$img_foto = $perfil["img_foto"] == 1 ? 't' : 'f';
		$img_titulo = $perfil["img_titulo"] == 1 ? 't' : 'f';
		switch ($niveles) {
			case 3:
			$sql = "INSERT INTO perfil_investigador (ci_investigador,rif_investigador,id_nivel_academico,id_estatus_academico,id_institucion_educativa,id_area_conocimiento,id_sub_area,consigno_cedula,consigno_rif,consigno_foto,consigno_titulo) VALUES ($cedula,'$rif',$niveles,$estatus,$institucion_educativa,$areas,$sub_areas,'$img_cedula','$img_rif','$img_foto','$img_titulo')"				;			
			break;
			case 4:
			if (array_key_exists("especialidad", $perfil)) {
				$sql = "INSERT INTO perfil_investigador (ci_investigador,rif_investigador,id_nivel_academico,id_estatus_academico,id_institucion_educativa,id_especialidad_salud,id_area_conocimiento,id_sub_area,consigno_cedula,consigno_rif,consigno_foto,consigno_titulo) VALUES ($cedula,'$rif',$niveles,$estatus,$institucion_educativa,$especialidad,$areas,$sub_areas,'$img_cedula','$img_rif','$img_foto','$img_titulo')";
			} else {
				$sql = "INSERT INTO perfil_investigador (ci_investigador,rif_investigador,id_nivel_academico,id_estatus_academico,id_institucion_educativa,id_area_conocimiento,id_sub_area,consigno_cedula,consigno_rif,consigno_foto,consigno_titulo) VALUES ($cedula,'$rif',$niveles,$estatus,$institucion_educativa,$areas,$sub_areas,'$img_cedula','$img_rif','$img_foto','$img_titulo')";
			}
			break;
			default:
			$sql = "INSERT INTO perfil_investigador (ci_investigador,rif_investigador,id_nivel_academico,id_estatus_academico,consigno_cedula,consigno_rif,consigno_foto) VALUES ($cedula,'$rif',$niveles,$estatus,'$img_cedula','$img_rif','$img_foto')";
			break;
		}
		$query = $this->db->query($sql);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	public function actualizar_perfl_investigador($perfil) {
		$cedula=$perfil["cedula"];
		$rif=$perfil["rif"];
		$niveles=$perfil["niveles"];
		$estatus=$perfil["estatus"];
		$institucion_educativa=$perfil["institucion_educativa"];
		if (array_key_exists("especialidad", $perfil) && strlen($perfil["especialidad"] > 0)) {
			$especialidad=$perfil["especialidad"];	
		} else {
			$especialidad=0;
		}
		$areas=$perfil["areas"];
		$sub_areas=$perfil["sub_areas"];
		$area_conocimiento_tsu=$perfil["area_conocimiento_tsu"];
		$img_cedula = $perfil["img_cedula"]==1 ? 't' : 'f';
		$img_rif = $perfil["img_rif"] == 1 ? 't' : 'f';
		$img_foto = $perfil["img_foto"] == 1 ? 't' : 'f';
		$img_titulo = $perfil["img_titulo"] == 1 ? 't' : 'f';
		switch ($niveles) {
			case 3:
			$sql = "UPDATE perfil_investigador SET rif_investigador='$rif',id_nivel_academico=$niveles,id_estatus_academico=$estatus,id_institucion_educativa=$institucion_educativa,consigno_cedula='$img_cedula',consigno_rif='$img_rif',consigno_foto='$img_foto',consigno_titulo='$img_titulo' WHERE activo AND ci_investigador = $cedula";
			break;
			case 4:
			if (array_key_exists("especialidad", $perfil)) {
				$sql = "UPDATE perfil_investigador SET rif_investigador='$rif',id_nivel_academico=$niveles,id_estatus_academico=$estatus,id_institucion_educativa=$institucion_educativa,id_especialidad_salud=$especialidad,id_area_conocimiento=$areas,id_sub_area=$sub_areas,consigno_cedula='$img_cedula',consigno_rif='$img_rif',consigno_foto='$img_foto',consigno_titulo='$img_titulo' WHERE activo AND ci_investigador=$cedula";
			} else {
				$sql = "UPDATE perfil_investigador SET rif_investigador='$rif',id_nivel_academico=$niveles,id_estatus_academico=$estatus,id_institucion_educativa=$institucion_educativa,id_area_conocimiento=$areas,id_sub_area=$sub_areas,consigno_cedula='$img_cedula',consigno_rif='$img_rif',consigno_foto='$img_foto',consigno_titulo='$img_titulo' WHERE activo AND ci_investigador=$cedula";
			}
			break;
			default:
			$sql = "UPDATE perfil_investigador SET rif_investigador = '$rif',id_nivel_academico = $niveles,id_estatus_academico = $estatus,consigno_cedula = '$img_cedula',consigno_rif = '$img_rif',consigno_foto = '$img_foto' WHERE activo AND ci_investigador = $cedula";
			break;
		}
		$query = $this->db->query($sql);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	public function registrar_trayectoria($datos) {
		$tiempo = $datos["ti"];
		$cuantas = $datos["ci"];
		$cedula = $this->session->userdata("cedula");
		$sql = "SELECT * FROM trayectoria WHERE ci_investigador = $cedula";
		$trayectoria = $this->db->query($sql)->num_rows();
		if($trayectoria ==0) {
			$query = $this->db->query("INSERT INTO trayectoria (ci_investigador,id_tiempo_investigacion,id_cantidad_investigacion) VALUES ($cedula,".$datos["ti"].",".$datos["ci"].")");
			return $query;
		} else {
			return false;
		}
	}
	public function registrar_investigacion($datos) {
		$cedula = $this->session->userdata("cedula");
		$apl = $datos["apl_pol_pub"]=='true'?true:false;
		if ($apl) {
			$campo1 = ",id_politica_publica,";
			$valor1 = ",".$this->db->escape($datos["pol_pub"]).",";
		} else {
			$campo1 = ",";
			$valor1 = ",";
		}
		switch ($datos["tip_inst"]) {
			case 1:
			$campo2 = ",id_centro,";
			$valor2 = ",".$this->db->escape($datos["centro"]).",";
			break;
			case 4:
			$campo2 = ",id_centro,";
			$valor2 = ",".$this->db->escape($datos["comuna"]).",";
			break;
			default:
			$campo2 = ",id_centro,";
			$valor2 = ",".$this->db->escape($datos["cen_salud"]).",";
			break;
		}
		$sql = 'INSERT INTO perfil_investigacion (ci_investigador,politica_publica'.$campo1.'id_linea_investigacion'.$campo2.'id_tipo_investigacion,id_fase,id_tipo_institucion,titulo_investigacion,fecha_culminacion,publicada,link_publicacion,objetivo_investigacion,resultado_investigacion,tiempo_investigacion,id_unidad_tiempo) VALUES ('.
		$this->db->escape($cedula).",".$this->db->escape($datos["apl_pol_pub"]).$valor1.$this->db->escape($datos["linea_investigacion"]).$valor2.$this->db->escape($datos["tipo_investigacion"]).",".$this->db->escape($datos["fase"]).",".$this->db->escape($datos["tip_inst"]).",".$this->db->escape($datos["titulo_investigacion"]).",".$this->db->escape($datos["fecha_culminacion"]).",".$this->db->escape($datos["publicada"]).",".$this->db->escape($datos["enlace_publicacion"]).",".$this->db->escape($datos["objetivo_investigacion"]).",".$this->db->escape($datos["resultado_investigacion"]).",".$this->db->escape($datos["tiempo_dinvestigacion"]).",".$this->db->escape($datos["unidad_tiempo"]).')';
		$this->db->trans_start();
		$query = $this->db->query($sql);
		$aultimo = $this->db->insert_id('perfil_investigacion_id_perfil_investigacion_seq');
		foreach ($datos["responsables"] as $r) {
			$data = array(
				'id_investigacion' => $aultimo,
				'ci_responsable_investigacion' => $r["cedula"],
				'nombre_responsable_investigacion' => $r["nombre"],
				'apellido_responsable_investigacion' => $r["apellido"]
			);
			$this->db->insert("responsables_investigacion",$data);
		}
		$sql = "SELECT * FROM trayectoria WHERE ci_investigador = $cedula";
		$trayectoria = $this->db->query($sql)->num_rows();
		if($trayectoria ==0) {
			$datos = array (
				'ci_investigador' => $cedula,
				'id_tiempo_investigacion' => $datos["tiempo_investigacion"],
				'id_cantidad_investigacion' => $datos["cantidad_investigacion"]
			);
			$this->db->insert("trayectoria",$datos);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status !== false) {
			return true;
		} else {
			return false;
		}
	}
	public function registrar_investigacion_act($datos) {
		$cedula = $this->session->userdata("cedula");
		$sql = "SELECT count(*) FROM investigacion_actual WHERE ci_investigador = $cedula";
		$prev = $this->db->query($sql)->result_array();
		//Descomentar; evita que e cargue la investigación actual varias veces
		// if ($prev[0]["count"]==0) {
		if ($datos["centro"] !== "0" || $datos["cen_salud"] !== "0" || $datos["comuna"] !== "0" ) {
			$campo_centro = ",id_centro,";
			if ($datos["centro"]!== "0") {
				$val_centro=",".$datos["centro"].",";
			} else if ($datos["cen_salud"]!== "0") {
				$val_centro=",".$datos["cen_salud"].",";
			} else if ($datos["comuna"]!== "0") {
				$val_centro=",".$datos["comuna"].",";
			}
		} else {
			$campo_centro = "";
			$val_centro = "";
		}
		if ($datos["tiempo_investigacion"]!== "0" || $datos["tiempo_investigacione"]!== "0" ) {
			$campo_tiempo = ",tiempo_investigacion,";
			if ($datos["tiempo_investigacion"]!== "0") {
				$val_tiempo=",".$datos["tiempo_investigacion"].",";
			} else if ($datos["tiempo_investigacione"]!== "0") {
				$val_tiempo=",".$datos["tiempo_investigacione"].",";
			} 
		} else {
			$campo_tiempo = "";
			$val_tiempo = "";
		}
		if ($datos["unidad_tiempo"]!== "0" || $datos["unidad_tiempoe"]!== "0" ) {
			$campo_unidad = ",id_unidad_tiempo,";
			if ($datos["unidad_tiempo"]!== "0") {
				$val_unidad=",".$datos["unidad_tiempo"].",";
			} else if ($datos["unidad_tiempoe"]!== "0") {
				$val_unidad=",".$datos["unidad_tiempoe"].",";
			} 
		} else {
			$campo_unidad = "";
			$val_unidad = "";
		}
		if ($datos["com_etica"]!== "0" || $datos["com_eticac"]!== "0" ) {
			$campo_com_etica = ",id_com_etica,";
			if ($datos["com_etica"]!== "0") {
				$val_com_etica=",".$datos["com_etica"].",";
			} else if ($datos["com_eticac"]!== "0") {
				$val_com_etica=",".$datos["com_eticac"].",";
			} 
		} else {
			$campo_com_etica = "";
			$val_com_etica = "";
		}
		if ($datos["inst_etica"]!== "0" || $datos["inst_eticac"]!== "0"|| $datos["centro_etica"]!== "0" ) {
			$campo_ins_etica = ",id_inst_etica,";
			if ($datos["inst_etica"]!== "0") {
				$val_ins_etica=",".$datos["inst_etica"].",";
			} else if ($datos["inst_eticac"]!== "0") {
				$val_ins_etica=",".$datos["inst_eticac"].",";
			} else if ($datos["centro_etica"]!== "0") {
				$val_ins_etica=",".$datos["centro_etica"].",";
			} 
		} else {
			$campo_ins_etica = "";
			$val_ins_etica = "";
		}
		if ($datos["objetivos_inv"]!== "0") {
			$campo_objetivos_inv = ",objetivo_investigacion,";
			if ($datos["objetivos_inv"]!== "0") {
				$val_objetivos_inv=",'".$datos["objetivos_inv"]."',";
			}
		} else {
			$campo_objetivos_inv = "";
			$val_objetivos_inv = "";
		}
		if ($datos["resul_invc"]!== "0" || $datos["resul_inv"]!== "0" ) {
			$campo_resul_inv = ",resultado_investigacion,";
			if ($datos["resul_invc"]!== "0") {
				$val_resul_inv=",'".$datos["resul_invc"]."',";
			} else if ($datos["resul_inv"]!== "0") {
				$val_resul_inv=",'".$datos["resul_inv"]."',";
			}
		} else {
			$campo_resul_inv = "";
			$val_resul_inv = "";
		}
		if ($datos["impacto"] !== "0") {
			$campo_impacto = ",impacto_investigacion,";
			if ($datos["impacto"] !== "0") {
				$val_impacto=",'".$datos["impacto"]."',";
			}
		} else {
			$campo_impacto = "";
			$val_impacto = "";
		}
		if ($datos["enlace"] !== "0") {
			$campo_enlace = ",enlace_publicacion,";
			$campo_publicado = ",publicado,";
			if ($datos["enlace"] !== "0") {
				$val_enlace=",'".$datos["enlace"]."',";
				$val_publicado=$datos["publicado"]?",'t',":",'f',"; 
			}
		} else {
			$campo_enlace = "";
			$val_enlace = "";
			$campo_publicado = "";
			$val_publicado = "";
		}
		$sql = "INSERT INTO investigacion_actual (ci_investigador,titulo_investigacion,id_tipo_institucion,id_linea_investigacion,id_tipo_investigacion,id_fase $campo_centro $campo_tiempo $campo_unidad $campo_com_etica $campo_ins_etica $campo_objetivos_inv $campo_resul_inv $campo_impacto $campo_publicado $campo_enlace) VALUES ($cedula,'".$datos["titulo_investigacion"]."',".$datos["tip_inst"].",".$datos["lin_invp"].",".$datos["tipo_inv"].",".$datos["fase_inv"].","."$val_centro $val_tiempo $val_unidad $val_com_etica $val_ins_etica $val_objetivos_inv $val_resul_inv $val_impacto $val_publicado $val_enlace".")";
		$sql = preg_replace('/\s\s+/', ' ', $sql);
		$sql = str_replace(', ,',',',$sql);
		$sql = str_replace(',,',',',$sql);
		$sql = str_replace(', )',')',$sql);
		$sql = str_replace(',)',')',$sql);
		$this->db->trans_start();
		$query = $this->db->query($sql);
		$sql_u = "SELECT MAX(id_investigacion_actual) AS ult FROM investigacion_actual WHERE ci_investigador = $cedula";
		$aultimo = $this->db->query($sql_u)->result_array();
		foreach ($datos["responsables"] as $r) {
			$sql_r = "INSERT INTO responsables_investigacion (id_investigacion,ci_responsable_investigacion,nombre_responsable_investigacion,apellido_responsable_investigacion,actual) VALUES (".$aultimo[0]["ult"].",".$r["cedula"].",'".$r["nombre"]."','".$r["apellido"]."','t')";
			$this->db->query($sql_r);
		}
		$this->db->trans_complete();
		if ($query) {
			return true;
		} else {
			return false;
		}
		// } else {
		// 	return ("YA LA INVESTIGACIÓN FUE REGISTRADA PREVIAMENTE");	
		// }
		// } else {
		// 	return ("YA LA INVESTIGACIÓN FUE REGISTRADA PREVIAMENTE");
		// }
	}
	public function verificar_investigacion_actual($cedula) {
		$sql = "SELECT count(ci_investigador) AS cant,id_investigacion_actual FROM investigacion_actual WHERE activo AND ci_investigador =$cedula GROUP BY id_investigacion_actual";
		$query=$this->db->query($sql)->result_array();
		return $query;
	}
	public function get_investigacion_actual($cedula) {
		$consulta_fase = $this->db->query("SELECT id_fase FROM investigacion_actual WHERE activo AND ci_investigador = $cedula")->row_array();
		$fase = $consulta_fase["id_fase"];
		switch ($fase) {
			case 1:
			$sql = "SELECT a.id_investigacion_actual,a.ci_investigador,a.titulo_investigacion,a.id_tipo_institucion,CASE WHEN a.id_tipo_institucion = 1 THEN b.cod_centro_salud WHEN a.id_tipo_institucion = 2 THEN c.id_institucion_investigacion WHEN a.id_tipo_institucion = 3 THEN d.id_institucion_educativa WHEN a.id_tipo_institucion = 4 THEN e.id_comuna END AS id_centro,a.id_linea_investigacion,a.resultado_investigacion,a.id_tipo_investigacion,a.id_fase,a.tiempo_investigacion,a.id_unidad_tiempo,a.activo,a.fecha_registro FROM investigacion_actual a LEFT JOIN centros_salud b ON b.cod_centro_salud=a.id_centro LEFT JOIN instituciones_investigacion c ON c.id_institucion_investigacion =a.id_centro LEFT JOIN instituciones_educativas d ON d.id_institucion_educativa = a.id_centro LEFT JOIN comunas e ON e.id_comuna=a.id_centro WHERE a.activo AND ci_investigador = $cedula";
			break;
			case 2:
			$sql = "SELECT a.id_investigacion_actual,a.ci_investigador,a.titulo_investigacion,a.id_tipo_institucion,CASE WHEN a.id_tipo_institucion = 1 THEN b.cod_centro_salud WHEN a.id_tipo_institucion = 2 THEN c.id_institucion_investigacion WHEN a.id_tipo_institucion = 3 THEN d.id_institucion_educativa WHEN a.id_tipo_institucion = 4 THEN e.id_comuna END AS id_centro,a.id_linea_investigacion,a.resultado_investigacion,a.id_tipo_investigacion,a.id_fase,a.objetivo_investigacion,a.id_com_etica,a.id_inst_etica,CASE WHEN a.id_com_etica = 1 THEN (SELECT w.cod_centro_salud FROM centros_salud w WHERE w.cod_centro_salud=a.id_inst_etica) WHEN a.id_com_etica = 2 THEN (SELECT x.id_institucion_investigacion FROM instituciones_investigacion x WHERE x.id_institucion_investigacion=a.id_inst_etica) WHEN a.id_com_etica = 3 THEN (SELECT y.id_institucion_educativa FROM instituciones_educativas y WHERE y.id_institucion_educativa=a.id_inst_etica) WHEN a.id_com_etica = 4 THEN (SELECT z.id_comuna FROM comunas z WHERE z.id_comuna=a.id_inst_etica) END AS d_inst_etica,a.activo,a.fecha_registro FROM investigacion_actual a	LEFT JOIN centros_salud b ON b.cod_centro_salud = a.id_centro AND a.id_tipo_institucion = 1 LEFT JOIN instituciones_investigacion c ON c.id_institucion_investigacion = a.id_centro AND a.id_tipo_institucion = 2 LEFT JOIN instituciones_educativas d ON d.id_institucion_educativa = a.id_centro AND a.id_tipo_institucion = 3 LEFT JOIN comunas e ON e.id_comuna = a.id_centro AND a.id_tipo_institucion = 4 LEFT JOIN centros_salud w ON w.cod_centro_salud = a.id_inst_etica AND a.id_com_etica = 1 LEFT JOIN instituciones_investigacion x ON x.id_institucion_investigacion = a.id_inst_etica AND a.id_com_etica = 2 LEFT JOIN instituciones_educativas y ON y.id_institucion_educativa = a.id_inst_etica AND a.id_com_etica = 3 LEFT JOIN comunas z ON z.id_comuna = a.id_inst_etica AND a.id_com_etica = 4 WHERE a.activo AND a.ci_investigador = $cedula";
			break;
			case 3:
			$sql = "SELECT a.id_investigacion_actual,a.ci_investigador,a.titulo_investigacion,a.id_tipo_institucion,CASE WHEN a.id_tipo_institucion = 1 THEN b.cod_centro_salud WHEN a.id_tipo_institucion = 2 THEN c.id_institucion_investigacion WHEN a.id_tipo_institucion = 3 THEN d.id_institucion_educativa WHEN a.id_tipo_institucion = 4 THEN e.id_comuna END AS id_centro,a.id_linea_investigacion,a.resultado_investigacion,a.id_tipo_investigacion,a.id_fase,a.tiempo_investigacion,a.id_unidad_tiempo,a.id_com_etica,a.id_inst_etica,CASE WHEN a.id_com_etica = 1 THEN (SELECT w.cod_centro_salud FROM centros_salud w WHERE w.cod_centro_salud = a.id_inst_etica) WHEN a.id_com_etica = 2 THEN (SELECT x.id_institucion_investigacion FROM instituciones_investigacion x WHERE x.id_institucion_investigacion = a.id_inst_etica) WHEN a.id_com_etica = 3 THEN (SELECT y.id_institucion_educativa FROM instituciones_educativas y WHERE y.id_institucion_educativa = a.id_inst_etica) WHEN a.id_com_etica = 4 THEN (SELECT z.id_comuna FROM comunas z WHERE z.id_comuna = a.id_inst_etica) END AS id_inst_etica,a.impacto_investigacion,a.publicado,a.enlace_publicacion,a.fecha_registro FROM investigacion_actual a LEFT JOIN centros_salud b on b.cod_centro_salud = a.id_centro LEFT JOIN instituciones_investigacion c on c.id_institucion_investigacion = a.id_centro LEFT JOIN instituciones_educativas d on d.id_institucion_educativa = a.id_centro LEFT JOIN comunas e on e.id_comuna = a.id_centro WHERE a.activo AND a.ci_investigador = $cedula";
			break;
		}
		return $this->db->query($sql)->result_array();
	}
	public function get_insti_etica($id_tipo_etica,$id_centro) {
		switch ($id_tipo_etica) {
			case 2:
			$sql = "SELECT id_institucion_investigacion AS id_institucion,nombre_institucion_investigacion AS institucion FROM instituciones_investigacion WHERE activo AND id_institucion_investigacion = $id_centro";
			break;		
			case 3:
			$sql = "SELECT id_institucion_educativa AS id_institucion,nombre_institucion_educativa AS institucion FROM instituciones_educativas WHERE activo AND id_institucion_educativa = $id_centro";
			break;		
			case 4:
			$sql = "SELECT cod_centro_salud AS id_institucion,nombre_centro AS institucion FROM centros_salud WHERE activo AND cod_centro_salud = $id_centro";
			break;
		}
		return $this->db->query($sql)->result_array();
	}
	public function investigador_actual() {
		$cedula = $this->session->userdata("cedula");
		$sql = "SELECT a.ci_investigador,b.pnombre,b.snombre,b.papellido,b.sapellido,TO_CHAR(a.fecha_registro,'DD/MM/YYYY') AS fecha_registro FROM investigacion_actual a LEFT JOIN investigadores b on b.ci_investigador = a.ci_investigador WHERE a.ci_investigador = $cedula AND a.activo AND b.activo";
		return $this->db->query($sql)->row_array();
	}
	public function listar_investigadores() {
		return $this->db->query("SELECT a.id_investigador,a.ci_investigador,TRIM(a.pnombre || ' ' ||a.snombre) AS nombres,TRIM(a.papellido || ' ' || a.sapellido) AS apellidos,a.correo,CASE WHEN (SELECT count(x.*) FROM perfil_investigador x WHERE x.ci_investigador = a.ci_investigador) > 0 THEN 'SI' ELSE 'NO' END as perfil_academico,CASE WHEN (SELECT count(y.*) FROM perfil_investigacion y WHERE y.ci_investigador = a.ci_investigador) > 0 THEN 'SI' ELSE 'NO' END as perfil_investigacion,CASE WHEN (SELECT count(z.*) FROM investigacion_actual z WHERE z.ci_investigador = a.ci_investigador) > 0 THEN 'SI' ELSE 'NO' END as investigacion_actual,to_char(a.fecha_creacion,'DD/MM/YYYY') AS fecha_creacion FROM investigadores a WHERE a.activo ORDER BY a.ci_investigador");
	}
	public function get_vinvestigador($cedula) {
		$sql = "SELECT ci_investigador,pnombre,snombre,papellido,sapellido,nombre_genero,to_char(fecha_nac,'DD/MM/YYYY') AS fecha_nac,nombre_estado,estado,municipio,parroquia,codigo_postal,telefono,celular,correo,profesion,tipo_institucion,nombre_institucion,modo_investigacion,to_char(fecha_creacion,'DD/MM/YYYY') AS fecha_creacion FROM v_investigadores WHERE ci_investigador = $cedula";
		return $this->db->query($sql)->result_array();
	}
	public function get_vperfil_investigador($cedula) {
		$sql = "SELECT consigno_foto,id_perfil_investigador,ci_investigador,pnombre,snombre,papellido,sapellido,rif_investigador,nivel_academico,estatus_academico,nombre_institucion_educativa,nombre_especialidad_salud,area_conocimiento,sub_area,consigno_cedula,consigno_rif,consigno_titulo,fecha_creacion FROM vperfil_investigador WHERE ci_investigador = $cedula";
		return $this->db->query($sql)->result_array();
	}
	public function get_vperfil_investigacion($cedula) {
		return $this->db->query("SELECT impacto_politica_publica,politica_publica,linea_investigacion,tipo_investigacion,fase,tipo_institucion,centro,titulo_investigacion,fecha_culminacion,objetivo_investigacion,resultado_investigacion,activo,publicada,link_publicacion,fecha_registro,tiempo_investigacion,id_perfil_investigacion,ci_investigador FROM vperfil_investigacion WHERE ci_investigador = $cedula")->result_array();
	}
	// public function get_responsables($ceula) {
	// }
	public function get_vactual($cedula) {
		$sql = "SELECT id_investigacion_actual,ci_investigador,titulo_investigacion,tipo_institucion,centro,linea_investigacion,resultado_investigacion,tipo_investigacion,fase,tiempo_investigacion,objetivo_investigacion,institucion_etica,impacto_investigacion,publicado,enlace_publicacion,activo,fecha_registro FROM vinvestigacion_actual WHERE ci_investigador = $cedula";
		return $this->db->query($sql)->result_array();
	}
}