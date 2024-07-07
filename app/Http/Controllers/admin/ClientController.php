<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(request()->ajax());
        if ($request->ajax()) {
            $data = User::where('role', 'user')->get();
            // dd($data );
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $action = '';

                    $action .= '<a href="' . route('admin.client.edit', [$row->id]) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Edit</a>';
                    $action .= '&nbsp
                            <button data-href="' . route('admin.client.destroy', [$row->id]) . '" class="btn btn-xs btn-danger delete_user_button"><i class="fa-solid fa-trash" ></i> Delete</button>';

                    return $action;
                })
                ->removeColumn('id')
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.client.index');
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
        return view('admin.client.edit');
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

        $user = User::where('role', 'user')->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found or not a user with role "user".'], 404);
        }
        $user->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }

}
