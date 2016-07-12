<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAttribute\CreateProductAttributeRequest;
use App\ProductAttribute;

class AttributesController extends Controller
{
    /**
     * Show all attributes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = ProductAttribute::with('attribute_properties')->get();

        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show a form for creating a new attribute.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.create', [
          'product_attribute' => new ProductAttribute(),
        ]);
    }

    /**
     * Show a form for updating attribute terms.
     *
     * @param string $attribute_slug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAttribute $product_attribute)
    {
        return view('admin.attributes.edit', compact('product_attribute'));
    }

    public function store(CreateProductAttributeRequest $request)
    {
        $product_attribute = ProductAttribute::create($request->all());

        return redirect()->route('admin.attributes.edit', $product_attribute);
    }

    /**
     * Delete all instances of a given taxonomy from storage.
     *
     * @param string $taxonomy
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAttribute $product_attribute)
    {
        $name = $product_attribute->name;
        $product_attribute->delete();

        return redirect()->route('admin.attributes.index')->with([
            'alert'       => sprintf('Attribute "%s" deleted', $name),
            'alert-class' => 'success',
            ]);
    }
}
