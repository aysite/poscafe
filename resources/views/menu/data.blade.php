@extends('layouts.template')

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
        {{-- Card Header --}}
        <div class="card-header bg-secondary">
            <div class="card-tools">
                <a class="btn btn-secondary btn-sm" href="{{ route('menu.create') }}"><i class="fas fa-plus"></i>Add
                    New</a>
            </div>
        </div>
        {{-- End Card Header --}}

        {{-- Card Body --}}
        <div class="card-body">
            <table id="dtMenu" class="tbData table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Menu</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dtMenu as $rsMenu)
                        <tr>
                            <td>
                                @if (@$rsMenu->foto_menu!="")
                                    <img id="foto_menu" class="thumbnail-small" src="{{ asset('uploads/menu/'.@$rsMenu->foto_menu) }}" alt="{{ @$rsMenu->nm_menu }}">
                                @else
                                    <img id="foto_menu" class="thumbnail-small" src="{{ asset('img/no-menu-image.png') }}" alt="{{ @$rsMenu->nm_menu }}">
                                @endif
                            </td>
                            <td>
                                <strong>{{ $rsMenu->nm_menu }} - {{ $rsMenu->kd_menu }}</strong>
                                <br>
                                {{ $rsMenu->desc_menu }}
                                <br/>
                                <strong>Kategori : </strong> {{ $rsMenu->category->nm_category }}
                                <br/>
                                <strong>Dapur : </strong> {{ $rsMenu->kitchen->nm_kitchen }}
                            </td>
                            <td>{{ number_format($rsMenu->harga_menu,0,',',',') }} / {{ $rsMenu->satuan_menu }}</td>
                            <td>{{ $rsMenu->stok_menu == "A" ? "Available" : "Unavailable" }}</td>
                            <td class="text-center">
                                <form action="{{ route('menu.destroy', $rsMenu->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-warning btn-xs" href="{{ route('menu.edit', $rsMenu->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger btn-xs"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- End Card Body --}}
    </div>
@endsection
