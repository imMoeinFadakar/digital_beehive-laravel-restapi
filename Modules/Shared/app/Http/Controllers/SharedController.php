<?php

namespace Modules\Shared\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Modules\AuthOtpSms\Traits\SendSmsTrait;
use Modules\Shared\Traits\DataTrait;
use Modules\Shared\Traits\ApiResponseTrait;
use Modules\Shared\Traits\UploadImageTrait;
use Modules\Shared\Traits\CreateRandomCodeTrait;
use Modules\Shared\Traits\ReferralCodeTrait;

class SharedController extends Controller
{
    use ApiResponseTrait , CreateRandomCodeTrait, DataTrait,
     UploadImageTrait,SendSmsTrait,ReferralCodeTrait;


}
