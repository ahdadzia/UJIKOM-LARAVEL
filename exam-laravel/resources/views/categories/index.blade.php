@extends('layouts.app')

@section('title')
    Categories
@endsection

@section('js')
<script>
    $(function(){
        $('input[name="name"]').on('keyup', function(){
            let Text = $(this).val();

            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');

            $('input[name="slug"]').val(Text);
        })
    })
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories') }} <form action="{{route('categories.create')}}" class="d-inline"><button class="btn btn-sm btn-success">Create</button></form></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="row">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($category as $item)
                          <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{!! $item->slug !!}</td>

                            <td>
                                <a href="{{route('categories.edit', $item->id)}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt pe-1"></i>Edit</a>
                                <form action="{{route('categories.delete', $item->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt pe-1">Delete</i>
                                    </button>
                                </form>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection