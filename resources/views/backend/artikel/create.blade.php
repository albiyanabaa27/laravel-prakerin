@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <script src="{{ asset('backend/assets/js/components/select2-init.js')}}"></script>
    <script src="{{ asset('backend/assets/vendor/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('editorl');

    $(document).ready(function () {
        $('#select2').select2();
    })
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
            <form action="{{route('artikel.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="">Judul</label>
                    <input type="text" class="form-control {{ $errors->has('judul') ? ' is-invalid' : '' }}" value="{{ old('judul') }}" name="judul" required>
                    @if ($errors->has('judul'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('judul') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Foto</label>
                        <input type="file" name="foto">  
                </div> 
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select class="form-control {{ $errors->has('id_kategori') ? ' is-invalid' : '' }}" name="id_kategori">
                        @foreach ($kategori as $data)
                        <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
                        @endforeach    
                    </select>
                    @if ($errors->has('id_kategori'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('id_kategori') }}</strong>
                        </span>
                        @endif
                </div>
                <div class="form-group">
                        <label for="">Tag</label>
                        <select name="tag[]" class="form-control {{ $errors->has('tag') ? ' is-invalid' : '' }}" id="s2_demo3" multiple="multiple">
                            @foreach ($tag as $data)
                        <option value="{{ $data->id }}"> {{ $data->nama_tag}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('tag'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tag') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="from-group">
                    <label from="">konten</label>
                    <textarea name="konten" id="texteditor" class="form-control" cols="30" rows="10"></textarea>
                    @if ($errors->has('konten'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('konten') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <button type ="submit" class="btn btn-primary btn-floating" data-qt-block="body">Simpan</button>
                    
                </div>
                </form>
                     </div> 
                </div>
            </div>
        </div>
    </div>
     @endsection
