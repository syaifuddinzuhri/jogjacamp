@extends('main')

@section('content')
<div class="container">
    <div class="row my-5">
        @if (Session::has('success'))
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        </div>
        @endif
        <div class="col-md-6">
            <h1>Add New Category</h1>
            <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
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
                        <option value="1">Active</option>
                        <option value="0">Non-active</option>
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
        <div class="col-md-6">
            <h1>Search Category</h1>
            <form action="{{route('category.search')}}" method="GET">
                <div class="form-group">
                    <label for="keyqords">Keywords</label>
                    <input type="text" class="form-control @error('keywords') is-invalid @enderror" id="keywords" name="keywords">
                    @error('keywords')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-12">
            <h1>Data Categories</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Publish</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->isEmpty())
                        <tr>
                            <td colspan="4">Data is empty.</td>
                        </tr>
                        @else
                        @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ ($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</th>
                            <td>{{$item->name}}</td>
                            <td>
                                @if ($item->is_publish)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Non-active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $item->id)}}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{route('category.destroy', $item->id)}}" method="POST" class="d-inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @if (!$data->isEmpty())
                {{$data->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
