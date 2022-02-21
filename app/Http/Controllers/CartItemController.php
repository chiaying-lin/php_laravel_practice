<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;
use App\Models\Cart;
use App\Models\CartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //add data新增資料、建造資料的函示
        // $form = $request->all();
        // DB::table('cart_items')->insert(['cart_id' => $form['cart_id'],
        //                                  'quantity' => $form['quantity'],
        //                                  'product_id' => $form['product_id'],
        //                                  'created_at' => now(),
        //                                   'updated_at' => now()]);
        // return response()->json(true);
        $messages = [
            'required' => ':attribute 是必填的欄位',
            'between' => ':attribute 的輸入 :input 不在 :min 和 :max 之間'
        ];

        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|between:1,10'
        ], $messages);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $validatedData = $validator->validate();
        $cart = Cart::find($validatedData['cart_id']);
        $result = $cart->cartItems()->create([
            'quantity' =>  $validatedData['quantity'],
            'product_id' =>  $validatedData['product_id']
        ]);
        return response()->json($result);
        //dd($validatedData);
        // DB::table('cart_items')->insert([
        //     'cart_id' =>  $validatedData['cart_id'],
        //     'quantity' =>  $validatedData['quantity'],
        //     'product_id' =>  $validatedData['product_id'],
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // return response()->json(true);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartItem $request, $id)
    {
        //更新資料
        $form = $request->validated();
        $item = CartItem::find($id);
        $item->fill(['quantity' => $form['quantity']]);
        $item->save();
        // DB::table('cart_items')->where('id',$id)
        //                        ->update(['quantity' => $form['quantity'],
        //                                  'updated_at' => now()]);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //刪除資料
        //只會被softdelete
        CartItem::find($id)->delete();
        //強制刪除：即使被softdelete的資料強制被刪除
        //CartItem::withTrashed()->find($id)->forcedelete();
        // DB::table('cart_items')->where('id',$id)
        //                        ->delete();
        return response()->json(true);
    }
}
