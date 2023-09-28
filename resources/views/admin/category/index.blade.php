@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                            <div class="w-50">
                                <h5>Categories</h5>
                                <button class="text-uppercase btn bg-gradient-success" id="create-category"  data-bs-toggle="modal" data-bs-target="#modal-category">Create&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                                <button class="text-uppercase btn bg-gradient-danger" id="bulk-delete-category"  data-bs-toggle="modal" data-bs-target="#modal-delete">Bulk Delete&nbsp;&nbsp;<i class="fas fa-trash"></i></button>
                            </div>
                            <div class="w-50">
                                <div class="float-end">
                                    <h5>&nbsp;</h5>
                                    <button class="text-uppercase btn bg-gradient-warning" onclick="location.href='{{ route('category.index') }}'">Clear&nbsp;&nbsp;<i class="fas fa-broom"></i></button>
                                    <div class="d-flex float-end mx-1">
                                        <form action="{{ route('category.index') }}" method="get" id="frm-search" class="w-100 mx-1 d-flex">
                                            <input type="text" class="form-control" placeholder="Search here..." name="search" id="search" value="{{ $search }}">
                                            <!-- <i class="fas fa-search" aria-hidden="true"></i> -->
                                            <input type="hidden" name="num_per_page" id="num-per-page" value="{{ $numPerPage }}">
                                            <input type="hidden" name="sort_column" id="sort-column" value="{{ $sortColumn }}">
                                            <input type="hidden" name="sort_type" id="sort-type" value="{{ $sortType }}">
                                        </form>
                                    </div>
                                </div>
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
                                            $classSortName = $classSortDescription = $classSortUser = 'fa-sort';
                                            if ($sortColumn == 'name') {
                                                if ($sortType == 'asc') {
                                                    $classSortName = 'fa-sort-up';
                                                } else {
                                                    $classSortName = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'description') {
                                                if ($sortType == 'asc') {
                                                    $classSortDescription = 'fa-sort-up';
                                                } else {
                                                    $classSortDescription = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'user') {
                                                if ($sortType == 'asc') {
                                                    $classSortUser = 'fa-sort-up';
                                                } else {
                                                    $classSortUser = 'fa-sort-down';
                                                }
                                            }
                                        @endphp
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Name<i class="fas fa-solid {{ $classSortName }} cursor-pointer" aria-hidden="true" id="but-sort-name"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Description<i class="fas fa-solid {{ $classSortDescription }} cursor-pointer" aria-hidden="true" id="but-sort-description"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Parent Category</th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">User<i class="fas fa-solid {{ $classSortUser }} cursor-pointer" aria-hidden="true" id="but-sort-user"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name='Category_ids[]' value="{{ $item->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->description }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->parent->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->user }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-solid fa-eye ms-auto text-primary cursor-pointer view-category" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-category" data-id="{{ $item->id }}" title="View"></i>
                                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer edit-category" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-category" data-id="{{ $item->id }}" title="Edit" ></i>
                                            <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer delete-category" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-delete" data-id="{{ $item->id }}" title="Delete"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (count($categories) > 0)
                    @include('admin.includes.paging', ['pageObject' => $categories, 'numPerPage' => $numPerPage, 'search' => $search])
                @endif
            </div>
        </div>
    </div>
@include('admin.includes.modals.modal-category')
@include('admin.includes.modals.modal-delete')
@endsection
@section('scripts')
    <script>
        $('#search').keyup(function(event) {
            if (event.which === 13 || $(this).val() == '') {
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
        $('#but-sort-description').click(function() {
            $('#sort-column').val('description');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-user').click(function() {
            $('#sort-column').val('user');
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