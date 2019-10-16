<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('pages.category.index',[
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=> 'unique:categories|required'
        ]);
        Category::create($validatedData);
        return redirect('category')->with('message', 'Tambah category berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrfail($id);
        return view('pages.category.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'=> 'required'
        ]);
        $category= Category::findOrfail($id);
        $category->update($validatedData);
        return redirect('/category')->with('message', 'Edit category berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        return redirect('/category');
    }
    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('pages.category.trash', [
            'categories' => $categories
        ]);
    }
    public function destroypermanent($id)
    {
        $category = Category::onlyTrashed()->findOrfail($id);
        $category->forceDelete();
        return redirect('category/trash');
    }
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrfail($id);
        $category->restore();
        return redirect('category/trash');
    }
}
