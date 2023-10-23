@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                            <div class="w-30">
                                <h5>Schedules</h5>
                                <button class="text-uppercase btn bg-gradient-primary" onclick="location.href='{{ route('schedule.calendar') }}'">Calendar&nbsp;&nbsp;<i class="fas fa-calendar"></i></button>
                                <!-- <button class="text-uppercase btn bg-gradient-success" id="create-schedule"  data-bs-toggle="modal" data-bs-target="#modal-schedule">Create&nbsp;&nbsp;<i class="fas fa-plus"></i></button> -->
                                <button class="text-uppercase btn bg-gradient-danger" id="bulk-delete-schedule"  data-bs-toggle="modal" data-bs-target="#modal-delete">Bulk Delete&nbsp;&nbsp;<i class="fas fa-trash"></i></button>
                            </div>
                            <div class="w-70">
                                <div class="float-end">
                                    <h5>&nbsp;</h5>
                                    <button class="text-uppercase btn bg-gradient-warning" onclick="location.href='{{ route('schedule.index') }}'">Clear&nbsp;&nbsp;<i class="fas fa-broom"></i></button>
                                    <button class="text-uppercase btn bg-gradient-primary"><i class="fas fa-filter"></i></button>
                                    <div class="d-flex float-end mx-1">
                                        <select class="form-control pe-md-4 w-100 mx-1" id="list-doctor">
                                            <option value="">Doctors</option>
                                            @foreach ($doctors as $key => $item)
                                                <option value="{{ $item->id }}" {{ $item->id == app('request')->input('select_doctor') ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="mt-2">From</span>
                                        <input type="date" id="from-start-date" class="form-control" value="{{ $startDate }}">
                                        <span class="mt-2">To</span>
                                        <input type="date" id="to-end-date" class="form-control" value="{{ $endDate }}">
                                        <form action="{{ route('schedule.index') }}" method="get" id="frm-search" class="w-100 mx-1 d-flex">
                                            <input type="text" class="form-control" placeholder="Search here..." name="search" id="search" value="{{ $search }}">
                                            <!-- <i class="fas fa-search" aria-hidden="true"></i> -->
                                            <input type="hidden" name="num_per_page" id="num-per-page" value="{{ $numPerPage }}">
                                            <input type="hidden" name="sort_column" id="sort-column" value="{{ $sortColumn }}">
                                            <input type="hidden" name="sort_type" id="sort-type" value="{{ $sortType }}">
                                            <input type="hidden" name="select_doctor" id="select-doctor" value="{{ $doctorId }}">
                                            <input type="hidden" name="select_start_date" id="select-start-date" value="{{ $startDate }}">
                                            <input type="hidden" name="select_end_date" id="select-end-date" value="{{ $endDate }}">
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
                                            $classSortDoctor =  $classSortStartDate = $classSortEndDate  = 'fa-sort';
                                            if ($sortColumn == 'doctor') {
                                                if ($sortType == 'asc') {
                                                    $classSortDoctor = 'fa-sort-up';
                                                } else {
                                                    $classSortDoctor = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'start_date') {
                                                if ($sortType == 'asc') {
                                                    $classSortStartDate = 'fa-sort-up';
                                                } else {
                                                    $classSortStartDate = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'end_date') {
                                                if ($sortType == 'asc') {
                                                    $classSortEndDate = 'fa-sort-up';
                                                } else {
                                                    $classSortEndDate = 'fa-sort-down';
                                                }
                                            }
                                        @endphp
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Doctor<i class="fas fa-solid {{ $classSortDoctor }} cursor-pointer" aria-hidden="true" id="but-sort-doctor"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Frames</th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Start Date<i class="fas fa-solid {{ $classSortStartDate }} cursor-pointer" aria-hidden="true" id="but-sort-start-date"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">End Date<i class="fas fa-solid {{ $classSortEndDate }} cursor-pointer" aria-hidden="true" id="but-sort-end-date"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($schedules) > 0)
                                    @foreach ($schedules as $key => $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name='Schedule_ids[]' value="{{ $item->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->doctor  }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->frame_ids }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->start_date }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->end_date }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-solid fa-eye ms-auto text-primary cursor-pointer view-schedule" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-schedule" data-id="{{ $item->id }}" title="View"></i>
                                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer edit-schedule" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-schedule" data-id="{{ $item->id }}" title="Edit" ></i>
                                            <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer delete-schedule" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-delete" data-id="{{ $item->id }}" title="Delete"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">{{ config('message.NO_DATA') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (count($schedules) > 0)
                    @include('admin.includes.paging', ['pageObject' => $schedules, 'numPerPage' => $numPerPage, 'search' => $search])
                @endif
            </div>
        </div>
    </div>
@include('admin.includes.modals.modal-schedule')
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
        $('#from-start-date').on('change', function(){
            $('#select-start-date').val($(this).val());
            $('#frm-search').submit();
        })
        $('#to-end-date').on('change', function(){
            $('#select-end-date').val($(this).val());
            $('#frm-search').submit();
        })
        $('#list-doctor').change(function() {
            $('#select-doctor').val($(this).val());
            $('#frm-search').submit();
        });
        $('#sel-num-per-page').change(function() {
            $('#num-per-page').val($(this).val());
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
        $('#but-sort-start-date').click(function() {
            $('#sort-column').val('start_date');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-end-date').click(function() {
            $('#sort-column').val('end_date');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $("#modal-schedule").on("hidden.bs.modal", function() {
            $('.frame .frame-body:gt(0)').remove();
            $('#but-create-schedule').off('click');
        });
        $('#create-schedule').on('click', function() {
            $('.modal-title').html('New Schedule');
            $.ajax({
                type: 'GET',
                url: '{{ route('schedule.get.edit') }}',
                data: {
                    'id': ''
                },
                success: function(result) {
                    $('#doctor-id').html(result.doctorList);
                    let $firstRow = $('.frame').find('.frame-body:first');
                    result.frames.forEach(function(frame) {
                        let $newRow = $('<div class="d-flex frame-body">'+ $firstRow.html() +'</div');
                        $newRow.find('.frame-id').val(frame.id);
                        $newRow.find('.frame-name').val(frame.name);
                        $newRow.find('.frame-start-time').val(frame.start_time);
                        $newRow.find('.frame-end-time').val(frame.end_time);
                        $('.frame').append($newRow);
                    });
                    $firstRow.remove();
                }
            }); 
            resetErrors();
            $('#but-create-schedule').css('display', 'inline-block');
            $("#frm-schedule input, select").not('input.frame-name, input.frame-start-time, input.frame-end-time').prop("disabled", false);
            $('#modal-schedule').show();
        });
        $('.edit-schedule').on('click', function() {
            $('.modal-title').html('Edit Schedule');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('schedule.get.edit') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#doctor-id').html(result.doctorList);
                    $('#frame-ids').val(result.frameIds);
                    $('#start-date').val(result.schedule.start_date);
                    $('#end-date').val(result.schedule.end_date);
                    $('#color').val(result.schedule.color);
                    $('#id').val(id);
                    let $firstRow = $('.frame').find('.frame-body:first');
                    result.frames.forEach(function(frame) {
                        let $newRow = $('<div class="d-flex frame-body">'+ $firstRow.html() +'</div');
                        $newRow.find('.frame-id').val(frame.id);
                        $newRow.find('.frame-name').val(frame.name);
                        $newRow.find('.frame-start-time').val(frame.start_time);
                        $newRow.find('.frame-end-time').val(frame.end_time);
                        if (result.frameIds.split(',').indexOf(frame.id.toString()) !== -1) {
                            $newRow.find('.frame-id').prop('checked', true);
                        }
                        $('.frame').append($newRow);
                    });
                    $firstRow.remove();
                }
            });
            resetErrors();
            $('#but-create-schedule').css('display', 'inline-block');
            $("#frm-schedule input, select").not('input.frame-name, input.frame-start-time, input.frame-end-time').prop("disabled", false);
            $('#modal-schedule').show();
        });
        $('.view-schedule').on('click', function() {
            $('.modal-title').html('View Schedule');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('schedule.get.edit') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#doctor-id').html(result.doctorList);
                    $('#frame-ids').val(result.frameIds);
                    $('#start-date').val(result.schedule.start_date);
                    $('#end-date').val(result.schedule.end_date);
                    $('#color').val(result.schedule.color);
                    $('#id').val(id);
                    let $firstRow = $('.frame').find('.frame-body:first');
                    result.frames.forEach(function(frame) {
                        let $newRow = $('<div class="d-flex frame-body">'+ $firstRow.html() +'</div');
                        $newRow.find('.frame-id').val(frame.id);
                        $newRow.find('.frame-name').val(frame.name);
                        $newRow.find('.frame-start-time').val(frame.start_time);
                        $newRow.find('.frame-end-time').val(frame.end_time);
                        if (result.frameIds.split(',').indexOf(frame.id.toString()) !== -1) {
                            $newRow.find('.frame-id').prop('checked', true);
                        }
                        $('.frame').append($newRow);
                    });
                    $firstRow.remove();
                }
            });
            resetErrors();
            $('#but-create-schedule').css('display', 'none');
            $("#frm-schedule input, select").prop("disabled", true);
            $('#modal-schedule').show();
        });
        $('#but-create-schedule').on('click', function() {
            $('#but-create-schedule').text('Saving ...');
            $('#but-create-schedule').prop('disabled', true);
            let form = $('#frm-schedule')[0];
            let data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url:'{{ route("schedule.store") }}',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result){
                    if (result.code == 422) {
                        resetErrors();
                        $('#but-create-schedule').text('Save');
                        $('#but-create-schedule').prop('disabled', false);
                        $('#err-doctor-id').text(result.errors.doctor_id);
                        $('#err-frame-ids').text(result.errors.frame_ids);
                        for (let key in result.errors) {
                            $('select[name='+ key +']').addClass("is-invalid");
                        }
                    } else {
                        $('#modal-schedule').hide(); 
                        location.reload();
                    }
                }
            })
        });
        $('.delete-schedule').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('schedule.delete') }}');
            let _this = $(this);
            let id = _this.data('id');
            $('#id-delete').val(id);
            $('#modal-delete').show();
        });
        $('#bulk-delete-schedule').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('schedule.delete') }}');
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
        function updateFrameIds() {
            let frameIds = [];
            $('.frame-id:checked').each(function() {
                let frameId = $(this).val();
                frameIds.push(frameId);
            });
            $('#frame-ids').val(frameIds.toString());
        }
        $('#check-all-frame').click(function() {
            let checked = $(this).prop('checked');
            $('.frame-id').prop('checked', checked);
            updateFrameIds();
        });
        $(document).on('click', '.frame-id', function() {
            updateFrameIds();
        });
        function getRandomColor() {
            let red = Math.floor(Math.random() * 256);
            let green = Math.floor(Math.random() * 256);
            let blue = Math.floor(Math.random() * 256);

            let color = "#" + red.toString(16) + green.toString(16) + blue.toString(16);

            return color;
        }
        function resetErrors() {
            $('#err-doctor-id').text('');
            $('#err-frame-ids').text('');
            $("#doctor-id").removeClass("is-invalid");
        }
    </script>
@endsection