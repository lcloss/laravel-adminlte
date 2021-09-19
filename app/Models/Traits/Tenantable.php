<?php

namespace App\Models\Traits;

use App\Scopes\TenantScope;
use App\Models\Tenant;

trait Tenantable
{
    /**
     * Assign to every model before it was inserted.
     */
    public static function bootTenantable()
    {
        static::addGlobalScope(new TenantScope());

        if ( check_if_tenant_id_is_present() ) {
            static::creating( function ( $model ) {
                $model->tenant_id = session()->get('tenant_id');
            });
        }
    }

    /**
     * Tenant relationship
     *
     * @return App\Models\Tenant
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

}
