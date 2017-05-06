<?php

namespace ventureoak\Transformers;


abstract class Transformer
{
    /**
     * This method maps collection between field names in database and responses sent to the API
     *
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items) {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);
}