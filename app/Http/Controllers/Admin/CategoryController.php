<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;
use Validator;
use Session;
use File;
use Str;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','store']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index() {
        try {
            $data = [];

            $data['page_title'] = 'Category List';

            $data['btnadd'][] = array(
                'link' => route('admin.category.create'),
                'title' => 'Add Category',
            );

            // $data['categories'] = Category::get();

            $data['breadcrumb'][] = array(
                'link' => route('admin.dashboard'),
                'title' => 'Dashboard'
            );

            $data['breadcrumb'][] = array(
                'title' => 'Category List'
            );

            return view('admin.category.index', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function datatable(Request $request) {
        $category = Category::query();

        return DataTables::eloquent($category)
            ->editColumn('image', function($category) {
                $image = '';

                if (isset($category->image) && $category->image != '' && File::exists(public_path('uploads/categories/'.$category->image))) {
                    $image .= '<img src="'.asset("uploads/categories/".$category->image).'" style="width:60px;" alt="Category Image">';
                }

                return $image;
            })
            ->addColumn('action', function($category) {
                $action = '<a href="'.route('admin.category.edit', $category->id).'" class="btn btn-outline-secondary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;<a class="btn btn-outline-secondary btn-sm btnDelete" data-url="'.route('admin.category.destroy').'" data-id="'.$category->id.'" title="Delete"><i class="fas fa-trash-alt"></i></a>';
                return $action;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    public function create() {
        try {
            $data['page_title'] = 'Add Category';

            $data['breadcrumb'][] = array(
                'link' => route('admin.dashboard'),
                'title' => 'Dashboard'
            );

            $data['breadcrumb'][] = array(
                'link' => route('admin.category.index'),
                'title' => 'Category List'
            );

            $data['breadcrumb'][] = array(
                'title' => 'Add Category'
            );

            return view('admin.category.add', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function store(Request $request) {
        try {
            $rules = [
                'title' => 'required|string|max:255',
            ];
    
            if ($request->actionType === 'add') {
                $rules['image'] = 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048';
            }

            $this->validate($request, $rules);
            
            if ($request->has('category_id')) {
                $category   = Category::where('id', $request->category_id)->first();
                $action     = 'updated';
            } else {
                $category   = new Category();
                $action     = 'added';
            }

            $category->title = $request->title;
            $category->description = $request->description;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imgFolderPath = public_path('uploads/categories/');

                if (!File::isDirectory($imgFolderPath)) {
                    File::makeDirectory($imgFolderPath, 0777, true, true);
                }

                $fileName = uniqid().'.'.$file->getClientOriginalExtension();
                // Image::make($file)->save(public_path('uploads/categories/'.$fileName));
                $file->move($imgFolderPath, $fileName);


                $category->image = $fileName;

            }
            $category->save();

            Session::flash('alert-message', 'Category '.$action.' successfully.');
            Session::flash('alert-class', 'success');
            return redirect()->route('admin.category.index');
            
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function edit($id) {
        try {
            $data['page_title'] = 'Edit Category';

            $data['breadcrumb'][] = array(
                'link' => route('admin.dashboard'),
                'title' => 'Dashboard'
            );

            $data['breadcrumb'][] = array(
                'link' => route('admin.category.index'),
                'title' => 'Category List'
            );

            $data['breadcrumb'][] = array(
                'title' => 'Edit Category'
            );

            $category = Category::find($id);

            if ($category) {
                $data['category'] = $category;

                return view('admin.category.add', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function destroy(Request $request) {
        try {
            if($request->ajax()) {
                $category = Category::where('id', $request->id)->first();

                if ($category->delete()) {
                    $return['success']  = true;
                    $return['message']  = "Category deleted successfully.";
                } else {
                    $return['success']  = false;
                    $return['message']  = "Category not deleted.";
                }

                return response()->json($return);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
