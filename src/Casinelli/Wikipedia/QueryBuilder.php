<?php namespace Casinelli\Wikipedia;

class QueryBuilder {

	protected $url = "http://en.wikipedia.org/w/api.php";

	/**
	 * Contains query parameters that cannot be modified
	 * @var array
	 */
	protected $queryPrivate = [
		'action' => 'query',
		'prop' => 'extracts',
	];

	/**
	 * Query parameters that can be modified
	 * to produce differen results
	 * @var array
	 */
	protected $query = [
		'exchars' => null,		// No less than 1
		'exsentences' => null,	// Between 1 and 10
		'exlimit' => 1,			// Max 20
		'titles' => null,			// The page title to search

		'format' => 'json',		// json|xml|php|wddx|yaml|jsonfm|txt|dbg|dump
	];

	/**
	 * Allowed response formats
	 * @link https://www.mediawiki.org/wiki/API:Data_formats
	 * @var array
	 */
	protected $allowedFormats = ['json', 'xml', 'php', 'wddx', 'yaml', 'jsonfm', 'txt', 'dbg', 'dump'];

	public function fetch()
	{
		return file_get_contents( $this->getQueryUrl() );
	}

	/**
	 * Returns the URL with query string
	 * @return string The URL with query string used to retrieve data from wikipedia
	 */
	public function getQueryUrl()
	{
		return $this->url . '?' . $this->getQueryString();
	}

	public function getQueryString()
	{
		return http_build_query( array_merge($this->query, $this->queryPrivate) );
	}

	protected function isValidQueryParam($name)
	{
		return array_key_exists($name, $this->query);
	}

	public function getFormat()
	{
		return $this->format;
	}

	/**
	 * Set the response format
	 * @param string $format The response format. Must be one of $this->allowedFormat.
	 */
	public function setFormat($format)
	{
		if ( ! in_array($format, $this->allowedFormats) ) return false;

		$this->format = $format;

		return true;
	}

	/**
	 * Allows to set only parameters in the $query array
	 * @param string $name  query attribute to set
	 * @param string $value new value of the query attribute
	 */
	public function __set($name, $value)
	{
		if ( ! $this->isValidQueryParam($name)) return;

		$this->query[$name] = $value;
	}

	/**
	 * Gets only from parameters in the $query array
	 * @param  string $name query attribute
	 * @return string       $this->query[$name]
	 */
	public function __get($name)
	{
		if ( ! array_key_exists($name, $this->query)) return null;

		return $this->query[$name];
	}

}
