@extends('layouts.admin')
@section('content')
@php 
  $permissions = explode(',', Auth::user()->role->permission);
@endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                            <div class="w-50">
                                <h5>Prescriptions</h5>
                                @if (in_array(config('constants.PERMISSION.CREATE_PRESCRIPTION'), $permissions))
                                <button class="text-uppercase btn bg-gradient-success" onclick="location.href='{{ route('prescription.create') }}'">Create&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                                @endif
                                @if (in_array(config('constants.PERMISSION.DELETE_PRESCRIPTION'), $permissions))
                                <button class="text-uppercase btn bg-gradient-danger" id="bulk-delete-prescription"  data-bs-toggle="modal" data-bs-target="#modal-delete">Bulk Delete&nbsp;&nbsp;<i class="fas fa-trash"></i></button>
                                @endif
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
                                            $classSortName = $classSortCode = $classSortPatient = $classSortDoctor = 'fa-sort';
                                            if ($sortColumn == 'name') {
                                                if ($sortType == 'asc') {
                                                    $classSortName = 'fa-sort-up';
                                                } else {
                                                    $classSortName = 'fa-sort-down';
                                                }
                                            } elseif ($classSortCode == 'code') {
                                                if ($sortType == 'asc') {
                                                    $classSortCode = 'fa-sort-up';
                                                } else {
                                                    $classSortCode = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'patient') {
                                                if ($sortType == 'asc') {
                                                    $classSortPatient = 'fa-sort-up';
                                                } else {
                                                    $classSortPatient = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'doctor') {
                                                if ($sortType == 'asc') {
                                                    $classSortDoctor = 'fa-sort-up';
                                                } else {
                                                    $classSortDoctor = 'fa-sort-down';
                                                }
                                            }
                                        @endphp
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Name<i class="fas fa-solid {{ $classSortName }} cursor-pointer" aria-hidden="true" id="but-sort-name"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Code<i class="fas fa-solid {{ $classSortCode }} cursor-pointer" aria-hidden="true" id="but-sort-code"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Patient<i class="fas fa-solid {{ $classSortPatient }} cursor-pointer" aria-hidden="true" id="but-sort-patient"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Doctor<i class="fas fa-solid {{ $classSortDoctor }} cursor-pointer" aria-hidden="true" id="but-sort-doctor"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($prescriptions) > 0)
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
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->patient ?? '' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->doctor ?? '' }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-solid fa-eye ms-auto text-primary cursor-pointer" onclick="location.href='{{ route('prescription.edit', [$item->slug, true]) }}'" data-bs-placement="top" data-id="{{ $item->id }}" title="View"></i>
                                            @if (in_array(config('constants.PERMISSION.EDIT_PRESCRIPTION'), $permissions))
                                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" onclick="location.href='{{ route('prescription.edit', [$item->slug, false]) }}'" data-bs-placement="top" data-id="{{ $item->id }}" title="Edit" ></i>
                                            @endif
                                            @if (in_array(config('constants.PERMISSION.DELETE_PRESCRIPTION'), $permissions))
                                            <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer delete-prescription" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-delete" data-id="{{ $item->id }}" title="Delete"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">{{ config('message.NO_DATA') }}</td>
                                        </tr>
                                    @endif
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
        $('#but-sort-code').click(function() {
            $('#sort-column').val('code');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-patient').click(function() {
            $('#sort-column').val('patient');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-doctor').click(function() {
            $('#sort-column').val('doctor');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('.delete-prescription').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('prescription.delete') }}');
            $('#but-confirm-delete').prop('disabled', false);
            let _this = $(this);
            let id = _this.data('id');
            $('#id-delete').val(id);
            $('#modal-delete').show();
        });
        $('#bulk-delete-prescription').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('prescription.delete') }}');
            let ids = [];
            $("tbody input:checked").each(function() {
                ids.push($(this).val());
            });
            if (ids.length == 0) {
                $('#but-confirm-delete').prop('disabled', true);
            } else {
                $('#but-confirm-delete').prop('disabled', false);
            }
            $('#id-delete').val(ids.toString());
            $('#modal-delete').show();
        });
    </script>
@endsection