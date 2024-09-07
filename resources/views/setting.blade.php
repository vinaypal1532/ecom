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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                          

                            <form method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="email">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $setting->title) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Sub Title </label>
                                    <input type="text" class="form-control" id="pan_card" name="pan_card" value="{{ old('pan_card', $setting->pan_card) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $setting->email) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="mobile_no">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $setting->mobile_no) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $setting->address) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                    @if ($setting->logo)
                                        <img src="{{ asset('images/' . $setting->logo) }}" alt="Logo" width="100">
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
