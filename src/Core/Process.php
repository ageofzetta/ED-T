<?php




/**
* 
*/
class Referencia
{
	public $id;
	function __construct($id)
	{
		$this->id = $id;
	}

	public function getBasicInfo()
	{
		$db         = &$GLOBALS['_ATP_db'];
		$ATP_SCHEMA = strtoupper($GLOBALS['ATP_SCHEMA']);

		// Tabla pedime
		$sql  = 'SELECT adu_desp,pat_agen,num_pedi,mtr_sali FROM saaio_pedime WHERE num_refe = ?';
		$res  = $db->query($sql, $this->id);
		$res->fetchInto($pedime);

		// Tabla guia
		$sql  = 'SELECT guia FROM guia WHERE referencia = ?';
		$res  = $db->query($sql, $this->id);
		$res->fetchInto($guia);

		// Tabla transp
		$sql  = 'SELECT cve_transp FROM saaio_transp WHERE num_refe = ?';
		$res  = $db->query($sql, $this->id);
		$res->fetchInto($transp);
		
		if ($pedime && $guia) {
			$data = array_merge($pedime,$guia);
			if ($transp) {
				$data = array_merge($data,$transp);
			}
		 	return json_encode(array('ok' => true, 'data'=> $data));
		}else{
		 	// var_dump($guia);
		 	return json_encode(array('ok' => false, 'msg' => 'No existen registros asociados asociados a: '.$this->id));

		}
		// $m = $this->db->getRow('SELECT adu_desp,pat_agen FROM saaio_pedime LIMIT 1');
		// var_dump($m);

		// saaio_pedime cve_impórt (cliente) tabla cliente
		
	}
}
