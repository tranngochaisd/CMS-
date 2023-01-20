<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('posts.create', [
            'categories' => Category::with('descendants')->onlyParent()->get(),
            'status' => $this->status(),
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
        //validator là API dùng để xác thực một cách nhanh chóng khỏi mất công viết hàm

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:60',
                'slug' => 'required|string|unique:posts,slug',
                'thumbnail' => 'required',
                'description' => 'required|string|max:240',
                'content' => 'required',
                'category' => 'required',
                'tag' => 'required',
                'status' => 'required',

            ],
            [],
            $this->atributes()
        );
        // chế độ xem tự động
        if ($validator->fails()) {
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Bắt đầu các hành động trên CSDL
        //DB:beginTransaction();  -> cẩn thận lỗi cú pháp :: thay vì :
        DB::beginTransaction();

        try {
            $post = Post::create([
                "title" => $request->title,
                "slug" => $request->slug,
                "thumbnail" => $request->thumbnail,
                "description" => $request->description,
                "content" => $request->content,
                "status" => $request->status,
                "user_id" => Auth::user()->id,
            ]);
            $post->tags()->attach($request->tag);
            $post->categories()->attach($request->category);

            Alert::success(
                trans('posts.alert.create.title'),
                trans('posts.alert.create.message.success'),
            );

            return redirect()->route('posts.index');
            // thiếu một dấu ngoặt kép mất gần 2 h đề fix lol   
        } catch (\Throwable $th) {
            //Gặp lỗi nào đó mới rollback
            DB::rollBack();
            Alert::error(
                trans('posts.alert.create.title'),
                trans('posts.alert.create.message.error', ['error' => $th->getMessage()]),
            );
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            //Commit dữ liệu khi hoàn thành kiểm tra
            DB::commit();
        }
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = $post->categories;
        $tags = $post->tags;

        return view('posts.detail', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::with('descendants')->onlyParent()->get(),
            'status' => $this->status(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:60',
                'slug' => 'required|string|unique:posts,slug,' . $post->id, // cẩn thận thiếu dấu ', ' sau slug
                'thumbnail' => 'required',
                'description' => 'required|string|max:240',
                'content' => 'required',
                'category' => 'required',
                'tag' => 'required',
                'status' => 'required',

            ],
            [],
            $this->atributes()
        );
        // chế độ xem tự động
        if ($validator->fails()) {
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        //DB:beginTransaction();  -> cẩn thận lỗi cú pháp :: thay vì :
        DB::beginTransaction();

        try {
            $post->update([
                "title" => $request->title,
                "slug" => $request->slug,
                "thumbnail" =>parse_url( $request->thumbnail)['path'],
                "description" => $request->description,
                "content" => $request->content,
                "status" => $request->status,
                "user_id" => Auth::user()->id,
            ]);
            $post->tags()->sync($request->tag);
            $post->categories()->sync($request->category);

            Alert::success(
                trans('posts.alert.update.title'),
                trans('posts.alert.update.message.success'),
            );

            return redirect()->route('posts.index');
            // thiếu một dấu ngoặt kép mất gần 2 h đề fix lol   
        } catch (\Throwable $th) {
            //Gặp lỗi nào đó mới rollback
            DB::rollBack();
            Alert::error(
                trans('posts.alert.update.title'),
                trans('posts.alert.update.message.error', ['error' => $th->getMessage()]),
            );
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            //Commit dữ liệu khi hoàn thành kiểm tra
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        DB::beginTransaction();

        try {
            $post->tags()->detach();
            $post->categories()->detach();
                // Phương pháp xóa thẻ dữ liệu được chọn bởi thẻ post
            $post->delete();
        
            Alert::success(
                trans('posts.alert.delete.title'),
                trans('posts.alert.delete.message.success'),
            );

            return redirect()->route('posts.index');
            // thiếu một dấu ngoặt kép mất gần 2 h đề fix lol   
        } catch (\Throwable $th) {
            //Gặp lỗi nào đó mới rollback
            DB::rollBack();
            Alert::error(
                trans('posts.alert.delete.title'),
                trans('posts.alert.delete.message.error', ['error' => $th->getMessage()]),
            );
            
        } finally {
            //Commit dữ liệu khi hoàn thành kiểm tra
            DB::commit();
            return redirect()->back();

        }
    }

    public function status()
    {
        return [
            'draft' => trans('posts.form_control.select.status.option.draft'),
            'publish' => trans('posts.form_control.select.status.option.publish'),

        ];
    }
    private function atributes()
    {
        return [
            'title' => trans('posts.form_control.input.title.attribute'),
            'slug' =>  trans('posts.form_control.input.slug.attribute'),
            'thumbnail' =>  trans('posts.form_control.input.thumbnail.attribute'),
            'description' => trans('posts.form_control.textarea.description.attribute'),
            'content' => trans('posts.form_control.textarea.description.attribute'),
            'category' => trans('posts.form_control.input.category.attribute'),
            'tag' => trans('posts.form_control.select.tag.attribute'),
            'status' => trans('posts.form_control.select.status.attribute'),
        ];
    }
}
