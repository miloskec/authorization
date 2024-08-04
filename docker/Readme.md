## Gateway 

docker build -f ./docker/Dockerfile --build-arg APP_TIMEZONE=CET --build-arg WWWGROUP=1000 --no-cache  --progress=plain -t authorization . 
docker-compose -f docker-compose.prod.yml up --build 
docker-compose -f docker-compose.dev.yml up --build    

