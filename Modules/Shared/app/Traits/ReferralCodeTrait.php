<?php

namespace Modules\Shared\Traits;
use Illuminate\Support\Str;
use Modules\User\Models\User;

trait ReferralCodeTrait {


    protected $user;

    protected function __construct(User $user) {
        $this->user = $user;
    }

    public function generateRandomCode()
    {
        return rand(111111,999999);
    }

      /**
     * @return string
     */
    public function generateRefferalCode(): ?string
    {
        $refferalCode =  Str::random(10);

        while($this->isRefferalCodeExists($refferalCode)){

            $refferalCode =  Str::random(10);

        }

        return $refferalCode;

    }

    /**
     * @param string $refferalCode
     * @return bool
     */
    protected function isRefferalCodeExists(string $refferalCode): ?bool
    {
        return $this->user->query()
        ->where("refferal_code",$refferalCode)
        ->exists();
    }

}
