@extends('layouts.patient_main')

@push('title')
    <title>Patient Appointments</title>
@endpush

@push('css')
    <link rel="stylesheet" href="{{asset('css/calendar.css')}}">
    <script src="{{asset('js/calendar.js')}}"></script>
@endpush

@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Appointment</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <li class="breadcrumb-item active">New</li>
                    <li class="breadcrumb-item"><a href="{{ url('patient/appointment/request') }}"> Your Request</a></li>
                </ol>
            </nav>
        </div>
        
        <div class="section" >
            <div class="card" id="cardTable">
                <div class="card-body">
                    <div class="card-title"></div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div id="calendar" class="col-lg-12">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-form-label col-lg-12 text-center">
                                    <h4>Appointment Details</h4>
                                </div>
                                <div class="row p-0">
                                    <label for="" class="col-lg-4 col-form-label">Purpose</label>
                                    <div class="col-lg-8 p-0">
                                        <select name="" id="" class="form-select" style="width: 100%;">
                                            <option value="">Choose</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row p-0 mt-4">
                                    <label for="" class="col-lg-4 col-form-label">Date</label>
                                    <div class="col-lg-8 p-0">
                                        <input type="date" class="form-control" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="row p-0 mt-4">
                                    <label for="" class="col-lg-4 col-form-label">Time</label>
                                    <div class="col-lg-8 p-0">
                                        <input type="time" class="form-control" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="row p-0 mt-4">
                                    <label for="" class="col-lg-4 col-form-label">Message</label>
                                    <div class="col-lg-8 p-0">
                                        <textarea class="form-control" name="" id=""></textarea>
                                    </div>
                                </div>
                                <div class="row p-0 mt-4">
                                    <label for="" class="col-lg-4 col-form-label"></label>
                                    <div class="col-lg-8 p-0">
                                        <a href="" class="btn btn-primary">Submit Request</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

@endsection
  
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: '2022-06-31',
                editable: true,
                selectable: true,
                businessHours: true,
                dayMaxEvents: true
            });
            calendar.render();

        });
    </script>
    <script>
        $(document).ready(function(){
            
        });
    </script>
@endpush