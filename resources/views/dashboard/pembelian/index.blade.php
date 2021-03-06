@extends('dashboard.master')
@section('content')
<div class="row">

    <div class="col-xl-12 order-xl-1">
      <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Pembelian</h3>
            </div>

          </div>
        </div>
        <div class="card-body">
        <form  id="formpembelian">
            {{ method_field('POST') }}
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <h6 class="heading-small text-muted mb-4">Sistem pembayaran</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="boot-multiselect-demo">Pilih Barang</label>
                    <select id="action"  class="custom-select my-1 mr-sm-2 action" multiple="multiple" name="name[]" id="pilihbrg" >
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            {{-- <option value="pilihbrg" >Pilih Barang</option> --}}
                        @foreach($data as $row)
                        @if($row->qty >0)
                        <option value="{{ $row->id }}" >{{ $row->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <br>

                  </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group focused">
                      <label class="form-control-label" for="boot-multiselect-demo">Punya Member</label>
                      <select class="custom-select my-1 mr-sm-2 action" id="havemember" >
                              {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
                              <option value="no" >Tidak Punya</option>
                        @foreach ($member as $mbr )
                        <option value="{{ $mbr->id }}" >{{ $mbr->kode }} - {{ $mbr->name }}</option>
                        @endforeach


                      </select>

                    </div>
                  </div>
                <div class="col-lg-3">
                  <div class="form-group focused" id="fetchitung">

                  </div>


                </div>
              </div>
            </div>
            <hr class="my-4">
            <!-- Address -->
            {{-- <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-address">Alamat</label>
                    <input id="input-address" name="location_informations[address]" class="form-control form-control-alternative" placeholder="Home Address"  type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-city">Kota</label>
                    <input type="text" id="input-city" name="location_informations[city]" class="form-control form-control-alternative" placeholder="City">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-country">Negara</label>
                    <input type="text" id="input-country" name="location_informations[country]" class="form-control form-control-alternative" placeholder="Country" >
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="input-country">Kode Postal</label>
                    <input type="number" id="input-postal-code" name="location_informations[code]" class="form-control form-control-alternative" placeholder="Postal code">
                  </div>
                </div>
              </div>
            </div> --}}
            <div  style=" display: flex; align-items: center; justify-content: center;">
                <button name="submit" type="button" class="btn btn-info hitung" data-id="hitung">Hitung</button>
        </div>
          </form>
        </div>
      </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalhitung" tabindex="-1" role="dialog" aria-labelledby="modalhitungLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-body" >
            <div class="col-lg-12 content-wrapper">
                <div class="table-container list-table">
                <div class="report-title">
                <table class="profit-loss report-table table" id="date-profit-lost">
                <thead class="report-header">
                    <tr>
                        <th colspan="2">
                     Detail Transaksi
                        </th>
                    <th></th>

                    </tr>
                </thead>
                <tbody id="modalshow">


                </tbody>
            </table>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <form id="hasiluang">
                         <input type="number" id="uang" name="uang" min="0" class="form-control form-control-alternative" placeholder="Jumlah Uang">
                        </form>
                    </div>

                </div>
                <br>
                <table class="profit-loss report-table table" id="date-profit-lost">
                    <thead class="report-header">
                        <tbody>
                            <tr>
                                <td class="report-subtotal text-left regular-text data-col-half" >
                                Kembalian
                                </td>
                                <td class="report-subtotal text-right" id="assets-type-1-total-data">

                                </td>
                                <td class="border-top-thin" id="kembalian" style="padding-left:200px;" >

                                </td>
                            </tr>
                        </tbody>
                    </thead>
                </table>
            </div>


        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info" id="savehasil">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script>
   $(document).ready(function() {
    $('.action').select2();

    $('.action').change(function(){
        var first = $(this).find('option').first().val();
        var data = $('#action').val();

         $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
     $.ajax({
        url: '{{ Route("beli.fetch") }}',
        method: 'POST',
        data: {
            'data':data,

        },

        success:function(data){

            $('#fetchitung').html(data);
        }
     });

    });


    $(document).on('click','.hitung', function(){
        var none = $(this).find('option:selected').length;
        var values = [];
      $("div input[name='datahitung']").each(function() {
           values.push($(this).val());
      });

      var member = $('#havemember').val();
      var uang = $('#uang').val();
      var name = $(this).attr('data-id');

      console.log(member);
      var id = [];
      $("div input[name='datahitung']").each(function() {
           id.push($(this).attr('data-id'));
      });
     var data = {'id':id, 'data':values};
     var newarray = [],thing;

        for(var y = 0; y < values.length; y++){
            thing = {};
            thing[id[y]] = values[y];
            newarray.push(thing);
        }
        console.log(newarray);


        if($('#pilihbrg').val()==""){
            swal("Error", "Pilih barang yg mau dibeli", "error");
        }else if($('#datahitung').val()==""){
            swal("Error", "Silahkan masukkan jumlah barangnya", "error");
        }else{
            $.ajax({
            url: '{{ Route("beli.hitung") }}',
            method: 'POST',
            data: {'data':newarray,
                    'name':name,
                    'member':member,
                    'uang':uang,
            },
            success:function(response){
                $('#formpembelian')[0].reset();
                // $('#fetchitung')[0].reset();
                $('#modalhitung').modal('show');
                $('#modalshow').html(response);

                // swal(response);


            }
      });
        }
    });


    $('#uang').on('keyup', function(){
            var uang = $('#uang').val();
            var id = $('#iddata').val();
            $.ajax({
                url:'/admin/pembelian/post',
                method:'POST',
                data:{'savehasil':1,'id':id,'uang':uang},
                success:function(data){
                  $('#kembalian').text(data);
                }
            });
    });


    $('#savehasil').on('click', function(){
        var id = $('#iddata').val();
        var back = $('#kembalian').text();
        var money = $('#uang').val();
        $.ajax({
                url:'/admin/pembelian/savemoney',
                method:'POST',
                data:{'savemoney':1,'id':id,'uang':money,'back':back},
                success:function(data){

                    $('#modalhitung').modal('hide');
                    $('#hasiluang')[0].reset();
                }
            });
    });
});
</script>
@endsection
