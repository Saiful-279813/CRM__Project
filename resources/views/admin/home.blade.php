@extends('layouts.backend_master')
@section('content')
    <!-- do work -->
    <div class="row bread_part">
        <div class="col-sm-12 bread_col">
            <h4 class="pull-left page-title bread_title">Dashboard</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active">Home</li>

            </ol>
        </div>
    </div>
    <div class="main_part">
      <div class="row">
          <div class="col-md-6 col-xl-3">
              <div class="mini-stat clearfix bx-shadow bg-white">
                  <span class="mini-stat-icon bg-primary"><i class="md md-person"></i></span>
                  <div class="mini-stat-info text-right text-dark mini_stat_info">
                       <span class="counter text-dark"></span>  User
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="mini-stat clearfix bx-shadow bg-white">
                  <span class="mini-stat-icon bg-primary"><i class="md md-person"></i></span>
                  <div class="mini-stat-info text-right text-dark mini_stat_info">
                      <span class="counter text-dark"> </span> Pending Order
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-xl-3">
              <div class="mini-stat clearfix bx-shadow bg-white">
                  <span class="mini-stat-icon bg-primary"><i class="md md-person"></i></span>
                  <div class="mini-stat-info text-right text-dark mini_stat_info">
                      <span class="counter text-dark"> </span> Confirm Order
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-xl-3">
              <div class="mini-stat clearfix bx-shadow bg-white">
                  <span class="mini-stat-icon bg-primary"><i class="md md-person"></i></span>
                  <div class="mini-stat-info text-right text-dark mini_stat_info">
                      <span class="counter text-dark"> </span> Delivery Order
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-xl-3">
              <div class="mini-stat clearfix bx-shadow bg-white">
                  <span class="mini-stat-icon bg-primary"><i class="md md-person"></i></span>
                  <div class="mini-stat-info text-right text-dark mini_stat_info">
                      <span class="counter text-dark"> </span> Return Order
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-xl-3">
              <div class="mini-stat clearfix bx-shadow bg-white">
                  <span class="mini-stat-icon bg-primary"><i class="md md-contacts"></i></span>
                  <div class="mini-stat-info text-right text-dark mini_stat_info">
                      <span class="counter text-dark">20</span>
                      Total Brand
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-xl-3">
              <div class="mini-stat clearfix bx-shadow bg-white">
                  <span class="mini-stat-icon bg-primary"><i class="md md-contacts"></i></span>
                  <div class="mini-stat-info text-right text-dark mini_stat_info">
                      <span class="counter text-dark">20</span>
                      Total Category
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-xl-3">
              <div class="mini-stat clearfix bx-shadow bg-white">
                  <span class="mini-stat-icon bg-primary"><i class="md md-view-quilt"></i></span>
                  <div class="mini-stat-info text-right text-dark mini_stat_info">
                      <span class="counter text-dark"></span>
                     Total Product
                  </div>
              </div>
          </div>


      </div>
    </div>
    <!-- do work -->
@endsection
