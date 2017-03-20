<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script type="text/javascript">
	$( document ).ready(function() {
		$.notify({
      		message: "<?= $message ?>",
      		icon: 'fa fa-warning' 
      	},{
      		type: "danger"
      	});
	});
</script>
