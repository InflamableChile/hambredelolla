<?php namespace flow\cache;
if ( ! defined( 'WPINC' ) ) die;
/**
 * FlowFlow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 *
 * @link      http://looks-awesome.com
 * @copyright 2014-2015 Looks Awesome
 */
class FFCacheAdapter implements FFCache{
	private $force;
	private $context;
	/**  @var FFCache */
	private $cache;

	function __construct($context, $force = false){
		$this->force = $force;
		$this->context = $context;
	}

	public function setStream( $stream ) {
		if ($stream->moderation()){
			$this->cache = $this->admin() ?
				new FFAdminModerationCacheManager($this->context, $this->force) : new FFModerationCacheManager($this->context, $this->force);
		}
		else
			$this->cache = new FFCacheManager($this->context, $this->force);
		$this->cache->setStream($stream);
	}

	public function posts( $feeds, $disableCache ) {
		return $this->cache->posts( $feeds, $disableCache );
	}

	public function errors() {
		return $this->cache->errors();
	}

	public function hash() {
		return $this->cache->hash();
	}

	public function transientHash( $streamId ) {
		return $this->cache->transientHash($streamId);
	}

	public function moderate() {
		$this->cache->moderate();
	}

	private function admin(){
		return FF_USE_WP ? (function_exists('current_user_can') && current_user_can( 'administrator' )) : ff_user_can_moderate();
	}
}