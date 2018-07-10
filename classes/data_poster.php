<?php

class data_poster
{
public function send_request($url, $postdata)
{
  $content = "";

  // Add post data to request.
  foreach($postdata as $key => $value)
  {
    $content .= "{$key}={$value}&";
  }

  $params = array('http' => array(
    'method' => 'POST',
    'header' => 'Content-Type: application/x-www-form-urlencoded',
    'content' => $content
  ));

//   $ctx = stream_context_create($params);
//   $fp = fopen($url, 'rb', false, $ctx);

//   if (!$fp) {
//     throw new Exception("Connection problem in Data Poster, {$php_errormsg}");
//   }

//   $response = @stream_get_contents($fp);
//   if ($response === false) {
//     throw new Exception("Response error, {$php_errormsg}");
//   }

  $response=$this->curl_post($url, $content);
  return $response;
}
private function curl_post($url,$fields)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HEADER, 'Content-Type: application/x-www-form-urlencoded');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
        return $server_output;
}
}

?>