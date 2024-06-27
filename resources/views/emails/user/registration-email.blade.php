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
								<td class="h2 pb10" style="color:#ffffff; font-family:'Playfair Display', Georgia, serif; font-size:35px; line-height:46px; text-align:center; font-style:italic; padding-bottom:10px;"><multiline>Thank you for  your registration </multiline></td>
							</tr>
							<tr>
								<td class="text pb30" style="color:#a3a3a3; font-family:'Playfair Display', Georgia, serif; font-size:16px; line-height:30px; text-align:center; padding-bottom:30px;"><multiline>Your account is under observation. After reviewing your identity, we will let you know via email. Till then  thank's for your patience </multiline></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- Button -->
				<tr>
					<td align="center">
						<table border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;margin-bottom:15px;">
							<tr>
								<td class="text-button" style="border:2px solid #ffffff; color:#ffffff; font-family:'Playfair Display', Georgia, serif; font-size:14px; line-height:18px; text-align:center; font-weight:bold; padding:14px 20px; text-transform:uppercase; border-radius:10px;"><multiline><a href="{{route('login')}}" target="_blank" class="link-white" style="color:#ffffff; text-decoration:none;"><span class="link-white" style="color:#ffffff; text-decoration:none;"><a href="{{route('home')}}">Retina Soft</a></span></a></multiline></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- END Button -->
			</table>
		</td>
		<td class="content-spacing" width="1" style="font-size:0pt; line-height:0pt; text-align:left;"></td>
	</tr>
</table>
@endsection
