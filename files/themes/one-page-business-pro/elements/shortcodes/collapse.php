<?php
/**
 * Title: Shortcode[cc_collapse]
 *
 * Description: Defines markup for shortcode [cc_collapse], handles parameters passed in the shortcode.
 *
 * Please do not edit this file. This file is part of the CyberChimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

// Variable to hold name/ID of parent div of collapse div which is passed by [collapse]
$parent = "";

function cyberchimps_shortcodes_collapse( $atts, $content = null ) {

	global $parent;

	// Extract parameters passed in the shortcode
	extract( shortcode_atts( array(
		                         'name' => 'cyberchimps_collapse',
	                         ), $atts ) );

	// Assign name to parent
	$parent = $name;

	// Markup for Modal
	$html .=
		'<div class="accordion" id="' . $name . '">'
		. do_shortcode( $content ) .
		'</div>';

	return $html;
}

add_shortcode( 'cc_collapse', 'cyberchimps_shortcodes_collapse' );

function cyberchimps_shortcodes_collapse_tab( $atts, $content = null ) {

	// Extract parameters passed in the shortcode
	extract( shortcode_atts( array(
		                         'name'  => 'cyberchimps_collapse_tab',
		                         'label' => 'Collapsible tab'
	                         ), $atts ) );

	global $parent;

	// Markup for Modal
	$html .=
		'<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#' . $parent . '" href="#' . $name . '">' .
		$label .
		'</a>
	</div>
	<div id="' . $name . '" class="accordion-body collapse">
				<div class="accordion-inner">'
		. do_shortcode( $content ) .
		'</div>
	</div>
</div>';

	return $html;
}

add_shortcode( 'cc_collapse_tab', 'cyberchimps_shortcodes_collapse_tab' );?>