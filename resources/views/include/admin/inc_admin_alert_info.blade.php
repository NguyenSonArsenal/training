@if (session('create_success'))
    <div class="alert alert-info fade in" style="margin-top: 20px; background: none">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{ session('create_success') }}</strong>
    </div>
@endif

@if (session('update_success'))
    <div class="alert alert-info fade in" style="margin-top: 20px; background: none">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{ session('update_success') }}</strong>
    </div>
@endif

@if (session('update_fail'))
    <div class="alert alert-danger fade in" style="margin-top: 20px; background: none">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{ session('update_fail') }}</strong>
    </div>
@endif

@if (session('delete_success'))
    <div class="alert alert-info fade in" style="margin-top: 20px; background: none">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{ session('delete_success') }}</strong>
    </div>
@endif

@if (session('continue_create'))
    <div class="alert alert-info fade in" style="margin-top: 20px; background: none">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>{{ session('continue_create') }}</strong>
    </div>
@endif