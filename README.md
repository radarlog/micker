# Micker

Micker (**M**ars T**icker**) is an HTTP based microservice written on PHP that receives
the Earth (UTC) timestamp in seconds as an input and returns two values:
* Mars Sol Date (MSD)
* Martian Coordinated Time (MTC)

## Installation and running

Before running the project you might create `.env` file in the root folder. Please refer `.env.dist` file for details. 

``` bash
$ make run
```

Navigate the browser to http://localhost:8080/index.html to open the OpenApi (Swagger) UI page

## Testing

``` bash
$ make tests
```

## License

This project is licensed under the MIT license. Please see [LICENSE](LICENSE) for details.
