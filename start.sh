#!/bin/sh
docker run -it --rm --network host -v "$PWD:/var/www/html" php74-alpine-mysql ash
