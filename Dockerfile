FROM registry.apps.dev.ocp-dev.ised-isde.canada.ca/ised-ci/sclorg-s2i-php:7.3

# The following commands need to be executed as root.

USER root

# Composer
ENV COMPOSER_FILE=composer-installer
RUN curl -s -o $COMPOSER_FILE https://getcomposer.org/installer && \
    php $COMPOSER_FILE --version=1.10.15

# Postgres Client - Required for the backup system.
RUN yum install -y https://download.postgresql.org/pub/repos/yum/reporpms/EL-8-x86_64/pgdg-redhat-repo-latest.noarch.rpm && \
    yum --disablerepo=rhel-8-for-x86_64-appstream-rpms install -y postgresql12 && \
    yum clean all

# Ghostscript - Required in order to annotate PDFs from within Moodle.
RUN yum install -y ghostscript

# TODO: Install php extension: sodium
# RUN yum --enablerepo=remi-php73 install-y php-sodium

# Disable directory listings.
RUN sed -i 's/Options Indexes FollowSymLinks/Options FollowSymLinks/' /etc/httpd/conf/httpd.conf

# Moodle
COPY / /opt/app-root/src
RUN chgrp -R 0 /opt/app-root/src && \
    chmod -R g=u+wx /opt/app-root/src

# Moosh
# 2021-03-05 - Commented out as it has a broken dependency (see https://github.com/tmuras/moosh/issues/367)
# RUN git clone https://github.com/tmuras/moosh.git /opt/app-root/moosh && \
#    ln -s /opt/app-root/moosh/moosh.php /usr/local/bin/moosh
# RUN chgrp -R 0 /opt/app-root/moosh && \
#    chmod -R g=u+wx /opt/app-root/moosh

# Do not run composer as root, according to the documentation.

USER 1001

# Moosh (cont.)
# WORKDIR /opt/app-root/moosh
# RUN /opt/app-root/src/composer.phar install --no-interaction --no-ansi --optimize-autoloader

WORKDIR /opt/app-root/src
RUN ./composer.phar install --no-interaction --no-ansi --optimize-autoloader --no-dev

# The following commands need to be executed as root.

USER root

RUN chgrp -R 0 /opt/app-root/src && \
    chmod -R g=u+wx /opt/app-root/src

# Moosh (cont.)
# RUN chgrp -R 0 /opt/app-root/moosh && \
#    chmod -R g=u+wx /opt/app-root/moosh

RUN chgrp -R 0 /run/httpd && \
    chmod -R g=u /run/httpd

#    rm -rf /run/httpd/*

USER 1001

ENTRYPOINT ["bin/run"]
