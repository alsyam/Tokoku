<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clothes;
use App\Models\User;
use App\Models\Category;

class ClothesController extends Controller
{
    public function index()
    {

        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }

        return view('clothes', [
            "title" => "All clothes" . $title,
            "active" => "clothes",
            "clothes" => Clothes::latest()->filter(request(['search', 'category', 'author']))->paginate(12)->withQueryString()
        ]);
    }

    public function show(Clothes $clothes)
    {
        return view("detailClothes", [
            "title" => "Detail Clothes",
            "active" => "clothes",
            "clothes" => $clothes
        ]);
    }
}
