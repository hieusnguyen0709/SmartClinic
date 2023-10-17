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
                                <div class="d-flex frame">
                                    <div class="form-group col-4">
                                        <label>Frame</label>
                                        <select class="form-control frame-id" name="frame_id">
                                        </select>
                                        <div class="text-danger text-xs font-weight-bold mt-2 err-frame-id"></div>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Start Time</label>
                                        <input type="time" class="form-control start-time" placeholder="Start Time" name="start_time" disabled>
                                    </div>
                                    <div class="form-group col-3">
                                        <label>End Time</label>
                                        <input type="time" class="form-control end-time" placeholder="End Time" name="end_time" disabled>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="text-uppercase btn bg-gradient-danger mt-4 delete-frame"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="text-uppercase btn bg-gradient-success add-frame"><i class="fas fa-plus"></i></button>
                                </div>
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