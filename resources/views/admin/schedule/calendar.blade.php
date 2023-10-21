@extends('layouts.admin')
@section('content')
    <div class="container-fluid container m-auto row justify-content-md-center py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                             <div class="w-50">
                                <h5>Schedules</h5>
                                <button class="text-uppercase btn bg-gradient-primary" onclick="location.href='{{ route('schedule.index') }}'">Index&nbsp;&nbsp;<i class="fas fa-table"></i></button>
                            </div>                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <div id="calendar" class="bg-white rounded px-4 pt-4">
                </div>
            </div>
            <div class="col-3">
                <div class="bg-white rounded border border-dark px-4 pt-4">
                    <img src="{{ asset('assets/admin/img/default-avatar.png') }}" class="avatar avatar-lx me-3">
                    <label for="example-text-input" class="form-control-label">Doctor A</label>
                    <label for="example-text-input" class="form-control-label">Morning</label>
                    <label for="example-text-input" class="form-control-label">07:00</label>
                    <label for="example-text-input" class="form-control-label">11:00</label>
                </div>
                <div class="bg-white rounded px-4 border border-dark pt-4 mt-2">
                    <img src="{{ asset('assets/admin/img/default-avatar.png') }}" class="avatar avatar-lx me-3">
                    <label for="example-text-input" class="form-control-label">Doctor B</label>
                    <label for="example-text-input" class="form-control-label">Noon</label>
                    <label for="example-text-input" class="form-control-label">13:00</label>
                    <label for="example-text-input" class="form-control-label">17:00</label>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.includes.modals.modal-schedule')
@include('admin.includes.modals.modal-delete')
@section('scripts')
<script>
    $(document).ready(function() {
        let events = @json($events);

        $('#calendar').fullCalendar({
            header: {
                left: 'prev, next today',
                center: 'title',
                right: 'month, agendaWeek, agendaDay'
            },
            events: events,
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDays) {
                $('#modal-schedule').modal('toggle');
                $('#modal-schedule').find('.modal-title').text('Add Schedule');
                $('#but-create-schedule').on('click', function() {
                    $('#but-create-schedule').text('Saving ...');
                    $('#but-create-schedule').prop('disabled', true);
                    storeSchedule(null, moment(start).format('YYYY-MM-DD'), moment(end).subtract(1, 'days').format('YYYY-MM-DD'));
                });
            },
            editable: true,
            eventDrop: function(event) {
                storeSchedule(event.id, moment(event.start).format('YYYY-MM-DD'), moment(event.end).format('YYYY-MM-DD'));
            },
            eventClick: function(event){
                deleteSchedule(event.id);
            },
            selectAllow: function(event)
            {
                // return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
            },
        });
    });
    $("#modal-schedule").on("hidden.bs.modal", function() {
        $('#but-create-schedule').off('click');
    });
    function storeSchedule(id = null, start_date = null, end_date = null) {
        $('#frm-schedule').find('#id').val(id);
        $('#frm-schedule').find('#start-date').val(start_date);
        $('#frm-schedule').find('#end-date').val(end_date);
        $('#frm-schedule').find('#color').val(getRandomColor());
        let form = $('#frm-schedule')[0];
        let data = new FormData(form);
        let url;
        if (id) {
            url = '{{ route("schedule.update.calendar") }}';
        } else {
            url = '{{ route("schedule.store") }}';
        }
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: url,
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
                    if (id !== null) {
                        swal("Successfully!", "Schedule Updated!", "success");
                    } else {
                        $('#modal-schedule').hide(); 
                        location.reload();
                    }
                }
            }
        })
    }
    function deleteSchedule(id = null) {
        $('#modal-delete').modal('toggle');
        $('#frm-delete').attr('action', '{{ route('schedule.delete') }}');
        $('#frm-delete').find('#id-delete').val(id);
    }
    $(window).on('load', function() {
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
    });
    function resetErrors() {
        $('#err-doctor-id').text('');
        $('#err-frame-ids').text('');
        $("#doctor-id").removeClass("is-invalid");
    }

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
</script>
@endsection