<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Constants\UserConstant;
use App\Domains\Traits\FilterableBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, FilterableBuilder;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'access_level',
        'organization_id',
        'address',
        'cellphone',
        'complement',
        'number',
        'neighborhood',
        'register_number',
        'zipCode',
        'city',
        'state'
    ];

    const FILTERABLE_COLUMNS = [
        'id',
        'cpf',
        'auditor_name',
        'organization',
        'organization_name',
        'register_number'
    ];

    const COLUMN_ALIASES = [
        'organization' => 'organization_id',
        'organization_name' => 'organizations.name',
        'auditor_name' => 'users.name'
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

    public function organization(): BelongsTo{
        return $this->belongsTo(Organization::class);
    }

    public function getAuthUser(){
        return Auth::user();
    }

    public function isGeneralAuditor(){
        return $this->access_level == UserConstant::GENERAL_AUDITOR;
    }

    public function isCitizen(){
        return $this->access_level == UserConstant::CITIZEN;
    }

    public function isAuditor(){
        return $this->access_level == UserConstant::AUDITOR;
    }
}
