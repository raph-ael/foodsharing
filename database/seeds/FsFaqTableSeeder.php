<?php

use Illuminate\Database\Seeder;

class FsFaqTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_faq')->delete();
        
        \DB::table('fs_faq')->insert(array (
            0 => 
            array (
                'id' => 2,
                'foodsaver_id' => 2855,
                'faq_kategorie_id' => 1,
                'name' => 'Ist es kostenlos, sich bei foodsharing.de anzumelden?',
            'answer' => 'Ja! Es gibt auch keine Sternchen oder versteckte Kosten ;-)',
        ),
        1 => 
        array (
            'id' => 3,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 1,
            'name' => 'Wie lange muss ich warten, bis ich anfangen kann, Lebensmittel zu retten?',
        'answer' => 'Zun&auml;chst musst Du das Quiz zum Foodsaver absolvieren. Anschlie&szlig;end wirst Du von einer BotschafterIn Deiner Region kontaktiert, der Du bitte mitteilst, dass Du daran interessiert bist, Lebensmittel bei den Betrieben abzuholen. Du wirst dann Terminvorschl&auml;ge f&uuml;r die ersten gemeinsamen Abholungen bekommen, die Du bitte best&auml;tigst. Die Einf&uuml;hrungsabholungen sollen Dir die M&ouml;glichkeit bieten, foodsharing praktisch kennenzulernen. Mehr zu den Einf&uuml;hrungsabholungen erf&auml;hrst Du unter http://wiki.lebensmittelretten.de/Einf%C3%BChrungsabholungen. Nach drei erfolgreichen Einf&uuml;hrungsabholungen kannst Du Deinen Foodsaver-Ausweis erhalten (sofern die Voraussetzungen hierf&uuml;r erf&uuml;llt sind, s. "Wie bekomme ich meinen Foodsaver-Ausweis?"), den Betrieben Deiner Wahl als AbholerIn beitreten und Dich dort in die Schichtpl&auml;ne eintragen.

Weitere Infos zum Quiz gibt\'s unter http://wiki.lebensmittelretten.de/Quiz',
        ),
        2 => 
        array (
            'id' => 5,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 4,
            'name' => 'Wie bekomme ich meinen Foodsaver Ausweis?',
        'answer' => 'Nach drei erfolgreichen Einf&uuml;hrungsabholungen kannst Du Deinen Foodsaver Ausweis von Deiner BotschafterIn erhalten. Die Einf&uuml;hrungsabholungen sollen Dir die M&ouml;glichkeit bieten, foodsharing praktisch kennenzulernen. Au&szlig;erdem wird geschaut, ob Du die Mission, den Grundgedanken, die Verhaltensregeln und die Rechtsvereinbarung verstanden und verinnerlicht hat. Siehe auch http://wiki.lebensmittelretten.de/Einf%C3%BChrungsabholungen.Voraussetzung ist au&szlig;erdem, dass Du alle Daten komplett und wahrheitsgetreu ausgef&uuml;llt sowie Dein Foto im Passfotoformat in Dein Profil geladen hast (s. "Leitfaden f&uuml;r ein repr&auml;sentatives Foto": http://wiki.lebensmittelretten.de/Leitfaden_f%C3%BCr_ein_repr%C3%A4sentatives_Foto).Sollte es noch keine BotschafterIn in Deiner Region oder Stadt geben, kannst Du Dich als BotschafterIn bewerben und die Sache des Drucks und die Koordination usw. selbst in die Hand nehmen, oder eine FreundIn von Dir daf&uuml;r begeistern, die BotschafterInnenrolle in Deiner Gegend zu &uuml;bernehmen.',
        ),
        3 => 
        array (
            'id' => 6,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 1,
            'name' => 'Ich kann mich mit meinen Zugangsdaten nicht einloggen? Wie erstelle ich ein neues Passwort?',
            'answer' => 'Um ein neues Kennwort zu erstellen, klicke auf Login und dann auf "Passwort vergessen". Falls das nicht klappt, probier\'s mit diesem Link: http://foodsharing.de/?page=login&amp;sub=passwordReset',
        ),
        4 => 
        array (
            'id' => 7,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 1,
            'name' => 'Wieso ist bei den LebensmittelretterInnen alles so streng organisiert?',
            'answer' => 'Wir machen seit Anfang 2012 Erfahrungen mit dem Lebensmittelretten bei L&auml;den, Biosuperm&auml;rkten, ProduzentInnen usw. Um den Lebensmittelspendebetrieben wie auch den Foodsavern eine reibungslose Zusammenarbeit zu erm&ouml;glichen, ist es notwendig, sich gut zu organisieren. Es ist leider zu oft vorgekommen, dass Menschen nicht p&uuml;nktllich oder &uuml;berhaupt nicht zum verabredeten Zeitpunkt erschienen sind. Die Konsequenz war oft, dass die Lebensmittel dann doch wieder in der Tonne landeten und die Betriebe unzufrieden wurden, in einigen F&auml;llen sogar die Kooperation gek&uuml;ndigt haben.Um das zu vermeiden, gibt es eine gute Organisationstruktur, die eine gewisse Zuverl&auml;ssigkeit sicher stellt. Selbstverst&auml;ndlich kann man auch mal absagen, nur eben mindestens 24h vorher, so dass die 100-prozentige Abholquote gewahrt bleibt. Wohnst Du z.B. in einer WG oder hast andere zuverl&auml;ssige Freunde, die auch mitmachen, kannst Du Dich nat&uuml;rlich auch kurzfristiger "abmelden", wenn Du jemanden hast, der*die f&uuml;r Dich einspringt. Wir w&uuml;rden uns freuen, wenn Du mitmachen m&ouml;chtest! Die gute Organisation soll in erster Linie allen Beteiligten helfen, mit Freude und Elan dabei zu sein und es auch zu bleiben.',
        ),
        5 => 
        array (
            'id' => 8,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 1,
            'name' => 'Was wurde aus lebensmittelretten.de?',
            'answer' => 'Wir haben anfangs gedacht, wir m&uuml;ssten &uuml;berhaupt keine Organisationsplattform der Freiwilligen von foodsharing einrichten. Doch dann hat der liebe Raphael aus K&ouml;ln angefangen f&uuml;r seine Region eine kleine Orgaseite einzurichten, die innerhalb von 6 Wochen zu www.lebensmittelretten.de geworden ist. Seit dem 12.12.2014 sind diese beiden Seiten verkn&uuml;pft. Es gibt jetzt nur noch foodsharing.de. Ihr k&ouml;nnt nun als Foodsharer Essensk&ouml;rbe reinstellen und, wenn ihr euch mehr engagieren m&ouml;chtet, als Foodsaver Lebensmittel von B&auml;ckereien, Superm&auml;rkten, Produzenten etc. abholen und fairteilen. Wenn Du unsere Geschichte in allen Details nachlesen m&ouml;chtest, kannst Du das&nbsp;hier tun: http://wiki.lebensmittelretten.de/Geschichte_von_foodsharing',
        ),
        6 => 
        array (
            'id' => 9,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 1,
            'name' => 'Wofür braucht Ihr meine Daten bei der Anmeldung und werden diese an Dritte weitergegeben?',
        'answer' => 'Bei der Anmeldung als Foodsaver akzeptierst Du die Rechtsvereinbarung. Diese Rechtsvereinbarung ist nur g&uuml;ltig, wenn Du sie unter Angabe von Deinem Namen und Deiner Adresse akzeptierst. Dar&uuml;ber hinaus erm&ouml;glicht die Telefonnummer eine gute Koordination: Die anderen Freiwilligen k&ouml;nnen Dich in Notf&auml;llen ("Ich kann heute spontan nicht zur Abholung kommen, weil ich krank geworden bin") viel besser erreichen. Das Profilbild schafft einen vertrauensvolleren Umgang untereinander, weil man dadurch von den anderen nicht nur einen Namen hat, sondern auch ein Bild sieht. Und es ist essentiell f&uuml;r den Ausweis. Du kannst unter Deinen Einstellungen festlegen, welche Daten f&uuml;r andere Nutzer*innen der Webseite sichtbar sein sollen - und welche nicht.',
        ),
        7 => 
        array (
            'id' => 10,
            'foodsaver_id' => 146,
            'faq_kategorie_id' => 5,
            'name' => 'Wie kann ich mich vom Foodsaver zur BotschafterIn "upgraden"?',
            'answer' => 'Wende Dich dazu bitte an welcome@lebensmittelretten.de',
        ),
        8 => 
        array (
            'id' => 11,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 7,
            'name' => 'Ich möchte gerne eine Kooperation aufbauen, Tipps zum Ansprechen von Läden bekommen, mehr über die Lebensmittelrettenden, foodsharing etc. erfahren:',
        'answer' => 'Bitte klicke auf das Fragezeichen (rechts oben neben Deinem Profilbild) und dann "Wiki" bzw. hier: http://wiki.lebensmittelretten.de/ Da steht alles ausf&uuml;hrlichst beschrieben. Das Ansprechen von Betrieben ist hier im Detail erl&auml;utert: http://wiki.lebensmittelretten.de/Checkliste_Kooperationsaufbau_und_Kooperationspflege',
        ),
        9 => 
        array (
            'id' => 12,
            'foodsaver_id' => 0,
            'faq_kategorie_id' => 4,
            'name' => 'Wie kann ich mich zur BetriebsverantwortlicheN "upgraden", um die Verantwortung für einen Betrieb zu übernehmen ?',
            'answer' => 'Das geht ganz einfach. Lies Dir zun&auml;chst die entsprechenden Wiki-Dokumente durch http://wiki.lebensmittelretten.de/Quiz#Quiz_f.C3.BCr_Betriebsverantwortliche und mache dann das Quiz. Das Quiz findest Du, wenn Du mit der Maus &uuml;ber Dein Profilbild rechts oben gehst und dann auf "Einstellungen", anschlie&szlig;end auf "Werde Betriebsverantwortlicher Foodsaver" klickst. Viel Erfolg!',
        ),
        10 => 
        array (
            'id' => 13,
            'foodsaver_id' => 4282,
            'faq_kategorie_id' => 1,
            'name' => 'Wie bekomme ich Flyer und Poster von foodsharing?',
            'answer' => 'Der "Materialienkatalog" ist eine Sammlung aller bisher angelegter Corporate Design Materialien. Diese Materialien sind zum Beispiel bereits erstellte Flyer, Poster, Banner, Aufkleber, T-Shirts, Buttons, usw. Der &ldquo;Materialienkatalog&rdquo; wird deutschlandweit und international f&uuml;r die foodsharing-Community in der Mediathek ver&ouml;ffentlicht.

&Uuml;ber den Materialienkatalog in der Mediathek hast Du die M&ouml;glichkeit, Materialien auszusuchen und sogar f&uuml;r den eigenen Druck oder die online-Nutzung direkt zu laden und zu verwenden. Bei Materialienanfragen und Bestellungen von Printmedien (Werbemittel) wende Dich bitte direkt an: bestellung@foodsharing.de. Mit einer Ausnahme, wenn Du eine grafische Modifizierung eines Materials ben&ouml;tigst, darfst Du Dich direkt an uns wenden: grafikdateien@lebensmittelretten.de 

Beim Beschaffen und Verteilen der Materialien ist es uns wichtig so Ressourcen-schonend wie m&ouml;glich zu handeln! Daher wende Dich mit Deinem Vorhaben/ Wunsch als erstes an Deine/n zust&auml;ndige/n regionale/n BotschafterIn um zu kl&auml;ren, welche Ressourcen an Werbemittel f&uuml;r Deine Aktion bereits zur Verf&uuml;gung stehen. Ebenso sollte &ldquo;Werbung&rdquo; nur an wirklich Interessierten ausgeh&auml;ndigt werden und keine z.B. willk&uuml;rliche Flyerverteilung stattfinden.',
        ),
        11 => 
        array (
            'id' => 14,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 4,
            'name' => 'Wie finde ich den/die nächsteN foodsharing BotschafterIn?',
        'answer' => 'Du kannst entweder in der Suche den Namen einer Stadt eingeben und dann erscheinen in der linken Leiste die Namen der BotschafterInnen. Oder Du kannst (nach dem Einloggen) auf die Karte gehen und dann rechts nur "Botschafter" ausw&auml;hlen und schauen, wer da bei Dir in der N&auml;he ist.',
        ),
        12 => 
        array (
            'id' => 15,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 4,
            'name' => 'Wie kann ich meinen Account löschen?',
            'answer' => 'Du f&uuml;hrst die Maus &uuml;ber Dein Profilbild und klickst dann auf "Einstellungen" -&gt; "Account l&ouml;schen".',
        ),
        13 => 
        array (
            'id' => 16,
            'foodsaver_id' => 2855,
            'faq_kategorie_id' => 4,
            'name' => 'Wozu brauche ich ein Profilbild?',
        'answer' => 'Das Profilbild wird f&uuml;r die Ausweiserstellung ben&ouml;tigt (was eine BotschafterIn in Deiner Region erledigt). Bitte beachte den "Leitfaden f&uuml;r ein repr&auml;sentatives Foto": http://wiki.lebensmittelretten.de/Leitfaden_f%C3%BCr_ein_repr%C3%A4sentatives_Foto',
        ),
    ));
        
        
    }
}