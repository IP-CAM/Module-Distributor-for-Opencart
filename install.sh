#!/bin/bash

cp bin/* /usr/local/bin

rm -R /usr/local/lib/oc-distributor
mkdir -p /usr/local/lib/oc-distributor
cp -R lib/* /usr/local/lib/oc-distributor

chmod 755 /usr/local/bin/oc-distribute
chmod 755 /usr/local/bin/oc-dist-deploy
chmod -R 755 /usr/local/lib/oc-distributor

echo 'Success!'