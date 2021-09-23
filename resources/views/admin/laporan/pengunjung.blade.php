@extends('layouts.layout1')



@section('title','Anggota')
@section('linkpages')
data{{ $pages }}
@endsection
@section('halaman','kelas')

@section('csshere')
@endsection

@section('jshere')
<script>
    $(function () {
      $('.select2').select2()
    });
</script>
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

@section('container')

<section class="content-header">
    <div class="container-fluid">
      <h2 class="text-center display-4">Laporan Pengunjung</h2>
    </div>
    <!-- /.container-fluid -->
  </section>

    <section class="content">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group ">
                                    <input type="text" class="form-control form-control search" placeholder="Type your keywords here" name="cari"  id="cari" autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn btn-default search">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    @php
                                        if(old('bln')!=null){
                                            $bln=old('bln');
                                        }else{
                                            $bln=date('Y-m');
                                        }

                                    @endphp 
                                    <input type="month" name="bln" id="bln"
                                        class="form-control  search" placeholder=""
                                        value="{{$bln}}" required>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        </div>
                    </div>
                </div>
            
            <script>
                $(document).ready(function(){

                //  fetch_customer_data();
                cari = $("input[name=cari]").val();
                bln = $("input[name=bln]").val();

                 function fetch_customer_data(query = '')
                 {
                  $.ajax({
                   url:"{{ route('admin.laporan.pengunjungapi') }}",
                   method:'GET',
                   data:{
                            "_token": "{{ csrf_token() }}",
                            cari: cari,
                            bln: bln,
                        },
                   dataType:'json',
                   success:function(data)
                   {
                       $('#tampil').html(data.show);
                        // console.log($('#tampil').html(data.datas);
                        // console.log(data.datas);
                    // $('tbody').html(data.table_data);
                    // $('#total_records').text(data.total_data);
                   }
                  })
                 }

                 $(document).on('keyup', '.search', function(){
                cari = $("input[name=cari]").val();
                bln = $("input[name=bln]").val();
                        // console.log(cari);
                  var query = $(this).val();
                  fetch_customer_data(query);
                 });

                 
                 $(document).on('change', '#bln', function(){
                cari = $("input[name=cari]").val();
                bln = $("input[name=bln]").val();
                        // console.log(cari);
                  var query = $(this).val();
                  fetch_customer_data(query);
                 });
                //  $("button#clear").click(function(){
                     
                //     //  alert('');
                //      $("input[name=cari]").val('');
                //  });
                });
                </script>
              <!-- Default box -->
      <div class="card col-md-10 offset-md-1">
        <div class="card-header" id="jmldata">
            <label>Jumlah : 0 Pengunjung</label>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Nama
                      </th>
                      <th style="width: 30%">
                          Identitas
                      </th>
                      <th>
                          Tanggal Berkunjung
                      </th>
                      <th style="width: 8%" class="text-center">
                          Tipe
                      </th>
                     
                  </tr>
              </thead>
              <tbody id="tampil">
                  {{-- {{dd($datas)}} --}}
                  @foreach ($datas as $data)
                      
                  <tr>
                      <td>
                         {{$loop->index+1}}
                      </td>
                      <td>
                          <a>
                              {{$data->nama}}
                          </a>
                          {{-- <br/> --}}
                          {{-- <small>
                              Created 01.01.2019
                          </small> --}}
                      </td>
                      <td>
                        {{$data->nomeridentitas}}
                      </td>
                      <td class="project_progress">
                          {{-- <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                              </div>
                          </div> --}}
                          <small>
                             {{Fungsi::tanggalindo($data->tgl)}}
                          </small>
                      </td>
                      <td class="project-state">
                          @php
                           
                          @endphp           
                          <span class="badge badge-success">{{$data->tipe}}</span>
                      </td>
                     
                  </tr>
                  @endforeach
                 
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

        </div>

        
    </section>
    @endsection