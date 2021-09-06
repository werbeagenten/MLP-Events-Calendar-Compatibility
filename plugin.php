<?php
/**
 * Plugin Name:     Multilingual Press - The Events Calendar Compatibility
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Adds missing compatibility functions for The Events Calendar to Multilingual Press.
 * Author:          TW Werbeagenten Heidelberg GmbH
 * Author URI:      https://www.werbeagenten.de
 * Text Domain:     mlp-events-calendar-compatibility
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Mlp_Events_Calendar_Compatibility
 */

// Your code starts here.

namespace Werbeagenten\Mlp_Events_Calendar_Compatibility;

add_action('multilingualpress.metabox_after_relate_posts', __NAMESPACE__ . '\copy_events_postmeta_fields', 10, 2);

/**
 * Copy the postmeta fields from the original post to the translation.
 */
function copy_events_postmeta_fields( $context, $request ) {

	// Fields to copy
	$fields_to_copy = [
		'_EventStartDate',
		'_EventEndDate',
		'_EventAllDay',
		'_EventStartDateUTC',
		'_EventEndDateUTC',
		'_EventTimezone',
		'_EventShowMapLink',
		'_EventShowMap',
		'_EventDuration',
		'_EventCurrencySymbol',
		'_EventCurrencyPosition',
		'_EventCost',
		'_EventURL',
		'_EventTimezone',
		'_EventTimezoneAbbr',
		'_EventOrigin'
	];

	$field_values = [];

	// switch to the original posts blog
	switch_to_blog( $context->sourceSiteId() );

	/// Get the original posts postmeta values for the fields to copy.
	foreach ( $fields_to_copy as $field ) {
		$field_values[ $field ] = get_post_meta( $context->sourcePostId(), $field, true );
	}

	// Switch back to the current blog (the blog of the new duplicated post)
	restore_current_blog();

	// save the postmeta values for the fields to copy
	foreach ( $field_values as $field => $value ) {
		update_post_meta( $context->remotePostId(), $field, $value );
	}

}
