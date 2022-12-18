<?php

namespace App\Http\Controllers;

namespace App\Http\Traits;

use App\Models\Setting;

trait assetstrait
{

    //Get any coin, any currency rate
    public function get_rates($coin, $currency, $option)
    {
        //get settings
        $site_name = Setting::getValue('site_name');

        $url = "https://api.cryptonator.com/api/ticker/$coin-$currency";
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, "$site_name");
        $query = curl_exec($curl_handle);

        curl_close($curl_handle);

        $data = json_decode($query, TRUE);

        $price = $data["ticker"]["price"];

        if ($option == "price") {
            return $price;
        } else {
            return $data;
        }
    }
};