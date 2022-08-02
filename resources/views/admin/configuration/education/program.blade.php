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
                    <li class="breadcrumb-item"><a href="{{ url('admin/configuration/gradelevel') }}">GradeLevel</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/configuration/department') }}">Department</a></li>
                    <li class="breadcrumb-item active">Program</li>
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
                    <h5 class="card-title">Program</h5>
                    <a href="#" class="btn btn-secondary btn-sm" id="add" style="float: right; margin-top: -2.5rem;">
                        <i class="bi bi-plus-lg"></i>          
                    </a>
                    <table id="datatable" class="table table-striped col-lg-12" style="width: 100%;">
                        <thead> 
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" class="d-none">gl_id</th>
                                <th scope="col">GradeLevel</th>
                                <th scope="col" class="d-none">dept_id</th>
                                <th scope="col">Department</th>
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style = "width: 100%;">
                            @foreach($programs as $program)
                            <tr>
                                <td>{{ $program->prog_id }}</td>
                                <td class="d-none">{{ $program->gl_id }}</td>
                                <td>{{ $program->gl_name }}</td>
                                <td class="d-none">{{ $program->dept_id }}</td>
                                <td>{{ $program->dept_code }}</td>
                                <td>{{ $program->prog_code }}</td>
                                <td>{{ $program->prog_name }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" id="update_btn"><i class="bi bi-pencil"></i></a>
                                    <a href="{{ url('admin/configuration/program/delete/'.$program->prog_id) }}" class="btn btn-danger btn-sm"><i class="bi bi-eraser"></i></a>
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
                <h5 class="modal-title" id="modal_title">Add Program</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="form">
                <div class="modal-body mb-4">
                    @csrf
                    <div class="col-lg-12">
                        <div class="row">
                            <label for="grade_level" class="col-lg-12 col-form-label">Grade level:</label>
                            <div class="col-lg-12">
                                <select name="grade_level" id="grade_level" class="form-select">
                                    <option value="">Choose</option>
                                    @foreach($grade_levels as $grade_level)
                                    <option value="{{ $grade_level->gl_id }}">{{ $grade_level->gl_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="col-lg-12 text-danger">
                                @error('grade_level')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="row mt-3">
                            <label for="department" class="col-lg-12 col-form-label">Department:</label>
                            <div class="col-lg-12">
                                <select name="department" id="department" class="form-select">
                                    <option value="">Choose</option>
                                </select>
                            </div>
                            <span class="col-lg-12 text-danger">
                                @error('grade_level')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="row mt-3">
                            <label for="code" class="col-lg-12 col-form-label">Code:</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}">
                            </div>
                            <span class="col-lg-12 text-danger">
                                @error('code')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="row mt-3">
                            <label for="name" class="col-lg-12 col-form-label">Name:</label>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            <span class="col-lg-12 text-danger">
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
                        $('#modal_title').html('Update Program');
                        $('#submit_button').html('Update');
                    @endif
                @endif
                $('#modal').modal('show');
            @endif

            $('.alert').delay(5000).fadeOut('slow');

            $('#add').click(function(e){
                e.preventDefault();
                $('#form').attr('action', "{{ url('admin/configuration/program/new') }}");
                $('#modal_title').html('Add Program');
                $('#submit_button').html('Add');
                $('#grade_level').val('');
                $('#code').val('');
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
                $('#grade_level').val(data[1]);
                get_set_department('#department',data[3],data[1]);
                $('#code').val(data[3]);
                $('#code').val(data[5]);
                $('#name').val(data[6]);
                $('#form').attr('action', "{{ url('admin/configuration/program/update') }}"+"/"+data[0]);
                $('#modal_title').html('Update Program');
                $('#submit_button').html('Update');
                $('#modal').modal('show');
            });

            $('#grade_level').change(function(){
                get_set_department('#department','all',$(this).val());
            });
        });
    </script>
@endpush