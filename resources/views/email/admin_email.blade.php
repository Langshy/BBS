<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>注册确认链接</title>
</head>
<body>
  <p>
    请点击下面的链接完成注册：
    <a href="{{ route('Admin.confirm_email') }}?token={{$user->verif_token}}">
    {{ route('Admin.confirm_email') }}?token={{$user->verif_token}}
    </a>
  </p>

  <p>
    如果这不是您本人的操作，请忽略此邮件。
  </p>
</body>
</html>