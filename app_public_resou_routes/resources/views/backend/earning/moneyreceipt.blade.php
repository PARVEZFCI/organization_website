<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Receipt</title>
</head>
<body>
@php 
         $data = DB::table('settings')->orderBy('id','DESC')->first();
       
    @endphp
  <table style="text-align:center;width:800px;padding-top:20px;">
      <tr>
          <td>
          <img style="margin-left:-50px" width="270" src="{{url($data->logo)}}" alt="">
          </td>
          <td></td>
          <td>
              <span style="color:red;font-size:28px">{{$data->company_name}}</span><br>
              <span>{{$data->address}}</span>
          </td>
      </tr>
      <tr>
          <td> <p style="text-align:left">MR NO.</p> </td>
          <td style="text-align:center"> <h2>Money Receipt </h2> <hr> </td>
          <td> <p>Date-----------------------</p> </td>
      </tr>
      <tr>
         
          <td style="text-align:left;padding-top:20px">Received with Thanks From </td>
          <td colspan="2" style="align:left">{{$earnData->name}} <hr> </td>
      </tr>

      <tr>
         
          <td style="text-align:left;padding-top:20px">Amount Of Taka </td>
          <td colspan="2" style="align:left">{{$earnData->amount}} Taka<hr> </td>
      </tr>

  </table>
    
</body>
</html>