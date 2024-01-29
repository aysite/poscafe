@extends ('layouts.blank')

@section('title', 'Transactions')

@section('content')
    <div id="transaksi">
        <div class="row" class="m-0">
            <div id="menu" class="col-md-8 p-0">
                <div class="card">
                    <div class="card-header bg-olive">
                        <h4 class="card-title">CASHIER : ARDI YOTO</h4>
                        <div class="card-tools">
                            <a href="{{ url('/') }}"><i class="fas fa-home text-light"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($dtMenu as $rsMenu)
                                <div class="menu-item col-sm-3">
                                    <div class="position-relative">
                                        @if ($rsMenu->foto_menu)
                                            <img src="{{ asset('uploads/menu/' . $rsMenu->foto_menu) }}" alt="Photo 1"
                                                class="img-fluid">
                                        @else
                                            <img src="{{ asset('img/no-menu-image.png') }}" alt="Photo 1"
                                                class="img-fluid">
                                        @endif
                                        @if ($rsMenu->stok_menu == 'NA')
                                            <div class="ribbon-wrapper ribbon-lg">
                                                <div class="ribbon bg-danger">
                                                    Unavailable
                                                </div>
                                            </div>
                                        @endif
                                        <div class="detail-menu-item">
                                            <h5>{{ $rsMenu->nm_menu }}</h5>
                                            <p class="text-danger">Rp {{ number_format($rsMenu->harga_menu, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div id="detail" class="col-md-4">
                <div class="card">
                    <div class="card-header bg-olive">
                        <h4 class="card-title">
                            #ORD-HDY78SV98
                        </h4>
                    </div>
                    <div class="card-body p-0">
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-7"><strong>Fahrizal Saputra</strong></div>
                                    <div class="col-md-5 text-right"><strong>Meja#MN01</strong></div>
                                </div>
                            </li>
                        </ol>
                        <div class="detail-order">
                            <h5 class="bg-secondary">ORDER LIST</h5>
                            <ul class="order-list list-group list-group-flush">
                                <li class="order-list-item list-group-item">
                                    <h6 class="nm_menu">Nasi Goreng Hongkong</h6>
                                    <div class="input-group qty_menu">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-olive btn-minus"><i class="fas fa-minus"></i></span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Number of Menu">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-olive btn-plus"><i class="fas fa-plus"></i></span>
                                        </div>
                                    </div>
                                    <span class="price_menu badge text-danger">30.000</span>
                                </li>
                                <li class="order-list-item list-group-item">
                                    <h6 class="nm_menu">Cumi Crispy</h6>
                                    <div class="input-group qty_menu">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-olive btn-minus"><i class="fas fa-minus"></i></span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Number of Menu">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-olive btn-plus"><i class="fas fa-plus"></i></span>
                                        </div>
                                    </div>
                                    <span class="price_menu badge text-danger">20.000</span>
                                </li>
                                <li class="order-list-item list-group-item">
                                    <h6 class="nm_menu">Es Teh Lemon</h6>
                                    <div class="input-group qty_menu">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-olive btn-minus"><i class="fas fa-minus"></i></span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Number of Menu">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-olive btn-plus"><i class="fas fa-plus"></i></span>
                                        </div>
                                    </div>
                                    <span class="price_menu badge text-danger">17.000</span>
                                </li>
                                <li class="order-list-item list-group-item">
                                    <h6 class="nm_menu">Es Teh Lemon</h6>
                                    <div class="input-group qty_menu">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-olive btn-minus"><i class="fas fa-minus"></i></span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Number of Menu">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-olive btn-plus"><i class="fas fa-plus"></i></span>
                                        </div>
                                    </div>
                                    <span class="price_menu badge text-danger">17.000</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-7"><strong>Total</strong></div>
                                    <div class="col-md-5 text-right">25.000</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-7"><strong>Diskon</strong></div>
                                    <div class="col-md-5 text-right">5.000</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-7"><strong>Tax (11%)</strong></div>
                                    <div class="col-md-5 text-right">1.500</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <h4 class="text-center">21.500</h4>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn bg-olive btn-block">SIMPAN</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-warning btn-block">PRINT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
