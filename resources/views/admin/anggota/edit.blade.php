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
<section class="content">

    <!-- Default box -->

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
                        <label for="nama">Nama @yield('title')</label>
                        <input type="text" name="nama" id="nama"
                            class="form-control @error('nama') is-invalid @enderror" placeholder=""
                            value="{{$datas->nama}}" required>
                        @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-12 col-12">
                        <label>Tipe Anggota<code>*)</code></label>
                        <select class="form-control form-control-lg" required name="tipe">  
                            @if ($datas->tipe)
                            <option>{{$datas->tipe}}</option>                        
                            @endif
                            <option>Siswa</option>
                            <option>Umum</option>
                        </select>
                    </div> 

                    <div class="form-group col-md-12 col-12">
                        <label for="nomeridentitas">Nomer Identitas / NIS / KTP / SIM</label>
                        <input type="text" name="nomeridentitas" id="nomeridentitas"
                            class="form-control @error('nomeridentitas') is-invalid @enderror" placeholder=""
                            value="{{$datas->nomeridentitas}}" required>
                        @error('nomeridentitas')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6 col-6">
                        <label for="tempatlahir">Tempat Lahir <code>*)</code></label>
                        <input type="text" name="tempatlahir" id="tempatlahir" class="form-control @error('tempatlahir') is-invalid @enderror" value="{{$datas->tempatlahir}}" required>
                        @error('tempatlahir')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 col-6">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgllahir" @error('tgllahir') is-invalid @enderror" value="{{$datas->tgllahir}}" >
                        @error('tgllahir')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6 col-6">
                        <label>Jenis Kelamin <code>*)</code></label>
                        <select class="form-control form-control-lg" required name="jk">
                        @if ($datas->jk)
                        <option>{{$datas->jk}}</option>                        
                        @endif
                        
                        
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>

                    
                    <div class="form-group col-md-6 col-6">
                        <label for="telp">Telp <code>*)</code></label>
                        <input type="text" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" value="{{$datas->telp}}" required>
                        @error('telp')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-6">
                        <label>Agama <code>*)</code></label>
                        <select class="form-control form-control-lg" required name="agama"> 
                        @if ($datas->agama)
                        <option>{{$datas->agama}}</option>                        
                        @endif
                        <option>Islam</option>
                        <option>Kristen</option>
                        <option>Katholik</option>
                        <option>Hindu</option>
                        <option>Budha</option>
                        <option>Konghucu</option>
                        <option>Lain-lain</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6 col-6">
                        <label for="alamat">Alamat <code>*)</code></label>
                        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{$datas->alamat}}" required>
                        @error('alamat')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-12 col-12">
                        <label for="sekolahasal">Sekolah Asal</label>
                        <input type="text" name="sekolahasal" id="sekolahasal"
                            class="form-control @error('sekolahasal') is-invalid @enderror" placeholder=""
                            value="{{$datas->sekolahasal}}" required>
                        @error('sekolahasal')<div class="invalid-feedback"> {{$message}}</div>
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
                
            </div>
            <!-- /.card-body -->

        </div>
    </div>
    <!-- /.card -->

    </div>

</section>
<!-- /.content -->
@endsection
