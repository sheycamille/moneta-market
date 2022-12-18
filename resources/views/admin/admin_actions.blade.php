<!-- Reset user password Modal -->
<div id="resetpswdModal{{ $admin->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header ">

                <h4 class="modal-title ">Reset Password</strong></h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-3">
                <p class="">Are you sure you want to reset password
                    for
                    {{ $admin->firstName }} to <span class="text-primary font-weight-bolder">admin01236</span>
                </p>
                <a class="btn btn-danger" href="{{ route('adminresetadminpass', $admin->id) }}">Reset
                    Now</a>
            </div>
        </div>
    </div>
</div>
<!-- /Reset user password Modal -->

<!-- Delete user Modal -->
<div id="deleteModal{{ $admin->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title ">Delete Manager</strong></h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-3">
                <form action="{{ route('deladmin', $admin->id) }}" method="POST">
                    @csrf
                    <p class="">Are you sure you want to delete
                        {{ $admin->firstName }}</p>
                    <button class="btn btn-danger btn-sm">Yes, I'm sure</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete user Modal -->

<!-- Edit user Modal -->
<div id="edituser{{ $admin->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title ">Edit Admin</strong></h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form style="padding:3px;" role="form" method="post" action="{{ route('editadmin', $admin->id) }}">
                    <h5 class=" ">Firstname</h5>
                    <input style="padding:5px;" class="form-control " value="{{ $admin->firstName }}" type="text"
                        name="fname" required><br />
                    <h5 class=" ">Lastname</h5>
                    <input style="padding:5px;" class="form-control " value="{{ $admin->lastName }}" type="text"
                        name="l_name" required><br />
                    <h5 class=" ">Email</h5>
                    <input style="padding:5px;" class="form-control " value="{{ $admin->email }}" type="email"
                        name="email" required><br />
                    <h5 class=" ">Phone Number</h5>
                    <input style="padding:5px;" class="form-control " value="{{ $admin->phone }}" type="text"
                        name="phone" required>
                    <br>
                    <h5 class=" ">Type</h5>
                    <select class="form-control " name="type">
                        <option @if ($admin->type == 'Super Admin') selected @endif value="Super Admin">Super Admin
                        </option>
                        <option @if ($admin->type == 'Admin') selected @endif value="Admin">Admin</option>
                    </select><br>
                    <h5 class=" ">Roles</h5>
                    <select class="form-control" name="roles[]" multiple>
                        @foreach ($roles as $role)
                            <option @if ($admin->hasRole($role)) selected @endif value="{{ $role->id }}">
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ $admin->id }}">
                    <input type="submit" class="btn btn-info" value="Update account">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit user Modal -->

<!-- send a single user email Modal-->
<div id="sendmailModal{{ $admin->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">Send Email Message</h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p class="">This message will be sent to
                    {{ $admin->firstName }}
                    {{ $admin->lastName }} </p>
                <form role="form" method="post" action="{{ route('sendmail', $admin->id) }}">

                    <input type="hidden" name="id" value="{{ $admin->id }}">
                    <textarea class="form-control " name="message " row="3" placeholder="Type your message here" required></textarea><br />

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="Send">
                </form>
            </div>
        </div>
    </div>
</div>
