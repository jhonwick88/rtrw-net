<h1>bschunts.com</h1>

## How To Start

## Required

- composer
- npm
- nano
- git
- VCS

## Installation
```bash

$ git clone -b snipperMaster https://gitlab.com/pintarmedia/coin-snipper.git

$ cd snipperMaster/

$ composer install

$ cp .env.example .env

$ php artisan key:generate

$ npm install

// 1.1 open .env file with NANO or VCS and setup your local db path
// 1.2 from .env change path api to local MIX_API_PATH (just comment) then save it
// 2. Download database from live and import to local db

$ php artisan serve

$ npm run watch

// after edit is final <b>CHANGE PATH MIX_API_PATH to LIVE Version</b>, and then run :

$ npm run prod

$ git add --all

$ git commit -m "what ever your change"

$ git push origin snipperMaster

// on SSH server goto domain document path

$ cd /public_html

// make sure you're in snipperMaster branch

$ git branch

// update live version

$ git pull

// insert your git user and password

// DONE :D
```

- Docummented by PINTARMEDIA
- Last Update 20-08-2021 20:49 PM
- Location : Nganjuk City