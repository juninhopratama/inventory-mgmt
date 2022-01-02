<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::table('items')
            ->orderBy('item_id','asc')
            ->paginate(50);
        
        return view('fifo.allitem', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fifo.registitem');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|unique:items,item_id',
            'item_name' => 'required',
            'item_satuan' => 'required'
        ]);

        $item = Items::create($request->all());

        return redirect()->route('registitem.create')
            ->with('success', 'Item baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Items::where('item_id', $id)->first();

        return view('fifo.edititem', [
            'item' => $item
        ]);
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
        $request->validate([
            'item_id' => 'required',
            'item_name' => 'required',
            'item_satuan' => 'required'
        ]);

        $item = Items::where('item_id', $id)->update($request->except(['_token', '_method']));

        return redirect()->route('registitem.edit', $id)
            ->with('success', 'Item berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Items::where('item_id', $id)->first();
        $item_name = $item->item_name;
        $item = Items::where('item_id', $id)->delete();
        return redirect()->route('allitem.show')
            ->with('success', 'Item ['.$id.' - '.$item_name.'] berhasil dihapus.');
    }
}
