#!/bin/bash

source /usr/local/lib/oc-distributor/default.conf

cp $LIB_PATH/distributor_config.php distributor_config.php
mkdir -p d_rules
cp $LIB_PATH/d_rules/* d_rules/