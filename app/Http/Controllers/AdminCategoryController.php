<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;



class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('verified');
    }


    public function index()
    {

        // $this->authorize('admin');
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'categories' => Category::all()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        $data['background'] = $request->file('background')->store('post-image');

        Category::create($data);

        return redirect('/dashboard/categories')->with('success', 'New Product has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'categories' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required',
            'background' => 'required|image|file|max:1024',


        ];

        $data = $request->validate($rules);


        if ($request->file('background')) {
            if ($request->oldBackground) {
                Storage::delete($request->oldBackground);
            }
            $data['background'] = $request->file('background')->store('post-image');
        }
        Category::where('slug', $category->slug)->update($data);

        return redirect('/dashboard/categories')->with('success', 'New Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);

        return redirect('/dashboard/categories')->with('success', 'Categories has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug =  SlugService::createSlug(Categories::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
}
