<?php

namespace Modules\Beehive\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Beehive\Http\Requests\UpdateBeehiveRequest;
use Modules\Beehive\Models\Beehive;
use Modules\Beehive\Transformers\BeehiveResorce;
use Modules\Beehive\Transformers\BeehiveResource;
use Modules\ProductUser\Models\ProductUser;
use Modules\Shared\Http\Controllers\SharedController;
use Modules\Shared\Traits\ApiResponseTrait;

/**
 * beehive are generating honey for user
 */
class BeehiveController extends Controller
{
    use ApiResponseTrait;
    /**
     * beehive/index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $beehive = Beehive::query()
        ->orderBy("id")
        ->where("user_id", auth()->user()->id)
        ->first();

        if(! $beehive) 
        return $this->api(null,__METHOD__,
        "you dont have beehive!",
        false,
        400);

        return $this->api(new BeehiveResorce($beehive->toArray()),__METHOD__);
    }

 

   
}
