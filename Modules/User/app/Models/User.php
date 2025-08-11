<?php

namespace Modules\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Modules\Sellers\Models\Seller;
use Modules\Auth\Models\SellerUser;
use Nwidart\Modules\Facades\Module;
use Modules\Activity\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Modules\OrderUser\Models\OrderUser;
use Illuminate\Notifications\Notifiable;
use Modules\UserProduct\Models\UserProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Auth\app\Notifications\ResetPasswordNotification;

// use Modules\User\Database\Factories\UserFactory;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        "last_name",
        'email',
        'password',
        'username',
        'phone_number',
        'address',
        'image',
        'status',
        'role',
        'refferal_code',
        'postal_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        "role",
        "status"
    ];


    public function seller_user()
    {
        return $this->hasMany(SellerUser::class);
    }


    public function getNonNullAttributes()
    {
        return collect($this->attributes)->filter(function ($value) {
            return !is_null($value);
        });
    }

    /**
     * Summary of sendPasswordResetNotification
     * @param mixed $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function seller(){ 

        return $this->hasOne(Seller::class);
    }


    public function order_user()
    {
        return $this->hasMany(OrderUser::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }



    public function addNewUser(array $validated): ?User
    {
        return $this->query()->create($validated);
    }

    public function updateUser(array $validated): ?static
    {
        $this->update($validated);
        return $this;
    }

    public function deleteUser(): ?bool
    {
        return $this->delete();
    }

}
