<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PublishedScope implements Scope
{
    /**
     * Limits the products users can see by published status
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('published', true);
    }
}
