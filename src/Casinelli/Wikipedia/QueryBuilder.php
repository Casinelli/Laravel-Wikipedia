<?php namespace Casinelli\Wikipedia;

class QueryBuilder {

	protected $url = "http://en.wikipedia.org/w/api.php";

	/**
	 * Contains query parameters that cannot be modified
	 * @var array
	 */
	protected $queryPrivate = [
		'action' => 'query',
		'prop'   => 'extracts',
	];

	/**
	 * Query parameters that can be modified
	 * to produce differen results
	 * @var array
	 */
	protected $query = [
		'exchars'     => null,		// No less than 1
		'exsentences' => null,	// Between 1 and 10
		'exlimit'     => 1,			// Max 20
		'titles'      => null,		// The page title to search
		'explaintext' => null,	// Return format as plain text instead of HTML
		
		'format'      => 'json',		// json|xml|php|wddx|yaml|jsonfm|txt|dbg|dump
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

	/**
	 * Get the query string built from the parameters in $query and $queryPrivate
	 * @return string The query string
	 */
	public function getQueryString()
	{
		return http_build_query( array_merge($this->query, $this->queryPrivate) );
	}

	/**
	 * Get the format requested for the data to be returned
	 * @return string The format of the data to be returned
	 */
	public function getFormat()
	{
		return $this->query["format"];
	}

	/**
	 * Set the response format
	 * @param string $format The response format. Must be one of $this->allowedFormat.
	 */
	public function setFormat($format)
	{
		if ( ! in_array($format, $this->allowedFormats) ) return false;

		$this->query["format"] = $format;

		return true;
	}

	/**
	 * Get the number of extracts to return
	 * @return int The number of extracts to return
	 */
	public function getExtractsLimit()
	{
		return $this->query["exlimit"];
	}

	/**
	 * Sets the maximum number of extracts to return. Max allowed: 20.
	 * @param int $value The number of extracts to return
	 */
	public function setExtractsLimits($value)
	{
		if ($value < 1 || $value > 20) return false;

		$this->query["exlimits"] = $value;

		return true;
	}

	/**
	 * Get the number of characters to return for each extract
	 * @return int The number of characters to return for each extract
	 */
	public function getExtractsChars()
	{
		return $this->query["exchars"];
	}

	/**
	 * Set the number of characters to return for each extract
	 * @param int $chars The number of characters to return for each extract
	 */
	public function setExtractsChars($chars)
	{
		if ($chars < 1) return false;

		$this->query["exchars"] = $chars;
		$this->query["exsentences"] = null;

		return true;
	}

	/**
	 * Get the number of sentences to return for each extract
	 * @return int The number of sentences to return for each extract
	 */
	public function getExtractsSentences()
	{
		return $this->query["exsentences"];
	}

	/**
	 * Set the number of sentences to return for each extract
	 * @param int $sentences The number of sentences to return for each extract
	 */
	public function setExtractsSentences($sentences)
	{
		if ($sentences < 1 || $sentences > 10) return false;

		$this->query["exsentences"] = $sentences;
		$this->query["exchars"] = null;

		return true;
	}

	/**
	 * Get the titles of the pages to search for
	 * @return string The titles of the pages
	 */
	public function getTitles()
	{
		return $this->query["titles"];
	}

	/**
	 * Set the titles of the pages to search for
	 * @param string $titles Titles of the pages
	 */
	public function setTitles($titles)
	{
		$this->query["titles"] = $titles;

		return true;
	}

	/**
	 * Get the explaintext query value, that tells if it's
	 * looking for plain text or HTML
	 * @return [type] [description]
	 */
	public function getExtractsPlainText()
	{
		return $this->query["explaintext"];
	}

	/**
	 * Sett the explaintext query value
	 * @param bool $value True for Plain text, false for HTML
	 */
	public function setExtractsPlainText($value)
	{
		return $this->query["explaintext"] = $value;
	}

}
