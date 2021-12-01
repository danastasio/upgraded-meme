#Copyright (C) 2020  David D. Anastasio

#This program is free software: you can redistribute it and/or modify
#it under the terms of the GNU Affero General Public License as published
#by the Free Software Foundation, either version 3 of the License, or
#(at your option) any later version.

#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
#GNU Affero General Public License for more details.

#You should have received a copy of the GNU Affero General Public License
#along with this program.  If not, see <https://www.gnu.org/licenses/>.

FROM registry.fedoraproject.org/fedora-minimal

RUN microdnf install -y libmcrypt-devel sqlite sqlite-devel uuid-devel vim php nodejs caddy php-fpm composer
RUN microdnf reinstall -y tzdata 

WORKDIR /app
COPY . /app

RUN cp /app/.env.example /app/.env
RUN touch /app/database/database.db
RUN yes "no" | php artisan key:generate
RUN php artisan migrate --force
RUN php artisan optimize:clear
RUN php artisan storage:link
RUN php artisan view:cache
RUN php artisan config:cache
RUN php artisan route:cache
RUN mkdir /var/run/php-fpm
RUN chmod 777 /app -R

VOLUME /app/database
EXPOSE 8000

CMD php-fpm && caddy run --config Caddyfile
