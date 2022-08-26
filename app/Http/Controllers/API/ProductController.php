<?php

namespace App\Http\Controllers\API;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();

        if($data){
            return Response::success($data);
        }
        else{
            return Response::error();
        }
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
        try{
            $request->validate([
                'nama' => 'required',
                'price' => 'required',
            ]);

            $product = Product::create([
                'nama'=>$request->nama,
                'price'=>$request->price,
            ]);

            $data = Product::where('id','=',$product->id)->get();

            if($data){
                return Response::success($data);
            }
            else{
                return Response::error();
            }
        }
        catch (Exception $error){
            return Response::error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::where('id','=',$id)->get();

        if($data){
            return Response::success($data);
        }
        else{
            return Response::error();
        }
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
        try{
            $request->validate([
                'nama' => 'required',
                'price' => 'required',
            ]);

            $product = Product::findOrFail($id);

            $product->update([
                'nama'=>$request->nama,
                'price'=>$request->price,
            ]);

            $data = Product::where('id','=',$product->id)->get();

            if($data){
                return Response::success($data);
            }
            else{
                return Response::error();
            }
        }
        catch (Exception $error){
            return Response::error();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{$product = Product::findOrFail($id);

        $data = $product->delete();

        $data = Product::all();

        if($data){
            return Response::success($data='Null');
        }
        else{
            return Response::error();
        }
    }
    catch(Exception $error){
        return Response::error();
    }
    }
}
