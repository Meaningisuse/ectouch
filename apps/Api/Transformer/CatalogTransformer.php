<?php

namespace app\api\transformer;

/**
 * Class CatalogTransformer
 * @package app\api\transformer
 */
class CatalogTransformer extends Transformer
{
    /**
     * @param $item
     * @return array|mixed
     */
    public function transform($item)
    {
        return [
            'id' => $item['cat_id'],
            'name' => $item['cat_name'], // 分类名
            'icon' => $item['cat_icon'], // 分类图标
        ];
    }
}
