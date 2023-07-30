<?php

namespace App\Http\Controllers;

use App\Exports\ClothesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Clothes;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardClothesController extends Controller
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
        $this->authorize('admin');

        return view('dashboard.clothes.index', [
            'clothes' => Clothes::where('user_id', Auth()->user()->id)->get()
        ]);
    }


    public function export_excel()
    {
        return Excel::download(new ClothesExport, 'clothes.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clothes.create', [
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
        $validatedData = $request->validate([
            'product' => 'required|max:255',
            'slug' => 'required|unique:clothes',
            'category_id' => 'required',
            's' => 'required',
            'l' => 'required',
            'm' => 'required',
            'xl' => 'required',
            'xxl' => 'required',
            'description' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'image' => 'required|image|file|max:1024',
            'image2' => 'required|image|file|max:1024',
            'image3' => 'required|image|file|max:1024',
        ]);


        $validatedData['image'] = $request->file('image')->store('post-image');
        $validatedData['image2'] = $request->file('image2')->store('post-image');
        $validatedData['image3'] = $request->file('image3')->store('post-image');

        $validatedData['user_id'] = auth()->user()->id;
        Clothes::create($validatedData);

        return redirect('/dashboard/clothes')->with('success', 'New Product has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clothes  $clothes
     * @return \Illuminate\Http\Response
     */
    public function show(Clothes $clothes)
    {
        return view('dashboard.clothes.show', [
            'clothes' => $clothes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clothes  $clothes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clothes $clothes)
    {
        return view(
            'dashboard.clothes.edit',
            [
                'clothes' => $clothes,
                'categories' => Category::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clothes  $clothes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clothes $clothes)
    {
        $rules = [
            'product' => 'required|max:255',
            'category_id' => 'required',
            's' => 'required',
            'l' => 'required',
            'm' => 'required',
            'xl' => 'required',
            'xxl' => 'required',
            'description' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'image' => 'image|file|max:1024',
            'image2' => 'image|file|max:1024',
            'image3' => 'image|file|max:1024'

        ];




        if ($request->slug != $clothes->slug) {
            $rules['slug'] = 'required|unique:clothes';
        }

        $validatedData = $request->validate($rules);


        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-image');
        }
        if ($request->file('image2')) {
            if ($request->oldImageTwo) {
                Storage::delete($request->oldImageTwo);
            }
            $validatedData['image2'] = $request->file('image2')->store('post-image');
        }
        if ($request->file('image3')) {
            if ($request->oldImageThree) {
                Storage::delete($request->oldImageThree);
            }
            $validatedData['image3'] = $request->file('image3')->store('post-image');
        }



        $validatedData['user_id'] = auth()->user()->id;
        Clothes::where('id', $clothes->id)
            ->update($validatedData);

        return redirect('/dashboard/clothes')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clothes  $clothes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clothes $clothes)
    {

        if ($clothes->image) {
            Storage::delete($clothes->image);
        }
        if ($clothes->image2) {
            Storage::delete($clothes->image2);
        }
        if ($clothes->image3) {
            Storage::delete($clothes->image3);
        }


        Clothes::destroy($clothes->id);

        return redirect('/dashboard/clothes')->with('success', 'Clothes has been deleted!');
    }



    public function checkSlug(Request $request)
    {
        $slug =  SlugService::createSlug(Clothes::class, 'slug', $request->product);

        return response()->json(['slug' => $slug]);
    }
}
