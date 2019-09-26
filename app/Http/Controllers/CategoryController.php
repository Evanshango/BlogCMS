<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category = new Category;
        $category->name = $request->name;

        $category->save();

        session()->flash('success', 'Category created');

        return redirect(route('categories.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return void
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return void
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;

        $category->update();

        session()->flash('success', 'Category updated.');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        foreach ($category->posts as $post){
            $post->deleteImage();
            $post->forceDelete();
        }

        $category->delete();

        session()->flash('success', 'Category deleted');
        return redirect(route('categories.index'));
    }
}
