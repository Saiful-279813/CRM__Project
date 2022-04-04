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
                        {{-- Visa Type --}}


                    </ul>
                </li>
                {{-- accounts & Finance --}}
                <li class="@yield('accounts')"><a href="#" class="waves-effect"><i class="bx bx-package"></i><span>Finance & Accounting</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a class="@yield('balancesheet')" href="#"> <i class="fas fa-arrow-right sm child_i"></i> Balance Sheet </a></li>
                        <li><a class="@yield('summary')" href="#"> <i class="fas fa-arrow-right sm child_i"></i> Summary </a></li>
                        <li><a class="@yield('income')" href="{{ route('income.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Daily Income </a></li>
                        <li><a class="@yield('expense')" href="{{ route('expense.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Daily Expense </a></li>
                        <li><a class="@yield('incomeCategory')" href="{{ route('income-category.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Income Category </a></li>
                        <li><a class="@yield('expenseCategory')" href="{{ route('expense-category.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Expense Category </a></li>
                        <li><a class="@yield('cashflow')" href="#"> <i class="fas fa-arrow-right sm child_i"></i> Cash Flow </a></li>
                        <li><a class="@yield('payment')" href="#"> <i class="fas fa-arrow-right sm child_i"></i> Payment </a></li>
                        {{-- <li><a class="@yield('loan')" href="#"> <i class="fas fa-arrow-right sm child_i"></i> Loan </a></li> --}}
                    </ul>
                </li>
                {{-- accounts & Finance --}}
                <li class="@yield('customer')"><a href="#" class="waves-effect"><i class="bx bx-happy-alt"></i><span>Customers</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a class="@yield('addCustomer')" href="{{ route('customers.create') }}"> <i class="fas fa-arrow-right sm child_i"></i> Add Customer </a></li>
                        {{-- list customer --}}
                        <li><a class="@yield('customerList')" href="{{ route('customers.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Customer List </a></li>
                        {{-- visa list --}}
                        <li><a class="@yield('customerTransaction')" href="{{ route('customer-trnasaction.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Customer Transaction </a></li>
                    </ul>
                </li>

                <li class="@yield('employee')"><a href="#" class="waves-effect"><i class="bx bx-happy-alt"></i><span>Employee</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a class="@yield('addEmployee')" href="{{ route('employee.create') }}"> <i class="fas fa-arrow-right sm child_i"></i> Add New Employee </a></li>
                        <li><a class="@yield('addEmployee')" href="{{ route('employee.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Employee List </a></li>
                        <li><a class="@yield('salary')" href="{{ route('salary.index') }}"> <i class="fas fa-arrow-right sm child_i"></i> Employee Salary </a></li>
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
