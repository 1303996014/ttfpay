<?php
namespace Ttfpay\Http;

final class Sign
{
    public static function createSign(array $data, string $config_secret)
    {
        $str = '';
        ksort($data);
        foreach ($data as $k => $val)
        {
            if($val){
                $str .= $k . '=' . $val . '&';
            }
        }
        $str .= 'secret=' . $config_secret;
        return strtoupper(md5($str));
    }
}
