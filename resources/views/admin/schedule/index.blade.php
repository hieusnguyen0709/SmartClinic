@extends('layouts.admin')
@section('content')
    <div class="container-fluid container m-auto row justify-content-md-center py-4">
        <div class="row">
            <div class="col-10">
                <div id="calendar" class="bg-white rounded px-4 pt-4">
                </div>
            </div>
            <div class="col-2">
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
                $('#modal-schedule').find('.modal-title').text('Add Schedule');
                $('#modal-schedule').modal('toggle');
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
            }
        });
    });
    $(window).on('load', function() {
        resetErrors();
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
    
    function resetErrors() {
        $('#err-doctor-id').text('');
        $('#err-frame-ids').text('');
        $("#doctor-id").removeClass("is-invalid");
    }
</script>
@endsection