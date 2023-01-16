<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequests;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $listCategory = Category::all();
        return view('admin.category.index',compact('listCategory'));

    }

    public function add()
    {
        $title = 'Thêm Loại Sản Phẩm';
        return view('admin.category.add',compact('title'));

    }
    public function create(CategoryRequests $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('category.list')->with('msg','Thêm loại sản phẩm thành công');
    }
    public function edit($id)
    {
        $title = 'Sửa loại sản phẩm';
        $listCategory = Category::find($id);
        return view('admin.category.edit',compact('title','listCategory'));
    }

    public function update($id,Request $request)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->update();
        return redirect()->route('category.list')->with('msg','Sửa loại sản phẩm thành công');


    }
    public function destroy($id)
    {
        Product::where('category_id', $id)->delete();
        Category::where('id', $id)->delete();
        return redirect()->route('category.list')->with('deleted','Xóa sản phẩm thành công');
    }
}
