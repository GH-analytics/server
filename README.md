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

Logout of the system ```GET /logout```

Upload file ```POST /upload``` submit file with name file and encoding multipart/form-data.

Sync file ```GET /sync/{id}```

Check Sync process and get info about it ```GET /check-sync```

Check Sync process to see if it's running ```GET /checkpid```

####After Sync has completed.

Getting conversation information

```GET /conversation``` get's all conversations in the system.

```GET /conversation/{id}``` get conversation in the system.

Get messages in the system

```GET /message?page={?page_number}``` Gets 50 messages at a time.

```GET /message/{id}``` Gets the message based on ID.

```GET /message-by-conv/{id}?page={?page_number}``` Gets messaged based on the conversation ID.
