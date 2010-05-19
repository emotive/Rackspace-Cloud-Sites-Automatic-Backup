#!/bin/sh
 mysqldump --opt -h MYSQLHOSTNAME -u MYSQLUSER -p'MYSQLPASSWORD' MYSQLDATABASE > YOURSITEPATH/backup/db_backup.sql
 
 gzip -f YOURSITEPATH/backup/db_backup.sql
 
 tar czf YOURSITEPATH/backup/web_backup.tgz YOURSITEPATH/content/