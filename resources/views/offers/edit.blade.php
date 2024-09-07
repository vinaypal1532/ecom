@include('layouts.app')
@include('layouts.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Offer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Offer</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <form action="{{ route('offers.update', $offer->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $offer->title }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $offer->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="product" {{ $offer->type == 'product' ? 'selected' : '' }}>Product</option>
                                        <option value="festival" {{ $offer->type == 'festival' ? 'selected' : '' }}>Festival</option>
                                        <option value="season" {{ $offer->type == 'season' ? 'selected' : '' }}>Season</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="discount_percentage">Discount Percentage</label>
                                    <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" value="{{ $offer->discount_percentage }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $offer->start_date }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $offer->end_date }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active" {{ $offer->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $offer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Offer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>      
        </div>      
    </section>
</div>

@include('layouts.footer')
