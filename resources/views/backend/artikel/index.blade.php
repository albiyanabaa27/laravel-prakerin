@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Halaman Artikel Berita</div>
                <br>
                <center><a href="{{ route('artikel.create') }}" class="btn btn-primary">Tambah Data</a></center>
                    <br>
                    <div class="table-responsive">
                    <table id="bs4-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Slug</th>
                                <th>Kategori</th>
                                <th>Tag</th>
                                <th>Penulis</th>
                                <th>Foto</th>
                                <th colspan="3" style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($artikel as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->judul}}</td>
                                <td>{{ $data->slug}}</td>
                                <td>{{ $data->kategori->nama_kategori}}</td>
                                <td>
                                        <ol>
                                            @foreach ($data->tag as $tag)
                                                <li>{{ $tag->nama_tag }}</li>
                                            @endforeach
                                        </ol>
                                </td>
                                <td>{{ $data->user->name}}</td>
                                <td>
                                <img src="{{asset('assets/img/artikel/'.$data->foto.'')}}" 
                                     style="width:100px; height:100px;" alt="foto"
                                     class="card-img img-fluid mb-4">
                                </td>

                                    <td>
                                    <form action="{{ route('artikel.destroy',$data->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{route('artikel.edit',$data->id)}}" class="btn btn-md btn-warning btn-floating" >Edit</a>
                                        <button type="submit" class="btn btn-md btn-danger btn-floating" data-qt-block="body" >Delete</button>
                                        <a href="{{route('artikel.show',$data->id)}}" class="btn btn-md btn-success btn-floating" >Show</a>
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
@endsection
