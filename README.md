# Whise Demo

## Documentations
### Official documention of Whise API
https://api.whise.eu/WebsiteDesigner.html#tag/Estates/operation/Estates_GetOwnedEstates


### SDK of FW4
https://github.com/fw4-bvba/whise-api

Author: https://www.fw4.immo/

## Postman collection
https://api.whise.eu/docs/postman/WhiseAPI_wd_postman_collection.json

You can import it into Postman application

## Requirements
- PHP >= 8
- Composer | https://getcomposer.org/download/
- pnpm | https://pnpm.io/installation

## Optional
- Make | https://wiki.debian.org/Make
- Concurrently | https://www.npmjs.com/package/concurrently


## Installation

Copy .env.dist to .env and fill variables

Get **WHISE_TOKEN** and **WHISE_CLIENTID** from https://web.whise.eu/marketplace-admin.html

### Back-end
```bash
cd back
composer install
```

### Front-end
```bash
cd front
pnpm i
```


## Explainations

### Back
The back-end written in PHP with some composer dependencies for CLI or API.

You have two features
- CLI
- API

Cli is just call and render data in terminal, you have two commands available.

```bash
# Get list of estates
php ./back/src/cli.php estates

# Get list of offices
php ./back/src/cli.php offices
```

For the API, we just have one endpoint for the front

To launch api server you need to execute this line

```bash
php -S localhost:1234 -t back/src/web
```

http://localhost:1234/api/estates.php

### Front
The front side written in react with typescript.

The builder used is https://vitejs.dev/

```bash
pnpm run dev
```

## Makefile

If you have make and concurrently installed, you can use the Makefile

```bash
# Will install all dependencies
make install

# Will start back-end AND front-end concurrently
make start
```

## Issues ?

For questions relative to the project, make an issue on this repo.

For questions relative to Whise API, make a request to Whise support.

This project is not maintained day to day so please, be kind with me ;)
