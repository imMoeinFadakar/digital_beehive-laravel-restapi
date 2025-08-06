<?php

namespace Modules\Reward\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Reward\Models\Reward;
use App\Http\Controllers\Controller;
use Modules\Reward\Transformers\RewardResource;
use Modules\Shared\Http\Controllers\SharedController;

class RewardController extends SharedController
{
    /**
     * reward/controller
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $rewards = Reward::query()
        ->orderBy("id")
        ->where("status","active")
        ->when(isset($request->id), fn($query)=> $query->where("id",$request->id))
        ->when(isset($request->title), fn($query)=> $query->where("title","%" . $request->title . "%"))
        ->get();

        return $this->api( RewardResource::collection($rewards),__METHOD__);
    }

    /**
     * reward/show
     * @param \Modules\Reward\Models\Reward $reward
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Reward $reward)
    {
        return $this->api(new RewardResource($reward->toArray()),__METHOD__);
    }

}
