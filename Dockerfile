FROM ubuntu:22.04
RUN apt-get update -q \
  && DEBIAN_FRONTEND=noninteractive apt-get install -qy mysql-client \
  && apt-get clean \
  && rm -rf /var/lib/apt
ENTRYPOINT ["mysql"]