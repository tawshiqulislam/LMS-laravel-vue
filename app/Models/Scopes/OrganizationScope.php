<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrganizationScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (app()->bound('currentOrganization') && app('currentOrganization')) {
            $organization = app('currentOrganization');
            $builder->where($model->getTable() . '.organization_id', $organization->id);
        } else {
            // main domain হলে → শুধু global course (organization_id null)
            if (request()->is('api/*')) {
                $builder->whereNull($model->getTable() . '.organization_id');
            }
            if (request()->is('admin/*')) {
                $builder->whereNull($model->getTable() . '.organization_id');
            }
        }
    }
}
