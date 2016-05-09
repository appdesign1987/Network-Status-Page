<!DOCTYPE html>
<?php
	Ini_Set( 'display_errors', true );
	include '../../init.php';
	include ROOT_DIR . '/assets/php/functions.php';
	include("service.class.php");
	include("serviceSAB.class.php");
	include("serviceMinecraft.class.php");
?>
<html lang="en">
	<script>
	// Enable bootstrap tooltips
	$(function ()
	        { $("[rel=tooltip]").tooltip();
	        });
	</script>
<?php
$sabnzbdXML = simplexml_load_file('http://'.$sab_ip.':'.$sab_port.'/api?mode=qstatus&output=xml&apikey='.$sabnzbd_api);

if (($sabnzbdXML->state) == 'Downloading'):
	$timeleft = $sabnzbdXML->timeleft;
	$sabTitle = 'SABnzbd ('.$timeleft.')';
else:
	$sabTitle = 'SABnzbd';
endif;

$services = array(
	new service("Plex", 32400, "http://couch.jeroenvd.nl:32400"),
	//new service("pfSense", 8082, "http://:8082", "d4rk.co"),
	new serviceSAB($sabTitle, 8080, "http://couch.jeroenvd.nl:8080", "192.168.88.55"),
	new service("Deluge", 8112, "http://couch.jeroenvd.nl:8112", "1291.168.88.55"),
	new service("CouchPotato", 5050, "http://couch.jeroenvd.nl:5050", "192.168.88.55"),
	new service("Proxmox", 8006, "http://192.168.88.81:8006", "192.168.88.81"),
	new service("ShipYard", 8080, "http://192.168.88.52:8080"),
	//new service("Starbound Server", 21025, "http://playstarbound.com"),
	//new serviceMinecraft("Vanilla", 25564, "http://minecraft.d4rk.co", "mc.d4rk.co"),
	//new serviceMinecraft("Bevo Tech Pack", 25565, "http://minecraft.d4rk.co")
);
?>
<table class="center">
	<?php foreach($services as $service){ ?>
		<tr>
			<td style="text-align: right; padding-right:5px;" class="exoextralight"><?php echo $service->name; ?></td>
			<td style="text-align: left;"><?php echo $service->makeButton(); ?></td>
		</tr>
	<?php }?>
</table>
