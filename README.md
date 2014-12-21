Knightingale
============

Knightingale is a PHP framework that makes it easy to access your music from different providers.

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
