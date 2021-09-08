<?php

namespace App\UseCases\Blog;

use Exception;

class DeleteBlog
{
    use BaseBlogUseCase;

    /**
     * @param int $id
     * @throws Exception
     */
    public function __invoke(int $id)
    {
        $this->repository->delete($id);
    }
}
