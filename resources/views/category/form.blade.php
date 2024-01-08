@extends('layouts.template')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            {{-- Notification --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Terjadi Kesalahan ! Silahkan Periksa Inputan Anda !
                </div>
            @endif
            {{-- End Notification --}}

            <div class="card">
                {{-- Card Header --}}
                <div class="card-header bg-secondary">
                    <h4 class="card-title">{{ $edit ? 'Edit' : 'Add New' }} {{ $title }}</h4>
                </div>
                {{-- End Card Header --}}

                {{-- Card Body --}}
                <div class="card-body">
                    <form action="{{ $edit ? route('category.update', $rsCategory->id) : route('category.store') }} "
                        method="post">
                        @csrf
                        @if ($edit)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="nm_category" class="form-label">Category Name</label>
                            <input type="text" name="nm_category" id="nm_category"
                                class="form-control @error('nm_category') is-invalid @enderror"
                                value="{{ @old('nm_category') ? @old('nm_category') : @$rsCategory->nm_category }}">
                            @error('nm_category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="icon_category" class="form-label">Icon</label>
                            <input type="text" name="icon_category" id="icon_category" class="form-control"
                                value="{{ @$rsCategory->icon_category }}">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="SAVE" class="btn btn-secondary btn-block">
                        </div>
                    </form>
                </div>
                {{-- End Card Body --}}
            </div>
        </div>
    </div>
@endsection
