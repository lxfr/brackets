# Brackets.php
![Image alt](https://github.com/lxfr/brackets/raw/master/brackets.png)

PHP класс (и пример использования) анализа синтаксиса скобок [ ], ( ), { } в строках. Допускается вложенность написания и наличие текста внутри.

## Как использовать
В файле Brackets.php содержится рабочий класс, а также добавлен следующий пример реализации:
```php
$brackets = new Brackets();
var_dump($brackets->analize('( [ ] { } )')); //вернет true
var_dump($brackets->analize('какой-то текст([{}])')); //вернет true
var_dump($brackets->analize(']неверный синтаксис скобок[([{}])')); //вернет false
var_dump($brackets->analize('{{тест{[123]}}}')); //вернет true
var_dump($brackets->analize('([{}])()[]')); //вернет true
var_dump($brackets->analize('[тест](тест{})')); //вернет true
```
Достаточно запустить скрипт в интерпретаторе PHP, чтобы увидеть результат:
true true false true true true
Протестировано на PHP 7.

## Примечание
Если вы хотите использовать данный PHP класс в качестве рабочего инструмента, не забудьте удалить создание объекта и вызов метода из файла (это сделано для демонстрации).

