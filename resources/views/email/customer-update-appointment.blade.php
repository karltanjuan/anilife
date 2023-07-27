@component('mail::message')


Hi Administrator,<br>

There is a new booking with the following details: <br><br>
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

Thank you,<br>
{{ env('APP_NAME') }} <br>


@endcomponent
