<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'phone_number_e164',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_number_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getPhoneNumberE164Attribute(): string
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $phoneNumber = $phoneUtil->parse($this->phone_number, 'NG');

        return $phoneUtil->format($phoneNumber, PhoneNumberFormat::INTERNATIONAL);
    }

    public function routeNotificationForSms(Notification $notification): ?string
    {
        return $this->phone_number_e164;
    }
}
