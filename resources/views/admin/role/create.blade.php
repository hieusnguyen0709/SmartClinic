@extends('layouts.admin')
@section('content')
    <form action="{{ route('role.store') }}" id="frm-role" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                            <div class="w-50">
                                <h5>Roles / Create</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-name"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <textarea class="form-control" type="text" name="description" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-bold text-uppercase text-base">Permission</p>
                        
                        <!-- Dashboard -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex">
                                    <div class="w-50">
                                        <p class="text-uppercase text-sm">Dashboard</p>
                                    </div>
                                    <div class="w-50">
                                        <div class="float-end">                                    
                                            <button type="button" class="text-uppercase btn bg-gradient-success mx-1 check-all-per"><i class="fas fa-check-double"></i></button>                                 
                                            <button type="button" class="text-uppercase btn bg-gradient-secondary mx-1 uncheck-all-per"><i class="fas fa-ban"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="custom-control-label">View</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <!-- Dashboard -->

                        <!-- Users -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex">
                                    <div class="w-50">
                                        <p class="text-uppercase text-sm">Users</p>
                                    </div>
                                    <div class="w-50">
                                        <div class="float-end">                                    
                                            <button type="button" class="text-uppercase btn bg-gradient-success mx-1 check-all-per"><i class="fas fa-check-double"></i></button>                                 
                                            <button type="button" class="text-uppercase btn bg-gradient-secondary mx-1 uncheck-all-per"><i class="fas fa-ban"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="custom-control-label">View</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                                <div class="form-check">
                                    <label class="custom-control-label">Create</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                                <div class="form-check">
                                    <label class="custom-control-label">Edit</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                                <div class="form-check">
                                    <label class="custom-control-label">Delete</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                                <div class="form-check">
                                    <label class="custom-control-label">Lock/Unlock</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <!-- Users -->

                        <!-- Roles -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex">
                                    <div class="w-50">
                                        <p class="text-uppercase text-sm">Roles</p>
                                    </div>
                                    <div class="w-50">
                                        <div class="float-end">                                    
                                            <button type="button" class="text-uppercase btn bg-gradient-success mx-1 check-all-per"><i class="fas fa-check-double"></i></button>                                 
                                            <button type="button" class="text-uppercase btn bg-gradient-secondary mx-1 uncheck-all-per"><i class="fas fa-ban"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="custom-control-label">View</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                                <div class="form-check">
                                    <label class="custom-control-label">Create</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                                <div class="form-check">
                                    <label class="custom-control-label">Edit</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                                <div class="form-check">
                                    <label class="custom-control-label">Delete</label>
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <!-- Roles -->

                        <div class="row">
                            <div class="text-center d-flex">
                                <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-15 mt-4 mb-0" onclick="location.href='{{ route('role.index') }}'">Cancel</button>
                                <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-15 mt-4 mb-0" id="but-create-role">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@include('admin.includes.modals.modal-delete')
@endsection
@section('scripts')
    <script>
        $('#but-create-role').on('click', function() {
            $('#err-name').text('');
            $('#err-permission').text('');
            $('#but-create-role').text('SAVING ...');
            $('#but-create-role').prop('disabled', true);
            let form = $('#frm-role')[0];
            let data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url:'{{ route("role.store") }}',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result){
                    if (result.code == 422) {
                        $('#but-create-role').text('SAVE');
                        $('#but-create-role').prop('disabled', false);
                        $("input[name='name']").addClass("is-invalid");
                        $('#err-name').text(result.errors.name);
                    } else {
                        location.href = '{{ route("role.index") }}';
                    }
                }
            })
        });
    </script>
@endsection