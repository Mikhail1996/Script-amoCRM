<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AuthPage</title>
</head>
<body>
    <form action="auth.php" method="post">
        <label for="email">Логин (электронная почта):</label>
        <input type="email" name="email" id="email" value="sokol-production@yandex.ru" required>
        <label for="hash">Хэш для доступа к API (смотрите в профиле пользователя):</label>
        <input type="text" name="hash" id="hash" value="f19bf63dfb658fb2d0e15bd9253224d0e212ad87" required>
        <input type="submit" value="Авторизоваться">
    </form>
</body>
</html>