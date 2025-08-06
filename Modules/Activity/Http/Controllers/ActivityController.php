<?php

namespace Modules\Activity\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Activity\Models\Activity;
use Modules\Activity\Transformers\ActivityResource;
use Modules\Shared\Http\Controllers\SharedController;

class ActivityController extends SharedController
{
    /**
     * activity/index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $activity = Activity::query()
        ->where("status","active")
        ->when(isset($request->id), fn($query)=> $query->where("id",$request->id))
        ->when(isset($request->score), fn($query)=> $query->where("id",$request->score))
        ->when(isset($request->title), fn($query)=> $query->where("title","%". $request->title. "%")) 
        ->get();

        return $this->api(ActivityResource::collection($activity),__METHOD__);
    }


    /**
     * activity/show
     * @param \Modules\Activity\Models\Activity $activity
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Activity $activity)
    {
        return $this->api(new ActivityResource($activity->toArray()),__METHOD__);
    }


}
