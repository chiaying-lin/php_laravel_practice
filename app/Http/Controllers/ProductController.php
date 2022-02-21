<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('products')->get();
        return response($data);
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
        $data = $this->getData(); //先取得原本的資料
        $newdata = $request->all(); //新增的資料存進newdata
        $data->push(collect($newdata)); //array_push將新增的資料($newdata)加到原本陣列($data)的後面
        dump($data);
        return response($data); //再將$data回傳出去
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
    public function update(Request $request, $id)
    {
        $update = $request->all();
        $data = $this -> getData();
        $selected = $data -> where('id',$id)->first(); //選擇指定id的資料，first()可以直接取得該筆資料
        $selected = $selected->merge(collect($update)); //將指定的資料更新成新的資料
        return response($selected);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->getData();
        $data = $data->filter(function($product) use ($id){     //$product每一筆collect
            return $product['id'] != $id;  //id不相同就return到data
        });
        return response($data->values()); //取得純資料的形式
    }

    public function getData(){
        return collect([
            collect([
                'id' => 0,
                'fruit' => 'apple',
                'price' => '每袋50元',
                'origin' => '日本'
            ]),
            collect([
                'id' => 1,
                'fruit' => 'banana',
                'price' => '每袋70元',
                'origin' => '台灣'
            ]),
            collect([
                'id' => 2,
                'fruit' => 'grape',
                'price' => '每串80元',
                'origin'=> '台灣'
            ])
        ]);
    }
}
