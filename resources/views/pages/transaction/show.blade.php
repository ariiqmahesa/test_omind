<table class="table table-bordered">
    <tr>
        <th>Nama</th>
    <td>{{ $items->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
    <td>{{ $items->email }}</td>
    </tr>
    <tr>
        <th>Nomor</th>
    <td>{{ $items->number }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
    <td>{{ $items->address }}</td>
    </tr>
    <tr>
        <th>Total Transaksi</th>
    <td>{{ $items->transaction_total }}</td>
    </tr>
    <tr>
        <th>Status Transaksi</th>
    <td>{{ $items->transcation_status }}</td>
    </tr>
    <tr>
        <th>Pembelian Produk</th>
    <td>
        <table class="table table-bordered  w-100">
            <tr>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Harga</th>
            </tr>
            @foreach ($items->details as $detail)
            <tr>
            <th>{{ $detail->product->name }}</th>
            <th>{{ $detail->product->type }}</th>
            <th>${{ $detail->product->price }}</th>
            </tr>    
            @endforeach
        </table>
    </td>
    </tr>
</table>
{{--
<div class="row">
<div class="col-4">
<a href="{{ route('transaction.status'.$item->id) }}?status=SUCCESS" class="btn btn-success btn-block">
     <i class="fa fa-check"></i> Set Sukses
</a>
</div>
<div class="col-4">
    <a href="{{ route('transaction.status'.$item->id) }}?status=FAILED" class="btn btn-warning btn-block">
         <i class="fa fa-check"></i> Set Gagal
    </a>
    </div>
    <div class="col-4">
        <a href="{{ route('transaction.status'.$item->id) }}?status=PENDING" class="btn btn-info btn-block">
             <i class="fa fa-check"></i> Set Pending
        </a>
        </div>
</div>
--}}