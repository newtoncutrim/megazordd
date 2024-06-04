<?php

namespace App;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JWTauth extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = "jwt_users";

    protected $fillable = [
        'email',
        'password'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'password'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function cliente()
    {
        return $this->hasOne(Clients::class, 'email', 'email')->where('active', 1)->first();
    }
}
