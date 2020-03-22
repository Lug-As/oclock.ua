<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Error Development</title>
</head>
<body>

    <h1>Произошла ошибка</h1>
    <p><b>Код ошибки:</b> <?= $errno; ?></p>
    <p><b>Текст ошибки:</b> <?= $errstr; ?></p>
    <p><b>Файл:</b> <?= $errfile; ?></p>
    <p><b>Строка:</b> <?= $errline; ?></p>
    <p><a href="<?=PATH; ?>">На главную</a></p>

</body>
</html>
