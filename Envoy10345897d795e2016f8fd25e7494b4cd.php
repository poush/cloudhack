<?php $repo = isset($repo) ? $repo : null; ?>
<?php $release = isset($release) ? $release : null; ?>
<?php $path = isset($path) ? $path : null; ?>
<?php $branch = isset($branch) ? $branch : null; ?>
<?php $env = isset($env) ? $env : null; ?>
<?php $date = isset($date) ? $date : null; ?>
<?php $now = isset($now) ? $now : null; ?>
<?php $ip = isset($ip) ? $ip : null; ?>
<?php $__container = isset($__container) ? $__container : null; ?>
<?php $__container->servers(['web' => ["root@$ip"]]); ?>

<?php
	$now = new DateTime();
	$date = $now->format('YmdHis');
	$env = isset($env) ? $env : "production";
	$branch = isset($branch) ? $branch : "master";
	$path = rtrim($path, '/');
	$release = $path.'/'.$date;
?>

<?php $__container->startTask('lamp', ['on' => 'web']); ?>
	sudo apt-get update
	sudo apt-get install git
	git config --global user.name "Deployer"
	git config --global user.email "deploy@do.com"
	curl -sS https://getcomposer.org/installer | php
	cd /var/www/html
	git clone $repo
<?php $__container->endTask(); ?>


<?php $__container->startTask('lemp', ['on' => 'web']); ?>
	cd /usr/share/nginx/html
	git clone $repo
<?php $__container->endTask(); ?>

