#! /bin/bash
#
# The default installation instruction with Docker from Yiisoft do not work.
# This script fix problem with permissions.
#

chown -R www-data.www-data web runtime
