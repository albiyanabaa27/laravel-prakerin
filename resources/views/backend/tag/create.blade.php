@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Membuat Data Tag</div>
                <div class="card-body">
                    <form action="{{ route('tag.store') }}" method="post">
                        {{ csrf_field() }}

    <div class="form-group">
        <label for="">Tag</label>
        <input class="form-control" type="text" name="nama_tag">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-outline-info">
        Simpan Data
        </button>
    </div>
    <div class="form-group">
        <a href="{{ url('admin/tag') }}" class="btn btn-outline-info">Kembali</a>
    </div>
        </form>
            </div>
                </div>
                    </div>
                        </div>
                            </div>
                                @endsection