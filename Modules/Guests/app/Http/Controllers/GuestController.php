<?php

namespace Modules\Guests\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Guests\Models\Guest;
use Modules\Guests\Http\Requests\addNewGuestRequest;
use Modules\Guests\Models\GuestCard;
use Modules\Guests\Transformers\GuestResource;
use Modules\Shared\Http\Controllers\SharedController;

class GuestController extends SharedController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $guest =  Guest::query()
        ->when(isset($request->status), fn($query) => $query->where("status", $request->status))
        ->where("user_id", auth()->user()->id)
        ->get();

        return $this->api(GuestResource::collection($guest),__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(addNewGuestRequest $request,Guest $guest)
    {
        $validated = $request->validated();
        $guestCode = $this->getGuestCode($validated['code']);
        if(! $guestCode)
            return $this->api(null,__METHOD__,"code is not valied!");

        $this->updateGuestCode($guestCode);

        $validated['user_id'] = $guestCode->user_id;
        
        $guest = $guest->addNewGuest($validated);


        return $this->api(new GuestResource($guest->toArray()),__METHOD__);

        // $guest->addNewGuest($);

        // return 
    }

    protected function updateGuestCode(GuestCard $guestCard)
    {
        $guestCard->status = "used";
        $guestCard->save();
        return;
    }


    public function getGuestCode(int $guestCode) : GuestCard|null
    {
        return GuestCard::query()
        ->where("code", $guestCode)
        ->where("status","not_used")
        ->first(["user_id"]);
    }


}
