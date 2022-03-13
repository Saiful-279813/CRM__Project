<div id="sidebar-menu">
    <ul>
       <li><a target="_blank" href="{{ url('/') }}" class="waves-effect"><i class="fas fa-globe-europe"></i><span>Website </span></a></li>
       <li><a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="md md-home"></i><span>Dashboard </span></a></li>
       <!-- Administor Settings -->
       {{-- role & Permission --}}
       <li class="has_sub">
           <a href="#" class="waves-effect"><i class="fas fa-user-cog"></i><span>Administor Settings</span><span class="pull-right"><i class="md md-add"></i></span></a>
           <ul class="list-unstyled">
               <li><a href="{{ route('users.index') }}"><span><i class="fas fa-arrow-right"></i></span> Users</a></li>
               <li><a href="{{ route('roles.index') }}"><span><i class="fas fa-arrow-right"></i></span> Role Manage</a></li>
               <li class="@yield('banner')"><a class="@yield('bannerChild')" href="{{ route('banner.index') }}"><span><i class="fas fa-arrow-right"></i></span> Banner </a></li>
               {{-- second banner --}}
               <li class="@yield('secondbanner')"><a class="@yield('secondbannerChild')" href="{{ route('secondbanner.index') }}"><span><i class="fas fa-arrow-right"></i></span> Second Banner </a></li>
               {{-- Others banner --}}
               <li class=""><a class="" href="{{ route('othersbanner') }}"><span><i class="fas fa-arrow-right"></i></span> Others Banner </a></li>
               {{-- product Delivery --}}
               <li class="@yield('pdelivery')"><a class="@yield('pdeliveryChild')" href="{{ route('pdelivery.index') }}"><span><i class="fas fa-arrow-right"></i></span> Product Delivery </a></li>

               <li class="@yield('coupon')"><a class="@yield('couponChild')" href="{{ route('coupon.index') }}"><span><i class="fas fa-arrow-right"></i></span> Coupon </a></li>
               {{-- settings --}}
               <li class=""><a class="" href="{{ route('setting.index') }}"><span><i class="fas fa-arrow-right"></i></span> Settings </a></li>
               {{-- Report --}}
               <li class="@yield('report')"><a class="@yield('reportChild')" href="{{ route('report') }}"><span><i class="fas fa-arrow-right"></i></span> Report </a></li>
           </ul>
       </li>
       {{-- order --}}
       <li class="has_sub">
           <a href="#" class="waves-effect"><i class="fas fa-user-cog"></i><span>Orders</span><span class="pull-right"><i class="md md-add"></i></span></a>
           <ul class="list-unstyled">
               <li  class="@yield('order')"><a href="{{ route('new-order') }}" class="@yield('newOrder')"><span><i class="fas fa-arrow-right"></i></span> New Order </a></li>
               <li class="@yield('order')"><a href="{{ route('confirm-order') }}" class="@yield('confirmOrder')"><span><i class="fas fa-arrow-right"></i></span> Confirm Order </a></li>
               <li class="@yield('order')"><a href="{{ route('sale-order') }}" class="@yield('saleOrder')"><span><i class="fas fa-arrow-right"></i></span> Sale Order </a></li>
               <li class="@yield('order')"><a href="{{ route('cencel-order') }}" class="@yield('cencelOrder')"><span><i class="fas fa-arrow-right"></i></span> Cencel Order </a></li>
               <li class="@yield('order')"><a href="{{ route('reject-order') }}" class="@yield('rejectOrder')"><span><i class="fas fa-arrow-right"></i></span> Reject Order </a></li>
           </ul>
       </li>
       {{-- Category & Brand --}}
       <li class="has_sub">
           <a href="#" class="waves-effect"><i class="fab fa-product-hunt"></i><span>Category & Brand</span><span class="pull-right"><i class="md md-add"></i></span></a>
           <ul class="list-unstyled">
               <li class="@yield('brand')"><a class="@yield('brandChild')" href="{{ route('brand.index') }}"><span><i class="fas fa-arrow-right"></i></span> Brand </a></li>

               <li class="@yield('category')"><a class="@yield('categoryChild')" href="{{ route('category.index') }}"><span><i class="fas fa-arrow-right"></i></span> Category </a></li>

               <li class="@yield('subcategory')"><a class="@yield('subcategoryChild')"  href="{{ route('subcategory.index') }}"><span><i class="fas fa-arrow-right"></i></span> Second Category </a></li>

               <li class="@yield('thirdcategory')"><a class="@yield('thirdcategoryChild')" href="{{ route('thirdcategory.index') }}"><span><i class="fas fa-arrow-right"></i></span> Third Category </a></li>
               {{-- end ul --}}
           </ul>
       </li>
       {{-- product --}}
       <li class="has_sub">
           <a href="#" class="waves-effect"><i class="fas fa-user-cog"></i><span>Products</span><span class="pull-right"><i class="md md-add"></i></span></a>
           <ul class="list-unstyled">
               <li><a href="{{ route('products.create') }}"><span><i class="fas fa-arrow-right"></i></span> Add New Product </a></li>
               <li class="@yield('product')"><a class="@yield('productChild')" href="{{ route('products.index') }}"><span><i class="fas fa-arrow-right"></i></span> All Products </a></li>
           </ul>
       </li>

       <li class="has_sub">
           <li><a href="{{ route('getReview') }}"><span><i class="fas fa-user-cog"></i></span> Products Review </a></li>
       </li>







    </ul>
    <div class="clearfix"></div>
</div>
