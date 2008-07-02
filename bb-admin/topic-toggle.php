<?php
require('admin-action.php');

$topic_id = (int) $_GET['id'];
$topic    =  get_topic ( $topic_id );

if ( !$topic )
	bb_die(__('There is a problem with that topic, pardner.'));

if ( !bb_current_user_can( 'close_topic', $topic_id ) ) {
	wp_redirect( bb_get_uri(null, null, BB_URI_CONTEXT_HEADER) );
	exit();
}

bb_check_admin_referer( 'close-topic_' . $topic_id );

if ( topic_is_open( $topic_id ) )
	bb_close_topic( $topic_id );
else
	bb_open_topic ( $topic_id );

if ( !$redirect = wp_get_referer() )
	$redirect = get_topic_link( $topic_id );

bb_safe_redirect( $redirect );
exit;

?>
