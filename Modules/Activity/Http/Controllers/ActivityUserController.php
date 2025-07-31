<?php

namespace Modules\Activity\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Activity\Models\Activity;
use Modules\Activity\Models\ActivityUser;
use Modules\Activity\Http\Requests\ActivityRequest;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\Activity\Transformers\ActivityUserResource;
use Illuminate\Support\Facades\DB;

class ActivityUserController extends SharedController
{
    /**
     * activityUser/index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $ActivityUser = ActivityUser::query()
        ->where("user_id",Auth::user()->id)
        ->when(isset($request->activity_id), fn($query)=> $query->where("activity_id", $request->activity_id)) 
        ->when(isset($request->id), fn($query)=> $query->where("id", $request->id )) 
        ->with(['activity:id,title,description,image'])
        ->get();
        
        return $this->api(ActivityUserResource::collection($ActivityUser),
        __METHOD__);
        
    }

    /**
     * activityUser/store
     * @param \Modules\Activity\Http\Requests\ActivityRequest $request
     * @param \Modules\Activity\Models\ActivityUser $activityUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ActivityRequest $request, ActivityUser $activityUser) 
    {

        if($this->isUserActivityExists($request->activity_id))
            return $this->api(null,__METHOD__,"you done this activity before");

        $validated = $request->validated();
       
        $activity = $this->getRewardById($validated['activity_id']);

        $user = Auth::user();


        try{

            DB::beginTransaction();

            $user->increment("score",$activity->reward);

            $validated['user_id'] = auth()->user()->id;

            $activityUser =  $activityUser->addNewActivityUser($validated);

            DB::commit();

             return $this->api(new ActivityUserResource($activityUser->toArray()),
            __METHOD__);

        }catch(Exception $e){

            Db::rollBack();

              return $this->api(null,
            __METHOD__,"Unknown error occurred!" . $e->getMessage());

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
