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
                                <th scope="col">StudentID</th>
                                <th scope="col">Name</th>
                                <th scope="col">DepartmentProgram</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                            <tr>
                                <td>19-78604</td>
                                <td>Joseph E. Calma</td>
                                <td>CICS-BSIT</td>
                                <td>
                                    <span class="badge bg-success rounded-pill"">Verified</span>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                    <a class="btn btn-danger btn-sm"><i class="bi bi-eraser"></i></a>
                                    <a class="btn btn-secondary btn-sm" href="{{ url('admin/patient/records') }}"><i class="bi bi-folder"></i></a>
                                    <!-- <a class="btn btn-success btn-sm"><i class="bi bi-chat"></i></a> -->
                                    
                                    
                                    <!-- <a class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i> Remove</a> -->
                                </td>
                            </tr>
                            <tr>
                                <td>19-31250</td>
                                <td>Aeron P. Nepomuceno</td>
                                <td>CICS-COE</td>
                                <td>
                                    <span class="badge bg-primary rounded-pill" style="width: 100px;">Not Verified</span>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                    <a class="btn btn-danger btn-sm"><i class="bi bi-eraser"></i></a>
                                    <a class="btn btn-secondary btn-sm" href="{{ url('admin/patient/records') }}"><i class="bi bi-folder"></i></a>
                                    <!-- <a class="btn btn-danger btn-sm"><i class="bi bi-x-lg"></i> Remove</a> -->
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