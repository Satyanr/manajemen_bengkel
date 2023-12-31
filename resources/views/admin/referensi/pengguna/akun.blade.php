@extends('layouts.admin')

@section('content')

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Referensi</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Pengguna</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    @livewire('admin.referensi.pengguna.akun.index')
</div>

@endsection
