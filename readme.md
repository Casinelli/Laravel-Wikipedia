# Laravel-Wikipedia

### About 

This project is a fork to extend the functionality of the original Laravel-Wikipedia By Giovanni Casinelli (see credits below)

### Installation

Begin by installing this package through Composer.

```js
{
    "require": {
        "casinelli/wikipedia": "dev-master"
    }
}
```

### Usage

**Retrieve page extract**

```php
$wikipedia = new \Casinelli\Wikipedia\Wikipedia;

return $wikipedia->search("Rome")->getSentences(5);
```

**Same with QueryBuilder**

```php
$qb = new \Casinelli\Wikipedia\QueryBuilder;

$qb->setFormat("php");
$qb->setTitles("Singapore");
$qb->setExtractsSentences(3);
$qb->setExtractsPlainText(true);

$response = unserialize( $qb->fetch() );

$page = reset( $response["query"]["pages"] );

return $page["extract"];
```

### Credits

Original Project Author: 
Giovanni Casinelli
https://github.com/Casinelli/Laravel-Wikipedia
