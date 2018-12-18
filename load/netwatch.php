<?php
switch($_GET['get']){
default:
$mikmosLoad = $API->comm("/tool/netwatch/getall");
$mikmosTot = count($mikmosLoad);
?>
<div id="reloadNetwacthx">

<div class="row">
<div class="col-sm-12">
<section class="panel">
<header class="panel-heading">
<strong><?php echo __NETWATCH;?></strong> | <span class="text-danger"><?php if($mikmosTot < 2 ){echo "$mikmosTot"; }elseif($mikmosTot > 1){echo "$mikmosTot";}?></span> items
<span class="tools pull-right"> </span>
</header>
<div class="panel-body">
<p class="text-muted">
<a class="btn btn-success" href="./?load=netwatch&get=ae"> <i class="fa fa-plus"></i> <?php echo __ADD;?></a>
</p><hr>
<?php //print_r($mikmosLoad);?>
<div class="table-responsive">
<div class="adv-table">
<div class="table-responsive">
 <table class="table table-bordered table-hover text-nowrap" id="mikmos-tbl-noinfo">
 <thead>
<tr> 
<th class="text-center" style="width:70px;"></th>
<th>Host</th>
<th>Interval</th>
<th>Time Out</th>
<th>Status</th>
<th>Waktu</th>
</tr>
</thead>

<tbody>
<?php
for ($i=0; $i<$mikmosTot; $i++){
	$mikmosData = $mikmosLoad[$i];
?>
<tr>
<td class="align-middle">
<?php if($mikmosData['disabled']=='false'){?>
<a title="Non Aktifkan" href="./?load=netwatch&get=disabled&id=<?php echo $mikmosData['.id'];?>" class="btn btn-info btn-xs"><i class='fa fa-unlock '></i></a> <?php }else{ ?><a title="Aktifkan" href="./?load=netwatch&get=enabled&id=<?php echo $mikmosData['.id'];?>" class="btn btn-danger btn-xs"><i class='fa fa-lock '></i></a> <?php } ?> 
<a title="Hapus" href="./?load=netwatch&get=del&id=<?php echo $mikmosData['.id'];?>" class="btn btn-danger btn-xs"><i class='fa fa-trash'></i></a> </td>
<td><?php echo $mikmosData['host'];?></td>
<td class="text-center"><?php echo $mikmosData['interval'];?></td>
<td class="text-center"><?php echo $mikmosData['timeout'];?></td>
<td class="text-center"><?php echo $mikmosData['status'];?></td>
<td><?php echo $mikmosData['since'];?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
</div>
<?php
break;
case'ae':
if(!empty($_GET['id'])){
$id_net = $_GET['id'];
$API = new RouterosAPI();
$API->debug = false;
$API->connect($_IPMK, $_USMK, _de(ltrim($_PSMK, __CMS)));
$mikmosLoad =$API->comm("/tool/netwatch/print", array("?.id" => "$id_net"));
$mikmosLoads = $mikmosLoad[0];
}else{
$id_net = '';
}
if(isset($_POST['save'])){
$host = ($_POST['host']);
$interval = ($_POST['interval']);
$timeout = ($_POST['timeout']);
$upscript = ($_POST['upscript']);
$downscript = ($_POST['downscript']);
$disabled = ($_POST['disabled']);
$API->comm("/tool/netwatch/add", array(
"host" => "$host",
"interval" => "$interval",
"timeout" => "$timeout",
"up-script" => "$upscript",
"down-script" => "$downscript",
"disabled" => "$disabled",
));
echo "<script>window.location='./?load=netwatch'</script>";
}
if(isset($_POST['edit'])){
$host = ($_POST['host']);
$interval = ($_POST['interval']);
$timeout = ($_POST['timeout']);
$upscript = ($_POST['upscript']);
$downscript = ($_POST['downscript']);
$disabled = ($_POST['disabled']);
$API->comm("/tool/netwatch/set", array(
".id" => "$id_net",
"host" => "$host",
"interval" => "$interval",
"timeout" => "$timeout",
"up-script" => "$upscript",
"down-script" => "$downscript",
"disabled" => "$disabled",
));
echo "<script>window.location='./?load=netwatch'</script>";
}
?>
<div class="row">
<div class="col-sm-12">
<section class="panel">
<header class="panel-heading">
<strong><?php echo __NETWATCH;?></strong></i>
</header>
<div class="panel-body">

<form name="form" autocomplete="off" method="post" action="">
<p class="text-muted">
<a class="btn btn-warning" href="./?load=netwatch"> <i class="fa fa-close btn-mrg"></i> <?php echo __CANCEL;?></a>
<button type="submit" name="edit" class="btn btn-primary btn-mrg" ><i class="fa fa-save btn-mrg"></i> <?php echo __SAVE;?></button>
</p><hr>
<div class="row">
<div class="col-md-7">
<table class="table">
<tr>
<td>Host</td><td><input class="form-control" type="text" autocomplete="off" name="host" value="<?php echo $mikmosLoads['host'];?>" placeholder="0.0.0.0" required="1" autofocus></td>
</tr>
<tr>
<td>Interval</td><td><input class="form-control" type="text" size="4" autocomplete="off" name="interval" value="<?php echo $mikmosLoads['interval'];?>" placeholder="1m" required="1"></td>
</tr>
<tr>
<td>Timeout</td><td><input class="form-control" type="text" name="timeout" autocomplete="off" value="<?php echo $mikmosLoads['timeout'];?>" placeholder="1s" required="1"></td>
</tr>
<tr>
<td>Enabled</td><td>
<select class="form-control" name="disabled" required="1">
<option <?php if($mikmosData['disabled']=='false'){echo'selected';}?> value="false"><?php echo __ENABLE;?></option>
<option <?php if($mikmosData['disabled']=='true'){echo'selected';}?> value="trus"><?php echo __DISABLE;?></option>
</select>
</td>
</tr>
<tr>
<td>Up Script</td><td>
<textarea class="form-control" name="upscript"><?php echo $mikmosLoads['up-script'];?></textarea>
</td>
</tr>
<tr>
<td>Down Script</td><td>
<textarea class="form-control" name="downscript"><?php echo $mikmosLoads['down-script'];?></textarea>
</td>
</tr>
<tr>
<td></td><td>
<div>
</div>
</td>
</tr>
</table>
</div>
</div>
</form>
</div>
</div>
</div>
<?php
break;
case'disabled':
@session_start();
error_reporting(0);
$removeuserprofile = $_GET['id'];
$API->comm("/tool/netwatch/set", array(
".id"=> "$removeuserprofile",
"disabled"=> "true",));
_e('<script>window.history.go(-1)</script>');
break;
case'enabled':
@session_start();
error_reporting(0);
$removeuserprofile = $_GET['id'];
$API->comm("/tool/netwatch/set", array(
".id"=> "$removeuserprofile",
"disabled"=> "false",));
_e('<script>window.history.go(-1)</script>');
break;
case'del':
@session_start();
error_reporting(0);
$removeuserprofile = $_GET['id'];
$API->comm("/tool/netwatch/remove", array(
".id"=> "$removeuserprofile",));
_e('<script>window.history.go(-1)</script>');
break;
}
?>
