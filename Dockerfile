FROM registry.apps.ocp.dev.ised-isde.canada.ca/ised-ci/sclorg-s2i-php:7.4

# The following commands need to be executed as root.

USER root

# Composer
ENV COMPOSER_FILE=composer-installer
RUN curl -s -o $COMPOSER_FILE https://getcomposer.org/installer && \
    php $COMPOSER_FILE --version=1.10.15

# Postgres Client - Required for the backup system.
RUN yum install -y https://download.postgresql.org/pub/repos/yum/reporpms/EL-8-x86_64/pgdg-redhat-repo-latest.noarch.rpm && \
    yum --disablerepo=rhel-8-for-x86_64-appstream-rpms install -y postgresql14 && \
    yum clean all

# Ghostscript - Required in order to annotate PDFs from within Moodle.
RUN yum install -y ghostscript

# Remi Repository - Required for PHP 7.4 and its dependencies.
RUN yum install -y \
    https://dl.fedoraproject.org/pub/epel/epel-release-latest-8.noarch.rpm && \
    yum install -y https://rpms.remirepo.net/enterprise/remi-release-8.rpm && \
    yum module reset php -y && \
    yum module enable -y php:remi-7.4 && \
    yum install -y php php-cli php-common php-pdo php-mbstring php-xml php-gd php-zip php-sodium php-pgsql && \
    yum clean all

# Disable directory listings.
RUN sed -i 's/Options Indexes FollowSymLinks/Options FollowSymLinks/' /etc/httpd/conf/httpd.conf

# Moodle
COPY / /opt/app-root/src
RUN chmod -R g=u+wx /opt/app-root/src
RUN chown -R default /opt/app-root/src/.git

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

# Ensure Moodle data directory exists and is writable by the application user.
# This prepares the image so a named volume will inherit reasonable permissions
# when initialized from the image.
RUN mkdir -p /var/moodledata && \
    chown -R 1001:0 /var/moodledata && \
    chmod 2777 /var/moodledata

#    rm -rf /run/httpd/*

USER 1001

ENTRYPOINT ["bin/run"]
