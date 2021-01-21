<?php

use React\EventLoop\Factory;
use shanemcc\discord\DiscordClient;
require "film.php";
require __DIR__.'/vendor/autoload.php';
require_once "bot.php";
const noticia = "http://www.sensesofcinema.com/";

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
     $film2 = new film("Midsommar","A couple travels to Eastern Europe to visit a rural hometown's fabled Swedish mid-summer festival. What begins as an idyllic retreat quickly devolves into an increasingly violent and bizarre competition at the hands of a pagan cult.",
     "horror","Ari Aster");
     $film3 = new film("Exorcist","When a 12-year-old girl is possessed by a mysterious entity, her mother seeks the help of two priests to save her.",
     "horror","William Friedkin");
     $film4 = new film("Halloween","Fifteen years after murdering his sister on Halloween night 1963, Michael Myers escapes from a mental hospital and returns to the small town of Haddonfield, Illinois to kill again.",
     "horror","John Carpenter");
    
    $horrorFilms= array($film1,$film2,$film3,$film4);
    $response= array_rand($horrorFilms);
    $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $horrorFilms[$response]->__toString() . "\r\n" . ' Have a spooky one!');
	}
	
if(strtolower($data['content']) == '!drama') {
  $film5 = new film("Another Round","Four friends, all high school teachers, test a theory that they will improve their lives by maintaining a constant level of alcohol in their blood.",
  "drama","Thomas Vinterberg");
  $film6 = new film("HackSaw Ridge","World War II American Army Medic Desmond T. Doss, who served during the Battle of Okinawa, refuses to kill people, and becomes the first man in American history to receive the Medal of Honor without firing a shot.",
  "drama","Mel Gibson");
  $film7 = new film("Never Rarely Sometimes Always","A pair of teenage girls in rural Pennsylvania travel to New York City to seek out medical help after an unintended pregnancy.",
  "drama","Eliza Hittman");
  $film8 = new film("Good Will Hunting","Will Hunting, a janitor at M.I.T., has a gift for mathematics, but needs help from a psychologist to find direction in his life.",
  "drama","Gus Van Sant");
  $dramaFilms= array($film5,$film6,$film7,$film8);
  $response2= array_rand($dramaFilms);
  $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $dramaFilms[$response2]->__toString() . "\r\n" . ' BO HOO stop crying!');
	}
	
if(strtolower($data['content']) == '!action') {
  $film9 = new film("Bad Boys","Two hip detectives protect a witness to a murder while investigating a case of stolen heroin from the evidence storage room from their police precinct.",
   "action","Michael Bay");
   $film10 = new film("American Ultra","A stoner - who is in fact a government agent - is marked as a liability and targeted for extermination. But he's too well-trained and too high for them to handle.",
   "action","Nima Nourizadeh");
   $film11 = new film("Tenet","Armed with only one word, Tenet, and fighting for the survival of the entire world, a Protagonist journeys through a twilight world of international espionage on a mission that will unfold in something beyond real time.",
   "action","Christopher Nolan");
   $film12 = new film("The Matrix","When a beautiful stranger leads computer hacker Neo to a forbidding underworld, he discovers the shocking truth--the life he knows is the elaborate deception of an evil cyber-intelligence.",
   "action","Lana Wachowski and Lilly Wachowski ");
   $actionFilms= array($film9,$film10,$film11,$film12);
   $response3= array_rand($actionFilms);
   $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $actionFilms[$response3]->__toString() . "\r\n" . 'pew pew');
 	}
	
if(strtolower($data['content']) == '!thriller') {
  $film13 = new film("Nightcrawler","When Louis Bloom, a con man desperate for work, muscles into the world of L.A. crime journalism, he blurs the line between observer and participant to become the star of his own story",
  "Thriller","Dan Gilroy");
  $film14 = new film("Parasite","Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.",
  "Thriller","Bong Joon Ho");
  $film15 = new film("Fight Club","An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much, much more.",
  "Thriller","David Fincher");
  $film16 = new film("The Devil All the Time","Sinister characters converge around a young man devoted to protecting those he loves in a postwar backwoods town teeming with corruption and brutality.",
  "Thriller","Antonio Campos");
  $thrillerFilms= array($film13,$film14,$film15,$film16);
   $response4= array_rand($thrillerFilms);
  $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $thrillerFilms[$response4]->__toString() . "\r\n" . 'hmmmmm interesting and misterious hun');
    }

if(strtolower($data['content']) == '!comedy') {
  $film17 = new film("Death at a funeral","Chaos ensues when a man tries to expose a dark secret regarding a recently deceased patriarch of a dysfunctional British family.",
  "comedy","Frank Oz");
  $film18 = new film("Scott Pilgrim vs. the World ","In a magically realistic version of Toronto, a young man must defeat his new girlfriend's seven evil exes one by one in order to win her heart.",
  "comedy","Edgar Wright");
  $film19 = new film("21 Jump Street","A pair of underachieving cops are sent back to a local high school to blend in and bring down a synthetic drug ring.",
  "comedy","Phil Lord and Christopher Miller");
  $film20 = new film("Ted","John Bennett, a man whose childhood wish of bringing his teddy bear to life came true, now must decide between keeping the relationship with the bear, Ted or his girlfriend, Lori.",
  "comedy","Seth MacFarlane");
  $comedyFilms= array($film17,$film18,$film19,$film20);
  $response5= array_rand($comedyFilms);
  $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $comedyFilms[$response5]->__toString() . "\r\n" . 'haha very funny');
        }
if(strtolower($data['content']) == '!noticias') {
  $bot = new bot ();
  $bot->devolverHtml(noticia);
  $discordBot->sendChannelMessage($data['guild_id'], $data['channel_id'], $bot->receberTags() . "\r\n" . 'Latest news');
         }	
});

$discordBot->connect();
$loop->run();



