<?php

namespace App\Proxy;

use GuzzleHttp\Client;

class ShippingProxy
{
    /**
     * @var string
     */
    protected $queryExpressUrl = 'https://sp0.baidu.com/9_Q4sjW91Qh3otqbppnN2DJv/pae/channel/data/asyncqury?appid=4001&com=%s&nu=%s';

    /**
     * @param string $com
     * @param string $num
     * @return array
     */
    public function getExpress($com = '', $num = '')
    {
        $client = new Client();

        $url = sprintf($this->queryExpressUrl, $com, $num);

        $cache_id = md5($url);
        $result = cache($cache_id);

        if (is_null($result)) {
            $response = $client->get($url, $this->defaultOptions());
            $result = json_decode($response->getBody(), true);
            cache($cache_id, $result);
        }

        if ($result['error_code'] === '0') {
            return ['error' => 0, 'data' => $result['data']['info']];
        } else {
            return ['error' => 403, 'data' => $result['msg']];
        }
    }

    /**
     * @return array
     */
    public function defaultOptions()
    {
        return [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.' . time(),
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',
                'Cache-Control' => 'no-cache',
                'Connection' => 'keep-alive',
                'Cookie' => 'BAIDUID=751A380F4F4F8FB7F348EB4E64E9FACF:FG=1', // TODO 获取BAIDUID
                'Host' => 'sp0.baidu.com',
                'Pragma' => 'no-cache',
                'Upgrade-Insecure-Requests' => '1',
            ]
        ];
    }
}
