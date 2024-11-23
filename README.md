## Simple sample application that forecasts the weather

![scrrenshot](https://raw.githubusercontent.com/plishkin/weather/refs/heads/main/screenshot.png)

### Uses

- **[Laravel](https://laravel.com/)**
- **[Typescript](https://www.typescriptlang.org/)**
- **[ReactJS](https://reactjs.org/)**
- **[SCSS](https://sass-lang.com/)**
- **[WebSocket](https://en.wikipedia.org/wiki/WebSocket)**
- **[Docker](https://www.docker.com/)**

## Installation

### Clone the project with git

```bash
git clone https://github.com/plishkin/weather.git
```

Go to the cloned project folder

```bash
cd weather
```

Copy and configure .env file

by default APP_PORT is 8082

```bash
cp .env.example .env
```

Add your Openweathermap API appid to the key OPENWEATHERMAPID in .env file
For ex.

```
OPENWEATHERMAPID=myappidkey
```


### Up and running with docker

#### Make sure you use docker at least 26.0 version
#### Run build script

```bash
bash docker_build.sh
```

### Visit in your browser

http://localhost:8082

### Run tests

#### Backend

```bash
docker compose exec laravel.test php artisan test
```

#### Frontend

```bash
docker compose exec laravel.test npm run test
```
