<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\File as ModelsFile;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class FrontController extends Controller
{
    public function index()
    {
        $cities = City::all();
        $posts = Post::orderBy('id', 'desc')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.*', 'users.name as user_name')
            ->paginate(8);
        $popular = Post::orderBy('views', 'desc')->take(3)->get();
        $recent = Post::orderBy('id', 'desc')->take(3)->get();
        // return $posts;
        return view('frontends.index', compact('posts', 'popular', 'recent', 'cities'));
    }
    public function post()
    {
        $posts = Post::orderBy('id', 'asc')->with('files')->paginate(8);
        $popular = Post::orderBy('views', 'desc')->take(3)->get();
        $recent = Post::orderBy('id', 'desc')->take(3)->get();
        // return $posts;
        return view('frontends.post', compact('posts', 'popular', 'recent'));
    }
    public function search(Request $request)
    {
        $keyword = $request['keyword'];

        $posts = Post::where('title', 'like', "%" . $keyword . "%")
            ->paginate(2);
        $posts->appends(array('keyword' => $keyword));

        $popular = Post::orderBy('views', 'desc')->take(3)->get();
        $recent = Post::orderBy('id', 'desc')->take(3)->get();

        return view('frontends.search', compact('posts', 'popular', 'recent', 'keyword'));
    }

    public function category($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        $posts = Post::where('category_id', $category->id)
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.*', 'users.name as user_name')
            ->paginate(8);
        $popular = Post::orderBy('views', 'desc')->take(3)->get();
        $recent = Post::orderBy('id', 'desc')->take(3)->get();
        // return $posts;
        return view('frontends.category', compact('posts', 'popular', 'recent', 'category'));
    }
    public function tag($tag_slug)
    {

        $tag = Tag::where('slug', $tag_slug)->first();
        $post_tags = PostTag::where('tag_id', $tag->id)->get();
        $tagName = $tag->name;

        $posts = Post::whereHas('tag', function ($query) use ($tagName) {
            $query->whereName($tagName);
        })->paginate(8);

        $popular = Post::orderBy('views', 'desc')->take(3)->get();
        $recent = Post::orderBy('id', 'desc')->take(3)->get();
        // return $posts;
        return view('frontends.tag', compact('posts', 'popular', 'recent', 'tag'));
    }
    public function show(String $post_slug)
    {
        $post = Post::where('posts.slug', $post_slug)
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.*', 'categories.name as category_name', 'categories.slug as category_slug', 'users.name as user_name')
            ->first();
        $tags = PostTag::where('post_id', $post->id)
            ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
            ->select('post_tags.*', 'tags.name as tag_name', 'tags.slug as tag_slug')
            ->get();
        // return $tags;
        $related = Post::where('category_id', $post->category_id)->take(3)->get();
        $popular = Post::orderBy('views', 'desc')->take(3)->get();
        $recent = Post::orderBy('id', 'desc')->take(3)->get();

        $user = User::where('id', $post->user_id)->first();
        // return $user;

        // return $popular;
        $files = ModelsFile::where('post_id', $post->id)->get();
        // return $files;


        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', (request()->ip())) . '-' . $post->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $post->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $post->incrementReadCount(); //count the view

            return response()
                ->view('frontends.show', [
                    'post' => $post,
                    'related' => $related,
                    'popular' => $popular,
                    'recent' => $recent,
                    'user' => $user,
                    'tags' => $tags,
                    'files' => $files,

                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return view('frontends.show', compact('post', 'related', 'popular', 'recent', 'user', 'tags', 'files'));
        }
    }



    public function download($uuid)
    {
        $files = ModelsFile::where('uuid', $uuid)->first();
        $post = Post::where('id', $files->post_id)->first();
        // return $post;
        return view('frontends.download', compact('files', 'post'));
        // $hash = encrypt([
        //     'valid_to' => strtotime('+30 minutes'),
        //     'file_path' => '/home2/alihoss1/domains/alihossein.ir/public_html/dl/video/MySql/Sql1.mp4'
        // ]);
    }
    public function download_process($uuid)
    {
        $file = ModelsFile::where('uuid', $uuid)->first();
        $pathToFile = public_path('uploads/files/' . $file->file);


        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', (request()->ip())) . '-' . $file->uuid);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $file->uuid); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $file->incrementReadCount(); //count the view

            return response()->download($pathToFile); //store the cookie
        } else {
            return response()->download($pathToFile);
        }
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('frontends.page', compact('page'));
    }
}
