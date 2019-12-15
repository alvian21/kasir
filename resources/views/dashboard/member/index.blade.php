@extends('dashboard.master')
@section('content')

  <div class="modal fade" id="modaleditmember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"  style="justify-content:center;">
          <h3 class="modal-title" id="exampleModalLabel">Edit Barang</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="editmbr">
                {{ method_field('POST') }}
                <input type="hidden" name="id" id="id">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label for="nama_mbr">Nama Member</label>
                  <input type="text" class="form-control" id="nama_mbr" name="nama_mbr" aria-describedby="emailHelp" placeholder="Kode Barang">
                </div>
                <div class="form-group">
                  <label for="email_mbr">Email Member</label>
                  <input type="text" class="form-control" id="email_mbr" name="email_mbr" >
                </div>
                <div class="form-group">
                    <label for="nomer_mbr">Nomer Hp</label>
                    <input type="number" class="form-control" id="nomer_mbr" name="nomer_mbr">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info" id="saveeditmbr">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal + member -->
  <div class="modal fade" id="modalmember" tabindex="-1" role="dialog" aria-labelledby="modatmbhl" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header"  style="justify-content:center;">
              <h3 class="modal-title" id="modatmbhl">Tambah Member</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="tambahbaru">
                    {{ method_field('POST') }}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="nama">Nama Member</label>
                      <input type="text" class="form-control" name="nama" aria-describedby="emailHelp" placeholder="Nama Member">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" placeholder="Email Member">
                    </div>
                    <div class="form-group">
                        <label for="nomerhp">Nomer Hp</label>
                        <input type="number" class="form-control" name="nomerhp" placeholder="Nomer Hp">
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-info" id="savemember">Simpan</button>
            </form>
            </div>
          </div>
        </div>
</div>



<div class="col">

    <div class="card bg-default shadow">
      <div class="card-header bg-transparent border-0">
        <div class="row">
            <div class="col-md-2">
                    <h3 class="text-white mb-0">List Member</h3>
            </div>
            <div class="col-md-10">
                    <div class="col text-right">
                            <button type="button" class="btn btn-info" id="tmbmember" data-toggle="modal" data-target="#exampleModal">Tambah Member</button>
                    </div>
            </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-dark table-flush">
          <thead  class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Nomer hp</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody id="tabelmember">
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
                url:"{{ Route('member.fetch') }}",
                method:"POST",
                success:function(data)
                {
                    $('#tabelmember').html(data);
                }
            });
        }
    $('#tmbmember').on('click', function(){
        $('#modalmember').modal('show');
    });

    $('#savemember').on('click', function(){
        var formdata = $('#tambahbaru').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ Route("member.store") }}',
            method: 'POST',
            data: formdata,
            success:function(reseponse){
                $('#tambahbaru')[0].reset();
                $('#modalmember').modal('hide');
                alert('data saved');
                fetch_data();
            }
        });
    });

   $(document).on('click','.deletemember', function(){
            var id = $(this).attr('data-id');

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
                url: '{{ Route("member.delete") }}',
                method: 'GET',
                data: {
                    'delete':1,
                    'id':id
                },
                success:function(response){
                    fetch_data();
                }
            });
            }

   });
});

    $(document).on('click','.editmember', function(){
        $('#modaleditmember').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children('td').map(function(){
            return $(this).text();
        }).get();
        $('#id').val(data[1]);
        $('#nama_mbr').val(data[2]);
        $('#email_mbr').val(data[3]);
        $('#nomer_mbr').val(data[4]);
    });

    $('#saveeditmbr').on('click', function(){
        var id = $('#id').val();
        var nama = $('#nama_mbr').val();
        var email = $('#email_mbr').val();
        var nomer = $('#nomer_mbr').val();
        $.ajax({
            url:'{{ Route("member.edit") }}',
            method: 'POST',
            data: {
                'id':id,
                'nama':nama,
                'email':email,
                'phone_number':nomer,
            },

            success:function(response){
                fetch_data();
                $('#modaleditmember').modal('hide');
                alert('data has been update');
            },
            error: function(error){
               alert(error);
            }

        });
    });
});
</script>




@endsection
