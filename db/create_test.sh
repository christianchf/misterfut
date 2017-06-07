#!/bin/sh

sudo -u postgres dropdb misterfut_test
sudo -u postgres createdb -O misterfut misterfut_test
sudo pg_dump -U misterfut misterfut > misterfut_dump.sql
sudo psql -U misterfut misterfut_test < misterfut_dump.sql
