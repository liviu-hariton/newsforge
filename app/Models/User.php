<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\EmailConfirmLink;
use App\Mail\PasswordReset;
use App\Traits\HasPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        'password' => 'hashed',
        'data' => 'array',
    ];

    public function adminProfile(): HasOne
    {
        return $this->hasOne(AdminProfile::class);
    }

    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function articlePhotoGalleries(): HasMany
    {
        return $this->hasMany(ArticlePhotoGallery::class);
    }

    public function articlePhotoGalleryImages(): HasMany
    {
        return $this->hasMany(ArticlePhotoGalleryImage::class);
    }

    public function sendPasswordResetNotification($token): void
    {
        Mail::to($this->email)->send(
            new PasswordReset(
                from_address: _tnrs('from_address'),
                from_name: _tnrs('from_name'),
                the_name: $this->name,
                the_subject: 'Your password reset link request',
                the_reset_url: route('password.reset', [
                    'token' => $token,
                    'email' => $this->email
                ]),
            )
        );
    }

    public function sendEmailVerificationNotification(): void
    {
        Mail::to($this->email)->send(
            new EmailConfirmLink(
                from_address: _tnrs('from_address'),
                from_name: _tnrs('from_name'),
                the_name: $this->name,
                the_subject: 'Verify your email for a seamless experience!',
                the_confirm_url: URL::temporarySignedRoute(
                    'verification.verify',
                    now()->addMinutes(config('auth.verification.expire', 60)),
                    [
                        'id' => $this->id,
                        'hash' => sha1($this->email),
                    ]
                ),
            )
        );
    }
}
