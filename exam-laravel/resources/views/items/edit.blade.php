@extends('layouts.app')

@section('title')
    Edit | Items
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
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
                <div class="card-header">{{ __('Edit | Items') }}</div>
                <div class="card-body">
                    <form action="{{ route('items.update', $items->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">

                                    <div class="mb-3">
                                        {{-- <div class="mb-2 @error('name') text-danger fw-bold @enderror">Categories:</div>
                                        <input type="text" name="name" value="{{old('name')}}" placeholder="Name" class="form-control @error('name') text-danger is-invalid @enderror">
                                        @error('name')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror --}}

                                        <select class="form-control @error('category_id') text-danger is-invalid @enderror" name="category_id" id="category_id">
                                            <option holder>Pilih Kategori</option>
                                            @foreach ($category as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                        
                                        @error('category_id')
                                        <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                        
                                    </div>
                                    {{-- @dump($serviceCategories) --}}

                                    <div class="mb-3">
                                        <div class="mb-2 @error('question') text-danger fw-bold @enderror">Question:</div>
                                        <textarea placeholder="question" name="question" class="form-control
                                        @error('question') text-danger is-invalid @enderror">
                                        {{-- {{$about->description}} --}}
                                        </textarea>
                                        @error('question')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 @error('a') text-danger fw-bold @enderror">A:</div>
                                        <textarea placeholder="a" name="a" class="form-control
                                        @error('a') text-danger is-invalid @enderror">
                                        {{-- {{$about->description}} --}}
                                        </textarea>
                                        @error('a')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 @error('b') text-danger fw-bold @enderror">B:</div>
                                        <textarea placeholder="b" name="b" class="form-control
                                        @error('b') text-danger is-invalid @enderror">
                                        {{-- {{$about->description}} --}}
                                        </textarea>
                                        @error('b')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 @error('c') text-danger fw-bold @enderror">C:</div>
                                        <textarea placeholder="c" name="c" class="form-control
                                        @error('c') text-danger is-invalid @enderror">
                                        {{-- {{$about->description}} --}}
                                        </textarea>
                                        @error('c')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 @error('d') text-danger fw-bold @enderror">D:</div>
                                        <textarea placeholder="d" name="d" class="form-control
                                        @error('d') text-danger is-invalid @enderror">
                                        {{-- {{$about->description}} --}}
                                        </textarea>
                                        @error('d')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 @error('image') text-danger fw-bold @enderror">Image:</div>
                                    
                                        <input type="file" class="form-control" name="image" id="image">
                                        <img src="" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview" alt="">
                                        @error('image')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 @error('answer') text-danger fw-bold @enderror">Answer:</div>
                                        <select name="answer" id="answer">
                                            <option holder>Pilih Jawaban</option>
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="c">C</option>
                                            <option value="d">D</option>
                                        </select>
                                        {{-- <input type="text" name="answer" value="{{old('answer')}}" placeholder="answer" class="form-control @error('answer') text-danger is-invalid @enderror"> --}}
                                        @error('answer')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 @error('active') text-danger fw-bold @enderror">Active:</div>
                                        <select name="active" id="ansactivewer">
                                            <option holder>Apakah Soal Aktif?</option>
                                            <option value="true">Aktif</option>
                                            <option value="false">Tidak Aktif</option>
                                        </select>
                                        {{-- <input type="text" name="answer" value="{{old('answer')}}" placeholder="answer" class="form-control @error('answer') text-danger is-invalid @enderror"> --}}
                                        @error('active')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>

                                    {{-- <div class="mb-3">
                                        <div class="mb-2 @error('description') text-danger fw-bold @enderror">Description:</div>
                                    
                                        <textarea placeholder="description" name="description" class="form-control
                                        @error('description') text-danger is-invalid @enderror">
                                        {{$about->description}}
                                        </textarea>
                                        @error('description')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div> --}}
                                    <button class="btn btn-dark">Update</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection