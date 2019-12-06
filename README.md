# Mathrix Team Good Plan REST API

Mathrix Good Plan REST API, based on the [Lumen framework](https://lumen.laravel.com/), edited by [Laravel](https://laravel.com/).

| Environment | Documentation | Version |
|-------------|-----|---------|
| master | [api.good-plans.mathrix.fr](https://api.good-plans.mathrix.fr) | [![Development API version][master-version-img]][master-version-link] |
| dev | [dev.api.good-plans.mathrix.fr](https://dev.api.good-plans.mathrix.fr) | [![Development API version][dev-version-img]][dev-version-link] |

## Contributors

- [Mathieu Bour](https://github.com/mathieu-bour) (maintainer), Vice-CTO @mathrix-team
- [Valentin Pollart](https://github.com/valentinpollart), Lead Cloud Engineer @mathrix-teamn

### Database

The linked database is based on [mysql/mysql-server][mysql-repo]
To run migrations and seed your own database, you first have to write a .env file following the .env.example file in the root path of the project.
Then, run 

```bash
php artisan migrate --seed 
```

The whole database will be generated and filled with mocked data, in order to run functionnal test.

[mysql-repo]: https://github.com/mysql/mysql-server

### Documentation

The documentation is based on the [OpenAPI specification v3.0.2][openapi-spec]. The sources files of the documentation
are located in the `docs/` folder and split across several files. In order to build the actual YAML specification, run

```bash
composer docs:compile
```

The documentation render process uses [Redocly/redoc][redoc-repo], a node-based OpenAPI renderer. In order to render the
documentation, just run:

```bash
npm run docs:serve   # serve the documentation on localhost:8080
npm run docs:bundle  # bundle the documetation into resources/views/docs/index.html
```

[openapi-spec]: https://github.com/OAI/OpenAPI-Specification/blob/master/versions/3.0.2.md
[redoc-repo]: https://github.com/Redocly/redoc


### Testing

There are 1 type of tests in this project:

- API tests (`tests/API`), which are functional tests ;

Testing is achieved using [sebastianbergmann/phpunit][phpunit-repo].

Since we are using the documentation-driven development strategy which means that we are testing against our
documentation, it is necessary to compile the documentation specification before running tests.

```bash
phpunit            # runs tests
composer test:cov  # runs tests with code-coverage enable
```

[phpunit-repo]: https://github.com/sebastianbergmann/phpunit

### Deployment

This project is compiled inside a docker container and deployed through a pipeline using Github Actions.
To generate the corresponding docker image, run in root path

```bash
docker build -t good-planAPI .
```

Then, to run the image 

```bash
docker run -i good-planAPI good-planAPI
```

This image will be listen by default on port 8080
