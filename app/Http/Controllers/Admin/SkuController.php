<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sku;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SkuRequest;
use App\Http\Controllers\Controller;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $skus = $product->skus()->paginate(10);

        return view('admin.skus.index', compact('skus', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.skus.create', compact('product'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Product  $product
     * @param  SkuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkuRequest $request, Product $product)
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $skus = Sku::create($params);
        $skus->propertyOptions()->sync($request->property_id);

        return redirect()->route('skus.index', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function show(Sku $sku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     *  @param  Product  $product
     *  @param  Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Sku $sku)
    {
        return view('admin.skus.edit', compact('product', 'sku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SkuRequest  $request
     * @param  Product  $product
     * @param  Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function update(SkuRequest $request, Product $product, Sku $sku)
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $sku->update($params);
        $sku->propertyOptions()->sync($request->property_id);

        return redirect()->route('skus.index', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @param  Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Sku $sku)
    {
        //dd(Str::plural('sku'), Str::singular('skus'));
        $sku->delete();

        return redirect()->route('skus.index', $product);
    }
}
