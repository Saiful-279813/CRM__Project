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
  <div class="cs-container">
    <div class="cs-invoice cs-style1">
      <div class="cs-invoice_in" id="download_section">

          <table>
            <thead>
                <tr class="cs-focus_bg">
                    <td class="heading__td__style" style="width: 100%;">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr class="first__row">
                                <td> <span>PP Loc</span> </td>
                                <td> <span>Name</span> </td>
                                <td> <span>Pas</span> </td>
                                <td> <span>Mob</span> </td>
                                <td> <span>Vex</span> </td>
                                <td> <span>PC</span> </td>
                                <td> <span>Medi</span> </td>
                                <td> <span>Rport</span> </td>
                                <td> <span>V.online</span> </td>
                            </tr>
                            <tr class="second__row">

                                <td> <span>1st Pay</span> </td>
                                <td> <span>Visa</span> </td>
                                <td> <span>Trn</span> </td>
                                <td> <span>Mpr</span> </td>
                                <td> <span>Tic</span> </td>
                                <td> <span>Rf.Ofc</span> </td>
                                <td> <span>Wrk</span> </td>
                                <td> <span>County</span> </td>
                                <td> <span>F.Amt</span> </td>


                            </tr>
                            <tr>
                                <td> <span>T.pay</span> </td>
                                <td> <span>Due</span> </td>
                                <td> <span>Pay To Me</span> </td>
                                <td> <span>D.O.Pay-Details</span> </td>
                                <td> <span>Cost</span> </td>
                                <td> <span>Ofc.Com</span> </td>
                                <td> <span>Ag.Com.Pay</span> </td>
                                <td> <span>Date</span> </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </thead>
            <tbody>
              @foreach ($customer_list as $data)
                <tr class="bdr">
                    <td class="body__td__style">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <!-- do work -->
                            <tr class="first__row__tbody">
                                <td> <span>{{ $data->pp_location }}</span> </td>
                                <td> <span>{{ $data->customer_name }}</span> </td>
                                <td> <span>{{ $data->passport_number }}</span> </td>
                                <td> <span>{{ $data->customer_phone }}</span> </td>
                                <td> <span>{{ $data->vecxin == 1 ? 'Yes' : 'No' }}</span> </td>
                                <td> <span>{{ $data->PC == 1 ? 'Yes' : 'No' }}</span> </td>
                                <td> <span>{{ $data->medical == 1 ? 'Yes' : 'No' }} <br> {{ $data->medical_date }} </span> </td>
                                <td> <span>{{ $data->report }}</span> </td>
                                <td> <span>{{ $data->visa_online == 1 ? 'Yes' : 'No' }}</span> </td>

                            </tr>
                            <tr class="second__row__tbody">

                                <td> <span>--</span> </td>
                                <td> <span>{{ $data->visa == 1 ? 'Yes' : 'No' }}</span> </td>
                                <td> <span>{{ $data->training == 1 ? 'Yes' : 'No' }}</span> </td>
                                <td> <span>{{ $data->manpower == 1 ? 'Yes' : 'No' }}</span> </td>
                                <td> <span>{{ $data->ticket == 1 ? 'Yes' : 'No' }}</span> </td>
                                <td> <span>{{ $data->employee_name }}</span> </td>
                                <td> <span>{{ $data->work }}</span> </td>
                                <td> <span>{{ $data->name }}</span> </td>
                                <td> <span>{{ $data->full_contact }}</span> </td>

                            </tr>
                            <tr class="third__row__tbody">
                                <td> <span>{{ $data->total_pay }}</span> </td>
                                <td> <span>{{ $data->due_to_admin }}</span> </td>
                                <td> <span>{{ $data->payment_to_admin }}</span> </td>
                                <td> <span>{{ $data->date }}</span> </td>
                                <td> <span>{{ $data->cost }}</span> </td>
                                <td> <span>{{ $data->officer_commision }}</span> </td>
                                <td> <span>{{ $data->agent_commision }}</span> </td>
                                <td> <span>--</span> </td>
                            </tr>
                            <!-- do work -->


                        </table>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>



      </div>
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
  <script src="{{asset('contents/admin/invoice')}}/assets/js/jquery.min.js"></script>
  <script src="{{asset('contents/admin/invoice')}}/assets/js/jspdf.min.js"></script>
  <script src="{{asset('contents/admin/invoice')}}/assets/js/html2canvas.min.js"></script>
  <script src="{{asset('contents/admin/invoice')}}/assets/js/main.js"></script>
</body>
</html>
