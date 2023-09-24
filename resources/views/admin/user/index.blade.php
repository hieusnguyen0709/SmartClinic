@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header">
                            <h5>Users</h5>
                            <button class="text-uppercase btn bg-gradient-success mb-0" id="create-user"  data-bs-toggle="modal" data-bs-target="#modal-user">Add&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                            <button class="text-uppercase btn bg-gradient-danger mb-0" id="bulk-delete-user"  data-bs-toggle="modal" data-bs-target="#modal-delete">Bulk Delete&nbsp;&nbsp;<i class="fas fa-trash"></i></button>
                        </div>
                        <div class="ms-md-auto pe-md-4 d-flex align-items-center">
                            <div class="input-group">
                                <!-- <label>Filter</label>
                                <select class="form-control pe-md-4" id="role-id" name="role_id">
                                    <option>Roles</option>
                                    <option>Admin</option>
                                    <option>User</option>
                                </select> -->
                                <form action="{{ route('user.index') }}" method="get" id="frm-search">
                                    <!-- <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Search here..." name="search" id="search" value="{{ $search }}">
                                    <input type="hidden" name="num_per_page" id="num-per-page" value="{{ $numPerPage }}">
                                    <input type="hidden" name="sort_column" id="sort-column" value="{{ $sortColumn }}">
                                    <input type="hidden" name="sort_type" id="sort-type" value="{{ $sortType }}">
                                    <!-- <input type="hidden" name="role_id" id="role-id" value="{{ $roleId ?? NULL }}"> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check-all">
                                            </div>
                                        </th>
                                        @php
                                            $classSortName = $classSortEmail = $classSortStatus = $classSortRole = 'fa-sort';
                                            if ($sortColumn == 'name') {
                                                if ($sortType == 'asc') {
                                                    $classSortName = 'fa-sort-up';
                                                } else {
                                                    $classSortName = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'email') {
                                                if ($sortType == 'asc') {
                                                    $classSortEmail = 'fa-sort-up';
                                                } else {
                                                    $classSortEmail = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'role') {
                                                if ($sortType == 'asc') {
                                                    $classSortRole = 'fa-sort-up';
                                                } else {
                                                    $classSortRole = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'status') {
                                                if ($sortType == 'asc') {
                                                    $classSortStatus = 'fa-sort-up';
                                                } else {
                                                    $classSortStatus = 'fa-sort-down';
                                                }
                                            }
                                        @endphp
                                        <th class="text-uppercase text-secondary text-base font-weight-bolder opacity-20 ps-4"><i class="fas fa-solid fa-image"></i> </th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Name<i class="fas fa-solid {{ $classSortName }} cursor-pointer" aria-hidden="true" id="but-sort-name"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Email<i class="fas fa-solid {{ $classSortEmail }} cursor-pointer" aria-hidden="true" id="but-sort-email"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Role<i class="fas fa-solid {{ $classSortRole }} cursor-pointer" aria-hidden="true" id="but-sort-role"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Status<i class="fas fa-solid {{ $classSortStatus }} cursor-pointer" aria-hidden="true" id="but-sort-status"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name='user_ids[]' value="{{ $item->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $item->avatar ? asset('/storage/user/'. $item->avatar) : asset('assets/admin/img/default-avatar.png') }}" class="avatar avatar-sm me-3">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->email }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->role }}</p>
                                        </td>
                                        <td>
                                            <p class="badge badge-sm bg-gradient-{{ $item->viewStatus() == 'Active' ? 'success' : 'danger' }}">{{ $item->viewStatus() }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-solid fa-eye ms-auto text-primary cursor-pointer view-user" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-user" data-id="{{ $item->id }}" title="View"></i>
                                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer edit-user" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-user" data-id="{{ $item->id }}" title="Edit" ></i>
                                            <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer delete-user" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-delete" data-id="{{ $item->id }}" title="Delete"></i>
                                            <i class="fas fa-solid fa-{{ $item->viewStatus() == 'Active' ? 'lock' : 'unlock' }} ms-auto text-default cursor-pointer update-status-user" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-update-status" data-id="{{ $item->id }}" data-status="{{ $item->status }}" title="{{ $item->viewStatus() == 'Active' ? 'Lock' : 'Unlock' }}"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (count($users) > 0)
                    @include('admin.includes.paging', ['pageObject' => $users, 'numPerPage' => $numPerPage, 'search' => $search])
                @endif
            </div>
        </div>
    </div>
@include('admin.includes.modals.modal-user')
@include('admin.includes.modals.modal-delete')
@include('admin.includes.modals.modal-update-status')
@endsection
@section('scripts')
    <script>
        $('#search').keyup(function(event) {
            if (event.which === 13 || isEmpty($(this).val()))
            {
                event.preventDefault();
                $('#frm-search').submit();
            }
        });
        $('#sel-num-per-page').change(function() {
            $('#num-per-page').val($(this).val());
            $('#frm-search').submit();
        });
        $('#but-sort-name').click(function() {
            $('#sort-column').val('name');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-email').click(function() {
            $('#sort-column').val('email');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-role').click(function() {
            $('#sort-column').val('role');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-status').click(function() {
            $('#sort-column').val('status');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#create-user').on('click', function() {
            $('.modal-title').html('New User');
            $.ajax({
                type: 'GET',
                url: '{{ route('user.get.edit') }}',
                data: {
                    'id': ''
                },
                success: function(result) {
                    $('#role-id').html(result.roleList);
                }
            });
            resetErrors();
            $('#but-create-user').css('display', 'inline-block');
            $("#frm-user input, select").prop("disabled", false);
            $('#name').val('');
            $('#email').val('');
            $('#password').val('');
            $('#confirm-password').val('');
            $('#gender').val('0');
            $('#phone').val('');
            $('#age').val('');
            $('#address').val('');
            $('#avatar').val('');
            $('#modal-user').show();
        });
        $('.edit-user').on('click', function() {
            $('.modal-title').html('Edit User');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('user.get.edit') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#role-id').html(result.roleList);
                    $('#name').val(result.user.name);
                    $('#email').val(result.user.email);
                    $('#gender').val(result.user.gender);
                    $('#phone').val(result.user.phone);
                    $('#age').val(result.user.age);
                    $('#address').val(result.user.address);
                    $('#avatar').val(result.user.avatar);
                    $('#id').val(id);
                }
            });
            resetErrors();
            $('#but-create-user').css('display', 'inline-block');
            $("#frm-user input, select").prop("disabled", false);
            $('#modal-user').show();
        });
        $('.view-user').on('click', function() {
            $('.modal-title').html('View User');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('user.get.edit') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#role-id').html(result.roleList);
                    $('#name').val(result.user.name);
                    $('#email').val(result.user.email);
                    $('#gender').val(result.user.gender);
                    $('#phone').val(result.user.phone);
                    $('#age').val(result.user.age);
                    $('#address').val(result.user.address);
                    $('#avatar').val(result.user.avatar);
                    $('#id').val(id);
                }
            });
            resetErrors();
            $('#but-create-user').css('display', 'none');
            $("#frm-user input, select").prop("disabled", true);
            $('#modal-user').show();
        });
        $('#but-create-user').on('click', function() {
            $('#but-create-user').text('SAVING ...');
            $('#but-create-user').prop('disabled', true);
            let form = $('#frm-user')[0];
            let data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url:'{{ route("user.store") }}',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result){
                    if (result.code == 422) {
                        resetErrors();
                        $('#but-create-user').text('SAVE');
                        $('#but-create-user').prop('disabled', false);
                        $('#err-role-id').text(result.errors.role_id);
                        $('#err-name').text(result.errors.name);
                        $('#err-email').text(result.errors.email);
                        $('#err-password').html(result.errors.password);
                        $('#err-confirm-password').html(result.errors.confirm_password);
                        $('#err-avatar').text(result.errors.avatar);
                        for (let key in result.errors) {
                            $('input[name='+ key +'], select[name='+ key +']').addClass("is-invalid");
                        }
                    } else {
                        $('#modal-user').hide(); 
                        location.reload();
                    }
                }
            })
        });
        $('.update-status-user').on('click', function() {
            $('#frm-update-status').attr('action', '{{ route('user.update.status') }}');
            let _this = $(this);
            let id = _this.data('id');
            let status = _this.data('status');
            $('#id-update-status').val(id);
            $('#status').val(status);
            $('#modal-update-status').show();
        });
        $('.delete-user').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('user.delete') }}');
            let _this = $(this);
            let id = _this.data('id');
            $('#id-delete').val(id);
            $('#modal-delete').show();
        });
        $('#bulk-delete-user').on('click', function(e) {
            $('#frm-delete').attr('action', '{{ route('user.delete') }}');
            let ids = [];
            $("tbody input:checked").each(function() {
                ids.push($(this).val());
            });
            if (ids.length == 0) {
                return false;
            }
            $('#id-delete').val(ids.toString());
            $('#modal-delete').show();
        });
        function resetErrors() {
            $('#err-role-id').text('');
            $('#err-name').text('');
            $('#err-email').text('');
            $('#err-password').text('');
            $('#err-confirm-password').text('');
            $('#err-avatar').text('');
            $("#role-id").removeClass("is-invalid");
            $("#name").removeClass("is-invalid");
            $("#email").removeClass("is-invalid");
            $("#password").removeClass("is-invalid");
            $("#confirm-password").removeClass("is-invalid");
            $("#avatar").removeClass("is-invalid");
        }
    </script>
@endsection