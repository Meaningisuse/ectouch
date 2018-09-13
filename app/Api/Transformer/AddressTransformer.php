<?php

namespace App\Api\Transformer;

/**
 * Class AddressTransformer
 * @package App\Api\Transformer
 */
class AddressTransformer extends Transformer
{

    /**
     * @param $item
     * @return array|mixed
     */
    public function transform($item)
    {
        return [
            'id' => $item['address_id'],
            'name' => $item['consignee'], // 收货人
            'mobile' => $item['mobile'], // 收货人手机号
            'email' => $item['email'], // 邮箱
            'country' => $item['country'], // 国家
            'province' => $item['province'], // 省
            'city' => $item['city'], // 市
            'district' => $item['district'], // 区/县
            'town' => $item['town'], // 镇
            'address' => $item['consignee'], // 详细地址
            'sign_building' => $item['sign_building'], // 标志性建筑
            'best_time' => $item['best_time'], // 最佳配送时间
            'tag' => $item['address_name'], // 名称
        ];
    }
}
