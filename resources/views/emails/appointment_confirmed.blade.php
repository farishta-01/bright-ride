<!DOCTYPE html>
<html>

<head>
    <title>Appointment Confirmation</title>
</head>

<body>
    <p>Dear {{ $appointment->name }},</p>

    <p>Your appointment has been confirmed!</p>

    <p>Details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $appointment->name }}</li>
        <li><strong>Email:</strong> {{ $appointment->email }}</li>
        <li><strong>Date:</strong> {{ $appointment->booking_date }}</li>
        <li><strong>Time:</strong> {{ $appointment->booking_time }}</li>
        <li><strong>Vehical Details:</strong> {{ $car->brand->name }} {{ $car->model }} ({{ $car->year }})</li>
        <li><strong>Booking Number:</strong> {{ $bookingNumber }}</li>
        <!-- Display the booking number -->
    </ul>


    <p>Thank you for booking with us!</p>
</body>

</html>
