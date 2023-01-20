<?php
//Bộ điều khiển danh mục
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $categories = Category::whereNull('parent_id')->with('descendants')->get();
        // return view('categories.index',compact('categories'));
        $categories = Category::with('descendants');  // descendants ở phần model/category
        if ($request->has('keyword') && trim($request->keyword)) {
            $categories->search($request->keyword);
        } else {
            $categories ->onlyParent();
        }
        return view(
            'categories.index',
            ['categories' => $categories->paginate(10)
            ->appends(['keyword'=>$request->get('keyword')])
            ]
        );
        // đưa 10 dữ liệu yển mỗi trang
    }

    // truy van tim kiem san pham
    public function select(Request $request)
    {
        $categories = [];
        if ($request->has('q')) {
            $search = $request->q;
            $categories = Category::select('id', 'title')->where('title', 'LIKE', "%$search%")->limit(6)->get();
        } else {
            $categories = category::select('id', 'title')->onlyParent()->limit(6)->get;
        }
        return response()->json($categories);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // hàm khôi phục thông tin 
    //kieem ham add
    public function store(Request $request)
    {
        //   dd( $request->thumbnail,);
        // parse_url( $request->thumbnail));
        //validator là API dùng để xác thực một cách nhanh chóng khỏi mất công viết hàm
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:60',
                'slug' => 'required|string|unique:categories,slug',
                'thumbnail' => 'required',
                'description' => 'required|string|max:240',
            ],
            [],
            //customAttributes - giúp hỗ trợ phiên dịch
            $this->attribut()
        );
        // nếu validator sẽ lư lại thông tin củ sau khi được trả về - tuy nhiên nó đang không hoạt động
        if ($validator->fails()) {
            if ($request->has('parent_catagory')) {
                $request['parent_catagory'] = Category::select('id', 'title')->find($request->parent_catagory);
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

     
        //         //create datac Category
        try {
            Category::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'parent_id' => $request->parent_category
            ]);
            Alert::success(
                trans('categories.alert.create.title'),
                trans('categories.alert.create.message.success')
            ); // hiện bản thông báo
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            if ($request->has('parent_catagory')) {
                $request['parent_catagory'] = Category::select('id', 'title')->find($request->parent_catagory);
            }
            Alert::error(
                // trans('categories.alert.create.title'),
                'chay dell dc',
                trans('categories.alert.create.message.error'),
                ['error' => $th->getMessage()]
            ); // hiện bản thông báo
            return redirect()->back()->withInput($request->all())->withErrors($validator);
            
        }


        // dd("data inserted | Đã chèn dữ liệu", $request->all());

        // cẩn thận nội bộ validate rất dễ lỗi với khoản cách
        // uique độc nhất
        // sao chép lại biểu mẫu $title = $request->old('title');
        // <input type="text" name="title" value="{{ old('title') }}">
        // $redirect  được tạo để đưa người dùng trở lại vị trí trước đó của họ khi xác thực yêu cầu biểu mẫu không thành công. 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    //  compact ĐỂ TRUYỀN THAM SỐ VÀO INDEX

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // dd($category);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        // dd(
        //     $request->all(),
        //     $category
        // );
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:60',
                'slug' => 'required|string|unique:categories,slug,' . $category->id,
                'thumbnail' => 'required',
                'description' => 'required|string|max:240',
            ],
            [],
            //customAttributes - giúp hỗ trợ phiên dịch
            $this->attribut()
        );
        // nếu validator sẽ lư lại thông tin củ sau khi được trả về - tuy nhiên nó đang không hoạt động
        if ($validator->fails()) {
            if ($request->has('parent_catagory')) {
                $request['parent_catagory'] = Category::select('id', 'title')->find($request->parent_catagory);
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        // dd( $request->thumbnail,
        // parse_url( $request->thumbnail));
        //update datac Category

        try {
            $category->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'parent_id' => $request->parent_category
            ]);
            Alert::success(
                trans('categories.alert.update.title'),
                trans('categories.alert.update.message.success')
            ); // hiện bản thông báo
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            if ($request->has('parent_catagory')) {
                $request['parent_catagory'] = Category::select('id', 'title')->find($request->parent_catagory);
            }
            Alert::error(
                trans('categories.alert.update.title'),
                trans('categories.alert.update.message.error'),
                ['error' => $th->getMessage()]
            ); // hiện bản thông báo
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Alert::success(
                trans('categories.alert.delete.title'),
                trans('categories.alert.delete.message.success')
            );
        } catch (\Throwable $th) {
            Alert::error(
                trans('categories.alert.delete.title'),
                trans('categories.alert.delete.message.error'),
                ['error' => $th->getMessage()]
            ); // hiện bản thông báo

        }
        return redirect()->back();
    }
    // giúp viết sub sang mộ số thuộc tính
    private function attribut()
    {
        return [
            'title' => trans('categories.form_control.input.title.attribute'),
            'slug' => trans('categories.form_control.input.slug.attribute'),
            'thumbnail' => trans('categories.form_control.input.thumbnail.attribute'),
            'description' => trans('categories.form_control.textarea.description.attribute'),
        ];
    }
}
