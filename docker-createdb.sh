#!/bin/bash
#
# DO NOT USE THIS SCRIPT ON PRODUCTION!!
#

echo "Recreating database: customers"
mysql -hmysql -uroot -pverysecret -e "drop database if exists customers; create database customers default character set utf8 default collate utf8_unicode_ci";

echo "Recreating database: customers_test"
mysql -hmysql -uroot -pverysecret -e "drop database if exists customers_test; create database customers_test default character set utf8 default collate utf8_unicode_ci";

