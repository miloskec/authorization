<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $full_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasRoles, Notifiable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'full_name',
        'email',
        'user_id',
    ];

    // Get the identifier that will be stored in the subject claim of the JWT.
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Return a key-value array, containing any custom claims to be added to the JWT.
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the activity log options for the model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // Logs all attributes
            ->logOnlyDirty()
            ->useLogName('user')
            ->setDescriptionForEvent(fn (string $eventName) => "User has been {$eventName}");
    }
}
