<?php

namespace App\UseCases\Blog;

use App\Repositories\BlogRepository;

trait BaseBlogUseCase
{
    /**
     * @var BlogRepository
     */
    private BlogRepository $repository;

    public function __construct(BlogRepository $repository)
    {
        $this->repository = $repository;
    }
}
