@extends('emails.user.master_user')
@section('body')

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="content-spacing" width="1" style="font-size:0pt; line-height:0pt; text-align:left;"></td>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="p30-15" style="padding: 65px 40px; border-radius: 12px; border: 2px solid #ffd5ab;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="h2 pb10" style="color:#ffffff; font-family:'Playfair Display', Georgia, serif; font-size:35px; line-height:46px; text-align:center; font-style:italic; padding-bottom:10px;"><multiline>Welcome! </multiline></td>
							</tr>
							<tr>
								<td class="text pb30" style="color:#a3a3a3; font-family:'Playfair Display', Georgia, serif; font-size:16px; line-height:30px; text-align:center; padding-bottom:30px;"><multiline>
									<h1>Event Reminder</h1>
									<p>You have an upcoming event: {{ $event->title }}</p>
									<p>From Date: {{ $event->from_date }}</p>
									<p>To Date: {{ $event->to_date }}</p>
									<p>Description: {{ $event->description }}</p>
								</multiline></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td class="content-spacing" width="1" style="font-size:0pt; line-height:0pt; text-align:left;"></td>
	</tr>
</table>
@endsection
