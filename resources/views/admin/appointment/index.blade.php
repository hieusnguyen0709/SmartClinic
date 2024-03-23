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
                                <h5>Appointments</h5>
                                @if (in_array(config('constants.PERMISSION.CREATE_APPOINTMENT') , $permissions))
                                <button class="text-uppercase btn bg-gradient-success" id="create-appointment"  data-bs-toggle="modal" data-bs-target="#modal-appointment">Create&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                                @endif
                                @if (in_array(config('constants.PERMISSION.DELETE_APPOINTMENT') , $permissions))
                                <button class="text-uppercase btn bg-gradient-danger" id="bulk-delete-appointment"  data-bs-toggle="modal" data-bs-target="#modal-delete">Bulk Delete&nbsp;&nbsp;<i class="fas fa-trash"></i></button>
                                @endif
                            </div>
                            <div class="w-50">
                                <div class="float-end">
                                    <h5>&nbsp;</h5>
                                    <button class="text-uppercase btn bg-gradient-warning" onclick="location.href='{{ route('appointment.index') }}'">Clear&nbsp;&nbsp;<i class="fas fa-broom"></i></button>
                                    <div class="d-flex float-end mx-1">
                                        <form action="{{ route('appointment.index') }}" method="get" id="frm-search" class="w-100 mx-1 d-flex">
                                            <input type="text" class="form-control" placeholder="Search here..." name="search" id="search" value="{{ $search }}">
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
                                            $classSortCode = $classSortPatient = $classSortDoctor = $classSortDateTime = $classSortStatus = 'fa-sort';
                                            if ($sortColumn == 'code') {
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
                                            } elseif ($sortColumn == 'date_time') {
                                                if ($sortType == 'asc') {
                                                    $classSortDateTime = 'fa-sort-up';
                                                } else {
                                                    $classSortDateTime = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'status') {
                                                if ($sortType == 'asc') {
                                                    $classSortStatus = 'fa-sort-up';
                                                } else {
                                                    $classSortStatus = 'fa-sort-down';
                                                }
                                            } 
                                        @endphp
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Code<i class="fas fa-solid {{ $classSortCode }} cursor-pointer" aria-hidden="true" id="but-sort-code"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Patient<i class="fas fa-solid {{ $classSortPatient }} cursor-pointer" aria-hidden="true" id="but-sort-patient"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Doctor<i class="fas fa-solid {{ $classSortDoctor }} cursor-pointer" aria-hidden="true" id="but-sort-doctor"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Date time<i class="fas fa-solid {{ $classSortDateTime }} cursor-pointer" aria-hidden="true" id="but-sort-date-time"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Status<i class="fas fa-solid {{ $classSortStatus }} cursor-pointer" aria-hidden="true" id="but-sort-status"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($appointments) > 0)
                                    @foreach ($appointments as $key => $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name='Appointment_ids[]' value="{{ $item->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->code }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->patient }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->doctor }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->date_time }}</p>
                                        </td>
                                        <td>
                                            <p class="badge badge-sm bg-gradient-{{ $item->viewStatus() == 'Processed' ? 'success' : 'danger' }}">{{ $item->viewStatus() }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-solid fa-eye ms-auto text-primary cursor-pointer view-appointment" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-appointment" data-id="{{ $item->id }}" title="View"></i>
                                            @if (in_array(config('constants.PERMISSION.EDIT_APPOINTMENT') , $permissions))
                                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer edit-appointment" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-appointment" data-id="{{ $item->id }}" title="Edit" ></i>
                                            @endif
                                            @if (in_array(config('constants.PERMISSION.DELETE_APPOINTMENT') , $permissions))
                                            <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer delete-appointment" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-delete" data-id="{{ $item->id }}" title="Delete"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">{{ config('message.NO_DATA') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (count($appointments) > 0)
                    @include('admin.includes.paging', ['pageObject' => $appointments, 'numPerPage' => $numPerPage, 'search' => $search])
                @endif
            </div>
        </div>
    </div>
@include('admin.includes.modals.modal-delete')
@include('admin.includes.modals.modal-appointment')
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
        $('#but-sort-date-time').click(function() {
            $('#sort-column').val('date_time');
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
        $('#create-appointment').on('click', function() {
            $('.modal-title').html('New Appointment');
            $.ajax({
                type: 'GET',
                url: '{{ route('appointment.get.edit') }}',
                data: {
                    'id': ''
                },
                success: function(result) {
                    $('#id').val('');
                    $('#patient-id').html(result.patientList);
                    $('#doctor-id').html(result.doctorList);
                    $('#date-time').val('');
                    $('#note').val('');
                }
            });
            resetErrors();
            $('#but-create-appointment').css('display', 'inline-block');
            $("#frm-appointment input, select, textarea").prop("disabled", false);
            $('#modal-appointment').show();
        });
        $('.edit-appointment').on('click', function() {
            $('.modal-title').html('Edit Appointment');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('appointment.get.edit') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#id').val(id);
                    $('#patient-id').html(result.patientList);
                    $('#doctor-id').html(result.doctorList);
                    $('#date-time').val(result.appointment.date_time);
                    $('#note').val(result.appointment.note);
                }
            });
            resetErrors();
            $('#but-create-appointment').css('display', 'inline-block');
            $("#frm-appointment input, select, textarea").prop("disabled", false);
            $('#modal-appointment').show();
        });
        $('.view-appointment').on('click', function() {
            $('.modal-title').html('View Appointment');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('appointment.get.edit') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#id').val(id);
                    $('#patient-id').html(result.patientList);
                    $('#doctor-id').html(result.doctorList);
                    $('#date-time').val(result.appointment.date_time);
                    $('#note').val(result.appointment.note);
                }
            });
            resetErrors();
            $('#but-create-appointment').css('display', 'none');
            $("#frm-appointment input, select, textarea").prop("disabled", true);
            $('#modal-appointment').show();
        });
        $('#but-create-appointment').on('click', function() {
            $('#but-create-appointment').text('Saving ...');
            $('#but-create-appointment').prop('disabled', true);
            let form = $('#frm-appointment')[0];
            let data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url:'{{ route("appointment.store") }}',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result){
                    if (result.code == 422) {
                        resetErrors();
                        $('#but-create-appointment').text('Save');
                        $('#but-create-appointment').prop('disabled', false);
                        $('#err-patient-id').text(result.errors.patient_id);
                        $('#err-doctor-id').text(result.errors.doctor_id);
                        $('#err-date').text(result.errors.date_time);
                        for (let key in result.errors) {
                            $('input[name='+ key +'], select[name='+ key +']').addClass("is-invalid");
                        }
                    } else {
                        $('#modal-appointment').hide(); 
                        location.reload();
                    }
                }
            })
        });
        $('.delete-appointment').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('appointment.delete') }}');
            $('#but-confirm-delete').prop('disabled', false);
            let _this = $(this);
            let id = _this.data('id');
            $('#id-delete').val(id);
            $('#modal-delete').show();
        });
        $('#bulk-delete-appointment').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('appointment.delete') }}');
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
        function resetErrors() {
            $('#err-patient-id').text('');
            $('#err-doctor-id').text('');
            $('#err-date-time').text('');
            $("#patient-id").removeClass("is-invalid");
            $("#doctor-id").removeClass("is-invalid");
            $("#date-time").removeClass("is-invalid");
        }
    </script>
@endsection