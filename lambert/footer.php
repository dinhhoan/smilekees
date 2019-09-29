<?php
/* banner-php */

			if( lambert_global_var('footer_info') || lambert_global_var('footer_copyright') ): ?>
			    <footer class="footer-main">
			        <div class="footer-inner">
			            
			            <div class="container">
			            	<div class="row">
			            		<?php 
			                    if(is_active_sidebar('footer_widgets_widget')){
			                        dynamic_sidebar('footer_widgets_widget');
			                    }
			                    ?>
			            		
			            	</div>
			            	<?php echo lambert_global_var('footer_info'); ?>
			            	<?php 
		                    if(is_active_sidebar('footer_contacts_widget')){ ?>
							<div class="bold-separator">
                                <span>circle</span>
                            </div>
		                   	<?php 
		                        dynamic_sidebar('footer_contacts_widget');
		                    }
		                    ?>
			            </div>
			        </div>
			        <?php 
                    if(is_active_sidebar('footer_copyright_widget')){
                        dynamic_sidebar('footer_copyright_widget');
                    }
                    ?>
			        <?php echo lambert_global_var('footer_copyright');?>
			    </footer><!-- footer end    -->
			<?php
			endif; ?>
            </div><!-- end #wrapper -->
		</div> <!-- End #main -->
	    <?php wp_footer(); ?>
	</body>
</html>