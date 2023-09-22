<!-- Modal -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-center text-uppercase">
                            <h2 class="font-weight-bolder text-primary text-gradient modal-title">Warning</h2>
                            <p class="mb-5">Would you like to delete?</p>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left" action="" method="post" id="frm-delete">
                                @csrf
                                <input type="hidden" name="id_delete" id="id-delete" value="">
                                <div class="text-center">
                                    <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded" id="but-cancel-delete" data-bs-dismiss="modal">No</button>
                                    <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded" id="but-confirm-delete">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->