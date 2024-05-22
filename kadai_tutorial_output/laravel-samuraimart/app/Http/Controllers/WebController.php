<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MajorCategory;

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $major_categories = MajorCategory::all();

        return view('web.index', compact('major_categories', 'categories'));
    }
}
