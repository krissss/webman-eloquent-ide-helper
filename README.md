# webman-eloquent-ide-helper

## 说明

webman 目前默认使用的 Laravel ORM，已经给 `support/Model` 加上了必要的注释

使用 `webman/console` 的 `webman make:model` 也已经会给模型加上了相应的字段注释

目前仍不能做到的：

- 数据库字段更新后更新注释
- 添加 `getXxxAttribute` 或者模型关联后，不能更新注释

## 简介

给 webman 的 laravel eloquent model 加上注释

使用 [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper#automatic-phpdoc-generation-for-laravel-facades) 

## 安装

```bash
composer require kriss/webman-eloquent-ide-helper
```

## 使用

```
php webman ide-helper:models
```
