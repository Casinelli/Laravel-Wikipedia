<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - search()
* - getSentences()
* - getChars()
* - getResponseExtract()
* Classes list:
* - Wikipedia
*/
namespace KealJones\LaravelWikipedia;

class Wikipedia
{
    
    protected $queryBuilder;
    
    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder;
        $this->queryBuilder->setFormat( "php" );
        $this->queryBuilder->setExtractsPlainText( true );
    }
    
    /**
     * Sets up the entry name to be searched
     * @param  string $search Entry name
     * @return \Casinelli\Wikipedia\Wikipedia Return itself
     */
    public function search( $search )
    {
        $this->queryBuilder->setTitles( $search );
        
        return $this;
    }
    
    /**
     * Returns $sentences sentences
     * @param  int $sentences Number of sentences to be returned
     * @return string         Extract
     */
    public function getSentences( $sentences )
    {
        $this->queryBuilder->setExtractsSentences( $sentences );
        
        return $this->getResponseExtract( $this->queryBuilder->fetch() );
    }
    
    /**
     * Returns $chars chars
     * @param  int $chars Number of characters to be returned
     * @return string     Extract
     */
    public function getChars( $chars )
    {
        $this->queryBuilder->setExtractsChars( $chars );
        
        return $this->getResponseExtract( $this->queryBuilder->fetch() );
    }
    
    /**
     * Return the extract part of the response, if there is one.
     * Otherwise it returns null.
     * @param  mixed $serializedResponse A serialized PHP array
     * @return string                    Extract
     */
    protected function getResponseExtract( $serializedResponse )
    {
        $response = unserialize( $serializedResponse );
        
        $page = reset( $response["query"]["pages"] );
        
        if( !isset( $page["extract"] ) )return null;
        
        return $page["extract"];
    }
}
