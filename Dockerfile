FROM debian:wheezy

MAINTAINER lcefr <laurent.cetinsoy@gmail.com>

RUN apt-get update 
RUN apt-get install -y php5-cli php5-pgsql

