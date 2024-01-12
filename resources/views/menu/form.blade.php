@extends('layouts.template')

@section('title', $title)
@section('page-title', $page_title)

@section('content')
    {{-- Notification --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Terjadi Kesalahan ! Silahkan Periksa Inputan Anda !
        </div>
    @endif
    {{-- End Notification --}}

    {{-- Form --}}
    <form action="{{ $edit ? route('menu.update', $rsMenu->id) : route('menu.store') }} " method="post"
        enctype="multipart/form-data">
        @csrf
        @if ($edit)
            @method('PUT')
        @endif

        <div class="row">
            {{--  --}}
            <div class="col-md-4">
                <div class="card">
                    {{-- Title --}}
                    <div class="card-header bg-secondary">
                        <h4 class="card-title">Thumbnail</h4>
                    </div>
                    {{-- End Title --}}

                    {{-- Body --}}
                    <div class="card-body">
                        @if (@$rsMenu->foto_menu != '')
                        @else
                        @endif
                        <input class="d-none" type="file" name="file_foto" id="file_foto">
                        <input class="d-none" type="file" name="old_foto" id="old_foto"
                            value="{{ @$rsMenu->foto_menu }}">
                    </div>
                    {{-- End Body --}}
                </div>
            </div>
            {{--  --}}
            {{-- Class Card --}}
            <div class="col-md-8">
                <div class="card">
                    {{-- Title --}}
                    <div class="card-header bg-secondary">
                        <h4 class="card-title">{{ $edit ? 'Edit' : 'Add New' }} {{ $title }}</h4>
                    </div>
                    {{-- End Title --}}
                    {{-- Body --}}
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="kd_menu" class="form-label">Menu Code</label>
                            <input type="text" name="kd_menu" id="kd_menu"
                                class="form-control @error('kd_menu') is-invalid @enderror"
                                value="{{ @old('kd_menu') ? @old('kd_menu') : @$rsMenu->kd_menu }}">
                            @error('kd_menu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nm_menu" class="form-label">Menu Name</label>
                            <input type="text" name="nm_menu" id="nm_menu"
                                class="form-control @error('nm_menu') is-invalid @enderror"
                                value="{{ @old('nm_menu') ? @old('nm_menu') : @$rsMenu->nm_menu }}">
                            @error('nm_menu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_cat_menu" class="form-label">Category</label>
                                    <select name="id_cat_menu" id="id_cat_menu"
                                        class="form-control @error('id_cat_menu') is-invalid @enderror"
                                        value="{{ @old('id_cat_menu') ? @old('id_cat_menu') : @$rsMenu->id_cat_menu }}">
                                        <option value="">- Category -</option>
                                        @foreach ($dtCategory as $rsCategory)
                                            <option
                                                {{ @$rsMenu->id_cat_menu == $rsCategory->id || @old('id_cat_menu') == $rsCategory->id ? 'selected' : '' }}
                                                value="{{ $rsCategory->id }}">{{ $rsCategory->nm_category }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_cat_menu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_kitchen_menu" class="form-label">Kitchen</label>
                                    <select name="id_kitchen_menu" id="id_kitchen_menu"
                                        class="form-control @error('id_kitchen_menu') is-invalid @enderror"
                                        value="{{ @old('id_kitchen_menu') ? @old('id_kitchen_menu') : @$rsMenu->id_kitchen_menu }}">
                                        <option value="">- Kitchen -</option>
                                        @foreach ($dtKitchen as $rsKitchen)
                                            <option
                                                {{ @$rsMenu->id_kitchen_menu == $rsKitchen->id || @old('id_kitchen_menu') == $rsKitchen->id ? 'selected' : '' }}
                                                value="{{ $rsKitchen->id }}">{{ $rsKitchen->nm_kitchen }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kitchen_menu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="harga_menu" class="form-label">Price</label>
                                    <input type="number" name="harga_menu" id="harga_menu"
                                        class="form-control @error('harga_menu') is-invalid @enderror"
                                        value="{{ @old('harga_menu') ? @old('harga_menu') : @$rsMenu->harga_menu }}">
                                    @error('harga_menu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="satuan_menu" class="form-label">Unit</label>
                                    <input type="text" name="satuan_menu" id="satuan_menu"
                                        class="form-control @error('satuan_menu') is-invalid @enderror"
                                        value="{{ @old('satuan_menu') ? @old('satuan_menu') : @$rsMenu->satuan_menu }}">
                                    @error('satuan_menu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="stok_menu" class="form-label">Stock</label>
                            <select name="stok_menu" id="stok_menu"
                                class="form-control @error('stok_menu') is-invalid @enderror"
                                value="{{ @old('stok_menu') ? @old('stok_menu') : @$rsMenu->stok_menu }}">
                                <option {{ @$rsMenu->stok_menu == 'A' || @old('stok_menu') == 'A' ? 'selected' : '' }}
                                    value="A">Available</option>
                                <option {{ @$rsMenu->stok_menu == 'NA' || @old('stok_menu') == 'NA' ? 'selected' : '' }}
                                    value="NA">Unavailable</option>
                            </select>
                            @error('stok_menu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="desc_menu" class="form-label">Description</label>
                            <textarea name="desc_menu" id="desc_menu" class="form-control @error('desc_menu') is-invalid @enderror">{{ @old('desc_menu') ? @old('desc_menu') : @$rsMenu->desc_menu }}</textarea>
                            @error('desc_menu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="SAVE" class="btn btn-secondary btn-block">
                        </div>
                    </div>
                    {{-- End Body --}}
                </div>
            </div>
        </div>
    </form>
    {{-- End Form --}}
@endsection
