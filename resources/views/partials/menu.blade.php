<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('license_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/lics*") ? "menu-open" : "" }} {{ request()->is("admin/tasks*") ? "menu-open" : "" }} {{ request()->is("admin/esfelts*") ? "menu-open" : "" }} {{ request()->is("admin/closes*") ? "menu-open" : "" }} {{ request()->is("admin/task-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/tasks-calendars*") ? "menu-open" : "" }} {{ request()->is("admin/user-alerts*") ? "menu-open" : "" }} {{ request()->is("admin/contractors*") ? "menu-open" : "" }} {{ request()->is("admin/billcons*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/lics*") ? "active" : "" }} {{ request()->is("admin/tasks*") ? "active" : "" }} {{ request()->is("admin/esfelts*") ? "active" : "" }} {{ request()->is("admin/closes*") ? "active" : "" }} {{ request()->is("admin/task-statuses*") ? "active" : "" }} {{ request()->is("admin/tasks-calendars*") ? "active" : "" }} {{ request()->is("admin/user-alerts*") ? "active" : "" }} {{ request()->is("admin/contractors*") ? "active" : "" }} {{ request()->is("admin/billcons*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.license.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('lic_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.lics.index") }}" class="nav-link {{ request()->is("admin/lics") || request()->is("admin/lics/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.lic.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.task.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('esfelt_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.esfelts.index") }}" class="nav-link {{ request()->is("admin/esfelts") || request()->is("admin/esfelts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.esfelt.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('close_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.closes.index") }}" class="nav-link {{ request()->is("admin/closes") || request()->is("admin/closes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.close.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-statuses.index") }}" class="nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tasks_calendar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks-calendars.index") }}" class="nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tasksCalendar.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_alert_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bell">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userAlert.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('contractor_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contractors.index") }}" class="nav-link {{ request()->is("admin/contractors") || request()->is("admin/contractors/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bell">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contractor.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('billcon_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.billcons.index") }}" class="nav-link {{ request()->is("admin/billcons") || request()->is("admin/billcons/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.billcon.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('electrical_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/transeformers*") ? "menu-open" : "" }} {{ request()->is("admin/cbs*") ? "menu-open" : "" }} {{ request()->is("admin/minibllers*") ? "menu-open" : "" }} {{ request()->is("admin/boxes*") ? "menu-open" : "" }} {{ request()->is("admin/bills*") ? "menu-open" : "" }} {{ request()->is("admin/allnotes*") ? "menu-open" : "" }} {{ request()->is("admin/minibllarnotes*") ? "menu-open" : "" }} {{ request()->is("admin/lines*") ? "menu-open" : "" }} {{ request()->is("admin/cts*") ? "menu-open" : "" }} {{ request()->is("admin/diagrams*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/transeformers*") ? "active" : "" }} {{ request()->is("admin/cbs*") ? "active" : "" }} {{ request()->is("admin/minibllers*") ? "active" : "" }} {{ request()->is("admin/boxes*") ? "active" : "" }} {{ request()->is("admin/bills*") ? "active" : "" }} {{ request()->is("admin/allnotes*") ? "active" : "" }} {{ request()->is("admin/minibllarnotes*") ? "active" : "" }} {{ request()->is("admin/lines*") ? "active" : "" }} {{ request()->is("admin/cts*") ? "active" : "" }} {{ request()->is("admin/diagrams*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.electrical.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('transeformer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.transeformers.index") }}" class="nav-link {{ request()->is("admin/transeformers") || request()->is("admin/transeformers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.transeformer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('cb_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.cbs.index") }}" class="nav-link {{ request()->is("admin/cbs") || request()->is("admin/cbs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.cb.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('minibller_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.minibllers.index") }}" class="nav-link {{ request()->is("admin/minibllers") || request()->is("admin/minibllers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.minibller.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('box_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.boxes.index") }}" class="nav-link {{ request()->is("admin/boxes") || request()->is("admin/boxes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.box.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('bill_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.bills.index") }}" class="nav-link {{ request()->is("admin/bills") || request()->is("admin/bills/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.bill.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('allnote_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.allnotes.index") }}" class="nav-link {{ request()->is("admin/allnotes") || request()->is("admin/allnotes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.allnote.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('minibllarnote_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.minibllarnotes.index") }}" class="nav-link {{ request()->is("admin/minibllarnotes") || request()->is("admin/minibllarnotes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.minibllarnote.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('line_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.lines.index") }}" class="nav-link {{ request()->is("admin/lines") || request()->is("admin/lines/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.line.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('ct_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.cts.index") }}" class="nav-link {{ request()->is("admin/cts") || request()->is("admin/cts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ct.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('diagram_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.diagrams.index") }}" class="nav-link {{ request()->is("admin/diagrams") || request()->is("admin/diagrams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.diagram.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('task_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/task-tags*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/task-tags*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-list">

                            </i>
                            <p>
                                {{ trans('cruds.taskManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('task_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-tags.index") }}" class="nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('station_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.stations.index") }}" class="nav-link {{ request()->is("admin/stations") || request()->is("admin/stations/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.station.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>