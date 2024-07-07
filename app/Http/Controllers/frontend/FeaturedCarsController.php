<?php

namespace App\Http\Controllers\frontend;

use App\Models\Car;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class FeaturedCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all cars with their images and brand
        $data = Car::with(['carImages', 'brand'])->get();

        $cars_data = [];

        foreach ($data as $car) {
            $first_image = $car->carImages->isNotEmpty() ? $car->carImages->first()->image_path : null;

            $cars_data[] = [
                'id' => $car->id,
                'brand_name' => $car->brand->name,
                'title' => $car->title, // Assuming 'title' is a property in your Car model
                'description' => $car->description, // Assuming 'description' is a property in your Car model
                'price' => $car->price, // Assuming 'price' is a property in your Car model
                'model' => $car->model, // Assuming 'price' is a property in your Car model
                'mileage' => $car->mileage, // Assuming 'price' is a property in your Car model
                'transmission' => $car->transmission, // Assuming 'price' is a property in your Car model
                'first_image' => $first_image,
            ];
        }
        // dd($cars_data);
        // Pass data to the view
        return view('frontend.featured_cars', compact('cars_data'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
