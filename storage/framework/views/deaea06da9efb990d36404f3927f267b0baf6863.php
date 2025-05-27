<?php if(isset($status)): ?>
  <?php if($status==config('constant.status.active')): ?>
      <span class="badge badge-blue">Yes</span>
  <?php else: ?>
      <span class="badge badge-danger">No</span>
  <?php endif; ?>
<?php endif; ?>
<?php if(isset($default)): ?>
  <?php if($default==config('constant.default.enabled')): ?>
      <span class="badge badge-blue">Yes</span>
    <?php else: ?>
      <span class="badge badge-danger">No</span>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/inc/status.blade.php ENDPATH**/ ?>