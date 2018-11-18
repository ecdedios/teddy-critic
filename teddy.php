<?php
/**
 * @package Teddy_Critic
 * @version 1.17
 */
/*
Plugin Name: Teddy Critic
Plugin URI: http://ednalyn.com/wordpress/plugins/teddy-critic/
Description: A plugin inspired by <cite>Matt's Mullenweg's</cite> original <cite>Hello Dolly</cite> plugin.
Author: Ednalyn C. De Dios
Version: 1.17
Author URI: http://ednalyn.com
*/

function Teddy_Critic_get_quote() {
    /** This  quote from our dear ol' friend Theodore Roosevelt */
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

	// Here we split it into lines
	$quotes = explode( "\n", $quotes );

	// And then randomly choose a line
	return wptexturize( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function Teddy_Critic() {
	$chosen = Teddy_Critic_get_quote();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'Teddy_Critic' );

// We need some CSS to position the paragraph
// using the original Hello Dolly plugin by Matt
function dolly_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );

?>
