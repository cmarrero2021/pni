<?php
class DBlog_Hook {
	var $path    = 'sistema/logs/';
	function DBlog_Hook() {
		$this->CI =& get_instance();
	}
	function log_all_query() {
		$this->ci = &get_instance();
		$this->dbtable="public.auditoria";
		$dbs    = array();
		$output = NULL;
		$queries = $this->CI->db->queries;
		if (count($queries) > 0) {
			foreach ($queries as $query) {
				if (stripos($query,'select') === false || stripos($query,'public.auditoria')) {
					$ultimoid = $this->ci->db->query('select event_id,previa,actual from audit.vreciente')->row();
					$ultimo_id = $ultimoid->event_id;
					$data['estado_previo'] = $ultimoid->previa;
					$data['estado_actual'] = $ultimoid->actual;
					$query1 = preg_replace("[\n|\r|\n\r]", ' ', $query);
					if (strtoupper(substr(PHP_OS, 0, 3)) =="WIN") {
						$salida = shell_exec('arp -a');
					} else {
						$salida = shell_exec('arp -n');
					}
					$datos = explode("\n", $salida);
					$subdatos =$datos[3];
					$subdatos2 =$datos[1];
					$info2 = explode(" ",$subdatos2);
					$info = explode(" ",$subdatos);
					$data['ip'] = $_SERVER['REMOTE_ADDR'];
					$data['equipo'] = $info[14];
					$accion = explode(" ",$query);
					switch ($accion[0]) {
						case 'INSERT':
						$acc = 'INSERTAR';
						break;
						
						case 'UPDATE':
						$acc = 'MODIFICAR';
						break;
						
						case 'DELETE':
						$acc = 'ELIMINAR';
						break;
						
						default:
						$acc = 'SET';
						break;
					}
					if ($acc=='MODIFICAR') {
						$tabla = $accion[1];
					} else {
						$tabla = $accion[2];
					}
					$tabla = str_replace('"','',$tabla);
					$data['tabla'] = $tabla;
					$ced = $this->ci->session->userdata('cedula');
					$data['usuario'] = $ced;
					$data['accion']=$acc;
					$data['sql']=$query1;
					if ($data['accion'] != 'SET') {

						$this->ci->db->insert($this->dbtable,$data);
					//* SI SE DESEA GENERAR UN LOG EN ARCHIVO, DESCOMENTAR 
					//* $output .= $query1 ."\n";
					//* $this->CI->load->helper('file');
					//* if ( ! write_file($this->path . 'queries.txt', $output, 'a+')) {
					//*	log_message('debug','Unable to write the file');
					//*}
					}
				}
			}
		}
	}
}