@component('mail::message')


Hi {{ $customer_name }},<br>

Here is the update for your booked appointment: <br><br>
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
		<th>Date Updated</th>
		<th>Status</th>	
	</tr>
	<tr>
		<td>{{ $code }}</td>
		<td>{{ date("M d, Y h:i A", strtotime($scheduled_at)) }}</td>
		<td>{{ date("M d, Y h:i A", strtotime($updated_at))}}</td>
		<td>{{ $status}}</td>
	</tr>
</table>

<br>

@if($status == "Confirmed")
<span>We are waiting for your pets on our clinic!</span><br><br>
@elseif($status == "Cancelled")
<span>We are sorry for the inconvience. If you have further questions, don't hesitate to contact us!</span><br><br>
@elseif($status == "Completed")
<span>Thank you for your time on our clinic, see you again next time!</span><br><br>
@endif

Thank you,<br>
{{ env('APP_NAME') }} <br>


@endcomponent
