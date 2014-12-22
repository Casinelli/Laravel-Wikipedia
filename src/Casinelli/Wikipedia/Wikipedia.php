<?php namespace Casinelli\Wikipedia;

class Wikipedia {
	
	protected $queryBuilder;

	public function __construct()
	{
		$this->queryBuilder = new QueryBuilder;
		$this->queryBuilder->setFormat("php");
		$this->queryBuilder->setExtractsPlainText(true);
	}

	public function search($search)
	{
		$this->queryBuilder->setTitles($search);

		return $this;
	}

	public function getSentences($sentences)
	{
		$this->queryBuilder->setExtractsSentences($sentences);

		return $this->getResponseExtract( $this->queryBuilder->fetch() );
	}

	public function getChars($chars)
	{
		$this->queryBuilder->setExtractsChars($chars);

		return $this->getResponseExtract( $this->queryBuilder->fetch() );
	}

	protected function getResponseExtract($serializedResponse)
	{
		$response = unserialize( $serializedResponse );

		$page = reset( $response["query"]["pages"] );

		return $page["extract"];
	}

}