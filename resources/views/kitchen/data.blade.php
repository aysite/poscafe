@extends('layouts.template')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Notification --}}
    @if (session('notif'))
        <div class="alert alert-{{ session('notif')['type'] }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('notif')['text'] }}
        </div>
    @endif
    {{-- End Notification --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                {{-- Card Header --}}
                <div class="card-header bg-secondary">
                    <h4 class="card-title"><strong>{{ $edit ? 'Edit' : 'Add New' }}</strong> : {{ $title }}</h4>
                </div>
                {{-- End Card Header --}}

                {{-- Card Body --}}
                <div class="card-body">
                    <form action="{{ $edit ? route('kitchen.update', $rsKitchen->id) : route('kitchen.store') }} "
                        method="post">
                        @csrf
                        @if ($edit)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="nm_kitchen" class="form-label">Kitchen Name</label>
                            <input type="text" name="nm_kitchen" id="nm_kitchen"
                                class="form-control @error('nm_kitchen') is-invalid @enderror"
                                value="{{ @old('nm_kitchen') ? @old('nm_kitchen') : @$rsCategory->nm_kitchen }}">
                            @error('nm_kitchen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="SAVE" class="btn btn-secondary btn-block">
                        </div>
                    </form>
                </div>
                {{-- End Card Body --}}
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                {{-- Card Header --}}
                <div class="card-header bg-secondary">
                    <div class="card-tools">
                        <a class="btn btn-secondary btn-sm" href="{{ route('kitchen.index') }}"><i class="fas fa-plus"></i>
                            Add New</a>
                    </div>
                </div>
                {{-- End Card Header --}}

                {{-- Card Body 2 --}}
                <div class="card-body">
                    <table id="dtKitchen" class="tbData table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kitchen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dtKitchen as $rsKitchen)
                                <tr>
                                    <td>{{ $rsKitchen->id }}</td>
                                    <td>{{ $rsKitchen->nm_kitchen }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('kitchen.destroy', $rsKitchen->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-secondary btn-xs"
                                                href="{{ route('kitchen.edit', $rsKitchen->id) }}"><i
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
                {{-- End Card Body 2 --}}
            </div>
        </div>
    </div>
@endsection
