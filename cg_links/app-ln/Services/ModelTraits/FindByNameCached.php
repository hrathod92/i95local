<?php

namespace App\Models\Concerns;

use App\Services\ModelTraits\FindByName;
use Illuminate\Cache\ArrayStore;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait FindByNameCached
{
    use FindByName;

    /**
     * @var ArrayStore
     */
    static $cache;

    static public function bootFindByNameCached()
    {
        static::$cache = app(ArrayStore::class);
    }

    static public function clearCache()
    {
        static::$cache->flush();
    }

    /**
     * @return Collection
     */
    static public function cacheGet()
    {
        return static::$cache->remember('all', 20, function () {
            return static::all();
        });
    }

    static public function findById($id)
    {
        return static::cacheGet()->where('id', $id)->first();
    }

    static public function findByIdOrFail($id)
    {
        return static::returnResultOrFail(
            static::findById($id)
        );
    }

    static public function findByName($name, $columns = ['*'])
    {
        $result = static::cacheGet()->where('name', $name)->first();
        if ($result) {
            return $result->filterSelectColumns($columns);
        }
    }

    static public function findByNameOrFail($name, $columns = ['*'])
    {
        return static::returnResultOrFail(
            static::findByName($name, $columns)
        );
    }

    static public function findNameById($id)
    {
        $result = static::findById($id);
        if ($result) {
            return $result->name;
        }
    }

    static public function findNameByIdOrFail($id)
    {
        return static::returnResultOrFail(
            static::findNameById($id)
        );
    }

    static public function findIdByName($name)
    {
        $result = static::findByName($name);
        if ($result) {
            return $result->id;
        }
    }

    static public function findIdByNameOrFail($name)
    {
        $result = static::findIdByName($name);
        return static::returnResultOrFail($result);
    }

    protected function filterSelectColumns(array $columns)
    {
        if ($columns == ['*']) {
            return $this;
        }

        foreach ($this->attributes as $key => $value) {
            if (!in_array($key, $columns)) {
                unset($this[$key]);
            }
        }

        return $this;
    }

    static protected function returnResultOrFail($result)
    {
        if (!$result) {
            throw (new ModelNotFoundException)->setModel(self::class);
        }

        return $result;
    }

}