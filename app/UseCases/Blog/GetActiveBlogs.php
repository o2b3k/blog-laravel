<?php

namespace App\UseCases\Blog;

use Illuminate\Database\Eloquent\Collection;

class GetActiveBlogs
{
    use BaseBlogUseCase;

    /**
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return $this->repository->getActiveBlogs();
    }
}
