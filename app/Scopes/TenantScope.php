<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if ( check_if_tenant_id_is_present() ) {
            $field = sprintf('%s.%s', $builder->getQuery()->from, 'tenant_id');

            // $builder->where($field, auth()->id())->orWhereNull($field);
            $builder->where($field, session()->get('tenant_id') );
        }
    }
}
