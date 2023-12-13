## 使用方法

### 统一下单
```php
use Ttfpay\Http\Client;
...

$config = array(
    'merchantno_key' => '商户key',
    'userid'         => '用户USERID',
    'config_secret'  => '商户secret',
    'total_fee'      => '订单金额',
    'out_trade_no'   => '订单单号',
    'notify_url'     => '回调地址',
    'body'           => '支付内容标题'
);
$Client = new Client($config);
$result = $Client->http_post();
...
```

### 验签
```php
use Ttfpay\Http\Client;
...
$config = array(
    'config_secret'  => '商户secret'
);
$Client = new Client($config);
#$sign：接口返回的sign
#$data：接口返回的参数请求参数
$result = $Client->checkSign($sign, $data);
...
```
