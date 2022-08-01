@extends('layouts.admin_main')

@push('title')
    <title>Medicine Inventory</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Inventory</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <li class="breadcrumb-item">Medicine</li>
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
                                <th scope="col">Medicine Name</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date added</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                            <tr>
                                <td>Paracetamol</td>
                                <td>Capsule</td>
                                <td>15</td>
                                <td>
                                    <span class="badge bg-success rounded-pill">Available</span>
                                </td>
                                <td>2022-07-31</td>
                                <td>
                                    <a class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-danger btn-sm"><i class="bi bi-eraser"></i></a>
                                    
                                    <!-- <a class="btn btn-success btn-sm"><i class="bi bi-chat"></i></a> -->
                                    
                                    
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