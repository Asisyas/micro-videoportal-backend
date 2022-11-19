# [WIP] It is a viewportal engine focused on Dynamic Adaptive Streaming over HTTP based on MicroFramework

### Used external technologies
 - [PHP ~8.1](https://www.php.net/releases/8.1/en.php)
 - [Ffmpeg](https://ffmpeg.org/)
 - [Redis](https://redis.io/)
 - [Doctrine](https://www.doctrine-project.org/)
 - [ElasticSearch](https://www.elastic.co/)
 - [Temporal](https://temporal.io/)
 - [RoadRunner](https://roadrunner.dev/)
 - [MPEG-DASH](https://en.wikipedia.org/wiki/Dynamic_Adaptive_Streaming_over_HTTP) - Dynamic Adaptive Streaming over HTTP

### Short description
 - Client: Clients for reading data. (Redis, Elastic)
 - Backend: Application business logic.
 - Shared: Common codebase for communication backend, client and front parts. (Constants, DTO, etc...)
 - Config: Application configuration generator. ( Currently based on .env file )
 - Frontend: Representation of data for the end user.


