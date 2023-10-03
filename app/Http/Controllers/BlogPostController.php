<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $posts = BlogPost::latest()->where('status', BlogPost::STATUS_PUBLISHED)->paginate();

        return view('blog.index', [
            'posts' => $posts,
            'title' => 'All Gaming News',
        ]);
    }

    /**
     * It will show listing of all blog posts it's meant only for admin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex(Request $request)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        return view('panel.admin.blog.index', [
            'posts' => BlogPost::filter($request->all())->latest()->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        return view('panel.admin.blog.create', [
            'post' => new BlogPost(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        $payload = $request->validate([
            'content' => 'required',
            'category' => 'required|string',
            'title' => 'required|string',
            'slug' => 'required|string|unique:blog_posts,slug',
            'status' => 'required|string',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'page_title' => 'nullable',
            'schedule_publish_at' => 'nullable',
            'image' => 'required|image|dimensions:width=656,height=368'
        ]);


        $file = str_replace('public', 'storage', $request->file('image')->storePublicly('/public/blog-images'));

        $payload['image'] = \URL::to($file);

        $payload['slug'] = Str::slug($request->slug);

        if ($request->schedule_publish_at) {
            $payload['schedule_publish_at'] = Carbon::parse($request->schedule_publish_at);
        }

        $payload['content'] = str_replace(['<a'], '<a rel="noindex, nofollow"', $request->content);
        BlogPost::create($payload);

        session()->flash('success', 'Blog post has been created!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return mixed
     */
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->first();

        abort_if(! $post, 404);

        return view('blog.show', [
            'post' => $post,
            'title' => $post->page_title ?? $post->title,
            'meta_keywords' => $post->meta_keywords,
            'meta_description' => $post->meta_description,
        ]);
    }

    /**
     * Display lol blog posts.
     *
     * @return mixed
     */
    public function lol()
    {
        $posts = BlogPost::where('category', 'lol')->get();

        return view('blog.index', [
            'posts' => $posts,
            'title' => 'League of Legends News',
        ]);
    }

    /**
     * Display valorant blog posts.
     *
     * @return mixed
     */
    public function valorant()
    {
        $posts = BlogPost::where('category', 'valorant')->get();

        return view('blog.index', [
            'posts' => $posts,
            'title' => 'Valorant News',
        ]);
    }

    /**
     * Display csgo blog posts.
     *
     * @return mixed
     */
    public function csgo()
    {
        $posts = BlogPost::where('category', 'csgo')->get();

        return view('blog.index', [
            'posts' => $posts,
            'title' => 'CS:GO News',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        return view('panel.admin.blog.edit', [
            'post' => $blogPost,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        abort_if(! auth()->user()->hasRole('admin'), 404);

        $payload = $request->validate([
            'content' => 'required',
            'category' => 'required|string',
            'title' => 'required|string',
            'slug' => ['required', Rule::unique('blog_posts')->ignore($blogPost->id)],
            'status' => 'required|string',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'page_title' => 'nullable',
            'schedule_publish_at' => 'nullable',
            'image' => 'nullable|image|dimensions:width=656,height=368'
        ]);

        if ($request->schedule_publish_at) {
            $payload['schedule_publish_at'] = Carbon::parse($request->schedule_publish_at);
        }

        if ($request->hasFile('image')) {
            $file = str_replace('public', 'storage', $request->file('image')->storePublicly('/public/blog-images'));
            $payload['image'] = \URL::to($file);
        }

        $payload['content'] = str_replace(['<a'], '<a rel="noindex, nofollow"', $request->content);
        $blogPost->update($payload);

        session()->flash('success', 'Blog post has been updated.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        //
    }
}
