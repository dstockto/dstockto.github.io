function mybugon() {
  export PHP_IDE_CONFIG="serverName=myserver.dev"
  export XDEBUG_CONFIG="idekey=PHPSTORM"
}

function mybugoff() {
  unset PHP_IDE_CONFIG
  unset XDEBUG_CONFIG
}

alias bugon="mybugon"
alias bugoff="mybugoff"