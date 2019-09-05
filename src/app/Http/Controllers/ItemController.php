<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $items = Item::with(['supplier:id,name', 'category:id,name'])->get();

      return view('pages.item.index', [
        'items' => $items,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('pages.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        $validatedData = $request->validate([
          'name' => 'unique:items|required',
          'price' => 'required',
          'stock' => 'required',
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        Item::create($validatedData);
      }

      return redirect()->route('item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $item = Item::find($id);

      return view('pages.item.edit', [
        'item' => $item,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try {
        $validatedData = $request->validate([
          'name' => 'unique:items|required',
          'price' => 'required',
          'stock' => 'required',
          'sold' => 'required',
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        Item::where('id', $id)->update($validatedData);
      }

      return redirect()->route('item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        Item::where('id', $id)->delete();
      } catch (Exception $e) {
        return abort(404, $e);
      }

      return redirect()->route('item');
    }
}
