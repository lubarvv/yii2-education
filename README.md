# Yii2 basic app for teaching

## Setting up the local environment

Go to your projects directory and clone the repository
```
git clone git@github.com:lubarvv/yii2-education.git
```

Run docker-compose up
```
docker-compose up -d
```

Run migrations
```
docker-compose exec app ./yii migrate
```

After you can see interface in the http://localhost:8080
