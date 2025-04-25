<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
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

    public function points(): HasOne {
        return $this->hasOne(Points::class);
    }

    public function tasks(): HasMany {
        return $this->hasMany(CompletedTask::class);
    }

    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }

    public function dailyReward(): HasOne {
        return $this->hasOne(DailyReward::class);
    }

    public function currentTier(): Tier {
        // Get all tiers ordered by required_tasks ascending
        $tiers = Tier::orderBy('required_tasks')->get();

        // Loop through tiers from highest to lowest
        foreach ($tiers->reverse() as $tier) {
            $completedInWindow = CompletedTask::where('user_id', $this->id)
                ->where('created_at', '>=', now()->subDays($tier->days_threshold))
                ->count();

            if ($completedInWindow >= $tier->required_tasks) {
                return $tier;
            }
        }

        // Fallback to default tier
        return $tiers->firstWhere('default', true);
    }

    public function nextTierProgress(): ?array {
        // Get all tiers ordered by required_tasks ascending
        $tiers = Tier::orderBy('required_tasks')->get();

        foreach ($tiers as $tier) {
            $completedInWindow = CompletedTask::where('user_id', $this->id)
                ->where('created_at', '>=', now()->subDays($tier->days_threshold))
                ->count();

            if ($completedInWindow < $tier->required_tasks) {
                $percent = round(min(100, ($completedInWindow / $tier->required_tasks) * 100), 2);
                return [
                    'tier' => $tier,
                    'progress' => $percent,
                    'remaining_tasks' => $tier->required_tasks - $completedInWindow,
                ];
            }
        }

        // User has already unlocked all tiers
        return null;
    }
}
