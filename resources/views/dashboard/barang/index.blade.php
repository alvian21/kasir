@extends('dashboard.master')
@section('content')


  <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"  style="justify-content:center;">
          <h3 class="modal-title" id="exampleModalLabel">Edit Barang</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="editbrg">
                {{ method_field('POST') }}
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label for="kode_brg">Kode barang</label>
                  <input type="text" class="form-control" id="kode_brg" name="kode_edit" aria-describedby="emailHelp" placeholder="Kode Barang">
                </div>
                <div class="form-group">
                  <label for="nama_brg">Nama Barang</label>
                  <input type="text" class="form-control" id="nama_brg" name="nama_edit" >
                </div>
                <div class="form-group">
                    <label for="jml_brg">Jumlah Barang</label>
                    <input type="number" class="form-control" id="jml_brg" name="jml_edit">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info" id="savedit">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal + barang -->
  <div class="modal fade" id="modalbarang" tabindex="-1" role="dialog" aria-labelledby="modatmbhl" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header"  style="justify-content:center;">
              <h3 class="modal-title" id="modatmbhl">Tambah Barang</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="tambahbaru">
                    {{ method_field('POST') }}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="kode_barang">Kode barang</label>
                      <input type="text" class="form-control" name="kode_barang" aria-describedby="emailHelp" placeholder="Kode Barang">
                    </div>
                    <div class="form-group">
                      <label for="nama_barang">Nama Barang</label>
                      <input type="text" class="form-control" name="nama_barang">
                    </div>
                    <div class="form-group">
                        <label for="harga_barang">Harga Barang</label>
                        <input type="number" class="form-control" name="harga_barang">
                      </div>
                    <div class="form-group">
                        <label for="jml_barang">Jumlah Barang</label>
                        <input type="number" class="form-control" name="jml_barang">
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-info" id="savebarang">Save changes</button>
            </form>
            </div>
          </div>
        </div>
</div>



<div class="col">

    <div class="card shadow">
      <div class="card-header border-0">
        <div class="row">
            <div class="col-md-2">
                    <h3 class="text-black mb-0">List Barang</h3>
            </div>
            <div class="col-md-10">
                    <div class="col text-right">
                            <button type="button" class="btn btn-info" id="tmbarang" data-toggle="modal" data-target="#exampleModal">Tambah barang</button>
                    </div>
            </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Kode barang</th>
              <th scope="col">Nama</th>
              <th scope="col">Quantity</th>
              <th scope="col">Harga</th>
              <th scope="col">Keterangan</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody id="tabelbarang">
                <meta name="csrf-token" content="{{ csrf_token() }}">
          </tbody>
        </table>
      </div>

    </div>


</div>
@endsection

@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function(){
    fetch_data();

    function fetch_data(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $.ajax({
                url:"/admin/fetchdata",
                method:"POST",
                success:function(data)
                {
                    $('#tabelbarang').html(data);
                }
            });
        }


    $('#tmbarang').on('click',function(){
        $('#modalbarang').modal('show');
    } );

    $('#savebarang').on('click', function(){
        var formdata = $('#tambahbaru').serialize();

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ Route("tmbbarang") }}',
            method: 'POST',
            data: formdata,

            success:function(data){
                $('#tambahbaru')[0].reset();
                fetch_data();
                alert('data saved');
                $('#modalbarang').modal('hide');

            }
        });
    });

    $(document).on('click', '.delete', function(){
        var id = $(this).data('id');
        $clicked_btn = $(this);
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/admin/barang/delete',
                    type: 'GET',
                    data: {
                    'delete': 1,
                    'id': id,
                  },
                  success: function(response){
                    // remove the deleted comment
                    fetch_data();
                    console.log(response);
                    $clicked_btn.parent().remove();
                  }
                  });
            }
          })

    });


    $(document).on('click','.editdataku', function(){
        $('#modaledit').modal('show');
        var id = $(this).data('id');

        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function(){
            return $(this).text();
        }).get();

        // console.log(data);
        $('#id').val(data[0]);
        $('#kode_brg').val(data[1]);
        $('#nama_brg').val(data[2]);
        $('#jml_brg').val(data[3]);


        });

        $('#savedit').on('click', function(){
            var id = $('#id').val();
            var kode = $('#kode_brg').val();
            var nama = $('#nama_brg').val();
            var jml = $('#jml_brg').val();
            var formedit = $('#editbrg').serialize();
            // console.log(formedit);
            // console.log(id);
        $.ajax({
            url: '{{ route("editbarang") }}',
            method: 'POST',
            data: {
                    'edit':1,
                    'id':id,
                    'kode':kode,
                    'nama':nama,
                    'jml':jml
            },

            success:function(data){
                fetch_data();
                $('#modaledit').modal('hide');
                swal("Berhasil", "Data berhasil di update", "success");
            }

            });
    });
});

</script>


@endsection
