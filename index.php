<html>
  <head>
    <title>Monitor</title>
  </head>
</html>

<?php
function get_server_memory_usage(){

    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory_usage = $mem[2]/$mem[1]*100;

    return substr($memory_usage,0,6);
}

function get_server_cpu_usage(){

    $load = sys_getloadavg();
    return $load[0];

}

$cpu = get_server_cpu_usage();
$mem = get_server_memory_usage();

echo "<h1>Memory Usage: $mem% <br><br>";
echo "CPU Usage: $cpu% <br><br>";

$proc = shell_exec('cat /proc/net/dev');
$proc = (string)trim($proc);
$proc_arr = explode("\n", $proc);
$proc_row = explode(" ", $proc_arr[3]);
$proc_row1 = explode(" ", $proc_arr[2]);
echo "Network:<br> lo: Receiving $proc_row1[5] bytes, Transmitting $proc_row1[46] bytes <br>";
echo "         eno1: Receiving $proc_row[3] bytes, Transmitting $proc_row[37] bytes <br><br>";
//$i = 0;
//foreach($proc_row1 as $obj) {
//    echo "($i)[$obj]";
//    $i++;
//}
//echo "$proc_arr[3]<br>";

echo "https://www.purpletie.com: ";

$header_check = get_headers("https://www.purpletie.com");
$response_code = $header_check[0];

if (isset($response_code)) {
    echo $response_code;
}
else {
    echo "No Response";
}
echo '<br>';

header("Refresh:1");
?>

