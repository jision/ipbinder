#!/bin/bash

iptables -I INPUT -p tcp -s $1 --dport 3306 -j ACCEPT

