@extends('layouts.admin')
@section('customer') active mm-active @endsection
@section('customerTransaction') active @endsection
@section('styles')
  <style media="screen">
    .form-check-label{
      cursor: pointer;
    }
  </style>
@endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Customer Payment</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Customer Payment</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_save_change'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Save & Change Customer Transaction.
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
        <form class="form-horizontal" method="post" action="{{ route('customer-payment-process',$transaction->cust_trans_id) }}" id="customerForm">
          @csrf
          <div class="card">
            <div class="card-header custom-card-header">
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-4">
                      <label class="control-label">Full Contact:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." class="form-control" name="full_contact" value="{{ $transaction->full_contact }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('full_contact')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group custom_form_group col-md-4">
                      <label class="control-label">Total Payment:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." name="paymentsummery" class="form-control" value="{{ $transaction->total_pay }}" disabled>
                          <input type="text" name="paymentsummery" value="">
                          @error('total_pay')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group custom_form_group col-md-4">
                      <label class="control-label">Total Due:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." name="due_to_admin_show" class="form-control" value="{{ $transaction->due_to_admin }}" disabled>

                          <input type="hidden" name="due_to_admin" value="{{ $transaction->due_to_admin }}">
                          @error('due_to_admin')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Payment:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." class="form-control" name="total_pay" value="{{ old('total_pay') }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup" onblur="payment()">
                          @error('total_pay')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Remarks:<span class="req_star">*</span></label>
                      <div class="">
                          <textarea name="remarks" class="form-control" placeholder="Remarks..." required data-parsley-pattern="[a-zA-Z-_ ]+$" data-parsley-length="[1,220]" data-parsley-trigger="keyup"></textarea>
                          @error('remarks')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">Payment</button>
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
    {{-- calculation --}}
    <script type="text/javascript">
      /* ================ do work ================ */
      function payment(){
        let full_contact = parseInt($('input[name="full_contact"]').val());

        let total_pay = parseInt($('input[name="total_pay"]').val());
        let paymentsummery = parseInt($('input[name="paymentsummery"]').val());

        if(total_pay != ''){
          let result2 = (paymentsummery + total_pay);
          let result = (full_contact - total_pay);


          $('input[name="paymentsummery"]').val(result2);

          $('input[name="due_to_admin"]').val(result);
          $('input[name="due_to_admin_show"]').val(result);
        }else{
          $('input[name="paymentsummery"]').val(paymentsummery);
          $('input[name="due_to_admin"]').val(full_contact);
          $('input[name="due_to_admin_show"]').val(full_contact);
        }


      }
      /* ================ do work ================ */
    </script>
@endsection
