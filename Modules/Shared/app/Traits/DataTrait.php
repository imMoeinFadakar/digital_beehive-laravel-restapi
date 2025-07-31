<?php

namespace Modules\Shared\Traits;

trait DataTrait {

    public function databaseArray(array $keys ,array $values ): ?array
    {
        return array_combine($keys , $values);
    }



}
