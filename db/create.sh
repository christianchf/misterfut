#!/bin/sh

sudo -u postgres dropuser misterfut
sudo -u postgres dropdb misterfut
sudo -u postgres psql -c "create user misterfut password 'misterfut' superuser;"
sudo -u postgres createdb -O misterfut misterfut
