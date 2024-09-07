@include('layouts.app')
@include('layouts.sidebar')


<div class="content-wrapper">
    <div class="container-fluid">

    @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Profile Information -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">                        
                            
                            @if ($teacher->image)
                                <img src="{{ asset('images/' . $teacher->image) }}" alt="Profile Image" class="img-thumbnail" width="150" height="150">
                            @else
                            <img src="https://acmeindian.com/assets/images/logo/logo.jpg" alt="Profile Image" class="img-thumbnail" width="150" height="150">
                            @endif

                            <h5 class="card-title mt-3">{{ $teacher->name }}</h5>
                            <p class="card-text">Email: {{ $teacher->email }}</p>
                            <p class="card-text">Mobile No: {{ $teacher->mobile_no }}</p>
                            <p class="card-text">Status:
                                @if ($teacher->status == 1)
                                    Active
                                @elseif ($teacher->status == 0)
                                    Pending
                                @elseif ($teacher->status == 2)
                                    Blocked
                                @else
                                    Unknown
                                @endif
                            </p>
                            <p class="card-text">Role: {{ $teacher->role }}</p>
                        </div>
                    </div>
                </div>

                <!-- Change Password Form -->
                <div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Change Password</h5><br/>            
           
            <form method="POST" action="{{ route('change-password') }}">
                @csrf
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</div>

            </div>
        </div>
    </section>
</div>

@include('layouts.footer')

