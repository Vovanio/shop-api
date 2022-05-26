<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Products::all();

        return response()->json([
            'items' => [
                'products' => $products
            ]
        ],200);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:64',
            'description' => 'string|max:255',
            'price' => 'required|integer',
            'img' => 'required|image',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ]
            ], 422);
        }

        $path = $request->file('img')
            ->store('media/images/uploads', 'public');

        $fullpathtoimg = 'storage/' . $path;

        $products = new Products();
        $products->title = $request->title;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->img_src = $fullpathtoimg;
        $products->save();

        return response()->json([], 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $stores
     * @return \Illuminate\Http\Response
     */
    public function show(Products $stores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $stores
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $stores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'title' => 'required|string|max:64',
            'description' => 'required|string|max:255',
            'price' => 'required|integer',
            'img' => 'required|image',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ]
            ], 422);
        }

        $path = $request->file('img')
            ->store('media/images/uploads', 'public');

        $fullpathtoimg = 'storage/'. $path;

        $products = Products::find($request->id);
        $products->title = $request->title;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->img_src = $fullpathtoimg;

        return response()->json([], 204);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ]
            ], 422);
        }

        Products::find($request->id)
            ->delete();

    }
}
