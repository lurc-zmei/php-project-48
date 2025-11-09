install: # установка пакетов в /vendor
	composer install

validate: # проверка файла composer.json
	composer validate --no-check-publish

lint: #CodeSniffer
	composer exec --verbose phpcs -- --standard=PSR12 src bin
lint-fix: #CodeSniffer cbf
	composer exec --verbose phpcbf -- --standard=PSR12 src bin

test:
	composer exec --verbose phpunit tests
