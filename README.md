<h1 align="center">Каталог новостей</h1>
<p>
Проект создан для упоминания в резюме в качестве примера кода<br/>
и постепенно дополняется.
</p>
<h2>О проекте</h2>
<ol>
<li>Frontend-часть реализована на JS фреймворке Vue.js. (Vue-cli@4)</li>
<li>При разработке Frontend-части была использована библиотека
готовых компонентов 
<a href="https://element.eleme.io/#/en-US/component/quickstart">Element</a> 
</li>
<li>Backend-часть реализована при помощи фреймворка Yii2<br>
с использованием базы данных MySQL</li>
<li>Дизайн в проекте отсутствует полностью, ибо я - не дизайнер просто ни разу,<br/>
хоть и к сожалению.</li>
</ol>

<p>
На данный момент реализовано отображение двух страниц: список новостей
и одна новость.<br/>
Backend - REST-сервис, Frontend - Single Page Application.<br/>
На backend-е реализованы две связанные даблицы для новостей и авторов.
В миграциях всё видно.
</p>
<p>В работе данный код можно увидеть <a href="http://yiidevel.r3p.ru">здесь</a>.</p>


СТРУКТУРА КАТАЛОГОВ
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
