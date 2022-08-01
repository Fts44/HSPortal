
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('admin/dashboard') }}" id="sidebar_message">
                    <i class="bi bi-columns-gap"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" id="sidebar_message">
                    <i class="bi bi-chat"></i>
                    <span>Message</span>
                </a>
            </li> -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('admin/appointment') }}" id="sidebar_dashboard">
                    <i class="bi bi-calendar4-week"></i>
                    <span>Appointment</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" id="sidebar_dashboard"  data-bs-target="#inv-nav" data-bs-toggle="collapse" >
                    <i class="bi bi-boxes"></i>
                    <span>Inventory</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="inv-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin/inventory/equipments') }}">
                            <i class="bi bi-circle"></i><span>Equipments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/inventory/medication') }}">
                            <i class="bi bi-circle"></i><span>Medication</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" id="sidebar_dashboard" data-bs-target="#user-nav" data-bs-toggle="collapse" >
                    <i class="bi bi-people"></i>
                    <span>User</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="user-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin/infirmarypersonnel') }}">
                            <i class="bi bi-circle"></i><span>Infirmary Personnel</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/patient') }}">
                            <i class="bi bi-circle"></i><span>Patient</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('admin/') }}" id="sidebar_dashboard">
                    <i class="bi bi-person"></i>
                    <span>Personal Info</span>
                </a>
            </li>

        </li>

    </ul>

</aside>
