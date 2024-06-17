<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Enums\Roles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserMetadataScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder<\App\Models\UserMetadata>  $builder
     */
    public function apply(Builder $builder, Model $model): void
    {
        /** @var ?\App\Models\User $user */
        $user = Auth::getUser();

        match (true) {
            $user === null => true,
            $user->role === Roles::Admin => true,
            default => $builder->where('user_id', $user->id),
        };
    }
}
