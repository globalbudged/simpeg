<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\Traits\HasUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
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
    ];

    // logsActivity
    protected static $logAttributes = ['name', 'email', 'password'];
    protected static $logName = 'user';
    protected static $logOnlyDirty = true;
    public function getDescriptionForEvent(string $eventName): string
    {
        return "User History {$eventName}";
    }



    public function pegawai()
    {
       return $this->hasOne(Pegawai::class);
    }
    public function audit_log()
    {
       return $this->hasOne(AuditLog::class);
    }

    public function log($message)
    {
        $message = ucwords($message);
        $data = [
            'user_id'=>$this->id,
            'name'=>$this->name,
            'date'=>Carbon::parse(now())->toString(),
            'activity'=> $message
            // 'activity'=>"{$this->name} $message"
        ];
       AuditLog::query()->create($data);
    }

    
    
}
