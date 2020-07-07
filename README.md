woutrunforlife
==============

Mario collecting gold coins for Wout his StuBru RunForLife participation.

For some reason the `images` (containing the images & sounds) were gitignored and I lost them :(  
And... I found them back. So now we have `images` and `images-new` for two fantastic experiences.


Startup
-------

```bash
docker-compose up -d
```

Execute the statements in `migrations.txt` (manually).


### Manual install

#### PHP Server

```bash
docker build -t woutrunforlife-php .
docker run -it -p 8080:8080 --name woutrunforlife-php woutrunforlife-php
```

#### Database

```bash
docker run --name woutrunforlife-mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=my-secret-pw -d mysql:5.5.60
```

Execute the statements in `migrations.txt` (manually).

Bugs
----

- Money is not saved as a decimal to the db
