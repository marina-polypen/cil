<?php
/**
 * Plugin Name: Conditional Internal Links
 * Description: Hides internal links pointing to non-published posts/pages/CPT (draft, pending, future, private) and automatically restores them once the target is published.
 * Version: 1.0.0
 * Author: MarinaP
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'the_content', 'cil_filter_internal_links', 20 );

/**
 * Scan post content for internal links and strip the anchor tag
 * if the linked post is not publicly published.
 *
 * @param string $content Post content.
 * @return string Filtered content.
 */
function cil_filter_internal_links( $content ) {

	if ( is_admin() || empty( $content ) || false === strpos( $content, '<a' ) ) {
		return $content;
	}

	return preg_replace_callback(
		'/<a\s[^>]*href=(["\'])(.*?)\1[^>]*>(.*?)<\/a>/is',
		'cil_process_link_match',
		$content
	);
}

/**
 * Callback for each matched anchor tag.
 *
 * @param array $matches Regex matches: [0] full tag, [1] quote, [2] href, [3] anchor text.
 * @return string Original tag or plain anchor text.
 */
function cil_process_link_match( $matches ) {

	$full_tag    = $matches[0];
	$href        = trim( $matches[2] );
	$anchor_text = $matches[3];

	if ( '' === $href ) {
		return $full_tag;
	}

	if ( ! cil_is_internal_url( $href ) ) {
		return $full_tag;
	}

	$post_id = url_to_postid( $href );

	// No matching post found (e.g. archive, category, custom URL) — leave untouched.
	if ( ! $post_id ) {
		return $full_tag;
	}

	$post_status = get_post_status( $post_id );

	// Post not found or already publicly accessible — keep the link as is.
	if ( ! $post_status || 'publish' === $post_status ) {
		return $full_tag;
	}

	return $anchor_text;
}

/**
 * Determine whether a URL points to the current site (internal link).
 *
 * @param string $url URL to check.
 * @return bool True if internal, false if external.
 */
function cil_is_internal_url( $url ) {

	// Relative URLs (no host) are always internal.
	$parsed_url = wp_parse_url( $url );

	if ( empty( $parsed_url['host'] ) ) {
		return true;
	}

	$site_host = wp_parse_url( home_url() );

	if ( empty( $site_host['host'] ) ) {
		return false;
	}

	return strcasecmp( $parsed_url['host'], $site_host['host'] ) === 0;
}
