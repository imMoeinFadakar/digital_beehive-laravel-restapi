<?php

namespace Modules\Refferal\Http\Controllers;

use Modules\Refferal\Transformers\RefferalResource;
use Modules\Beehive\Models\Beehive;
use Modules\Refferal\Models\Refferal;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\Refferal\Http\Requests\storeNewRefferalRequest;

class RefferalController extends SharedController
{
    /**
     * refferal/index
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $RefferalQuentity = Refferal::query()
        ->where("reffering_id", auth()->user()->id)
        ->count();

        return $this->api(['refferal_quentity' => $RefferalQuentity],__METHOD__);
    }


    /**
     * refferal/store
     * @param \Modules\Refferal\Http\Requests\storeNewRefferalRequest $request
     * @param \Modules\Refferal\Models\Refferal $refferal
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(storeNewRefferalRequest $request,Refferal $refferal) {

        $validated = $request->validated();

        $refferingUser = $this->findUserByRefferalCode($validated['refferal_code'])->user;
        
        if(! $refferingUser || $this->findUserBeehive()->refferal_code == $request->refferal_code)
                return $this->api(null,__METHOD__,"کاربر پیدا نشد");

       $data =  $this->setAttrebuitForStore(['reffered_id','reffering_id'],
        [auth()->user()->id,$refferingUser->id]);

       $refferal  =  $refferal->addNewRefferal($data);

        return $this->api(new RefferalResource($refferal->toArray()),__METHOD__);
    }

    public function findUserBeehive(): Beehive|null
    {
        return Beehive::query()
        ->where("user_id",auth()->user()->id)
        ->first();
    }

    protected function setAttrebuitForStore(array $keys,array $values): array 
    {
        return  array_combine($keys,$values);
    }

    protected function findUserByRefferalCode(int $refferalCode): ?Beehive
    {
        return Beehive::query()
        ->where("refferal_code", $refferalCode)
        ->with(['user:id'])
        ->first() ?? null;
    }




}
