@extends('layouts.admin')
@section('accounts') active mm-active @endsection
@section('incomeCategory') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Income Category</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Income Category</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- main work --}}
  <div class="row">
    <div class="col-lg-12">

          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> View Income Category</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('income-category.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Income Category </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body">
              <div class="col-md-8 m-auto">
                  <table class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
                      <tr>
                        <td>Category Name</td>
                        <td>:</td>
                        <td>{{$data->in_cat_name}}</td>
                      </tr>
                      <tr>
                        <td>Category Remarks </td>
                        <td>:</td>
                        <td>{{$data->in_cat_remarks}}</td>
                      </tr>
                      <tr>
                        <td>Create Time </td>
                        <td>:</td>
                        <td>{{$data->created_at->format('d/m/Y')}}</td>
                      </tr>
                  </table>
                  <hr>
              </div>
              {{-- do work --}}
            </div>
            <div class="card-footer card_footer_button text-center">
                .
            </div>
          </div>
          {{-- visa form --}}
        </form>
    </div>
  </div>
  {{-- main work --}}
@endsection
