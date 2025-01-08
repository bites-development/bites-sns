## Run This To Terminal
composer config repositories.bites-development vcs https://github.com/bites-development/bites-sns.git

## Composer Require
composer require bites-development/bites-sns:dev-main

## Run Vendor
php artisan vendor:publish --tag="sns"

## Add AWS Config at env file
SNS_ACCESS_KEY_ID

SNS_SECRET_ACCESS_KEY

SNS_DEFAULT_REGION
