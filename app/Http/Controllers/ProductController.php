<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("ihednfv");
        $products = product::count();
        return view('products.index', compact('products'));
    }
    public function datatable(Request $request)
    {
        $products = DB::table('products')->select('id','name', 'description', 'price', 'sku', 'qty', 'type', 'vendor', 'image', 'tags')->where('deleted_at',null);
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                if ($row->image) {
                    return '<img src="' . asset('storage/' . $row->image) . '"
                            class="product-thumb">';
                }
                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('action', function ($row) {
                return '
        <a href="' . route('product.edit', $row->id) . '" class="btn btn-sm btn-primary mr-1">
            Edit
        </a>
        <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">
            Delete
        </button>
    ';
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'description'   => 'required|string|min:10',
            'price'  => 'required|numeric|min:1',
            'qty'    => 'required|integer|min:1',
            'sku'    => 'nullable|string|max:100|unique:products,sku',
            'type'   => 'required|string|max:100',
            'vendor' => 'required|string|max:150',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        // dd($data);
        // Product::create($data);
        $t= Product::create($data);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'description'   => 'required|string|min:10',
            'price'  => 'required|numeric|min:1',
            'qty'    => 'required|integer|min:1',
            'sku'    => 'nullable|string|max:100|unique:products,sku,' . $id,
            'type'   => 'required|string|max:100',
            'vendor' => 'required|string|max:150',
            'image'    => 'nullable|image|max:2048',
        ]);

        $img = $product->product_image;

        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->qty,
            'sku' => $request->sku,
            'type' => $request->type,
            'vendor' => $request->vendor,
            'image' => $img,
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $p = Product::where('id', $id)->delete();
        // dd($p);
        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
