<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template - URL Shortener</h1>
    <br>
</p>

### Install with Docker

```
docker-compose up -d --build && docker-compose exec php composer install --optimize-autoloader && docker-compose exec php php yii migrate --interactive 0
```
        
You can then access the application through the following URL:

    http://localhost:20993
