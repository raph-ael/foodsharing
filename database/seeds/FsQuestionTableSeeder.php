<?php

use Illuminate\Database\Seeder;

class FsQuestionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_question')->delete();
        
        \DB::table('fs_question')->insert(array (
            0 => 
            array (
                'id' => 1,
                'text' => 'Du möchtest Dich bei einem erst kürzlich eingetragenem Betrieb zum Abholen eintragen und entdeckst, dass die Abholzeiten zwar angegeben sind, sich aber niemand eingetragen hat. Auf der Pinnwand des Betriebes steht, dass die Abholungen erst mal über facebook geregelt werden und keine weiteren Foodsaver benötigt werden. Wie reagierst Du?',
                'duration' => 120,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Verhaltensregeln',
            ),
            1 => 
            array (
                'id' => 2,
                'text' => '27 Stunden vor einer geplanten und bestätigten Abholung bei einem Betrieb, wo noch 2 andere Foodsaver gleichzeitig abholen, wird Dir ganz übel und Du spürst, dass Du unmöglich am nächsten Abend raus kannst um Essen abzuholen, wie reagierst Du?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Aufgaben_eines_Foodsavers',
            ),
            2 => 
            array (
                'id' => 3,
                'text' => 'Du bist mit einem anderen Foodsaver zum Abholen bei einem Betrieb, bei dem Du schon mehrfach abgeholt hast, um Punkt 14 Uhr verabredet. Mit dem Betrieb ist vereinbart, dass die Abholung zwischen 14 und 15 Uhr stattfindet. Jetzt ist es 14.15 und der Foodsaver ist immer noch nicht da, wie reagierst Du?',
                'duration' => 120,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Aufgaben_eines_Foodsavers',
            ),
            3 => 
            array (
                'id' => 5,
                'text' => 'Rechtsvereinbarung: Ich werde bei Lebensmittelspenderbetrieben Lebensmittel abholen und diese…?',
                'duration' => 80,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Rechtsvereinbarung',
            ),
            4 => 
            array (
                'id' => 6,
                'text' => 'In welcher Situation ist es erlaubt, für die Abgabe von geretteten Waren Geld oder etwas im Tausch zu verlangen?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Umgang_mit_Geld_bei_lebensmittelretten.de',
            ),
            5 => 
            array (
                'id' => 7,
                'text' => 'Welche Punkte sollten bei den Abholungen im Allgemeinen beachtet werden?
',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege#Kooperationspflege',
            ),
            6 => 
            array (
                'id' => 8,
                'text' => 'Du bekommst auf Deinen Forenbeitrag eine scharf formulierte Antwort, die Dich persönlich angreift oder nicht Deiner Meinung entspricht. Wie verhältst Du Dich?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Verhaltensregeln#Verhaltensregeln_Online',
            ),
            7 => 
            array (
                'id' => 9,
                'text' => 'Wozu erklärst Du Dich bereit, wenn Du als Foodsaver bei einem Kooperationspartner Lebensmittel abholst?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Aufgaben_eines_Foodsavers',
            ),
            8 => 
            array (
                'id' => 10,
                'text' => 'Seit Wochen holst Du immer montags nach Feierabend die Backwaren bei einem Betrieb ab und es gab auch immer ganze Laibbrote. Wie reagierst Du wenn eine Mitarbeiterin Dir nur einen kleinen Sack mit Brötchen gibt?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Verhaltensregeln#Verhaltensregeln_Offline',
            ),
            9 => 
            array (
                'id' => 11,
                'text' => 'Bei einem Betrieb, wo Du in der Regel alleine abholst und es durchschnittlich nur 10-20 kg Lebensmittel abzuholen gibt, welche Du immer leicht in Deinem Rucksack verstauen kannst, bekommst Du auf einmal etwa 50 kg Lebensmittel - vermutlich aufgrund eines Feiertages davor. Du schaffst es unmöglich, auf einmal alles mitzunehmen, wie reagierst Du?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Aufgaben_eines_Foodsavers',
            ),
            10 => 
            array (
                'id' => 12,
                'text' => 'Bei einem Betrieb, wo Du schon öfter abgeholt hast, steht neben dem Einkaufswagen mit den Abschriften eine volle Kiste mit Kaffeepackungen, die aber noch nicht abgelaufen ist, wie reagierst Du?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege#Kooperationspflege http://wiki.lebensmittelretten.de/Verhaltensregeln',
            ),
            11 => 
            array (
                'id' => 13,
                'text' => 'Du möchtest in den Urlaub fahren, hast Dich aber zuvor für ein oder mehrere Abholungen während dieses Zeitraums eingetragen. Wie gehst Du vor?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Aufgaben_eines_Foodsavers',
            ),
            12 => 
            array (
                'id' => 14,
                'text' => 'Wie verhältst Du Dich, wenn Du Dich in das Team eines von Dir nahegelegenen Supermarktes über den Button “Ich möchte bei diesem Betrieb abholen”  eingetragen hast und Du auch nach mehreren Tagen immer noch nicht angenommen wurdest?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Aufgaben_eines_Foodsavers',
            ),
            13 => 
            array (
                'id' => 15,
                'text' => 'Wie wird foodsharing derzeit finanziert?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Umgang_mit_Geld_bei_lebensmittelretten.de',
            ),
            14 => 
            array (
                'id' => 16,
                'text' => 'Was muss ich laut Rechtsvereinbarung machen, wenn ich zu einem Abholtermin nicht erscheinen kann und dies mehr als 24 Stunden vor dem Abholtermin weiß?
',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Rechtsvereinbarung',
            ),
            15 => 
            array (
                'id' => 17,
                'text' => 'Nachdem Du bei einer Supermarktkette gekühlte Produkte gerettet hast und mit den Waren danach direkt zu Dir nach Hause gefahren bist, triffst Du einen Nachbarn im Treppenhaus, dem Du eine Packung vom geretteten Lachs, der vor einem Tag das Verbrauchsdatum überschritten hat, schenkst. 2 Tage später leidet der Nachbar unter üblen Bauchkrämpfen - wer trägt die rechtliche Verantwortung?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Rechtsvereinbarung',
            ),
            16 => 
            array (
                'id' => 19,
                'text' => 'Wer hat foodsharing e.V. gegründet?',
                'duration' => 30,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Geschichte_von_lebensmittelretten_und_foodsharing',
            ),
            17 => 
            array (
                'id' => 20,
                'text' => 'Wann fiel der Startschuss für die Plattform foodsharing.de?',
                'duration' => 30,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Geschichte_von_lebensmittelretten_und_foodsharing',
            ),
            18 => 
            array (
                'id' => 21,
                'text' => 'Bei welchen Dreharbeiten entstand die Idee von foodsharing?
',
                'duration' => 50,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Geschichte_von_lebensmittelretten_und_foodsharing',
            ),
            19 => 
            array (
                'id' => 22,
                'text' => 'Wie wurde der Start vom Verein foodsharing e.V. finanziert?
',
                'duration' => 30,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Geschichte_von_lebensmittelretten_und_foodsharing',
            ),
            20 => 
            array (
                'id' => 24,
                'text' => 'Wie wird foodsharing aktuell finanziert? ',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Umgang_mit_Geld_bei_lebensmittelretten.de',
            ),
            21 => 
            array (
                'id' => 25,
                'text' => 'Welche Daten der neuen Foodsaver müssen vor oder während der Übergabe des foodsharing Ausweises überprüft werden bzw. nach der darauffolgenden Verifizierung ?',
                'duration' => 50,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver',
            ),
            22 => 
            array (
                'id' => 26,
                'text' => 'Was geschieht, nachdem ein Foodsharer das Foodsaver Quiz erfolgreich absolviert hat und Dir in der Glocke als "Neuer Foodsaver" angezeigt wird?
',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver',
            ),
            23 => 
            array (
                'id' => 27,
                'text' => 'Was muss der Foodsaver machen, bevor er seinen Ausweis bekommt? 
',
                'duration' => 40,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver',
            ),
            24 => 
            array (
                'id' => 28,
                'text' => 'Mit wem sollen neu angemeldete Foodsaver ihre 3 Einführungsabholungen machen? 
',
                'duration' => 50,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver',
            ),
            25 => 
            array (
                'id' => 29,
                'text' => 'Beim Erstkontakt zeigt die Geschäftsleitung keine Bereitschaft zu kooperieren. Wie reagierst du? 
',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Wie_umgehen_mit_Betrieben,_die_nicht_kooperieren_wollen',
            ),
            26 => 
            array (
                'id' => 30,
                'text' => 'Eine Kooperation ist in Gefahr, wie reagierst Du? 
',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            27 => 
            array (
                'id' => 31,
                'text' => 'Du hast erfolgreich viele Kooperationen aufgebaut und willst jetzt einige abgeben. Was ist zu beachten? 
',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Betriebsverantwortliche',
            ),
            28 => 
            array (
                'id' => 32,
                'text' => 'Welches sind die Vorteile für den Lebensmittelspendebetrieb bei einer Kooperation mit foodsharing?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Vorteil_f%C3%BCr_den_Lebensmittelspenderbetrieb',
            ),
            29 => 
            array (
                'id' => 33,
                'text' => 'Im Team kracht es gerade so richtig und Du weißt nicht mehr weiter. Was kannst Du tun? ',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            30 => 
            array (
                'id' => 34,
                'text' => 'Schon seit vielen Monaten holst Du als BetriebsverantwortlicheR mit einem gutem Team Obst & Gemüse bei einem Supermarkt ab, aber Trockenwaren, Kosmetika und gekühlte Waren sind nie dabei. Was machst Du?
',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Betriebsverantwortliche',
            ),
            31 => 
            array (
                'id' => 35,
                'text' => 'In Deinem Team gibt es einen Foodsaver, der sich über einen langen Zeitraum jeden Tag zur Abholung einträgt. Auf Nachfrage sagt die Person, dass die Abholung zur Deckung des Eigenbedarfs dient. Wie verhältst Du Dich?
',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Betriebsverantwortliche',
            ),
            32 => 
            array (
                'id' => 36,
                'text' => 'Du bist BetriebsverantwortlicheR und siehst, dass eine Abholung 24 Stunden vorher im Kalender nicht besetzt ist.
Wie kannst Du Dich verhalten?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Betriebsverantwortliche http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            33 => 
            array (
                'id' => 37,
                'text' => 'Stell Dir vor, dass Du zwei Nachrichten von Foodsavern bekommst, in denen diese sich übereinander beschweren. Was tust du?
',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            34 => 
            array (
                'id' => 38,
                'text' => 'Welche Punkte gibt es bei der Kommunikation zwischen dem Team und dem/der Betriebsverantwortlichen zu beachten? 
',
                'duration' => 90,
                'wikilink' => 'wiki.lebensmittelretten.de/Betriebsverantwortliche http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            35 => 
            array (
                'id' => 39,
                'text' => 'Du bist mit einem anderen Foodsaver zum Abholen bei einem großen Betrieb verabredet, der um 19:00 Uhr schließt und die Abholung für diesen Zeitpunkt vereinbart ist. Der Foodsaver ist aber noch nicht da. Wie reagierst Du?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Aufgaben_eines_Foodsavers',
            ),
            36 => 
            array (
                'id' => 41,
                'text' => 'Was muss der Foodsaver machen, bevor er seinen Ausweis bekommt?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Werdegang_eines_Foodsavers',
            ),
            37 => 
            array (
                'id' => 43,
                'text' => 'Welche Ziele verfolgen wir bei einer Kooperation mit einem Betrieb, bei dem wir Lebensmittel retten?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            38 => 
            array (
                'id' => 45,
                'text' => 'Deine Region/Bezirk ist neu dabei, noch machen erst wenige Betriebe mit und es gibt erst 13 Foodsaver in Deiner Gegend. Du sprichst neue Bäckereien, Reformhäuser und auch Gemüseläden an, um sie zum Mitmachen zu gewinnen. Heute hast Du schon 3 neue Läden überzeugen können mitzumachen, Du bist animiert - wie würdest Du weitermachen?',
                'duration' => 70,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            39 => 
            array (
                'id' => 46,
                'text' => 'Nun bist Du in einem Bezirk/Region registriert, in dem es noch keine oder kaum erkennbare Aktivitäten gibt, jedoch gibt es schon eineN BotschafterIn. Wie gehst Du damit um?',
                'duration' => 70,
                'wikilink' => 'http://wiki.lebensmittelretten.de/BotschafterIn#Zentrale_Aufgaben',
            ),
            40 => 
            array (
                'id' => 47,
                'text' => 'Stell Dir vor, dass Du zwei kritisierende Nachrichten von Foodsavern aus deinem Betriebs-Team bekommst. Was tust du?',
                'duration' => 40,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            41 => 
            array (
                'id' => 48,
                'text' => 'Wie verläuft die Terminabsprache für die 3 Einführungsabholungen?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver',
            ),
            42 => 
            array (
                'id' => 49,
                'text' => 'Warum kann es Sinn machen, den Foodsaver vor seinen 3 Einführungsabholungen in das Team von einem Betrieb aufzunehmen? ',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Einf%C3%BChrungsabholungen',
            ),
            43 => 
            array (
                'id' => 50,
                'text' => 'Stell Dir vor, Du bist in einem kleinen Geschäft in einer Stadt/einem Bezirk, in der Du nicht regelmäßig abholen könntest. Eine MitarbeiterIn nimmt Gemüse aus dem Regal, welches nicht mehr so ganz frisch aussieht. Wie reagierst Du?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            44 => 
            array (
                'id' => 51,
                'text' => 'Wie sollte eine Einführungsabholung vor Ort bei einem Betrieb ablaufen?',
                'duration' => 70,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Einf%C3%BChrungsabholungen',
            ),
            45 => 
            array (
                'id' => 52,
                'text' => 'Es ist schon Abend als Du bemerkst, dass Du einen Abholtermin bei einem Betrieb, bei dem Du schon öfter abgeholt hast, total verschlafen hast. Es war auch niemand anderes zum Abholen eingetragen, wie reagierst Du?',
                'duration' => 80,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Regelverst.C3.B6.C3.9Fe',
            ),
            46 => 
            array (
                'id' => 53,
            'text' => 'Was machst Du, wenn Du bei einem neuen Foodsaver der sich in Deiner Region nach dem erfolgreichen absolvieren des Foodsaver Quiz in Deinem Bezirk angemeldet hat, Daten (Name, Adresse, Geburtsdatum) eindeutig falsch sind bzw. es sich evtl. um eine Scherz-Anmeldung handelt?',
                'duration' => 80,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver',
            ),
            47 => 
            array (
                'id' => 54,
                'text' => 'Ein Foodsaver möchte als BotschafterIn in Deiner Stadt/Deinem Bezirk aktiv werden und dort für einen Bereich zuständig sein. Du kennst die Person persönlich, was müsste der/die BotschaftsanwärterIn jetzt am besten tun?',
                'duration' => 120,
                'wikilink' => 'http://wiki.lebensmittelretten.de/BotschafterIn',
            ),
            48 => 
            array (
                'id' => 55,
                'text' => 'Was gehört zu den Aufgaben der BotschafterInnen?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/BotschafterIn',
            ),
            49 => 
            array (
                'id' => 56,
            'text' => 'Warum ist es wichtig, eine gewisse Kontinuität (längere Auslandsaufenthalte oder Umzug frühzeitig zu kommunizieren) als BotschafterIn an den Tag zu legen?
',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/BotschafterIn',
            ),
            50 => 
            array (
                'id' => 57,
                'text' => 'Welche Konsequenzen hat es, wenn Du eine Kooperation auf die Beine stellst?',
                'duration' => 60,
                'wikilink' => 'wiki.lebensmittelretten.de/Betriebsverantwortliche',
            ),
            51 => 
            array (
                'id' => 58,
                'text' => 'Was musst Du unbedingt erledigt haben, bevor Du einen Betrieb ansprichst?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            52 => 
            array (
                'id' => 59,
                'text' => 'Warum musst Du unbedingt vor der ersten Kontaktaufnahme mit einem Betrieb diesen auf der foodsharing Plattform anlegen?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            53 => 
            array (
                'id' => 60,
                'text' => 'Wessen Aufgabe ist es Verhaltensregel-Verstöße, wie Nichterscheinen, Unpünktlichkeit, unsoziales Verhalten, etc. zu melden?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#Regelverst.C3.B6.C3.9Fe',
            ),
            54 => 
            array (
                'id' => 61,
                'text' => 'Was sollte man zu einem Erstgespräch mit der Markt- oder Filialleitung eines Betriebes mitnehmen? ',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            55 => 
            array (
                'id' => 62,
                'text' => 'Bei welchen Betrieben oder Filialen kann ich im Bezug auf eine Kooperation mit foodsharing nachfragen?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            56 => 
            array (
                'id' => 63,
                'text' => 'Warum soll ich keine Betriebe mit mehr als 3 Filialen ansprechen?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            57 => 
            array (
                'id' => 64,
                'text' => 'Welche Betriebe spreche ich am besten an, wenn ich noch alleine in einer Region bin?',
                'duration' => 60,
                'wikilink' => 'wiki.lebensmittelretten.de/Betriebsverantwortliche',
            ),
            58 => 
            array (
                'id' => 65,
                'text' => 'Welche Arten der Kontaktaufnahme zu möglichen Kooperationsbetrieben sind sinnvoll?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            59 => 
            array (
                'id' => 66,
                'text' => 'Wann hat es Sinn anderen Foodsavern eine Vertrauensbanane zu schenken?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Vertrauensbanane',
            ),
            60 => 
            array (
                'id' => 67,
                'text' => 'Was mache ich, wenn mir die Geschäftsleitung sagt, dass bereits mit einer anderen Organisation kooperiert wird und diese alle Lebensmittel abholen?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            61 => 
            array (
                'id' => 69,
                'text' => 'Was machst Du, wenn der Filialleiter nicht mit Dir persönlich sprechen will, sondern Dir lediglich seine Visitenkarte in die Hand drückt und um Informationen per Mail bittet? ',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            62 => 
            array (
                'id' => 70,
                'text' => 'Was ist der Sinn von regelmäßigen oder unregelmäßigen Treffen der Foodsaver? ',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/BotschafterIn#Zentrale_Aufgaben',
            ),
            63 => 
            array (
                'id' => 71,
                'text' => 'Warum ist es wichtig, dass Du bei Gesprächen mit eventuellen Kooperationsbetrieben Deinen Foodsaver-Ausweis mit dabei hast?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            64 => 
            array (
                'id' => 72,
                'text' => 'Laut Rechtsvereinbarung handeln wir ehrenamtlich, aus sozialen, ethischen und ökologischen Gründen. Was sind unsere Ziele?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Hintergrund_und_Mission_von_lebensmittelretten.de',
            ),
            65 => 
            array (
                'id' => 73,
                'text' => 'Die Geschäftsleitung erzählt Dir, dass bereits mit einer anderen Organisation kooperiert wird, bittet Dich aber darum, eine Deiner Visitenkarten für Notfälle bei ihm zu hinterlegen. Was machst Du?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            66 => 
            array (
                'id' => 74,
                'text' => 'Welche Lebensmittel und zu welchen Zeiten können wir im Gegensatz zu vielen anderen Organisationen, Einrichtungen und Vereinen abholen?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Vorteil_f%C3%BCr_den_Lebensmittelspenderbetrieb',
            ),
            67 => 
            array (
                'id' => 75,
                'text' => 'Wozu verpflichtest Du Dich in der Rechtsvereinbarung in Bezug auf Mülltrennung und Sauberkeit bei Abholungen?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Rechtsvereinbarung',
            ),
            68 => 
            array (
                'id' => 76,
                'text' => 'Welche Vorteile hat ein Betrieb, der mit uns kooperiert?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Vorteil_f%C3%BCr_den_Lebensmittelspenderbetrieb',
            ),
            69 => 
            array (
                'id' => 77,
                'text' => 'Wovon werden in der Rechtsvereinbarung, die alle Foodsaver akzeptieren müssen, alle Lebensmittelspendebetriebe, Vereine, Bauernhöfe etc., die Essen abgeben, entbunden?',
                'duration' => 80,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Rechtsvereinbarung',
            ),
            70 => 
            array (
                'id' => 78,
                'text' => 'Wie kann ein Betrieb durch eine Kooperation mit uns Geld einsparen?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Vorteil_f%C3%BCr_den_Lebensmittelspenderbetrieb',
            ),
            71 => 
            array (
                'id' => 79,
                'text' => 'Was wird als oberstes Ziel in der Rechtsvereinbarung genannt?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Rechtsvereinbarung',
            ),
            72 => 
            array (
                'id' => 80,
                'text' => 'Nach wem richten wir uns, wenn es bei einem Kooperationsaufbau um Abholzeiten und Abholrhythmus geht?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            73 => 
            array (
                'id' => 81,
                'text' => 'Was ist ideal bei Abholtagen und Abholrhythmus?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            74 => 
            array (
                'id' => 82,
                'text' => 'Zu was erkläre ich mich bereit, wenn ich als Foodsaver bei einem Kooperationspartner Lebensmittel abhole?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver ',
            ),
            75 => 
            array (
                'id' => 83,
                'text' => 'Was musst Du nach der persönlichen Kontaktaufnahme zu einem möglichen Kooperationspartner machen?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            76 => 
            array (
                'id' => 84,
                'text' => 'Als BetriebsverantwortlicheR habe ich folgende Verantwortungen:',
                'duration' => 60,
                'wikilink' => 'wiki.lebensmittelretten.de/Betriebsverantwortliche',
            ),
            77 => 
            array (
                'id' => 85,
                'text' => 'Beim Anmelden als Foodsaver hast Du die Rechtsvereinbarung und Verhaltensregeln akzeptiert. Verpflichtest Du Dich damit zu etwas?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Rechtsvereinbarung',
            ),
            78 => 
            array (
                'id' => 86,
                'text' => 'Welche Punkte gibt es bei der Kommunikation mit den Betrieben zu beachten?',
                'duration' => 60,
                'wikilink' => 'wiki.lebensmittelretten.de/Betriebsverantwortliche',
            ),
            79 => 
            array (
                'id' => 87,
                'text' => 'Welche Ziele verfolgen wir bei einer Kooperation?',
                'duration' => 60,
                'wikilink' => 'wiki.lebensmittelretten.de/Betriebsverantwortliche',
            ),
            80 => 
            array (
                'id' => 88,
                'text' => 'Wenn ich die Rechtsvereinbarung akzeptiere, verzichte ich gegenüber foodsharing und den Lebensmittelspendebetrieben …?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Rechtsvereinbarung',
            ),
            81 => 
            array (
                'id' => 89,
                'text' => 'Während einer Abholung bei einem Supermarkt sehe ich noch im Regal liegende Waren die gestern abgelaufen sind, wie reagierst Du?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            82 => 
            array (
                'id' => 90,
                'text' => 'Wie ist ein Team im Idealfall für einen Betrieb aufgestellt?',
                'duration' => 60,
                'wikilink' => 'wiki.lebensmittelretten.de/Betriebsverantwortliche',
            ),
            83 => 
            array (
                'id' => 91,
                'text' => 'Welche Punkte sollten bei jeder Abholung beachtet werden?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            84 => 
            array (
                'id' => 92,
                'text' => 'Wie reagierst Du, wenn Du von einem InhaberIngeführten Betrieb beim ersten Gespräch mit dem/der Verantwortlichen hörst, dass es sich nicht lohnt, weil es ohnehin nur unregelmäßig abgeschriebene Waren gibt und wenn, dann sind es meist auch nur 5-10kg?',
                'duration' => 120,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Vorteil_f%C3%BCr_den_Lebensmittelspenderbetrieb',
            ),
            85 => 
            array (
                'id' => 93,
                'text' => 'Welche Punkte musst Du beachten, wenn Du Dich bei einem Betrieb zur Abholung eingetragen hast?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver#3._Praxisteil',
            ),
            86 => 
            array (
                'id' => 94,
                'text' => 'In meinem Bezirk/Region gibt es noch keineN BotschafterIn oder die bestehende BotschafterIn meldet sich schon länger nicht mehr. Was wäre sinnvoll?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Vorlage_eMail_neue_Foodsaver_ohne_Region',
            ),
            87 => 
            array (
                'id' => 95,
                'text' => 'Warum sollten Foodsaver sich möglichst bei Betrieben eintragen, zu denen sie einen kurzen Anfahrtsweg haben?',
                'duration' => 70,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Rechtsvereinbarung',
            ),
            88 => 
            array (
                'id' => 96,
            'text' => 'Wie gehst Du mit Lebensmitteln um, deren Mindesthaltbarkeitsdatum (MHD) überschritten ist und was sagt dieses Datum genau aus?
Gekennzeichnet ist das Mindesthaltbarkeitsdatum auf den Lebensmittelpackungen folgendermaßen: „Mindestens haltbar bis: Datum und ggf. einer Lagertemperaturangabe.“ ',
                'duration' => 120,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Fair-Teiler_Regeln_und_Voraussetzungen',
            ),
            89 => 
            array (
                'id' => 98,
                'text' => 'Was macht der/die BotschafterIn oder die geeignete Vertrauensperson nach der Durchführung der einzelnen Einführungsabholungen?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/BotschafterIn',
            ),
            90 => 
            array (
                'id' => 99,
                'text' => 'Wie kommt der Foodsaver nach seinen drei Einführungsabholungen an seinen Ausweis?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver',
            ),
            91 => 
            array (
                'id' => 101,
                'text' => 'Wie reagierst Du als Foodsaver in folgender Situation: Du bist in einem kleinen Geschäft, von dem Du nicht weißt, ob es bereits bei foodsharing mitmacht oder nicht. Das Geschäft ist in einer Stadt/einem Bezirk, in dem Du nicht regelmäßig abholen könntest und Du beobachtest eine Mitarbeiterin, wie sie Gemüse aus dem Regal nimmt, welches nicht mehr so ganz frisch aussieht.',
                'duration' => 70,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            92 => 
            array (
                'id' => 102,
                'text' => 'Du überprüfst natürlich regelmäßig die neu eingetragenen Betriebe in deiner Stadt oder deinem Bezirk. 
In einem frisch eingetragenen Betrieb von einem anderen Bezirksbotschafter steht auf der Pinnwand des Betriebes, dass die Abholungen erst mal privat (nicht über die Plattform) organisiert und keine Foodsaver benötigt werden. Wie reagierst Du?',
                'duration' => 120,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            93 => 
            array (
                'id' => 103,
                'text' => 'Wann ging die ehemalige Freiwilligen Plattform von foodsharing Lebensmittelretten.de online?',
                'duration' => 50,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Geschichte_von_lebensmittelretten_und_foodsharing',
            ),
            94 => 
            array (
                'id' => 104,
            'text' => 'Wo hat das Konzept des Lebensmittelrettens bei Betrieben, wie es heute über die Plattform foodsharing (ehemals Lebensmittelretten.de) läuft, seinen Ursprung?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Geschichte_von_lebensmittelretten_und_foodsharing',
            ),
            95 => 
            array (
                'id' => 105,
                'text' => 'Ist es wichtig, alle Verhaltensregelverstöße umgehend zu melden und sich anschließend mit der Person des Regelverstoßes in Verbindung zu setzen und sie/ihn über das Fehlverhalten zu informieren?',
                'duration' => 110,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver',
            ),
            96 => 
            array (
                'id' => 106,
                'text' => 'Was musst Du vor/bei dem Verifizieren eines Foodsavers beachten?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Foodsaver',
            ),
            97 => 
            array (
                'id' => 107,
                'text' => 'Du erfährst von einem Foodsaver am Telefon, dass ein anderer Foodsaver in deinem Bezirk gerade auf dem Weg zu einer großen Supermarkt-Kette ist, um dort nach Lebensmitteln und einer Kooperation zu fragen, was tust du?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
            ),
            98 => 
            array (
                'id' => 108,
                'text' => 'Was tust Du, wenn Du überraschenderweise für mehrere Wochen oder länger Deine BotschafterInnen-Funktion nicht ausüben kannst?',
                'duration' => 70,
                'wikilink' => 'http://wiki.lebensmittelretten.de/BotschafterIn',
            ),
            99 => 
            array (
                'id' => 109,
                'text' => 'Welche Vorteile habe ich als BotschafterIn von meiner ehrenamtlichen Arbeit für foodsharing?',
                'duration' => 80,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Umgang_mit_Geld_bei_lebensmittelretten.de',
            ),
            100 => 
            array (
                'id' => 110,
                'text' => 'Wo genau lag der Unterschied vor der Fusion im Dezember 2014 der beiden Plattformen ”foodsharing.de” und ”Lebensmittelretten.de”?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Geschichte_von_foodsharing',
            ),
            101 => 
            array (
                'id' => 111,
                'text' => 'Wie gehst Du mit hygienisch riskanten Lebensmitteln um, also z.B. roher Fisch, rohe Eierspeisen, Geflügel, Hackfleisch und anderes Fleisch sowie zubereitete Lebensmittel, die Fleisch oder Fisch enthalten, die Du bei einem Betrieb oder einem Restaurant abgeholt hast?',
                'duration' => 90,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Fair-Teiler_Regeln_und_Voraussetzungen',
            ),
            102 => 
            array (
                'id' => 112,
                'text' => 'Was sagt das Verbrauchsdatum aus, bzw. was ist zu beachten wenn dieses auf einem Lebensmittel angegeben ist - welche Aussagen sind richtig?',
                'duration' => 80,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Glossar',
            ),
            103 => 
            array (
                'id' => 113,
                'text' => 'Beim Ansprechen einer neuen Kooperation stellt Dir die Geschäftsleitung die Frage: “Gebt ihr die Lebensmittel denn an Bedürftige weiter?” Was würdest Du antworten?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Lebensmittelretten.de_und_Bed%C3%BCrftigkeit',
            ),
            104 => 
            array (
                'id' => 114,
                'text' => 'Einer der Foodsaver holt jeden Freitag mit Dir ab. Weil es oft mehr Lebensmittel sind, als man tragen kann, kommt dieser Foodsaver diesmal mit seinem Auto. Welche Haltung wahrst Du vor der Geschäftsleitung und den Foodsavern wenn Du darauf angesprochen wirst?',
                'duration' => 60,
                'wikilink' => 'http://wiki.lebensmittelretten.de/Lebensmittelretten.de_und_Bed%C3%BCrftigkeit',
            ),
        ));
        
        
    }
}