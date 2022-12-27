@extends('layouts.app')

@section('title')
    Items
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Items') }} <form action="{{route('items.create')}}" class="d-inline"><button class="btn btn-sm btn-success">Create</button></form>
            </div>

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
                            <th scope="col">Category</th>
                            <th scope="col">Question</th>
                            <th scope="col">A</th>
                            <th scope="col">B</th>
                            <th scope="col">C</th>
                            <th scope="col">D</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Image</th>
                            <th scope="col">Active</th>
                            <th scope="row">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item => $result)
                          <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $result->category->name }}</td>
                            <td>{!! $result->question !!}</td>
                            <td>{!! $result->a !!}</td>
                            <td>{!! $result->b !!}</td>
                            <td>{!! $result->c !!}</td>
                            <td>{!! $result->d !!}</td>
                            <td>{!! $result->answer !!}</td>
                            <td class="w-25"><img src="{{ $result->image }}" class="img-thumbnail img-fluid"></td>
                            <td>{!! $result->active !!}</td>

                            <td>
                                <a href="{{route('items.edit', $result->id )}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt pe-1"></i>Edit</a>
                                <form action="{{route('items.delete', $result->id )}}" method="POST" class="d-inline">
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