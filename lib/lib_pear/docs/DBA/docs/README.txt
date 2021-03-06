DBA is a set of classes for handling and extending Berkeley DB style 
databases. It works around some of the quirks in the built-in dba 
functions in PHP (e.g. gdbm does not support dba_replace), has its own 
file-based dbm driver for installations where dba support is not included
in PHP.

** About DBA **

Berkeley DB style databases are much simpler than the other database 
systems that PHP supports. They typically support inserting, removing, 
and retreiving data from a file, using a key as a reference. An 
advantage of these type databases is that they are file-based. A 
database-driven web application can run entirely in PHP without any 
external database software. They are also easy to use. The interface is 
similar to that of reading and writing a file. The difference is, the 
database system keeps track of data by key-value pairs rather than by 
location-offset.

DBA implements all of the basic functionality of a Berkeley database and 
adds some extra functionality.

** Usage **

DBA objects are generated by calling the static method of class DBA, 
create().

require_once 'DBA.php';
$db = DBA::create($driver);

$driver is a string that describes which database driver to use. DBA can 
use the built-in dba_ functions of PHP if they are compiled in. See the 
dba documentation in the PHP manual for more information: 
http://www.php.net/manual/en/ref.dba.php. If the driver string is set to 
'file' or the dba_ functions are not present, then a built-in driver 
is used.

NOTE: The file, gdbm, db2, db3 and db4 drivers work perfectly with DBA. Other
drivers may work (see http://www.php.net/manual/en/ref.dba.php) but have
not been tested yet.

Once the object is created, a database file can be opened.

$db = DBA::create('file');
$result = $db->open('database', 'n'); // create a new database
if (PEAR::isError($result)) {
    echo $result->getMessage()."\n";
}

Added to:

$db->insert('key1', 'Hello');
$db->insert('key2', 'World');
$db->replace('key1', 'Howdy!');

And deleted from:

$db->remove('key2');

To traverse a DBA database, use the following construct:

$key = $db->firstkey();

while ($key !== false) {
    echo $db->fetch($key);
    $key = $db->nextkey();
}

To close the database, use $db->close();

DBA supports some additional methods:
$db->sync() synchronizes pending writes to disk (these happen 
automatically too)
$db->exists($key) checks if a key exists
$db->isOpen(), $db->isWritable(), $db->isReadable()

DBA is copyright 2002 Brent Cook <busterb@mail.utexas.edu>
