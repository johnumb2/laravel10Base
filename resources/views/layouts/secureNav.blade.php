<div class="col-lg-2"> <!-- This is your Left Nav -->
    <ul class="nav flex-column" id="left-nav">
        <li class="nav-item">
            <div class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard">Dashboard</a>
            </div>
        </li>
        <li class="nav-item">
            <h6>User Management</h6>
        </li>
        <li class="nav-item">
            <div class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                <a href="/users">Users</a>
            </div>
        </li>
        <li class="nav-item">
            <h6>Permission Management</h6>
        </li>
        <li class="nav-item">
            <div class="nav-link {{ request()->is('permissions') ? 'active' : '' }}">
                <a href="/permissions">Permissions</a>
            </div>
            <div class="nav-link {{ request()->is('permission') ? 'active' : '' }}">
                <a href="/permission">Add Permission</a>
            </div>
        </li>
    </ul>
</div>

@push('js')
    <script type="text/javascript">
        $(function () {
            $("#left-nav").accordion();
        });
    </script>
@endpush
