<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TerminalAmoCRM</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <h3>Добавление сделки и контакта:</h3>
    <form action="" id="addform">
        <label for="customername">Имя покупателя:</label>
        <input type="text" name="customername" id="customername">
        <label for="dealname">Название сделки:</label>
        <input type="text" name="dealname" id="dealname">
        <label for="budget">Бюджет:</label>
        <input type="number" step="0.01" min="0" placeholder="0,00" name="budget" id="budget"> ₽
        <input type="submit" id="addbutton" value="Добавить сделку и контакт">
    </form>
    <h3>Таблица сделок:</h3>
    <table id="dealtable" border="1px"></table><br>
    <button id="getbutton">Вывести все сделки за последний месяц</button>
    <script type="text/javascript" src="js.js"></script>
</body>
</html>