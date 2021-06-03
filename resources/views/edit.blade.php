@extends('main')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-md-6">
            <h1>Add New Category</h1>
            <form action="{{route('category.update', $data->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$data->name}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="is_publish">Publish</label>
                    <select class="form-control @error('is_publish') is-invalid @enderror" name="is_publish" id="is_publish">
                        <option selected disabled hidden>-- Choose publish --</option>
                        <option value="1" {{$data->is_publish == 1 ? 'selected' : ''}}>Active</option>
                        <option value="0" {{$data->is_publish == 0 ? 'selected' : ''}}>Non-active</option>
                    </select>
                    @error('is_publish')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>
</div>
@endsection
