<!DOCTYPE html>
<html>

<head>
    <title>Appointment Confirmation</title>
</head>

<body>
    <h1>Appointment Confirmation</h1>
    <p>Dear {{ $appointment->name }},</p>
    <p>Thank you for booking an appointment with us. Please confirm your appointment by clicking the button below:</p>
    <a href="{{ route('appointments.confirm', ['token' => $appointment->confirmation_token]) }}"
        style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Confirm
        Appointment</a>
    <p>Appointment Details:</p>
    <ul>
        <li>Date: {{ $appointment->booking_date }}</li>
        <li>Time: {{ $appointment->booking_time }}</li>
        <li>Vehical details: {{ $car->brand->name }} {{ $car->model }}</li>
    </ul>
</body>

</html>
