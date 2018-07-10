<?php
/**
 * Created by PhpStorm.
 * User: Hadi Nahavandi
 * Date: 7/2/2017
 * Time: 12:13 AM
 */

namespace core\CoreClasses\Net;


class WebClient
{

    function DownloadString($url)
    {
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,$url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:30.0) Gecko/20100101 Firefox/30.0');
        curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl_handle, CURLOPT_SSLVERSION,4);
        curl_setopt ($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($curl_handle, CURLOPT_SSL_VERIFYHOST, false);
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $query;
    }

}