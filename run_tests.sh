docker run -v $(pwd):/app --rm phpunit/phpunit HandTest 

docker run -v $(pwd):/app --rm phpunit/phpunit PlayerTest 

docker run -v $(pwd):/app --rm phpunit/phpunit GameStateTest 

echo "Ready."
