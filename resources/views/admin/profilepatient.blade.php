@extends('layouts.admin_main')

@push('title')
    <title>Patient</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Accounts</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <li class="breadcrumb-item">Infirmary Personnel</li>
                    <li class="breadcrumb-item active">Patient</li>
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
                                <th scope="col" class="d-none">ID</th>
                                <th scope="col">SRCode</th>
                                <th scope="col">GradeLevel</th>
                                <th scope="col">Department</th>
                                <th scope="col">Program</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                        @foreach($patients as $patient)
                            <tr>
                                <td class="d-none">{{ $patient->id }}</td>
                                <td>{{ $patient->sr_code }}</td>
                                <td>{{ $patient->grade_level }}</td>
                                <td>{{ $patient->department }}</td>
                                <td>{{ $patient->program }}</td>
                                <td>{{ ucwords($patient->first_name)." ".(($patient->middle_name)? ucwords($patient->middle_name)[0].'. ' : '' )." ".ucwords($patient->last_name)." ".ucwords($patient->suffix_name) }}</td>
                                <td>{{ $patient->contact }}</td>
                            </tr>
                        @endforeach 
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