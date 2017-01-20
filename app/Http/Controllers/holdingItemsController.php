<?php

namespace App\Http\Controllers;

use App\HoldingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class holdingItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = HoldingItem::all();
        return $items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return '[' . __METHOD__ . '] ' . 'respond a create form';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ip    = Input::get('ip');
        $type  = Input::get('type');
        $price = Input::get('price');
        $share = Input::get('share');

        $item = New HoldingItem();
        $item->ip = $ip;
        $item->type = $type;
        $item->price = $price;
        $item->share = $share;
        $item->save();

        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = HoldingItem::find($id);
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return '[' . __METHOD__ . '] ' . 'respond an edit form for id of ' . $id;
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

        $ip  = Input::get('ip');
        $type  = Input::get('type');
        $price = Input::get('price');
        $share = Input::get('share');

        $item = HoldingItem::find($id);
        $item->ip = $ip;
        $item->type = $type;
        $item->price = $price;
        $item->share = $share;
        $item->save();

        return $item;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = HoldingItem::find($id);
        $item->delete();

        return ['success'=>true];
    }
}
