<?php

namespace app\http\controllers;

use Firebase\JWT\JWT;
use think\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @return int
     */
    protected function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * 返回封装后的API数据到客户端
     * @param mixed|string $data 要返回的数据
     * @return string
     */
    protected function succeed($data)
    {
        return $this->setStatusCode(200)->resp([
            'status' => 'success',
            'data' => $data,
            'time' => time(),
        ]);
    }

    /**
     * 返回异常数据到客户端
     * @param string $message 要返回的错误消息
     * @return string
     */
    protected function failed($message)
    {
        return $this->setStatusCode(100)->resp([
            'status' => 'failed',
            'errors' => [
                'code' => $this->getStatusCode(),
                'message' => $message,
            ],
            'time' => time(),
        ]);
    }

    /**
     * 返回 Json 数据格式
     * @param $data
     * @return string
     */
    protected function resp($data)
    {
        $code = $this->getStatusCode();

        return $this->response($data, 'json', $code);
    }

    /**
     * 通过JWT加密用户数据
     * @param null $data
     * @return string
     */
    protected function JWTEncode($data = null)
    {
        $key = config('app_key');

        $data = $this->getJWTToken($data);

        return JWT::encode($data, $key, 'HS256');
    }

    /**
     * 通过JWT解密用户数据
     * @param $token
     * @return object
     */
    protected function JWTDecode($token)
    {
        $key = config('app_key');

        $data = JWT::decode($token, $key, ['HS256']);

        return json_decode(json_encode($data), true);
    }

    /**
     * 返回用户数据的属性
     * @param null $token
     * @param string $header
     * @param string $value
     * @return mixed
     */
    protected function authorization($token = null, $header = 'token', $value = 'user_id')
    {
        if (is_null($token)) {
            $token = request()->header($header);
        }

        $data = $this->JWTDecode($token);

        return $data[$value];
    }

    /**
     * 设置JWT数据的有效期
     * @param null $data
     * @return array
     */
    protected function getJWTToken($data = null)
    {
        $token = config('jwt.');

        // Add Token expires 过期时间
        $token['exp'] = Carbon::now()->addDays($token['exp'])->timestamp;

        return array_merge($token, $data);
    }

    /**
     * 检测输入的验证码是否正确，$code为用户输入的验证码字符串
     * @param $code
     * @param string $id
     * @return bool
     */
    protected function checkVerify($code, $id = '')
    {
        $verify = new \App\Kernel\Verify();
        return $verify->check($code, $id);
    }
}