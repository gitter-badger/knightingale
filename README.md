Knightingale
============

[![Latest Stable Version](https://img.shields.io/packagist/v/knightingale-io/knightingale.svg?style=flat-square)](https://packagist.org/packages/knightingale/knightingale)
[![Build Status](https://img.shields.io/travis/knightingale-io/knightingale.svg?style=flat-square)](http://travis-ci.org/knightingale-io/knightingale)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/0479a5d4-0059-4a70-8e9c-685a147680f8.svg?style=flat-square)](https://insight.sensiolabs.com/projects/0479a5d4-0059-4a70-8e9c-685a147680f8)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/knightingale-io/knightingale.svg?style=flat-square)](https://scrutinizer-ci.com/g/knightingale-io/knightingale/)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/knightingale-io/knightingale.svg?style=flat-square)](https://scrutinizer-ci.com/g/knightingale-io/knightingale/code-structure/)
[![Packagist](https://img.shields.io/packagist/l/knightingale/knightingale.svg?style=flat-square)](https://github.com/knightingale-io/knightingale/blob/master/LICENSE)


Knightingale is a PHP library that provides a unified interface to various music services.

### Installing via Composer

```bash
composer require knightingale/knightingale
```

### Supported providers

- [The Hype Machine](#the-hype-machine)

#### The Hype Machine

##### Anonymous access

```php
use Knightingale\KnightingaleKernel;

$knightingale = new KnightingaleKernel();
/** @var \Knightingale\Provider\Hypem\HypemProvider $hypem */
$hypem = $knightingale->getProvider('hypem');
$playlist = $hypem->getPlaylist('popular');
$trackCollection = $playlist->getTracks();

foreach ($trackCollection as $track) {
    printf(
        "%s by %s (Added: %s)\n",
        $track->getName(),
        $track->getArtistName(),
        $track->getAddedAt()->format('d.m.Y')
    );
}
```

##### Access as a user

```php
use Knightingale\User\User;
use Knightingale\KnightingaleKernel;

// Configuration
$user = new User([
    'hypem' => 'foudufafa'
]);

$knightingale = new KnightingaleKernel();
$knightingale->setUser($user);

// Usage
/** @var \Knightingale\Provider\Hypem\HypemProvider $hypem */
$hypem = $knightingale->getProvider('hypem');
$playlist = $hypem->getUserPlaylist('starred');
$trackCollection = $playlist->getTracks();

foreach ($trackCollection as $track) {
    printf(
        "%s by %s (Added: %s)\n",
        $track->getName(),
        $track->getArtistName(),
        $track->getAddedAt()->format('d.m.Y')
    );
}
