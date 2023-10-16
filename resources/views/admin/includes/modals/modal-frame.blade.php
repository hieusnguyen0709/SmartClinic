<!-- Modal -->
    <div class="modal fade" id="modal-frame" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient modal-title"></h3>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left" action="{{ route('frame.store') }}" id="frm-frame" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name" id="name">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-name"></div>
                                </div>
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <input type="time" class="form-control" placeholder="Start Time" name="start_time" id="start-time">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-start-time"></div>
                                </div>
                                <div class="form-group">
                                    <label>End Time</label>
                                    <input type="time" class="form-control" placeholder="End Time" name="end_time" id="end-time">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-end-time"></div>
                                </div>
                                <input type="hidden" name="id" id="id" value="">
                                <div class="text-center">
                                    <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0" id="but-create-frame">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->