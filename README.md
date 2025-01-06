## Run This To Terminal
composer config repositories.bites-development vcs https://github.com/bites-development/bites-sns.git

## Composer Require
composer require bites-development/bites-sns:dev-main

## Run Vendor
php artisan vendor:publish --tag="sns"

## Add AWS Config at env file
AWS_ACCESS_KEY_ID

AWS_SECRET_ACCESS_KEY

AWS_DEFAULT_REGION
