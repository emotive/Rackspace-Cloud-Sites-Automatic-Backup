#!/bin/sh

php -d include_path=.:.. ./tests.php 2>&1 | tee output.log

