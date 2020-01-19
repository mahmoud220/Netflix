@extends('layouts.dashboard.app')
@section('content')
<h2>Categories</h2>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Categories</li>
          {{-- <li class="breadcrumb-item active">Data</li> --}}
        </ol>
      </nav>

      <div class="tile mb-4">
      <div class="row">
          <div class="col-12">
              <form action="">
                  <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                        <input type="text" name="search" autofocus class="form-control" placeholder="search" value="{{ request()->search }}">
                        </div>
                      </div>
                      <div class="col-4">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                      <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                      </div>
                  </div>
              </form>
          </div>
      </div>


      <div class="row">
          <div class="col-md-12">
              @if($categories->count() > 0)
              <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index=>$category)
                    <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                    <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <form method="post" action="{{ route('dashboard.categories.destroy', $category->id) }}" style="display:inline-block">
                      @csrf
                      @method('delete')

                      <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Delete</button>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->appends(request()->query())->links() }}
            @else
            <h3 style="font-weight:400;">Sorry! No Records Found</h3>
              @endif
          </div>
      </div>
    </div>
@endsection
