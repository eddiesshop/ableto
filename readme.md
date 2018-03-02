##  Prerequisites

composer, npm, git

If you don't have the prereq's, in an ubuntu-server environment run the following:

sudo apt-get update
sudo apt-get install curl php-cli php-mbstring git unzip
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

sudo apt-get install nodejs
sudo apt-get install npm

apt-get install git-core

## Starting Application

git clone https://github.com/eddiesshop/ableto.git

composer install
npm install --no-bin-links
sudo npm install --global cross-env
sudo npm install -g acorn
sudo npm install -g webpack-cli -D

php artisan key:generate
php artisan config:clear
php artisan config:cache

php artisan migrate
php artisan db:seed