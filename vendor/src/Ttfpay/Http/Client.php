<?php
namespace Ttfpay\Http;

use Ttfpay\Config;
use Ttfpay\Http\Sign;

final class Client
{

    protected $config;

    public function __construct(array $config)
    {
        if(!isset($config['merchantno_key'])){
            throw new \Exception('缺少merchantno_key参数');
        }
        if(!isset($config['userid'])){
            throw new \Exception('缺少userid参数');
        }
        if(!isset($config['config_secret'])){
            throw new \Exception('缺少config_secret参数');
        }
        if(!isset($config['total_fee'])){
            throw new \Exception('缺少total_fee参数');
        }
        if(!isset($config['out_trade_no'])){
            throw new \Exception('缺少out_trade_no参数');
        }
        if(!isset($config['notify_url'])){
            throw new \Exception('缺少notify_url参数');
        }
        if(!isset($config['body'])){
            throw new \Exception('缺少body参数');
        }
        $this->config = $config;
    }

    /**
     * Notes:统一下单请求
     * @return bool|string
     * @throws \Exception
     * User: yym
     * Date: 2023/12/13
     */
    public function http_post()
    {
        $data = [
            'merchant_id' => $this->config['merchantno_key'],
            'amount'      => floatval($this->config['total_fee']),
            'userid'      => $this->config['userid'],
            'ordercode'   => $this->config['out_trade_no'],
            'paytool'     => 'alipayh5pay',
            'callback'    => $this->config['notify_url'],
            'timestamp'   => time(),
            'goods_name'  => $this->config['body']
        ];
        $data['sign'] = Sign::createSign($data, $this->config['config_secret']);
        try {
            $res = $this->curl_post( Config::HTTP_URL . '/api/v2/payments', $data);
        } catch (\Exception $e) {
            throw new \Exception('支付错误返回：' . $e->getMessage());
        }
        return $res;
    }

    /**
     * Notes:curl https post请求
     * @param $url
     * @param $post_data
     * @param array $header
     * @return bool|string
     * User: yym
     * Date: 2023/12/13
     */
    private function curl_post($url,$post_data,$header=[])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * Notes:签名校验
     * @param string $sign
     * @param array $data
     * @return bool
     * User: yym
     * Date: 2023/12/13
     */
    public function checkSign(string $sign, array $data)
    {
        if(isset($data['sign'])){
            unset($data['sign']);
        }
        if(Sign::createSign($data) != $sign){
            return false;
        }
        return true;
    }
}
