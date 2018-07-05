<?php
$activeSidebar = 'admin_page';

?>

@extends('layouts.admin')

@section('title', 'Edit Admin')

@section('add_link_css_admin')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/inc_custorm.css') }}">
@endsection

@section('content')

    <section class="content-header">
        <h1 class="pull-left">Edit admin</h1>

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
                  method="post" action="{{ route($nameRouteUpdateAdmin, ['id' => $admin->id]) }}">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id"  value="{{ $admin->id }}">
                <input type="hidden" name="_method" value="PUT">

                <h3>Basic info</h3>

                <div class="form-item">
                    <label for="" class="label_item">Name<small class="colorRed">(*)</small></label><br>
                    <input class="input" type="text" name="name"
                           value="{{ (old('name')) ? old('name') : $admin->name }}">
                    @if ($errors->has('name'))
                        <span class="show_error">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-item">
                    <label for="" class="label_item">Email<small class="colorRed">(*)</small></label><br>
                    <input class="input" type="email" name="email"
                            value="{{ keepValueInput(old('email'), $admin->email) }}">
                    @if ($errors->has('email'))
                        <span class="show_error">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                @if ($admin->role_type == config('settings.role_type.supperadmin.id'))
                    <div class="form-item">
                        <label for="" class="label_item">Role</label>
                        <input type="radio" class="input_radio" name="role_type"
                               value={{ config('settings.role_type.admin.id') }}

                               @if(old('role_type'))
                               {{ $admin->role_type = old('role_type') }}
                               @endif
                               @if (config('settings.role_type.admin.id') == $admin->role_type)
                                       checked="checked"
                               @endif
                        >
                        Admin

                        <input type="radio" class="input_radio" name="role_type"
                               value={{ config('settings.role_type.superadmin.id') }}
                               @if(old('role_type'))
                                {{ $admin->role_type = old('role_type') }}
                               @endif
                               @if (config('settings.role_type.superadmin.id') == $admin->role_type)
                                       checked="checked"
                               @endif
                        >
                        SuperAdmin
                    </div>
                @endif

                <div class="form-item">
                    <label for="" class="label_item">Avatar</label>
                    <input type="file" name="image">
                </div>

                <h3>Update Password</h3>
                <div class="form-item">
                    <label for="" class="label_item">New Password</label><br>
                    <input type="password" class="input" name="new_password">

                    @if($errors->has('new_password'))
                        <span class="show_error"> {{ $errors->first('new_password') }}</span>
                    @endif
                </div>

                <div class="form-item">
                    <label for="" class="label_item">Confirm new Password</label><br>
                    <input type="password" class="input" name="new_password_confirmation" }}">

                    @if($errors->has('new_password_confirmation'))
                        <span class="show_error"> {{ $errors->first('new_password_confirmation') }}</span>
                    @endif
                </div>

                <div class="box-footer">
                    <button type="submit" class="button_save">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Save
                    </button>
                    <a href="{{ route('superadmin.home') }}" type="button" class="button_undo">
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