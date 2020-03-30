# AskMe.

The AskMe website allows you to create a question and upload it to a timeline. You will be able to answer questions and delete them. Others will be able to answer and favourite your questions.

There is a search page where you can search for users and go to their profile. Once you are one their profile you can subscribe to them and view their questions on your timeline.

There are also notifications created with websockets. You will get a notification if a user answers, favourites and subscribes to you.

---

## Software I Used

* Laravel (PHP Framework)
* VueJS (JavaScript Framework)
* Vuex (State Management Pattern)
* Bootstrap4 + CSS
* Laravel Websockets

---

## How To Use AskMe.

1. Open A Command Line And Run

```CMS
php artisan serve

or

php artisan serve --host 127.0.0.1:8000 <<<<the url is just an example
```

---

2. Open A __Second__ Command Line And Run

```
npm run watch

or

npm run dev
```

---

3. Open A __Third__ Command Line And Run

```
php artisan websockets:serve
```

---

4. Create A MYSQL database called "askme(1.0)"

---

5. Finally Open A __Fourth__ Command Line and Run

```
php artisan migrate
```