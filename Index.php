<?php

use React\EventLoop\Factory;
use shanemcc\discord\DiscordClient;
require "film.php";
require __DIR__.'/vendor/autoload.php';


//=================config de ligação ao discord =============================
$clientID = '';
$clientSecret = '';
$token='';
$discordBot = new DiscordClient($clientID, $clientSecret, $token);
$loop = Factory::create();
$discordBot->setLoopInterface($loop);


//============================funcoes do discord================================================
$discordBot->on('event.MESSAGE_CREATE', function( DiscordClient $discordBot, int $shard, String $event, Array $data) {
  

  if(strtolower($data['content']) == '!horror') {
    $film1 = new film("Hereditary","A grieving family is haunted by tragic and disturbing occurrences.",
    "horror","Ari Aster");
  $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $film1->__toString() . "\r\n" . 'Have a spooky one');
	}
	
if(strtolower($data['content']) == '!drama') {
  $film2 = new film("HackSaw Ridge","World War II American Army Medic Desmond T. Doss, who served during the Battle of Okinawa, refuses to kill people, and becomes the first man in American history to receive the Medal of Honor without firing a shot.",
  "drama","Mel Gibson");
  $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $film2->__toString() . "\r\n" . ' stop crying');
	}
	
 if(strtolower($data['content']) == '!action') {
  $film3 = new film("Bad Boys","Two hip detectives protect a witness to a murder while investigating a case of stolen heroin from the evidence storage room from their police precinct.",
  "action","Michael Bay");
  $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $film3->__toString() . "\r\n" . 'pew pew');
	}
	
 if(strtolower($data['content']) == '!thriller') {
  $film4 = new film("Nightcrawler","When Louis Bloom, a con man desperate for work, muscles into the world of L.A. crime journalism, he blurs the line between observer and participant to become the star of his own story",
  "Thriller","Dan Gilroy");
  $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $film4->__toString() . "\r\n" . 'hmmmmm interesting and misterious hun');
    }

    if(strtolower($data['content']) == '!comedy') {
      $film5 = new film("Death at a funeral","Chaos ensues when a man tries to expose a dark secret regarding a recently deceased patriarch of a dysfunctional British family.",
      "comedy","Frank Oz");
      $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $film5->__toString() . "\r\n" . 'haha very funny');
        }
});

$discordBot->connect();
$loop->run();



