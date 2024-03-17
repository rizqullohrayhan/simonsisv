<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="login.css">
</head>
<body>

<div class="log-form">
  <h2>Login to your account</h2>
  <form action="{{route('proses_logdev')}}" method="POST">
    @csrf
    <input type="text" title="username" placeholder="email" name="email" required/>
    <input type="password" title="username" placeholder="password" name="password" required/>
    <button type="submit" class="btn">Login</button>
  </form>
</div><!--end log form -->

</body>
</html>
