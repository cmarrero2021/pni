<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			delete_cookie("ci_session");
			redirect(base_url().'login');
		}		
		$this->load->model("perfil_model","perfil");
		$this->load->model("login_model","login");
		$this->load->model("menu_model","menu");
		$this->load->library('pdf');
		ini_set('date.timezone', 'America/Caracas');
		$this->load->helper('form'); 
	}
	public function perfil_general() {
		$cedula = $this->session->userdata('cedula');
		$this->session->set_userdata('titulo_url'," &nbsp;Perfil General");
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$menu1["grupo_usuario"] = $grupo_usuario;	
		$menu1['buscar'] = false;
		$menu1["menu"] = $this->menu->get_full_menu($grupo_usuario);
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$data["investigador"] = $this->perfil->buscar_investigador($cedula);
		if (empty($data["investigador"])) {
			$data["investigador"] = $this->perfil->buscar_usuario($cedula);
		}
		$inv1 = $data["investigador"]["interes_inv"];
		$act1 = $data["investigador"]["inv_actual"];
		$data["investigador"]["inv1"] = $data["investigador"]["interes_inv"];
		$data["investigador"]["act1"] = $data["investigador"]["inv_actual"];
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/inicio_contenido');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view('perfil/perfil_personal_view',$data);
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function perfil_investigador() {
		$cedula = $this->session->userdata('cedula');
		$this->session->set_userdata('titulo_url'," &nbsp;Perfil del Investigador");
		$data["salud"] = $this->perfil->get_profesion_salud($cedula);
		$data["perfil"] = $this->perfil->get_perfil_investigador($cedula);
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$menu1["grupo_usuario"] = $grupo_usuario;
		$menu1['buscar'] = false;
		$menu1["menu"] = $this->menu->get_full_menu($grupo_usuario);
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/inicio_contenido');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view('perfil/perfil_academico_view',$data);
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function perfil_investigacion() {
		$cedula = $this->session->userdata('cedula');
		$this->session->set_userdata('titulo_url'," &nbsp;Perfil Investigación");
		$data["salud"] = $this->perfil->get_profesion_salud($cedula);
		$data["institucion"] = $this->perfil->buscar_investigador($cedula,"id_tipo_institucion");
		$data["tiempo"] = $this->perfil->buscar_tiempo();
		$data["cantidad"] = $this->perfil->buscar_cantidad();
		$data["grupo"] = $this->perfil->buscar_grupo();
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$menu1["grupo_usuario"] = $grupo_usuario;
		$menu1['buscar'] = false;
		$menu1["menu"] = $this->menu->get_full_menu($grupo_usuario);
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/inicio_contenido');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view('perfil/perfil_investigacion_view',$data);
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function investigacion_actual() {
		$cedula = $this->session->userdata('cedula');
		$this->session->set_userdata('titulo_url'," &nbsp;Investigación Actual");
		$data["salud"] = $this->perfil->get_profesion_salud($cedula);
		$inv_act = $this->perfil->verificar_investigacion_actual($cedula);
		if ($inv_act[0]["cant"] == 1) {
			$data["responsables"] = $this->perfil->get_responsables_investigacion($inv_act[0]["id_investigacion_actual"]);
			$data["actual"] = $this->perfil->get_investigacion_actual($cedula); 
			$vista = 'perfil/investigaciones_actuales_view';
			// $data["investigaciones_actuales"]=$this->perfil->listar_investigaciones_actuales($cedula);
		} else {
			$vista = 'perfil/investigacion_actual_view';
		}
		$data["institucion"] = $this->perfil->buscar_investigador($cedula,"id_tipo_institucion");
		$data["grupo"] = $this->perfil->buscar_grupo();
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$menu1["grupo_usuario"] = $grupo_usuario;
		$menu1['buscar'] = false;
		$menu1["menu"] = $this->menu->get_full_menu($grupo_usuario);
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/inicio_contenido');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view($vista,$data);
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function get_ficha_proyecto() {
		$id = $this->input->post("id");
		$query = $this->perfil->get_ficha_proyecto($id);
		echo json_encode($query, JSON_UNESCAPED_UNICODE);
	}
	public function investigadores() {
		$this->session->set_userdata('titulo_url'," &nbsp;Investigadores");
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$menu1["grupo_usuario"] = $grupo_usuario;
		$menu1['buscar'] = false;
		$menu1["menu"] = $this->menu->get_full_menu($grupo_usuario);
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		$data['usuarios']=$this->perfil->listar_investigadores();
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view('plantillas/inicio_contenido');
		$this->load->view('investigadores/listar_investigadores_view.php',$data);
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function listar_investigadores() {
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$query = $this->perfil->listar_investigadores();
		$data = [];
		foreach($query->result() as $r) {
			$data[] = array(
				$r->acciones='			
				<a class="btn btn-xs bgc-success clight" href="javascript:void(0)" title="Ver" onclick="ver('."'".$r->id_investigacion_actual."'".')"><i class="fa fa-eye fa-2x"></i></a>',
				$r->ci_investigador,
				$r->nombres,
				$r->apellidos,
				$r->correo,
				$r->perfil_academico,
				$r->perfil_investigacion,
				$r->investigacion_actual,
				$r->fecha_creacion
			);			
		}
		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);
		echo json_encode($result);
	}

	public function listar_investigaciones_actales() {
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$query = $this->perfil->listar_investigaciones_actuales($this->session->userdata("cedula"));
		$data = [];
		foreach($query->result() as $r) {
			$data[] = array(
				$r->acciones='			
				<a class="btn btn-xs bgc-success clight" href="javascript:void(0)" title="Ver" onclick="ver('."'".$r->id_investigacion_actual."'".')"><i class="fa fa-eye fa-2x"></i></a>',
				$r->id_investigacion_actual,
				$r->titulo_investigacion,
				$r->linea_investigacion,
				$r->fase,
				$r->tipo_investigacion
			);			
		}
		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);
		echo json_encode($result);
	}
	public function get_investigador() {
		$cedula = $this->uri->segment(3);
		$data["inv"]=$this->perfil->get_vinvestigador($cedula);
		$data["pinvd"]=$this->perfil->get_vperfil_investigador($cedula);
		$data["pinvi"]=$this->perfil->get_vperfil_investigacion($cedula);
		$data["actual"]=$this->perfil->get_vactual($cedula);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	public function verificar_archivos1() {
		$cedula = $this->input->post("cedula");
		$foto_png = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_foto.png";
		$foto_jpg = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_foto.jpg";
		$foto_pdf = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_foto.pdf";
		if (file_exists($foto_png)) {
			$foto_ext="png";
		} else if (file_exists($foto_jpg)) {
			$foto_ext="jpg";
		} else if (file_exists($foto_pdf)) {
			$foto_ext="pdf";
		} else {
			$foto_ext="";
		}
		$cedula_png = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_cedula.png";
		$cedula_jpg = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_cedula.jpg";
		$cedula_pdf = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_cedula.pdf";
		if (file_exists($cedula_png)) {
			$cedula_ext="png";
		} else if (file_exists($cedula_jpg)) {
			$cedula_ext="jpg";
		} else if (file_exists($cedula_pdf)) {
			$cedula_ext="pdf";
		} else {
			$cedula_ext="";
		}
		$rif_png = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_rif.png";
		$rif_jpg = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_frifjpg";
		$rif_pdf = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_rif.pdf";
		if (file_exists($rif_png)) {
			$rif_ext="png";
		} else if (file_exists($rif_jpg)) {
			$rif_ext="jpg";
		} else if (file_exists($rif_pdf)) {
			$rif_ext="pdf";
		} else {
			$rif_ext="";
		}
		$titulo_png = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_titulo.png";
		$titulo_jpg = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_titulo.jpg";
		$titulo_pdf = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$cedula."/".$cedula."_titulo.pdf";
		if (file_exists($titulo_png)) {
			$titulo_ext="png";
		} else if (file_exists($titulo_jpg)) {
			$titulo_ext="jpg";
		} else if (file_exists($titulo_pdf)) {
			$titulo_ext="pdf";
		} else {
			$titulo_ext="";
		}
		$foto = "/assets/documentos/".$cedula."/".$cedula."_foto.".$foto_ext;
		$foto_mini = "/assets/documentos/".$cedula."/mini_".$cedula."_foto.".$foto_ext;
		$rif = "/assets/documentos/".$cedula."/".$cedula."_rif.".$rif_ext;
		$rif_mini = "/assets/documentos/".$cedula."/mini_".$cedula."_rif.".$rif_ext;
		$titulo = "/assets/documentos/".$cedula."/".$cedula."_titulo.".$titulo_ext;
		$titulo_mini = "/assets/documentos/".$cedula."/mini_".$cedula."_titulo.".$titulo_ext;
		$cedula_mini = "/assets/documentos/".$cedula."/mini_".$cedula."_cedula.".$cedula_ext;
		$cedulai = "/assets/documentos/".$cedula."/".$cedula."_cedula.".$cedula_ext;
		$archivos = array (
			array(
				"foto" => $foto,
				"cedula" => $cedulai,
				"rif" => $rif,
				"titulo" => $titulo,
				"foto_mini" => $foto_mini,
				"cedula_mini" => $cedula_mini,
				"rif_mini" => $rif_mini,
				"titulo_mini" => $titulo_mini,
				"ext_foto" => $foto_ext,
				"ext_cedula" => $cedula_ext,
				"ext_rif" => $rif_ext,
				"ext_titulo" => $titulo_ext
			)
		);
		echo json_encode($archivos, JSON_UNESCAPED_UNICODE);
	}
	public function get_responsables_proyecto() {
		$id = $this->input->post("id");
		$query = $this->perfil->get_responsables_investigacion($id);
		echo json_encode($query, JSON_UNESCAPED_UNICODE);
	}
	public function get_investigaciones() {
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$query = $this->perfil->listar_investigaciones();
		$data = [];
		foreach($query->result() as $r) {
			$data[] = array(
				$r->acciones='			
				<a class="btn btn-xs bgc-success clight" href="javascript:void(0)" title="Ver Ficha" onclick="ver('."'".$r->id_perfil_investigacion."'".')"><i class="fa fa-eye fa-2x"></i></a>
				<a class="btn btn-xs bgc-danger clight" href="javascript:void(0)" title="Eliminar" onclick="suspender('."'".$r->id_perfil_investigacion."'".')"><i class="fa fa-trash fa-2x"></i></a>',
				$r->id_perfil_investigacion,
				$r->titulo_investigacion,
				$r->fecha_culminacion,
				$r->resultado_investigacion,
				$r->cpolitica_publica,
				$r->politica_publica,
				$r->linea_investigacion,
				$r->objetivo_investigacion,
				$r->tipo_investigacion,
				$r->fase,
				$r->tiempo 
			);			
		}
		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);
		echo json_encode($result);		
	}
	public function suspender_investigacion() {
		$id=$this->input->post("id");
		$query = $this->perfil->suspender_investigacion($id);
		echo json_encode($query, JSON_UNESCAPED_UNICODE);
	}
	public function buscar_responsables() {
		$cedula = $this->input->post("cedula");
		$query = $this->perfil->buscar_responsables($cedula);
		echo json_encode($query, JSON_UNESCAPED_UNICODE);
	}
	public function agregar_perfl_investigador() {
		$perfil = $this->input->post();
		$query = $this->perfil->agregar_perfl_investigador($this->input->post());
		echo json_encode($query);
	}
	public function actualizar_perfl_investigador() {
		$perfil = $this->input->post();
		$query = $this->perfil->actualizar_perfl_investigador($this->input->post());
		echo json_encode($query);
	}
	public function registrar_trayectoria() {
		$query = $this->perfil->registrar_trayectoria($this->input->post());
		echo json_encode($query);
	}
	public function registrar_investigacion() {
		$query = $this->perfil->registrar_investigacion($this->input->post());
		echo json_encode($query);
	}
	public function registrar_investigacion_act() {
		$sesion = print_r($_SESSION,true);
		$query = $this->perfil->registrar_investigacion_act($this->input->post());
		$ficha_ejecucion = 0;
		$proyecto_ejecucion = 0;
		foreach ($_SESSION as $k => $v) {
			if($v==="ficha_ejecucion") {
				$ficha_ejecucion = 1;
				$arc[]=$v;
				unset($_SESSION[$k]);
			}
			if($v==="proyecto_ejecucion") {
				$proyecto_ejecucion = 1;
				$arc[]=$v;
				unset($_SESSION[$k]);
			}
		}
		if ($ficha_ejecucion == 1 && $proyecto_ejecucion == 1) {
			$nombre_viejo0 = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$this->session->userdata("cedula")."/".$this->session->userdata("cedula")."_ficha_ejecucion.pdf";
			$nombre_nuevo0 = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$this->session->userdata("cedula")."/".$this->session->userdata("cedula")."_ficha_ejecucion_".$query.".pdf";
			$nombre_viejo1 = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$this->session->userdata("cedula")."/".$this->session->userdata("cedula")."_proyecto_ejecucion.pdf";
			$nombre_nuevo1 = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$this->session->userdata("cedula")."/".$this->session->userdata("cedula")."_proyecto_ejecucion_".$query.".pdf";
			rename($nombre_viejo0,$nombre_nuevo0);
			rename($nombre_viejo1,$nombre_nuevo1);
		} else {
			foreach ($_SESSION as $k => $v) {
				$cad = substr($k,0,12);
				if($cad == "tipo_archivo") {
					$nombre_viejo = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$this->session->userdata("cedula")."/".$this->session->userdata("cedula")."_".$v.".pdf";
					$nombre_nuevo = $_SERVER["DOCUMENT_ROOT"]."/assets/documentos/".$this->session->userdata("cedula")."/".$this->session->userdata("cedula")."_".$v."_".$query.".pdf";
					if (file_exists($nombre_viejo)) {
						rename($nombre_viejo,$nombre_nuevo);	
					}
				}
			}
		}
		echo json_encode($query);
	}
	public function verificar_rif() {
		$query = $this->perfil->verificar_rif($this->input->post());
		echo $query;
	}
	public function cargar_documento1() {
		$tipo = $this->uri->segment(3);
		$this->session->unset_userdata('tipo');
		$dir = "assets/documentos/".$this->session->userdata("cedula")."/";
		if (!file_exists($_SERVER["DOCUMENT_ROOT"]."/".$dir))
			mkdir($_SERVER["DOCUMENT_ROOT"]."/".$dir,0777,true);
		if(isset($_FILES["file"]["name"])) {
			$config['upload_path'] = './'.$dir;
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('file')) {
				echo $this->upload->display_errors();
			} else {
				$data = $this->upload->data();
				if ($data["file_size"] > 2048.00) {
					unlink($dir.$data["file_name"]);
					echo "El archivo es demasiado grande para ser subido, debe tener un máximo de 2Mb";
				} else {
					$cedula = $this->session->userdata("cedula");
					$documento = $_SERVER["DOCUMENT_ROOT"]."/".$dir.$cedula."_".$tipo.".*";
					$miniatura = $_SERVER["DOCUMENT_ROOT"]."/".$dir."mini_".$cedula."_".$tipo.".*";
					if (glob($documento)) {
						$arch = glob($documento);
						foreach ($arch as $a) {
							unlink($a);
						}
					}
					if (glob($miniatura)) {
						$mini = glob($miniatura);
						foreach ($mini as $m) {
							unlink($m);
						}
					}
					$ext = strtolower(substr( $data["file_name"], strpos( $data["file_name"], '.') ));
					$nombre_nuevo = $this->session->userdata("cedula")."_".$tipo.$ext;
					$ctipo = $data["file_type"];
					if (strpos($ctipo, 'image') !== false) {
						$tipo_d = "imagen";
					} else if(strpos($ctipo, 'application/pdf') !== false){
						$tipo_d = "pdf";
					}
					if ($tipo_d == "imagen") {
						if (exif_imagetype($dir.$data["file_name"]) ==2) {
							imagepng(imagecreatefromjpeg($dir.$data["file_name"]), $dir.$nombre_nuevo);
						} else {
							rename($dir.$data["file_name"],$dir.$nombre_nuevo);
						}
						if (file_exists($dir.$data["file_name"])) {
							unlink($dir.$data["file_name"]);
						}
						$tam = getimagesize($dir.$nombre_nuevo);
						$tam_arch = $data["file_name"];
						$archivo =$dir.$nombre_nuevo;
						$nuevo = imagecreatefrompng($archivo);
						$miniatura = imagecreatetruecolor(300, 200);
						$ancho_original = imagesx($nuevo);
						$alto_original = imagesy($nuevo);
						if ($tam[0] > $tam[1]) {
							$ancho = 300;
							$alto = 200;
						} else {
							$alto = 300;
							$ancho = 200;		
						}
						imagecopyresampled($miniatura,$nuevo,0,0,0,0,$ancho,$alto,$ancho_original,$alto_original);		
						$nombre_miniatura = $dir."mini_$nombre_nuevo";
						imagepng($miniatura, $nombre_miniatura);
						echo '<img src="'.base_url().$nombre_miniatura.'"class="img-responsive img-thumbnail" />';
					} else {					
						$nombre_nuevo = $this->session->userdata("cedula")."_".$tipo.$ext;
						rename($dir.$data["file_name"],$dir.$nombre_nuevo);
						$this->session->set_userdata('tipo_archivo',$tipo);
						echo "img";
					}
				}
			}
		}
	}
	public function cargar_documento2() {
		$tipo = $this->uri->segment(3);
		$this->session->unset_userdata('tipo');
		$dir = "assets/documentos/".$this->session->userdata("cedula")."/";
		if (!file_exists($_SERVER["DOCUMENT_ROOT"]."/".$dir))
			mkdir($_SERVER["DOCUMENT_ROOT"]."/".$dir,0777,true);
		if(isset($_FILES["file"]["name"])) {
			$config['upload_path'] = './'.$dir;
			$config['allowed_types'] = 'pdf';
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('file')) {
				echo $this->upload->display_errors();
			} else {
				$data = $this->upload->data();
				if ($data["file_size"] > 2048.00) {
					echo "El archivo es demasiado grande para ser subido, debe tener un máximo de 2Mb";
					unlink($dir.$data["file_name"]);
				} else {
					$nom = $data["file_name"];
					$ext = substr( $nom, strpos( $nom, '.') );
					$nombre_nuevo = $this->session->userdata("cedula")."_".$tipo.$ext;
					rename($dir.$data["file_name"],$dir.$nombre_nuevo);
					if (file_exists($dir.$data["file_name"])) {
						unlink($dir.$data["file_name"]);
					}
					// if ($this->session->userdata('tipo_archivo') !== FALSE) {
					$tpa = 'tipo_archivo_'.$tipo;
					$this->session->set_userdata($tpa,$tipo);
					// $this->session->set_userdata('tipo_archivo',$tipo);
					// } 
					echo "img";
				}
			}
		}
	}
	public function get_niveles() {
		echo json_encode($this->perfil->get_niveles(), JSON_UNESCAPED_UNICODE);
	}
	public function get_estatus() {
		echo json_encode($this->perfil->get_estatus(), JSON_UNESCAPED_UNICODE);
	}
	public function get_institucion_educativa() {
		echo json_encode($this->perfil->get_institucion_educativa(), JSON_UNESCAPED_UNICODE);
	}
	public function get_especialidad_salud() {
		echo json_encode($this->perfil->get_especialidad_salud(), JSON_UNESCAPED_UNICODE);
	}
	public function get_areas() {
		echo json_encode($this->perfil->get_areas(), JSON_UNESCAPED_UNICODE);
	}
	public function get_sub_areas() {
		$area = $this->uri->segment(3);
		echo json_encode($this->perfil->get_sub_areas($area), JSON_UNESCAPED_UNICODE);
	}
	public function get_munsalud() {
		if ($this->input->post("estado")) {
			$estado = $this->input->post("estado");
			echo json_encode($this->perfil->get_munsalud($estado), JSON_UNESCAPED_UNICODE);
		} else {
			return true;
		}
	}
	public function get_parsalud() {
		$estado = $this->input->post("estado");
		$municipio = $this->input->post("municipio");
		echo json_encode($this->perfil->get_parsalud($estado,$municipio), JSON_UNESCAPED_UNICODE);
	}
	public function get_censalud() {
		$estado = $this->input->post("estado");
		$municipio = $this->input->post("municipio");
		$parroquia = $this->input->post("parroquia");
		echo json_encode($this->perfil->get_censalud($estado,$municipio,$parroquia), JSON_UNESCAPED_UNICODE);
	}
	public function get_datos_comuna() {
		$id_comuna = $this->input->post("id_comuna");
		echo json_encode($this->perfil->get_datos_comuna($id_comuna), JSON_UNESCAPED_UNICODE);
	}
	public function get_comuna() {
		$tipo = $this->input->post("tipo");
		echo json_encode($this->perfil->get_comuna($tipo), JSON_UNESCAPED_UNICODE);		
	}
	public function get_edo_mun_par_por_centro() {
		$centro = $this->input->post("id_centro");
		echo json_encode($this->perfil->get_edo_mun_par_por_centro($centro), JSON_UNESCAPED_UNICODE);
	}
	public function get_nombre_salud() {
		$cod_centro = $this->input->post("id_centro");
		echo json_encode($this->perfil->get_nombre_salud($cod_centro), JSON_UNESCAPED_UNICODE);
	}
	public function get_insti_etica() {
		$id_tipo_etica=$this->input->post("id_tipo_etica");
		$id_centro=$this->input->post("id_centro");
		echo json_encode($this->perfil->get_insti_etica($id_tipo_etica,$id_centro), JSON_UNESCAPED_UNICODE);
	}
	public function pdf_inv_actual() {
		$this->load->library('pdf');
		$data["pdf"] = $this->input->post("pdf");
		$data["investigador_actual"] = $this->perfil->investigador_actual();
		$html = $this->load->view('perfil/ficha_inv_act_view.php', $data, TRUE);
		$archivo = "assets/documentos/fichas_actuales/".$this->session->userdata("cedula")."_ficha_investigacion_actual.pdf";
		$this->pdf->load_html($html);
		$this->pdf->set_paper("Letter", "portrait");
		$this->pdf->render();
		$salida = $this->pdf->output();
		file_put_contents($archivo,$salida);
		echo json_encode(base_url().$archivo);
	}
	public function select_sencillo() {
		$tabla=$this->input->post("tabla");
		$id=$this->input->post("id");
		$valor=$this->input->post("valor");
		if (null !== $this->input->post("orden")) {
			$orden = 1;
		} else {
			$orden = 0;
		}
		echo json_encode($this->perfil->select_sencillo($tabla,$id,$valor,$orden), JSON_UNESCAPED_UNICODE);
	}

}
