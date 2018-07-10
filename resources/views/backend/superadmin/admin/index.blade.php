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
        <a type="button" class="button-redirect" href="{{ route('superadmin.create.admin.get') }}">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add admin
        </a>
        <div class="clearfix"></div>
        @include('include.admin.inc_admin_alert_info')
    </section>

    <section class="content">
        <div class="box box-primary">
            <!-- Search and Filter -->

            <form method="get" action="{{ route('superadmin.home') }}" class="search-filter">
                <input type="text" class="input_search"
                       placeholder="Enter your name or id admin" name="search"
                       value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">

                <select name="filter" style="outline: none; margin-right: 10px">
                    <option value="{{ config('settings.role_type.superadmin.id') }}"
                            {{ isset($_GET['filter']) && $_GET['filter'] ==
                             config('settings.role_type.superadmin.id') ? 'selected' : '' }}
                    >
                        {{ config('settings.role_type.superadmin.title') }}
                    </option>
                    <option value="{{ config('settings.role_type.admin.id') }}"
                            {{ isset($_GET['filter']) && $_GET['filter'] ==
                             config('settings.role_type.admin.id') ? 'selected' : '' }}
                    >
                        {{ config('settings.role_type.admin.title') }}
                    </option>
                    <option value="{{ config('settings.filter.all') }}"
                            {{ isset($_GET['filter']) && $_GET['filter'] ==
                             config('settings.filter.all') ? "selected" : '' }} >All</option>
                </select>

                <button type="submit" class="button_primary">
                    <i class="fa fa-save" aria-hidden="true"></i>
                    Search
                </button>
            </form>

            <!-- End Search and Filter -->

            <!-- data -->
            <table class="table_list_admins" style="width: 100%">
                <thead class="thead">
                    <tr class="tr tr_head">
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Infor</th>
                        <th>Role</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach($admins as $admin)
                        <tr class="tr">
                            <td>{{ $admin->id }}</td>
                            <td>
                                @if ($admin->avatar)
                                    <img src="{{ $admin->avatar }}"
                                         height="40" width="40" alt="name image">
                                @else
                                    <img src="{{ asset('assets/admin/images/default-avatar.png') }}"
                                         height="40" width="40" alt="name image">
                                @endif
                            </td>
                            <td>
                                <i class="fa fa-user"> {{ $admin->name }}</i></br>
                                <i class="fa fa-envelope"> {{ $admin->email }}</i>
                            </td>
                            <td>
                                @if ($admin->role_type == config('settings.role_type.admin.id'))
                                    <span>Admin</span>
                                @elseif ($admin->role_type == config('settings.role_type.superadmin.id'))
                                    <span>Super Admin</span>
                                @endif
                            </td>
                            <td>
                                Đã tạo:<br>
                                {{--{{ $admin->ins_datetime->format('H:m:s d-m-Y') }}--}}
                                {{--<small>({{ $admin->ins_datetime->diffForHumans() }})</small>--}}
                                <br>
                                Lần cập nhật cuối:
                                {{--<br>{{ $admin->upd_datetime->format('H:i:s d-m-Y') }}--}}
                                {{--<small>({{ $admin->upd_datetime->diffForHumans() }})</small>--}}
                            </td>
                            <td style="display: inline-flex">
                                @if ($admin->role_type == config('settings.role_type.admin.id'))
                                    <a href="{{ route('superadmin.edit.admin.get', ['id' => $admin->id]) }}"
                                       type="button" class="button_primary button_edit">
                                        <i class="fa fa-edit">Edit</i>
                                    </a>

                                    <form method="post" action="{{ route('superadmin.delete.admin', ['id' => $admin->id]) }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button class="button_danger" value="Delete" type="submit"
                                                onclick="return confirm('Are you sure delete ?')">
                                            <i class="fa fa-trash"></i>Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="paginate_page">
                <div class="dataTables_info">
                    Hiển thị
                    <span>{{ $paramsPaginate['start'] }}      </span> đến
                    <span>{{ $paramsPaginate['end'] }}        </span> của
                    <span>{{ $paramsPaginate['totalRecords']}}</span>
                    bản ghi
                </div>
                    <ul class="pagination">
                        {{ $admins->appends(request()->query())->links()  }}
                    </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>

@endsection

@section('script')
<script>
    $(document).ready(function () {
    });
</script>
@endsection