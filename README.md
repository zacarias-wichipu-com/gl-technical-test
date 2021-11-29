Installation
------------

* Install with Composer.
* I recommend running the application with the Symfony server.

Exercice 1
----------

Test the service with the commands:

- `symfony console app:fibonacci:current-mont` for the current month.
- `symfony console app:fibonacci:current-year` for the current year.
- `symfony console app:fibonacci:date-rang` for custom date range with the start and end date arguments:
    ```
    symfony console app:fibonacci:date-rang "2021-12-01 00:00:00" "2021-12-31 23:59:59"
    ```

Exercice 2
----------

An HTTP request for intelliJ IDEs is ready to run in the following path,

_./resources/fibonacci-range-date-matches.http_

You can also execute the request from the command line with curl,

```
curl -L https://127.0.0.1:8000/api/fibonacci/\?start_date\=2003-01-01+00%3A00%3A00\&end_date\=2032-01-01+23%3A59%3A59 | json_pp
```

Exercice 3
----------

The HTTP client has only one path, if you have run the application with the Symfony server (and you didn't have port 8000 on your machine busy) you can access from here,

_[https://127.0.0.1:8000/](https://127.0.0.1:8000/)_