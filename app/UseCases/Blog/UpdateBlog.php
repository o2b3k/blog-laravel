<?php

namespace App\UseCases\Blog;

use Exception;

class UpdateBlog
{
    use BaseBlogUseCase;

    /**
     * @param string $slug
     * @param array $data
     * @throws Exception
     */
    public function __invoke(string $slug, array $data)
    {
        $this->repository->update($slug, $data);
    }
}
