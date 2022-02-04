# TODO DEMO APP

### This app is an example for you to follow in your project.
### In order to use this mvc project you need to install one of this app in your pc
* XAMPP (recommended for windows os)
* LAMPP (recommended for linux os)
* MAMP (recommended for mac os)
### After the installation go to the folder of the app and find htdocs folder
### After opening htdocs folder please paste the TODO DEMO APP project
### Now is all set
## Good job, but we hadn't finished yet :(
## Install Composer to your pc by running the following commands
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
### Perfect now you need to make it available GLOBALLY...
### Run also this command on windows
```bash
mv composer.phar /usr/local/bin/composer
```
### If you are on mac or linux run this command
```bash
sudo mv composer.phar /usr/local/bin/composer
```
## Good job, this was it about configuration
### Now open TODO DEMO APP project in one editor like phpStorm or vsCode and open the integrated terminal
### You need to run the following command to use the magic of composer autoload
```bash
composer dump-autoload -o
```
## Open now xampp or lampp or mamp control panel and start apache and mysql
### Now open [phpMyAdmin](http://localhost/phpMyAdmin) and create a todo_list db and then import todo_list.sql (you can find in this project)
## DONE open now this link [localhost](http://localhost)

