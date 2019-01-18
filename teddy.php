<?php
/**
 * @package Teddy_Critic
 * @version 1.2
 */
/*
Plugin Name: Teddy Critic
Plugin URI: https://github.com/ecdedios/teddy-critic
Description: A plugin inspired by <cite>Matt's Mullenweg's</cite> original <cite>Hello Dolly</cite> plugin. When activated a randomly selected phrase from <cite>Teddy Roosevelt's The Man in the Arena"</cite> will appear in the upper right of your admin screen on every page.
Author: Ednalyn C. De Dios
Version: 1.2
Author URI: http://ednalyn.com
*/

function teddy_critic_get_quote() {
	/** This  is the sppech, The Man in the Arena **/
	$quotes = "It is not the critic who counts;
not the man who points out how the strong man stumbles,
or where the doer of deeds could have done them better.
The credit belongs to the man who is actually in the arena,
whose face is marred by dust and sweat and blood;
who strives valiantly; who errs,
who comes short again and again,
because there is no effort without error and shortcoming;
but who does actually strive to do the deeds;
who knows great enthusiasms,
the great devotions;
who spends himself in a worthy cause;
who at the best knows in the end
the triumph of high achievement,
and who at the worst, if he fails,
at least fails while daring greatly,
so that his place shall never be
with those cold and timid souls
who neither know victory nor defeat.";

	// Splits it the speech into lines
	$quotes = explode( "\n", $quotes );

	// Random selection of a line
	return wptexturize( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );
}

// Echoes the chosen line
function teddy_critic() {
	$chosen = teddy_critic_get_quote();
	echo "<p id='teddy'>$chosen</p>";
}

// This function will execute when the admin_notices action is called
add_action( 'admin_notices', 'teddy_critic' );

// CSS to position the paragraph
function teddy_css() {
	// Ensures positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#teddy {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'teddy_css' );

?>
