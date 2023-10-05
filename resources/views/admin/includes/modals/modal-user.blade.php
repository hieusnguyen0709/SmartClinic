<!-- Modal -->
    <div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient modal-title"></h3>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left" action="{{ route('user.store') }}" id="frm-user" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" id="role-id" name="role_id">
                                    </select>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-role-id"></div>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name" id="name">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-name"></div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-email"></div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-password"></div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm-password">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-confirm-password"></div>
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">----</option>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-gender"></div>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-phone"></div>
                                </div>
                                <div class="form-group">
                                    <label>Age</label>
                                    <input type="text" class="form-control" placeholder="Age" name="age" id="age">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-age"></div>
                                </div>           
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Address" name="address" id="address">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-address"></div>
                                </div>                               
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <input type="file" class="form-control" placeholder="Avatar" name="avatar" id="avatar">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-avatar"></div>
                                </div>
                                <input type="hidden" name="id" id="id" value="">
                                <div class="text-center">
                                    <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0" id="but-create-user">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->