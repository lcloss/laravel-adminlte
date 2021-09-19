<?php

namespace App\Models;

use App\Models\Traits\Statusable;
use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Statusable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id',
        'status',
        'approved',
        'verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            /* Do not verify if user was created on admin panel */
            if (auth()->check()) {
                $user->verified = 1;
                $user->verified_at = Carbon::now()->format(config('constants.timestamp_format'));
                $user->save();

            /* Create a verification token and notify user to verify your email address */
            } elseif (!$user->verification_token) {
                $token = Str::random(64);
                $usedToken = User::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;

                /* Create tenant for user */
                $tenant = Tenant::create([
                    'name'      => $user->name
                ]);
                $user->tenant_id = $tenant->id;

                $user->save();

                /* Assign the user to default role */
                $registrationRole = config('constants.registration_default_role_id');
                if (!$user->roles()->get()->contains($registrationRole)) {
                    $user->roles()->attach($registrationRole);
                }

                $user->notify(new VerifyUserNotification($user));
            }
        });
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat(config('constants.datetime.timestamp_format'), $value)->format(config('constants.datetime.timestamp_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('constants.datetime.timestamp_format'), $value)->format(config('constants.datetime.timestamp_format')) : null;
    }

    public function getIsAdminAttribute()
    {
        if ( $this->roles->contains( 1 ) ) {
            return true;
        }

        return false;
    }

    public function tenant()
    {
        /**
         * User model cannot has Tenant trait (make sure admin has no Tenant id)
         */
        return $this->belongsTo(Tenant::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Serialize $dates
     *
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format(config('constants.timestamp_format'));
    }
}
