
            <div class="form-group col-md-12 col-12 mt-1 text-right">
              <button type="button" class="btn btn-icon btn-primary btn-sm" data-toggle="modal" data-target="#importExcel"><i class="fas fa-upload"></i>
                Import 
              </button>
              <a href="/admin/@yield('linkpages')/export" type="submit" value="Import" class="btn btn-icon btn-primary btn-sm"><span
                    class="pcoded-micon"> <i class="fas fa-download"></i> Export </span></a>
              </div>
{{-- @yield('datatable') --}}
{{-- {{ dd($datas) }} --}}      

    <div class="card-body -mt-5">
        <div class="table-responsive">
            <table class="table table-bordered table-md">
                @yield('headtable')
                @yield('bodytable')
            
            </table>
        </div>
        <div class="card-footer text-right">
                @yield('foottable')
        </div>