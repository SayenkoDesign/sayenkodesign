<?php global $smof_data; ?>
<?php if($smof_data['header_number'] || $smof_data['header_email']): ?>
<div class="header-info">
	<?php echo $smof_data['header_number']; ?>
		<?php if($smof_data['header_number'] && $smof_data['header_email']): ?>
            <?php if($smof_data['header_position'] == 'Top'): ?>
            <span class="sep">|</span>
            <?php else: ?>
            <br />
        <?php endif; ?>
	<?php endif; ?>
    <a href="mailto:<?php echo $smof_data['header_email']; ?>"><?php echo $smof_data['header_email']; ?></a>
</div>
<?php endif; ?>



<div class="modal fade" id="free-estimate_11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color:#f6f6f6;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:30px;">×</button>
        <!--h4 class="modal-title" id="myModalLabel">Modal title</h4-->
      </div>
      <div class="modal-body">
      	<h2 style="text-align: center; font-size: 28px !important; text-transform: uppercase;">FREE Web Consultation</h2>
      	<div class="tx-div2 small"></div>
		<?php echo do_shortcode( '[gravityform id="7" name="Header Pop up" title="false" description="false" ajax="true"]' ); ?>
      </div>
    </div>
  </div>
</div>