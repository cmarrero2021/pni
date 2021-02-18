<?php
class DBlog_Hook {

	var $path    = 'sistema/logs/';

	function DBlog_Hook() {
		$this->CI =& get_instance();
	}

	function log_all_query() {


		$this->ci = &get_instance();
		//$this->CI->load->helper('file');
		//$this->ci->db->query('BEGIN');
		//$this->ci->db->query('LOCK TABLE auditoria IN EXCLUSIVE MODE');
		//$ultima = $this->ci->db->query('SELECT * FROM audit.logged_actions WHERE event_id = (SELECT MAX(event_id) FROM audit.logged_actions)');
		/*		$ultima = $this->ci->db->query('select * from audit.logged_actions where event_id = (select max(event_id) from audit.logged_actions)')->row();*/
/*		$ultima2 =json_encode($ultima,JSON_UNESCAPED_UNICODE);
$ultima3 =json_decode($ultima2);*/

		//write_file($this->path . 'res.txt', $ultima, 'a+'),



		//print_r($ultima);
		//die();
/*		foreach ($ultima as $e) {
			$pepe =  $e['row_data'];
			$pepa =  $e['changed_fields'];
		}*/
		// $data['estado_previo'] = $ultima['row_data'];
		// $data['estado_actual'] = $ultima['changed_fields'];
		//$this->ci->db->query('COMMIT');
		$this->dbtable="public.auditoria";
		$dbs    = array();
		$output = NULL;
		$queries = $this->CI->db->queries;
		if (count($queries) > 0) {
			foreach ($queries as $query) {
				if (stripos($query,'select') === false || stripos($query,'public.auditoria')) {
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
					$data['ip'] = $info2[1];
					$data['equipo'] = $info[14];
					$this->db->query('LOCK TABLE public.auditoria IN ACCESS EXCLUSIVE');
					$accion = explode(" ",$query);
					if ($accion[0]=='UPDATE') {
						$data['tabla'] = $accion[1];
					} else {
						$data['tabla'] = $accion[2];
					}
					$ced = $this->ci->session->userdata('cedula');
					$data['usuario'] = $ced;
					$data['accion']=$accion[0];
					$data['sql']=$query1;
					$this->ci->db->insert($this->dbtable,$data);
					$this->db->query('UNLOCK TABLES');
					$output .= $query1 ."\n";
				}
			}
		}

		$this->CI->load->helper('file');
/*		if ( ! write_file($this->path . 'queries.txt', $output, 'a+')) {
			log_message('debug','Unable to write the file');
		}*/

/*		if ( ! write_file($this->path . 'res.txt', $ultima3, 'a+')) {
			log_message('debug','Unable to write the file');
		}
*/
	}
}