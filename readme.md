# Wikipedia

**Example: Retrieve page extract**

```
$qb = new \Casinelli\Wikipedia\QueryBuilder;

$qb->setFormat("php");
$qb->titles = "Earth";
$qb->exsentences = 4;

$response = unserialize( $qb->fetch() );

$page = reset( $response["query"]["pages"] );

return $page["extract"];
```