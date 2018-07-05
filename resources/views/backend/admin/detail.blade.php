<?php
$activeSidebar = 'admin_page';

?>

@section('add_link_css_admin')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/inc_custorm.css') }}">
@endsection

@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Info admin</h1>

        <a type="button" class="button-redirect" href="{{ route('admin.edit.get', ['id' => $admin->id]) }}">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Update info
        </a>

        <div class="clearfix"></div>

        @include('include.admin.inc_admin_alert_info')

    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="form-item">
                <label for="">Name</label><br>
                <input type="text" disabled value="{{ $admin->name }}" class="input">
            </div>

            <div class="form-item">
                <label for="">Email</label><br>
                <input type="text" disabled value="{{ $admin->email }}" class="input">
            </div>

            <div class="form-item">
                <label for="">Role</label><br>
                @if ($admin->role_type == config('settings.role_type.superadmin.id'))
                    <input type="text" disabled value="{{ config('settings.role_type.superadmin.title') }}" class="input">
                @elseif ($admin->role_type == config('settings.role_type.admin.id'))
                    <input type="text" disabled value="{{ config('settings.role_type.admin.title') }}" class="input">
                @endif
            </div>

            <div class="form-item">
                <label for="">Last Updated</label><br>
                <input type="text" disabled value="{{ $admin->updated_at }}" class="input">
            </div>

            @if ($adminUpdated)
                <div class="form-item">
                    <label for="">Last Updated By</label><br>
                    <input type="text" disabled value="{{ $adminUpdated->name }} " class="input">
                </div>
            @endif
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
        });
    </script>
@endsection