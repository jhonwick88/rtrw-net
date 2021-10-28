<h1>RT RW Net</h1>
<p>Payment report system management for RTRWNet</p>

## How To Start

## Required

- composer
- npm
- nano
- git
- VCS

## Installation
```bash

$ mkdir YOUR_DIR

$ cd YOUR_DIR

$ git clone -b masterDeni https://github.com/jhonwick88/rtrw-net.git

$ cd rtrw-net

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

$ git push origin masterDeni

// on SSH server goto domain document path

$ cd /public_html

// make sure you're in masterDeni branch

$ git branch

// update live version

$ git pull

// insert your git user and password

// DONE :D
```

- Docummented by PINTARMEDIA
- Last Update 28-10-2021 21:56 PM
- Location : Nganjuk City
