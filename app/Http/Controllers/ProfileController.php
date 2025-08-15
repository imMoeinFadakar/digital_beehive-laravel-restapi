<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewReportRequest;
use Exception;
use Modules\User\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\SellerUser;
use Illuminate\Support\Facades\Auth;
use Modules\OrderUserStatus\Models\OrderUserstatus;
use Modules\Refferal\Models\Refferal;
use Modules\Shared\Http\Controllers\SharedController;

class ProfileController extends SharedController
{

     
    public function index()
    {
        $sellerUser = $this->getSellerUserCostumers();

        // dd($sellerUser->toArray());


        $sellerRefferalCode = env("APP_FRONTEND_URL") ."/login?code=" . auth()->user()->personel_code; 

        $gen = 0;



        return view("dashboard",compact("sellerUser",["sellerRefferalCode","gen"]));

    }


    public function getSellerUserCostumers()
    {
        return SellerUser::query()
        ->select('seller_users.*', DB::raw('COUNT(refferals.id) as referrals_count'))
        ->join('users as main_user', 'main_user.id', '=', 'seller_users.user_id')
        ->leftJoin('refferals', 'refferals.reffering_id', '=', 'main_user.id')
        ->where('seller_users.telephone_seller_id', Auth::id())
        ->groupBy('seller_users.id')
        ->with(['user:id,first_name,last_name,email,phone_number,refferal_code'])
        ->paginate(10);
    }

   

    public function getUserByRefferalCode(string $refferalCode,int $gen)
    {
        
        if($gen >= 4 )
            return redirect()->back(400)->with("error","اطلاعات مورد نظر پیدا نشد");

        $user = User::query()
        ->where("refferal_code",$refferalCode)
        ->where("status","active")
        ->first();

        $userRefferals = Refferal::query()
        ->where("reffering_id",$user->id)
        ->with(['reffered:id,first_name,phone_number,last_name,refferal_code'])
        ->get();


       $userRefferals->makeHidden(['reffering_id','reffered_id']);



        return view("GenerationRefferalPage",compact("userRefferals","gen"));


    }

    public function createNewReport(string $referralCode)
    {

        $user = User::query()
        ->where("refferal_code",$referralCode)
        ->first();

        $userId = $user->id;

        $perviousReports  = OrderUserstatus::query()
        ->where("user_id",$user->id) 
        ->paginate(10);


        return view("AddNewReportView",compact("perviousReports","userId"));
    }


    public function storeNewReport(AddNewReportRequest $request ,OrderUserstatus $orderUserstatus)
    {
      
        try{
             $orderUserstatus->addNewOrderUserStatus($request->validated());

             return back()->with("success","گزارش با موفقیت ثبت شد");
        }catch(Exception $e){
            return back()->with("error","خطا:" . $e->getMessage() .' '.$e->getLine());
        }

      

    }



}
