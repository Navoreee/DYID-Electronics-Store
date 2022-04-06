<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function showCategories()
    {
        $categories = Category::paginate(10);
        return view('admin.view_category', compact('categories'));
    }

    public function showAddCategoryForm()
    {
        return view('admin.add_category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|unique:categories',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('message', 'Category successfully added.');
    }

    public function showEditCategoryForm($id)
    {
        $category = Category::where('id','=',$id)->first();
        return view('admin.edit_category', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => [
                'required',
                'min:2',
                Rule::unique('categories')->ignore($id),
            ],
        ]);

        $category = Category::where('id','=',$id)->first();
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('message', 'Category successfully updated.');
    }

    public function deleteCategory(Request $request)
    {
        $id = $request->id;
        Category::where('id','=',$id)->delete();
        return redirect()->back();
    }
}
