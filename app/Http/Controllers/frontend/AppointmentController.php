<?php

namespace App\Http\Controllers\frontend;

use App\Models\Appointment;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;
use App\Mail\AppointmentConfirmed;
use App\Mail\AppointmentNotification;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.appointment');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)

    {
        // dd($id);
        $car_id = $id;
        return view('frontend.appointment', compact('car_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bookingTime = $request->input('booking_time');
        try {
            $dateTime = new \DateTime($bookingTime);
            $convertedTime = $dateTime->format('H:i');
        } catch (\Exception $e) {
            // Handle invalid time format
            return response()->json(['message' => 'Invalid time format'], 422);
        }
        if ($request->ajax()) {
            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'booking_date' => 'required|date|after_or_equal:today',
                'booking_time' => 'required',
                'car_id' => 'required|exists:cars,id',
            ]);
            $bookingNumber = strtoupper(uniqid('BOOKING_', true));
            // Create a new appointment record
            $appointment = Appointment::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'booking_date' => $validated['booking_date'],
                'booking_time' => $convertedTime,
                'status' => 'pending', // Default status
                'user_id' => Auth::id(), // Assuming the user is logged in
                'car_id' => $validated['car_id'],
                'booking_number' => $bookingNumber, // Store the booking number
            ]);

            Mail::to($validated['email'])->send(new AppointmentConfirmation($appointment));

            // Send email to admin
            Mail::to('admin@example.com')->send(new AppointmentNotification($appointment));

            return response()->json([
                'message' => 'Appointment booked successfully! Please confirm your booking through your email inbox.',
                'appointment' => $appointment
            ]);
        }


        return response()->json(['message' => 'Invalid request'], 400);
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
    public function confirm($token)
    {
        // Find the appointment using the confirmation token
        $appointment = Appointment::where('confirmation_token', $token)->firstOrFail();

        // Update the status of the appointment
        $appointment->status = 'confirmed';
        $appointment->save();
        Mail::to($appointment->email)->send(new AppointmentConfirmed($appointment));
        Mail::to('admin@example.com')->send(new AppointmentConfirmed($appointment)); // Replace with admin email

        // Redirect to the featured cars route with a success message
        return redirect()->route('frontend.featured_cars')->with('message', 'Your booking has been confirmed!');
    }
}
