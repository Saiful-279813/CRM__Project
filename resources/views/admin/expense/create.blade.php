@extends('layouts.admin')
@section('accounts') active mm-active @endsection
@section('expense') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Expense</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Expense</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_store'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Added New Expense.
            </div>
          @endif

          @if(Session::has('error'))
            <div class="alert alert-warning alerterror" role="alert">
               <strong>Opps!</strong> please try again.
            </div>
          @endif
      </div>
      <div class="col-md-2"></div>
  </div>
  {{-- main work --}}
  <div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal" method="post" action="{{ route('expense.store') }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Create Expense</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('expense.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Expense</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="form-group custom_form_group row mb-3">
                    <label class="col-sm-4 col-form-label col_form_label">Category Name:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                        <select class="form-control" name="exp_cat_id" id="search_select2" required>
                          <option value="">----Select Category----</option>
                          @foreach ($category as $catg)
                            <option value="{{ $catg->exp_cat_id }}">{{ $catg->exp_cat_name }}</option>
                          @endforeach
                        </select>
                        @error('in_cat_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group custom_form_group row mb-3">
                    <label class="col-sm-4 col-form-label col_form_label">Amount:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Amount..." class="form-control" name="expens_amount" value="{{old('expens_amount')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[0,15]" data-parsley-trigger="keyup">
                        @error('expens_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group custom_form_group row mb-3">
                    <label class="col-sm-4 col-form-label col_form_label">Remarks:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                        <textarea name="expens_details" rows="3" cols="80" class="form-control" placeholder="Remarks Here..." required>{{ old('expens_details') }}</textarea>
                        @error('expens_details')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3 ">
                    <label class="col-sm-4 col-form-label col_form_label">Income Date:<span class="req_star">*</span></label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <input type="text" class="form-control form_control" id="birththday" name="expens_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') ?? old('expens_date') }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Image --}}
            </div>
            <div class="card-footer card_footer_button text-center">
                <button type="submit" class="btn btn-primary waves-effect">SAVE</button>
            </div>
          </div>
          {{-- visa form --}}
        </form>
    </div>
  </div>
  {{-- main work --}}
@endsection

@section('scripts')
    <script type="text/javascript">
      /* ================ do work ================ */
      $(document).ready(function() {
          $('#customerForm').parsley();
      });
      /* ================ do work ================ */
    </script>
@endsection
