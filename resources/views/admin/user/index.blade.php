@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header">
                            <h5>Users</h5>
                        </div>
                        <!-- <div class="col-6 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
                        </div> -->
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                                <form action="{{ route('user.index') }}" method="get" id="frm-search">
                                    <!-- <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span> -->
                                    <input type="text" class="form-control" placeholder="Search here..." name="search" id="search" value="{{ $search }}">
                                    <input type="hidden" name="num_per_page" id="num-per-page" value="{{ $numPerPage }}">
                                    <input type="hidden" name="sort_column" id="sort-column" value="{{ $sortColumn }}">
                                    <input type="hidden" name="sort_type" id="sort-type" value="{{ $sortType }}">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
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
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-4"><i class="fas fa-solid fa-image"></i> </th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Name<i class="fas fa-solid {{ $classSortName }}" aria-hidden="true" id="but-sort-name"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Email<i class="fas fa-solid {{ $classSortEmail }}" aria-hidden="true" id="but-sort-email"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Role<i class="fas fa-solid {{ $classSortRole }}" aria-hidden="true" id="but-sort-role"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Status<i class="fas fa-solid {{ $classSortStatus }}" aria-hidden="true" id="but-sort-status"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('assets/admin/img/default-avatar.png') }}" class="avatar avatar-sm me-3">
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
                                            <i class="fas fa-solid fa-{{ $item->viewStatus() == 'Active' ? 'lock' : 'unlock' }} ms-auto text-default cursor-pointer update-status-user" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-update-status" data-id="{{ $item->id }}" title="{{ $item->viewStatus() == 'Active' ? 'Lock' : 'Unlock' }}"></i>
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
    </script>
@endsection