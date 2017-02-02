# Test task to share API

## Requirements

- PHP >= 5.6.4
- MySQL 5.x
- composer
- terminal access
- git

## Installation

- Please get repository to your local computer

```
$ git clone
```
- You need to configure you web server.
Root directory for your domain should be applicationDirectory/public
- If you need use apache, you need to enable mod_rewrite
-
with configured PHP >=5.6
- Move file /.env.example to /.env.
You need to only set there MySQL access data and set APP_KEY for example

```
APP_KEY=base64:5Y7w1INxwOtpA3vhW50FO743j9YrMOxXO+hKPtc4jbo=

```

- in project home directory run
- sub-directories in /storage must be writable

```
$ composer update
```
- in same directory run

```
$ php artisan migrate
```

## Using

- Run unit test
In app directory run
```
$ vendor/bin/phpunit tests
```

For all requests required is plain JSON as parameters.

- User Create
(postman example)

```
HEADERS:
X-Requested-With:XMLHttpRequest
Content-Type: application/json

POST /api/user/create
```
![](https://d17oy1vhnax1f7.cloudfront.net/items/263f2k0O1n24202t3C2C/Image%202017-02-02%20at%204.06.21%20PM.png?v=0adeebab)

Response is JSON object with data or errors

- User edit

```
HEADERS:
X-Requested-With:XMLHttpRequest
Content-Type: application/json

PUT /api/user/edit
```

![](https://d17oy1vhnax1f7.cloudfront.net/items/2V0N0M1R0S0z2h221i1B/Image%202017-02-02%20at%204.09.54%20PM.png?v=ff22275f)

Response is integer grated than 1 or errors

- Create deposit


```
HEADERS:
X-Requested-With:XMLHttpRequest
Content-Type: application/json

POST /api/banking/deposit
```
![](https://d17oy1vhnax1f7.cloudfront.net/items/0B0g0I3x3w3i1j1x2w0F/Image%202017-02-02%20at%204.17.12%20PM.png?v=a0c40c26)

Response is JSON object with data or errors


- Create withdraw

```
HEADERS:
X-Requested-With:XMLHttpRequest
Content-Type: application/json

POST /api/banking/withdraw
```

![](https://d17oy1vhnax1f7.cloudfront.net/items/231k0j3x0u092I2w3L18/Image%202017-02-02%20at%204.18.37%20PM.png?v=0cb6eeb7)

Response is JSON object with data or errors




- Report


```
HEADERS:
X-Requested-With:XMLHttpRequest
Content-Type: application/json

POST /api/report
```
![](https://d17oy1vhnax1f7.cloudfront.net/items/271C1M1L1B3h3e2Q2c30/Image%202017-02-02%20at%204.21.20%20PM.png?v=f5b99127)

![](https://d17oy1vhnax1f7.cloudfront.net/items/1a2V3g2x0I2i2z43202W/Image%202017-02-02%20at%204.29.45%20PM.png?v=068f507e)

![]()
Response is JSON object with data or errors
