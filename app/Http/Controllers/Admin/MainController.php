<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        try {
            $data = [];
            $data['page_title']    = 'Dashboard';

            $data['breadcrumb'][]      = array(
                'title'         => 'Dashboard'
            );

            return view('admin.dashboard', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
