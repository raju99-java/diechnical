<?php

namespace App\Helpers;

use Google_Client;
use Google_Service_Calendar;
/* * *************Models**************** */
use App\Model\UserMaster;

class CalenderApi {

    protected $client;

    public function __construct() {
        // Initialise the client.
        $this->client = new Google_Client();
// Set the application name, this is included in the User-Agent HTTP header.
        $this->client->setApplicationName('Calendar integration');
// Set the authentication credentials we downloaded from Google.
        $this->client->setAuthConfig(public_path('/credentials.json'));
// Setting offline here means we can pull data from the venue's calendar when they are not actively using the site.
        $this->client->setAccessType("offline");
// This will include any other scopes (Google APIs) previously granted by the venue
        $this->client->setIncludeGrantedScopes(true);
// Set this to force to consent form to display.
        $this->client->setApprovalPrompt('force');
// Add the Google Calendar scope to the request.
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
// Set the redirect URL back to the site to handle the OAuth2 response. This handles both the success and failure journeys.
        $this->client->setRedirectUri(url('oauth2callback'));
        // Set state allows us to match the consent to a specific venues
    }

    public function createAuthURL($id) {

        $this->client->setState($id);
// The Google Client gives us a method for creating the 
        return $this->client->createAuthUrl();
    }

    public function fetchGCalenderCrendials($code) {
        return $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function refreshingAccessToken($gcalendar_credentials, $userid) {
        $this->client->setAccessToken($gcalendar_credentials);
        if ($this->client->isAccessTokenExpired()) {
            $NewAccessToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            if (!empty($NewAccessToken)) {
                $model = UserMaster::where('id', $userid)->first();
                $model->update(['gcalendar_credentials' => json_encode($NewAccessToken)]);
            }
        }
    }

    public function getCalendarService($userid, $accessToken, $optParams) {
        $this->refreshingAccessToken($accessToken, $userid);
        $service = new Google_Service_Calendar($this->client);
        $calendarId = 'primary';
        return $service->events->listEvents($calendarId, $optParams);
    }

    public function fetchMoreEventWithPageToken($optParams) {
        $service = new Google_Service_Calendar($this->client);
        $calendarId = 'primary';
        return $service->events->listEvents($calendarId, $optParams);
    }

}
