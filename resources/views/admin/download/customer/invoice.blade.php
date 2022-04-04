<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ThemeMarch">
  <!-- Site Title -->
  <title>Customer Information</title>
  <link rel="stylesheet" href="{{asset('contents/admin/invoice')}}/assets/css/style.css">
  <link rel="stylesheet" href="{{asset('contents/admin/invoice')}}/assets/css/custom.css">
</head>

<body>
  {{-- do work --}}
  <div class="cs-container2">
    <div class="cs-invoice cs-style1">
      <div class="cs-invoice_in" id="download_section">
        <div class="cs-invoice_head cs-type1 cs-mb25">
          <div class="cs-invoice_left">
            <p class="cs-invoice_number cs-primary_color cs-mb0 cs-f16">
              <b class="cs-primary_color">{{ $data->customer_name }}</b> ({{ $data->customer_id_number }})
            </p>
          </div>
          <div class="cs-invoice_right cs-text_right">
            <div class="cs-logo cs-mb5"><img src="{{ asset($data->customer_photo) }}" alt="Logo"></div>
          </div>
        </div>

        <div class="cs-mb20">
          <ul class="cs-list cs-style1">
            <li>
              <div class="cs-list_left"><b class="cs-primary_color cs-semi_bold">Father Name:</b> {{ $data->customer_father }}</div>
              <div class="cs-list_right"><b class="cs-primary_color cs-semi_bold">Phone</b> {{ $data->customer_phone }}</div>
            </li>
            <li>
              <div class="cs-list_left"><b class="cs-primary_color cs-semi_bold">Email:</b> {{ $data->customer_email == NULL ? 'Not Assigned' : $data->customer_email }}</div>
              <div class="cs-list_right"><b class="cs-primary_color cs-semi_bold">Address:</b> {{ $data->customer_address }}</div>
            </li>
            <li>
              <div class="cs-list_left"><b class="cs-primary_color cs-semi_bold">Passport Number:</b> {{ $data->passport_number }}</div>
              <div class="cs-list_right"><b class="cs-primary_color cs-semi_bold">Passport Location:</b> {{ $data->pp_location }}</div>
            </li>
            <li>
              <div class="cs-list_right"><b class="cs-primary_color cs-semi_bold">Visa Type:</b> {{ $data->visa_type_name }}</div>
              <div class="cs-list_left"><b class="cs-primary_color cs-semi_bold">Visa Name:</b> {{ $data->visa_name }}</div>
            </li>
            <li>
              <div class="cs-list_right"><b class="cs-primary_color cs-semi_bold">Work Name:</b> {{ $data->work }}</div>

            </li>

            <li>
              <div class="cs-list_left"><b class="cs-primary_color cs-semi_bold">Place Of Country:</b> {{ $data->name }}</div>
              <div class="cs-list_right"><b class="cs-primary_color cs-semi_bold">Duration:</b> {{ $data->from_date }} To {{ $data->to_date }} ({{ $data->visa_duration }}) Days</div>
            </li>
            <li>
              <div class="cs-list_left"><b class="cs-primary_color cs-semi_bold">Refference Officer:</b> {{ $data->employee_name }}</div>
              <div class="cs-list_right"><b class="cs-primary_color cs-semi_bold">Apply Date:</b> {{ $data->apply_date }}</div>
            </li>
          </ul>
        </div>

        <hr>
        <div class="others_information">
          <ul>
            <li> <strong>Vecxin:</strong> {{ $data->vecxin == 1 ? 'Yes' : 'No' }} </li>
            <li> <strong>PC:</strong> {{ $data->PC == 1 ? 'Yes' : 'No' }} </li>
            <li> <strong>Medical:</strong> {{ $data->medical == 1 ? 'Yes' : 'No' }} {{ $data->medical == 1 ? $data->medical_date : '' }} </li>
            <li> <strong>Report:</strong> {{ $data->report }} </li>
            <li> <strong>Visa Online:</strong> {{ $data->visa_online == 1 ? 'Yes' : 'No' }} </li>
            <li> <strong>Visa:</strong> {{ $data->visa == 1 ? 'Yes' : 'No' }} </li>
          </ul>

          <ul>

            <li> <strong>Training:</strong> {{ $data->training == 1 ? 'Yes' : 'No' }} </li>
            <li> <strong>Manpower:</strong> {{ $data->manpower == 1 ? 'Yes' : 'No' }} </li>
            <li> <strong>Ticket:</strong> {{ $data->ticket == 1 ? 'Yes' : 'No' }} </li>
          </ul>
        </div>


        <div class="cs-table cs-style2 cs-mb15">
          <div class="cs-round_border">
            <div class="cs-table_responsive">
              <table>
                <thead>
                  <tr class="cs-focus_bg">
                    <th> <span>Full Contact</span> </th>
                    <th> <span>Admin Pay</span> </th>
                    <th> <span>Total Pay</span> </th>
                    <th> <span>Total Due</span> </th>
                    <th> <span>Officer Com</span> </th>
                    <th> <span>Agent Com</span> </th>
                    <th> <span>Total Cost</span> </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td> <span>{{ $data->full_contact }}</span> </td>
                    <td> <span>{{ $data->payment_to_admin }}</span> </td>
                    <td> <span>{{ $data->total_pay }}</span> </td>
                    <td> <span>{{ $data->due_to_admin }}</span> </td>
                    <td> <span>{{ $data->officer_commision }}</span> </td>
                    <td> <span>{{ $data->agent_commision }}</span> </td>
                    <td> <span>{{ $data->cost }}</span> </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="cs-table cs-style1 cs-type1 cs-accent_10_bg">
          <h4>Payment History</h4>
          <div class="cs-table_responsive">
            <table>
              <tbody>
                <tr>
                  <td class="cs-text_center cs-semi_bold">Date</td>
                  <td class="cs-text_right cs-semi_bold">Amount</td>
                  <td class="cs-text_center cs-semi_bold">Remarks</td>
                </tr>
                @forelse ($payment as $amount)
                  <tr>
                    <td class="cs-primary_color cs-text_center">{{ $amount->created_at->format('d/m/Y') }}</td>
                    <td class="cs-primary_color cs-text_right">{{ $data->amount }}</td>
                    <td class="cs-primary_color cs-text_center">{{ $data->remarks }}</td>
                  </tr>
                @empty
                  <p>No payment has been made yet</p>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{-- invoice download button --}}
      <div class="cs-invoice_btns cs-hide_print">
        <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24"/></svg>
          <span>Print</span>
        </a>
        <button id="download_btn" class="cs-invoice_btn cs-color2">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Download</title><path d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M176 272l80 80 80-80M256 48v288"/></svg>
          <span>Download</span>
        </button>
      </div>
    </div>
  </div>
  {{-- do work --}}
  <script src="{{asset('contents/admin/invoice')}}/assets/js/jquery.min.js"></script>
  <script src="{{asset('contents/admin/invoice')}}/assets/js/jspdf.min.js"></script>
  <script src="{{asset('contents/admin/invoice')}}/assets/js/html2canvas.min.js"></script>
  <script src="{{asset('contents/admin/invoice')}}/assets/js/main.js"></script>
</body>
</html>
