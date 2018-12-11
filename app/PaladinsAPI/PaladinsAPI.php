<?php

namespace PaladinsNinja\PaladinsAPI;

use Carbon\Carbon;
use PaladinsNinja\PaladinsAPI\PaladinsException;
use Illuminate\Support\Facades\Cache;
use function GuzzleHttp\json_decode;

class PaladinsAPI
{
    private $devId;
    private $authKey;
    private $apiUrl;
    private $guzzleClient;
    private static $instance;

    public function __construct($devId, $authKey)
    {
        $this->devId        = $devId;
        $this->authKey      = $authKey;
        $this->apiUrl       = 'http://api.paladins.com/paladinsapi.svc';
        $this->guzzleClient = new \GuzzleHttp\Client;
    }

    public static function getInstance($devId = null, $authKey = null)
    {
        if ( !isset(self::$instance)) {
            self::$instance = new self($devId, $authKey);
        }
        return self::$instance;
    }

    /**
     * Get the top 50 most watched / recent matches
     *
     * @return void
     */
    public function getTopMatches()
    {
        $response = $this->guzzleClient->get($this->buildUrl('gettopmatches'));

        return json_decode($response->getBody(), true);
    }

    /**
     * Get the information for a particular ended match.
     *
     * @param  int $matchId
     * @return void
     */
    public function getModeDetails(int $matchId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getmodedetails', $matchId));

        return json_decode($response->getBody(), true);
    }

    /**
     * Gets all the player loadouts available.
     *
     * @param integer $playerId
     * @return void
     */
    public function getPlayerLoadouts(int $playerId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getplayerloadouts', $playerId, 1));

        return json_decode($response->getBody(), true);
    }

    public function getChampionRanks(int $playerId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getchampionranks', $playerId));

        return json_decode($response->getBody(), true);
    }

    public function getPlayerFriends(int $playerId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getfriends', $playerId));

        return json_decode($response->getBody(), true);
    }

    public function getChampions()
    {
        $response = $this->guzzleClient->get($this->buildUrl('getchampions', null, 1)); // 1 = ENGLISH

        return json_decode($response->getBody(), true);
    }

    public function getItems()
    {
        $response = $this->guzzleClient->get($this->buildUrl('getitems', null, 1)); // 1 = ENGLISH

        return json_decode($response->getBody(), true);
    }

    public function getChampionCards(int $championId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getchampioncards', null, 1, null, $championId));

        return json_decode($response->getBody(), true);
    }

    public function getChampionSkins(int $championId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getchampionskins', null, 1, null, $championId));

        return json_decode($response->getBody(), true);
    }

    public function getPlayer(string $playerName, int $platform = null)
    {
        // if ($platform) {
        //     $this->getPlayerIdByPortalUserId($playerName, $platform);
        // }

        $response = $this->guzzleClient->get($this->buildUrl('getplayer', $playerName));

        return json_decode($response->getBody(), true);
    }

    public function getPlayerIdByName(string $playerName)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getplayeridbyname', $playerName));

        return json_decode($response->getBody(), true);
    }

    public function getPlayerIdByPortalUserId(string $playerName, int $platform)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getplayeridbyportaluserid', $playerName, null, null, null, null, null, null, $platform));

        \Log::info($response->getBody());
        return json_decode($response->getBody(), true);
    }

    public function getPlayerStatus(int $playerId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getplayerstatus', $playerId));

        return json_decode($response->getBody(), true);
    }

    public function getMatchHistory(int $playerId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getmatchhistory', $playerId));

        return json_decode($response->getBody(), true);
    }

    public function getMatchDetails(int $matchId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getmatchdetails', null, null, $matchId));

        return json_decode($response->getBody(), true); 
    }

    public function getActiveMatchDetails(int $matchId)
    {
        $response = $this->guzzleClient->get($this->buildUrl('getmatchplayerdetails', null, null, $matchId));

        return json_decode($response->getBody(), true); 
    }

    public function getDataUsage()
    {
        $response = $this->guzzleClient->get($this->buildUrl('getdataused'));

        return json_decode($response->getBody(), true);
    }

    public function getMatchIdsByQueue(string $hour, $date, int $queue = 424)
    {
        $url = $this->apiUrl . '/getmatchidsbyqueueJson/' . $this->devId . '/' . $this->getSignature('getmatchidsbyqueue') . '/' . $this->getSession() . '/' . $this->getTimestamp() . '/' . $queue . '/' . $date . '/' . $hour;
        $response = $this->guzzleClient->get($url);

        return json_decode($response->getBody(), true);
    }

    private function getSession() 
    {
        // TODO: Check and see if this will be affected on a multi-sever/loadbalanced network.
        if (!Cache::has('paladins.api.sessionId') || Cache::get('paladins.api.sessionId') == null) {
            try {
                $response = $this->guzzleClient->get($this->apiUrl . '/createsessionJson/' . $this->devId . '/' . $this->getSignature('createsession') . '/' . $this->getTimestamp());
                \Log::info('Getting new session');
                \Log::info(json_decode($response->getBody(), true));
                Cache::put('paladins.api.sessionId', json_decode($response->getBody(), true)['session_id'], Carbon::now()->addMinutes(12));

                return Cache::get('paladins.api.sessionId');
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
                throw new PaladinsException($e->getMessage());
            }
        } else {
            return Cache::get('paladins.api.sessionId');
        }
    }

    private function getSignature(string $method)
    {
        return md5($this->devId . $method . $this->authKey . $this->getTimestamp());
    }

    private function getTimestamp()
    {
        return Carbon::now('UTC')->format('YmdHis');
    }

    private function buildUrl(string $method = null, $player = null, int $lang = null, int $match_id = null, int $champ_id = null, int $queue = null, int $tier = null, int $season = null, int $platform = null)
    {
        $baseUrl = $this->apiUrl . '/' . $method . 'Json/' . $this->devId . '/' . $this->getSignature($method) . '/' . $this->getSession() . '/' . $this->getTimestamp();

        $platform ? ($baseUrl .= '/' . $platform) : null;
        $player ? ($baseUrl .= '/' . $player) : null;
        $champ_id ? ($baseUrl .= '/' . $champ_id) : null;
        $lang ? ($baseUrl .= '/' . $lang) : null;
        $match_id ? ($baseUrl .= '/' . $match_id) : null;
        $queue ? ($baseUrl .= '/' . $queue) : null;
        $tier ? ($baseUrl .= '/' . $tier) : null;
        $season ? ($baseUrl .= '/' . $season) : null;
        
        

        \Log::info($baseUrl);

        return $baseUrl;
    }
}