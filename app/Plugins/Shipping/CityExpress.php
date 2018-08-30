<?php

/**
 *  城际快递插件
 */

load_lang('shipping/city_express');

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == true) {
    $i = (isset($modules)) ? count($modules) : 0;

    /* 配送方式插件的代码必须和文件名保持一致 */
    $modules[$i]['code'] = 'city_express';

    $modules[$i]['version'] = '1.0.0';

    /* 配送方式的描述 */
    $modules[$i]['desc'] = 'city_express_desc';

    /* 配送方式是否支持货到付款 */
    $modules[$i]['cod'] = true;

    /* 插件的作者 */
    $modules[$i]['author'] = 'ECTouch TEAM';

    /* 插件作者的官方网站 */
    $modules[$i]['website'] = 'http://www.ectouch.cn';

    /* 配送接口需要的参数 */
    $modules[$i]['configure'] = [
        ['name' => 'base_fee', 'value' => 10],
    ];

    /* 模式编辑器 */
    $modules[$i]['print_model'] = 2;

    /* 打印单背景 */
    $modules[$i]['print_bg'] = '';

    /* 打印快递单标签位置信息 */
    $modules[$i]['config_lable'] = '';

    return;
}

class CityExpress
{
    /**
     * 配置信息
     */
    public $configure;

    /**
     * CityExpress constructor.
     * @param array $cfg
     */
    public function __construct($cfg = [])
    {
        foreach ($cfg as $key => $val) {
            $this->configure[$val['name']] = $val['value'];
        }
    }

    /**
     * 计算订单的配送费用的函数
     *
     * @param   float $goods_weight 商品重量
     * @param   float $goods_amount 商品金额
     * @return  decimal
     */
    public function calculate($goods_weight, $goods_amount)
    {
        if ($this->configure['free_money'] > 0 && $goods_amount >= $this->configure['free_money']) {
            return 0;
        } else {
            return $this->configure['base_fee'];
        }
    }

    /**
     * 查询发货状态
     * 该配送方式不支持查询发货状态
     *
     * @access  public
     * @param   string $invoice_sn 发货单号
     * @return  string
     */
    public function query($invoice_sn)
    {
        return $invoice_sn;
    }
}
