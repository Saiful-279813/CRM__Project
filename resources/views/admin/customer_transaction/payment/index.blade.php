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
          @if(Session::has('success_store'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Customer Transaction Done.
            </div>
          @endif


          @if(Session::has('due_amount_0'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Opps!</strong> Your arrears have already been paid.
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
                  <div class="form-group custom_form_group col-md-2">
                      <label class="control-label">Full Contact: <strong>{{ $transaction->full_contact }}</strong> </label>
                  </div>
                  <div class="form-group custom_form_group col-md-2">
                      <label class="control-label">Total Payment: <strong id="payment_amount">{{ $transaction->total_pay }}</strong> </label>
                      <input type="hidden" name="payment_amount_input" value="{{ $transaction->total_pay }}">
                  </div>
                  <div class="form-group custom_form_group col-md-2">
                      <label class="control-label">Total Due: <strong id="due_amount">{{ $transaction->due_to_admin }}</strong> </label>
                      <input type="hidden" name="due_amount_input" value="{{ $transaction->due_to_admin }}">
                  </div>

                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Payment:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." class="form-control" name="total_pay" value="{{ old('total_pay') }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup" onkeyup="payment()">
                          @error('total_pay')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Remarks:</label>
                      <div class="">
                          <textarea name="remarks" class="form-control" placeholder="Remarks..." data-parsley-pattern="[a-zA-Z-_ ]+$" data-parsley-length="[1,220]" data-parsley-trigger="keyup"></textarea>
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
        var due_amountshow = parseFloat( $('#due_amount').text() );

        var due_amount_input = parseFloat( $('input[name="due_amount_input"]').val() );

        var payment_amount_input = parseFloat( $('input[name="payment_amount_input"]').val() );

        var total_pay = parseFloat( $('input[name="total_pay"]').val() );

        if(total_pay >= 0 ){
          var due = (due_amount_input - total_pay);
          var payment = (payment_amount_input + total_pay);
          $('#due_amount').text('');
          $('#due_amount').text(due);

          $('#payment_amount').text('');
          $('#payment_amount').text(payment);
        }else{
          $('#due_amount').text('');
          $('#due_amount').text(due_amount_input);

          $('#payment_amount').text('');
          $('#payment_amount').text(payment_amount_input);
        }

      }
      /* ================ do work ================ */
    </script>
@endsection
