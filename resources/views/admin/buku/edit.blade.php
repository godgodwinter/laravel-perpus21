@extends('layouts.layout1')
{{-- @extends('admin.pages.beranda') --}}


@section('title','Rak Buku')
@section('linkpages')
data{{ $pages }}
@endsection
@section('halaman','kelas')

@section('csshere')
@endsection

@section('jshere')
@endsection


@section('notif')


@php
$tipe=session('tipe');
$message=session('status');
@endphp
        @if (session('status'))
        <script>
            $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            
            Toast.fire({
                icon: '{{$tipe}}',
                title: '{{$message}}'
                });
            });
        </script>
@endif
@endsection


{{-- DATATABLE --}}
@section('headtable')
@endsection

@section('bodytable')
@endsection

@section('foottable')

@endsection

@section('container')
<!-- Main content -->
<section class="content">


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@yield('title')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->

    <!-- Default box -->

    <div class="card-body">
        <div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
           
            <div class="card-body">

  
                <form action="/admin/{{ $pages }}/{{$datas->id}}" method="post">
                    @method('put')
                    @csrf
            <div class="card-header">
                <span class="btn btn-icon btn-light"><i class="fas fa-feather"></i> EDIT</span>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-12 col-12">
                      <label for="nama">Judul Buku</label>
                      <input type="text" name="nama" id="nama"
                          class="form-control @error('nama') is-invalid @enderror" placeholder=""
                          value="{{$datas->nama}}" required>
                      @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror
                  </div>
                  
                  <div class="form-group col-md-12 col-12">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit"
                        class="form-control @error('penerbit') is-invalid @enderror" placeholder=""
                        value="{{$datas->penerbit}}" required>
                    @error('penerbit')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                </div>
                <div class="form-group col-md-12 col-12">
                    <label for="tahunterbit">Tanggal Terbit</label>
                    <input type="text" name="tahunterbit" id="tahunterbit"
                        class="form-control @error('tahunterbit') is-invalid @enderror" placeholder=""
                        value="{{$datas->tahunterbit}}" required>
                    @error('tahunterbit')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                </div>
                
                <div class="form-group col-md-12 col-12">
                    <label for="isbn">ISBN </label>
                    <input type="text" name="isbn" id="isbn"
                        class="form-control @error('isbn') is-invalid @enderror" placeholder=""
                        value="{{$datas->isbn}}" >
                    @error('isbn')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                </div>
                
                <div class="form-group col-md-12 col-12">
                    <label for="bahasa">Bahasa</label>
                    <input type="text" name="bahasa" id="bahasa"
                        class="form-control @error('bahasa') is-invalid @enderror" placeholder=""
                        value="{{$datas->bahasa}}" required>
                    @error('bahasa')<div class="invalid-feedback"> {{$message}}</div>
                    @enderror
                </div>
                 
                  {{-- <div class="form-group col-md-12 col-12">
                      <label>Tempat Rak Buku <code>*)</code></label>
                      <select class="form-control form-control-lg" required name="bukurak_nama">  
                          @if ($datas->bukurak_nama)
                          <option>{{$datas->bukurak_nama}}</option>                        
                          @endif
                      @foreach ($bukurak as $t)
                          <option>{{ $t->nama }}</option>
                      @endforeach
                      </select>
                  </div>  --}}

                  
                  <div class="form-group col-md-12 col-12">
                      <label>DDC / Kategori Buku <code>*)</code></label>
                      <select class="form-control form-control-lg" required name="bukukategori_nama">  
                          @if ($datas->bukukategori_nama)
                          <option value="{{$datas->bukukategori_nama}}">{{$datas->bukukategori_ddc}} / {{$datas->bukukategori_nama}}</option>                        
                          @endif
                      @foreach ($bukukategori as $t)
                          <option value="{{ $t->nama }}">{{ $t->kode }} / {{ $t->nama }}</option>
                      @endforeach
                      </select>
                  </div> 
                  
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Kode Buku</span>
                      </div>
                      <input type="number" name="kode" id="kode"
                      class="form-control @error('kode') is-invalid @enderror" placeholder="Otomatis di antara DDC"
                      value="{{$datas->kode}}" required min="1" readonly>
                  @error('kode')<div class="invalid-feedback"> {{$message}}</div>
                  @enderror


              </div>

                </div>
             
           
            </div>
            <div class=" text-right">
                
              <a href="{{ route('admin.'.$pages) }}" class="btn btn-icon btn-dark ml-3"> <i class="fas fa-backward"></i> Batal</a>
              <button class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
                <!-- /.card-body -->

    <!-- /.card -->


</section>
<!-- /.content -->
@endsection
