<?php
$activeSidebar = 'admin_page';
?>

@extends('layouts.admin')

@section('title', 'Add Admin')

@section('add_link_css_admin')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/inc_custorm.css') }}">
@endsection

@section('content')

    <section class="content-header">
        <h1 class="pull-left">Add admin</h1>

        <a type="button" class="button-redirect" href="{{ route('superadmin.home') }}">
            <i class="fa fa-undo" aria-hidden="true"></i>
            Undo
        </a>

        <div style="clear: both"></div>

        <small class="colorRed">The filed with (*) is required</small>
        @include('include.admin.inc_admin_alert_info')
    </section>

    <section class="content">
            <div class="box box-primary">
                <form class="form form-horizontal tab-content" enctype="multipart/form-data"
                      method="post" action="{{ route('superadmin.store.admin') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="form-item">
                        <label for="" class="label_item">Name<small class="colorRed">(*)</small></label><br>
                        <input class="input" type="text" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="show_error">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-item">
                        <label for="" class="label_item">Email<small class="colorRed">(*)</small></label><br>
                        <input class="input" type="email" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="show_error">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-item">
                        <label for="" class="label_item">Password<small class="colorRed">(*)</small></label><br>
                        <input class="input" type="password" name="password">
                        @if ($errors->has('password'))
                            <span class="show_error">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-item">
                        <label for="" class="label_item">Role<small class="colorRed">(*)</small></label>
                        <input type="radio" class="input_radio" name="role_type"
                               value={{ config('settings.role_type.admin.id') }} checked
                               {{ old('role_type') == config('settings.role_type.admin.id') ? "checked" : "" }}
                        >
                        Admin

                        <input type="radio" class="input_radio" name="role_type"
                               value={{ config('settings.role_type.superadmin.id') }}
                                {{ old('role_type') == config('settings.role_type.superadmin.id') ? "checked" : "" }}
                        >
                        SuperAdmin
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="button_save">
                            <i class="fa fa-save" aria-hidden="true"></i>
                            Save
                        </button>
                        <a href="" type="button" class="button_undo">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            Undo
                        </a>
                    </div>
                </form>
            </div>
    </section>


@endsection

@section('script')
    <script>
        $(document).ready(function () {
            // $('#toggleActiveAdmin').click(function () {
            //     var isActive = $('#inputActiveAdmin').prop('checked') ? 0 : 1;
            //     $('#inputActiveAdmin').val(isActive);
            // });
        })
    </script>
@endsection