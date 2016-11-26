@servers(['web' => ['root@139.59.23.89']])

@task('deploy', ['on' => 'web'])
	adduser poush
	usermod -aG sudo poush
@endtask