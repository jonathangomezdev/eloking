#Eloking

Eloking provides a platform for gamers to boost their Ranks either by Playing with qualified Eloking Boosters or Using Eloking Boosting Services.

# Setup

----
## Step 1. Clone Git Repository

COMMAND DISCUSSED
```shell
$ git clone https://github.com/grand-ventures/eloking
```
Clone git repository into your work env.
`git clone https://github.com/grand-ventures/eloking`
---
## Step 2. Install dependencies

COMMAND DISCUSSED
```shell
$ composer install
$ npm install
```

### Step 2.1 Composer
You will need composer to install dependencies. You can find out more about composer here https://getcomposer.org
You will need to `cd` into `eloking` project and run `composer install`.

### Step 2.2 npm
There are frontend packages which we need to be installed in order to compile our frontend assets. In this case we're using npm. You can learn more about that here. https://www.npmjs.com
You will need to `cd` into `eloking` project and run `npm install`

If you didn't hit any error. Then, you should have all required dependencies installed now.

---
## Step 3. `.env` file

COMMAND DISCUSSED
```shell
$ cp .env.example .env
```

Laravel needs `.env` file for configurations, Without certain values the project won't work. So, run `cp .env.example .env` command, and it will create `.env` file from a template in the project called `.env.example`.

---
## Step 4. App Key

COMMAND DISCUSSED
```shell
$ php artisan key:gen
```

As discussed in `Step 3`. Laravel needs certain values from `.env` file to work. `APP_KEY` is one of those value. `cd` into `eloking` project and run this command `php artisan key:gen`. That should override your `.env` file and if you check your `APP_KEY` will have a key.

---
## Step 5. Storage to be available for public

COMMAND DISCUSSED
```shell
$ php artisan storage:link
```

There are certain items which are uploaded via user into the system, and we want those items to be available publicly. So, it can be modified or deleted later by the author. In order for that document to be accessible publicly. We can create a special directory and only items in that directory can be accesssed from a browser. Lucky us, Laravel does that for us. You can just `cd` into your `eloking` directory and run `php artisan storage:link` it will create a symbolic link inside your `eloking/public` directory. Which will link to `storage/app/public` directory. All publicly accessible documents will live here.

---
## Step 6. Compile assets
COMMAND DISCUSSED
```shell
$ npm run watch # OR
$ npm run dev
```
We need to compile assets like `sass` to normal `css`. So, that browser can understand what it's supposed to do. You `cd` into `eloking` directory and run `npm run watch` this will continuously listen if there are changes in files and recompile them automatically. So, that you don't have to compile everytime manually. If you just want to run it once and not listen for changes in files. Then, you can run `npm run dev` and it will compile only once. 

---
## Step 7. Database
COMMAND DISCUSSED
```shell
$ php artisan migrate:fresh --seed
```
We're almost done. Now, we need to link our `eloking` project to a database. You must have `MySQL` installed for this. Find out more about that here. https://www.mysql.com/downloads

### Step 7.1 Configure `.env`
We need to tell `Laravel` through `.env` file about which database to connect and with what credentials. If you've `MySQL` installed. Then, You may already know the credentials for your database. But if you don't. Then, try running `sudo mysql` (Doesn't work on Windows. Looks for xampp, WSL, etc. in Windows case.) and if you get no error then follow this tutorial [Create New MySQL User](https://www.digitalocean.com/community/tutorials/how-to-create-a-new-user-and-grant-permissions-in-mysql). If you hit an error, then you may have to find your MySQL root password. Something like this may help [Find Root password or Reset for MySQL](https://phoenixnap.com/kb/how-to-reset-mysql-root-password-windows-linux) 

Once you've access to database create a database for `eloking` project. You can run following command to create a new database `CREATE DATABASE eloking` name can be anything you like, for this command to work. You must be in MySQL shell.

Now, Open `.env` and put following credentials in it.
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eloking # Name of the database you created above in MySQL
DB_USERNAME=root # name of the user you create above in MySQL
DB_PASSWORD= # It can be empty if your MySQL setup has no password otherwise, Provide a password which you chose during creation of user in MySQL
```

### Step 7.2 Migrate Database
Laravel has blueprint and some dummy data ready for testing. All you've to do is tell laravel to connect to given database in `Step 7.1`, and create all tables and put dummy data. The way you tell Laravel to do that is by running `php artisan migrate:fresh --seed` (You must be in `eloking` directory for this to work). If credentials are correct then you should be able to see all green lines.

That's all. Now, you should have the project working.

---

# Other Setup

## Customer Booster Live Chat

Live chat is powered by [Pusher](https://pusher.com/). In order for live chat to work. You will need to generate api credentials from Pusher. You can create an account, and once you've account created you will need to create an app, You can name it anything you like. Once, you've created the app. You will see some credentials. You will need to put those credentials in following manner inside your `.env` file. 
```dotenv
PUSHER_APP_ID=1317230
PUSHER_APP_KEY=fa18276972e43f2f4b9a
PUSHER_APP_SECRET=f2e58b73d0eca8cee732
PUSHER_APP_CLUSTER=ap2
```
(Those are example values, Replace them with the credentials you've received for your account.)

Also, Make sure in your `.env` file `BROADCAST_DRIVER` is set to `pusher`

Once you do that. Rest should be ok. 

## Email setup
If you would like to receive email from the `eloking` project. Then, you will need to provide credentials to laravel. So, that Laravel can use those credentials to send an actual email.

You can use [Mailtrap](https://mailtrap.io/) for local email testing. It's easiest to setup. You can look at alternatives like Mailhog, gmail (for actual email sending), etc. Credentials would be very similar.

If you would like to use Mailtrap. Then, you can register for a new account or login and it will show you inbox. Click on any inbox, and it will show you credentials.

Open your `.env` file and put those credentials
```dotenv
MAIL_MAILER=smtp # Laravel supports some mail providers out of the box like Mailgun. Read Laravel docs for that.
MAIL_HOST=smtp.mailtrap.io # change if you are not using Mailtrap. Mail Provider will give you this.
MAIL_PORT=2525 # change if you are not using Mailtrap. Mail Provider will give you this.
MAIL_USERNAME=11afb491a1d65c
MAIL_PASSWORD=8db1c77eceb32f
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=something@som.com # If you don't have this, laravel will throw error saying "Cannot send message without sender address"
MAIL_FROM_NAME="${APP_NAME}" # Change if you like, Otherwise, It will use APP_NAME value from your .env file
```
