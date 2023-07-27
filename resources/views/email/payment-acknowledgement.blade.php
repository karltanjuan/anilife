@component('mail::message')


Hi {{ $customer_name }},<br>

Here is the preview of your payment: <br><br>
<style>
	.appointment-table, 
	.appointment-table th,
	.appointment-table td {
	  border: 1px solid #333;
	  border-collapse: collapse;
	  padding: 5px;
	}

</style>
<table class="appointment-table">
	<tr>
		<th>Code</th>
		<th>Date Scheduled</th>
		<th>Payment</th>
		<th>Reference No</th>
		<th>Status</th>	
	</tr>
	<tr>
		<td>{{ $code }}</td>
		<td>{{ date("M d, Y h:i A", strtotime($scheduled_at)) }}</td>
		<td>
			@if ($payment_option == "GCash")
				<span>GCash - {{$payment_amount}}</span>
			@else
				<span>Cash - {{$payment_amount}}</span>
			@endif
		</td>
		<td>
			@if ($payment_option == "GCash")
				<span>{{$payment_reference_no}}</span>
			@endif
		</td>
		<td>{{ $status}}</td>
	</tr>
</table>

<br>

Thank you,<br>
{{ env('APP_NAME') }} <br>


@endcomponent
