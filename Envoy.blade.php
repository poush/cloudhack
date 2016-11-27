@servers(['web' => ["root@$ip"]])



@task('lamp', ['on' => 'web'])
	sudo apt-get update
	sudo apt-get install git -qqy
	git config --global user.name "Deployer"
	git config --global user.email "deploy@do.com"
	cd /usr/local/bin
	curl -sS https://getcomposer.org/installer | php
	chmod a+x composer.phar
	cd /var/www/html
	rm -rf *
	git clone {!! $repo !!} .
	composer.phar install
@endtask

@task('laravel', ['on' => 'web'])
	cd /var/www/html
	git pull origin master
	composer.phar install --no-interaction --prefer-dist --optimize-autoloader
	php artisan migrate
@endtask


@task('django', ['on' => 'web'])
	cd /usr/share/nginx/html
	git clone $repo
@endtask

