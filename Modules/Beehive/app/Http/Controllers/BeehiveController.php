<?php

namespace Modules\Beehive\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Beehive\Http\Requests\UpdateBeehiveRequest;
use Modules\Beehive\Models\Beehive;
use Modules\Beehive\Transformers\BeehiveResorce;
use Modules\Beehive\Transformers\BeehiveResource;
use Modules\ProductUser\Models\ProductUser;
use Modules\Shared\Http\Controllers\SharedController;

class BeehiveController extends SharedController
{
    /**
     * beehive/index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $beehive = Beehive::query()
        ->orderBy("id")
        ->where("user_id", auth()->user()->id)
        ->first();

        if(! $beehive) 
            return $this->api(null,__METHOD__,"you dont have beehive!");


        return $this->api(new BeehiveResorce($beehive->toArray()),__METHOD__);
    }

    /**
     * beehive/index
     * @param \Illuminate\Http\Request $request
     * @param \Modules\Beehive\Models\Beehive $beehive
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request,Beehive $beehive)
    {

        if(! $this->hasUserProduct())
            return $this->api(null,__METHOD__,"با خرید محصول کندوی شما به صورت دیجیتال فعال خواهد شد");


        if($this->hasUserBeehive())
            return $this->api(null,__METHOD__,"شما در حال حاضر یک کندوی فعال دارید");


        $referralCode = $this->generateReferralCode();
        
        $data = $this->databaseArray(['user_id','refferal_code'],[auth()->user()->id,$referralCode]);
      
        $beehive = $beehive->addNewBeehive($data);

        return $this->api(new BeehiveResource($beehive->toArray()),__METHOD__);

    }
    
    protected function findUserBeehive(int $id): Beehive|null
    {
        return Beehive::query()
        ->where("user_id", auth()->user()->id)
        ->where("id", $id)
        ->first() ?? null;
    }

    protected function hasUserBeehive(): ?bool
    {
        return Beehive::query()
        ->where("user_id", auth()->user()->id)
        ->exists();
    }

    public function hasUserProduct(): ?bool
    {
        return ProductUser::query()
        ->where("user_id",auth()->user()->id)
        ->exists();
    }

    /**
     * @return int
     */
    protected function generateReferralCode(): ?int
    {
        $referralCode = $this->createRandomCode(10);
        
        while($this->isRefferalCodeExists($referralCode)){

            $referralCode = $this->createRandomCode(10);
        }

        return $referralCode;

    }

    /**
     * @param int $referralCode
     * @return bool
     */
    protected function isRefferalCodeExists(int $referralCode): ?bool
    {
        return Beehive::query()
        ->where("refferal_code",$referralCode)
        ->exists();
    }




   
}
