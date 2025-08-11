<?php

namespace Modules\Refferal\Http\Controllers;

use Exception;
use Modules\User\Models\User;
use Modules\Refferal\Models\Card;
use Illuminate\Support\Facades\DB;
use Modules\Beehive\Models\Beehive;
use Illuminate\Support\Facades\Auth;
use Modules\Refferal\Models\CardUser;
use Modules\Refferal\Models\Refferal;
use Modules\Refferal\Transformers\RefferalResource;
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


        $cardUser = $this->getAuthUserCard();

        return $this->api(['refferal_quentity' => $RefferalQuentity ,
         "cart" => $cardUser ?? "هنوز هیچ کارت فعالی ندارید" ],__METHOD__);
    }


    protected function getAuthUserCard(): ?CardUser
    {
        return CardUser::query()
        ->where("user_id",Auth::id())
        ->with(['card'])
        ->first();
    }


    /**
     * refferal/store
     * @param \Modules\Refferal\Http\Requests\storeNewRefferalRequest $request
     * @param \Modules\Refferal\Models\Refferal $refferal
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreNewRefferalRequest $request,Refferal $refferal) {


        $isRefferalExists = $this->isUserRefferedBefore();
        if($isRefferalExists)
                return $this->api(null,
            __METHOD__,
            "قبلا معرف شما ثبت شده",
            false,
            422);

        $validated = $request->validated();

        $refferingUser = $this->findRefferingUser(
            $validated['refferal_code']);

        if($refferingUser->id === Auth::id())
            return $this->api(null,
        __METHOD__,
        "کد معرف اشتباه است",
        false,
        422);    


    try{
        DB::beginTransaction();

        
       $data =  [
        "reffered_id" => Auth::id(),
        "reffering_id" => $refferingUser->id
       ];
       

        $refferal->addNewRefferal($data);


       $cardUser = $this->getCardUser($refferingUser);

       if(! $cardUser){

        $cardUser = $this->createCardUser($refferingUser);

        DB::commit();

         return $this->api(null,
        __METHOD__,
        "دعوت موفقیت امیز بود");

       }

       $newCard = $this->getNewCardLevel($cardUser->card->refferal_require);

       if(! $newCard){

        DB::commit();
         return $this->api(null,
        __METHOD__,
        "تبریک شما به اخرین سطح رسیدید");

       }


       $refferingUser->score += $newCard->score;
       $refferingUser->save();

       $cardUser->card_id = $newCard->id;
        $cardUser->save();


        DB::commit();


        return $this->api(null,
        __METHOD__,
        "دعوت موفقیت امیز بود");


    }catch(Exception $e){

        DB::rollBack();

        return $this->api(null,
        __METHOD__,
        "خطای ناشناخته ایی رخ داد" . ' ' .$e->getMessage(),
        false,500);

    }



        


    }


    protected function getCardUser($refferingUser): ?CardUser
    {
        return CardUser::query()
        ->where("user_id",$refferingUser->id)
        ->with(['card'])
        ->first();
    }

   
    public function getNewCardLevel(int $cardRefferalQuentity): ?Card
    {
        return Card::query()
        ->where("refferal_require",$cardRefferalQuentity + 1)
        ->first();
    }


    public function createCardUser($refferingUser): ?CardUser
    {
        return CardUser::query()
        ->create([
            "user_id" => $refferingUser->id ,
            "card_id" => 1
        ])->load(['card']);
    }


  
    protected function isUserRefferedBefore(): ?bool
    {
        return Refferal::query()
        ->where("reffered_id",Auth::id())
        ->exists();
    }

    protected function findRefferingUser(string $refferalCode): ?User
    {
        return User::query()
        ->where("refferal_code", $refferalCode)
        ->where("status","active")
        ->first() ?? null;
    }




}
