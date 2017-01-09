mysql> use cabBills;
Database changed
mysql> show tables;
+--------------------+
| Tables_in_cabbills |
+--------------------+
| collectdata        |
| employee           |
+--------------------+
2 rows in set (0.35 sec)

mysql> desc employee;
+--------------+-------------+------+-----+---------+-------+
| Field        | Type        | Null | Key | Default | Extra |
+--------------+-------------+------+-----+---------+-------+
| name         | varchar(50) | YES  |     | NULL    |       |
| acc          | varchar(25) | YES  |     | NULL    |       |
| manager_name | varchar(50) | YES  |     | NULL    |       |
| exp_nature   | varchar(30) | YES  |     | NULL    |       |
| pmtdt        | varchar(20) | YES  |     | NULL    |       |
+--------------+-------------+------+-----+---------+-------+
5 rows in set (0.40 sec)

mysql> desc collectdata;
+--------+-------------+------+-----+---------+-------+
| Field  | Type        | Null | Key | Default | Extra |
+--------+-------------+------+-----+---------+-------+
| date   | varchar(10) | YES  |     | NULL    |       |
| brdtm  | varchar(7)  | YES  |     | NULL    |       |
| amount | double      | YES  |     | NULL    |       |
| rate   | double      | YES  |     | NULL    |       |
+--------+-------------+------+-----+---------+-------+
4 rows in set (0.19 sec)

mysql>
