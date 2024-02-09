<h3>Welcome {{ $account_user->fullname }} to Medicine Mart</h3>
<p>
    Please click here to verify your account!
</p>

<p>
    <a href="{{ route('users.verify-account', $account_user->email) }}">Click here to verify!!!</a>
</p>