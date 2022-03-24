<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li><a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="bx bx-home-circle"></i><span>Dashboard</span></a></li>

                <li class="@yield('admin')"><a href="#" class="waves-effect"><i class="bx bx-cog"></i><span>Administrator</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a class="@yield('userChild')" href="{{ route('users.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Users </a></li>
                        {{-- role --}}
                        <li><a class="@yield('role')" href="{{ route('roles.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Role </a></li>
                        {{-- Blood --}}
                        <li><a class="@yield('blood')" href="{{ route('blood.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Blood Group </a></li>
                        {{-- Department --}}
                        <li><a class="@yield('department')" href="{{ route('department.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Department </a></li>
                        {{-- Designation --}}
                        <li><a class="@yield('designation')" href="{{ route('designation.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Designation </a></li>
                        {{-- Employee Type --}}
                        <li><a class="@yield('employee-type')" href="{{ route('employee-type.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Employee Type </a></li>

                    </ul>
                </li>

                {{-- do work --}}
                <li class="@yield('customer')"><a class="@yield('customer_child')" href="{{ route('customers.index') }}" class="waves-effect"><i class="bx bx-user-pin"></i><span>Customers</span></a></li>

                <li class="@yield('employee')"><a href="#" class="waves-effect"><i class="bx bx-happy-alt"></i><span>Employee</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a class="@yield('addEmployee')" href="{{ route('employee.create') }}"> <i class="fas fa-arrow-right sm child_i"></i> Add New Employee </a></li>
                        <li><a class="@yield('addEmployee')" href="{{ route('employee.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Employee List </a></li>
                    </ul>
                </li>


                {{--


                <i class="bx bx-package"></i>
                <li><a href="#" class="waves-effect"><i class="bx bx-briefcase-alt-2"></i><span>Human Resource</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('dashboard/employee')}}">Employee Information</a></li>
                        <li><a href="{{url('dashboard/department')}}">Department</a></li>
                        <li><a href="{{url('dashboard/designation')}}">Designation</a></li>
                    </ul>
                </li>
                <li><a href="#" class="waves-effect"><i class="bx bx-data"></i><span>Inventory Management</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('dashboard/material')}}">Material</a></li>
                        <li><a href="{{url('dashboard/material/purchase')}}"> Material Purchase</a></li>
                        <li><a href="{{url('dashboard/material/damage')}}">Material Damage</a></li>
                        <li><a href="#">Material Stock</a></li>
                    </ul>
                </li> --}}



                <li><a href="{{url('dashboard/recycle')}}" class="waves-effect"><i class="bx bx-trash"></i><span>Recycle</span></a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="waves-effect"><i class="bx bx-power-off"></i><span>Logout</span></a></li>
            </ul>
        </div>
    </div>
</div>
