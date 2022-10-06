COMPOSE_FILES=docker-compose.yml

command:
	docker-compose -f $(COMPOSE_FILES) exec php zsh
