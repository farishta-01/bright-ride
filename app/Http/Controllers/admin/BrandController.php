<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::all();
            // dd($data);

            return DataTables::of($data)
            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '" style="width: 50px; height: 50px; margin-right: 5px;" />';
            })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.cars.edit', $row->id);
                    // $deleteUrl = route('admin.cars.destroy', $row->id);

                    $action = '<button data-href="' . $editUrl . '" id="carmodal_edit" class="btn btn-primary btn-modal" data-container_modal=".view_modal">
                                <i class="fa fa-eye" aria-hidden="true"></i> Edit
                            </button>';

                    $action .= '&nbsp;
                                <button data-href="' . route('admin.brands.destroy', $row->id) . '" class="btn btn-xs btn-danger delete_brand_button"><i class="fa-solid fa-trash" ></i> Delete</button>';

                    return $action;
                })
                ->removeColumn('id')
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd(123);
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug the request data
        // dd($request->all());

        if ($request->ajax()) {
            try {
                // Validate the request
                // dd($request->validate);
                $validatedData = $request->validate([
                    'title' => 'required|string|max:255',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
// dd($validatedData);
                // Debug the file presence
                // dd($request->hasFile('image'));

                // Handle the file upload
                if ($request->hasFile('image')) {
                    // Store the file in the public storage (you can use other storage drivers as needed)
                    $path = $request->file('image')->store('public/brand_images');
                    $imagePath = Storage::url($path); // Get the URL to store in the database
                } else {
                    throw new \Exception('Image file is missing');
                }
// dd($imagePath);
                // Create a new Brand instance
                $brand = new Brand();
                $brand->name = $request->input('title');
                $brand->image = $imagePath; // Assuming the 'image' field exists in the 'brands' table

                // Save the brand to the database
                $brand->save();

                // Return a JSON response for successful creation
                return response()->json(['success' => 'Brand added successfully.']);
            } catch (\Exception $e) {
                // Log the error for debugging purposes
                Log::error('Failed to create brand: ' . $e->getMessage());

                // Return a JSON response for the error
                return response()->json(['error' => 'Brand addition Failed.']);
            }
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
        $data = Brand::findorfail($id);

        if (!$data) {
            return response()->json(['error' => 'Brand not found ".'], 404);
        }
        $data->delete();
        return response()->json(['success' => 'Brand Record deleted successfully.']);
    }

}
