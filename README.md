# Тестовое задание стажера
## Настройка
Для настройки сервиса впишите данные в **config.php**. Все константы стандартные кроме "**TABLE_NAME**", которая определяет название будущей таблицы.
## Описание
**1**.Для генерации значения выберите тип значения, введите длину строки и подстроку в корне сайта. По нажатию generate будет отправлен *POST* запрос на адрес **/api/generate/**
Данные хранятся в таблице из 2 столбцов:
- id (уникальный идентификатор, по которому определяется значение);
- random_value (само значение с ограничением до 100 символов).

**2**.Для получения значения по id по *GET* запросу впишите в адрес **/api/retrieve/?id=n**. Где n - номер id.