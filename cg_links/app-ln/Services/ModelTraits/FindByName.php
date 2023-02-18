<?php

namespace App\Services\ModelTraits;

use Illuminate\Database\Eloquent\ModelNotFoundException;

trait FindByName
{
    static public function findById($id, $columns = ['*'])
    {
        return static::where('id', $id)->first($columns);
    }

    static public function findByIdOrFail($id, $columns = ['*'])
    {
        return static::where('id', $id)->firstOrFail($columns);
    }

    static public function findByName($name, $columns = ['*'])
    {
        return static::where('name', $name)->first($columns);
    }

    static public function findByNameOrFail($name, $columns = ['*'])
    {
        return static::where('name', $name)->firstOrFail($columns);
    }

    static public function findNameById($id)
    {
        return static::where('id', $id)->value('name');
    }

    static public function findNameByIdOrFail($id)
    {
        return static::where('id', $id)->firstOrFail(['name'])->name;
    }

    static public function findIdByName($name)
    {
        return static::where('name', $name)->value('id');
    }

    static public function findIdByNameOrFail($name)
    {
        return static::where('name', $name)->firstOrFail(['name'])->name;
    }

    /**
     * @param int|string|static::class $identifier
     * @return static
     * @throws \Exception
     */
    static public function toModel($identifier)
    {

        if ($identifier instanceof self) {
            return $identifier;
        }

        if (is_int($identifier)) {
            return static::findById($identifier);
        }

        if (is_string($identifier)) {
            return static::findByName($identifier);
        }

        $class   = static::class;
        $type    = gettype($identifier);
        $message = "Cannot find Model {$class} by $identifier type: {$type}(value: {$identifier}). identifier argument must be: string (name), int (id), or instance of Model ({$class})";
        throw new \Exception($message);
    }

    /**
     * @param $identifier
     * @return static
     */
    static public function toModelOrFail($identifier)
    {
        $result = static::toModel($identifier);

        if (!$result) {
            $class = self::class;
            $type  = gettype($identifier);
            $msg   = "Model Not Found when trying to find {$class} by type: '{$type}', value: '{$identifier}')";
            throw (new ModelNotFoundException)->setModel(static::class, $msg);
        }

        return $result;
    }
}