# Whise Demo by Julien

## Postman collection
https://api.whise.eu/docs/postman/WhiseAPI_wd_postman_collection.json

You can import it into Postman application

## Requirements
- PHP >= 8
- Composer

## Installation

Copy .env.dist to .env and fill variables

Get WHISE_TOKEN and WHISE_CLIENTID from https://web.whise.eu/marketplace-admin.html

Example: Client id of 13immo is 2027

## SDK of fw4
https://github.com/fw4-bvba/whise-api

## Usage

### CLI

#### Get list of estates
```bash
php ./back/src/cli.php estates
```

#### Get list of offices
```bash
php ./back/src/cli.php offices
```