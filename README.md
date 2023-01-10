## PAYLOAD VALIDATOR ENGINE

Simple Laravel validtion engine for validating json payload based on a the supplied rules

## End Point
```/api/validate ```

## Method
``` POST ```

## Allowed Rules
```
- alpha
- required
- email
- number
```

## Sample payload
```
{
    "first_name": {
        "value": "John",
        "rules": "alpha|required"
    },
    "last_name": {
        "value": "Doe",
        "rules": "alpha|required"
    },
    "email": {
        "value": "Doe",
        "rules": "email"
    },
    "phone": {
        "value": "08175020329",
        "rules": "number"
    }
}
```

## Sample Response
```
- Success
{"status" : true}

- Failed
Returns laravel standard validation error

