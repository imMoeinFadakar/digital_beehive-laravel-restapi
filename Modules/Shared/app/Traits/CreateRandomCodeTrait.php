<?php

namespace Modules\Shared\Traits;

use Nette\Utils\Random;
use Psy\Util\Str;






trait CreateRandomCodeTrait {


    public function createRandomCode(int $length) {

     $random = (string) Random::generate($length,'0-9');   

      return   intval($random);

    }





}
