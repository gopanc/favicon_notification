{*
* 2007-2019 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<script src="../../libs/favico.js"></script> 

<div class="panel preview_icon">
	<h3><i class="icon icon-credit-card"></i> {l s='Preview' mod='favicon_notification'}</h3>
	<p>
		<strong>Here is how it looks</strong>
		<br />
	</p>	
	<div>
		<img src="../img/favicon.ico">
		<span class="display_topright">4</span>
	</div>
</div>

<style>
	.preview_icon {
		width: 100%;
		display: inline-block;
	}

	.preview_icon div{
		float: left;
		position: inherit;
	}

	.preview_icon div span{		
		position: absolute;		
		text-align: center;
		font-weight: bold;
		padding: 2px;
		font-size: 21px;
		min-width: 35px;
		min-height: 35px;
	}

	.display_circle {
		border-radius: 100%;
	}

	.display_square {
		border-radius: 0%;
	}

	.display_topleft{
		top: 0px;
		left: 0px;
	}

	.display_topright{
		top: 0px;
		right: 0px;
	}

	.display_bottomleft{
		bottom: 0px;
		left: 0px;
	}

	.display_bottomright{
		bottom: 0px;
		right: 0px;
	}
</style>

<script>
	$(function() {
		//Loads current background color in use
		var bg_color = $("#color_0").val();
		$(".preview_icon div span").css("background-color", bg_color);

		//Live previews the background color the user is selecting
		$("#color_0").change(function() {
			var bg_color = $("#color_0").val();
			$(".preview_icon div span").css("background-color", bg_color);
		});

		//Loads current position in use
		var display_position = $("#FAVICON_NOTIFICATION_POSITION option:selected").val();
		if (display_position == "down") {
			$(".preview_icon div span").removeClass("display_topleft display_topright display_bottomleft display_bottomright").addClass("display_bottomright");
		} else if (display_position == "up"){
			$(".preview_icon div span").removeClass("display_topleft display_topright display_bottomleft display_bottomright").addClass("display_topright");
		} else if (display_position == "left"){
			$(".preview_icon div span").removeClass("display_topleft display_topright display_bottomleft display_bottomright").addClass("display_bottomleft");
		} else if (display_position == "upleft"){
			$(".preview_icon div span").removeClass("display_topleft display_topright display_bottomleft display_bottomright").addClass("display_topleft");
		}

		//Live previews the display position the user is selecting
		$("#FAVICON_NOTIFICATION_POSITION").change(function() {
			if ($(this, "option:selected").val() == "down") {
				$(".preview_icon div span").removeClass("display_topleft display_topright display_bottomleft display_bottomright").addClass("display_bottomright");
			} else if ($(this, "option:selected").val() == "up"){
				$(".preview_icon div span").removeClass("display_topleft display_topright display_bottomleft display_bottomright").addClass("display_topright");
			} else if ($(this, "option:selected").val() == "left"){
				$(".preview_icon div span").removeClass("display_topleft display_topright display_bottomleft display_bottomright").addClass("display_bottomleft");
			} else if ($(this, "option:selected").val() == "upleft"){
				$(".preview_icon div span").removeClass("display_topleft display_topright display_bottomleft display_bottomright").addClass("display_topleft");
			}
		});

		//Loads current position in use
		var display_position = $("#FAVICON_NOTIFICATION_SHAPE option:selected").val();
		if (display_position == "circle") {
			$(".preview_icon div span").removeClass("display_circle display_square").addClass("display_circle");
		} else if (display_position == "rectangle"){
			$(".preview_icon div span").removeClass("display_circle display_square").addClass("display_square");
		}

		//Live previews the display position the user is selecting
		$("#FAVICON_NOTIFICATION_SHAPE").change(function() {
			if ($(this, "option:selected").val() == "circle") {
				$(".preview_icon div span").removeClass("display_circle display_square").addClass("display_circle");
			} else if ($(this, "option:selected").val() == "rectangle"){
				$(".preview_icon div span").removeClass("display_circle display_square").addClass("display_square");
			}
		});

		//Loads current text color in use
		var txt_color = $("#color_1").val();
		$(".preview_icon div span").css("color", txt_color);

		//Live previews the text color the user is selecting
		$("#color_1").change(function() {
			var txt_color = $("#color_1").val();
			$(".preview_icon div span").css("color", txt_color);
		});
	});
</script>