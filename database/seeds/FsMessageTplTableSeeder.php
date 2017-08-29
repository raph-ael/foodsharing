<?php

use Illuminate\Database\Seeder;

class FsMessageTplTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_message_tpl')->delete();
        
        \DB::table('fs_message_tpl')->insert(array (
            0 => 
            array (
                'id' => 1,
                'language_id' => 1,
                'name' => 'Anmeldung Freiwilliger',
                'subject' => 'Danke {NAME} für Deine Anmeldung',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>sch&ouml;n, dass Du dabei bist! Deine Anmeldung wurd nun an {BOTSCHAFTER}, den Botschafter von {BEZIRK} zur Best&auml;tigung weitergeleitet. Du bekommst eine Email mit deinen Zugangsdaten, sobald du freigeschaltest wurdest.</p>',
            ),
            1 => 
            array (
                'id' => 2,
                'language_id' => 1,
                'name' => 'Anmeldung BotschafterIn',
                'subject' => 'Danke {NAME} für Deine Anmeldung',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>sch&ouml;n, dass Du dich als BotschafterIn einbringen m&ouml;chtest, dich offenbar umfassend informiert hast und &uuml;ber das n&ouml;tige Grundwissen verf&uuml;gst, um diese wichtige Aufgabe auszuf&uuml;hren! <br />Deine Anmeldung wird zur Best&auml;tigung weitergeleitet. Im n&auml;chsten Schritt wird sich ein Mitglied des Botschafter-Begr&uuml;&szlig;ungsteams telefonisch bei dir melden. Bei Fragen wende Dich an {BOTSCHAFTER}, dem Botschafter f&uuml;r {BEZIRK}.<br /><br />Wir vom Orga-Team freuen uns auf eine wundervolle Zusammenarbeit mit dir.</p>',
            ),
            2 => 
            array (
                'id' => 3,
                'language_id' => 1,
                'name' => 'Anmeldung Foodsaver',
                'subject' => 'Danke {NAME} für Deine Anmeldung',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>sch&ouml;n, dass Du dabei bist! Deine Anmeldung wurde nun an {BOTSCHAFTER}, den Botschafter von {BEZIRK} zur Best&auml;tigung weitergeleitet. Doch bevor es weitergehen kann, logge Dich doch bitte ein und lade ein passbild&auml;hnliches Foto hoch,&nbsp;welches f&uuml;r Deinen sp&auml;teren Ausweis n&ouml;tig ist.</p>
<p></p>
<p>Schlie&szlig;lich wird Deine Anmeldung freigeschaltet.</p>
<p></p>
<p>Alles Gute</p>
<p>dein Foodsharing Team</p>',
            ),
            3 => 
            array (
                'id' => 4,
                'language_id' => 1,
                'name' => 'Anmeldung in Bezirk ohne Botschafter',
                'subject' => 'Danke für Deine Anmeldung',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>F&uuml;r die Region {BEZIRK} gibt es noch keinen Botschafter, jemand aus dem Bundeweiten Orgateam wird sich mit Dir in Verbindung setzen.</p>
<p>Beachte das es in einer Region mindestens 5 Foodsharing Freiwillige geben muss und einer von euch muss die Botschafter Rolle &uuml;bernehmen.</p>
<p></p>
<p>Alles Liebe, Dein Foodsharing-Team.</p>',
            ),
            4 => 
            array (
                'id' => 5,
                'language_id' => 1,
                'name' => 'Kein Botschafter 5 Leute zum loslegen',
                'subject' => 'Ihr braucht mehr Leute!',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>super das Du dabei bist! In Deiner Region gibt es noch keinen Botschafter. Sobald ihr mindestens 5 Leute zusammen habt und einer die Botschafter-Rolle &uuml;bernehmen will k&ouml;nnt ihr loslegen!</p>
<p>Alles Liebe, Dein Foodsharing Team</p>',
            ),
            5 => 
            array (
                'id' => 6,
                'language_id' => 1,
                'name' => 'Region wurde erstellt und los gehts',
                'subject' => '{REGION} jetzt offiziell dabei',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>{REGION} ist jetzt als Foodsaver Region angelegt!</p>
<p>Sobald ihr mindestens 5 Leute zusammen habt und einer die Botschafter-Rolle &uuml;bernimmt, kann es los gehen.</p>
<p></p>
<p>Herzliche Gr&uuml;&szlig;e, Dein Foodsharing-Team.</p>',
            ),
            6 => 
            array (
                'id' => 7,
                'language_id' => 1,
                'name' => 'User akzepiert',
                'subject' => 'Du bist jetzt dabei!',
                'body' => '<p><strong>{ANREDE} {NAME},</strong></p>
<p></p>
<p>Herzlich Willkommen auf Lebensmittelretten.de!<br /><br />Sch&ouml;n, dass es Dich gibt und du Dich entschlossen hast gemeinsam mit tausenden anderen engagierten Menschen f&uuml;r das Ende der Verschwendung von Lebensmitteln und anderen Ressourcen einzusetzen.<br /><br />Bislang gibt es schon mehr als 5500 Foodsaver und &uuml;ber 250 BotschafterInnen, und wir brauchen noch mehr Menschen die Verantwortung und Koordination &uuml;bernehmen wollen, denn viele von Euch leben in St&auml;dten, Regionen und Bundesl&auml;ndern, wo es noch keine BotschafterInnen gibt. Erst wenn es eine(n) BotschafterIn in Deiner Gegend gibt, kannst Du loslegen, denn die BotschafterInnen erstellen die Foodsaver Ausweise, koordinieren die Organisation mit den Lebensmittelspenderbetrieben und verwalten die Rechtsvereinbarungen.<br />Solltest Du von keinem/r BotschafterIn in den n&auml;chsten Tagen eine eMail bekommen bzw. akzeptiert werden, dann wende Du dich bitte an den/die Dir am n&auml;chsten wohnenden BotschafterIn. Einfach &uuml;ber "Karte" und dann "Botschafter" rechts ausw&auml;hlen und dann siehst Du wer bei Dir im Umkreis BotschafterIn ist.</p>
<p></p>
<p>Sollte sich noch niemand in Deiner Region als BotschafterIn angemeldet haben, kannst Du Dir auch &uuml;berlegen diese Aufgabe zu &uuml;bernehmen, einfach auf "Avatar (Profilbild oben rechts)" dann "Einstellungen" und dann "werde Botschafter" anklicken. Als BotschafterIn tr&auml;gst Du mehr Verantwortung, sorgst Dich um die neuen und alten Foodsaver sowie die&nbsp;Betriebe, damit auch alle zufrieden sind.&nbsp;Mehr Dazu unter "Foodsaver" und dann "Dokumente".<br /><br />Lebensmittelretten.de ist eine Initiative von dem foodsharing e.V., um die Freiwilligen, Foodsaver und BotschafterInnen von www.foodsharing.de zu organisieren, Lebensmittel von Lebensmittelbetrieben aller Art zu retten, die Internationalisierung von foodsharing voranzubringen, Veranstaltungen zum Thema zu organisieren uvm.<br /><br />Seit Februar 2012 holen die LebensmittelretterInnen, nicht mehr verkaufbare Lebensmittel von Betrieben in Berlin ab. Seit Mai 2013, ist die Teilnahme bundesweit, sowie in &Ouml;sterreich und der Schweiz m&ouml;glich und im Sp&auml;tsommer 2014 auch weltweit.<br /><br />Die Plattform Lebensmittelretten.de basiert, wie auch Deine Unterst&uuml;tzung, zu 100 Prozent auf ehrenamtlichem und unentgeltlichem Engagment. Ein bundesweites Organisationsteam von 30 Menschen, habt in monatelanger Entwicklung, das Konzept erarbeitet, verbessert und realisiert, welches die Grundlage f&uuml;r eine erfolgreiche Zusammenarbeit mit B&auml;ckereien, Superm&auml;rkten, Gem&uuml;sh&auml;nderlern usw. ist.<br /><br />Wie auch das Konzept des Lebensmittelrettens, ist auch die Plattform open source und kostenlos. Dank &uuml;ber 1000&nbsp;Stunden genialer Programmierkunst von Raphael Wintrich aus K&ouml;ln, konnte Lebensmittelretten.de ohne jeglichen finanziellen Aufwand entstehen. <br />Auch in Zukunft wollen wir gemeinsam mit anderen ehrenamtlichen ProgrammiererInnen, DesignerInnen, &Uuml;bersetzerInnen und OrganisatorInnen, die Plattform weiter entiwckeln, optimieren, ausbauen und in vielen Sprachen den Menschen in allen L&auml;ndern der Welt zur Verf&uuml;gung stellen. &nbsp;<br /><br />Dank unserem &Ouml;ko Webhoster Partner <a href="http://www.Greensta.de" target="_blank">Greensta.de</a>, der f&uuml;r die Kosten der Domain sowie den Traffic aufkommt, werden die Server von Lebensmittelretten.de zu 100 Prozent mit veganem &Ouml;kostrom, von Greenpeace Energy, mit Strom versorgt.<br /><br />Lebensmittelretten.de ist kostenlos, nicht kommerziell und ohne Werbung und wird es auch f&uuml;r immer bleiben. <br /><br />Wir freuen uns sehr, dass Du Dich auch f&uuml;r die Initiative "Ende der Lebensmittelverschwendung" engagieren m&ouml;chtest und freuen uns auf Gute Zusammenarbeit.<br /><br />Du kannst jetzt loslegen, log Dich auf <a href="http://www.lebensmittelretten.de" target="_blank">www.lebensmittelretten.de</a>&nbsp;ein:<br /><br />Dein Passwort erstellst Du unter: <strong>{LINK}</strong><br /><br />Funktionen, die ab sofort auf lebensmittelretten.de f&uuml;r Dich freigeschaltet sind und Deine n&auml;chsten Schritte:</p>
<ul>
<li>Wir bitten Dich, alle Dokumente, die unter dem Punkt "Foodsaver" abgelegt sind, aufmerksam zu lesen und zu beherzigen. Hier findest du alle relevanten Informationen &uuml;ber das Retten von Lebensmitteln.</li>
<li>Verfasse unter &bdquo;Avatar (Dein Profilbild)&ldquo; und dann "Einstellungen" eine Kurzbeschreibung zu deiner Person, die dann f&uuml;r alle anderen LebensmittelretterInnen einsehbar ist.</li>
<li>W&auml;hle bei "<a href="http://www.lebensmittelretten.de/freiwillige/?page=settings" target="_blank">Einstellungen</a>"&nbsp;aus, ob Dein Foto und/oder Dein Name &ouml;ffentlich, bzw. nur f&uuml;r die LebensmittelretterInnen in Deiner Region einsehbar sein soll.</li>
<li>Du kannst allen Botschaftern und Foodsavern in Deiner Region Nachrichten schreiben.</li>
<li>Du findest eine &Uuml;bersicht der Betriebe und FoodsaverInnen aus Deiner Region, wenn Du auf &ldquo;Karte&rdquo; im Men&uuml; klickst. Hier kannst du auch angeben, ob Du nur Betriebe anzeigen m&ouml;chtest, die noch Verst&auml;rkung f&uuml;r ihr Team brauchen. Au&szlig;erdem kannst Du mit dem/der Filialverantwortlichen Foodsaver Kontakt aufnehmen, falls Du nicht innerhalb weniger Tage ins Team kommst, wo noch Foodsaver gesucht werden.&nbsp;</li>
<li>
<p>Solltest Du selbst neue Betriebe ansprechen wollen, vergewissere Dich, dass die Betriebe nicht bereits angesprochen worden sind und wenn nicht, trage sie am gleichen Tag wo Du den ersten Kontakt gemacht hast, ins System als neuen Betrieb hinzu (unter "Bezirk", dann Deine Region und dann "Betriebe"). Wichtig ist dabei, nur <span>InhaberInnengef&uuml;hrte</span>&nbsp;L&auml;den anzusprechen, also B&auml;ckereien, Markst&auml;nde, Reformh&auml;user etc. also Betriebe die keine Ketten sind und wo Du mit dem/der CheffIn sprechen kannst. Alle Ketten (Alnatura, Denns etc. aber auch konventionelle L&auml;den wie Edeka, Aldi, Kaiser etc.) werden&nbsp;nur durch das Orgateam zentral angesprochen. Bei Fragen dazu einfach eine email an <a href="mailto:ketten@lebensmittelretten.de" target="_blank">ketten@lebensmittelretten.de</a></p>
</li>
<li>
<p>Bei kleineren Gesch&auml;ften gibt es viel mehr Zeit mit MitarbeiterInnen und FilialinhaberInnen &uuml;ber Lebensmittelverwendung &amp; - verschwendung zu sprechen und sich auszutauschen. Bspw. k&ouml;nnte man den MitarbeiterInnen ein Rezept &uuml;berreichen, wie man aus Karottengr&uuml;n ein leckeres Pesto macht; und dieses kann er / sie dann den Kunden weiterreichen.</p>
</li>
<li>Erstelle einen Blog Eintrag, &uuml;ber bisherige Erfahrungen, schon bestehende Kooperationen mit Betrieben, Ideen, Veranstaltungen, Aktivit&auml;ten usw. (dieser ist dann &ouml;ffentlich einsehbar).</li>
<li>Schau Dir die FAQs (H&auml;ufig gestellte Fragen) an. Solltest Du dar&uuml;ber hinaus Fragen haben, schreibe eine Email an: fragen@lebensmittelretten.de</li>
<li>Wir freuen uns &uuml;ber Deine Ideen, Vorschl&auml;ge und Anregungen. Bitte benutzte daf&uuml;r den Feedback Button (das gelbe lachende Gesicht am linken Bildrand). Jede(r) Kritik, Fehler, Anmerkung oder Verbesserungsvorschlag ist sehr willkommen, denn wir wollen gemeinsam mit Euch an der Weiterentwicklung der Seite arbeiten und diese noch weiter ausbauen.</li>
<li>Teile mit zuverl&auml;ssigen und vertrauensw&uuml;rdigen Freunden und Bekannten die M&ouml;glichkeit Lebensmittel zu retten und lade sie ein, sich auf w<a href="ww.lebensmittelretten.de" target="_blank">ww.lebensmittelretten.de</a> zu registrieren.</li>
</ul>
<p></p>
<p><br />Alles Liebe und viel Spa&szlig; w&uuml;nscht Dir das gesamte Team von Lebensmittelretten.de</p>',
            ),
            7 => 
            array (
                'id' => 8,
                'language_id' => 1,
                'name' => 'Anmeldung abgelehnt',
                'subject' => 'Deine Anmeldung konnte nicht angenommen werden',
                'body' => '<p>{ANREDE} {NAME},</p>
<p></p>
<p>Wenn Du wirklich aktiv mitmachen m&ouml;chtest, melde Dich noch einmal sorgf&auml;ltig an.</p>
<p></p>
<p>Alles Liebe, Dein Foodsharing Team.</p>',
            ),
            8 => 
            array (
                'id' => 9,
                'language_id' => 1,
                'name' => 'Neue Nachricht',
                'subject' => '{SENDER} hat Dir eine Nachricht geschrieben',
                'body' => '<p>{ANREDE} {NAME},</p><p>{SENDER} hat Dir eine Nachricht geschrieben.</p><p>Gehe auf den folgendem Link um Deine Nachricht zu lesen.,<br /> Dein Lebensmittelretten.de Team</p><p></p><div class="border">{MESSAGE}<p><a href="{LINK}" target="_blank" class="button">Antworten</a></p></div>',
            ),
            9 => 
            array (
                'id' => 10,
                'language_id' => 1,
                'name' => 'Passwort ändern',
                'subject' => 'Neues Passwort auf Lebensmittelretten.de',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>Klicke auf den folgenden Link um Dein Passwort auf Lebensmittelretten.de zu &auml;ndern:</p>
<p></p>
<p><a href="{LINK}%20" target="_blank">{LINK} </a></p>
<p></p>
<p>Alles Liebe, Dein Foodsharing Team.</p>',
            ),
            10 => 
            array (
                'id' => 11,
                'language_id' => 1,
                'name' => 'Fehlermeldung für Admins',
                'subject' => 'System-Fehler',
                'body' => '<p>{DATA}</p>',
            ),
            11 => 
            array (
                'id' => 12,
                'language_id' => 1,
                'name' => 'Neues Thema in Bezirk',
                'subject' => 'Neues Thema in {BEZIRK}',
                'body' => '<p>{ANREDE} {NAME},<br /> {POSTER} hat ein neues Thema im Forum gepostet.</p>
<p></p>
<div class="border">
<p><strong><a href="{LINK}" target="_blank">{THREAD}</a></strong></p>
<p>{POST}</p>
<a href="{LINK}" target="_blank" class="button">Einloggen zum Antworten</a></div>
<p></p>
<p>Alles Liebe,<br />Dein Lebensmittelretten.de Team</p>',
            ),
            12 => 
            array (
                'id' => 13,
                'language_id' => 1,
                'name' => 'Neues Botschafter Thema in Bezirk',
                'subject' => 'Neues Thema für Botschafter aus {BEZIRK}',
                'body' => '<p>{ANREDE} {NAME},</p>
<p></p>
<p>{POSTER} hat ein neues Thema ins Botschafter-Forum gepostet.</p>
<p></p>
<div class="border">
<p><strong><a href="{LINK}" target="_blank">{THREAD}</a></strong></p>
<p>{POST}</p>
<a href="{LINK}" target="_blank" class="button">Einloggen zum Antworten</a></div>
<p>Alles Liebe,<br />Dein Lebensmittelretten.de Team</p>',
            ),
            13 => 
            array (
                'id' => 14,
                'language_id' => 1,
                'name' => 'Filliale ohne Verantwortlichen',
                'subject' => '{BETRIEB} hat keine/n Verantwortliche/n',
                'body' => '<p>{ANREDE} {NAME},</p>
<p></p>
<p>der Betrieb {BETRIEB} hat keinen zugewiesenen Verantwortlichen, bitte frage im entsprechenden Bezirk nach wer die Verantwortung tr&auml;gt.</p>
<p></p>
<p>Hier Der Link zur Betriebsseite:</p>
<p>{LINK}</p>
<p></p>
<p>Vielen lieben Dank Dir ,</p>
<p>Dein Lebensmittelretten.de Team</p>',
            ),
            14 => 
            array (
                'id' => 15,
                'language_id' => 1,
                'name' => 'Buch Anfrage',
                'subject' => '{RNAME} fragt nach einem Buch',
                'body' => '<p><strong>Hallo {NAME}</strong>,</p>
<p></p>
<p>{RNAME} fragt nach einem Buch. Gehe auf <a href="http://www.gluecklich-ohne-geld.de" target="_blank">www.gluecklich-ohne-geld.de</a> um die Anfrage zu bearbeiten.</p>
<p></p>
<p>Herzliche Gr&uuml;&szlig;e,</p>
<p>Dein gluecklich-ohne-geld.de Team</p>',
            ),
            15 => 
            array (
                'id' => 16,
                'language_id' => 1,
                'name' => 'Buch behalten',
                'subject' => '{RNAME} liest noch ein wenig',
                'body' => '<p>Hallo {NAME},</p>
<p></p>
<p>{RNAME} liest zur Zeit selber noch in dem Buch und kann es noch nocht weiter geben, schau nochmal auf der Karte nach ob Du nicht an einem anderen Ort noch ein Buch f&uuml;r Dich findest.</p>
<p></p>
<p>Herzliche Gr&uuml;&szlig;e,</p>
<p>Dein gluecklich-ohne-geld.de Team</p>',
            ),
            16 => 
            array (
                'id' => 17,
                'language_id' => 1,
                'name' => 'Account erstellt',
                'subject' => 'Glücklich ohne Geld',
                'body' => '<p>Einen wunderbaren guten Tag {NAME},</p>
<p></p>
<p>Dein Passwort auf gluecklich-ohne-geld.de lautet: <strong>{PASS}</strong></p>
<p></p>
<p>Alles Liebe, Dein Gl&uuml;cklich ohne Geld Team!</p>',
            ),
            17 => 
            array (
                'id' => 18,
                'language_id' => 1,
                'name' => 'Fair-Teiler Update',
                'subject' => 'Fair-Teiler Update: {FAIRTEILER}',
                'body' => '<p>{ANREDE} {NAME},</p>
<p></p>
<p>Es gibt Neuigkeiten beim <a href="{LINK}" target="_blank">Fair-Teiler {FAIRTEILER}</a></p>
<p></p>
<div class="border">
<p>{POST}</p>
<p><a href="{LINK}" target="_blank" class="button">Einloggen zum Antworten</a></p>
</div>',
            ),
            18 => 
            array (
                'id' => 19,
                'language_id' => 1,
                'name' => 'Antwort auf Foren Thema',
                'subject' => 'Antwort auf Thema  {THEME}',
                'body' => '<p>{ANREDE} {NAME},<br /> {POSTER} hat im Forum geantwortet</p>
<div class="border">
<p><strong><a href="{LINK}" target="_blank">{THEME}</a></strong></p>
<p>{POST}</p>
<p><a href="{LINK}" target="_blank" class="button">Einloggen zum Antworten</a></p>
</div>
<p>Alles Liebe,<br /> Dein Lebensmittelretten.de Team</p>',
            ),
            19 => 
            array (
                'id' => 20,
                'language_id' => 1,
                'name' => 'Forums Thema Bestätigung',
                'subject' => 'Ein Thema in {BEZIRK} muss bestätigt werden',
                'body' => '<p>{ANREDE} {NAME},</p>
<p></p>
<p>{POSTER} m&ouml;chte das Thema "<a href="{LINK}" target="_blank">{THREAD}</a>" absenden. Da Du Botschafter f&uuml;r {BEZIRK} bist, musst Du es best&auml;tigen, bevor es ver&ouml;ffentlicht wird.</p>
<p></p>
<p>Vielen Dank, alles Liebe,<br />Dein Lebensmittelretten.de Team</p>',
            ),
            20 => 
            array (
                'id' => 21,
                'language_id' => 1,
                'name' => 'E-Mail Adresse ändern',
                'subject' => 'Bestätige Deine neue E-Mail Adresse für lebensmittelretten.de',
                'body' => '<p>{ANREDE} {NAME},</p>
<p></p>
<p>um Deine neue E-Mail Adresse f&uuml;r lebensmittelretten.de zu aktivieren klicke bitte auf den folgenden Link</p>
<p><a href="{LINK}" target="_blank">{LINK}</a></p>
<p></p>
<p>Alles Liebe,</p>
<p>Dein Foodsharing Team.</p>',
            ),
            21 => 
            array (
                'id' => 22,
                'language_id' => 1,
                'name' => 'Anfrage Essenskorb',
                'subject' => 'Dein Essenskorb wurde von {SENDER} angefragt',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>{SENDER} hat Deinen Essenskorb angefragt.</p>
<p>Gehe auf den folgendem Link um die Anfrage zu bearbeiten.,<br /> Dein Lebensmittelretten.de Team</p>
<p></p>
<div class="border">{MESSAGE}
<p><a href="{LINK}" target="_blank" class="button">Antworten</a></p>
</div>',
            ),
            22 => 
            array (
                'id' => 23,
                'language_id' => 1,
                'name' => 'Anmeldung als Botschafter in leerem Bezi',
                'subject' => 'Danke',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>F&uuml;r die Region {BEZIRK} gibt es noch keinen Botschafter, jemand aus dem Bundeweiten Orgateam wird sich mit Dir in Verbindung setzen.</p>
<p>Beachte das es in einer Region mindestens 5 Foodsharing Freiwillige geben muss und einer von euch muss die Botschafter Rolle &uuml;bernehmen.</p>
<p></p>
<p>Alles Liebe, Dein Foodsharing-Team.</p>',
            ),
            23 => 
            array (
                'id' => 24,
                'language_id' => 1,
                'name' => 'Gruppenkontakt',
                'subject' => 'Anfrage an Gruppe: {GRUPPENNAME}',
                'body' => '{MESSAGE}',
            ),
            24 => 
            array (
                'id' => 25,
                'language_id' => 0,
                'name' => 'Neu-Registrierung',
                'subject' => 'Schön, dass Du jetzt dabei bist!',
                'body' => '<p>{ANREDE} {NAME},</p>
<p>Mit einem Klick auf den folgenden Link ist Dein Benutzerkonto auf foodsharing.de aktiviert: <a href="{LINK}" target="_blank"></a></p>
<p><a href="{LINK}" target="_blank">{LINK}</a></p>',
            ),
            25 => 
            array (
                'id' => 26,
                'language_id' => 0,
                'name' => 'Schlafmütze Vorwarnung',
                'subject' => 'Noch da? Bald bekommst Du eine Schlafmütze',
                'body' => '<p>{ANREDE} {NAME},</p>
<p></p>
<p>Du hast Dich seid 14 Tagen nciht mehr angemeldet, wir gehen davon aus das Du im Urlaub oder sonstwo unterwegs bist. Damit alle bescheid wissen bekommst du in 14 weiteren Tage eine Schlafm&uuml;tze.</p>
<p>Solltest DU dich innerhalb der n&auml;chsten 14 Tage noch einmal einloggen ist nat&uuml;rlich wieder alles beim alten.</p>
<p></p>
<p>Alles liebe,</p>
<p>Dein foodsharing Team</p>',
            ),
            26 => 
            array (
                'id' => 27,
                'language_id' => 0,
                'name' => 'Schlafmütze wird aufgesetzt',
                'subject' => 'Deine Schlafmütze',
                'body' => '{ANREDE} {NAME},

Da Du Dich das letzte Mal vor einem Monat eingeloggt hast bekommst Du nun eine Schlafm&uuml;tze, damit alle anderen bescheid wissen das Du z.Z. nicht aktiv Lebensmittel rettest.
In&nbsp;Deinen Einstellungen kannst Du nat&uuml;rlich jederzeit Deinen Account wieder aktivieren.

Alles liebe,
Dein foodsharing Team',
            ),
            27 => 
            array (
                'id' => 28,
                'language_id' => 0,
                'name' => 'Betrieb Kein Abholer Warnung',
                'subject' => 'Warnung: Für die nächste Abholung bei {BETRIEB} hat sich noch niemand zum Abholen eingetragen',
                'body' => '<p>{ANREDE} {NAME},</p>
<p></p>
<p>Du bist verantwortlich f&uuml;r <a href="{LINK}" target="_blank">{BETRIEB}</a>. Leider hat sich f&uuml;r den n&auml;chsten Termin noch niemand zum Abholen eingetragen.</p>
<p>Bitte k&uuml;mmere Dich schnellstm&ouml;glich um jemanden aus Deinem Betriebsteam, damit die Abholung stattfinden kann. Solltest Du niemanden mobilisieren k&ouml;nnen, &uuml;bernimmst Du die Abholung.</p>
<p></p>
<p>Alles liebe,</p>
<p>Dein foodsharing Team</p>',
            ),
            28 => 
            array (
                'id' => 29,
                'language_id' => 0,
                'name' => 'Internationales Treffen 2015 Anmeldebest',
                'subject' => 'Letzte Infos bzgl. des großen foodsharing Treffens in Berlin',
                'body' => '<p>-- See below for an english version --</p>
<p></p>
<p>{ANREDE} {NAME},</p>
<p>&nbsp;</p>
<p>es freut uns riesig, dass Du dabei bist! Bis jetzt haben sich bereits mehr als 700 Menschen offiziell f&uuml;r das bisher gr&ouml;&szlig;te foodsharing Treffen angemeldet. Da aber nicht alle zur gleichen Zeit da sein werden, gibt es immer noch freie Pl&auml;tze. F&uuml;r alle FreundInnen und andere Interessierte ist es noch m&ouml;glich, sich jetzt unter <a href="https://foodsharing.de/event" target="_blank">www.foodsharing.de/event</a> anzumelden.</p>
<p></p>
<p>a) Hausordnung und Rechtliches</p>
<p>b) Neuigkeiten</p>
<p>c) Zeitplan</p>
<p>d) Packliste</p>
<p>e) Anfahrt und Plan</p>
<p>f) Mitfahrgelegenheiten</p>
<p>g) Helfen</p>
<p>h) Foto von allen</p>
<p>i) Deine Fotos gesucht!</p>
<p>j) Berliner_innen herzlich eingeladen vor Ort zu schlafen</p>
<p>k) &Uuml;brige Lebensmittel gesucht!</p>
<p>l) In W&uuml;rzburg warten noch Lebensmittel auf uns!</p>
<p></p>
<p>Komme bei der Ankunft bitte erst einmal zum Haupteingang, dort wird dich das Begr&uuml;&beta;ungsteam in Empfang nehmen und Dir alles Weitere zeigen und erkl&auml;ren.</p>
<p>Solltest du irgendwelche Fragen, Anliegen oder Sonstiges haben kannst Du Dich w&auml;hrend des gesamten Events immer am Infopoint am Haupteingang melden. <br />Es gibt noch einen Workshop, zu dem Du Dich noch gerne anmelden m&ouml;chtest? <br />Dies kannst du auch gerne vor Ort am Infopoint erledigen.</p>
<p>Alle bisher geplanten Workshops noch mal hier: <a href="http://wiki.lebensmittelretten.de/Event_Workshops" target="_blank">wiki.lebensmittelretten.de/Event_Workshops</a></p>
<p>&nbsp;</p>
<p>Noch ein paar Infos zum Ablauf und den Rahmenbedingungen:</p>
<p></p>
<p>a) Hausordnung und Rechtliches</p>
<p>&nbsp;</p>
<p>Wir m&ouml;chten das Treffen als ein positives Ereignis f&uuml;r alle Beteiligten gestalten. Bitte beachte daher, dass wir Gast sind beim FEZ und deren Hausordnung respektieren:</p>
<p><a href="http://www.fez-berlin.de/fileadmin/fez/FEZ/download/FEZ_Hausordnung_ab_2013.pdf" target="_blank">www.fez-berlin.de/fileadmin/fez/FEZ/download/FEZ_Hausordnung_ab_2013.pdf</a></p>
<p>Die Verpflegung f&uuml;r das gesamte Event wird von uns durch von Betrieben und Euch gerettete Lebensmittel gew&auml;hrleistet. Lebensmittelspenden sind gerne willkommen, bitte bei Punkt k nachlesen.</p>
<p>&nbsp;</p>
<p>foodsharing als Veranstalter ist dabei von jeglicher Haftung f&uuml;r die Genie&szlig;barkeit bzw. gesundheitliche Unbedenklichkeit der Ware entbunden und &uuml;bernimmt keine Verantwortung f&uuml;r die Lebensmittelspenden.</p>
<p>Link:&nbsp;<a href="http://wiki.lebensmittelretten.de/Rechtsvereinbarung" target="_blank">http://wiki.lebensmittelretten.de/Rechtsvereinbarung</a></p>
<p>&nbsp;</p>
<p>Wir sorgen auf der Veranstaltung f&uuml;r Kinderbetreuung. Eltern haften jedoch f&uuml;r ihre Kinder und die Verantwortung f&uuml;r diese liegt ausschlie&beta;lich bei den Erziehungsberechtigten.</p>
<p>&nbsp;</p>
<p>Selbstverst&auml;ndlich gelten auf der Veranstaltung die Regelungen des Jugendschutzgesetzes zu Abgabe und Verzehr von Alkohol, Aufenthalt an &ouml;ffentlichen Orten wie Tanzveranstaltungen oder der Altersfreigabe von Filmen.</p>
<p>&nbsp;</p>
<p>b. Neuigkeiten</p>
<p><br /><br /></p>
<p>Es gibt einen neuen Workshop: Transition-Town (mit Film!) am Freitag von 15 bis 16.30 Uhr und 17 - 18.30 Uhr.</p>
<p>&nbsp;</p>
<p>Zudem wird Tobias Rosswog von Living Utopia! eine Keynote zum Thema &ldquo;Utopien jetzt leben!&rdquo; am Freitag ab 21 Uhr im Zirkuszelt geben. Raphael Fellmer wird im Anschluss auch dort eine Gespr&auml;chsrunde zum Thema &ldquo;Geldfreien Leben und einer Welt ohne Geld&rdquo; anbieten.</p>
<p>&nbsp;</p>
<p>Chuy You bietet an jedem Morgen von 9 - 9.30 Uhr Meditation (mit anschlie&szlig;ender Klangreise/Massage) an. Ohne Anmeldung - seid aber p&uuml;nktlich. Der Raum wird noch vor Ort festgelegt.</p>
<p>&nbsp;</p>
<p>Am Freitag- und Samstagabend gibts Jamsessions im Zirkuszelt. Herr Binner spielt am Samstag mit uns. Mehr Infos: <a href="http://herrbinner.de/" target="_blank">www.herrbinner.de</a></p>
<p>&nbsp;</p>
<p>c. Zeitplan</p>
<p>&nbsp;</p>
<p>Der vollendete Zeitplan sieht wie folgt aus:</p>
<p>&nbsp;</p>
<p>Donnerstag&nbsp;Ab 16 Uhr &nbsp; &nbsp; Anreise</p>
<p>ab 17.30 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;kurze Begr&uuml;&szlig;ung</p>
<p>18.30 - 20.30 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Abendessen</p>
<p>21 Uhr &ndash; open end &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Tanz in den Mai im Konzertsaal II</p>
<p>&nbsp;</p>
<p>Freitag - Feiertag 1. Mai</p>
<p>9.00 &ndash; 11.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Fr&uuml;hst&uuml;ck</p>
<p>11.00 &ndash; 13.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Er&ouml;ffnung / wesentliche Informationen, R&uuml;ckblicke u.a. mit Raphael Fellmer</p>
<p>13.00 - 15.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Mittagessen</p>
<p>15.00 &ndash; 16.30 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="http://wiki.lebensmittelretten.de/Event_Workshops" target="_blank">Workshops</a> I</p>
<p>17.00 - 18.30 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href="http://wiki.lebensmittelretten.de/Event_Workshops" target="_blank">Workshops</a> II (bis max. 19.30 Uhr)</p>
<p>13.30 &ndash; 16.30 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Orgateamtreffen</p>
<p>17.00 - 19.30 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Gemeinsames BotschafterInnen- und Orgateamtreffen</p>
<p>18.00 - 20.30 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Abendessen</p>
<p>20.00 - 21.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Fragetafel &ndash; Antworten und offene Fragen - bei trockenem Wetter am Wasserbecken</p>
<p>ab 21 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Keynote Tobi Rosswog &ldquo;Utopien jetzt leben!&rdquo; &amp; Raphael Fellmer zum &ldquo;Leben ohne Geld&rdquo; im Zirkuszelt</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;danach: Jamsessions im Zirkuszelt</p>
<p>&nbsp;</p>
<p>Samstag</p>
<p>8.00 &ndash; 10.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Fr&uuml;hst&uuml;ck</p>
<p>10.00 &ndash; 11.15 Uhr &nbsp; &nbsp; &nbsp; Treffen der Bundesl&auml;nder und L&auml;nder / Austausch und Beratung</p>
<p>11.30 - 13.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp;<a href="http://wiki.lebensmittelretten.de/Event_Workshops" target="_blank">Workshops</a> III</p>
<p>13.00 - 15.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp;Mittagessen</p>
<p>14 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Foto von allen (von oben)</p>
<p>14.30 - 16.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp;<a href="http://wiki.lebensmittelretten.de/Event_Workshops" target="_blank">Workshops</a> IV</p>
<p>16.30 &ndash; 19.00 Uhr &nbsp; &nbsp; &nbsp; Gruppentreffen - Wirkungsraum + Aufr&auml;umen der Seminarr&auml;ume</p>
<p>18.00 - 20.30 Uhr &nbsp; &nbsp; &nbsp; &nbsp;Abendessen</p>
<p>20.00 - 21.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp;Fragetafel &ndash; Antworten und offene Fragen - bei trockenem Wetter am Wasserbecken</p>
<p>ab 20 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Jamsessions und HerrBinner im Zirkuszelt</p>
<p>offener Abend, Jamsessions</p>
<p>&nbsp;</p>
<p>Sonntag</p>
<p>8.00 &ndash; 10.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Fr&uuml;hst&uuml;ck</p>
<p>10.30 -12.30 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Abschluss der Veranstaltung im Astrid-Lindgren-Saal -&nbsp;Pr&auml;sentation einzelner Ergebnisse der Gruppentreffen &amp;<a href="http://wiki.lebensmittelretten.de/Event_Workshops" target="_blank"> Workshops</a></p>
<p>13.00 - 15.00 Uhr &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Mittagessen</p>
<p>15.00 - max. 19.00 Uhr &nbsp;&nbsp;Aufr&auml;umen &amp; Abreise</p>
<p></p>
<p>Aktuelle Informationen und eventuelle &Auml;nderungen findest du hier:</p>
<p></p>
<p><a href="http://wiki.lebensmittelretten.de/Event_Zeitplan" target="_blank">http://wiki.lebensmittelretten.de/Event_Zeitplan</a></p>
<p><br /><br /></p>
<p>d. Packliste</p>
<p>&nbsp;</p>
<p>Es kann vor allem nachts kalt werden - bitte packt unbedingt genug Kleidung / Decken ein!</p>
<p>Die Packliste findet ihr nun hier: <a href="http://wiki.lebensmittelretten.de/Event_Packliste" target="_blank">http://wiki.lebensmittelretten.de/Event_Packliste</a></p>
<p>&nbsp;</p>
<p>e. Anfahrt und Plan</p>
<p>&nbsp;</p>
<p>Dazu findest du alle Informationen hier:</p>
<p><a href="http://wiki.lebensmittelretten.de/Event_Ort" target="_blank">http://wiki.lebensmittelretten.de/Event_Ort</a></p>
<p>&nbsp;</p>
<p>Wichtig f&uuml;r Bahnreisende: Zwischen Karlshorst und K&ouml;penick besteht von Donnerstag, 22 Uhr bis Montag, 1.30 Uhr Schienenersatzverkehr. Dies bedeutet, Sp&auml;tanreisende am Donnerstag oder Freitag-Anreisende kommen &ldquo;An der Wuhlheide&rdquo; an (vgl. Karte auf der verlinkten Anreise Informationsseite)</p>
<p>&nbsp;</p>
<p>f. Mitfahrgelegenheiten</p>
<p>&nbsp;</p>
<p>Seit einiger Zeit gibt es schon dieses Forum f&uuml;r Mitfahrgelegenheiten: <a href="https://board.foodsharing.de" target="_blank">https://board.foodsharing.de</a>. Bisher haben das noch wenige, aber vor allem keine Menschen genutzt, die mit dem Auto zum Treffen kommen.</p>
<p>Wir haben es jetzt m&ouml;glich gemacht, das Forum ohne Registrierung zu nutzen.</p>
<p>So ist das einfacher f&uuml;r alle.</p>
<p>&nbsp;</p>
<p>g. Helfen</p>
<p>&nbsp;</p>
<p>Wir brauchen dringend Helfer- und haben Schichtpl&auml;ne erstellt.</p>
<p>Bitte tragt euch ein, wann ihr wo mitmachen k&ouml;nnt:</p>
<p><a href="http://goo.gl/jbrytT" target="_blank">http://goo.gl/jbrytT</a> (bis Mittwoch, 16 Uhr - danach vor Ort)</p>
<p>&nbsp;</p>
<p>h. Foto von allen</p>
<p>&nbsp;</p>
<p>Am Samstag um 14 Uhr machen wir von oben - von der Terasse - ein Gruppenfoto und ihr k&ouml;nnt alle dabei sein!</p>
<p>&nbsp;</p>
<p>i. R&uuml;ckblicke zu foodsharing</p>
<p>&nbsp;</p>
<p>Um die Pr&auml;sentation zum R&uuml;ckblick der vergangenen Monate und Jahre noch sch&ouml;ner zu gestalten, sind Deine Fotos von Rettungen etc. gesucht.</p>
<p>Bitte beachte hier die Film- und Personenrechte sowie - ob die Zustimmung des ggf. erkennbaren Betriebes vorliegt. Sende diese an: <a href="mailto:spring2015@lebensmittelretten.de" target="_blank">spring2015@lebensmittelretten.de</a>&nbsp;und nutze dazu bitte einen Upload-Service wie beispielsweise&nbsp;<a href="https://www.wetransfer.com/" target="_blank">https://www.wetransfer.com/</a>&nbsp;und sende die Bilder nicht einfach als Anhang.</p>
<p>&nbsp;</p>
<p>j. Berliner_innen herzlich eingeladen vor Ort zu schlafen</p>
<p>&nbsp;</p>
<p>Da es noch gen&uuml;gend Platz f&uuml;r Zelte gibt, kann gerne jede/r Berliner/in mit uns vor Ort zelten. Bitte meldet dies am Infopoint an.</p>
<p>&nbsp;</p>
<p>Bei Unwetter oder Dauerregen und -k&auml;lte kommen wir alle im Hauptgeb&auml;ude unter.</p>
<p>&nbsp;</p>
<p>k. &Uuml;brige Lebensmittel gesucht!</p>
<p>&nbsp;</p>
<p>F&uuml;r das Treffen werden noch verschiedene Lebensmittel gesucht, die beim Retten selten dabei sind und die wir nirgendwo anders bekommen konnten:</p>
<p>Zwiebeln</p>
<p>Salat-&Ouml;l</p>
<p>Gelierzucker</p>
<p>S&uuml;&szlig;aufstriche</p>
<p>Brotaufstriche/Belag</p>
<p>Salz</p>
<p>Zucker</p>
<p>Essig</p>
<p>&nbsp;</p>
<p>Wenn Du etwas mitbringen kannst, trage dies einfach hier mit deinem Namen, der etwa-Menge und dem Ankunftszeitpunkt ein: <a href="http://piratepad.net/pZ4ih6FfOQ" target="_blank">http://piratepad.net/pZ4ih6FfOQ</a></p>
<p>&nbsp;</p>
<p>l. In W&uuml;rzburg warten haltbare Lebensmittel auf uns!</p>
<p>&nbsp;</p>
<p>Wer f&auml;hrt &uuml;ber W&uuml;rzburg nach Berlin bzw. kann dort kurz stoppen?</p>
<p>Es gibt dort jede Menge haltbare Lebensmittel zum Abholen, bitte meldet Euch!</p>
<p>&nbsp;</p>
<p>--------------------</p>
<p>&nbsp;</p>
<p>Super w&auml;re auch, wenn Du noch haltbare Lebensmittel (MHD) sammelst, die Du zum Treffen mitbringst. Wenn es sich um gr&ouml;&szlig;ere Mengen handelt, die Du selbst oder jemand aus deinem Team, nicht transportieren kann, melde Dich einfach bei uns!</p>
<p>&nbsp;</p>
<p>Wir freuen uns auf Dich und auf eine tolle Veranstaltung!</p>
<p>&nbsp;</p>
<p>Herzlichst</p>
<p>&nbsp;</p>
<p>euer Orgateam</p>
<p><a href="mailto:spring2015@lebensmittelretten.de" target="_blank">spring2015@lebensmittelretten.de</a></p>
<p></p>
<p>Dein&nbsp;pers&ouml;nlicher Link zum Bearbeiten deiner Anmeldedaten:&nbsp;<a href="{LINK}" target="_blank">{LINK}</a></p>
<p></p>
<p></p>
<p>Dear participant,</p>
<p>&nbsp;</p>
<p>We&rsquo;re really happy that you&rsquo;re taking part and we&rsquo;re so pleased to have you!</p>
<p>&nbsp;</p>
<ul>
<li>
<p>a) Site rules and legal issues</p>
</li>
<li>
<p>b) News</p>
</li>
<li>
<p>c) Schedule</p>
</li>
<li>
<p>d) Packing list</p>
</li>
<li>
<p>e) Directions and map</p>
</li>
<li>
<p>f) Car pooling</p>
</li>
<li>
<p>g) Helping out</p>
</li>
<li>
<p>h) Pictures of everyone</p>
</li>
<li>
<p>i) Foodsharing review</p>
</li>
<li>
<p>j) People from Berlin are invited to sleep on site</p>
</li>
</ul>
<p><br /><br /><br /></p>
<p>When you arrive, please first come to the Haupteingang (main entrance), where a team will be there to welcome you and will show and explain to you everything you need to know.</p>
<p>If you have any questions, concerns or anything other issues, feel free to go to the Infopoint at the main entrance at any time during the whole event.<br />Is there a workshop you&rsquo;d like to sign up for? <br />You can also do that at the Infopoint, as long as there are spaces free.</p>
<p>&nbsp;</p>
<p>Some information about the programme of events and general conditions:</p>
<p>&nbsp;</p>
<ol>
<li>
<p>a) Site Rules and Legal Issues</p>
</li>
</ol>
<p>&nbsp;</p>
<p>We want the meet-up to be a positive experience for all participants. Therefore please be aware that we are guests at FEZ and should respect their site rules:</p>
<p><a href="http://www.fez-berlin.de/fileadmin/fez/FEZ/download/FEZ_Hausordnung_ab_2013.pdf" target="_blank">http://www.fez-berlin.de/fileadmin/fez/FEZ/download/FEZ_Hausordnung_ab_2013.pdf</a></p>
<p>All meals throughout the event will be provided by us and consist of food saved from various different businesses. Foodsharing, as event organiser, is released from any liability for the edibility or safety of the products and assumes no responsibility for the donated food.</p>
<p><a href="http://wiki.lebensmittelretten.de/Rechtsvereinbarung" target="_blank">http://wiki.lebensmittelretten.de/Rechtsvereinbarung</a></p>
<p>&nbsp;</p>
<p>Child care will be provided during the event. However, parents are liable for their children and sole responsibility for them lies with their legal guardians.</p>
<p>&nbsp;</p>
<p>The same rules apply at the event as set out in the German Protection of Young Persons Act regarding the sale and consumption of alcohol, attendance at public places such as dance venues and the age restriction of films.</p>
<p>&nbsp;</p>
<p>b.) News</p>
<p><br /><br /></p>
<p>There is a new worksho: Transitiontown (including film!) on Friday from 3pm to 4.30 pm and also 5 pm to 6.30 pm.</p>
<p>&nbsp;</p>
<p>In addition to that, Tobi from Living Utopia! will hold a keynote in the circus tent on the topic of &ldquo;Utopien jetzt leben!&rdquo; (Live Utopias Now!) on Friday from 9pm. Raphael Fellmer will follow up with a discussion session on the topic of &ldquo;Leben ohne Geld&rdquo; (Life without money).</p>
<p>&nbsp;</p>
<p>On Friday and Saturday evenings there are jam sessions in the circus tent. HerrBinner will play with us on Saturday. More information: <a href="http://www.herrbinner.de/" target="_blank">http://www.herrbinner.de/</a></p>
<p>&nbsp;</p>
<p>c.) Schedule</p>
<p>&nbsp;</p>
<p>The final schedule is as follows:</p>
<p>&nbsp;</p>
<p><a href="http://wiki.lebensmittelretten.de/Event_timetable" target="_blank">http://wiki.lebensmittelretten.de/Event_timetable</a></p>
<p><br /><br /></p>
<p>d.) Packing list</p>
<p>&nbsp;</p>
<p>You can find the packing list here: <a href="http://wiki.lebensmittelretten.de/Event_Packliste" target="_blank">http://wiki.lebensmittelretten.de/Event_Packliste</a></p>
<p>&nbsp;</p>
<p>e.) Directions and map</p>
<p>&nbsp;</p>
<p>You can find all the information about the location here:</p>
<p><a href="http://wiki.lebensmittelretten.de/Event_Location" target="_blank">http://wiki.lebensmittelretten.de/Event_Location</a></p>
<p></p>
<p>&nbsp;</p>
<p>Inportant Info for people arriving by commuter-train (s-bahn): there will be rail-replacement service between the stations &ldquo;Karlshort&rdquo; and &ldquo;K&ouml;penig&rdquo; from thursday 10 pm to monday 1:30 pm. People arriving thursday-night or friday will arrive at the station &ldquo;An der Wohlheide&rdquo; (see map).</p>
<p>&nbsp;</p>
<p>f.) Car pooling</p>
<p>&nbsp;</p>
<p>There has been a forum for carpooling for a while: <a href="https://board.foodsharing.de" target="_blank">https://board.foodsharing.de</a>.</p>
<p>As of now the board has not been used by very many people arriving via car.</p>
<p>We have now made it possible to use the forum without being registered. This makes it easier for everyone.</p>
<p>&nbsp;</p>
<p>g.) helpers</p>
<p>&nbsp;</p>
<p>We urgently need helpers on site and have created a shift schedule.</p>
<p>Please sign in to this document with your name and when and where you can help:</p>
<p><a href="http://goo.gl/jbrytT" target="_blank">http://goo.gl/jbrytT</a> (until wednesday 4 pm, afterwards on site)</p>
<p>&nbsp;</p>
<p>h.) picture of everyone</p>
<p>will be taken saturday 2 pm from atop the terrace, everyone is very welcome to join!</p>
<p>&nbsp;</p>
<p>i.) review of foodsharing</p>
<p>To have a nice retrospect of the last months and years of foodshairng, we need your pictures of rescued food, actions against foodwaste, etc.</p>
<p>Please pay respect to individual and corporate copyright regulatons.</p>
<p>&nbsp;</p>
<p>j.) Berliners invited to sleep on site</p>
<p>There there now is enough space for tents for everyone, the local berlin residents are happily invited to sleep on the campsite together with everyone else . Please notify the Infopoint if you wish to do so.</p>
<p>&nbsp;</p>
<p>In case of a storm we can find shelter in the main building.</p>
<p><br /><br /></p>
<p>We are very much looking forward to a great event and meeting you all!</p>
<p>&nbsp;</p>
<p>Sincerely</p>
<p>&nbsp;</p>
<p>Your Orgateam</p>
<p></p>
<p>If you want to change your event settings, please use this link:&nbsp;<a href="{LINK_EN}" target="_blank">{LINK_EN}</a></p>
<p></p>',
),
29 => 
array (
'id' => 30,
'language_id' => 1,
'name' => 'Neue Gruppen-Nachricht',
'subject' => '{SENDER} hat an {CHATNAME} eine Nachricht geschrieben',
'body' => '<p>{ANREDE} {NAME},</p><p>{SENDER} hat an {CHATNAME} eine Nachricht geschrieben.</p><p>Gehe auf den folgendem Link um Deine Nachricht zu lesen.,<br /> Dein Lebensmittelretten.de Team</p><p></p><div class="border">{MESSAGE}<p><a href="{LINK}" target="_blank" class="button">Antworten</a></p></div>',
),
));
        
        
    }
}