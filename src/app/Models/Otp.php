<?php

namespace Taskio\UserManagement\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Otp extends Model
{

    /**
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'is_used',
        'expired_at'
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_used' => 'boolean',
            'is_expired' => 'datetime',
        ];
    }

    public function scopeNotUsed(Builder $builder): Builder
    {
        return $builder->where('is_used', false);
    }

    public function scopeUsed(Builder $builder): Builder
    {
        return $builder->where('is_used', true);
    }

    public function scopeNotExpired(Builder $builder): Builder
    {
        return $builder->where('expired_at', '>', Carbon::now());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
