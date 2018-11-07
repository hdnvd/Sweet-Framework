<?php
/**
 * Created by PhpStorm.
 * User: hduser
 * Date: 11/7/18
 * Time: 1:40 PM
 */

class InstagramClient
{
    private $AccessToken;

    /**
     * InstagramClient constructor.
     * @param $AccessToken
     */
    public function __construct($AccessToken)
    {
        $this->AccessToken = $AccessToken;
    }

    private function rudr_instagram_api_curl_connect( $api_url ){
        $connection_c = curl_init(); // initializing
        curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
        curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
        curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
        $json_return = curl_exec( $connection_c ); // connect and get json data
        curl_close( $connection_c ); // close connection
        return json_decode( $json_return ); // decode and return
    }
    public function getUserImages($username)
    {
        $user_search = $this->rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/search?q=" . $username . "&access_token=" . $this->AccessToken);
        $user_id = $user_search->data[0]->id; // or use string 'self' to get your own media
        $return = $this->rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $this->AccessToken);
        foreach ($return->data as $post) {
            echo '<a href="' . $post->images->standard_resolution->url . '" class="fancybox"><img src="' . $post->images->thumbnail->url . '" /></a>';
        }
    }
}