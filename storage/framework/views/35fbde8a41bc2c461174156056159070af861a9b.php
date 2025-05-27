<!-- Page Breadcrumbs -->
<?php if(isset($pagetitle) or isset($breadcrumbs)): ?>
    <div class="page-heading">
    <h1 class="page-title"><?php echo e((isset($pagetitle)) ? $pagetitle : ""); ?></h1>
    <?php if(isset($breadcrumbs)): ?>
        <ol class="breadcrumb">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title=>$url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="breadcrumb-item">
                <?php if($loop->first): ?>
                    <?php if(strlen($url)>0): ?>
                        <a href="<?php echo e($url); ?>"><i class="la la-home font-20"></i></a>
                    <?php else: ?>
                        <i class="la la-home font-20"></i></a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(strlen($url)>0): ?>
                        <a href="<?php echo e($url); ?>"><?php echo e($title); ?></a>
                    <?php else: ?>
                        <?php echo e($title); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/web/layouts/breadcrumbs.blade.php ENDPATH**/ ?>