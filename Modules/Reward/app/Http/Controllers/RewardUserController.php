<?php

namespace Modules\Reward\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Modules\Reward\Models\Reward;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Reward\Models\RewardUser;
use Modules\Reward\Http\Requests\RewardUserRequest;
use Modules\Reward\Transformers\RewardUserResource;
use Modules\Shared\Http\Controllers\SharedController;

class RewardUserController extends SharedController
{
    /**
     * reward user/index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $rewardUser = RewardUser::query()
        ->orderby("id")
        ->when(isset($request->id), fn($query)=> $query->where("id", $request->id))
        ->when(isset($request->id), fn($query)=> $query->where("id", "%" . $request->id . "%"))
        ->where("user_id",Auth::id())
        ->with(['reward:id,title'])
        ->get();

        return $this->api(RewardUserResource::collection($rewardUser),
        __METHOD__);

    }

    /**
    * reward user/store
     * @param \Modules\Reward\Http\Requests\RewardUserRequest $request
     * @param \Modules\Reward\Models\RewardUser $rewardUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RewardUserRequest $request,RewardUser $rewardUser)
    {

        $validated  = (array) $request->validated();
        $validated['user_id'] = auth()->id();

        $reward = $this->findRewradById($validated['Reward_id']);

        try{

            DB::beginTransaction();

             $userScore = (bool) $this->hasUserEnoughScore($reward);

            if(! $userScore)
                return $this->api(null,__METHOD__,
            "you dont have enough score");
            
            auth()->user()->decrement("score", $reward->cost);

          $rewardUser =   $rewardUser->addNewRewardUser($validated);

            DB::commit();

            return $this->api(new RewardUserResource($rewardUser->toArray()),
            __METHOD__);

        }catch(Exception $e){

            DB::rollBack();

              return $this->api(null,
            __METHOD__,"Unknown error occurred!". $e->getMessage());
            
        }

    }

    public function hasUserEnoughScore($reward): ?bool
    {
        if(auth()->user()->score < $reward->cost) 
            return false;

        return true;
    }

    public function findRewradById(int $rewardId)
    {
        return Reward::find($rewardId);
    }

}
