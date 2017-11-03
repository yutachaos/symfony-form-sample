# from amazon linux Image
FROM amazonlinux:2017.09
#
# PHP 7.0, Apache , git
RUN yum -y install httpd24 php70 php70-opcache php70-devel php70-mbstring php70-mcrypt php70-mysqlnd php70-pecl-xdebug php70-pecl-xhprof zip unzip git gcc && \
    sed -i -e "s/;date.timezone *=.*$/date.timezone = UTC/" /etc/php.ini  && \
    sed -i -e "s/AllowOverride None/AllowOverride All/" /etc/httpd/conf/httpd.conf && \
    sed -i -e "s/Options Indexes FollowSymLinks/Options -Indexes +FollowSymLinks/" /etc/httpd/conf/httpd.conf

RUN rm -rf /var/www/html && \
    mkdir -p /var/www/src/web && \
    ln -snf /var/www/src/web /var/www/html
WORKDIR /var/www/src
ENTRYPOINT /usr/sbin/httpd -D FOREGROUND