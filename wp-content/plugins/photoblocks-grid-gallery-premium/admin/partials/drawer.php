<div id="pb-drawer">
    <div class="pb-shoulder close-drawer"></div><!--
    	--><div class="pb-content">
        <?php include "drawer-sections/gallery.php" ?>
        <?php include "drawer-sections/image.php" ?>
        <?php include "drawer-sections/text.php" ?>
        <?php if ( photob_fs()->is__premium_only() ) : ?>
        <?php include "drawer-sections/source.php" ?>
        <?php endif ?>
    </div>
</div>