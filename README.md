# Experimental video portal application based on Micro Framework.

### Technologies used
 - [Ffmpeg](https://ffmpeg.org/)
 - [RabitMQ](https://www.rabbitmq.com/) - deprecated
 - [Docker](https://www.docker.com/)
 - [Redis](https://redis.io/)
 - [Doctrine](https://www.doctrine-project.org/)
 - [ElasticSearch](https://www.elastic.co/)
 - [Temporal](https://temporal.io/)
 - [RoadRunner](https://roadrunner.dev/)

### Short description
 - Client: Clients for reading data. (Redis, Elastic)
 - Backend: Application business logic.
 - Shared: Common codebase for communication backend, client and front parts. (Constants, DTO, etc...)
 - Config: Application configuration generator. ( Currently based on .env file )
 - Frontend: Representation of data for the end user.
