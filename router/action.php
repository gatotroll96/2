<?php

	require_once 'api/vendor/autoload.php';
	session_start();

	class Action
	{
	    public function index(){
	    	echo "Welcome to Google Calendar";
	    }


	    public function showCalendar(){
	    	// init configuration
			$clientID = '741919172763-mt9p2isehumo07gmdle0b8bhc945kb64.apps.googleusercontent.com';
			$clientSecret = 'KCrgloyf2PW0UdvaGZTx90tA';
			$redirectUri = 'http://localhost/5/index.php?action=showCalendar';
			   
			// create Client Request to access Google API
			$client = new Google_Client();
			$client->setClientId($clientID);
			$client->setClientSecret($clientSecret);
			$client->setRedirectUri($redirectUri);
			$client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
			
			// authenticate code from Google OAuth Flow
			if (isset($_GET['code'])) {
				$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
				if(!isset($token['error'])){			  
					// get calendar info				  
					$service = new Google_Service_Calendar($client);

						// Print the next 10 events on the user's calendar.
						$calendarId = 'primary';
						$optParams = array(
						  'maxResults' => 10,
						  'orderBy' => 'startTime',
						  'singleEvents' => true,
						  'timeMin' => date('c'),
						);
						$results = $service->events->listEvents($calendarId, $optParams);
						$events = $results->getItems();

						if (empty($events)) {
						    print "No upcoming events found.\n";
						} else {
						    print "Upcoming events:\n";
						    $_SESSION['event'] = $events;
						    foreach ($events as $event) {
						        $start = $event->start->dateTime;
						        if (empty($start)) {
						            $start = $event->start->date;
						        }
						        printf("%s (%s)\n", $event->getSummary(), $start);
						    }
						}
				}else{
					if (empty($_SESSION['event'])) {
						    print "No upcoming events found.\n";
						} else {
						    print "Upcoming events:\n";						    
						    foreach ($_SESSION['event'] as $event) {
						        $start = $event->start->dateTime;
						        if (empty($start)) {
						            $start = $event->start->date;
						        }
						        printf("%s (%s)\n", $event->getSummary(), $start);
						    }
						}
				}		  
			}else {
			  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
			}
	    }

	    public function logout(){
	    	

			//Destroy entire session data.
			session_destroy();

			//redirect page to index.php
			header('location:index.php');
	    }
	}
	





?>