@extends('frontend.layout.app')
@section('title', 'Appointment')
@section('css')
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-top: 2px;
            box-sizing: border-box;
        }

        .slider-container {
            margin-top: 15px;
        }

        .slider-label {
            margin-top: 10px;
            display: block;
        }

        .error-message {
            color: red;
            font-size: 12px;
            display: none;
        }

        .ui-datepicker-trigger {
            cursor: pointer;
        }

        .input-group {
            position: relative;
        }

        .input-group-addon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="form-container" style="margin-top: 8%">
        <h2>Book an Appointment</h2>
        <form id="appointmentForm" action="{{ route('appointment.store') }}" method="POST">
            @csrf <!-- Add CSRF token field for Laravel -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="date">Select Date</label>
                <div class="input-group">
                    <input type="text" id="date" name="booking_date" required>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
                <div id="date-error" class="error-message"></div>
            </div>
            <div class="form-group slider-container">
                <label for="time">Select Time</label>
                <div id="time-slider"></div>
                <input type="hidden" id="booking_time" name="booking_time" value="8:00 AM" required>
                <span class="slider-label" id="selected-time">8:00 AM</span>
            </div>
            <input type="hidden" name="car_id" value="{{ $car_id }}">

            <button type="submit" class="btn btn-success">Book Appointment</button>
        </form>
    </div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        $(function() {
            var selectedDate;
            var selectedTime;

            function validateDateTime() {
                var now = new Date();
                var error = false;

                if (!selectedDate || selectedDate.getDay() === 0 || selectedDate.getDay() === 6) {
                    $("#date-error").text("Appointments cannot be booked on Saturdays or Sundays.").show();
                    error = true;
                } else if (selectedDate.toDateString() === now.toDateString() && selectedTime <= now) {
                    $("#date-error").text("Selected time must be later than the current time.").show();
                    error = true;
                } else {
                    $("#date-error").hide();
                }

                $("#appointmentForm button[type='submit']").prop('disabled', error);
            }

            // Date Picker
            $("#date").datepicker({
                minDate: 0,
                maxDate: "+7D",
                dateFormat: "yy-mm-dd",
                beforeShowDay: function(date) {
                    // Disable Saturdays (6) and Sundays (0)
                    var day = date.getDay();
                    return [(day !== 0 && day !== 6), ""];
                },
                onSelect: function(dateText) {
                    selectedDate = new Date(dateText);
                    validateDateTime();
                }
            });

            // Time Slider
            $("#time-slider").slider({
                min: 8,
                max: 19,
                step: 0.5,
                value: 8,
                slide: function(event, ui) {
                    let hours = Math.floor(ui.value);
                    let minutes = (ui.value - hours) * 60;
                    selectedTime = new Date();
                    selectedTime.setHours(hours);
                    selectedTime.setMinutes(minutes);

                    let displayHours = hours > 12 ? hours - 12 : hours;
                    let timePeriod = hours >= 12 ? 'PM' : 'AM';
                    let timeString = displayHours + ':' + (minutes === 0 ? '00' : '30') + ' ' +
                        timePeriod;

                    $("#selected-time").text(timeString);
                    $("#booking_time").val(timeString); // Update hidden input with timeString

                    validateDateTime();
                }
            });

            // Initial validation
            validateDateTime();
        });
    </script>
    <script>
        // Set up the CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#appointmentForm').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            var formData = $(this).serialize(); // Serialize form data
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    toastr.success(response.message);
                    // Optionally clear the form or redirect the user
                    $('#appointmentForm')[0].reset(); // Clear the form fields
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.message || 'Form submission failed';
                    toastr.error(errorMessage);
                }
            });
        });
    </script>
@endsection
