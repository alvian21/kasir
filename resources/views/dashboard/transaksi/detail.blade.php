@extends('dashboard.master')
@section('content')
<section class="card shadow page-content reports new-design">
        <div class="col-lg-12 content-wrapper">
            <div class="table-container list-table">
            <div class="report-title">
            <div class="table-responsive dragscroll">
            <table class="profit-loss report-table table" id="date-profit-lost">
            <thead class="report-header">
                <tr>
                    <th colspan="2">
                 Detail Transaksi
                    </th>
                <th></th>

                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="report-header report-subheader-noindent" colspan="4">
                <b>Tanggal : {{ $data->created_at }}</b>
                </td>
            </tr>

            <?php $x = json_decode($data->name ,true); ?>

            @foreach($x as $row)
            <tr>
                <td class="report-subtotal text-left regular-text data-col-half" colspan="2">
                    {{ $row["name"] }}
                </td>
                <td class="report-subtotal text-center"  style="padding-right:80px;" >
                        jumlah barang {{ $row["qty"] }} x {{ $row["price"] }}
                        </td>
                <td class="border-top-thin" style="padding-left:80px;">
                        {{ $row["result"] }}
                </td>
            </tr>

            @endforeach
                {{-- @if(!empty($x[1]))
                    <tr>
                        <td class="report-subtotal text-left regular-text data-col-half" colspan="2">
                                {{ $x[1]["name"] }}
                        </td>
                        <td class="report-subtotal text-center"  style="padding-right:80px;" >
                                jumlah barang {{ $x[1]["qty"] }} x {{ $x[1]["price"] }}
                        </td>
                        <td class="border-top-thin" style="padding-left:80px;">
                                {{ $x[1]["result"] }}
                    </td>
                    </tr>
                @else
                @endif

                @if(!empty($x[2]))
                <tr>
                        <td class="report-subtotal text-left regular-text data-col-half" colspan="2">
                                {{ $x[2]["name"] }}
                        </td>
                        <td class="report-subtotal text-center"  style="padding-right:80px;" >
                                jumlah barang {{ $x[2]["qty"] }} x {{ $x[2]["price"] }}
                        </td>
                        <td class="border-top-thin" style="padding-left:80px;">
                                {{ $x[2]["result"] }}
                    </td>
                    </tr>
                @else
                @endif --}}

                <tr>
                    <td class="report-subtotal text-left regular-text data-col-half" colspan="2">
                          Total
                    </td>
                    <td class="report-subtotal text-right" id="assets-type-1-total-data">

                    </td>
                    <td class="border-top-thin" style="padding-left:80px;">
                        {{ $data->total }}
                    </td>
            </tr>

            <tr>
                <td class="report-subtotal text-left regular-text data-col-half" colspan="2">
                   Diskon
                </td>
                <td class="report-subtotal text-right" id="assets-type-1-total-data">

                </td>
                <td class="border-top-thin" style="padding-left:80px;">
                    {{ $data->discount }}
                </td>
            </tr>
            <tr>
                <td class="report-subtotal text-left regular-text data-col-half" colspan="2">
                   Total setelah diskon
                </td>
                <td class="report-subtotal text-right" id="assets-type-1-total-data">

                </td>
                <td class="border-top-thin" style="padding-left:80px;">
                    {{ $data->afterdiscount }}
                </td>
            </tr>



                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
</section>
@endsection
