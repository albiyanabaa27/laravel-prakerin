@extends('layouts.app')
@section('content')
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                <h5 class="card-header"><i class="la la-check-square"> {{$artikel->judul}}</i> | {{$artikel->user->name}}
                </h5>
                <div class="card-body">
                    <img src="{{asset('assets/img/artikel/'.$artikel->foto.'')}}" 
                                     style="width:400px; height:325px;" alt="foto"
                                     class="card-img img-fluid mb-4">
                <p>{!! $artikel->konten !!}</p>
                <br>
                <p>
                    Kategori :
                <button class="btn btn-sm btn-floating btn-info">{{$artikel->kategori->nama_kategori}}</button>
                </p>
                <p>
                    Tag :
                    @foreach ($artikel->tag as $data)
                    <button class="btn btn-sm btn-floating btn-default">{{$data->nama_tag}}</button>        
                    @endforeach
                </p>
                <p>
                    Tanggal : {{$artikel->created_at->format('d M Y, H:i:s')}} WIB
                </p>
                <p>
                    <a href="#"
                    class="btn btn-outline btn-rounded btn-info">
                    <i class="la la-paper-plane"></i>Lihat Artikel
                    </a>
                </p>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection