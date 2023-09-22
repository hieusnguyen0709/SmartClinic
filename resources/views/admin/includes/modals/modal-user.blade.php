<!-- Modal -->
    <div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient modal-title">Add user</h3>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left" action="{{ route('user.store') }}" method="post" id="frm-user">
                                @csrf
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" id="role-id" name="role_id">
                                        <option>----</option>
                                        <option>Admin</option>
                                        <option>User</option>
                                    </select>
                                </div>
                                <label>Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Name" name="name" id="name">
                                </div>
                                <label>Email</label>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                                </div>
                                <label>Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                </div>
                                <label>Confirm Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm-password">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option>----</option>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                </div>
                                <label>Phone</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone">
                                </div>
                                <label>Age</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Name" name="age" id="age">
                                </div>
                                <label>Address</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Name" name="address" id="address">
                                </div>
                                <label>Avatar</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" placeholder="Name" name="avatar" id="avatar">
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