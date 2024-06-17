<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Product;
use DataTables;
use Validator;
use Session;
use Image;
use File;
use Str;
use Auth;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','store']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index() {
        try {
            $data = [];

            $data['page_title'] = 'Product List';

            $data['btnadd'][] = array(
                'link' => route('admin.product.create'),
                'title' => 'Add Product',
            );

            $data['products'] = Product::get();

            $data['breadcrumb'][] = array(
                'link' => route('admin.dashboard'),
                'title' => 'Dashboard'
            );

            $data['breadcrumb'][] = array(
                'title' => 'Product List'
            );

            return view('admin.product.index', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function datatable(Request $request) {
        $product = Product::query();

        if (!Auth::user()->hasRole('Admin')) {
            $product->where('created_by', Auth::id());
        }
        
        return DataTables::eloquent($product)
            ->addColumn('action', function($product) {
                $action = '<a href="'.route('admin.product.edit', $product->id).'" class="btn btn-outline-secondary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;<a class="btn btn-outline-secondary btn-sm btnDelete" data-url="'.route('admin.product.destroy').'" data-id="'.$product->id.'" title="Delete"><i class="fas fa-trash-alt"></i></a>';
                return $action;
            })
            ->addColumn('category', function($product) {
                return ($product->category) ? $product->category->name : '';
            })
            ->editColumn('image', function($product) {
                $image = '';

                if (isset($product->image) && $product->image != '' && File::exists(public_path('uploads/products/'.$product->image))) {
                    $image .= '<img src="'.asset("uploads/products/".$product->image).'" style="width:60px;" alt="Product Image">';
                }

                return $image;
            })
            ->addColumn('categories', function ($product) {
                return $product->categories->pluck('title')->implode(', ');
            })
            ->rawColumns(['action', 'category', 'image'])
            ->make(true);
    }

    public function create() {
        try {
            $data = [];

            $data['page_title'] = 'Add Product';

            $data['breadcrumb'][] = array(
                'link' => route('admin.dashboard'),
                'title' => 'Dashboard'
            );

            $data['breadcrumb'][]   = array(
                'link' => route('admin.product.index'),
                'title' => 'Product List'
            );

            $data['breadcrumb'][]       = array(
                'title' => 'Add Product'
            );

            $data['categories'] = Category::get();

            return view('admin.product.add', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function store(Request $request) {
        try {
            $rules = [
                'category_id' => 'required',
                'title' => 'required',
                'price' => 'required',
                'quantity' => 'required',
            ];

            $this->validate($request, $rules);

            if ($request->has('product_id')) {
                $product    = Product::where('id', $request->product_id)->first();
                $action     = 'updated';
            } else {
                $product    = new Product();
                $action     = 'added';
            }

            $product->title          = $request->title;
            // $product->category_id   = $request->category_id;
            $product->price         = $request->price;
            $product->quantity         = $request->quantity;
            $product->description   = $request->description;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imgFolderPath = public_path('uploads/products/');

                if (!File::isDirectory($imgFolderPath)) {
                    File::makeDirectory($imgFolderPath, 0777, true, true);
                }

                $fileName = uniqid().'.'.$file->getClientOriginalExtension();
                $file->move($imgFolderPath, $fileName);

                $product->image = $fileName;                
            }
            $product->created_by = Auth::user()->id;
            $product->save();
            $product->categories()->sync($request->category_id);

            // if ($product->save()) {
            //     $response['status']     = true;
            //     $response['icon']       = 'success';
            //     $response['message']    = "Product $action Successfully.";
            // } else {
            //     $response['status']     = false;
            //     $response['message']    = "Product not saved.";
            //     $response['icon']       = "error";
            // }

            Session::flash('alert-message', 'Product '.$action.' successfully.');
            Session::flash('alert-class', 'success');
            return redirect()->route('admin.product.index');

        } catch (\Exception $e) {
            Session::flash('heading', "Error.");
            Session::flash('message', $e->getMessage());
            Session::flash('icon', 'error');

            if ($request->has('product_id')) {
                return redirect()->route('admin.product.edit', $request->product_id);
            } else {
                return redirect()->route('admin.product.create');
            }
        }
    }

    public function edit($id) {
        try {
            $data['page_title'] = 'Edit Product';

            $data['breadcrumb'][] = array(
                'link' => route('admin.dashboard'),
                'title' => 'Dashboard'
            );

            $data['breadcrumb'][] = array(
                'link' => route('admin.product.index'),
                'title' => 'Product List'
            );

            $data['breadcrumb'][] = array(
                'title' => 'Edit Product'
            );

            $product = Product::find($id);
            $data['categories'] = Category::get();

            if ($product) {
                $data['product'] = $product;

                return view('admin.product.add', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function destroy(Request $request) {
        try {
            if ($request->ajax()) {
                $product = Product::where('id', $request->id)->first();

                if ($product->delete()) {
                    $return['success'] = true;
                    $return['message'] = "Product deleted successfully.";
                } else {
                    $return['success'] = false;
                    $return['message'] = "Product not deleted.";
                }

                return response()->json($return);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
