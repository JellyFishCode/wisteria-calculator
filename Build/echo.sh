#!/bin/bash

PWD=`pwd`
SOURCEPATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && cd .. && pwd )"

./flow tictactoe:sayhello

#cd ${SOURCEPATH}
#Packages/Libraries/phpunit/phpunit/phpunit -c Build/UnitTests.xml --testsuite visol || exit 100
