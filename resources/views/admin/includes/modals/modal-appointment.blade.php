<!-- Modal -->
<div class="modal fade" id="modal-appointment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient modal-title"></h3>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left" action="{{ route('appointment.store') }}" id="frm-appointment" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Patient</label>
                                    <select class="form-control" id="patient-id" name="patient_id">
                                    </select>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-patient-id"></div>
                                </div>
                                <div class="form-group">
                                    <label>Doctor</label>
                                    <select class="form-control" id="doctor-id" name="doctor_id">
                                    </select>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-doctor-id"></div>
                                </div>
                                <div class="form-group">
                                    <label>Date Time</label>
                                    <input type="datetime-local" class="form-control" placeholder="Date Time" name="date_time" id="date-time">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-date-time"></div>
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" type="text" placeholder="Note" name="note" id="note" rows="10"></textarea>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-note"></div>
                                </div>
                                <input type="hidden" name="id" id="id" value="">
                                <div class="text-center">
                                    <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0" id="but-create-appointment">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->