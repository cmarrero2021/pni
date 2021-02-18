<?php
class Registro_model extends CI_Model
{
	public function __construct() {
		parent::__construct();
		$this->load->model('Audit_model', 'auditoria');
		$this->auditoria->auditar();
	}
	public function eliminar_investigador($cedula) {
		$this->db->trans_start();
		$this->db->where('ci_usuario',$cedula);
		$this->db->delete("usuarios");
		$this->db->where('ci_investigador',$cedula);
		$this->db->delete("investigadores");
		$this->db->trans_complete();
		$this->db->trans_commit();
		return true;
	}
	public function verificar_registro($cedula) {
		$query = $this->db->query("SELECT COUNT('ci_investigador') AS cant FROM investigadores WHERE ci_investigador = $cedula")->row_array();
		if ($query["cant"]>0) {
			return 0;
		} else {
			return 1;
		}
	}
	public function get_investigador($cedula) {
		return $this->db->query("SELECT COUNT('ci_investigador') AS cant FROM investigadores WHERE ci_investigador = $cedula")->row_array();
	}
	public function obtener_genero() {
		return $this->db->query("SELECT id_genero,nombre_genero FROM genero ORDER BY id_genero ASC ")->result_array();		
	}
	public function obtener_edociv() {
		return $this->db->query("SELECT id_estado_civil,nombre_estado FROM estado_civil ORDER BY id_estado_civil ASC ")->result_array();
	}
	public function obtener_estado() {
		return $this->db->query("SELECT id_estado,estado FROM estados ORDER BY estado ASC ")->result_array();
	}
	public function obtener_profesion() {
		return $this->db->query("SELECT id_profesion,profesion FROM profesiones WHERE activo ORDER BY profesion ASC ")->result_array();
	}
	public function obtener_tipo_institucion() {
		return $this->db->query("SELECT id_tipo_institucion,tipo_institucion FROM tipo_institucion ORDER BY id_tipo_institucion ASC ")->result_array();
	}
	public function obtener_linea_investigacion() {
		return $this->db->query("SELECT a.id_lineas_presidenciales,a.nombre_lineas_presidenciales,a.grupo,(SELECT count(x.grupo) FROM lineas_presidenciales x WHERE x.grupo = a.grupo) FROM lineas_presidenciales a ORDER BY a.grupo ASC,a.nombre_lineas_presidenciales ASC")->result_array();
	}
	public function inv() {
		return $this->db->query("SELECT id_lineas_presidenciales AS id,nombre_lineas_presidenciales AS text FROM lineas_presidenciales ORDER BY nombre_lineas_presidenciales ASC ")->result_array();
	}
	public function obtener_municipios($estado) {
		return $this->db->query("SELECT id_municipio,municipio FROM municipios WHERE id_estado = $estado ORDER BY municipio ASC ")->result_array();
	}
	public function obtener_parroquias($municipio) {
		return $this->db->query("SELECT id_parroquia,parroquia FROM parroquias WHERE id_municipio = $municipio ORDER BY parroquia ASC ")->result_array();
	}
	public function obtener_zonas($parroquia) {
		return $this->db->query("SELECT id_zona,codigo_postal FROM zonas WHERE id_parroquia = $parroquia ORDER BY codigo_postal ASC ")->result_array();
	}
	public function obtener_modo_investigacion() {
		return $this->db->query("SELECT id_modo_investigacion,modo_investigacion FROM modo_investigacion ORDER BY modo_investigacion ASC ")->result_array();
	}
	public function obtener_sector_empleo() {
		return $this->db->query("SELECT id_sector_empleo,sector_empleo FROM sector_empleo WHERE activo ORDER BY sector_empleo ASC ")->result_array();
	}
	public function obtener_tipo_investigador() {
		return $this->db->query("SELECT id_tipo_investigador,tipo_investigador FROM tipo_investigador WHERE activo")->result_array();
	}	
	public function insertar_registro($tabla,$data) {
		return $this->db->insert($tabla, $data);
	}
	public function insertar_investigador($datos) {
		$cedula = $datos["cedula"];
		$pnombre = $datos["pnombre"];
		$snombre = $datos["snombre"];
		$papellido = $datos["papellido"];
		$sapellido = $datos["sapellido"];
		$genero = $datos["genero"];
		$fnac = $datos["fnac"];
		$ecivil = $datos["ecivil"];
		$estado = $datos["estado"];
		$municipio = $datos["municipio"];
		$parroquia = $datos["parroquia"];
		$cpostal = $datos["cpostal"];
		$telefono = $datos["telefono"];
		$celular = $datos["celular"];
		$correo = $datos["correo"];
		$profesion = $datos["profesion"];
		$tinst = $datos["tinst"];
		$institucion = $datos["institucion"];
		$intinv = print_r($datos["intinv"],true);
		$invact = print_r($datos["invact"],true);
		$invcolind = $datos["invcolind"];
		$intinv=str_replace("(","[",$intinv);
		$intinv=str_replace(")","]",$intinv);
		$intinv=str_replace("[0] => ","",$intinv);
		$intinv=str_replace("[1] => ",",",$intinv);
		$intinv=str_replace("[2] => ",",",$intinv);
		$invact=str_replace("(","[",$invact);
		$invact=str_replace(")","]",$invact);
		$invact=str_replace("[0] => ","",$invact);
		$invact=str_replace("[1] => ",",",$invact);
		$invact=str_replace("[2] => ",",",$invact);
		$clave =  md5($datos["clave"]);
		$usr = array(
			"ci_usuario"		=> "$cedula",
			"nombre_usuario"	=> "$pnombre",
			"apellido_usuario"	=> "$papellido",
			"login_usuario"		=> "$correo",
			"clave_usuario"		=> "$clave",
			"status"			=> "t",
			"correo_usuario"	=> "$correo",
			"activo"			=> "t",
			"verificado"		=> "t",
			"telefono_usuario"	=> "$telefono",
			"id_grupo"			=> "3"
		);
		$this->db->trans_start();
		$this->db->insert('usuarios',$usr);
		$ci_investigador1 = $this->db->escape($cedula);
		$pnombre1 = $this->db->escape($pnombre);
		$snombre1 = $this->db->escape($snombre);
		$papellido1 = $this->db->escape($papellido);
		$sapellido1 = $this->db->escape($sapellido);
		$id_genero1 = $this->db->escape($genero);
		$fecha_nac1 = $this->db->escape($fnac);
		$id_civil1 = $this->db->escape($ecivil);
		$id_estado1 = $this->db->escape($estado);
		$id_municipio1 = $this->db->escape($municipio);
		$id_parroquia1 = $this->db->escape($parroquia);
		$id_zona1 = $this->db->escape($cpostal);
		$telefono1 = $this->db->escape($telefono);
		$celular1 = $this->db->escape($celular);
		$correo1 = $this->db->escape($correo);
		$id_profesion1 = $this->db->escape($profesion);
		$id_tipo_institucion1 = $this->db->escape($tinst);
		$nombre_institucion1 = $this->db->escape($institucion);
		$interes_inv1 = $intinv;
		$inv_actual1 = $invact;
		$id_modo_investigacion1 = $this->db->escape($invcolind);
		if (trim($telefono1) == '' || trim($celular1) == '' || trim($correo1) == '' || trim($nombre_institucion1) == '') {
			$this->db->trans_complete();
			$this->db->trans_rollback();
			return FALSE;			
		} else {		
			$sql = "INSERT INTO investigadores (ci_investigador,pnombre,snombre,papellido,sapellido,id_genero,fecha_nac,id_civil,id_estado,id_municipio,id_parroquia,id_zona,telefono,celular,correo,id_profesion,id_tipo_institucion,nombre_institucion,interes_inv,inv_actual,id_modo_investifgacion) VALUES ($ci_investigador1,$pnombre1,$snombre1,$papellido1,$sapellido1,$id_genero1,$fecha_nac1,$id_civil1,$id_estado1,$id_municipio1,$id_parroquia1,$id_zona1,$telefono1,$celular1,$correo1,$id_profesion1,$id_tipo_institucion1,$nombre_institucion1,$interes_inv1,$inv_actual1,$id_modo_investigacion1)";
			$sql = str_replace(",,", ",null,", $sql);
			$this->db->query($sql);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} 
			else {
				$this->db->trans_commit();
				return TRUE;
			}
		}
	}
	public function actualizar_investigador($datos) {
		$cedula = $datos["cedula"];
		$pnombre = $datos["pnombre"];
		$snombre = $datos["snombre"];
		$papellido = $datos["papellido"];
		$sapellido = $datos["sapellido"];
		$genero = $datos["genero"];
		$fnac = $datos["fnac"];
		$ecivil = $datos["ecivil"];
		$estado = $datos["estado"];
		$municipio = $datos["municipio"];
		$parroquia = $datos["parroquia"];
		$cpostal = $datos["cpostal"];
		$telefono = $datos["telefono"];
		$celular = $datos["celular"];
		$correo = $datos["correo"];
		$profesion = $datos["profesion"];
		$tinst = $datos["tinst"];
		$institucion = $datos["institucion"];
		$intinv = print_r($datos["intinv"],true);
		$invact = print_r($datos["invact"],true);
		$invcolind = $datos["invcolind"];
		$clave =  md5($datos["clave"]);
		$respuesta = false;
		if ($invcolind == 4) {
			$invact='Array[0]';
		}		
		$intinv=str_replace("(","[",$intinv);
		$intinv=str_replace(")","]",$intinv);
		$intinv=str_replace("[0] => ","",$intinv);
		$intinv=str_replace("[1] => ",",",$intinv);
		$intinv=str_replace("[2] => ",",",$intinv);
		$invact=str_replace("(","[",$invact);
		$invact=str_replace(")","]",$invact);
		$invact=str_replace("[0] => ","",$invact);
		$invact=str_replace("[1] => ",",",$invact);
		$invact=str_replace("[2] => ",",",$invact);
		$this->db->trans_start();
		$sql_us = "UPDATE usuarios SET nombre_usuario='$pnombre',apellido_usuario='$papellido',clave_usuario='$clave',telefono_usuario='$telefono' WHERE ci_usuario = $cedula";
		if ($this->db->query($sql_us)) {
			$respuesta = true;
		}
		$sql_reg = "UPDATE investigadores SET pnombre='$pnombre',snombre='$snombre',papellido='$papellido',sapellido='$sapellido',id_genero=$genero,fecha_nac='$fnac',id_civil=$ecivil,id_estado=$estado,id_municipio=$municipio,id_parroquia=$parroquia,id_zona=$cpostal,telefono='$telefono',celular='$celular',id_profesion=$profesion,id_tipo_institucion=$tinst,nombre_institucion='$institucion',interes_inv=$intinv,inv_actual=$invact,id_modo_investifgacion=$invcolind WHERE ci_investigador = $cedula";
		if ($this->db->query($sql_reg)) {
			$respuesta = true;
		} else {
			$respuesta = false;
		}
		$this->db->trans_complete();
		return $respuesta;
	}
	public function listar_motivo() {
		return $this->db->query("SELECT id_motivo,motivo FROM motivos ORDER BY id_motivo ASC ");
	}
	// public function guardar($data)	{
	// 	$this->db->trans_start();
	// 	$moti = $data['motivo'];
	// 	$ins = $this->db->query("INSERT INTO motivos (motivo) VALUES ('$moti')");
	// 	$query = $this->db->query("select max(id_motivo) as id from motivos")->row();
	// 	$this->db->trans_complete();
	// 	return $query;
	// }
	public function curl_download($Url){
		if (!function_exists('curl_init')){
			die('Recuerda que el cURL debe tener instalado el cURL, esta instalacion no lo tiene; instalala e intenta de nueva.');
		}
		$html = new simple_html_dom();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$html->load( curl_exec($ch));
		curl_close($ch);
		$nac="";
		$ced1="";
		$ced="";
		$nom="";
		$edo="";
		$mun="";
		$par="";
		$cen="";
		$dir="";
		$output="";
		$rows = $html->find('td');
		$m=0;
		foreach($rows as $rows) {
			$fila = $rows->plaintext;
			if(strpos($fila,"Nombre")) {
				$var8=trim(str_replace("Usted fue reubicado a este Centro de Votación","",$fila));
				$var9=trim(str_replace("REGISTRO ELECTORAL","",$var8));
				$var10=trim(str_replace("Consulta de Datos","",$var9));
				$var11=trim(str_replace("DATOS DEL ELECTOR","",$var10));
				$var12=trim(str_replace("Registro Electoral Definitivo Julio 2017","",$var11));
				$var13=trim(str_replace("para las Elecciones Regionales del 15 octubre de 2017","",$var12));
				$var14=trim(str_replace("Imprimir","",$var13));
				$var15=trim(str_replace("Cerrar","",$var14));
				$var16=trim(str_replace("Votación","",$var15));
				$m++;
				return $var14;
			} else {
				return "";
			}
		}
	}
	public function buscar_cne($cedula) {
		$sql = "SELECT cedula,primer_apellido,segundo_apellido,primer_nombre,segundo_nombre,fecha_nacimiento,CASE WHEN sexo = 'F' THEN 1 else 2 END as sexo FROM renac WHERE cedula = $cedula";
		$cons = $this->db->query($sql)->row_array();
		$fil = count($cons);
		if ($fil > 0) {
			return $cons;
		} else {
			$sql = "SELECT '' AS cedula,'' AS primer_apellido,'' AS segundo_apellido,'' AS primer_nombre,'' AS segundo_nombre,'' AS fecha_nacimiento,'' AS sexo";
			$cons1 = $this->db->query($sql)->row_array();
			return $cons1;
		}
	}
	public function reiniciar_clave($marca) {
		$res = $this->db->query("SELECT clave FROM empresa")->result_array();
		$clave = md5($res[0]["clave"]);
		return $this->db->query("UPDATE usuarios SET clave_usuario = '$clave' WHERE temporal = '$marca'");
	}
	public function revisar_cedula($cedula) {
		$sql = "SELECT count(ci_usuario) AS cant FROM usuarios WHERE ci_usuario = '".$cedula."'";
		$resultado = $this->db->query($sql)->result_array();
		return $resultado[0]["cant"];
	}
	public function revisar_correo($correo) {
		$sql = "SELECT count(correo_usuario) AS cant FROM usuarios WHERE correo_usuario = '".$correo."'";
		$resultado = $this->db->query($sql)->result_array();
		return $resultado[0]["cant"];
	}
	// public function registrar_usuario($data){
	// 	foreach($data as $var => $val) {
	// 		$$var = $val;
	// 	}
	// 	$clave = "'".md5($clave_usuario)."'";
	// 	$sql = "INSERT INTO usuarios (ci_usuario,nombre_usuario,login_usuario,clave_usuario,status,correo_usuario,telefono_usuario,id_grupo) VALUES ($ci_usuario,$nombre_usuario,$login_usuario,$clave,'true',$correo_usuario,$celular_usuario,2)";
	// 	$this->db->query($sql);
	// 	return true;
	// }
	public function verificar_cedula($ci) {
		return $query=$this->db->query("SELECT COUNT(*) AS ci FROM usuarios WHERE ci_usuario = ".$ci)->result_array();
	}
	public function datos_correo($correo) {
		$query = $this->db->query("SELECT nombre_usuario,temporal FROM usuarios WHERE correo_usuario = '$correo'")->row_array();
		$this->db->query("UPDATE usuarios set temporal = NULL WHERE correo_usuario = '$correo'");
		return $query;
	}
	public function verificar_correo($correo,$clave_temp) {
		$clave = md5($clave_temp);
		$sql_verif = "SELECT COUNT(*) AS correo FROM usuarios WHERE correo_usuario = ".$correo;
		$query=$this->db->query($sql_verif)->row_array();
		if ($query["correo"] ==1) {
			$this->db->query("UPDATE usuarios SET clave_usuario = '$clave', temporal = '$clave_temp' WHERE correo_usuario = $correo");
		}
		return $query;
	}
	public function marca_temporal($correo,$marca) {
		$cedula = $this->session->userdata['cedula'];
		$sql = "UPDATE usuarios SET temporal = '".$marca."', correo_usuario = '".$correo."' WHERE ci_usuario =  '".$cedula."'";
		$this->db->query($sql);
		return true;
	}
	public function marca_verificada($marca_temporal) {
		$sql1 = "SELECT count(*) AS existe FROM usuarios WHERE temporal = '$marca_temporal'";
		$res1 = $this->db->query("SELECT count(*) AS existe FROM usuarios WHERE temporal = '$marca_temporal'")->row_array();
		if ($res1["existe"] >0) {
			$this->db->query("UPDATE usuarios SET verificado = 't' WHERE temporal = '$marca_temporal'");
			return true;
		} else {
			return false;
		}
	}
	public function verificar_marca($marca) {
		$sql = "SELECT correo_usuario FROM usuarios WHERE temporal = '".$marca."'";
		$res = $this->db->query($sql)->row_array();
		$correo = $res["correo_usuario"];
		if ($correo != '') {
			return $correo;
		} else {
			return false;
		}
	}
	public function correo_usuario($correo) {
		return $this->db->query("SELECT nombre_usuario,apellido_usuario,login_usuario FROM usuarios WHERE correo_usuario = '$correo' " )->result_array();
	}
	public function actualizar_clave($data) {
		foreach($data as $var => $val) {
			$$var = $val;
		}
		$clave = md5($clave_usuario);
		$sql = "UPDATE usuarios SET clave_usuario =  '".$clave."' WHERE ci_usuario = '".$usuario."'";
		$this->db->query($sql);
		$sql2 = "SELECT correo_usuario,nombre_usuario FROM usuarios WHERE ci_usuario =  '".$usuario."'";
		$res =  $this->db->query($sql2)->result_array();
		return $res;
	}
	public function clave_defecto() {
		$res = $this->db->query("SELECT clave FROM empresa")->result_array();
		return $res[0]["clave"];
	}	
	public function consultar_cadena($cadena) {
		$res = $this->db->query("SELECT COUNT(*) FROM usuarios WHERE temporal = $cadena")->num_rows();
		if ($res ==1) {
			return true;
		} else {
			return false;
		}
	}
	public function completar_datos($data) {
		foreach($data as $var => $val) {
			$$var = $val;
		}
		$clave = md5($clave_usuario);
		$sql = "UPDATE usuarios SET clave_usuario =  '".$clave."',telefono_usuario = '".$celular."'  WHERE login_usuario = '".$usuario."'";
		$this->db->query($sql);
		$sql2 = "SELECT login_usuario,correo_usuario,nombre_usuario FROM usuarios WHERE login_usuario =  '".$usuario."'";
		$res =  $this->db->query($sql2)->result_array();
		return $res;
	}
}