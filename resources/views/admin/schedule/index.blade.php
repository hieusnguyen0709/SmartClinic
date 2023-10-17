@extends('layouts.admin')
@section('content')
    <div class="container-fluid container m-auto row justify-content-md-center py-4">
        <div class="row">
            <div class="col-12">
                <div id="calendar" class="bg-white rounded px-4 pt-4">
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
                                $('.err-frame-id').text(result.errors.frame_id);
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
                $('.frame-id').html(result.frameList);
            }
        });
    });
    $('.frame-id').change(function() {
        let frameId = $(this).val();
        let startTime = $(this).closest('div.frame').find('.start-time');
        let endTime = $(this).closest('div.frame').find('.end-time');

        if (frameId === '') {
            startTime.val('');
            endTime.val('');
        } else {
            $.ajax({
                type: 'GET',
                url: '{{ route('schedule.change.frame') }}',
                data: {
                    'frame_id': frameId
                },
                success: function(result) {
                    startTime.val(result.frame.start_time);  
                    endTime.val(result.frame.end_time);                
                }
            });
        }
    });
    function resetErrors() {
            $('#err-doctor-id').text('');
            $('.err-frame-id').text('');
            $("#doctor-id").removeClass("is-invalid");
            $(".frame-id").removeClass("is-invalid");
        }
</script>
@endsection