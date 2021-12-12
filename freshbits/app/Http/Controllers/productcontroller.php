<?php

namespace App\Http\Controllers;

use App\Models\product;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = product::all();
        return view('product.productlist', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.productadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'upc' => 'required|unique:products|min:13',
            'status' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
        ]);

        $lastid = product::orderBy('id', 'desc')->first()->id;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = ++$lastid . '_' . $request->name . '_product.' . $extension;
            $file->storeAs('public/uploads/products/' . $lastid . '/', $filename);
            $validator['image'] = $filename;
        }

        $result = product::create($validator);

        return redirect('product');
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
        $data = product::find($id);
        return view('product.productedit', ['data' => $data]);
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
        //
        $validator = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'upc' => [
                'required',
                Rule::unique('products')->ignore($id),
                'min:13'
            ],
            'status' => 'required',
        ]);

        $product = product::find($id);

        if ($request->hasfile('image')) {
            $destination = "public/uploads/products/" . $id . "/" . $product->image;
            if (Storage::exists($destination)) {
                Storage::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $id . '_' . $request->name . '_product.' . $extension;
            $file->storeAs('public/uploads/products/' . $id . '/', $filename);
            $validator['image'] = $filename;
        }

        $product->update($validator);

        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $product = product::find($request->delete_product_id);
        Storage::deleteDirectory("public/uploads/products/" . $product->id);
        $product->delete();

        return redirect('product');

    }

    public function deleteAll(Request $request)
    {

        $ids = $request->ids;

        $id_array = explode(",",$ids);

        $product = product::whereIn('id',$id_array)->get();

        foreach ($product as $value) {
            Storage::delete("public/uploads/products/".$value->id."/".$value->image);

        }

        product::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }
}
