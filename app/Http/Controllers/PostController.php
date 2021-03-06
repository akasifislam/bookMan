<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Post::query()->get();
        // return Post::get();
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $post_query = Post::withCount('comments')->where('user_id', auth()->id());

        if ($request->category) {
            $post_query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        if ($request->keyword) {
            $post_query->where('title', 'LIKE', '%' . $request->keyword . '%');
        }
        if ($request->sortByComments && in_array($request->sortByComments, ['asc', 'desc'])) {
            $post_query->orderBy('comments_count', $request->sortByComments);
        }
        if ($request->sortByQuantality && in_array($request->sortByQuantality, ['asc', 'desc'])) {
            $post_query->orderBy('comments_count', $request->sortByQuantality);
        }
        if ($request->sortByPrice && in_array($request->sortByPrice, ['asc', 'desc'])) {
            $post_query->orderBy('comments_count', $request->sortByPrice);
        }
        if ($request->sortByName && in_array($request->sortByName, ['asc', 'desc'])) {
            $post_query->orderBy('comments_count', $request->sortByName);
        }


        $data['posts'] = $post_query->orderBy('id', 'DESC')->paginate(4);
        return view('post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['tags'] = Tag::orderBy('id', 'DESC')->get();
        return view('post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'image' => 'required|image|mimes:png,jpg',
            'tags' => 'required|array',
        ], [
            'category.required' => 'please select a categiry',
            'tags.required' => 'please select a Tags',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path('post_images'), $image_name);
        }
        $post = Post::create([
            'title' => $request->title,
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'image' => $image_name,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category
        ]);
        $post->tags()->sync($request->tags);
        return redirect()->route('app.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['post'] = Post::findOrFail($id);
        return view('post.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['post'] = Post::findOrFail($id);
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['tags'] = Tag::orderBy('id', 'DESC')->get();
        return view('post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'image' => 'nullable|image|mimes:png,jpg',
            'tags' => 'required|array',
        ], [
            'category.required' => 'please select a categiry',
            'tags.required' => 'please select a Tags',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path('post_images'), $image_name);
            $old_path = public_path() . 'post_images/' . $post->image;

            if (\File::exists($old_path)) {
                \File::delete($old_path);
            }
        } else {
            $image_name = $post->image;
        }
        $post->update([
            'title' => $request->title,
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'image' => $image_name,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category
        ]);
        $post->tags()->sync($request->tags);
        return redirect()->route('app.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $old_path = public_path() . 'post_images/' . $post->image;

        if (\File::exists($old_path)) {
            \File::delete($old_path);
        }

        $post->delete();

        return redirect()->route('app.post.index');
    }
}
