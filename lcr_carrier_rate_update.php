<?php
/*
 * sip profile create 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'POST';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'update';
$module_name = 'lcr';
$obj_type = 'carrier';
$obj_name = 'NSC_new_carrier_profile2';
$sub_obj_type = 'rate';
$sub_obj_name = 'rate_448';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name .'/'. $sub_obj_type .'/'. $sub_obj_name ;

$json_data ='
{
		"digits": "2",
		"rate": "2",
		"lead_strip": "011",
		"trail_strip": "",
		"prefix": "",
		"suffix": "",
		"date_start": "",
		"date_end": ""
	}
';
$data = json_decode($json_data);
try {
    //API_KEY defined in 'setting.inc.php' send api key in header
    //$header_array[]="X-API-KEY:C2FF69E5B86551C8062F9B56E1065370"
    if(defined('API_KEY'))
    {
        $header_array[] = 'X-API-KEY:'.API_KEY;
    }else{
        $header_array = null;
    }
    $pest = new PestJSON($base_url);
    
    $status = $pest->post($request_uri, $data, $header_array);
} catch(Exception $e) {
    $status = json_decode($e->getMessage(), true);
}

$rc = $pest->lastStatus();
print('URL      : ' . $base_url.$request_uri.PHP_EOL);
print('Output   : ' . json_encode($status) .PHP_EOL);
print('Status   : ' . $rc.PHP_EOL);

/*
 * Output sample
{
	"status": true,
	"method": "update",
	"module": "lcr",
	"type": "carrier",
	"name": "NSC_new_carrier_profile2",
	"child_type": "rate",
	"child_name": "rate_448"
}
Status: 200


 *
 * */
?>