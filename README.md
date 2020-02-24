Introduction
============
## PHP_MSSQL_PDO  
##  โปรแกรมที่จำเป็นต้องใช้สำหรับ Database Mssql
 - xampp-windows-x64-7.4.1-0-VC15-installer
 - Driver php_pdo_sqlsrv ==> Windows-7.4 file  php_pdo_sqlsrv_74_ts.dll  
   copy to C:\xampp\php\ext  ขึ้นอยู่กับว่าใช้ x86 หรือ 64 
      
 
### php.ini  open extension for Mysql Database
- extension=pdo_mysql # For mysql
- short_open_tag = On

### file php.ini open extension for Ms sql Database
- extension=php_pdo_sqlsrv_74_ts.dll # For ms sql
- short_open_tag = On

### Database file 
- database_mysql==> Database Mysql
- database_mssql ==> Database MS sql V.2016

### file config.php  
 - $_svhost="sqlsrv";  Database MS sql
 - $_svhost="mysql";  Database mysql
 
### examples for db Mysql

$_svhost="mysql";
if($_svhost=="sqlsrv"){
    $db_config = array(
		"DB_type" => "sqlsrv",
        "DB_host" => "xxxxx",
        "DB_name" => "system_repair",
        "DB_user" => "xxx",
        "DB_pass" => "xxx",
        "DB_charset" => "utf8",
    );
}else{
    $db_config = array(
	    "DB_type" => "mysql",
        "DB_host" => "127.0.0.1",
        "DB_name" => "system_repair",
        "DB_user" => "root",
        "DB_pass" => "",
        "DB_charset" => "utf8",
    );
}

### examples for db Ms sql

$_svhost="sqlsrv";  
if($_svhost=="sqlsrv"){

    $db_config = array(
		"DB_type" => "sqlsrv",
        "DB_host" => "xxxxx",
        "DB_name" => "system_repair",
        "DB_user" => "xxx",
        "DB_pass" => "xxx",
        "DB_charset" => "utf8",
    );
}else{

    $db_config = array(
	    "DB_type" => "mysql",
        "DB_host" => "127.0.0.1",
        "DB_name" => "system_repair",
        "DB_user" => "root",
        "DB_pass" => "",
        "DB_charset" => "utf8",
    );
}

    
## LOGIN using
username: admin 
password: 123456

### DEMO http://www.satangapp.in/itcare

### *********************** Screenshot *******************************************
		
![GitHub Logo](https://github.com/aka1526/system_repaire_mssql/blob/master/blob/master/screenshot/p1.png)
![GitHub Logo](https://github.com/aka1526/system_repaire_mssql/blob/master/blob/master/screenshot/p2.png)
![GitHub Logo](https://github.com/aka1526/system_repaire_mssql/blob/master/blob/master/screenshot/p3.png)
![GitHub Logo](https://github.com/aka1526/system_repaire_mssql/blob/master/blob/master/screenshot/p4.png)
![GitHub Logo](https://github.com/aka1526/system_repaire_mssql/blob/master/blob/master/screenshot/p5.png)
![GitHub Logo](https://github.com/aka1526/system_repaire_mssql/blob/master/blob/master/screenshot/p6.png)
![GitHub Logo](https://github.com/aka1526/system_repaire_mssql/blob/master/blob/master/screenshot/p7.png)
![GitHub Logo](https://github.com/aka1526/system_repaire_mssql/blob/master/blob/master/screenshot/p8.png)
![GitHub Logo](https://github.com/aka1526/system_repaire_mssql/blob/master/blob/master/screenshot/p9.png)


[![Build Status](https://img.shields.io/travis/ColorlibHQ/AdminLTE/master.svg)](https://travis-ci.org/ColorlibHQ/AdminLTE)
[![npm version](https://img.shields.io/npm/v/admin-lte/latest.svg)](https://www.npmjs.com/package/admin-lte)
[![Packagist](https://img.shields.io/packagist/v/almasaeed2010/adminlte.svg)](https://packagist.org/packages/almasaeed2010/adminlte)
[![CDNJS](https://img.shields.io/cdnjs/v/admin-lte.svg)](https://cdnjs.com/libraries/admin-lte)
