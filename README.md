<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Каталог новостей</h1>
    <br>
</p>
<p>
Проект создан для упоминания в резюме в качестве примеро кода<br/>
и постоянно развивается. В данный момент он ещё довольно сырой.
</p>
<h2>О проекте</h2>
<ol>
<li>Frontend-часть реализована на JS фреймворке Vue.js. (Vue/CLI)</li>
<li>При разработке Frontend-части была использована библиотека
готовых компонентов 
[Element](https://element.eleme.io/#/en-US/component/quickstart)</li>
<li>Backend-часть реализована при помощи фреймворка Yii2<br>
с использованием базы данных MySQL</li>
</ol>

<p>
На данный момент реализовано отображение двух страниц: списка новостей
и просмотра одной новости.<br/>
Backend - REST-сервис, Frontend - Single Page Application.<br/>
На backend-е реализованы две связанные даблицы для новостей и авторов.
</p>



Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.com/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.com/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
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
