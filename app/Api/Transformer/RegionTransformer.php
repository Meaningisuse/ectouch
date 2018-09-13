<?php

namespace App\Api\Transformer;

/**
 * Class RegionTransformer
 * @package App\Api\Transformer
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
