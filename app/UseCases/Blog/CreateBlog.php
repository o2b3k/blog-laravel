<?php

namespace App\UseCases\Blog;

class CreateBlog
{
    use BaseBlogUseCase;

    public function __invoke(array $data)
    {
        $this->repository->save($data);
    }
}
