<?php
$activeSidebar = 'admin_page';

if (count($admins) > 0)
    $paramsPaginate = getParamsPaginate($admins);
?>

@section('add_link_css_admin')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/inc_custorm.css') }}">
@endsection

@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">List admin</h1>

        <a type="button" class="button-redirect" href="{{ route('superadmin.js') }}">
            <i class="fa fa-plus" aria-hidden="true"></i>
            js basic
        </a>

        <a type="button" class="button-redirect" href="{{ route('superadmin.create.admin.get') }}">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add admin
        </a>
        <div class="clearfix"></div>
        @include('include.admin.inc_admin_alert_info')
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="" style="display: inline-flex">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[2]"
                        onclick="handleChange(this)"
                    >
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </span>
                <input type="text" name="quant[2]"
                       width="25px" style="padding-left: 50px"
                       class="form-control input-number qty" id="qty" value="3" min="1" max="100">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </span>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
        });

        function handleChange() {
            var qty = document.getElementById('qty').value;
            var newQty = qty - 1;
            while (newQty > 0) {
                document.getElementById('qty').value = newQty;
            }
        }
    </script>
@endsection