<?php
/**
 * @package Go_with_the_flow
 * @version 1.7.2
 */
/*
Plugin Name: Go with the flow
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Basierend auf Hello Dolly, allerdings mit anderen Lyrics.
Author: Matt Mullenweg & Phil Schledorn
Version: 1.7.2
Author URI: http://ma.tt/
*/

function flow_get_lyric() {      /** These are the lyrics to Go with the Flow */
$lyrics =
"She said I'll throw myself away.
They're just photos after all.
I can't make you hang around.
I can't wash you off my skin.
Outside the frame, is what we're leaving out.
You won't remember anyway.
I can go with the flow.
But don't say it doesn't matter, matter anymore.
I can go with the flow.
Do you believe it in your head?
It's so safe to play along.
Little soldiers in a row.
Falling in and out of love.
Something sweet to throw away.
I want something good to die for.
To make it beautiful to live.
I want a new mistake, lose is more than hesitate.
Do you believe it in your head?
I can go with the flow…";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function flow() {
	$chosen = flow_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="flow"><span class="screen-reader-text">%s </span><span dir="ltr"%s><a href="https://www.youtube.com/watch?v=DcHKOC64KnE" target="_blank">%s</a></span></p>',
		__( 'Quote from Go with the Flow by Queens of the Stone Age:' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'flow' );

// We need some CSS to position the paragraph.
function flow_css() {
	echo "
	<style type='text/css'>
	#flow {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #flow {
		float: left;
	}
	.block-editor-page #flow {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#flow,
		.rtl #flow {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'flow_css' );
