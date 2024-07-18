<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\master\Location;
use App\Models\Rank;
use App\Models\Forces;
use App\Models\Usertype;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RankEnum;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'regt_no',
        'rank_id',
        'name',
        'email',
        'password',
        'status',
        'last_login_ip',
        'suspend',
        'location_id',
        'last_login_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userlocation()
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }

    protected $appends = ['rank_name'];

    public function getRankNameAttribute()
    {
        return $this->rank_id ? RankEnum::getRankName($this->rank_id) : '';
    }

}
