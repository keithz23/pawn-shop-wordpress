<?php
$page_views 	= intval( get_option("get_mystickybar_page_views") );
$reviewStatus 	= true;
$isHidden 		= get_option( "my-sticky-menu_hide_review_box" );
$dateToShow 	= get_option( "my-sticky-menu_show_review_box_after" );
$currentDate 	= date( "Y-m-d" );

if ( $isHidden !== false ) {	
	$reviewStatus = false;
}

if ( $dateToShow !== false ) {	
	if ( $currentDate < $dateToShow ) {
		$reviewStatus = false;
	}
}

if( $page_views >= 1 && $reviewStatus ) { ?>
	<div class="mystickymenu-popup-form" id="rating-modal-popup" >		
		<div class="popup-form-content upgrade-modal rating-modal">
			<div class="popup-content" style="position: relative;">
				<div class="close-popup-button">
					<a class="hide-upgrade-modal" href="javascript:;" ><span></span></a>
				</div>				
				<div class="rating-modal-steps active" id="step-1">
					<div class="upgrade-title"><?php esc_html_e("Seems like My Sticky Bar is bringing you value  🥳", "mystickymenu"); ?></div>
					<div class="upgrade-desc"><?php echo sprintf( esc_html__("Can you please show us some love and rate %1\$sMy Sticky Bar%2\$s? It'll really help us spread the word ", "mystickymenu"), '<strong>', '</strong>'); ?></div>
					<div class="upgrade-rating">
						<div id="mystickymenu-rating"></div>
						
					</div>
					<div class="upgrade-user-rating" style="visibility:hidden"><span>1/5</span> <?php esc_html_e("rating", "mystickymenu"); ?></div>
				</div>
				<div class="rating-modal-steps" id="step-2">
					<div class="upgrade-title"><?php esc_html_e("Share Your Experience", "mystickymenu"); ?></div>
					<div class="upgrade-rating">
						<div id="mystickymenu-rated-rating" class="mystickymenu-rated-rating"></div>
					</div>
					<div class="upgrade-user-rating"><span>1/5</span> <?php esc_html_e("rating", "mystickymenu"); ?></div>
					<div class="upgrade-review-textarea">
						<label for="upgrade-review-comment"><?php esc_html_e("Review (optional)", "mystickymenu"); ?><span>1000</span></label>
						<textarea id="upgrade-review-comment" maxlength="1000" placeholder="<?php esc_html_e("Please write your review here", "mystickymenu"); ?>"></textarea>
					</div>
					<div class="upgrade-modal-button">
						<button type="button" id="upgrade-review-button" class="upgrade-review-button"><?php esc_html_e("Submit", "mystickymenu"); ?></button>
					</div>
				</div>
				<div class="rating-modal-steps" id="step-3">
					<div class="upgrade-title"><?php esc_html_e("Would you like to be reminded in the future?", "mystickymenu"); ?></div>
					<div class="upgrade-review-textarea">
						<label for="upgrade-review-reminder"><?php esc_html_e("Remind me after", "mystickymenu"); ?></label>
						<select id="upgrade-review-reminder" class="upgrade-review-reminder">
							<option value="7"><?php esc_html_e("7 Days", "mystickymenu"); ?></option>
							<option value="14"><?php esc_html_e("14 Days", "mystickymenu"); ?></option>
							<option value="-1"><?php esc_html_e("Don't remind me", "mystickymenu"); ?></option>
						</select>
					</div>
					<div class="upgrade-modal-button">
						<button type="button" id="upgrade-review-button" class="upgrade-review-button"><?php esc_html_e("Submit", "mystickymenu"); ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style>
	.mystickymenu-popup-form{
		position: fixed;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, .5);
		top: 0;
		left: 0;
		z-index: 10001;
	}
	.popup-form-content {
		background: #fff;
		min-height: 100px;
		width: 400px;
		text-align: center;
		margin: 0 auto;
		position: absolute;
		left: 0;
		right: 0;
		top: 50%;
		transform: translate(0, -50%);
		-ms-transform: translate(0, -50%);
		padding: 20px;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border-radius: 4px;
		color: #484848;
		font-family: "Poppins";
	}
	.popup-form-content.upgrade-modal {
		width: 560px;
	}
	.rating-modal.popup-form-content {
		 background: #ffffff url("<?php echo esc_url(MYSTICKYMENU_URL. 'images/rating-top.png');?>") top left no-repeat;
	}
	.rating-modal.popup-form-content:after {
		content: "";		
		background: transparent url("<?php echo esc_url(MYSTICKYMENU_URL. 'images/rating-bottom.png');?>") bottom right no-repeat;
		width: 100%;
		display: block;
		height: 100%;
		position: absolute;
		left: 0;
		top: 0;
		z-index: -1;
	}
	.close-popup-button {
		position: absolute;
		right: -10px;
		top: -10px;
		width: 20px;
		height: 20px;
		z-index: 100001;
	}
	.close-popup-button a span {
		display: block;
		position: relative;
		width: 16px;
		height: 16px;
		transition: all .2s linear;
	}
	.close-popup-button a span:after, .close-popup-button a span:before {
		content: "";
		position: absolute;
		width: 12px;
		height: 2px;
		background-color: #333;
		display: block;
		border-radius: 2px;
		transform: rotate( 45deg );
		top: 7px;
		left: 2px;
	}
	.close-popup-button a span:after, .close-popup-button a span:before {
		content: "";
		position: absolute;
		width: 12px;
		height: 2px;
		background-color: #333;
		display: block;
		border-radius: 2px;
		transform: rotate( 45deg );
		top: 7px;
		left: 2px;
	}
	.close-popup-button a span:after {
		transform: rotate(
				-45deg
		);
	}
	.close-popup-button a:hover span {
		transform: rotate(
				180deg
		);
	}
	.close-popup-button a {
		display: block;
		position: relative;
		width: 20px;
		height: 20px;
		color: #333;
		padding: 2px;
		box-sizing: border-box;
	}
	.rating-modal-steps.active {
		display: block;
	}
	.rating-modal-steps {
		display: none;
		width: 400px;
		margin: 0 auto;
		max-width: 100%;
		padding: 30px 0;
	}
	.rating-modal.popup-form-content .popup-content .upgrade-title {
		color: #49687E;
		line-height: 42px;
		font-weight: 600;
	}
	.upgrade-title {
		font-size: 28px;
		font-weight: 500;
		line-height: 36px;
		text-align: center;
		padding: 10px 0 5px;
	}
	.rating-modal.popup-form-content .popup-content .upgrade-desc {
		color: #49687E;
		padding: 10px 0 0;
	}
	.upgrade-desc {
		font-size: 16px;
		font-weight: 400;
		line-height: 24px;
		text-align: center;
	}
	.upgrade-rating {
		padding: 25px 0 15px;
	}
	.upgrade-rating .jq-star {
		margin: 0 5px;
	}
	.upgrade-user-rating {
		font-size: 14px;
		color: rgba(73, 104, 126, 1);
	}
	.upgrade-user-rating span {
		font-weight: 500;
	}
	.jq-star {
		width: 100px;
		height: 100px;
		display: inline-block;
		cursor: pointer;
	}
	.upgrade-rating .jq-star svg {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
		stroke-width: 0px !important;
	}
	.mystickymenu-rated-rating .jq-star {
		width: 32px;
		height: 32px;
	}
	.upgrade-review-button {
		box-shadow: 0px 12px 12px -6px rgba(183, 141, 235, 0.52);
		background: rgba(183, 141, 235, 1);
		border: none;
		color: #fff;
		padding: 0 50px;
		line-height: 40px;
		font-size: 16px;
		border-radius: 8px;
		font-weight: 500;
		cursor: pointer;
	}
	.upgrade-review-textarea {
		padding: 15px 0;
		text-align: left;
	}
	.upgrade-review-textarea label {
		color: #83A1B7;
		font-size: 12px;
		display: flex;
		text-align: left;
		justify-content: space-between;
		padding: 0 0 5px 0;
	}
	.wp-core-ui select:active {
		border-color: #8c8f94;
		box-shadow: none;
	}
	.wp-core-ui select:hover {
		color: #2271b1;
	}
	select.upgrade-review-reminder {
		border: solid 1px #9fbbcb;
		width: 100%;
		padding: 4px 15px;
		margin-bottom: 15px;
	}
	.wp-core-ui select {
		font-size: 14px;
		line-height: 2;
		color: #2c3338;
		border-color: #8c8f94;
		box-shadow: none;
		border-radius: 3px;
		padding: 0 24px 0 8px;
		min-height: 30px;
		max-width: 25rem;
		-webkit-appearance: none;
		background: #fff url(data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2220%22%20height%3D%2220%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M5%206l5%205%205-5%202%201-7%207-7-7%202-1z%22%20fill%3D%22%23555%22%2F%3E%3C%2Fsvg%3E) no-repeat right 5px top 55%;
		background-size: 16px 16px;
		cursor: pointer;
		vertical-align: middle;
	}	
	.upgrade-review-textarea textarea {
		border: solid 1px #EAEFF2;
		width: 100%;
		height: 71px;
		padding: 4px 8px;
		font-size: 16px;
		line-height: 20px;
		outline: none;
		box-shadow: none;
		border-radius: 4px;
	}
	.upgrade-modal-button {
		padding: 0 0 25px;
	}	
	select.upgrade-review-reminder:focus {
		outline: none;
		box-shadow: none;
		border-color: rgba(183, 141, 235, 1);
	}
	.mystickymenu-rated-rating svg {
	  fill: #FDB10C;
	}
	</style>

<?php 
}