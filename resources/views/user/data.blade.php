@extends ('layouts.template')

@section('title', $title)
@section('page-title', $title)

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card card-danger">
                <div class="card-header">
                    <h4 class="card-title"><strong>{{ $edit ? 'Edit' : 'Add New' }}</strong> : {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ $edit ? route('user.update', @$rsUser->id) : route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($edit)
                            @method('PUT')
                        @endif
                        <div class="mb-3 text-center">
                            @if (@$rsUser->foto !="")
                                <img id="foto" class="thumbnail-user rounded-circle" src="{{ asset('uploads/menu/'. @$rsUser->foto) }}" alt="{{ @$rsUser->nm_menu }}">
                            @else
                                <img id="foto" class="thumbnail-user rounded-circle" src="{{ asset('img/avatar5.png') }}" alt="{{ @$rsUser->nm_menu }}">
                            @endif
                            <input class="d-none" type="file" name="file_foto" id="file_foto">
                            <input class="d-none" type="text" name="old_foto" id="old_foto" value="{{ @$rsUser->foto }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama User</label>
                            <input type="text" name="name" id="name" value="{{ old('name') ? old('name') : @$rsUser->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Nama User">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" value="{{ old('email') ? old('email') : @$rsUser->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"> <input type="hidden" name="old_password" id="old_password" value="{{ @$rsUser->password }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="superadmin" {{ @$rsUser->role == "superadmin" || old('role') == "superadmin" ? "selected" : "" }}>Super Admin</option>
                                <option value="admin" {{ @$rsUser->role == "admin" || old('role') == "admin" ? "selected" : "" }}>Admin</option>
                                <option value="koki" {{ @$rsUser->role == "koki" || old('role') == "koki" ? "selected" : "" }}>Koki</option>
                                <option value="cashier" {{ @$rsUser->role == "cashier" || old('role') == "cashier" ? "selected" : "" }}>Kasir</option>
                                <option value="member" {{ @$rsUser->role == "member" || old('role') == "member" ? "selected" : "" }}>Member </option>
                                <option value="user" {{ @$rsUser->role == "user" || old('role') == "user" ? "selected" : "" }}>User</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status') ? old('status') : @$rsUser->status }}">
                                <option {{ @$rsUser->status == 1 || old('status') == 1 ? "selected" : "" }} value = "1">Aktif</option>
                                <option {{ @$rsUser->status == 0 || old('status') == 0 ? "selected" : "" }} value = "0">Non Aktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="btn btn-block btn-danger" type="submit" value="SIMPAN">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-danger">
                <div class="card-header">
                    <h4 class="card-title">DATA</h4>
                    <div class="card-tools">
                        <a href="{{ route('user.index') }}" class="btn btn-tool btn-sm"><i class="fas fa-plus"></i> &nbsp; ADD NEW</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dtUser" class="tbData table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th width ="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dtUser as $rsUser)
                                <tr>
                                    <td>
                                        @if($rsUser->foto)
                                            <img alt="{{ $rsUser->name }}" class="user-avatar" src="{{ asset('uploads/user/'.$rsUser->foto) }}">
                                        @else
                                            <img alt="{{ $rsUser->name }}" class="user-avatar" src="{{ asset('img/avatar3.png') }}">
                                        @endif
                                        {{ $rsUser->name }} ( {{ $rsUser->role }} )
                                    </td>
                                    <td>{{ $rsUser->email }}</td>
                                    <td class="text-center">
                                        <span class="badge_bg-{{ $rsUser->status == 1 ? "success" : "danger" }}">
                                            {{ $rsUser->status == 1 ? "Aktif" : "Non Aktif" }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('user.destroy', $rsUser->id) }}" method="post">
                                            <a href="{{ route('user.edit', $rsUser->id) }}"><i class="text-warning fas fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-transparent border-0"><i class="text-danger fas fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
