<?php
// Database initialization
$db_file = 'queue.db';
$db = null;
$callQueue = null;
try {
    // Create/connect to SQLite database
    $db = new SQLite3($db_file);
    
    // Create table queue if it doesn't exist
    $query = "CREATE TABLE IF NOT EXISTS queues (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        queue_no INTEGER NOT NULL DEFAULT 0,
        print_no INTEGER NOT NULL DEFAULT 0,
        section TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    
    $db->exec($query);

    // Create table user if it doesn't exist
    $query = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    
    $db->exec($query);

    // Check if the queues table is empty
    $result = $db->query("SELECT COUNT(*) as count FROM queues");
    $row = $result->fetchArray();
    if ($row['count'] == 0) {
        for($i='a'; $i<='c'; $i++) {
            $db->exec("INSERT INTO queues (section) VALUES ('$i')");
        }
    }

    // Check if the users table is empty
    $result = $db->query("SELECT COUNT(*) as count FROM users");
    $row = $result->fetchArray();
    if ($row['count'] == 0) {
        $db->exec("INSERT INTO users (username, password) VALUES ('admin', 'admin123')");
    }

    if(isset($_GET['section']) && isset($_GET['action'])) {
        $section = $_GET['section'];
        $action = $_GET['action'];
        if($action == 'next') {
            $result = $db->query("SELECT print_no, queue_no FROM queues WHERE section = '$section'");
            $row = $result->fetchArray();
            if($row['print_no'] > $row['queue_no']) {
                $queue_no = intval($row['queue_no']) + 1;
                $db->exec("UPDATE queues SET queue_no = '$queue_no' WHERE section = '$section'");
                $callQueue['section'] = $section;
                $callQueue['queue_no'] = $queue_no;
            }
        }
    }

    $result = $db->query("SELECT * FROM queues");
    $queues = [];
    while ($row = $result->fetchArray()) {
        $queues[] = $row;
    }
} catch (Exception $e) {
    die('Database error: ' . $e->getMessage());
}

function audio_list()
{
	$output=array();
	$directory = 'audio/';
	$scanned_directory = array_diff(scandir($directory), array('..', '.'));
	foreach($scanned_directory as $r)
	{
		$ext=pathinfo($r,PATHINFO_EXTENSION);
		if(in_array($ext,array("MP3","mp3","wav")))
		{
			$explode=explode(".",$r);
			$ID=$explode[0];
			$output[]=array(
				'path'=>$directory.$r,
				'file'=>$r,
				'ID'=>$ID,
			);
		}
	}
	return $output;
}

?>