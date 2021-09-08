<?php

namespace App\Interfaces;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;

interface BlogRepositoryInterface
{
    public function getActiveBlogs(): Collection;

    public function save(array $data);

    public function update(string $slug, array $data);

    public function delete(int $id);

    public function getBySlug(string $slug): ?Blog;
}
