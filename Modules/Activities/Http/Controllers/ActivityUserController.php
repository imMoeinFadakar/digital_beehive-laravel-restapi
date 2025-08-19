<?php

namespace Modules\Activities\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Activities\Http\Requests\ActivityUserRequest;
use Modules\Activities\Models\Activity;
use Modules\Activities\Models\ActivityUser;
use Modules\Activities\Transformers\ActivityUserResource;
use Modules\Shared\Traits\ApiResponseTrait;

class ActivityUserController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(ActivityUserRequest $request,ActivityUser $activityUser)
    {
        $validated = $request->validated();
        if($this->hasUserActivity($validated['activity_id']))
            return $this->api(null,__METHOD__,
            "شما این ماموریت را قبلا انجام دادید!",400);

        $activity = $this->findActivity($validated['activity_id']);

        Auth::user()->increment('score',$activity->reward);

        $validated['user_id'] = Auth::id();
        $activityUser = $activityUser->addNewActivityUser($validated);

           return $this->api(new ActivityUserResource($activityUser->toArray()),
        __METHOD__); 
    }

    /**
     * @param int $activityId
     * @return Activity|null
     */
    protected function findActivity(int $activityId): ?Activity
    {
        return Activity::query()
        ->where("id",$activityId)
        ->where("status","active")
        ->first();
    }

    protected function hasUserActivity(int $activityId): ?bool
    {
        return   ActivityUser::query()
        ->where("user_id",Auth::id())
        ->where("activity_id",$activityId)
        ->exists();
    }




}
