@servers(['web' => ['root@$ip']])

@task('lamp', ['on' => 'web'])
	cd /var/www/html
	git clone $repo
@endtask


@task('lemp', ['on' => 'web'])
	cd /usr/share/nginx/html
	git clone $repo
@endtask

