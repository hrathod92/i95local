<?php

namespace App\Services;

use App\Ad;

class AdRandomizer
{

    static public function getRandomByType($type, $resultCount = 1)
    {
        $instance    = new static();
        $weightedIds = $instance->weightedIdsByType($type);
        $ids         = $instance->getRandomKeys($weightedIds, $resultCount);

        return Ad::query()->whereIn('id', $ids)->get();
    }

    protected function weightedIdsByType($type)
    {
        return Ad::wherePublic()
                 ->where('type', $type)
                 ->lists('random_weight', 'id')
                 ->toArray();
    }

    protected function getRandomKeys(array $weightedKeys, $resultCount = 1)
    {
        $ids = [];
        while ($resultCount-- && $weightedKeys) {
            $id = $this->getRandomKey($weightedKeys);
            unset($weightedKeys[$id]);
            $ids[] = $id;
        }
        return $ids;
    }

    protected function getRandomKey(array $weightedKeys)
    {
        $totalWeight = (int)array_sum($weightedKeys);
        if ($totalWeight === 0) {

            return array_rand($weightedKeys);
        }
        $rand = mt_rand(1, $totalWeight);

        foreach ($weightedKeys as $key => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $key;
            }
        }
    }
}