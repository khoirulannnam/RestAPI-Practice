<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Product;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::latest()->get();

        foreach($data as $item){
            $idEncrypt = Crypt::encrypt($item->id);
            $item['id_encrypt'] = $idEncrypt;
        }
       
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
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'price' => 'required',
            ]);

            if ($validator->fails()) {
                return Response::validationError($validator->errors());
            }

            $product = Product::create([
                'nama' => $request->nama,
                'price' => $request->price,
            ]);

            if ($product) {
                return Response::success($product, 200, 'Produk berhasil dibuat');
            } else {
                return Response::error();
            }
        } catch (Exception $error) {
            return Response::error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        try{
            $code = Crypt::decrypt($code);
            if(!$code){
                return Response::error(null, 400, 'ID tidak ditemukan');
            }

            $data = Product::where('id','=',$code)->first();
            if($data){
                return Response::success($data, 200, 'Berhasil fecthing data');
            }else{
                return Response::error(null, 400, 'Data tidak ditemukan');
            }
        } catch (Exception $error) {
            return Response::error();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $code
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'price' => 'required',
            ]);

            if ($validator->fails()) {
                return Response::validationError($validator->errors());
            }

            $product = Product::where('id',$code)
            ->update([
                'nama' => $request->nama,
                'price' => $request->price,
            ]);
            
            if ($product > 0) {
                return Response::success(null, 200, 'Data berhasil diupdate');
            }else{
                return Response::error(null, 400, 'Data tidak terupdate');
            }
        } catch (Exception $error) {
            return Response::error();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        try{
            $code = Crypt::decrypt($code);
            if(!$code){
                return Response::error(null, 400, 'ID tidak ditemukan');
            }
            $product = Product::findOrFail($code);

            if($product){
                $product->delete();
                return Response::success(null);
            }else{
                return Response::error(null, 400, 'Data tidak ditemukan');
            }
        }
        catch(Exception $error){
            return Response::error();
        }
    }
}
