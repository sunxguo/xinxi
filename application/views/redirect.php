<meta charset="utf-8">
<?php if (isset($info)) { ?>
<script>alert("<?php echo addslashes($info);?>")</script>
<?php } ?>
<?php if (isset($fartherurl)) { ?>
<script>window.parent.location.href="<?php echo $fartherurl;?>"</script>
<?php } elseif (isset($url)) { ?>
<script>window.location.href="<?php echo $url;?>"</script>
<?php } else { ?>
<script>history.go(-1);</script>
<?php } ?>

