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

```
- packages
  - Domain
    - Application
     => usecaseの実装クラス
    - Domain
     => domainやvalue object repositoryのinterfaceの実装

  - Infrastructure
  => repositoryの実装クラスや外部api、通知の実装

  - InMemoryInfrastructure
  => Infrastructure層の実装をtest用にmock化したもの

  - MockInteractor
   => usecaseの実装クラスをtest用にmock化したもの

  - UseCase
   => usecaseのinterfaceやinput bounday, output boundayを実装
```