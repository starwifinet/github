 $(document).ready(function(){ var interval = "10000"; setInterval(function() { $("#reloadHome").load("./load/home.php"); }, interval); setInterval(function() { $("#reloadActive").load("./load/users_active.php"); }, interval); setInterval(function() { $("#reloadNetwacth").load("./load/netwatch.php"); }, interval); setInterval(function() { $("#reloadDHCPLease").load("./load/dhcp_lease.php"); }, interval);setInterval(function() { $("#reloadNetwacth").load("./load/netwatch.php"); }, interval); setInterval(function() { $("#reloadInterface").load("./load/interface.php"); }, interval);});
 
 