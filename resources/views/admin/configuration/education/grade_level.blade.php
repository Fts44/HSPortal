@extends('layouts.admin_main')

@push('title')
    <title>Configuration</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Education</h1>
            <nav>
                <ol class="breadcrumb mt-1" style="--bs-breadcrumb-divider: '|';">
                    <li class="breadcrumb-item active">GradeLevel</li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/configuration/department') }}">Department</a></li>
                    <li class="breadcrumb-item"><a href="">Program</a></li>
                </ol>
            </nav>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                {{session('failed')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="section" >
            <div class="card" id="cardTable">
                <div class="card-body px-4">
                    <h5 class="card-title">Grade Levels</h5>
                    <a href="#" class="btn btn-secondary btn-sm" id="add" style="float: right; margin-top: -2.5rem;">
                        <i class="bi bi-plus-lg"></i>          
                    </a>
                    <table id="datatable" class="table table-striped col-lg-12" style="width: 100%;">
                        <thead> 
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Grade Level</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                            @foreach($grade_levels as $grade_level)
                                <tr>
                                    <td>{{ $grade_level->id }}</td>
                                    <td>{{ $grade_level->gl_name}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" id="update_btn"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ url('admin/configuration/gradelevel/delete/'.$grade_level->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-eraser"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Add Grade level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="form">
                <div class="modal-body mb-4">
                    @csrf
                    <div class="col-lg-12">
                        <div class="row">
                            <label for="name" class="col-lg-12 col-form-label">Grade level:</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>
                            <span class="col-lg-12 text-danger" id="gl_name_error">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit_button">Add</button>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
  
@push('script')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script>
        $(document).ready(function(){
            
            @if($errors->any())
                @if(session('url'))
                    console.log("{{ session('url') }}");
                    $('#form').attr('action', "{{ session('url') }}");
                    @if(session('action') == 'update') 
                        $('#modal_title').html('Update Grade level');
                        $('#submit_button').html('Update');
                    @endif
                @endif
                $('#modal').modal('show');
            @endif

            $('.alert').delay(5000).fadeOut('slow');

            $('#add').click(function(e){
                e.preventDefault();
                $('#form').attr('action', "{{ url('admin/configuration/gradelevel/new') }}");
                $('#modal_title').html('Add Grade level');
                $('#submit_button').html('Add');
                $('#name').val('');
                $('#modal').modal('show');
            });


            var table = $('#datatable').DataTable();

            table.on('click', '#update_btn', function(){
                
                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data);
                $('#name').val(data[1]);
                $('#form').attr('action', "{{ url('admin/configuration/gradelevel/update') }}"+"/"+data[0]);
                $('#modal_title').html('Update Grade level');
                $('#submit_button').html('Update');
                $('#modal').modal('show');
            });
        });
    </script>
@endpush