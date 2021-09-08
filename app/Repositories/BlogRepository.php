<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class BlogRepository implements BlogRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getActiveBlogs(): Collection
    {
        return Blog::active()->orderBy('created_at')->get();
    }

    /**
     * @param array $data
     */
    public function save(array $data)
    {
        Blog::save($data);
    }

    /**
     * @param string $slug
     * @param array $data
     * @throws Exception
     */
    public function update(string $slug, array $data)
    {
        $blog = Blog::ofSlug($slug)->first();
        if (!$blog) {
            throw new Exception("Blog not found");
        }
        $blog->update($data);
    }

    /**
     * @param int $id
     * @throws Exception
     */
    public function delete(int $id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            throw new Exception("Blog not found");
        }
        $blog->delete();
    }

    /**
     * @param string $slug
     * @return Blog|null
     */
    public function getBySlug(string $slug): ?Blog
    {
        return Blog::ofSlug($slug)->first();
    }
}
