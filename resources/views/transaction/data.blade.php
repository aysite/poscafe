@extends ('layouts.template')

@section('title', $title)
@section('page-title', $page_title)

@section('content')

    {{-- Notification --}}
    @if (session('notif'))
        <div class="alert alert-{{ session('notif')['type'] }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('notif')['text'] }}
        </div>
    @endif
    {{-- End Notification --}}

    <div class="card">
        <div class="card-header bg-success">
            <div class="card-tools">
                <a class="btn btn-success btn-sm" href="{{ route('trans.create') }}"><i class="fas fa-plus"></i> Add New</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dtTrans" class="tbData table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No Trans</th>
                        <th>Tanggal</th>
                        <th>Cashier</th>
                        <th>Customer</th>
                        <th>Layanan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dtTrans as $rsTrans)
                        <tr>
                            <td>{{ $rsTrans->no_trans }}</td>
                            <td>{{ $rsTrans->tgl_trans }}</td>
                            <td>{{ $rsTrans->name }}</td>
                            <td>{{ $rsTrans->nm_customer }}</td>
                            <td>
                                {{ $rsTrans->id_table == 0 ? 'Take Away' : 'Dine In - ' . $rsTrans->no_table }}
                            <td>
                            <td>{{ number_format($rsTrans->gtotal_trans, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $status = ['Belum di Bayar', 'Proses', 'Finish', 'Cancel'];
                                    $color = ['warning', 'primary', 'success', 'danger'];
                                @endphp
                                <span
                                    class="badge bg-{{ $color[$rsTrans->status_trans] }}">{{ $status[$rsTrans->status_trans] }}</span>
                            </td>
                            <td class="text-center">
                                @if ($rsTrans->status_trans == 0 || $rsTrans->status_trans == 1)
                                    <a class="btn btn-danger btn-xs" href="{{ route('trans.status',['id_trans'=>$rsTrans->id,"status"=>3]) }}"><i class="fas fa-ban"></i></a>
                                @endif
                                
                                @if ($rsTrans->status_trans < 3)
                                    <a class="btn btn-primary btn-xs" href="{{ route('trans.cetak', $rsTrans->no_trans) }}"><i class="fas fa-print"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
