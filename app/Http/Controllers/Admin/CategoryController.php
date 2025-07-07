<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Index function to show categories
    public function index()
    {
        $searchTerm = request()->get('q');
        $categories = Category::latest()
            ->where('title', 'like', "%$searchTerm%")
            ->paginate(15);
        return view('Admin.category.index', compact('categories'));
    }

    // Create form view
    public function create()
    {
        return view('Admin.category.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Category::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    // Edit form view
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('Admin.category.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::findOrFail($id);
        $category->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    // Delete category with AJAX support
    public function destroy(string $id)
    {
        $category = Category::find($id);

        $category->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category deleted successfully']);
        }

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
