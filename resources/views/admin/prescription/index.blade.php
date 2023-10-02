@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                            <div class="w-50">
                                <h5>Prescriptions</h5>
                                <button class="text-uppercase btn bg-gradient-success" id="create-prescription"  data-bs-toggle="modal" data-bs-target="#modal-prescription">Create&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                                <button class="text-uppercase btn bg-gradient-danger" id="bulk-delete-prescription"  data-bs-toggle="modal" data-bs-target="#modal-delete">Bulk Delete&nbsp;&nbsp;<i class="fas fa-trash"></i></button>
                            </div>
                            <div class="w-50">
                                <div class="float-end">
                                    <h5>&nbsp;</h5>
                                    <button class="text-uppercase btn bg-gradient-warning" onclick="location.href='{{ route('prescription.index') }}'">Clear&nbsp;&nbsp;<i class="fas fa-broom"></i></button>
                                    <div class="d-flex float-end mx-1">
                                        <form action="{{ route('prescription.index') }}" method="get" id="frm-search" class="w-100 mx-1 d-flex">
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
                                            $classSortName = $classSortCategory = $classSortInstruction = $classSortUnit = $classSortQuantity = 'fa-sort';
                                            if ($sortColumn == 'name') {
                                                if ($sortType == 'asc') {
                                                    $classSortName = 'fa-sort-up';
                                                } else {
                                                    $classSortName = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'category_id') {
                                                if ($sortType == 'asc') {
                                                    $classSortCategory = 'fa-sort-up';
                                                } else {
                                                    $classSortCategory = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'instruction') {
                                                if ($sortType == 'asc') {
                                                    $classSortInstruction = 'fa-sort-up';
                                                } else {
                                                    $classSortInstruction = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'unit') {
                                                if ($sortType == 'asc') {
                                                    $classSortUnit = 'fa-sort-up';
                                                } else {
                                                    $classSortUnit = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'quantity') {
                                                if ($sortType == 'asc') {
                                                    $classSortQuantity = 'fa-sort-up';
                                                } else {
                                                    $classSortQuantity = 'fa-sort-down';
                                                }
                                            }
                                        @endphp
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Name<i class="fas fa-solid {{ $classSortName }} cursor-pointer" aria-hidden="true" id="but-sort-name"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Code<i class="fas fa-solid {{ $classSortCategory }} cursor-pointer" aria-hidden="true" id="but-sort-category"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prescriptions as $key => $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name='Medicine_ids[]' value="{{ $item->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->code }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-solid fa-eye ms-auto text-primary cursor-pointer view-prescription" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-prescription" data-id="{{ $item->id }}" title="View"></i>
                                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer edit-prescription" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-prescription" data-id="{{ $item->id }}" title="Edit" ></i>
                                            <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer delete-prescription" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-delete" data-id="{{ $item->id }}" title="Delete"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (count($prescriptions) > 0)
                    @include('admin.includes.paging', ['pageObject' => $prescriptions, 'numPerPage' => $numPerPage, 'search' => $search])
                @endif
            </div>
        </div>
    </div>
@include('admin.includes.modals.modal-medicine')
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
        $('#but-sort-category').click(function() {
            $('#sort-column').val('category_id');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-instruction').click(function() {
            $('#sort-column').val('instruction');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-unit').click(function() {
            $('#sort-column').val('unit');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-quantity').click(function() {
            $('#sort-column').val('quantity');
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