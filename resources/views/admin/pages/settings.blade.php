@extends('layouts.layout1')
{{-- @extends('admin.pages.beranda') --}}


@section('title','Pengaturan')
@section('linkpages')
data{{ $pages }}
@endsection
@section('halaman','kelas')

@section('csshere')
@endsection

@section('jshere')
@endsection


@section('notif')

@if (session('tipe'))
@php
$tipe=session('tipe');
@endphp
@else
@php
$tipe='light';
@endphp
@endif

@if (session('icon'))
@php
$icon=session('icon');
@endphp
@else
@php
$icon='far fa-lightbulb';
@endphp
@endif

@php
$message=session('status');
@endphp
@if (session('status'))
<x-alert tipe="{{ $tipe }}" message="{{ $message }}" icon="{{ $icon }}" />

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
<!-- Main content -->
<section class="content">
  <div class="container-fluid">

      <!-- Default box -->

      <div class="col-12 col-md-12 col-lg-12">
          <div class="card">

              <div class="card-body">


                  <form action="/admin/{{ $pages }}/1" method="post">
                      @method('put')
                      @csrf
                      <div class="card-header">
                          <span class="btn btn-icon btn-light"><i class="fas fa-feather"></i> Pengaturan
                              Aplikasi</span>
                      </div>
                      <div class="card-body">
                          <div class="row">

                              <div class="form-group col-md-6 col-6">
                                  <label for="aplikasijudul">Judul Aplikasi</label>
                                  <input type="text" name="aplikasijudul" id="nama"
                                      class="form-control @error('nama') is-invalid @enderror" placeholder=""
                                      value="{{ Fungsi::aplikasijudul() }}" required>
                                  @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                  @enderror
                              </div>

                              <div class="form-group col-md-6 col-6">
                                  <label for="aplikasijudulsingkat">Nama Aplikasi Singkat</label>
                                  <input type="text" name="aplikasijudulsingkat" id="aplikasijudulsingkat"
                                      class="form-control @error('aplikasijudulsingkat') is-invalid @enderror"
                                      placeholder="" value="{{ Fungsi::aplikasijudulsingkat() }}" required>
                                  @error('aplikasijudulsingkat')<div class="invalid-feedback"> {{$message}}</div>
                                  @enderror
                              </div>


                              <div class="form-group col-md-6 col-6">
                                  <label for="paginationjml">Pagination</label>
                                  <input type="number" name="paginationjml" id="paginationjml"
                                      class="form-control @error('paginationjml') is-invalid @enderror" placeholder=""
                                      value="{{ Fungsi::paginationjml() }}" required min="3" max="50">
                                  @error('paginationjml')<div class="invalid-feedback"> {{$message}}</div>
                                  @enderror
                              </div>
                              
                              <div class="form-group col-md-6 col-6">
                                <label for="passdefaultadmin">Password Admin Default</label>
                                <input type="text" name="passdefaultadmin" id="passdefaultadmin"
                                    class="form-control @error('passdefaultadmin') is-invalid @enderror"
                                    placeholder="" value="{{ Fungsi::passdefaultadmin() }}" required>
                                @error('passdefaultadmin')<div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>

                            
                            <div class="form-group col-md-6 col-6">
                              <label for="passdefaultpegawai">Password Pustakawan Default</label>
                              <input type="text" name="passdefaultpegawai" id="passdefaultpegawai"
                                  class="form-control @error('passdefaultpegawai') is-invalid @enderror"
                                  placeholder="" value="{{ Fungsi::passdefaultpegawai() }}" required>
                              @error('passdefaultpegawai')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror
                          </div>

                          
                            
                          <div class="form-group col-md-6 col-6">
                            <label for="sekolahttd"> Nama Tanda tangan 1</label>
                            <input type="text" name="sekolahttd" id="sekolahttd"
                                class="form-control @error('sekolahttd') is-invalid @enderror"
                                placeholder="" value="{{ Fungsi::sekolahttd() }}" required>
                            @error('sekolahttd')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>
                         
                        <div class="form-group col-md-6 col-6">
                          <label for="defaultdenda"> Denda Terlambat /perhari</label>
                          <input type="text" name="defaultdenda" id="defaultdenda"
                              class="form-control @error('defaultdenda') is-invalid @enderror"
                              placeholder="" value="{{ Fungsi::defaultdenda() }}" required>
                          @error('defaultdenda')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror
                      </div>

                       
                      <div class="form-group col-md-6 col-6">
                        <label for="defaultminbayar">Minimal Nominal Pembayaran</label>
                        <input type="text" name="defaultminbayar" id="defaultminbayar"
                            class="form-control @error('defaultminbayar') is-invalid @enderror"
                            placeholder="" value="{{ Fungsi::defaultminbayar() }}" required min="1">
                        @error('defaultminbayar')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    
                    <div class="form-group col-md-6 col-6">
                      <label for="defaultmaxbukupinjam">Jumlah Maximal Buku dipinjam</label>
                      <input type="text" name="defaultmaxbukupinjam" id="defaultmaxbukupinjam"
                          class="form-control @error('defaultmaxbukupinjam') is-invalid @enderror"
                          placeholder="" value="{{ Fungsi::defaultmaxbukupinjam() }}" required min="1">
                      @error('defaultmaxbukupinjam')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror
                  </div>
                    
                    <div class="form-group col-md-6 col-6">
                      <label for="defaultmaxharipinjam">Jumlah Maximal Hari Peminjaman</label>
                      <input type="text" name="defaultmaxharipinjam" id="defaultmaxharipinjam"
                          class="form-control @error('defaultmaxharipinjam') is-invalid @enderror"
                          placeholder="" value="{{ Fungsi::defaultmaxharipinjam() }}" required min="1">
                      @error('defaultmaxharipinjam')<div class="invalid-feedback"> {{$message}}</div>
                      @enderror
                  </div>

                          </div>


                      </div>



                      <div class="card-header">
                          <span class="btn btn-icon btn-light"><i class="fas fa-feather"></i> Pengaturan
                              Sekolah</span>
                      </div>
                      <div class="card-body">
                          <div class="row">
                              <div class="form-group col-md-6 col-6">
                                  <label for="sekolahnama">Nama Sekolah @yield('title')</label>
                                  <input type="text" name="sekolahnama" id="sekolahnama"
                                      class="form-control @error('sekolahnama') is-invalid @enderror" placeholder=""
                                      value="{{ Fungsi::sekolahnama() }}" required>
                                  @error('sekolahnama')<div class="invalid-feedback"> {{$message}}</div>
                                  @enderror
                              </div>

                              <div class="form-group col-md-6 col-6">
                                  <label for="sekolahalamat">Alamat Sekolah</label>
                                  <input type="text" name="sekolahalamat" id="sekolahalamat"
                                      class="form-control @error('sekolahalamat') is-invalid @enderror" placeholder=""
                                      value="{{ Fungsi::sekolahalamat() }}" required>
                                  @error('sekolahalamat')<div class="invalid-feedback"> {{$message}}</div>
                                  @enderror
                              </div>

                              <div class="form-group col-md-6 col-6">
                                  <label for="sekolahtelp">No Telp Sekolah</label>
                                  <input type="text" name="sekolahtelp" id="sekolahtelp"
                                      class="form-control @error('sekolahtelp') is-invalid @enderror" placeholder=""
                                      value="{{ Fungsi::sekolahtelp() }}" required>
                                  @error('sekolahtelp')<div class="invalid-feedback"> {{$message}}</div>
                                  @enderror
                              </div>

                          </div>


                          <div class=" text-right">

                            <a href="{{ route('admin.'.$pages) }}" class="btn btn-icon btn-dark ml-3"> <i
                                    class="fas fa-backward"></i> Batal</a>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                      </div>

                      </div>
                    </div>
                    
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">

            <div class="card-body">
                      <div class="card-body">


                          <form action="/admin/{{ $pages }}/1}" method="post">
                              @method('put')
                              @csrf
                              <div class="card-header">
                                  <span class="btn btn-icon btn-light"><i class="fas fa-feather"></i> Data Seeder
                                      dan Reset</span>
                              </div>
                              <div class="card-body">
                                  <div class="row">
                                      <div class="form-group col-md-6 col-6">
                                       
                                      </div>
                                     

                                  </div>


                                  <div class="row">
                                      <div class="form-group mb-0 col-12">
                                          <div class="custom-control custom-checkbox">
                                              <input type="checkbox" name="remember" class="custom-control-input"
                                                  id="newsletter">


                                          </div>
                                      </div>
                                  </div>
                              </div>

                      </div>
              </div>
          </div>
      </div>
    </section>

@endsection
