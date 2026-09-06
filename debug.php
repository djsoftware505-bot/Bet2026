<?php
echo "<h1>BET2026 DEBUG ✅</h1>";
echo "PHP: ".phpversion()."<br>";
echo "Time: ".date('Y-m-d H:i:s')."<br>";
echo "Port: ".$_SERVER['PORT']."<br><br>";

echo "<h3>Files in root:</h3><pre>";
print_r(scandir('.'));
echo "</pre>";

echo "<h3>Check index.php:</h3>";
if(file_exists('index.php')) echo "✅ index.php IPO - ".filesize('index.php')." bytes<br>";
else echo "❌ index.php HAIPO<br>";

echo "<h3>Check Dockerfile:</h3>";
if(file_exists('Dockerfile')) echo "<pre>".file_get_contents('Dockerfile')."</pre>";
else echo "❌ Dockerfile HAIPO<br>";

echo "<br><a href='/'>Rudi Home</a> | <a href='/admin.php'>Admin</a>";
?>
