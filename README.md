### Prerequisites

1. Docker Installed.
1. Docker Compose Installed.

Make sure that the ports:
- 8000 For Nginx.
- 6379 For Redis, 
- 5050 For Adminer,
- 3306 For Mysql.
- 9000 For php7.4-fpm.

are available on your host, if you use Mysql, Redis and Apache2 on the default ports you need to stop them before running docker containers  by the commands:

```bash
make stop
```
You can check all opened ports on you device by the command: 
```bash
sudo netstat -anptu # Run sudo apt-get install net-tools to install netstat
```

Afetr that change the dirctory to the root of your project and run this command to start the containers:
```bash
make docker-build
make docker-up
```
## list of containers
1. nginx-container as web server listen on port 8000
2. node-container to work with Wepack Encore
3. php7.4-container
4. redis-container
5. adminer-container listen on port 5050(http://localhost:5050) to see the database and the tables.
6. mariadb-container as sql server
7. messenger-container to run the worker `messenger:consume`
8. mercure-container on port 3000
9. mail-container on http://localhost:8025 to test email in dev environment.
10. blackfire-container

After you run the containers in the terminal, you need to configure the .env file:
```python
DATABASE_URL=mysql://root:root@mariadb-service:3306/db_name?serverVersion=mariadb-10.4.11 # Replace only your the db_name.
REDIS_URL=redis://redis
MESSENGER_TRANSPORT_DSN=redis://redis:6379
```
Now you need to go the php7.4-container to create the database abd run the migrations, first to go inside the container run this:
```bash
sudo docker exec -it php7.4-container bash
```

So there you can run the `php bin/console`, `composer` or `symfony` commands, so create the database as usual:
```bash
symfony console doctrine:database:create
symfony console doctrine:schema:update --force
```

To update the packeges of nodejs, you need first to go inside the container and update node modules:

```bash
sudo docker exec -it node-container sh
yarn install
# or
docker exec node-conatiner yarn install
```

Then go to adminer container at http://localhost:5050 to see the tables.
The password is **root** and replace the db_name by your database name or remove it.

If evverything is good now you can see your application on http://localhost:8000.

If you want to see the logs of a conatiner in case you want to debug an error:
```bash
docker logs messenger-container -f #docker logs container_name -f
docker logs mercure-container -f 
```