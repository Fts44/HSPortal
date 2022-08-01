@extends('layouts.patient_main')

@push('title')
    <title>Patient Documents</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Medical Documents</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <li class="breadcrumb-item active">Uploads</li>
                    <li class="breadcrumb-item">Prescription</li>
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
                                <th scope="col">Document Name</th>
                                <th scope="col">Your uploads</th>
                                <th scope="col">Verified Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                            <tr>
                                <td>Vaccination Card</td>
                                <td>VaccinationCard_19-78604.jpg</td>
                                <td >
                                    <span class="badge bg-success rounded-pill" style="width: 100px;">Verified</span>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" style="width: 85px;"><i class="bi bi-eye"></i> View</a>
                                    <a class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i> Remove</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Insurance</td>
                                <td>
                                    <input type="file" name="" id="" accept=".jpg,.pdf">
                                </td>
                                <td>
                                    <span class="badge bg-secondary rounded-pill" style="width: 100px;">Not Verified</span>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"><i class="bi bi-upload"></i> Upload</a>
                                    <a class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i> Remove</a>
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