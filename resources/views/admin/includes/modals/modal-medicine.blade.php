<!-- Modal -->
    <div class="modal fade" id="modal-medicine" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient modal-title"></h3>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left" action="{{ route('medicine.store') }}" id="frm-medicine" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name" id="name">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-name"></div>
                                </div>
                                <div class="form-group select-category-tree">
                                    <label>Category</label>
                                    <input type="hidden" name="category_id" id="category-id" value="">
                                    <div class="dropdown" id="dropdown-parent-category">
                                    </div>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-category-id"></div>
                                </div>
                                <div class="form-group">
                                    <label>Instruction</label>
                                    <textarea type="text" class="form-control" placeholder="Instruction" name="instruction" id="instruction" rows="10"></textarea>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-instruction"></div>
                                </div>
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="form-control" id="unit" name="unit">
                                        <option>----</option>
                                        <option value="0">Bottle</option>
                                        <option value="1">Tube</option>
                                        <option value="2">Pill</option>
                                    </select>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-unit"></div>
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" class="form-control" placeholder="Quantity" name="quantity" id="quantity">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-quantity"></div>
                                </div>
                                <input type="hidden" name="id" id="id" value="">
                                <div class="text-center">
                                    <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0" id="but-create-medicine">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->