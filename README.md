#Hospital Open Source PHP Library

[![Join the chat at https://gitter.im/amarcinkowski/hospitalplugin](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/amarcinkowski/hospitalplugin?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Build Status](https://travis-ci.org/amarcinkowski/hospitalplugin.svg?branch=master)](https://travis-ci.org/amarcinkowski/hospitalplugin)
[![Coverage Status](https://coveralls.io/repos/amarcinkowski/hospitalplugin/badge.svg?branch=master)](https://coveralls.io/r/amarcinkowski/hospitalplugin?branch=master)
[![Code Climate](https://codeclimate.com/github/amarcinkowski/hospitalplugin/badges/gpa.svg)](https://codeclimate.com/github/amarcinkowski/hospitalplugin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/amarcinkowski/hospitalplugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/amarcinkowski/hospitalplugin/?branch=master)

[![Latest Stable Version](https://poser.pugx.org/amarcinkowski/hospitalplugin/v/stable.svg)](https://packagist.org/packages/amarcinkowski/hospitalplugin) [![Total Downloads](https://poser.pugx.org/amarcinkowski/hospitalplugin/downloads.svg)](https://packagist.org/packages/amarcinkowski/hospitalplugin) [![Latest Unstable Version](https://poser.pugx.org/amarcinkowski/hospitalplugin/v/unstable.svg)](https://packagist.org/packages/amarcinkowski/hospitalplugin) [![License](https://poser.pugx.org/amarcinkowski/hospitalplugin/license.svg)](https://packagist.org/packages/amarcinkowski/hospitalplugin)

PHP Library used in Hospital Wordpress plugins

Dev env setup
==================

### Grunt
* `npm install grunt`
* `npm install --save-dev grunt-npm-install`
* `npm install --save-dev load-grunt-tasks`
* `npm install --save-dev time-grunt`
* `grunt npm-install`
* `grunt`

### Bower
Command `npm install -g bower`.

`npm install -g grunt-cli`
`npm install grunt`
`npm install grunt-npm-install`
`sudo grunt npm-install`
`sudo npm install --save-dev load-grunt-tasks time-grunt`
Building and Documentation
`grunt build`
`grunt doc`

### PHPDox
`wget http://phpdox.de/releases/phpdox.phar`
`chmod +x phpdox.phar`
`mv phpdox.phar /usr/local/bin/phpdox`

### Doctrine db
reverse engineering
`php vendor/bin/doctrine orm:convert-mapping --force --from-database annotation ./EXPORT/`
db tables generation based on annotation
`php vendor/bin/doctrine orm:schema-tool:update --force --dump-sql`
