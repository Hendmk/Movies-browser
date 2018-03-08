<?php $__env->startSection('content'); ?>

<div class="w3-display-middle">
  <a href="<?php echo e(url('/start')); ?>"  style='text-decoration: none;'> <h1 class="w3-jumbo w3-animate-top">START</h1></a>
  <hr class="w3-border-grey" style="margin:auto;width:40%">
  <br>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.Master', ['title' => $title], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>