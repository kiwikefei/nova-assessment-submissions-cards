nvm:
	. ${NVM_DIR}/nvm.sh && nvm use && $(CMD)
build:
	composer install
	make nvm CMD="npm update -g npm"
	make nvm CMD="npm install"
	make nvm CMD="npm run nova:install"
	make nvm CMD="npm run prod"
