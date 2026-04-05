<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_KITCHEN_MANAGER = 'kitchen_manager';
    public const ROLE_USER_MANAGER = 'user_manager';
    public const ROLE_CUSTOMER = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'address',
        'account_type',
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

    /**
     * Get the user's full name.
     *
     * @return string
     */    public function getFullNameAttribute(): string
    {
        $fullName = $this->first_name;
        if ($this->middle_name) {
            $fullName .= ' ' . $this->middle_name;
        }
        $fullName .= ' ' . $this->last_name;
        return $fullName;
    }

    public function getNameAttribute(): string
    {
        return $this->full_name;
    }

    public static function validRoles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_KITCHEN_MANAGER,
            self::ROLE_CUSTOMER,
            self::ROLE_SUPER_ADMIN,
        ];
    }

    public function hasRole(string|array $roles): bool
    {
        $accountType = strtolower((string) $this->account_type);

        if (is_array($roles)) {
            $normalized = array_map(static fn ($role) => strtolower((string) $role), $roles);
            return in_array($accountType, $normalized, true);
        }

        return strtolower($roles) === $accountType;
    }

    public function getDashboardRoute(): string
    {
        if ($this->hasRole(self::ROLE_SUPER_ADMIN)) {
            return 'super-admin.dashboard';
        }

        if ($this->hasRole(self::ROLE_ADMIN)) {
            return 'admin.dashboard';
        }

        if ($this->hasRole(self::ROLE_KITCHEN_MANAGER)) {
            return 'kitchen.dashboard';
        }

        return 'dashboard';
    }
}
