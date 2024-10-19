<?php
global $pinnacle;
if ( isset( $pinnacle['home_action_text_tag'] ) && ! empty( $pinnacle['home_action_text_tag'] ) ) {
	$ttag = $pinnacle['home_action_text_tag'];
} else {
	$ttag = 'h1';
}
?>
<div class="home_calltoaction home-margin clearfix home-padding">
	<div class="kt-home-call-to-action panel-row-style-wide-feature">
		<div class="call-container clearfix">
			<div class="kt-cta">
				<div class="col-md-10 kad-call-title-case">
					<?php
					if ( isset( $pinnacle['home_action_text'] ) ) {
						echo '<' . esc_attr( $ttag ) . ' class="kad-call-title">' .  esc_html( $pinnacle['home_action_text'] ) . '</' . esc_attr( $ttag ) . '>';
					}
					?>
				</div>
				<div class="col-md-2 kad-call-button-case">
					<a href="<?php if(isset($pinnacle['home_action_link'])) echo esc_url($pinnacle['home_action_link']);?>" class="kad-btn-primary kad-btn lg-kad-btn"><?php if(isset($pinnacle['home_action_text_btn'])) echo esc_html($pinnacle['home_action_text_btn']);?></a>   	
				</div>
			</div>
		</div><!--container-->
	</div><!--call class-->
</div>