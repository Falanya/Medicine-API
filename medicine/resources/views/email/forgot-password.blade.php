<p>Hello, {{ $formData['user']->fullname }}!!!</p>
<p>You have requested to reset password</p>
<p>Please click the link below to reset password</p>
<p><a href="{{ route('account.reset_password', $formData['token']) }}">Click Here</a></p>