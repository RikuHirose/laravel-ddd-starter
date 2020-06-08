# laravel-ddd-starter
## Descriptions
便利なやつがいろいろ入ってる

## How To Set Up This App

1. Copy .env.example to .env
2. Run `composer install`
3. Run `npm install`
4. Run `php artisan key:generate`
5. Run `php artisan migrate`


## Start server

For local,
```
php artisan serve
```

## Front-end Dev

- For development
```
npm run dev
```
```
npm run watch
```

## ddd
https://little-hands.hatenablog.com/entry/2018/12/10/ddd-architecture

```
- packages
  - Domain
    - Application
     => usecaseの実装クラス
    - Domain
     => domainやvalue object, domain service, repositoryのinterfaceの実装

  - Infrastructure
  => repository, QueryServiceの実装クラスや外部api、通知の実装

  - InMemoryInfrastructure
  => Infrastructure層の実装をtest用にmock化したもの

  - MockInteractor
   => usecaseの実装クラスをtest用にmock化したもの

  - UseCase
   => usecaseのinterfaceやQueryServiceのinterface, input bounday, output boundayを実装
```

Create usecase files including usecase, usecase`s interface, inputdata, outputdata
```
php artisan make:usecase {domain : name of domain name} {usecaseName : The name of usecase}
```