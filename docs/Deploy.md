# Deploy

## Requirements
```bash

docker -v
>>> Docker version 19.03.2, build 6a30dfc

docker-compose -v
>>> docker-compose version 1.23.1, build b02f1306

node -v
>>> v11.1.0

npm -v
>>> 6.10.1

ng version
>>> 
>>>      _                      _                 ____ _     ___
>>>     / \   _ __   __ _ _   _| | __ _ _ __     / ___| |   |_ _|
>>>    / △ \ | '_ \ / _` | | | | |/ _` | '__|   | |   | |    | |
>>>   / ___ \| | | | (_| | |_| | | (_| | |      | |___| |___ | |
>>>  /_/   \_\_| |_|\__, |\__,_|_|\__,_|_|       \____|_____|___|
>>>                 |___/
>>>     
>>> 
>>> Angular CLI: 8.3.5
>>> Node: 11.1.0
>>> OS: linux x64
>>> Angular: 
>>> ... 
>>> 
>>> Package                      Version
>>> ------------------------------------------------------
>>> @angular-devkit/architect    0.803.5
>>> @angular-devkit/core         8.3.5
>>> @angular-devkit/schematics   8.3.5
>>> @schematics/angular          8.3.5
>>> @schematics/update           0.803.5
>>> rxjs                         6.4.0

```

## Backend

Run commands:

```bash

docker-compose up -d

docker exec -it f4u-php composer install

docker exec -it f4u-php /app/bin/console doctrine:migrations:migrate -n

docker exec -it f4u-php /app/bin/console doctrine:fixture:load -n

```

Backend running on http://0.0.0.0:8099

## Frontend

Run commands in main directory (`f4u-test-assignment`):

```bash

cd frontent 

npm install

ng serve

```

Frontend running on http://localhost:4200
