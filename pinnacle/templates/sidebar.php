 <?php if (pinnacle_display_sidebar()) : ?>
      <aside class="<?php echo pinnacle_sidebar_class(); ?>" role="complementary">
        	<div class="sidebar">
			<?php 
					dynamic_sidebar( kadence_sidebar_id() );
				?>
        </div><!-- /.sidebar -->
    </aside><!-- /aside -->
<?php endif; ?>