<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'department',
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
     * Get role label for display
     */
    public function getRoleLabel(): string
    {
        return match ($this->role) {
            'bendahara' => 'Bendahara Kampus',
            'staff_keuangan' => 'Staff Keuangan',
            'admin_fakultas' => 'Admin Fakultas',
            default => 'Staff Keuangan',
        };
    }

    /**
     * Scope a query to only include bendahara users
     */
    public function scopeBendahara($query)
    {
        return $query->where('role', 'bendahara');
    }

    /**
     * Scope a query to only include staff keuangan users
     */
    public function scopeStaffKeuangan($query)
    {
        return $query->where('role', 'staff_keuangan');
    }

    /**
     * Scope a query to only include admin fakultas users
     */
    public function scopeAdminFakultas($query)
    {
        return $query->where('role', 'admin_fakultas');
    }
}
