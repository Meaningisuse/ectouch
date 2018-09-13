<?php

namespace App\Api\Transformer;

/**
 * Class GoodsTransformer
 * @package App\Api\Transformer
 */
class GoodsTransformer extends Transformer
{

    /**
     * @param $item
     * @return array|mixed
     */
    public function transform($item)
    {
        return [
            'id' => $item['goods_id'],
            'name' => $item['goods_name'], // 商品名称
            'sn' => $item['goods_sn'], // 货号
            'image' => $item['goods_img'], // 商品图
            'thumb' => $item['goods_thumb'], // 商品图
            'click' => $item['click_count'], // 点击量
            'category' => '', // 分类
            'brand' => '', // 品牌
            'stock' => '', // 库存
            'weight' => '', // 重量
            'shop_price' => '', // 本店价
            'market_price' => '', // 市场价
        ];
    }
}
