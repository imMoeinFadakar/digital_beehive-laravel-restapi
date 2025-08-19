<?php

namespace Modules\Activities\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Activities\Models\Activity;
use Modules\Activities\Transformers\ActivityResource;
use Modules\Shared\Traits\ApiResponseTrait;

class ActivityController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
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
     * Show the specified resource.
     */
    public function show(Activity $activity)
    {
         return $this->api(new ActivityResource($activity->toArray()),__METHOD__);

    }


}
