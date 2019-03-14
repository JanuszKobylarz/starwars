<?php
/**
 * Created by PhpStorm.
 * User: jkoby
 * Date: 13-03-2019
 * Time: 22:08
 */

namespace App\Services;


class CallApiService{
    private $apiUrl;
    public function __construct($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    function CallAPI($method, $url, $data = false)
    {
        $url = $this->apiUrl.$url;
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

}