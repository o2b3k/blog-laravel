<?php

namespace App\UseCases\Blog;

use App\Models\Blog;

class GetBlogBySlug
{
    use BaseBlogUseCase;

    /**
     * @param string $slug
     * @return Blog|null
     */
    public function __invoke(string $slug): ?Blog
    {
        return $this->repository->getBySlug($slug);
    }
}
