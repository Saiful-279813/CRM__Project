@extends('layouts.admin')
@section('customer') active mm-active @endsection
@section('customer_child') active @endsection
@section('content')
  {{-- breadcrumb --}}
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0 font-size-18">Customer</h4>
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active">Customer</li>
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
               <strong>Successfully!</strong> Create New Customer.
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
        <form class="form-horizontal" method="post" action="{{ route('customers.store') }}" enctype="multipart/form-data" id="customerForm">
          @csrf

          <div class="card">
            <div class="card-header custom-card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title card_top_title"><i class="fab fa-gg-circle"></i> Create New Customer</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('customers.index') }}" class="btn btn-md btn-primary waves-effect card_top_button"><i class="fa fa-th"></i> All Customer List </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

              {{-- do work --}}
              <div class="row">
               {{-- Customer step --}}
                 <div class="col-md-6">
                     {{-- form element --}}
                     <div class="card-body card_form">
                         <h4>Customer Information</h4>
                         <hr>
                         <div class="form-group custom_form_group">
                             <label class="control-label">Customer Id No:<span class="req_star">*</span></label>
                             <div class="">
                                 <input type="text" placeholder="{{ $customerIdNo }}" class="form-control" disabled>
                                 <input type="hidden" class="form-control" name="customer_id_number" value="{{ $customerIdNo }}">
                             </div>
                         </div>

                         <div class="form-group custom_form_group">
                             <label class="control-label">Name:<span class="req_star">*</span></label>
                             <div class="">
                                 <input type="text" placeholder="Name" class="form-control" name="customer_name" value="{{old('customer_name')}}" required data-parsley-pattern="[a-zA-Z_ ]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                                 @error('customer_name')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group custom_form_group">
                             <label class="control-label">Father Name:<span class="req_star">*</span></label>
                             <div class="">
                                 <input type="text" placeholder="Father Name" class="form-control" name="customer_father" value="{{old('customer_father')}}" required data-parsley-pattern="[a-zA-Z_ ]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                                 @error('customer_father')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group custom_form_group">
                             <label class=" control-label">Phone Number:<span class="req_star">*</span></label>
                             <div class="">
                                 <input type="text" placeholder="Phone" class="form-control" name="customer_phone" value="{{old('customer_phone')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[11,15]" data-parsley-trigger="keyup">
                                 @error('customer_phone')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group custom_form_group">
                             <label class="control-label">Email Address:</label>
                             <div class="">
                                 <input type="email" placeholder="Email" class="form-control" name="customer_email" value="{{old('customer_email')}}" data-parsley-length="[10,50]" data-parsley-trigger="keyup">
                             </div>
                         </div>

                         <div class="form-group custom_form_group">
                             <label class="control-label">Total Cost:<span class="req_star">*</span></label>
                             <div class="">
                                 <input type="text" placeholder="Amount" class="form-control" name="total_cost" value="0{{old('total_cost')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[1,15]" data-parsley-trigger="keyup">
                                 @error('total_cost')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group custom_form_group">
                             <label class="control-label">Payment:<span class="req_star">*</span></label>
                             <div class="">
                                 <input type="text" placeholder="Amount" class="form-control" name="payment" value="{{old('payment')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[1,15]" data-parsley-trigger="keyup">
                                 @error('payment')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group custom_form_group">
                             <label class="control-label">Due:<span class="req_star">*</span></label>
                             <div class="">
                                 <input type="text" placeholder="Amount" class="form-control" name="due" value="{{old('due')}}" required data-parsley-pattern="[0-9]+$" data-parsley-length="[1,15]" data-parsley-trigger="keyup">
                                 @error('due')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group custom_form_group">
                             <label class="control-label">Apply Date:<span class="req_star">*</span></label>
                             <div class="">
                                 <input type="date" class="form-control" name="apply_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                             </div>
                         </div>

                         <div class="form-group custom_form_group">
                             <label class="control-label">Address:<span class="req_star">*</span></label>
                             <div class="">
                                 <textarea name="customer_address" rows="8" cols="80" class="form-control" placeholder="Address Here..." required data-parsley-pattern="[a-zA-Z0-9]+$" data-parsley-length="[10,255]"
                                   data-parsley-trigger="keyup">{{ old('customer_address') }}</textarea>
                                 @error('customer_address')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group">
                             <label class="control-label">Photo:<span class="req_star">*</span></label>
                             <div class="row">
                                 <div class="col-md-4">
                                   <input type="file" name="customer_photo" id="imgInp" required>
                                   {{-- data-parsley-fileextension='' --}}
                                   @error('customer_photo')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                                 </div>
                                 <div class="col-md-6">
                                   <img id="img-upload" / width="150">
                                 </div>
                             </div>


                         </div>
                     </div>
                     {{-- visa Information --}}
                 </div>
               {{-- Visa step --}}
                 <div class="col-md-6">
                   {{-- form element --}}
                   <div class="card-body card_form">
                       <h4>Visa Information</h4>
                       <hr>

                       <div class="form-group custom_form_group">
                           <label class="control-label">Visa Number:<span class="req_star">*</span></label>
                           <div class="">
                             <input type="text" placeholder="Visa Number" class="form-control" name="visa_number" value="{{old('visa_number')}}" required data-parsley-pattern="[a-zA-Z0-9]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                             @error('visa_number')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                           </div>
                       </div>

                       <div class="form-group custom_form_group">
                           <label class="control-label">Passport Number:<span class="req_star">*</span></label>
                           <div class="">
                             <input type="text" placeholder="Passport Number" class="form-control" name="passport_number" value="{{old('passport_number')}}" required data-parsley-pattern="[a-zA-Z0-9]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                             @error('passport_number')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                           </div>
                       </div>

                       <div class="form-group custom_form_group">
                           <label class="control-label">Place Of Issue:<span class="req_star">*</span></label>
                           <div class="">
                             <input type="text" placeholder="Place Of Issue" class="form-control" name="place_of_issue" value="{{old('place_of_issue')}}" required data-parsley-pattern="[a-zA-Z0-9]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                             @error('place_of_issue')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                           </div>
                       </div>

                       <div class="form-group custom_form_group">
                           <label class="control-label">Visa Type:<span class="req_star">*</span></label>
                           <div class="">
                             <input type="text" placeholder="Visa Type" class="form-control" name="visa_type" value="{{old('visa_type')}}" required data-parsley-pattern="[a-zA-Z0-9]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                             @error('visa_type')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                           </div>
                       </div>

                       <div class="form-group custom_form_group">
                           <label class="control-label">Visa Name:<span class="req_star">*</span></label>
                           <div class="">
                             <input type="text" placeholder="Visa Name" class="form-control" name="visa_name" value="{{old('visa_name')}}" required data-parsley-pattern="[a-zA-Z0-9]+$" data-parsley-length="[3,50]" data-parsley-trigger="keyup">
                             @error('visa_name')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                           </div>
                       </div>

                       <div class="form-group custom_form_group">
                           <label class="control-label">From Date:<span class="req_star">*</span></label>
                           <div class="">
                             <input type="date" class="form-control" name="from_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                           </div>
                       </div>

                       <div class="form-group custom_form_group">
                           <label class="control-label">End Date:<span class="req_star">*</span></label>
                           <div class="">
                             <input type="date" class="form-control" name="to_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                           </div>
                       </div>

                       <div class="form-group custom_form_group">
                           <label class="control-label">Remarks:<span class="req_star">*</span></label>
                           <div class="">
                             <textarea name="visa_remarks" rows="8" cols="80" class="form-control" placeholder="Remarks Here..." required data-parsley-pattern="[a-zA-Z0-9]+$" data-parsley-length="[0,500]" data-parsley-trigger="keyup">{{ old('visa_remarks') }}</textarea>
                             @error('visa_remarks')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                           </div>
                       </div>

                       <div class="form-group">
                         <label class="control-label">Visa Image:<span class="req_star">(Scan Copy)</span></label>
                         <div class="row">
                           <div class="col-md-4">
                             <input type="file" name="visa_image" id="imgInp2" required>
                             {{-- data-parsley-fileextension='' --}}
                             @error('visa_image')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                           </div>
                           <div class="col-md-3">
                             <img id="img-upload2"/ width="150">
                           </div>
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="control-label">Passport Image:<span class="req_star">(Scan Copy)</span></label>
                         <div class="row">
                           <div class="col-md-4">
                             <input type="file" name="passport_image" id="imgInp3" required onchange="passportImage(this)">
                             {{-- data-parsley-fileextension='' --}}
                             @error('passport_image')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror
                           </div>
                           <div class="col-md-3">
                             <img id="img-upload3"/ width="150">
                           </div>
                         </div>

                       </div>

                   </div>
                   {{-- visa Information --}}
               </div>
              </div>
              {{-- do work --}}
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
