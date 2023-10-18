<!-- Modal -->
    <div class="modal fade" id="modal-schedule" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient modal-title"></h3>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left" action="" id="frm-schedule" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Doctor</label>
                                    <select class="form-control" id="doctor-id" name="doctor_id">
                                    </select>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-doctor-id"></div>
                                </div>
                                <div class="frame">
                                    <div class="d-flex frame-header">
                                        <div class="form-group col-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check-all-frame">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Frame</label>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>Start Time</label>
                                        </div>
                                        <div class="form-group col-3">
                                            <label>End Time</label>
                                        </div>
                                    </div>
                                    <div class="d-flex frame-body">
                                        <div class="form-group col-1">
                                            <div class="form-check">
                                                <input class="form-check-input frame-id" type="checkbox" value="">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <input type="text" class="form-control frame-name" value="" disabled>
                                        </div>
                                        <div class="form-group col-3">
                                            <input type="time" class="form-control frame-start-time" value="" disabled>
                                        </div>
                                        <div class="form-group col-3">
                                            <input type="time" class="form-control frame-end-time" value="" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-danger text-xs font-weight-bold mt-2" id="err-frame-ids"></div>
                                <input type="hidden" name="frame_ids" id="frame-ids" value="">
                                <input type="hidden" name="id" id="id" value="">
                                <div class="text-center">
                                    <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0" id="but-create-schedule">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->