<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>密码修改确认链接</title>
</head>
<body>
  <p>
    请点击下面的链接完成邮箱验证：
    <a href="{{ route('confirm_password_email') }}?token={{$password->token}}">
    {{route('confirm_password_email')}}?token={{$password->token}}
    </a>
    ,请于30分钟没修改密码。
  </p>

  <p>
    如果这不是您本人的操作，请忽略此邮件。
  </p>
</body>
</html>