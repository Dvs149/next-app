<?php

use App\Models\Reward;

class Helper
{
    static $secretKey = 'divyesh@iih';
    static $secretIv = 'divyesh@iih';

    //get addmin prefix from here
    public static function admin_url($uri_path = '')
    {
        return url('admin/' . $uri_path);
    }

    public static function reward_type($reward_point = 0)
    {
        $reward_data = Reward::orderBy('r_point')
            ->get()
            ->toArray();
        $final_reward_type = '';
        foreach ($reward_data as $key => $value) {
            if ($reward_point <= $reward_data[$key]['r_point']) {
                // skip even members
                $final_reward_type = $reward_data[$key]['r_type'];
                return $final_reward_type;
            } else {
                $final_reward_type = $reward_data[$key]['r_type'];
                continue;
            }
        }
        return $final_reward_type;
    }

    public static function decrypt($string)
    {
        $output = false;
        $encrypt_method = 'AES-256-CBC';
        //pls set your unique hashing key
        $secret_key = 'iih';
        $secret_iv = 'iih';
        // hash
        $key = hash('sha256', self::$secretKey);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', self::$secretIv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }

    public static function encrypt($string)
    {
        $output = false;
        $encrypt_method = 'AES-256-CBC';
        //pls set your unique hashing key
        // hash
        $key = hash('sha256', self::$secretKey);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', self::$secretIv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    static function CURLsendsms($number, $message_body)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'appsid=' . env('UNIFONIC_APP_ID') . '&msg=' . $message_body . '&to=' . $number . '&sender=NEXTAP&baseEncode=false&encoding=GSM7');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/x-www-form-urlencoded', 'Accept:application/json']);
        curl_setopt($ch, CURLOPT_POST, true); // Set CURL Post Data
        curl_setopt($ch, CURLOPT_URL, 'http://basic.unifonic.com/wrapper/sendSMS.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch); // Close CURL
        return $output;
    }
    static function url_shortner($url_link)
    {
        $url = urlencode($url_link);
        // dd($url);
        $json = file_get_contents("https://cutt.ly/api/api.php?key=8dc61f7e1270219250469c70cde809dfb686b&short=$url");
        $data = json_decode($json, true);
        return $data;
    }
}
