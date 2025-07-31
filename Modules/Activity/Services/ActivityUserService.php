<?php

namespace Modules\Activity\Services;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Activity\Models\Activity;
use Modules\Activity\Models\ActivityUser;
use Modules\Activity\Http\Requests\ActivityRequest;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\Activity\Transformers\ActivityUserResource;
use Illuminate\Support\Facades\DB;
class ActivityUserService 
{
    public function storeActivity($request,$activityUser) {
        
        if($this->isUserActivityExists($request->activity_id))
            return "you done this activity before";

        $validated = $request->validated();
       
        $activity = $this->getRewardById($validated['activity_id']);

        $user = Auth::user();


        try{

            DB::beginTransaction();

            $user->increment("score",$activity->reward);

            $validated['user_id'] = auth()->user()->id;

            $activityUser =  $activityUser->addNewActivityUser($validated);

            DB::commit();

             return $activityUser;

        }catch(Exception $e){

            Db::rollBack();

              return "Unknown error occurred! " . $e->getMessage() ;

        }
    }

        public function isUserActivityExists(int $activityId ): ?bool
    {
        return ActivityUser::query()
        ->where("user_id",auth()->user()->id)
        ->where("activity_id", $activityId)
        ->exists();
    }


    protected function getRewardById(int $rewardId)
    {
        return  Activity::find($rewardId);
    }

}
