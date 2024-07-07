<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Car::with(['carImages', 'brand'])->get();
            // dd($data);
            return DataTables::of($data)
                ->addColumn('brand_name', function ($row) {
                    // dd($row);
                    return $row->brand->name; // Assuming 'name' is the column in 'brands' table
                })
                ->addColumn('images', function ($row) {
                    $image = '';

                    if ($row->carImages->isNotEmpty()) {
                        $firstImage = $row->carImages->first(); // Get the first image

                        $image = '<img src="' . asset('storage/' . $firstImage->image_path) . '" style="width: 50px; height: 50px; margin-right: 5px;" />';
                    }

                    return $image;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.cars.edit', $row->id);
                    // $deleteUrl = route('admin.cars.destroy', $row->id);

                    $action = '<button data-href="' . $editUrl . '" id="carmodal_edit" class="btn btn-primary btn-modal" data-container_modal=".view_modal">
                                <i class="fa fa-eye" aria-hidden="true"></i> Edit
                            </button>';

                    $action .= '&nbsp;
                                <button data-href="' . route('admin.cars.destroy', $row->id) . '" class="btn btn-xs btn-danger delete_car_button"><i class="fa-solid fa-trash" ></i> Delete</button>';

                    return $action;
                })
                ->removeColumn('id')
                ->rawColumns(['images', 'action'])
                ->make(true);
        }

        return view('admin.featuredcars.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        //  dd($brands);
        return view('admin.featuredcars.create', compact(['brands']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all(), $request->file('images'));
        // dd($request->ajax());
        if ($request->ajax()) {
            // Validate the request inputs
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'model' => 'required',
                'transmission' => 'required',
                'description' => 'required|string',
                'brand_id' => 'required',
                'price' => 'required|numeric',
                'mileage' => 'required|numeric',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            // dd($validator);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            // dd($request->transmission);
            // Create car entry
            try {
                $car = Car::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'price' => $request->price,
                    'mileage' => $request->mileage,
                    'brand_id' => $request->brand_id,
                    'model' => $request->model,
                    'transmission' => $request->transmission,
                ]);
                // dd($car);
            } catch (\Exception $e) {
                throw $e;
                return response()->json(['error' => 'Error creating car: ' . $e->getMessage()], 500);
            }

            // Handle image uploads
            try {
                // dd($request->hasFile('images'));
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        Storage::disk('public')->putFileAs('', $image, $imageName);
                        // dd($imageName );
                        // Create car image entry
                        CarImage::create([
                            'car_id' => $car->id,
                            'image_path' => $imageName,
                        ]);
                    }
                }
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error uploading image: ' . $e->getMessage()], 500);
            }

            return response()->json(['success' => 'Car added successfully.']);
        }

        return redirect()->route('admin.cars')->with('success', 'Car added successfully.');
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
        $car = Car::with('carImages')->findorfail($id);
        // $brands = Brand::all();
        $brandsname = $car->brand_id;
        $brands = Brand::findOrFail($brandsname);
        // dd( $brands->name);
        return view('admin.featuredcars.edit', compact(['car', 'brands']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->ajax());
        if ($request->ajax()) {

            DB::beginTransaction();

            try {

                $validatedData = $request->validate([
                    'title' => 'required|string|max:255',
                    'model' => 'required',
                    'transmission' => 'required',
                    'description' => 'required|string',
                    'brand_id' => 'required',
                    'price' => 'required|numeric',
                    'mileage' => 'required|numeric',
                    'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);


                $car = Car::findOrFail($id);
                $car->title = $validatedData['title'];
                $car->description = $validatedData['description'];
                $car->price = $validatedData['price'];
                $car->brand_id = $validatedData['brand_id'];
                $car->mileage = $validatedData['mileage'];
                $car->model = $validatedData['model'];
                $car->transmission = $validatedData['transmission'];

                if ($request->has('existing_images')) {
                    $existingImages = $request->input('existing_images');
                    $car->carImages()->whereNotIn('image_path', $existingImages)->delete();
                } else {
                    $car->carImages()->delete();
                }
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        Storage::disk('public')->putFileAs('', $image, $imageName);
                        $carImage = new CarImage();
                        $carImage->car_id = $car->id;
                        $carImage->image_path = $imageName;
                        $carImage->save();
                    }
                }
                $car->save();
                DB::commit();
                return response()->json(['success' => 'Car updated successfully']);
            } catch (\Illuminate\Validation\ValidationException $e) {
                DB::rollBack();
                return response()->json(['errors' => $e->errors()], 422);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Error updating car: ' . $e->getMessage()], 500);
            }
        }
        return redirect()->route('admin.cars')->with('success', 'Car updated successfully');
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Car::with('carImages')->findorfail($id);

        if (!$data) {
            return response()->json(['error' => 'Car not found ".'], 404);
        }
        $data->delete();
        return response()->json(['success' => 'Car Record deleted successfully.']);
    }
}
