docker run -v $(pwd):/app --rm phpunit/phpunit ./tests/HandTest 

docker run -v $(pwd):/app --rm phpunit/phpunit ./tests/PlayerTest 

docker run -v $(pwd):/app --rm phpunit/phpunit ./tests/GameStateTest 

echo "Ready."
