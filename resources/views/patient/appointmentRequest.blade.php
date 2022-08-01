@extends('layouts.patient_main')

@push('title')
    <title>Patient Appointment</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Appointment</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <li class="breadcrumb-item"><a href="{{ url('patient/appointment/') }}">New</a></li>
                    <li class="breadcrumb-item active"> Your Request</li>
                </ol>
            </nav>
        </div>
        
        <div class="section" >
            <div class="card" id="cardTable">
                <div class="card-body px-4 py-5">
                    <!-- <h5 class="card-title">Documents to be submitted</h5> -->
                    <table id="datatable" class="table table-striped col-lg-12" style="width: 100%;">
                        <thead> 
                            <tr>
                                <th scope="col">Purpose</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                            <tr>
                                <td>Checkup</td>
                                <td>July 31, 2022</td>
                                <td>09:30 am</td>
                                <td>
                                    <span class="badge bg-secondary rounded-pill" style="width: 100px;">Done</span>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i> Cancel</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Medical Certification</td>
                                <td>August 01, 2022</td>
                                <td>08:00 am</td>
                                <td>
                                    <span class="badge bg-success rounded-pill" style="width: 100px;">Approved</span>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i> Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
  
@push('script')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script>
        $(document).ready(function(){
          
        });
    </script>
@endpush