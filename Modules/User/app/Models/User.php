<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Activity\Models\Activity;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\UserProduct\Models\UserProduct;
use Laravel\Sanctum\HasApiTokens;
use Modules\Sellers\Models\Seller;

// use Modules\User\Database\Factories\UserFactory;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'email',
        'phone_number',
        'address',
        'image',
        'status',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        "id",
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        "role",
        "status"
    ];


    public function getNonNullAttributes()
    {
        return collect($this->attributes)->filter(function ($value) {
            return !is_null($value);
        });
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
