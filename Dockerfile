version: '3.8'

services:
  laravel.test:
    image: 'ghcr.io/laravel/sail:1.12.0-php8.1'
    container_name: project_api_management_app
    extra_hosts:
      - 'host.docker.internal:host-gateway'
    environment:
      WWWUSER: 1000
      WWWGROUP: 1000
      LARAVEL_SAIL: 1
      XDEBUG_MODE: 'off'
      IGNITION_LOCAL_SITES_PATH: '${PWD}'
    ports:
      - '${APP_PORT:-80}:80'
      - '${VITE_PORT:-5173}:${VITE_PORT:-5173}'
    volumes:
      - '.:/var/www/html'
    networks:
      - sail
    depends_on:
      - db
      - redis

  db:
    image: 'mysql/mysql-server:8.0'
    container_name: project_api_management_db
    environment:
      MYSQL_ROOT_PASSWORD: 'root_password'
      MYSQL_DATABASE: 'project_db'
      MYSQL_USER: 'sail'
      MYSQL_PASSWORD: 'password'
    networks:
      - sail
    ports:
      - '3306:3306'
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-p${DB_PASSWORD}"]
      retries: 3
      timeout: 5s

  redis:
    image: 'redis:alpine'
    container_name: project_api_management_redis
    networks:
      - sail
    ports:
      - '6379:6379'
    healthcheck:
      test: ["CMD", "redis-cli", "ping"]
      retries: 3
      timeout: 5s

  phpmyadmin:
    image: 'phpmyadmin/phpmyadmin'
    container_name: project_api_management_phpmyadmin
    environment:
      PMA_HOST: db
      MYSQL_ROOT_PASSWORD: root_password
    networks:
      - sail
    ports:
      - '8081:80'
    depends_on:
      - db

networks:
  sail:
    driver: bridge

volumes:
  sail-mysql:
    driver: local
  sail-redis:
    driver: local
