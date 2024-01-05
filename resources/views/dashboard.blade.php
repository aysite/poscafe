@extends('layouts.template')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Example</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="tbData table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Rendering</th>
                    <th>Rendering</th>
                    <th>Rendering</th>
                    <th>Rendering</th>
                    <th>Rendering</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Trident</td>
                    <td>Trident</td>
                    <td>Trident</td>
                    <td>Trident</td>
                    <td>Trident</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection