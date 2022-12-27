# Troubleshooting

## Editing Permissions on Linux

If you work on linux and cannot edit some of the project files right after the first installation, you can run `docker compose run --rm php chown -R $(id -u):$(id -g) .` to set yourself as owner of the project files that were created by the docker container.

## HTTPs and Redirects

If Micro is generating an internal redirect for an `https://` url, but the resulting url is `http://`, you have to uncomment the `TRUSTED_PROXIES` setting in your `.env` file.

## TLS/HTTPS Issues

See more in the [TLS section](tls.md)


## Port bindings error

If for some reason it happens that the docker containers do not start because the port is busy.

#### Check
```bash
$ sudo netstat -nlp | grep 80
```
First, you need to check what is listening on the port that is required for the application to work.

```bash
tcp        0      0 0.0.0.0:80              0.0.0.0:*               LISTEN      24673/docker-proxy  
tcp        0      0 0.0.0.0:8081            0.0.0.0:*               LISTEN      24601/docker-proxy  
tcp6       0      0 :::80                   :::*                    LISTEN      24680/docker-proxy  
tcp6       0      0 :::8081                 :::*                    LISTEN      24607/docker-proxy  
```

Check if there are any running containers that may be occupying the port you need and if there are, terminate them.

```bash
$ docker ps
```
If docker proxy is active when containers are not running, just run the commands below.
You can learn more about the problem from this [ticket](https://github.com/docker/compose/issues/3277)

```bash
$ sudo service docker stop
$ sudo rm -f /var/lib/docker/network/files/local-kv.db
```
