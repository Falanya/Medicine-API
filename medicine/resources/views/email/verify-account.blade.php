<h3>Hi: {{ $account->name }}</h3>
<p>
    Please click here to verify your account!
</p>

<p>
    <a href="{{ route('account.verify_account', $account->email) }}">Click here to verify!!!</a>
</p>