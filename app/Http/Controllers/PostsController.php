<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Intervention\Image\File;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $category = Category::all();
        $tags = Tag::all();

        if ($category->count() == 0){
            session()->flash('info', 'You must have at least a category before attempting to create a post');
            return redirect(route('category.create'));
        } elseif ($tags->count() == 0){
            session()->flash('info', 'You must have at least a tag before attempting to create a post');
            return redirect(route('tag.create'));
        }

        return view('admin.posts.create')->with('categories', $category)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return void
     */
    public function store(PostRequest $request)
    {
        $post = new Post;
        $img = $request->featured->store('posts', 'public');
        $image = Image::make(public_path('storage/' . $img))->resize(null, 300, function ($constraint){
            $constraint->aspectRatio();
        });
        $image->save();

        $post->title = $request->title;
        $post->contents = $request->contents;
        $post->category_id = $request->category_id;
        $post->slug = str_slug($request->title);
        $post->user_id = Auth::id();
        $post->featured = 'storage/' .$img;

        $post->save();

        if ($request->tags){
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post created successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return void
     */
    public function edit(Post $post)
    {
        $category = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create')
            ->with('post', $post)
            ->with('categories', $category)
            ->with('tags', $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param $id
     * @return void
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        if ($request->hasFile('featured')){
            $img = $request->featured->store('posts', 'public');
            $post->deleteImage();
            $image = Image::make(public_path('storage/' . $img))->resize(null, 300, function ($constraint){
                $constraint->aspectRatio();
            });
            $image->heighten(300);
            $post->featured = 'storage/' . $img;
            $image->save();
        }

        $post->title = $request->title;
        $post->contents = $request->contents;
        $post->category_id = $request->category_id;
        $post->slug = str_slug($request->title);
        $post->user_id = Auth::id();

        if ($request->tags){
            $post->tags()->sync($request->tags);
        }
        $post->update();
        session()->flash('success', 'Post updated successfully');
        return redirect(route('posts.index'));
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        session()->flash('success', 'Post restored');
        return redirect()->back();
    }

    public function trash(){
        $trash = Post::onlyTrashed()->get();
        return view('admin.posts.index')->with('posts', $trash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     * @throws \Exception
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();

        } else {
            $post->delete();
        }

        session()->flash('success', 'Post deleted successfully');
        return redirect()->back();

    }
}
