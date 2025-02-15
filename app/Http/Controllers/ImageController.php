<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Category;
use App\Models\Images;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $images = Images::all();v

        $images = Images::with('category')->get();


        return view('image.index', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
        $categories = Category::all();

        // Pass the categories to the view
        return view('image.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request)
    {
        $imageName = time() . '.' . $request->image->extension();
        $uploadedImage = $request->image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;
        // $request->image->storeAs('images', $imageName, 'local');

        $params = $request->validated();

        if ($product = Images::create($params)) {
            $product->image = $imagePath;
            $product->save();

            return redirect(route('image.index'))->with('success', 'Added!');
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
