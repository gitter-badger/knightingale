<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Provider\Hypem;

use Ivory\HttpAdapter\Message\Response;
use Knightingale\KnightingaleHttpAdapter;
use Knightingale\Provider\Hypem\HypemProvider;
use Ivory\HttpAdapter\Message\Stream\StringStream;
use Knightingale\User\User;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;

/**
 * HypemProvider Tests
 */
class HypemProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Prophet
     */
    protected $prophet;

    /**
     * @var ObjectProphecy|KnightingaleHttpAdapter
     */
    protected $http;

    protected function setUp()
    {
        parent::setUp();

        $this->prophet = new Prophet();

        $this->http = $this->prophet->prophesize('Knightingale\KnightingaleHttpAdapter');
    }

    protected function tearDown()
    {
        $this->prophet->checkPredictions();

        parent::tearDown();
    }

    public function testGetLatest()
    {
        $hypem = new HypemProvider();
        $hypem->setHttpAdapter($this->http->reveal());

        $this->http
            ->get('http://hypem.com/playlist/latest/all/json')
            ->willReturn($this->getLatestJsonResponse());

        $latest = $hypem->getPlaylist('latest');

        $this->assertInstanceOf('Knightingale\Entity\Playlist', $latest);
        $this->assertCount(1, $latest->getTracks());
    }

    public function testGetPopular()
    {
        $hypem = new HypemProvider();
        $hypem->setHttpAdapter($this->http->reveal());

        $this->http
            ->get('http://hypem.com/playlist/popular/all/json')
            ->willReturn($this->getPopularJsonResponse());

        $popular = $hypem->getPlaylist('popular');

        $this->assertInstanceOf('Knightingale\Entity\Playlist', $popular);
        $this->assertCount(1, $popular->getTracks());
    }

    public function testGetStarred()
    {
        $hypemUserName = 'foudufafa';

        $hypem = new HypemProvider();
        $hypem->setUser(new User(['hypem' => $hypemUserName]));
        $hypem->setHttpAdapter($this->http->reveal());

        $this->http
            ->get(sprintf('http://hypem.com/playlist/loved/%s/json', $hypemUserName))
            ->willReturn($this->getStarredJsonResponse());

        $starred = $hypem->getUserPlaylist('starred');

        $this->assertInstanceOf('Knightingale\Entity\UserPlaylist', $starred);
        $this->assertCount(1, $starred->getTracks());
    }

    /**
     * @return Response
     */
    protected function getLatestJsonResponse()
    {
        $json = <<<JSON
{
    "version":"1.1",
    "0":{
        "mediaid":"26kd3",
        "artist":"Fickle Friends",
        "title":"FOR YOU",
        "dateposted":1419802557,
        "siteid":2260,
        "sitename":"Indie Music Filter",
        "posturl":"http:\/\/indiemusicfilter.com\/sams-year-end-list-songs",
        "postid":2592477,
        "loved_count":2703,
        "posted_count":48,
        "thumb_url":"http:\/\/static-ak.hypem.net\/thumbs_new\/dd\/2592477.jpg",
        "thumb_url_medium":"http:\/\/static-ak.hypem.net\/thumbs_new\/dd\/2592477_120.jpg",
        "thumb_url_large":"http:\/\/static-ak.hypem.net\/thumbs_new\/dd\/2592477_320.jpg",
        "thumb_url_artist":null,
        "time":205,
        "description":"Indie Music Filter I\u2019ve had the opportunity to write about some amazing new music this year: new artists, reinventions from old artists, and seeing some newer bands find a voice that they had been looking for since their debut. Finding only ten to make th",
        "itunes_link":"http:\/\/hypem.com\/go\/itunes_search\/Fickle%20Friends"
    }
}
JSON;
        return new Response(
            200,
            'OK',
            Response::PROTOCOL_VERSION_1_1,
            array(),
            new StringStream($json)
        );
    }

    /**
     * @return Response
     */
    protected function getPopularJsonResponse()
    {
        $json = <<<JSON
{
    "version":"1.1",
    "0":{
        "mediaid":"28hj1",
        "artist":"Diplo",
        "title":"Revolution (Unlike Pluto remix)",
        "dateposted":1419618490,
        "siteid":21329,
        "sitename":"Casablanca Sunset",
        "posturl":"http:\/\/casablancasunset.com\/diplo-revolution-unlike-pluto-remix\/",
        "postid":2592077,
        "loved_count":6698,
        "posted_count":5,
        "thumb_url":"http:\/\/static-ak.hypem.net\/thumbs_new\/4d\/2592077.jpg",
        "thumb_url_medium":"http:\/\/static-ak.hypem.net\/thumbs_new\/4d\/2592077_120.jpg",
        "thumb_url_large":"http:\/\/static-ak.hypem.net\/thumbs_new\/4d\/2592077_320.jpg",
        "thumb_url_artist":null,
        "time":198,
        "description":"The Los Angeles based producer Unlike Pluto delivers another hit with his remix Diplo\u2019s \u201cRevolution.\u201d This is a great track that really mellows out the rather harsh approach Diplo took on the song, while still remaining edgy. Similar to what you would hea",
        "itunes_link":"http:\/\/hypem.com\/go\/itunes_search\/Diplo"
    }
}
JSON;
        return new Response(
            200,
            'OK',
            Response::PROTOCOL_VERSION_1_1,
            array(),
            new StringStream($json)
        );
    }

    /**
     * @return Response
     */
    protected function getStarredJsonResponse()
    {
        $json = <<<JSON
{
    "version":"1.1",
    "0":{
        "mediaid":"26dqh",
        "artist":"Aphex Twin",
        "title":"minipops 67 (120.2)(source Field Mix)",
        "dateposted":1419696846,
        "siteid":15688,
        "sitename":"Another Dying Art Form",
        "posturl":"http:\/\/anotherdyingartform.com\/post\/106322439412\/best-albums-of-2014-18-aphex-twin-syro",
        "postid":2592279,
        "loved_count":967,
        "posted_count":39,
        "thumb_url":"http:\/\/static-ak.hypem.net\/thumbs_new\/17\/2592279.jpg",
        "thumb_url_medium":"http:\/\/static-ak.hypem.net\/thumbs_new\/17\/2592279_120.jpg",
        "thumb_url_large":"http:\/\/static-ak.hypem.net\/thumbs_new\/3e\/2591294_320.jpg",
        "thumb_url_artist":null,
        "time":288,
        "description":"Best Albums Of 2014 - #18: Aphex Twin - Syro Although 2013 was the Year Of The Unannounced Comeback, Richard D. James made his re-emergence the story in 2014. He front loads Syro with the most accessible tracks, luring the listener in with slinky bass and",
        "dateloved":1409938287,
        "itunes_link":"http:\/\/hypem.com\/go\/itunes_search\/Aphex%20Twin"
    }
}
JSON;
        return new Response(
            200,
            'OK',
            Response::PROTOCOL_VERSION_1_1,
            array(),
            new StringStream($json)
        );
    }
}
