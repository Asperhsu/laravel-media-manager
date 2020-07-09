# 打包 ctf0/media-manager v3.6.7
## Why
- compile js, css 花費很多時間，即使不變動也需要與專案一起 compile
- 套件與專案混雜，不易分離
- 使用 bulma css，如與專案不同會導致衝突
- 移除 ctf0/PackageChangeLog 的執行

---
## Install
- install package
    ```shell
    composer require asperhsu/laravel-media-manager
    ```

- publish public assets
    ```shell
    php artisan vendor:publish --tag=MediaManager-public
    ```

- publish config (optional)
    ```shell
    php artisan vendor:publish --tag=MediaManager-config
    ```

- add routes
    ```php
    \ctf0\MediaManager\MediaRoutes::routes();
    ```

完成!  開啟 http://localhost/media

---
## Modal Demo View
```php
// view: [package]/src/resources/views/modal-demo.blade.php
Route::view('/', 'MediaManager::modal-demo');
```

BTW
```php
http://localhost/media aka media.index
// view: [package]/src/resources/views/media.blade.php
```

---
### Modify js, css
- publish assets to resource_path('MediaManager')
    ```shell
    php artisan vendor:publish --tag=MediaManager-assets
    ```

- cd resource_path('MediaManager')
    ```shell
    npm install
    npm run dev/watch/prod
    ```

---
### Note
- view should has @stack('styles) and @stack('scripts)
- @stack('scripts) should between vue.js and new Vue
