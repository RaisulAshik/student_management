@extends('admin.layout.master')

@section('content')
<header class="page-header">
    <h2>Manage Permissions</h2>
    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="{{route('roles.index')}}"><span>Roles</span></a></li>
            <li><span>Manage Permissions</span></li>
        </ol>
    </div>
</header>

@include('admin.layout.message')

<section class="panel">
    <header class="panel-heading">
        <h2 class="panel-title">Permissions for: <strong>{{ $role->name }}</strong></h2>
    </header>
    <div class="panel-body">
        <form method="POST" action="{{ route('roles.permissions.update', $role->id) }}">
            @csrf

            @foreach($permissionGroups as $group => $permissions)
            <div class="panel panel-default" style="margin-bottom: 15px;">
                <div class="panel-heading" style="background:#f5f5f5; padding:8px 15px;">
                    <strong>{{ $group }}</strong>
                    <label style="float:right; font-weight:normal; cursor:pointer;">
                        <input type="checkbox" class="group-toggle" data-group="{{ Str::slug($group) }}">
                        Select All
                    </label>
                </div>
                <div class="panel-body" style="padding:10px 15px;">
                    <div class="row">
                        @foreach($permissions as $permission)
                        <div class="col-md-3 col-sm-4" style="margin-bottom:8px;">
                            <label style="font-weight:normal; cursor:pointer;">
                                <input type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission }}"
                                    class="perm-{{ Str::slug($group) }}"
                                    {{ in_array($permission, $rolePermissions) ? 'checked' : '' }}>
                                {{ $permission }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach

            <div style="margin-top:20px;">
                <button type="submit" class="btn btn-success">Save Permissions</button>
                <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@section('custom-js')
<script>
$(document).on('change', '.group-toggle', function () {
    var group = $(this).data('group');
    $('.perm-' + group).prop('checked', $(this).is(':checked'));
});
</script>
@endsection
