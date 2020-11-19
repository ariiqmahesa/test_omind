<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Models\Product;
use illuminate\Support\str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Product::all();


        return view('pages.products.index')->with([
            'items' => $items
        ]);
    }
    public function create()
    {
        return view('pages.products.create');
    }
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Product::create($data);
        return redirect()->route('products.index');
    }
    public function edit($id)
    {
        $item = Product::findOrfail($id);

        return view('pages.products.edit')->with([
            'item' => $item
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function update(ProductRequest $request, $id)
    {
        $data =  $request->all();
        $data['slug'] = Str::slug($request->name);


        $items = Product::findorfail($id);
        $items->update($data);

        return redirect()->route('products.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findorfail($id);
        $item->delete();

        return redirect()->route('products.index');
    }
    public function gallery(Request $request, $id)
    {
        $product = Product::findorfail($id);
        $items = ProductGallery::with('product')
            ->where('products_id', $id)
            ->get();

        return view('pages.products.gallery')->with(
            [
                'product' => $product,
                'items' => $items
            ]
        );
    }
}
