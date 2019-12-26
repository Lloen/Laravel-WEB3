<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update your profile!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>    
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif

        <div class="flex-center position-ref full-height">

            <div class="content">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="userInputName" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="emailInputName" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" class="form-control" id="userInputAvatar" name="avatar" value="{{ $user->avatar }}">
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>