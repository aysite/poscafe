@extends('layouts.template')

@section('title', $title)
@section('page-title', $page_title)

@section('content')

{{-- Notification --}}
@if(session('notif'))
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
            <a class="btn btn-secondary btn-sm" href="{{ route('category.create') }}"><i class="fas fa-plus"></i>Add New</a>
        </div>
    </div>
    {{-- End Card Header --}}
    
    {{-- Card Body --}}
    <div class="card-body">
        <table id="dtCategory" class="tbData table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Icon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dtCategory as $rsCategory)
                    <tr>
                        <td>{{ $rsCategory->id }}</td>
                        <td>{{ $rsCategory->nm_category }}</td>
                        <td>{{ $rsCategory->icon_category }}</td>
                        <td class="text-center">
                            <form action="{{ route('category.destroy',$rsCategory->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-warning btn-xs" href="{{ route('category.edit',$rsCategory->id) }}"><i class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
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