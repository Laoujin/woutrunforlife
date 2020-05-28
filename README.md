woutrunforlife
==============

Mario collecting gold coins for Wout his StuBru RunForLife participation.

Well I was going to send him this to nudge him to go through with it this time but:  
For some reason the `images` (containing the images & sounds) are gitignored and I can't seem to find them :(

Bugs:
- Money is not saved as a decimal in the db


Startup
-------

```bash
docker-compose up
```

Execute the statements in `migrations.txt` (manually).


### No longer in use

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
