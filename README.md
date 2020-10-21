# Run the containers => install and build all containers : php, nginx, mysql, node
```bash
sudo docker-compose up -d --build
```

git remote add origin https://github.com/najmi9/docker-symfony-env.git

the work dirctory is app. it means our project should be in app folder.

the server point on public/index.php file in app dirctory (: perfect for symfony.
the port is `8080`.
to install symfony we will go to the php constainer and to the bash then execute the known command to install symfony:

```bash
sudo docker exec -it php74-container bash
symfony new . --full
```

sudoers

to generate a .gitignore file got to `gitignore.io`


install dependencies for node js

```bash
docker-compose run --rm node-service yarn install
```

```bash
sudo docker exec -it mysql8-container bash
```

## Install composer

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
remove cached files from git
```bash
git rm -r --cached node_modules
git commit -m "removing node_modules"
```


