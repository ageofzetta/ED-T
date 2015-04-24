<?php

include('tools.php');

$db         = &$GLOBALS['_ATP_db'];
$ATP_SCHEMA = strtoupper($GLOBALS['ATP_SCHEMA']);

$sql  = 'SELECT adu_desp,pat_agen FROM saaio_pedime WHERE num_refe = ?';
// $data = Tools::friendlyPost($_POST['num_refe']);
$data = Tools::friendlyPost('LAR08-02734-I01');

$res =& $db->query($sql, $data);

// Always check that result is not an error
if (PEAR::isError($res)) {
    return $res->getMessage();
 	echo json_encode(array('ok' => false, 'msg'=> $res->getMessage() ));

}
$res->fetchInto($mu);
// var_dump(get_class_methods($res));

if ($res->numRows()) {
	# code...
 	echo json_encode(array('ok' => true, 'data'=> $mu));
}else{
 	echo json_encode(array('ok' => false, 'msg' => 'No existen registros asociados'));

}
// $m = $db->getRow('SELECT adu_desp,pat_agen FROM saaio_pedime LIMIT 1');
// var_dump($m);

// saaio_pedime cve_impórt (cliente) tabla cliente