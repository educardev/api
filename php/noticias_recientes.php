<?php
/*
 * API Publica educ.ar
 *  
 * Ejemplo de llamado a endpoint: Noticias Recientes
 * 
 */
$service_url = 'https://api.educ.ar/0.9/noticias/recientes/';  
$api_key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';  //key
$params = array('key'=>$api_key);

if (!function_exists('curl_version'))
    die ('Se necesita tener instalada la extensión cURL');

$curl = curl_init($service_url.'?'.http_build_query($params));

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Debug
curl_setopt($curl, CURLOPT_VERBOSE, true);

curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,true);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,true);

$curl_response = curl_exec($curl);

if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('Ocurrió un error en la ejecución de llamada curl. Info adicional: ' . var_export($info,true));
}
curl_close($curl);


$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('Ocurrió un error: ' . $decoded->response->errormessage);
}

echo 'Respuesta ok!';
var_export($decoded->result->data);
?>
