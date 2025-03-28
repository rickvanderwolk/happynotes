<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

final class OwnNotesScope implements Scope
{
    #[\Override]
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::check()) {
            $builder->where('user_id', Auth::id());
        }
    }
}
