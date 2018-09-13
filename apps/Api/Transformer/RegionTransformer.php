<?php

namespace app\api\transformer;

/**
 * Class RegionTransformer
 * @package app\api\transformer
 */
class RegionTransformer extends Transformer
{

    /**
     * @param $item
     * @return array|mixed
     */
    public function transform($item)
    {
        return [
            'id' => $item['region_id'],
            'name' => $item['region_name'],
        ];
    }
}
