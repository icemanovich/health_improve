# health_improve
НаПоправку форма записи ко врачу


### Постановка задачи: 
Нужно написать упрощенную систему записи на прием к врачу.
Есть посетитель, врачи клиники и система.
Посетитель может выбрать нужного ему врача, выбрать интересующую дату и увидеть ленту записи на прием.
Посетитель находит свободное время кликает "записаться" на приём, система фиксирует, что указанное время занято.
Если у врача на указанную дату нет свободной записи при попытке выбрать дату пользователю должна сообщаться информация, что записи на этот день больше нет.

### Техника:
PHP (ООП), mysql, клиентская сторона на усмотрение. Допускается использование любых фреймворков. Желательно показать умение использовать AJAX. Проект должен быть на гитхабе и отражать процесс разработки.
Обратить внимание на безопасность кода, основательность подхода, расчет на нагрузку.

### В результате:
Ссылка на гитхаб и развёрнутое демо.

------

### Установка проекта

- Склонировать проект командой
`$ git clone https://github.com/icemanovich/health_improve.git`

- Установить зависимости
```
$ cd health_improve;
$ composer update;
```
- Настроить .env файл для окружения
- При использовании БД Sqlite необходимо создать файл для БД
```
$ touch database/DB_NAME;

(или имя файла по-умолчанию)
$ touch database/database.sqlite;
```
- Применить миграции и наполнение (seeding)
```
$ php artisan migrate

$ php artisan db:seed
```

### Аккаунты

В системе предустановлены пользователи. Для теста можно воспользоваться аккаунтами докторов и пользователей.
- doc1@example.com / qwerty
- doc2@example.com / qwerty
- user1@example.com / qwerty
- user2@example.com / qwerty


### Demo

Демо доступно по [ссылке](http://176.112.213.197/)

