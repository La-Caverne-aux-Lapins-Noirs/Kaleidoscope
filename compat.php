<?php
define ("UNIT_TEST", 1);

class DatabaseAssoc
{
    public $obj;

    function __construct($obj)
    {
	$this->obj = $obj;
    }

    function fetch_assoc()
    {
	if (!UNIT_TEST)
	    return ($this->obj->fetch_assoc()); // @codeCoverageIgnore
	return ($this->obj->fetchArray(SQLITE3_ASSOC));
    }
}

class Database
{
    private $logfile = "./dres/db.log";
    private $last_query = NULL;
    public $db;
    public $debug;
    public $insert_id;

    /**
     * @codeCoverageIgnore
     */
    function __construct(string		$url,
			 string		$user,
			 string		$pass,
			 string		$dbname,
			 bool		$debug = false,
			 string		$dbfile = "./database.sql")
    {
	if (!UNIT_TEST)
	    $this->db = new mysqli($url, $user, $pass, $dbname);
	else
	    $this->db = new SQLite3($dbfile);
	$this->debug = $debug;
    }

    function query($req, $display = false)
    { global  $install;
	if (UNIT_TEST)
	{
	    if (preg_match("/ALTER/", $req))
		return ("Skipped"); // @codeCoverageIgnore
	    $req = preg_replace("/CONCAT\(([a-zA-Z0-9_']+), ([a-zA-Z0-9_']+)\)/", '$1 || $2', $req);
	    $req = preg_replace("/NOW\(\)/", "date('now')", $req);
	    $req = preg_replace("/auto_increment/", "", $req);
    	    $req = preg_replace("/AUTO_INCREMENT/", "", $req);
   	    $req = str_replace("&&", " AND ", $req);
       	    $req = str_replace("||", " OR ", $req);
	    $out = [];
	    $out2 = [];
	    $idset = [];
	    preg_match("/INSERT INTO ([a-zA-Z0-9_`]+)/", $req, $out);
	    preg_match("/INSERT INTO [a-zA-Z0-9_`]+ \(([a-zA-Z0-9_`]+)/", $req, $out2);
	    preg_match("/INSERT INTO [a-zA-Z0-9_`]+ \(`id/", $req, $idset);
	    if (count($out) && count($idset) == 0 && $install == false && 0)
	    {
		$out = $out[1];
		$id = $this->query("SELECT id FROM $out ORDER BY id DESC");
		if (($id = $id->fetch_assoc()) == false)
		    $id = 1;
		else
		    $id = $id["id"] + 1;
		if ($out2[1] != "id" && $out2[1] != "`id`")
		{
		    $req = preg_replace("/INSERT INTO ([a-zA-Z0-9_`]+) \(/", 'INSERT INTO $1 (id, ', $req);
		    $req = preg_replace("/VALUES \(/", "VALUES ($id, ", $req);
		}
	    }
	}

	if ($display)
	    echo $req."\n"; // @codeCoverageIgnore
	if (($last_query = @$this->db->query($req)) == NULL && $this->debug)
	{
	    echo mysql_error();
	    return (NULL);
	}

	if (!UNIT_TEST)
	    $this->insert_id = $this->db->insert_id; // @codeCoverageIgnore
	else
	    $this->insert_id = $this->db->lastInsertRowId();

	return (new DatabaseAssoc($last_query));
    }

    function real_escape_string($str)
    {
	if (!UNIT_TEST)
	    return ($this->db->real_escape_string($str)); // @codeCoverageIgnore
	return ($this->db->escapeString($str));
    }
}

if (!isset($install) || $install == false)
  $Database = new Database("", "", "", "", true, "./database.sql");
else
  $Database = new Database("", "", "", "", true, "./../database.sql");

function mysql_connect($srv, $usr, $pas)
{
  return (true);
}

function mysql_select_db($db)
{
  return (true);    
}

$last_msg = "";
function mysql_query($d)
{
  global $Database;
  global $last_msg;
  $last_msg = $d;

  return ($Database->query($d));
}

function mysql_fetch_array($a)
{
  return ($a->fetch_assoc());
}

function mysql_error()
{
global $last_msg;
global $Database;
  return ($last_msg.": ".$Database->db->lastErrorMsg());
}

function mysql_real_escape_string($str)
{
  return ($Database->real_escape_string($str));
}

function mysql_num_rows($s)
{
  return (0);
}

function mysql_close()
{
  return (0);
}
