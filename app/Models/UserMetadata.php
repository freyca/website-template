<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Role;
use App\Models\Scopes\UserMetadataScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

#[ScopedBy([UserMetadataScope::class])]
class UserMetadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'postal_code',
    ];

    /**
     * @return BelongsTo<User, UserMetadata>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function (UserMetadata $userMetadata) {
            /** @var ?\App\Models\User $user */
            $user = Auth::getUser();

            match (true) {
                $user === null => true,
                $user->role === Role::Admin => true,
                default => $userMetadata->user_id = $user->id,
            };
        });
    }
}
