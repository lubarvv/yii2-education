#!/bin/bash

set -e

# start PHP and nginx
service php7.3-fpm start
service supervisor start
service memcached start
/usr/sbin/nginx
