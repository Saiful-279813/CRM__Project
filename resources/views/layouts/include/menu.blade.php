<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li><a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="bx bx-home-circle"></i><span>Dashboard</span></a></li>

                <li class="@yield('user')"><a href="#" class="waves-effect"><i class="bx bx-cog"></i><span>Administrator</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a class="@yield('userChild')" href="{{ route('users.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Users </a></li>
                    </ul>
                </li>

                {{-- do work --}}

                {{-- <li><a href="#" class="waves-effect"><i class="bx bx-package"></i><span>Finance & Accounting</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Balance Sheet</a></li>
                        <li><a href="{{url('dashboard/summary')}}">Summary</a></li>
                        <li><a href="{{url('dashboard/income')}}">Daily Income</a></li>
                        <li><a href="{{url('dashboard/expense')}}">Daily Expense</a></li>
                        <li><a href="{{url('dashboard/income/category')}}">Income Category</a></li>
                        <li><a href="{{url('dashboard/expense/category')}}">Expense Category</a></li>
                        <li><a href="#">Cash Flow</a></li>
                        <li><a href="#">Payment</a></li>
                        <li><a href="#">Loan</a></li>
                        <li><a href="#">Chart of Accounts</a></li>
                    </ul>
                </li>
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

                {{-- do work --}}
                <li><a href="{{url('dashboard/customer')}}" class="waves-effect"><i class="bx bx-user-pin"></i><span>Customers</span></a></li>
                <li><a href="{{url('dashboard/supplier')}}" class="waves-effect"><i class="bx bx-happy-alt"></i><span>Suppliers</span></a></li>
                <li><a href="{{url('dashboard/recycle')}}" class="waves-effect"><i class="bx bx-trash"></i><span>Recycle</span></a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="waves-effect"><i class="bx bx-power-off"></i><span>Logout</span></a></li>
            </ul>
        </div>
    </div>
</div>
