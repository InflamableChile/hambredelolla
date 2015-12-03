<?php

	require_once('phirehose/Phirehose.php');
	require_once('phirehose/OauthPhirehose.php');

	/**
	 * Example of using Phirehose to display a live filtered stream using track words 
	 */
	class FilterTrackConsumer extends OauthPhirehose
	{
	  /**
	   * Enqueue each status
	   *
	   * @param string $status
	   */
	  public function enqueueStatus($status)
	  {
	    /*
	     * In this simple example, we will just display to STDOUT rather than enqueue.
	     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
	     *       enqueued and processed asyncronously from the collection process. 
	     */
	    $data = json_decode($status, true);
	    if (is_array($data) && isset($data['user']['screen_name'])) {
	      print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "\n";
	    }
	  }
	}
	// The OAuth credentials you received when registering your app at Twitter
	define("TWITTER_CONSUMER_KEY", "LKIMgzYNSTvDSbOupNJKi2URk");
	define("TWITTER_CONSUMER_SECRET", "VX5H9igyX3HAaXIkE1gFhgS4VKKaaJRksUaCLFNAuQFdK25LN7");
	// The OAuth data for the twitter account
	define("OAUTH_TOKEN", "51871509-kmD2SOUIPpG36RTcN7naCnQlH6BsUVraqdPkt6qGc");
	define("OAUTH_SECRET", "niHfPJoOMOtBdBkos8RxFA2HMYlTywxT3JVjzY0KhhH1P");
	// Start streaming
	$sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
	$sc->setTrack(array('#hambredelolla'));
	$sc->consume(); 
	echo "TODO BIEN";
?>


