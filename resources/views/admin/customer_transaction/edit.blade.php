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
              <h4 class="mb-0 font-size-18">Customer Transaction</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Customer Transaction</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  {{-- response massege --}}
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
          @if(Session::has('success_store_first_step'))
            <div class="alert alert-success alertsuccess" role="alert">
               <strong>Successfully!</strong> Done First Step.
            </div>
          @endif

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
        <form class="form-horizontal" method="post" action="{{ route('customer-trnasaction.update',$data->cust_trans_id) }}" enctype="multipart/form-data" id="customerForm">
          @csrf
          @method('put')
          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Customer Transaction</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('customer-trnasaction.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> Customer Transaction List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body card_form">
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Full Contact:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." class="form-control" onkeyup="fullContact()" name="full_contact" value="{{ $data->full_contact }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('full_contact')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Officer Commission:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." class="form-control" onkeyup="officerCommision()" name="officer_commision" value="{{ $data->officer_commision }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('officer_commision')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror


                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Agent Commission:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." onkeyup="agentCommision()" class="form-control" id="agent_commision" name="agent_commision" value="{{ $data->agent_commision }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('agent_commision')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Total Costing:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." class="form-control" id="cost" name="cost" value="{{ $data->cost }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('cost')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                          <input type="hidden" id="temporaryOfficerComision" value="">
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Payment To Admin:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." onkeyup="paymentToAdmin()" class="form-control" name="payment_to_admin" value="{{ $data->payment_to_admin }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup">
                          @error('payment_to_admin')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>


                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Payment:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." onkeyup="paymentToNormal()" class="form-control" name="total_pay" value="{{ $data->total_pay }}" required data-parsley-pattern="[0-9]+$" min="0" data-parsley-length="[1,50]" data-parsley-trigger="keyup" onkeyup="payment()">
                          @error('total_pay')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Total Due:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="text" placeholder="Amount..." name="due_to_admin_show" class="form-control" value="{{ $data->due_to_admin }}" disabled>

                          <input type="hidden" name="due_to_admin" value="{{ $data->due_to_admin }}">
                          @error('due_to_admin')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group custom_form_group col-md-6 m-auto">
                      <label class="control-label">Date:<span class="req_star">*</span></label>
                      <div class="">
                          <input type="date" class="form-control" name="date" value="{{ $data->date == NULL ? Carbon\Carbon::now()->format('Y-m-d') : $data->date }}" required>
                          @error('date')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                </div>
            </div>

              <div class="card-footer card_footer_button text-center">
                  <button type="submit" class="btn btn-primary waves-effect">SAVE & CHANGE</button>
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
      function officerCommision(){
        var officer_commision = parseFloat( $('input[name="officer_commision"]').val() );
        if(officer_commision >= 0){
          $("#cost").val('');
          $("#cost").val(officer_commision);
          // temporaryField
          $("#temporaryOfficerComision").val('');
          $("#temporaryOfficerComision").val(officer_commision);
        }else{
          $("#cost").val('');
          $("#cost").val(0);
          $("#temporaryOfficerComision").val('');
          $("#temporaryOfficerComision").val(0);
        }
      }

      function agentCommision(){
        var agent_commision = parseFloat( $('#agent_commision').val() );
        var officer_commision = parseFloat( $('input[id="temporaryOfficerComision"]').val() );

        if(agent_commision >= 0){
          var total_costing = (agent_commision + officer_commision);
          $("#cost").val('');
          $("#cost").val(total_costing);
        }else{
          $("#cost").val('');
          $("#cost").val(officer_commision);
        }

      }

      // ================ Full Contact ===========
      function fullContact(){
        var full_contact = parseFloat( $('input[name="full_contact"]').val() );

        var total_pay = parseFloat( $('input[name="total_pay"]').val() );
        var payment_to_admin = parseFloat( $('input[name="payment_to_admin"]').val() );
        var totalPayment = (total_pay + payment_to_admin);

        if(full_contact >= 0){
          var due = (full_contact - totalPayment);
          $('input[name="due_to_admin_show"]').val('');
          $('input[name="due_to_admin"]').val('');
          $('input[name="due_to_admin_show"]').val(due);
          $('input[name="due_to_admin"]').val(due);
        }else{
          $('input[name="due_to_admin_show"]').val('');
          $('input[name="due_to_admin"]').val('');
          $('input[name="due_to_admin_show"]').val(0);
          $('input[name="due_to_admin"]').val(0);
        }

      }
      // ================ Full Contact ===========
      // ================ Payment To Admin ===========
      function paymentToAdmin(){
        var payment_to_admin = parseFloat( $('input[name="payment_to_admin"]').val() );
        var total_pay = parseFloat( $('input[name="total_pay"]').val() );
        var full_contact = parseFloat( $('input[name="full_contact"]').val() );

        if(payment_to_admin >= 0){
          var totalPay = (payment_to_admin + total_pay);
          var due = (full_contact - totalPay);
          $('input[name="due_to_admin_show"]').val('');
          $('input[name="due_to_admin"]').val('');
          $('input[name="due_to_admin_show"]').val(due);
          $('input[name="due_to_admin"]').val(due);
        }else{
          var totalPay = (0 + total_pay);
          var due = (full_contact - totalPay);
          $('input[name="due_to_admin_show"]').val('');
          $('input[name="due_to_admin"]').val('');
          $('input[name="due_to_admin_show"]').val(due);
          $('input[name="due_to_admin"]').val(due);

        }


      }
      function paymentToNormal(){
        var payment_to_admin = parseFloat( $('input[name="payment_to_admin"]').val() );
        var total_pay = parseFloat( $('input[name="total_pay"]').val() );
        var full_contact = parseFloat( $('input[name="full_contact"]').val() );

        if(total_pay >= 0){
          var totalPay = (payment_to_admin + total_pay);
          var due = (full_contact - totalPay);
          $('input[name="due_to_admin_show"]').val('');
          $('input[name="due_to_admin"]').val('');
          $('input[name="due_to_admin_show"]').val(due);
          $('input[name="due_to_admin"]').val(due);
        }else{
          var totalPay = (0 + total_pay);
          var due = (full_contact - totalPay);
          $('input[name="due_to_admin_show"]').val('');
          $('input[name="due_to_admin"]').val('');
          $('input[name="due_to_admin_show"]').val(due);
          $('input[name="due_to_admin"]').val(due);

        }


      }
      /* ================ do work ================ */
    </script>
@endsection
