<?php

namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Http\Requests\PageUpdateRequest;
use App\Models\Page;

class PageRepository extends Repository
{
    public static function model()
    {
        return Page::class;
    }

    public static function updateByRequest(PageUpdateRequest $request, $slug, $orgId)
    {
        return Page::updateOrCreate(
            ['organization_id' => $orgId, 'title'   => $request->title],
            [
                'slug'   => $slug,
                'content' => $request->content,
            ]
        );
    }
}
