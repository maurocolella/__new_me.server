<?php

namespace App\Helpers;

class API {
    /**
     * Marshall a single entry to JSON API.
     * @param  [[Type]] $entry [[Description]]
     * @param  [[Type]] $type  [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function marshallEntry($entry, $type)
    {
        $payload = new \stdClass;
        $payload->data = new \stdClass;
        $payload->data->type = $type;
        $payload->data->id = $entry->id;
        $payload->data->attributes = new \stdClass;

        foreach($entry->toArray() as $propName => $propVal){
            if(strcmp('id', $propName) !== 0){
                $payload->data->attributes->$propName = $propVal;
            }
        }

        return $payload;
    }

    /**
     * Marshall a data set to JSON API.
     * @param  [[Type]] $dataSet [[Description]]
     * @param  [[Type]] $type    [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function marshallDataset($dataSet, $type)
    {
        $payload = new \stdClass;
        $payload->data = array();

        $dataSet->each(function ($item, $key) use ($payload, $type) {
            $entry = new \stdClass;
            $entry->type = $type;
            $entry->id = $item->id;
            $entry->attributes = new \stdClass;

            foreach($item->toArray() as $propName => $propVal){
                if(strcmp('id', $propName) !== 0){
                    $entry->attributes->$propName = $propVal;
                }
            }

            $payload->data[] = $entry;
        });

        return $payload;
    }

}
