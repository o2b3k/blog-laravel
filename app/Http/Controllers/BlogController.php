<?php

namespace App\Http\Controllers;

use App\UseCases\Blog\CreateBlog;
use App\UseCases\Blog\DeleteBlog;
use App\UseCases\Blog\GetActiveBlogs;
use App\UseCases\Blog\GetBlogBySlug;
use App\UseCases\Blog\UpdateBlog;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(GetActiveBlogs $activeBlogs)
    {
        $blogs = $activeBlogs();
        return view('blog.list', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBlog $createBlog
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(CreateBlog $createBlog, Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:blogs|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'title' => $request->input('title'),
            'slug' => trim(strtolower($request->input('title'))),
            'description' => $request->input('description'),
        ];
        $createBlog($data);

        return redirect()->route('');
    }

    /**
     * Display the specified resource.
     *
     * @param GetBlogBySlug $getBlogBySlug
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show(GetBlogBySlug $getBlogBySlug, string $slug)
    {
        $blog = $getBlogBySlug($slug);
        if (is_null($blog)) {
            abort(404);
        }

        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GetBlogBySlug $getBlogBySlug
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit(GetBlogBySlug $getBlogBySlug, string $slug)
    {
        $blog = $getBlogBySlug($slug);
        if (is_null($blog)) {
            abort(404);
        }

        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param UpdateBlog $updateBlog
     * @param string $slug
     * @return RedirectResponse|void
     * @throws Exception
     */
    public function update(Request $request, UpdateBlog $updateBlog, string $slug)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:blogs|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'title' => $request->input('title'),
            'slug' => trim(strtolower($request->input('title'))),
            'description' => $request->input('description'),
        ];
        $updateBlog($slug, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteBlog $deleteBlog
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(DeleteBlog $deleteBlog, int $id): RedirectResponse
    {
        $deleteBlog($id);

        return redirect()->back();
    }
}
