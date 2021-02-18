<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reportes extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('login_model','login');
		$this->load->model("menu_model","menu");
		$this->load->model("registro_model","registro");
		$this->load->model("reportes_model","reportes");
	}
	public function registros() {
		$cedula = $this->session->userdata('cedula');
		$this->session->set_userdata('titulo_url'," &nbsp;Reportes");
		$grupo_usuario = $this->menu->get_grupo_usuario();
		$menu1["grupo_usuario"] = $grupo_usuario;
		$menu1['buscar'] = false;
		$menu1["menu"] = $this->menu->get_full_menu($grupo_usuario);		
		$empresa = $this->login->get_empresa();
		$titulo["titulo"]=$empresa[0]["titulo"];
		$pie["pie"] = $this->menu->get_pie_aplicacion();
		// $data["investigador"] = $this->reportes->buscar_investigador($cedula);
		$this->load->view('plantillas/cintillo');
		$this->load->view('plantillas/encabezado',$titulo);
		$this->load->view('plantillas/cuerpo');
		$this->load->view('plantillas/superior');
		$this->load->view('plantillas/menu_izquierdo',$menu1);
		$this->load->view('plantillas/inicio_contenido');
		$this->load->view('reportes/reportes_registrso_view.php',$data);
		$this->load->view('plantillas/pie_pagina',$pie);
		$this->load->view('plantillas/pie');
	}
	public function generar_excel_registros() {
		$fini = $this->input->post("fini");
		$ffin = $this->input->post("ffin");
		$objFini = date_create_from_format('Y-m-d', $fini);
		$objFfin = date_create_from_format('Y-m-d', $ffin);
		$fini1 = date_format($objFini, "d/m/Y");		
		$ffin1 = date_format($objFfin, "d/m/Y");
		$fecha_hora1 = date("Y-m-d_H-i-s");
		$fecha_hora2 = date("d/m/Y h:i:s A");
		$registros = $this->reportes->obtener_registros($fini,$ffin);
		if(count($registros) > 0) {
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Registros');
			$this->excel->getActiveSheet()->mergeCells("A1:L1");
			$this->excel->getActiveSheet()->mergeCells("A2:L2");
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(18);
			$this->excel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A2")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle('A3:AA3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A:A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('G:G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('L:L')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('M:M')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			$this->excel->getActiveSheet()->getStyle('M:M')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('N:N')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->setCellValue("A1", 'ONCTI - PROGRAMA NACIONAL DE INVESTIGADORES E INVESTIGADORAS - REPORTE DE REGISTROS POR FECHA');
			$this->excel->getActiveSheet()->setCellValue("A2", 'DESDE EL '.$fini1.' HASTA EL '.$ffin1." Emitido el ".$fecha_hora2);	
			$contador = 3;
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(25);
			$this->excel->getActiveSheet()->getStyle("A3:AA3")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", 'CÉDULA');	
			$this->excel->getActiveSheet()->setCellValue("B{$contador}", 'P. NOMBRE');
			$this->excel->getActiveSheet()->setCellValue("C{$contador}", 'S. NOMBRE');
			$this->excel->getActiveSheet()->setCellValue("D{$contador}", 'P. APELLIDO');	
			$this->excel->getActiveSheet()->setCellValue("E{$contador}", 'S. APELLIDO');
			$this->excel->getActiveSheet()->setCellValue("F{$contador}", 'GÉNERO');
			$this->excel->getActiveSheet()->setCellValue("G{$contador}", 'FECHA NAC.');	
			$this->excel->getActiveSheet()->setCellValue("H{$contador}", 'EDO. CIVIL');
			$this->excel->getActiveSheet()->setCellValue("I{$contador}", 'ESTADO');
			$this->excel->getActiveSheet()->setCellValue("J{$contador}", 'MUNICIPIO');	
			$this->excel->getActiveSheet()->setCellValue("K{$contador}", 'PARROQUIA');
			$this->excel->getActiveSheet()->setCellValue("L{$contador}", 'COD. POSTAL');
			$this->excel->getActiveSheet()->setCellValue("M{$contador}", 'TELÉFONO');	
			$this->excel->getActiveSheet()->setCellValue("N{$contador}", 'CELULAR');
			$this->excel->getActiveSheet()->setCellValue("O{$contador}", 'CORREO');
			$this->excel->getActiveSheet()->setCellValue("P{$contador}", 'PROFESION');	
			$this->excel->getActiveSheet()->setCellValue("Q{$contador}", 'TIPO INSTIT.');
			$this->excel->getActiveSheet()->setCellValue("R{$contador}", 'NOMBRE INSTIT.');	
			$this->excel->getActiveSheet()->setCellValue("S{$contador}", 'INTERES INV. 1.');
			$this->excel->getActiveSheet()->setCellValue("T{$contador}", 'INTERES INV. 2');
			$this->excel->getActiveSheet()->setCellValue("U{$contador}", 'INTERES INV. 3');
			$this->excel->getActiveSheet()->setCellValue("V{$contador}", 'INVESTIGACION ACT. 1.');
			$this->excel->getActiveSheet()->setCellValue("W{$contador}", 'INVESTIGACION ACT. 2');
			$this->excel->getActiveSheet()->setCellValue("X{$contador}", 'INVESTIGACION ACT. 3');
			$this->excel->getActiveSheet()->setCellValue("Y{$contador}", 'MODO INVESTIG.');			
			$this->excel->getActiveSheet()->setCellValue("Z{$contador}", 'ACTIVO');
			$this->excel->getActiveSheet()->setCellValue("AA{$contador}", 'FECHA REG.');
			foreach($registros as $l){
				$contador++;
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", $l->ci_investigador);
				$this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->pnombre);
				$this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->snombre);
				$this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->papellido);
				$this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->sapellido);
				$this->excel->getActiveSheet()->setCellValue("F{$contador}", $l->nombre_genero);
				$this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->fecha_nac);
				$this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->nombre_estado);
				$this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->estado);
				$this->excel->getActiveSheet()->setCellValue("J{$contador}", $l->municipio);
				$this->excel->getActiveSheet()->setCellValue("K{$contador}", $l->parroquia);
				$this->excel->getActiveSheet()->setCellValue("L{$contador}", $l->codigo_postal);
				$this->excel->getActiveSheet()->setCellValue("M{$contador}", $l->telefono);
				$this->excel->getActiveSheet()->setCellValue("N{$contador}", $l->celular);
				$this->excel->getActiveSheet()->setCellValue("O{$contador}", $l->correo);
				$this->excel->getActiveSheet()->setCellValue("P{$contador}", $l->profesion);
				$this->excel->getActiveSheet()->setCellValue("Q{$contador}", $l->tipo_institucion);
				$this->excel->getActiveSheet()->setCellValue("R{$contador}", $l->nombre_institucion);
				$this->excel->getActiveSheet()->setCellValue("S{$contador}", $l->linea_inv1);
				$this->excel->getActiveSheet()->setCellValue("T{$contador}", $l->linea_inv2);
				$this->excel->getActiveSheet()->setCellValue("U{$contador}", $l->linea_inv3);
				$this->excel->getActiveSheet()->setCellValue("V{$contador}", $l->linea_act1);
				$this->excel->getActiveSheet()->setCellValue("W{$contador}", $l->linea_act2);
				$this->excel->getActiveSheet()->setCellValue("X{$contador}", $l->linea_act3);
				$this->excel->getActiveSheet()->setCellValue("Y{$contador}", $l->modo_investigacion);
				$this->excel->getActiveSheet()->setCellValue("Z{$contador}", $l->activo);
				$this->excel->getActiveSheet()->setCellValue("AA{$contador}", $l->fecha_creacion);
			}
			$archivo = "registros_".$fecha_hora1.".xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$archivo.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
			$objWriter->save('php://output');
		} else {
			?>
			<script type="text/javascript">
				var base = "<?php echo 'http://'.$_SERVER['SERVER_NAME']; ?>";
				alert('No se han encontrado registros en el intervalo especificado');
				location.href = base+'/reportes/registros';
			</script>
			<?php 
		}
	}
	public function generar_excel_investigador() {
		$fini = $this->input->post("fini");
		$ffin = $this->input->post("ffin");
		$objFini = date_create_from_format('Y-m-d', $fini);
		$objFfin = date_create_from_format('Y-m-d', $ffin);
		$fini1 = date_format($objFini, "d/m/Y");		
		$ffin1 = date_format($objFfin, "d/m/Y");
		$fecha_hora1 = date("Y-m-d_H-i-s");
		$fecha_hora2 = date("d/m/Y h:i:s A");
		$registros = $this->reportes->obtener_investigador($fini,$ffin);
		if(count($registros) > 0) {
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Registros');
			$this->excel->getActiveSheet()->mergeCells("A1:L1");
			$this->excel->getActiveSheet()->mergeCells("A2:L2");
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(18);
			$this->excel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A2")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle('A3:AA3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A:A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('F:F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('M:M')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('N:N')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->setCellValue("A1", 'ONCTI - PROGRAMA NACIONAL DE INVESTIGADORES E INVESTIGADORAS - REPORTE DE PERFIL DEL INVESTIGADOR REGISTRADOS POR FECHA');
			$this->excel->getActiveSheet()->setCellValue("A2", 'DESDE EL '.$fini1.' HASTA EL '.$ffin1." Emitido el ".$fecha_hora2);	
			$contador = 3;
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", 'CÉDULA');	
			$this->excel->getActiveSheet()->setCellValue("B{$contador}", 'P. NOMBRE');
			$this->excel->getActiveSheet()->setCellValue("C{$contador}", 'S. NOMBRE');
			$this->excel->getActiveSheet()->setCellValue("D{$contador}", 'P. APELLIDO');	
			$this->excel->getActiveSheet()->setCellValue("E{$contador}", 'S. APELLIDO');
			$this->excel->getActiveSheet()->setCellValue("F{$contador}", 'RIF');
			$this->excel->getActiveSheet()->setCellValue("G{$contador}", 'NIVEL ACADÉMICO.');	
			$this->excel->getActiveSheet()->setCellValue("H{$contador}", 'ESTATUS ACADÉMICO');
			$this->excel->getActiveSheet()->setCellValue("I{$contador}", 'INSTITUCIÓN ACADÉMICA');
			$this->excel->getActiveSheet()->setCellValue("J{$contador}", 'ESPECIALIDAD SALUD');	
			$this->excel->getActiveSheet()->setCellValue("K{$contador}", 'ÁREA DE CONOCIMIENTO');
			$this->excel->getActiveSheet()->setCellValue("L{$contador}", 'SUB ÁREA');
			$this->excel->getActiveSheet()->setCellValue("M{$contador}", 'ACTIVO');
			$this->excel->getActiveSheet()->setCellValue("N{$contador}", 'FECHA CREACIÓN');	
			foreach($registros as $l){
				$contador++;
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", $l->ci_investigador);
				$this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->pnombre);
				$this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->snombre);
				$this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->papellido);
				$this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->sapellido);
				$this->excel->getActiveSheet()->setCellValue("f{$contador}", $l->rif_investigador);
				$this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->nivel_academico);
				$this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->estatus_academico);
				$this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->nombre_institucion_academica);
				$this->excel->getActiveSheet()->setCellValue("J{$contador}", $l->nombre_especialidad_salud);
				$this->excel->getActiveSheet()->setCellValue("K{$contador}", $l->area_conocimiento);
				$this->excel->getActiveSheet()->setCellValue("L{$contador}", $l->sub_area);
				$this->excel->getActiveSheet()->setCellValue("M{$contador}", $l->activo);
				$this->excel->getActiveSheet()->setCellValue("N{$contador}", $l->fecha_creacion);
			}
			$archivo = "investigadores_".$fecha_hora1.".xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$archivo.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
			$objWriter->save('php://output');
		} else {
			?>
			<script type="text/javascript">
				var base = "<?php echo 'http://'.$_SERVER['SERVER_NAME']; ?>";
				alert('No se han encontrado registros en el intervalo especificado');
				location.href = base+'/reportes/registros';
			</script>
			<?php 
		}
	}
	public function generar_excel_investigacion() {
		$fini = $this->input->post("fini");
		$ffin = $this->input->post("ffin");
		$objFini = date_create_from_format('Y-m-d', $fini);
		$objFfin = date_create_from_format('Y-m-d', $ffin);
		$fini1 = date_format($objFini, "d/m/Y");		
		$ffin1 = date_format($objFfin, "d/m/Y");
		$fecha_hora1 = date("Y-m-d_H-i-s");
		$fecha_hora2 = date("d/m/Y h:i:s A");
		$registros = $this->reportes->obtener_investigacion($fini,$ffin);
		if(count($registros) > 0) {
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Registros');
			$this->excel->getActiveSheet()->mergeCells("A1:L1");
			$this->excel->getActiveSheet()->mergeCells("A2:L2");
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(18);
			$this->excel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A2")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle('A3:AA3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A:A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('B:B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('J:J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('J:J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('M:M')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			
			$this->excel->getActiveSheet()->getStyle('O:O')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('P:P')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('Q:Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->setCellValue("A1", 'ONCTI - PROGRAMA NACIONAL DE INVESTIGADORES E INVESTIGADORAS - REPORTE DE PERFIL DE LAS INVESTIGACIONES REGISTRADOS POR FECHA');
			$this->excel->getActiveSheet()->setCellValue("A2", 'DESDE EL '.$fini1.' HASTA EL '.$ffin1." Emitido el ".$fecha_hora2);	
			$contador = 3;
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(60);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(60);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);		
			$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", 'CÉDULA');	
			$this->excel->getActiveSheet()->setCellValue("B{$contador}", 'INCIDE EN ALGUNA PP');
			$this->excel->getActiveSheet()->setCellValue("C{$contador}", 'CUÁL PP');
			$this->excel->getActiveSheet()->setCellValue("D{$contador}", 'LÍNEA INVESTIGACIÓN');	
			$this->excel->getActiveSheet()->setCellValue("E{$contador}", 'TIPO INVESTIGACIÓN');
			$this->excel->getActiveSheet()->setCellValue("F{$contador}", 'FASE');
			$this->excel->getActiveSheet()->setCellValue("G{$contador}", 'TIPO INST.');	
			$this->excel->getActiveSheet()->setCellValue("H{$contador}", 'CENTRO');
			$this->excel->getActiveSheet()->setCellValue("I{$contador}", 'TITULO INVESTIGACIÓN');
			$this->excel->getActiveSheet()->setCellValue("J{$contador}", 'FECHA CULMINACIÓN');	
			$this->excel->getActiveSheet()->setCellValue("K{$contador}", 'OBJETIVO INVESTIGACION');
			$this->excel->getActiveSheet()->setCellValue("L{$contador}", 'RESULTADO INVESTIGACION');
			$this->excel->getActiveSheet()->setCellValue("M{$contador}", 'PUBLICADA');
			$this->excel->getActiveSheet()->setCellValue("N{$contador}", 'ENLACE PUBLICACION');			
			$this->excel->getActiveSheet()->setCellValue("O{$contador}", 'TIEMPO INV.');
			$this->excel->getActiveSheet()->setCellValue("P{$contador}", 'ACTIVO');
			$this->excel->getActiveSheet()->setCellValue("Q{$contador}", 'FECHA CREACIÓN');	
			foreach($registros as $l){
				$contador++;
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", $l->ci_investigador);
				$this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->impacto_politica_publica);
				$this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->politica_publica);
				$this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->linea_investigacion);
				$this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->tipo_investigacion);
				$this->excel->getActiveSheet()->setCellValue("F{$contador}", $l->fase);
				$this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->tipo_institucion);
				$this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->centro);
				$this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->titulo_investigacion);
				$this->excel->getActiveSheet()->setCellValue("J{$contador}", $l->fecha_culminacion);
				$this->excel->getActiveSheet()->setCellValue("K{$contador}", $l->objetivo_investigacion);
				$this->excel->getActiveSheet()->setCellValue("L{$contador}", $l->resultado_investigacion);
				$this->excel->getActiveSheet()->setCellValue("M{$contador}", $l->publicada);
				$this->excel->getActiveSheet()->setCellValue("N{$contador}", $l->link_publicacion);
				$this->excel->getActiveSheet()->setCellValue("O{$contador}", $l->tiempo_investigacion);
				$this->excel->getActiveSheet()->setCellValue("P{$contador}", $l->activo);
				$this->excel->getActiveSheet()->setCellValue("Q{$contador}", $l->fecha_registro);
			}
			$archivo = "investigaciones_".$fecha_hora1.".xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$archivo.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
			$objWriter->save('php://output');
		} else {
			?>
			<script type="text/javascript">
				var base = "<?php echo 'http://'.$_SERVER['SERVER_NAME']; ?>";
				alert('No se han encontrado registros en el intervalo especificado');
				location.href = base+'/reportes/registros';
			</script>
			<?php 
		}
	}

	public function generar_excel_actual() {
		$fini = $this->input->post("fini");
		$ffin = $this->input->post("ffin");
		$objFini = date_create_from_format('Y-m-d', $fini);
		$objFfin = date_create_from_format('Y-m-d', $ffin);
		$fini1 = date_format($objFini, "d/m/Y");		
		$ffin1 = date_format($objFfin, "d/m/Y");
		$fecha_hora1 = date("Y-m-d_H-i-s");
		$fecha_hora2 = date("d/m/Y h:i:s A");
		$registros = $this->reportes->obtener_actual($fini,$ffin);
		if(count($registros) > 0) {
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Registros');
			$this->excel->getActiveSheet()->mergeCells("A1:L1");
			$this->excel->getActiveSheet()->mergeCells("A2:L2");
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(18);
			$this->excel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A2")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle('A3:AA3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle("A3:AA3")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A3:AA3')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->setCellValue("A1", 'ONCTI - PROGRAMA NACIONAL DE INVESTIGADORES E INVESTIGADORAS - REPORTE DE INVESTIGACIONES ACTUALES REGISTRADOS POR FECHA');
			$this->excel->getActiveSheet()->setCellValue("A2", 'DESDE EL '.$fini1.' HASTA EL '.$ffin1." Emitido el ".$fecha_hora2);	
			$contador = 3;
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(60);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(25);		
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", 'CÉDULA');	
			$this->excel->getActiveSheet()->setCellValue("B{$contador}", 'TÍTULO INVESTIGACIÓN');
			$this->excel->getActiveSheet()->setCellValue("C{$contador}", 'TIPO INSTITUCIÓN');
			$this->excel->getActiveSheet()->setCellValue("D{$contador}", 'CENTRO');	
			$this->excel->getActiveSheet()->setCellValue("E{$contador}", 'LÍNEA INVESTIGACIÓN');
			$this->excel->getActiveSheet()->setCellValue("F{$contador}", 'RESULTADO INVESTIGACIÓN');
			$this->excel->getActiveSheet()->setCellValue("G{$contador}", 'TIPO INVESTIGACIÓN');	
			$this->excel->getActiveSheet()->setCellValue("H{$contador}", 'FASE');
			$this->excel->getActiveSheet()->setCellValue("I{$contador}", 'TIEMPO INVESTIGACIÓN');
			$this->excel->getActiveSheet()->setCellValue("J{$contador}", 'OBJETIVO INVESTIGACIÓN');	
			$this->excel->getActiveSheet()->setCellValue("K{$contador}", 'INSTITUCIÓN ÉTICA');
			$this->excel->getActiveSheet()->setCellValue("L{$contador}", 'IMPACTO INVESTIGACIÓN');
			$this->excel->getActiveSheet()->setCellValue("M{$contador}", 'PUBLICADA');
			$this->excel->getActiveSheet()->setCellValue("N{$contador}", 'ENLACE');
			$this->excel->getActiveSheet()->setCellValue("O{$contador}", 'ACTIVO');
			$this->excel->getActiveSheet()->setCellValue("P{$contador}", 'FECHA REGISTRO');
			foreach($registros as $l){
				$contador++;
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", $l->ci_investigador);
				$this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->titulo_investigacion);
				$this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->tipo_institucion);
				$this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->centro);
				$this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->linea_investigacion);
				$this->excel->getActiveSheet()->setCellValue("F{$contador}", $l->resultado_investigacion);
				$this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->tipo_investigacion);
				$this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->fase);
				$this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->tiempo_investigacion);
				$this->excel->getActiveSheet()->setCellValue("J{$contador}", $l->objetivo_investigacion);
				$this->excel->getActiveSheet()->setCellValue("K{$contador}", $l->institucion_etica);
				$this->excel->getActiveSheet()->setCellValue("L{$contador}", $l->impacto_investigacion);
				$this->excel->getActiveSheet()->setCellValue("M{$contador}", $l->publicado);
				$this->excel->getActiveSheet()->setCellValue("N{$contador}", $l->enlace_publicacion);
				$this->excel->getActiveSheet()->setCellValue("O{$contador}", $l->activo);
				$this->excel->getActiveSheet()->setCellValue("P{$contador}", $l->fecha_registro);
			}
			$archivo = "actual_".$fecha_hora1.".xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$archivo.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
			$objWriter->save('php://output');
		} else {
			?>
			<script type="text/javascript">
				var base = "<?php echo 'http://'.$_SERVER['SERVER_NAME']; ?>";
				alert('No se han encontrado registros en el intervalo especificado');
				location.href = base+'/reportes/registros';
			</script>
			<?php 
		}
	}


}
