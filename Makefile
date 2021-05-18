##Stop Installed Services.
stop: ## So we can use thier ports with docker, otherwise we will get an error of port already in use.
	sudo service mysql stop
	sudo service redis stop
	sudo service apache2 stop

docker-up:
	docker-compose --env-file .env.dev up

docker-build:
	docker-compose --env-file .env.dev up --build

##Profiling and Analyzing the project by blckfire.io
blackfire:
	docker exec blackfire-container blackfire curl nginx-service