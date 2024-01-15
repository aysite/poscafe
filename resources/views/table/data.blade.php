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
            <h4 class="card-title">LIST</h4>
            <div class="card-tools">
                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-meja"
                    onclick="setFormTable('Add New')"><i class="fas fa-plus"></i>Add
                    New</button>
            </div>
        </div>
        {{-- End Card Header --}}

        {{-- Card Body --}}
        <div class="card-body">
            <div class="row">
                @foreach ($dtTable as $rsTable)
                    <div class="col-md-3 my-2">
                        <div class="position-relative p-3 bg-secondary"style="height : 100px">
                            <div class="ribbon-wrapper ribbon-lg">
                                <div class="ribbon bg-{{ $rsTable->status_table == 1 ? 'success' : 'danger' }}">
                                    {{ $rsTable->status_table == 1 ? 'AVAILABLE' : 'USED' }}
                                </div>
                            </div>
                            <h4>{{ $rsTable->no_table }}</h4>
                            <p><strong>Capacity : </strong>{{ $rsTable->capacity_table }}</p>
                        </div>
                        <div class="bg-dark py-1 text-center">
                            <form action="{{ route('table.destroy', $rsTable->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-warning btn-xs"
                                    onclick="setFormTable('Edit','{{ $rsTable }}')"><i
                                        class="fas fa-edit"></i></button>
                                <button type="submit" class="btn btn-danger btn-xs"><i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- EndCard Body --}}
    </div>

    {{-- Modal Meja --}}
    <div class="modal fade" id="modal-meja">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="frm_Table" action="{{ route('table.save') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_table" id="id_table" value="">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title"><span id="mode"></span> Table</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="no_table" class="form-label">Number of Table</label>
                            <input type="text" name="no_table" id="no_table" class="form-control @error ('no_table') is-invalid @enderror" value="{{ old('no_table') }}">
                            @error('no_table')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="capacity_table" class="form-label">Capacity</label>
                            <input type="number" name="capacity_table" id="capacity_table" class="form-control @error ('capacity_table') is-invalid @enderror" value="{{ old('capacity_table') }}">
                            @error('capacity_table')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status_table" class="form-label">Status</label>
                            <select name="status_table" id="status_table" class="form-control" value="">
                                <option {{ old('capacity_table') == 1 ? "selected" : "" }} value="1">Available</option>
                                <option {{ old('capacity_table') == 2 ? "selected" : "" }} value="2">Used</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-success btn-block">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Meja --}}
@endsection

@section('custom.js')
<script>
    @if($errors->any())
        $("#modal-meja").modal('show')
    @endif
</script>
@endsection
