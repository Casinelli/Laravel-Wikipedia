# Wikipedia

**Example: Retrieve page extract**

```
$qb = new \Casinelli\Wikipedia\QueryBuilder;

$qb->setFormat("php");
$qb->setTitles("Singapore");
$qb->setExtractsSentences(3);
$qb->setExtractsPlainText(true);

$response = unserialize( $qb->fetch() );

$page = reset( $response["query"]["pages"] );

return $page["extract"];
```