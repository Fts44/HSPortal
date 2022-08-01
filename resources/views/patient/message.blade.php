@extends('layouts.patient_main')

@push('title')
    <title>Patient Messages</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Messages</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <!-- <li class="breadcrumb-item">All</li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Product Info</li> -->
                </ol>
            </nav>
        </div>
        
        <div class="section">
            <div class="card ">
                <div class="card-body">
                    <div class="card-title"></div>
                    <div class="row p-0" style="height: 68vh;">
                        <div class="col-lg-4 p-2">
                            <div class="row mx-1">
                                <input type="text" class="form-control" placeholder="Search" style="width: 100%;">
                            </div>
                            <div class="row mx-1 mt-2" style=" border: solid 1px rgb(217, 226, 239); border-radius: 10px; cursor: pointer;">
                                <div class="col-lg-4 py-2">
                                    <img src="{{ asset('images/logo.png') }}" alt="" style="width: 70px;">
                                </div>
                                <div class="col-lg-8">
                                    <div class="row ms-1 d-flex align-content-sm-center" style="height: 50%;">
                                        Joseph Calma
                                    </div>
                                    <div class="row ms-1">
                                        You: Test
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 border">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
  
@push('script')
    <!-- <script src="{{ asset('js/datatable.js') }}"></script> -->
    <script>
        $(document).ready(function(){
          
        });
    </script>
@endpush