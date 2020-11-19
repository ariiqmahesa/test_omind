<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $slug = $request->input('slug');
        $type = $request->input('type');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');


        if ($id) {
            $product = Product::with('galleries')->find($id);

            foreach ($product->galleries as $g) {
                $g->photos = url('storage/' . $g->photos);
            }

            if ($product)
                return ResponseFormatter::success($product, 'Data Produk Berhasil Diambil');
            else
                return ResponseFormatter::error(null, 'Data Produk Tidak Ada', 404);
        }

        if ($slug) {
            $product = Product::with('galleries')->where('slug', $slug)
                ->first();

            if ($product)
                return ResponseFormatter::success($product, 'Data Produk Berhasil Diambil');
            else
                return ResponseFormatter::error(null, 'Data Produk Tidak Ada', 404);
        }

        $product = Product::with('galleries');

        if ($name)
            $product->where('name', 'like', '%' . $name . '%');
        if ($type)
            $product->where('type', 'like', '%' . $type . '%');
        if ($price_from)
            $product->where('price', '>=', $price_from);
        if ($price_to)
            $product->where('price', '<=', $price_to);

        $product = $product->paginate($limit);

        foreach ($product as $p) {
            foreach ($p->galleries as $g) {
                $g->photos = url('storage/' . $g->photos);
            }
        }

        return ResponseFormatter::success(
            $product,
            'Data List Produk Berhasil di Ambil'
        );
    }
}
