<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use Illuminate\Support\Facades\Storage;

class DashboardHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');

        return view('dashboard.home.index', [
            'homes' => Home::all(),
            'count' => Home::all()->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Home $home)
    {
        return view(
            'dashboard.home.edit',
            [
                'home' => $home
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Home $home)
    {
        $rules = [
            'banner' => 'image|file|max:1024',
            'banner2' => 'image|file|max:1024',
            'banner3' => 'image|file|max:1024'

        ];

        $validatedData = $request->validate($rules);


        if ($request->file('banner')) {
            if ($request->oldBanner) {
                Storage::delete($request->oldBanner);
            }
            $validatedData['banner'] = $request->file('banner')->store('post-image');
        }
        if ($request->file('banner2')) {
            if ($request->oldBannerTwo) {
                Storage::delete($request->oldBannerTwo);
            }
            $validatedData['banner2'] = $request->file('banner2')->store('post-image');
        }
        if ($request->file('banner3')) {
            if ($request->oldBannerThree) {
                Storage::delete($request->oldBannerThree);
            }
            $validatedData['banner3'] = $request->file('banner3')->store('post-image');
        }
        Home::where('id', $home->id)
            ->update($validatedData);

        return redirect('/dashboard/home')->with('success', 'Banner has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
