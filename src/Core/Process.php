<?php
/**
* 
*/
class Referencia
{
	public $id;
	private $db;
	function __construct($id)
	{
		$this->id = $id;

		$str_conn="firebird:dbname=192.168.1.30:".ATP_IB_DB;
		$this->db = new PDO($str_conn, "sysdba", "masterkey");
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	}

	public function getBasicInfo()
	{
		$sql  = 'SELECT GUIA FROM SAAIO_GUIAS WHERE num_refe = ?';
		$res = $this->db->prepare($sql);
		$res->execute(array($this->id));
		$guia = $res->fetch();
 



		// Tabla pedime
		$sql  = 'SELECT adu_desp,pat_agen,num_pedi,mtr_sali,num_refe FROM SAAIO_PEDIME WHERE num_refe = ? AND num_pedi IS NOT NULL';
		$res  = $this->db->prepare($sql);
		$res->execute(array($this->id));
		$pedime = $res->fetch();

		 

		// Tabla transp
		$sql  = 'SELECT cve_transp FROM SAAIO_TRANSP WHERE num_refe = ? AND cve_transp IS NOT NULL';
		$res  = $this->db->prepare($sql);
		$res->execute(array($this->id));
		$transp = $res->fetch();

		 
		
		if ($pedime && $guia) {
			$data = array_merge(array_change_key_case($pedime),array_change_key_case($guia));
			if ($transp) {
				$data = array_merge($data,array_change_key_case($transp));
			}if ($itn) {
				$data = array_merge($data,array_change_key_case($itn));
			}
		 	return json_encode(array('ok' => true, 'data'=> $data));
		}else{
		 	// var_dump($guia);
		 	return json_encode(array('ok' => false, 'msg' => 'No existen registros asociados asociados a: '.$this->id));

		}		
	}
}
