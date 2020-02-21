<?php
/**
 *  Simple code for executing commands on a remote Linux server via SSH in PHP
 *
 *  @author Phil Kershaw (In collaboration with Philip Mott)
 *
 *  Note: ssh2_connect requires libssh2-php which is a non-standard PHP lib.
 *  Debian: apt-get install libssh2-php
 *  Redhat: yum install libssh2-php ???? I've no idea for redhat, sorry.
 */
$server   = "192.168.2.27"; // server IP/hostname of the SSH server
$username = "osmc"; // username for the user you are connecting as on the SSH server
$password = "osmc"; // password for the user you are connecting as on the SSH server
$command  = "kodi-send --action=\"PlayMedia(special://profile/playlists/video/peppapig.xsp)\""; // could be anything available on the server you are SSH'ing to

// Establish a connection to the SSH Server. Port is the second param.
$connection = ssh2_connect($server, 22);

// Authenticate with the SSH server
ssh2_auth_password($connection, $username, $password);

// Execute a command on the connected server and capture the response
$stream = ssh2_exec($connection, $command);

// Sets blocking mode on the stream
stream_set_blocking($stream, true);

// Get the response of the executed command in a human readable form
$output = stream_get_contents($stream);

// echo output
echo "<pre>{$output}</pre>";
