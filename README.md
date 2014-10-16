server
======

Laravel Backend

### API Documentaion

Creating a User ```POST /user```

```json
{
    "first": "Michael",
    "last": "Schuett",
    "email": "mschuett@email.com",
    "password": "supersecret"
}
```

Logging in ```POST /login```

```json
{
    "email": "mschuett@uwm.edu",
    "password": "supersecret"
}
```

Check if you are logged in ```GET /check```

Upload file ```POST /upload``` submit file with name file and encoding multipart/form-data.

Sync file ```GET /sync/{id}```
