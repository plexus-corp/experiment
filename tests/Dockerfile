# Start test build with image containing composer
FROM plexuscorp/phpunit-composer:latest AS test

WORKDIR /var/www/html/experiment

# copy everything except src/ and tests/
COPY bin ./bin
COPY composer.json ./composer.json
COPY phpunit.xml.dist ./phpunit.xml.dist

# setup the os prior to test
RUN if test -f "bin/init-for-test.sh"; then ./bin/init-for-test.sh; fi

# pull in plugins required for testing this plugin
RUN composer require cakephp/app:~4.1 cakephp/debug_kit phpunit/phpunit:^8.5

# copy cake app fundamentals up to the plugin's root dir as if it were a real app
RUN cp -R vendor/cakephp/app/bin . \
    && cp -R vendor/cakephp/app/config . \
    && cp config/app_local.example.php config/app_local.php

# copy in src/ and tests/ late to leverage as much layer cache as possible
COPY src ./src
COPY tests ./tests

# run tests
RUN vendor/bin/phpunit
