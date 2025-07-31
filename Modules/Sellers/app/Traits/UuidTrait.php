<?php

namespace Modules\Sellers\Traits;

use illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait UuidTrait {

    public function generateUniqueCode($table, $coulmn = "code", int $length): ?string
    {
        do{

            $code = strtoupper(Str::random($length));

        }while(DB::table($table)->where($coulmn,$code)->exists());

        return $code;
    }


}
