Knightingale
============

[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/knightingale-io/knightingale?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Latest Stable Version](https://img.shields.io/packagist/v/knightingale/knightingale.svg?style=flat-square)](https://packagist.org/packages/knightingale/knightingale)
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
use Knightingale\Provider\Hypem\HypemProvider;

$hypem = new HypemProvider();
$playlists = $hypem->getAvailablePlaylists(); // ['latest', 'popular']
$latest = $hypem->getPlaylist('latest');

foreach ($latest->getTracks() as $track) {
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
use Knightingale\Provider\Hypem\HypemProvider;

$user = new User([
    'hypem' => 'foudufafa'
]);

$hypem = new HypemProvider();
$hypem->setUser($user);

$playlists = $hypem->getAvailableUserPlaylists(); // ['starred']
$starred = $hypem->getUserPlaylist('starred');

foreach ($starred->getTracks() as $track) {
    printf(
        "%s by %s (Added: %s)\n",
        $track->getName(),
        $track->getArtistName(),
        $track->getAddedAt()->format('d.m.Y')
    );
}
```

