@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                            <div class="w-50">
                                <h5>Frames</h5>
                                <button class="text-uppercase btn bg-gradient-success" id="create-frame"  data-bs-toggle="modal" data-bs-target="#modal-frame">Create&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                                <button class="text-uppercase btn bg-gradient-danger" id="bulk-delete-frame"  data-bs-toggle="modal" data-bs-target="#modal-delete">Bulk Delete&nbsp;&nbsp;<i class="fas fa-trash"></i></button>
                            </div>
                            <div class="w-50">
                                <div class="float-end">
                                    <h5>&nbsp;</h5>
                                    <button class="text-uppercase btn bg-gradient-warning" onclick="location.href='{{ route('frame.index') }}'">Clear&nbsp;&nbsp;<i class="fas fa-broom"></i></button>
                                    <div class="d-flex float-end mx-1">
                                        <form action="{{ route('frame.index') }}" method="get" id="frm-search" class="w-100 mx-1 d-flex">
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
                                            $classSortName = $classSortStartTime = $classSortEndTime = 'fa-sort';
                                            if ($sortColumn == 'name') {
                                                if ($sortType == 'asc') {
                                                    $classSortName = 'fa-sort-up';
                                                } else {
                                                    $classSortName = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'start_time') {
                                                if ($sortType == 'asc') {
                                                    $classSortStartTime = 'fa-sort-up';
                                                } else {
                                                    $classSortStartTime = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'end_time') {
                                                if ($sortType == 'asc') {
                                                    $classSortEndTime = 'fa-sort-up';
                                                } else {
                                                    $classSortEndTime = 'fa-sort-down';
                                                }
                                            } 
                                        @endphp
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Name<i class="fas fa-solid {{ $classSortName }} cursor-pointer" aria-hidden="true" id="but-sort-name"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Start Time<i class="fas fa-solid {{ $classSortStartTime }} cursor-pointer" aria-hidden="true" id="but-sort-start-time"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">End Time<i class="fas fa-solid {{ $classSortEndTime }} cursor-pointer" aria-hidden="true" id="but-sort-end-time"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">User</th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($frames) > 0)
                                    @foreach ($frames as $key => $item)
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
                                            <p class="text-xs font-weight-bold mb-0">{{ getTimeFormat($item->start_time) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ getTimeFormat($item->end_time) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->user->name ?? '' }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-solid fa-eye ms-auto text-primary cursor-pointer view-frame" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-frame" data-id="{{ $item->id }}" title="View"></i>
                                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer edit-frame" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-frame" data-id="{{ $item->id }}" title="Edit" ></i>
                                            <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer delete-frame" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-delete" data-id="{{ $item->id }}" title="Delete"></i>
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
                @if (count($frames) > 0)
                    @include('admin.includes.paging', ['pageObject' => $frames, 'numPerPage' => $numPerPage, 'search' => $search])
                @endif
            </div>
        </div>
    </div>
@include('admin.includes.modals.modal-frame')
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
        $('#but-sort-start-time').click(function() {
            $('#sort-column').val('start_time');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-end-time').click(function() {
            $('#sort-column').val('end_time');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#create-frame').on('click', function() {
            $('.modal-title').html('New Frame');
            $.ajax({
                type: 'GET',
                url: '{{ route('frame.get.edit') }}',
                data: {
                    'id': ''
                },
                success: function(result) {
                    $('#id').val('');
                    $('#name').val('');
                    $('#start-time').val('');
                    $('#end-time').val('');
                }
            });
            resetErrors();
            $('#but-create-frame').css('display', 'inline-block');
            $("#frm-frame input").prop("disabled", false);
            $('#modal-frame').show();
        });
        $('.edit-frame').on('click', function() {
            $('.modal-title').html('Edit Frame');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('frame.get.edit') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#id').val(result.frame.id);
                    $('#name').val(result.frame.name);
                    $('#start-time').val(result.frame.start_time);
                    $('#end-time').val(result.frame.end_time);
                }
            });
            resetErrors();
            $('#but-create-frame').css('display', 'inline-block');
            $("#frm-frame input").prop("disabled", false);
            $('#modal-frame').show();
        });
        $('.view-frame').on('click', function() {
            $('.modal-title').html('View Frame');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('frame.get.edit') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#id').val(result.frame.id);
                    $('#name').val(result.frame.name);
                    $('#start-time').val(result.frame.start_time);
                    $('#end-time').val(result.frame.end_time);
                }
            });
            resetErrors();
            $('#but-create-frame').css('display', 'none');
            $("#frm-frame input").prop("disabled", true);
            $('#modal-frame').show();
        });
        $('#but-create-frame').on('click', function() {
            $('#but-create-frame').text('Saving ...');
            $('#but-create-frame').prop('disabled', true);
            let form = $('#frm-frame')[0];
            let data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url:'{{ route("frame.store") }}',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result){
                    if (result.code == 422) {
                        resetErrors();
                        $('#but-create-frame').text('Save');
                        $('#but-create-frame').prop('disabled', false);
                        $('#err-name').text(result.errors.name);
                        $('#err-start-time').text(result.errors.start_time);
                        $('#err-end-time').text(result.errors.end_time);
                        for (let key in result.errors) {
                            $('input[name='+ key +']').addClass("is-invalid");
                        }
                    } else {
                        $('#modal-frame').hide(); 
                        location.reload();
                    }
                }
            })
        });
        $('.delete-frame').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('frame.delete') }}');
            let _this = $(this);
            let id = _this.data('id');
            $('#id-delete').val(id);
            $('#modal-delete').show();
        });
        $('#bulk-delete-frame').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('frame.delete') }}');
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
            $('#err-name').text('');
            $('#err-start-time').text('');
            $('#err-end-time').text('');
            $("#name").removeClass("is-invalid");
            $("#start-time").removeClass("is-invalid");
            $("#end-time").removeClass("is-invalid");
        }
    </script>
@endsection