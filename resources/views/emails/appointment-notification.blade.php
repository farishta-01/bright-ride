<!DOCTYPE html>
<html>

<head>
    <title>New Appointment Notification</title>
</head>

<body>

    <h1>New Appointment Booking</h1>
    <p>A new appointment has been booked. Details are as follows:</p>
    <ul>
        <li>Name: {{ $appointment->name }}</li>
        <li>Email: {{ $appointment->email }}</li>
        <li>Date: {{ $appointment->booking_date }}</li>
        <li>Time: {{ $appointment->booking_time }}</li>
        <li>Vehical Details:{{ $car->brand->name }} {{ $car->model }} </li>
    </ul>
</body>

</html>
