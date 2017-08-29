<?php

use Illuminate\Database\Seeder;

class FsContentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $this->seedContent();
    }

    private function seedContent()
    {
        \DB::table('fs_content')->delete();

        \DB::table('fs_content')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'botschafter',
                    'title' => 'BOTSCHAFTERInnen',
                    'body' => '<p class="caps">Die BotschafterInnen &uuml;bernehmen neben den gleichen T&auml;tigkeiten der Foodsaver und Freiwilligen Koordinations-Aufgaben. Sie sind AnsprechpartnerInnen f&uuml;r das jeweilige Bundesland, Stadt, Region oder Bezirk. Sie organisieren Treffen/Veranstaltungen mit allen Foodsharenden, gestalten gemeinsame Aktionen wie z.B. gemeinsames Kochen und Austeilen von &uuml;bersch&uuml;ssigen Lebensmitteln, lagern Flyer, Poster und Sticker und verteilen diese weiter. Au&szlig;erdem versuchen sie, Fair-Teiler-M&ouml;glichkeiten zu finden und zu betreuen und nat&uuml;rlich alle m&ouml;glichen Quellen von Lebensmitteln von Bauernh&ouml;fen, ProduzentInnen, H&auml;ndlerInnen, Superm&auml;rkten, GastronomInnen usw. ausfindig zu machen und die Verantwortlichen dieser Betriebe f&uuml;r die Idee zu begeistern, alles unverk&auml;ufliche aber noch genie&szlig;bare lieber an die Foodsaver bzw. direkt an foodsharing zu geben.</p>
<p class="caps">Weitere Infos dazu findest Du im <a href="http://wiki.lebensmittelretten.de/BotschafterIn" target="_blank">Wiki</a></p>
<p><a href="/freiwillige/mach-mit/?form=botschafter" target="_blank" class="btn-2 btn-align-left" style="background-color: #f15f27;"><span>Zur Anmeldung als BotschafterIN</span></a></p>',
                    'last_mod' => '2014-12-08 17:40:17',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'freiwillige',
                    'title' => 'FREIWILLIGE',
                    'body' => '<p class="caps">Willst Du Dich noch ein wenig mehr engagieren als nur ab und an einen Essenskorb abholen oder verschenken, kannst Du Dich als FreiwilligeR einbringen. Das hei&szlig;t u.a. die Idee von foodsharing in Deiner Region oder Stadt zu verbreiten und dabei zu helfen, Flyer und Poster zu verteilen, foodsharing auf Messen zu vertreten, sich um die Sauberkeit von den Fair-Teilern zu k&uuml;mmern, sowie f&uuml;r Medien- und Presseanfragen zur Verf&uuml;gung zu stehen. Au&szlig;erdem k&ouml;nnen sich die Freiwilligen ganz individuell mit ihren Talenten und F&auml;higkeiten bei foodsharing einbringen. Es geht dabei z.B. um die Hilfe bei &Uuml;bersetzungen in andere Sprachen, beim Programmieren &uuml;ber eine API, Veranstaltungen zum Thema Lebensmittelverschwendung, Kontakten zu L&auml;den/Druckereien u. v. m.</p>
<p><a href="/freiwillige/mach-mit/" target="_blank" class="btn-2 btn-align-left" style="background-color: #ffaa24;"><span>Zur Anmeldung als Freiwillige_r</span></a></p>',
                    'last_mod' => '2014-10-07 14:00:40',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'foodsaver',
                    'title' => 'FOODSAVER - LebensmittelretterInnen',
                    'body' => '<p class="caps">Die Foodsaver machen das gleiche wie die Freiwilligen, nur dass sie au&szlig;erdem noch helfen, Lebensmittel von Superm&auml;rkten, B&auml;ckerein, Bauern etc. vor der Vernichtung zu retten. Sprich, &uuml;bersch&uuml;ssige Lebensmittel mit einem Foodsaver-Ausweis in Absprache mit den anderen Engagierten des Foodsaver Teams von Betrieben abholen und diese an Vereine und soziale Projekte zu verteilen, oder bei foodsharing.de reinzustellen.</p>
<p class="caps">Weitere Infos findest Du im <a href="http://wiki.lebensmittelretten.de/Foodsaver" target="_blank">Wiki</a>.</p>
<p><a href="/freiwillige/mach-mit/?form=foodsaver" target="_blank" class="btn-2 btn-align-left" style="background-color: #689d44;"><span>Zur Anmeldung als Foodsaver</span></a></p>',
                    'last_mod' => '2014-12-08 17:41:27',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'fuer-unternehmen',
                    'title' => 'Für Unternehmen',
                    'body' => '<p><span>Wir freuen uns sehr, dass Ihr Betrieb an foodsharing interessiert ist! Gemeinsam mit foodsharing k&ouml;nnen Sie sich daf&uuml;r einsetzen, dass aussortierte und unverk&auml;ufliche Lebensmittel eine sinnvolle Verwendung anstelle der Entsorgung erfahren.</span></p>
<p><span><strong>Was ist unser Ziel?</strong><br>Wir Foodsaver sind eine Gruppe von Menschen, die sich ehrenamtlich daf&uuml;r engagieren, dass weniger Lebensmittel in den M&uuml;ll wandern. Weltweit landet n&auml;mlich jedes dritte produzierte Lebensmittel in der Tonne. In jedem einzelnen stecken aber Arbeitszeit, Ressourcen, zum Teil lange Transportwege und Geld. Foodsharing bietet eine M&ouml;glichkeit, all das wieder wertzusch&auml;tzen, indem wir Essen eine zweite Chance geben.</span></p>
<p><span><strong>Das k&ouml;nnen wir Ihrem Betrieb bieten:</strong><br> Deshalb k&uuml;mmern wir uns um alle Lebensmittel, die aus verschiedenen Gr&uuml;nden nicht mehr verkauft werden k&ouml;nnen, aber noch genie&szlig;bar sind. Falls gew&uuml;nscht, wird das Abgeholte von den Foodsavern nach Verwertbarkeit sortiert. Die noch genie&szlig;baren Produkte werden anschlie&szlig;end weiter verteilt. Damit die Rechtssicherheit f&uuml;r die Lebensmittelspendebetriebe gew&auml;hrleistet ist, &nbsp;unterschreiben alle Foodsaver eine<a href="http://wiki.lebensmittelretten.de/Rechtsvereinbarung" target="_blank" style="text-decoration: none;"><span> </span></a><a href="http://wiki.lebensmittelretten.de/Rechtsvereinbarung" target="_blank">Rechtsvereinbarung</a></span><span>, mit der sie die volle Verantwortung f&uuml;r die abgeholten Lebensmittel &uuml;bernehmen.</span></p>
<p><span><strong>Und was machen wir mit dem Essen?</strong><br> Ein Gro&szlig;teil der geretteten Lebensmittel wird von den Foodsavern an Vereine, Tafeln, Suppenk&uuml;chen, FreundInnen, NachbarInnen, und nat&uuml;rlich &uuml;ber das foodsharing-Netzwerk oder Fair-Teiler (&ouml;ffentliche Regale zum Austausch von Lebensmitteln) verschenkt, der Rest wird von den Foodsavern selbst verwertet. Wir sehen uns als Erg&auml;nzung und Unterst&uuml;tzung der &uuml;ber 900 Tafeln in Deutschland. Als flexible, lokal organisierte Initiative k&ouml;nnen Foodsaver auch Kleinstmengen, Produkte &uuml;ber dem Mindesthaltbarkeitsdatum, an Wochenenden/Feiertagen und spontan abholen. Von Betrieben, die mit einer Tafel oder einer &auml;hnlichen Initiative zusammenarbeiten, werden nur Lebensmittel abgeholt, die von jenen aus rechtlichen oder logistischen Gr&uuml;nden nicht verwendet werden k&ouml;nnen - also nur das, was wirklich im M&uuml;ll landen w&uuml;rde. Es ist umso erfreulicher, wenn der karitative Gedanke der Tafeln mit dem foodsharing-Motto &bdquo;verwenden statt verschwenden&ldquo; einhergeht.</span> <br><span>Mittlerweile sind &uuml;ber 5.000 engagierte Menschen in Deutschland, &Ouml;sterreich, Liechtenstein und der Schweiz akkreditierte LebensmittelretterInnen. Gemeinsam kooperieren wir mit 1.500 Betrieben, darunter f&uuml;hrende Bioh&auml;ndlerInnen wie SuperBioMarkt und die </span><a href="http://wiki.lebensmittelretten.de/images/9/9b/Tonnen_sind_kein_Platz_f%C3%BCr_Lebensmittel.pdf" target="_blank"><span>Bio Company</span></a><span>. Insgesamt wurden so schon &uuml;ber 1.100 Tonnen Lebensmittel gerettet!</span></p>
<p><span><strong>Jetzt sind Sie gefragt!</strong><br> Ob Laden, Supermarkt, Restaurant, Kantine, ProduzentIn, Getr&auml;nkemarkt, H&auml;ndlerIn und alle, die sonst in der Lebensmittelbranche t&auml;tig sind - jedeR ist willkommen!</span> <br><span>Um mit uns in Kontakt zu treten und zu erfahren, wie Sie mit uns zusammenarbeiten k&ouml;nnen, schreiben Sie einfach eine E-Mail an <a href="mailto:info@foodsharing.de" target="_blank">info@foodsharing.de</a>.</span></p>
<p><span><strong>Klingt gut - aber was habe ich davon?</strong></span></p>
<ul><li>Mit uns k&ouml;nnen Sie einen Beitrag gegen die Verschwendung leisten. Ethischer Umgang mit Resten und aussortierten Lebensmittel ist schon an sich ein Wert.</li>
<li>Mit uns sparen Sie Geld und Arbeitskraft.</li>
<ul><li><span>Einsparung der Kosten f&uuml;r die M&uuml;llentsorgung. &ldquo;Dass wir dadurch [Kooperation mit foodsharing] sehr viel weniger Containerkapazit&auml;t brauchen und zus&auml;tzlich Kosten sparen, ist ein willkommener Nebeneffekt.&rdquo; Georg Kaiser, Gesch&auml;ftsf&uuml;hrer der BIO COMPANY</span></li>
<li><span>Einsparung der Arbeit f&uuml;r Sortierung und Entsorgung: Foodsaver &uuml;bernehmen das Sortieren der nicht mehr verk&auml;uflichen Lebensmittel in &lsquo;genie&szlig;bar&rsquo; und &lsquo;nicht mehr genie&szlig;bar&rsquo;, sowie die Entsorgung des anfallenden M&uuml;lls.</span></li>
</ul><li>Mit uns sind Sie flexibel. <span>Unsere Foodsaver k&ouml;nnen auch am Wochenende, Feiertagen, sp&auml;t abends, nachts und fr&uuml;h morgens die aussortierten Waren abholen. Wir k&ouml;nnen auch bei Ausfall der Tafeln und unerwarteten Vorf&auml;llen (K&uuml;hlanlagenausfall, falsche Lieferung usw.) zeitnah nach Anruf einspringen, da wir lokal aufgestellt und flexibel sind. In der Regel werden feste Tage und feste Uhrzeiten mit den Foodsavern f&uuml;r die Abholung ausgemacht, so dass Sie genau wissen, wann die Lebensmittel abgeholt werden. Sie bestimmen den am besten geeigneten Zeitpunkt und sprechen sich mit uns ab.</span></li>
<li>Mit uns gewinnen Sie Ansehen bei Ihrer Kundschaft. <span>Geben Sie Ihren KundInnen die M&ouml;glichkeit, sich ganz bewusst f&uuml;r Ihren Betrieb zu entscheiden, der keine Lebensmittel verschwendet. Falls gew&uuml;nscht, werden Sie als Unterst&uuml;tzerIn erw&auml;hnt, was wiederum Werbung f&uuml;r Sie bedeutet. Sie k&ouml;nnen Ihre Kooperation au&szlig;erdem mit unserem foodsharing-Sticker sichtbar machen. Sprechen Sie uns darauf an!</span></li>
<li>Mit uns sind Sie auch rechtlich auf der sicheren Seite.<span> Lebensmittelabgaben bedeuten keine rechtlichen Risiken f&uuml;r Sie, weil alle unsere Foodsaver einem </span><a href="http://wiki.lebensmittelretten.de/Rechtsvereinbarung#Rechtsvereinbarung_Teil_II_-_Haftungsausschluss" target="_blank" style="text-decoration: none;"><span>Haftungsausschluss</span></a><span> zugestimmt haben. Mit der Abgabe der Lebensmittel an die Foodsaver &uuml;bernehmen wir die volle Verantwortung f&uuml;r deren weitere Verwendung. Wir verpflichten uns zur Zuverl&auml;ssigkeit den Betrieben gegen&uuml;ber und zur Einhaltung der hygienischen Richtlinien bei Lagerung und Transport der Ware. Wir verpflichten uns au&szlig;erdem, die Waren nicht weiter zu verkaufen.</span></li>
</ul><p><strong>Kontakt: <a href="mailto:info@foodsharing.de" target="_blank">info@foodsharing.de</a><br></strong></p>',
                    'last_mod' => '2015-03-05 10:19:04',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Tipps',
                    'title' => 'Tipps',
                    'body' => '<p>Bald...</p>
<p>Tipps und Vorschl&auml;ge, wie Unternehmen nachhaltiger wirtschaften k&ouml;nnen, um m&ouml;glichst wenig Lebensmittel aber auch andere Ressourcen unn&ouml;tig zu verschwenden.</p>',
                    'last_mod' => '2014-08-13 01:16:47',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'vorteile',
                    'title' => 'Vorteile',
                    'body' => '<div>
<ul><li>Kostenlose Nachhaltigkeitsberatung wie z.B. durch Verg&uuml;nstigungen, Abgabe an Mitarbeitende, Brot vom Vortag f&uuml;r den halben Preis, an den/die KonsumentIn angepasste Bestellungen (Wetter, Ferien, Feiertage etc.), gezielte Kampagnen, die auf die Notwendigkeit auch die Misfits (Obst &amp; Gem&uuml;se mit besonderer Form, Gr&ouml;&szlig;e, Farbe etc.) zu verkaufen, aufmerksam machen.</li>
<li>Einsparung der Kosten f&uuml;r die M&uuml;llentsorgung.</li>
<li>Einsparung der Arbeit f&uuml;r die Entsorgung der aussortierten Lebensmittel: Foodsaver &uuml;bernehmen das Sortieren und die Entsorgung der Lebensmittel sowie des anfallenden M&uuml;lls.</li>
<li>Gewinn an Ansehen bei KundInnen durch sinnvollen Umgang mit aussortierten Lebensmitteln: Umgang mit foodsharing-Sticker sichtbar machen.</li>
<li>Foodsaver nehmen auch noch genie&szlig;bare Produkte mit abgelaufenem MHD, kaputten und offenen Packungen.</li>
<li>Foodsaver nehmen auch jegliche gebrauchte, verunreinigte und kaputte Proben, Tester usw. aus der Kosmetik bzw. Hygieneabteilung.</li>
<li>Ethischer Umgang mit Resten und aussortierten Lebensmittel ist schon an sich ein Wert.</li>
<li>KonsumentInnen die M&ouml;glichkeit zu geben, sich ganz bewusst f&uuml;r Betriebe zu entscheiden, die keine Lebensmittel wegschmei&szlig;en.</li>
<li>Die Foodsaver k&ouml;nnen auch am Wochenende, Feiertagen, sp&auml;t abends, nachts und fr&uuml;h morgends abholen.</li>
<li>Die Foodsaver k&ouml;nnen auch bei Ausfall der Tafeln und unerwarteten Vorf&auml;llen (K&uuml;hlanlagenausfall, falsche Lieferung, usw.) zeithnah nach Anruf einspringen, da wir lokal aufgebaut und flexibel sind.</li>
<li>Lebensmittelabgaben ohne rechtliche Konsequenzen durch den Haftungsausschluss, den alle Foodsaver unterschreiben m&uuml;ssen.</li>
</ul><span></span></div>',
                    'last_mod' => '2014-12-08 17:42:47',
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'erfolgsgeschichten',
                    'title' => 'Erfolgsgeschichten',
                    'body' => '<p><strong>Seit April 2012 kooperiert die gr&ouml;&szlig;te Bioldadenkette in Berlin, Hamburg und Brandenburg mit den LebensmittelretterInnen.</strong><br><strong>Damit geh&ouml;rt Bio Company zu den Pionierunternehmen,&nbsp;und wurde das Vorbild f&uuml;r eine ganze Branche.&nbsp;</strong><br><strong>Georg Kaiser, Gesch&auml;ftsf&uuml;hrer der BIO COMPANY, denkt laut.</strong></p>
<p>Hier eine Kolumne aus dem <a href="http://www.biocompany.de/nachhaltigkeit-verantwortung-2013.html" target="_blank">Monatsflyer</a>&nbsp;der Bio Company von Juli 2013:</p>
<h2>Tonnen sind kein Platz f&uuml;r Lebensmittel</h2>
<p>Liebe Kundinnen, liebe Kunden!</p>
<p>Essen wegzuwerfen widerstrebt mir zutiefst! Ich bin so erzogen, und ich kann nicht ignorieren, was das achtlose Verschleudern kostbarer Nahrungs-Ressourcen &ouml;kologisch und moralisch in der Welt anrichtet. Bekanntlich bestehen jedoch selbst gute Grunds&auml;tze ihre Nagelprobe nur in der Praxis und das gilt auch f&uuml;r das M&uuml;llregime der BIO COMPANY. Die entsprechende Probe aufs Exempel fand an unseren Containern statt und der &ndash; zun&auml;chst klammheimliche &ndash; Pr&uuml;fer hie&szlig; Raphael Fellmer.</p>
<p>Dieser hatte vor etwa drei Jahren, nach einer halben Weltreise ganz ohne Geld, beschlossen, g&auml;nzlich in den Konsumstreik zu treten. Bevor er mich ansprach, hatten er und seine Frau deshalb sich und ihre kleine Tochter schon einige Zeit fast ausschlie&szlig;lich vom Ertrag n&auml;chtlicher Containerbesuche ern&auml;hrt.</p>
<p>Doch was Fellmer unter anderem aus den Tonnen der BIO COMPANY barg, war meistens mehr, als die kleine Familie selbst mit Hilfe von Freunden aufessen konnte. Ein Zustand, der dem jungen Vater auf die Dauer so wenig behagte wie die Heimlichtuerei im Dunkeln.</p>
<p>Also nahm er Kontakt zu den "besuchten" Unternehmen auf, um das Problem ans Licht zu bringen und offiziell zu l&ouml;sen. So kamen wir ins Gespr&auml;ch miteinander und schlossen eine Art "Lebensmittelretter-Pakt".</p>
<p>Heute, etwas mehr als ein Jahr sp&auml;ter, sind wir dem Ziel, die Verschwendung bei der BIO COMPANY auf Null zu bringen, schon nahe: Weit &uuml;ber 100, in einem von Raphael Fellmer koordinierten Netzwerk registrierte "Foodsaver", holen t&auml;glich unverk&auml;ufliche, aber noch gute Lebensmittel ab. Sie nehmen mit, was &uuml;brig ist, nachdem der Bedarf unserer Mitarbeiter und der Tafeln, mit denen wir schon l&auml;nger kooperieren, gedeckt ist. Es hat intern ein wenig &Uuml;berzeugungsarbeit gekostet, doch inzwischen sind fast alle Filialen der BIO COMPANY in Berlin, Potsdam und Hamburg dabei.</p>
<p>F&uuml;r die Tonnen bleibt jetzt kaum noch etwas &uuml;brig. Dass wir dadurch sehr viel weniger Containerkapazit&auml;t brauchen und zus&auml;tzlich Kosten sparen, ist ein willkommener Nebeneffekt. Noch ist nicht alles perfekt und wir m&uuml;ssen weiter dranbleiben. Aber das ist jetzt schon klar: Lebensmittel-Verschwendung im Handel ist keinesfalls unvermeidlich!</p>
<p>Und f&uuml;r alle, die unserem Beispiel gern folgen m&ouml;chten: Raphael Fellmer, sein bundesweites Netzwerk und foodsharing.de vermitteln Ihnen daf&uuml;r gerne Kooperationspartner vor Ort!</p>
<p>Es gr&uuml;&szlig;t Sie herzlich</p>
<p>Ihr Georg Kaiser</p>',
                    'last_mod' => '2014-12-08 17:43:27',
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'impressum',
                    'title' => 'Impressum',
                    'body' => '<div class="mainframe">
<div class="imprint"><strong>Angaben gem&auml;&szlig; &sect; 5 TMG:</strong><br /> Foodsharing e.V.<br /> Marsiliusstr 36<br /> 50937 K&ouml;ln<br />
<h4>Vertreten durch:</h4>
Frank Bowinkelmann<br /> <span>Foodsharing e.V.</span><br />Marsiliusstr 36<br />50937 K&ouml;ln<br />
<h5>Kontakt:</h5>
E-Mail:&nbsp;<a href="mailto:info@foodsharing.de" target="_blank">info@foodsharing.de</a><br /> Fax: 0221 /&nbsp;<span>9420 2512</span><br /><br />
<h4>Registereintrag:</h4>
Eintragung im Vereinsregister.<br /> Registergericht: Amtsgericht K&ouml;ln<br /> Registernummer: VR 17439<br /> <strong>Satzung </strong><br /> <a href="https://wiki.foodsharing.de/images/0/09/Satzung_foodsharing_e.V._2016-12-04.pdf" target="_blank">zum Download</a><br /> <br />
<h4>Verantwortlich f&uuml;r den Inhalt nach &sect; 55 Abs. 2 RStV:</h4>
Frank Bowinkelmann<br /> <span>Marsiliusstr 36</span><br /><span>50937 K&ouml;ln</span><br /><br />
<h4>Haftungsausschluss:</h4>
<strong>Haftung f&uuml;r getauschte Lebensmittel</strong><br /> Der Seitenbetreiber Foodsharing e.V. und seine F&ouml;rderinstitutionen, Sponsoren, Spender und Dienstleister &uuml;bernehmen keinerlei Haftung f&uuml;r die Angebote Dritter auf der Webseite foodsharing.de und Lebensmittelretten.de. Die Internet-Seite foodsharing.de und Lebensmittelretten.de vermittelt lediglich Anbieter von Lebensmitteln und Interessenten an diesen Lebensmitteln. Verantwortlich f&uuml;r das Befolgen aller privatrechtlichen, lebensmittelrechtlichen und gesundheitlich bedeutenden Aspekte beim Teilen von Lebensmitteln sind die Anbieter und Interessenten selbst. Wir weisen ausdr&uuml;cklich auf die Regeln und Informationen im Bereich <a href="../lebensmittelrecht" target="_blank">&bdquo;Ratgeber und Foodsharing-Etikette&ldquo;</a> hin, die f&uuml;r alle Nutzer verbindlich gelten. Foodsharing e.V. ist kein Lebensmittelunternehmer im Sinne der EU- und der deutschen Gesetze und Verordnungen. <br />Quelle: foodsharing e.V.<br /> <strong>Haftung f&uuml;r Inhalte</strong><br /> Die Inhalte unserer Seiten wurden mit gr&ouml;&szlig;ter Sorgfalt erstellt. F&uuml;r die Richtigkeit, Vollst&auml;ndigkeit und Aktualit&auml;t der Inhalte k&ouml;nnen wir jedoch keine Gew&auml;hr &uuml;bernehmen. Als Diensteanbieter sind wir gem&auml;&szlig; &sect; 7 Abs.1 TMG f&uuml;r eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach &sect;&sect; 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, &uuml;bermittelte oder gespeicherte fremde Informationen zu &uuml;berwachen oder nach Umst&auml;nden zu forschen, die auf eine rechtswidrige T&auml;tigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unber&uuml;hrt. Eine diesbez&uuml;gliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung m&ouml;glich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.<br /> <strong>Haftung f&uuml;r Links</strong><br /> Unser Angebot enth&auml;lt Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb k&ouml;nnen wir f&uuml;r diese fremden Inhalte auch keine Gew&auml;hr &uuml;bernehmen. F&uuml;r die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf m&ouml;gliche Rechtsverst&ouml;&szlig;e &uuml;berpr&uuml;ft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.<br /> <strong>Urheberrecht</strong><br /> Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielf&auml;ltigung, Bearbeitung, Verbreitung und jede Art der Verwertung au&szlig;erhalb der Grenzen des Urheberrechtes bed&uuml;rfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur f&uuml;r den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.<br /><br /> <strong>Datenschutz</strong><br /> Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten m&ouml;glich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder eMail-Adressen) erhoben werden, erfolgt dies, soweit m&ouml;glich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdr&uuml;ckliche Zustimmung nicht an Dritte weitergegeben.<br /> Wir weisen darauf hin, dass die Daten&uuml;bertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitsl&uuml;cken aufweisen kann. Ein l&uuml;ckenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht m&ouml;glich.<br /> Der Nutzung von im Rahmen der Impressumspflicht ver&ouml;ffentlichten Kontaktdaten durch Dritte zur &Uuml;bersendung von nicht ausdr&uuml;cklich angeforderter Werbung und Informationsmaterialien wird hiermit ausdr&uuml;cklich widersprochen. Die Betreiber der Seiten behalten sich ausdr&uuml;cklich rechtliche Schritte im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch Spam-Mails, vor.<br /> <strong>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Google Analytics</strong><br /> Diese Website benutzt Google Analytics, einen Webanalysedienst der Google Inc. ("Google"). Google Analytics verwendet sog. "Cookies", Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website durch Sie erm&ouml;glichen. Die durch den Cookie erzeugten Informationen &uuml;ber Ihre Benutzung dieser Website werden in der Regel an einen Server von Google in den USA &uuml;bertragen und dort gespeichert. Im Falle der Aktivierung der IP-Anonymisierung auf dieser Webseite wird Ihre IP-Adresse von Google jedoch innerhalb von Mitgliedstaaten der Europ&auml;ischen Union oder in anderen Vertragsstaaten des Abkommens &uuml;ber den Europ&auml;ischen Wirtschaftsraum zuvor gek&uuml;rzt.<br /> Nur in Ausnahmef&auml;llen wird die volle IP-Adresse an einen Server von Google in den USA &uuml;bertragen und dort gek&uuml;rzt. Im Auftrag des Betreibers dieser Website wird Google diese Informationen benutzen, um Ihre Nutzung der Website auszuwerten, um Reports &uuml;ber die Websiteaktivit&auml;ten zusammenzustellen und um weitere mit der Websitenutzung und der Internetnutzung verbundene Dienstleistungen gegen&uuml;ber dem Websitebetreiber zu erbringen. Die im Rahmen von Google Analytics von Ihrem Browser &uuml;bermittelte IP-Adresse wird nicht mit anderen Daten von Google zusammengef&uuml;hrt.<br /> Sie k&ouml;nnen die Speicherung der Cookies durch eine entsprechende Einstellung Ihrer Browser-Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht s&auml;mtliche Funktionen dieser Website vollumf&auml;nglich werden nutzen k&ouml;nnen. Sie k&ouml;nnen dar&uuml;ber hinaus die Erfassung der durch das Cookie erzeugten und auf Ihre Nutzung der Website bezogenen Daten (inkl. Ihrer IP-Adresse) an Google sowie die Verarbeitung dieser Daten durch Google verhindern, indem sie das unter dem folgenden Link verf&uuml;gbare Browser-Plugin herunterladen und installieren: <a href="http://tools.google.com/dlpage/gaoptout?hl=de" target="_blank">http://tools.google.com/dlpage/gaoptout?hl=de</a>.<br /> <strong>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Google +1</strong><br /> Erfassung und Weitergabe von Informationen:<br /> Mithilfe der Google +1-Schaltfl&auml;che k&ouml;nnen Sie Informationen weltweit ver&ouml;ffentlichen. &uuml;ber die Google +1-Schaltfl&auml;che erhalten Sie und andere Nutzer personalisierte Inhalte von Google und unseren Partnern. Google speichert sowohl die Information, dass Sie f&uuml;r einen Inhalt +1 gegeben haben, als auch Informationen &uuml;ber die Seite, die Sie beim Klicken auf +1 angesehen haben. Ihre +1 k&ouml;nnen als Hinweise zusammen mit Ihrem Profilnamen und Ihrem Foto in Google-Diensten, wie etwa in Suchergebnissen oder in Ihrem Google-Profil, oder an anderen Stellen auf Websites und Anzeigen im Internet eingeblendet werden.<br /> Google zeichnet Informationen &uuml;ber Ihre +1-Aktivit&auml;ten auf, um die Google-Dienste f&uuml;r Sie und andere zu verbessern. Um die Google +1-Schaltfl&auml;che verwenden zu k&ouml;nnen, ben&ouml;tigen Sie ein weltweit sichtbares, &ouml;ffentliches Google-Profil, das zumindest den f&uuml;r das Profil gew&auml;hlten Namen enthalten muss. Dieser Name wird in allen Google-Diensten verwendet. In manchen F&auml;llen kann dieser Name auch einen anderen Namen ersetzen, den Sie beim Teilen von Inhalten &uuml;ber Ihr Google-Konto verwendet haben. Die Identit&auml;t Ihres Google-Profils kann Nutzern angezeigt werden, die Ihre E-Mail-Adresse kennen oder &uuml;ber andere identifizierende Informationen von Ihnen verf&uuml;gen.<br /><br /> Verwendung der erfassten Informationen:<br /> Neben den oben erl&auml;uterten Verwendungszwecken werden die von Ihnen bereitgestellten Informationen gem&auml;&szlig; den geltenden Google-Datenschutzbestimmungen genutzt. Google ver&ouml;ffentlicht m&ouml;glicherweise zusammengefasste Statistiken &uuml;ber die +1-Aktivit&auml;ten der Nutzer bzw. gibt diese an Nutzer und Partner weiter, wie etwa Publisher, Inserenten oder verbundene Websites.<br /> <strong>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Twitter</strong><br /> Auf unseren Seiten sind Funktionen des Dienstes Twitter eingebunden. Diese Funktionen werden angeboten durch die Twitter Inc., 795 Folsom St., Suite 600, San Francisco, CA 94107, USA. Durch das Benutzen von Twitter und der Funktion "Re-Tweet" werden die von Ihnen besuchten Webseiten mit Ihrem Twitter-Account verkn&uuml;pft und anderen Nutzern bekannt gegeben. Dabei werden auch Daten an Twitter &uuml;bertragen.<br /> Wir weisen darauf hin, dass wir als Anbieter der Seiten keine Kenntnis vom Inhalt der &uuml;bermittelten Daten sowie deren Nutzung durch Twitter erhalten. Weitere Informationen hierzu finden Sie in der Datenschutzerkl&auml;rung von Twitter unter <a href="http://twitter.com/privacy" target="_blank">http://twitter.com/privacy</a>.<br /> Ihre Datenschutzeinstellungen bei Twitter k&ouml;nnen Sie in den Konto-Einstellungen unter <a href="http://twitter.com/account/settings" target="_blank">http://twitter.com/account/settings</a> &auml;ndern.<br /> Quellenangaben: <a href="http://www.e-recht24.de/muster-disclaimer.htm" target="_blank">Disclaimer eRecht24</a>, <a href="http://www.e-recht24.de/artikel/datenschutz/6590-facebook-like-button-datenschutz-disclaimer.html" target="_blank">eRecht24 Facebook Datenschutzerkl&auml;rung</a>, <a href="http://www.google.com/intl/de_ALL/analytics/tos.html" target="_blank">Datenschutzerkl&auml;rung Google Analytics</a>, <a href="http://www.google.com/intl/de/+/policy/+1button.html" target="_blank">Google +1 Bedingungen</a>, <a href="http://twitter.com/privacy" target="_blank">Twitter Bedingungen</a></div>
</div>',
                    'last_mod' => '2017-03-22 21:39:16',
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'ueber-uns',
                    'title' => 'Über Uns - Hintergrund & Mission von foodsharing',
                    'body' => '<p><strong>Herzlich Willkommen bei foodsharing!<br></strong></p>
<p></p>
<p>Wir sind froh, dass Du den Weg zu uns gefunden hast und Du Dich gemeinsam mit tausenden anderen engagierten Menschen f&uuml;r das Ende der Lebensmittelverschwendung einsetzt.</p>
<p>foodsharing ist eine Initiative, um Foodsaver und BotschafterInnen zu organisieren, Lebensmittel von Lebensmittelbetrieben aller Art zu retten, die Internationalisierung von foodsharing voranzubringen, Veranstaltungen zum Thema zu organisieren uvm.</p>
<p></p>
<p>Seit Mai 2013 haben sich bereits &uuml;ber 20.000 ehrenamtliche Menschen, die etwas gegen die Lebensmittelverschwendung unternehmen wollen, angemeldet und tausende Freiwillige von ihnen retten schon aktiv in &uuml;ber. 2.700 Betrieben.</p>
<p>&Uuml;ber 500 BotschafterInnen koordinieren die Foodsaver und Freiwilligen in den jeweiligen Regionen, St&auml;dten und Bundesl&auml;ndern. Die Plattform foodsharing basiert zu 100% auf ehrenamtlichem und unentgeltlichem Engagement. Ein bundesweites Organisationsteam von 30 Menschen hat in jahrelanger Entwicklung das Konzept erarbeitet, verbessert und realisiert. Die einzige noch bezahlte Stelle ist der Minijob der Gesch&auml;ftsf&uuml;hrerin.</p>
<p></p>
<p>So wie das Konzept des Lebensmittelrettens wird auch die Plattform Open Source und kostenlos. Dank tausender Stunden genialer Programmierung von dem IT-Team um den geldfrei lebenden Raphael Wintrich aus K&ouml;ln konnte die Plattform foodsharing.de (fr&uuml;her auch lebensmittelretten.de) ohne jegliche Kosten entstehen. Die Idee ist, gemeinsam mit anderen ehrenamtlichen ProgrammiererInnen, DesignerInnen, &Uuml;bersetzerInnen, OrganisatorInnen usw. die Plattform stetig weiter zu entwickeln, zu optimieren und auszubauen.</p>
<p>Dank unserem &Ouml;ko-Webhosting-Partner manitu.de, der f&uuml;r die Kosten des Traffic aufkommt, werden die Server von foodsharing.de zu 100% mit Strom aus Wasserkraft versorgt. Unser gr&uuml;ner Webhosting-Partner Greensta.de tr&auml;gt die Kosten f&uuml;r die E-Mail-Konten sowie die Domain.</p>
<p></p>
<p>foodsharing.de ist kostenlos, nicht kommerziell und ohne Werbung und wird es auch bleiben. Wir versuchen, auf eine organische und auf Sicherheit bedachte Weise zu wachsen. Das hei&szlig;t, dass wir nicht m&ouml;glichst schnell m&ouml;glichst viele Kooperationen eingehen und Leute aufnehmen, sondern dass wir uns die Zeit nehmen, alles so gut wie m&ouml;glich zu machen, bevor wir den n&auml;chsten Schritt gehen. Wir freuen uns sehr, dass Du Dich auch f&uuml;r die Initiative "Ende der Lebensmittelverschwendung" engagieren m&ouml;chtest und freuen uns auf gute Zusammenarbeit.</p>
<p></p>
<p><strong>Alles Liebe w&uuml;nscht Dir das gesamte Team von foodsharing!</strong></p>',
                    'last_mod' => '2014-12-12 11:01:28',
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'partner',
                    'title' => 'Partner',
                    'body' => '<div class="partner"><img src="https://foodsharing.de//images/content/10-Logo-Bio-Company.jpg" name="/Webseiten/Partner/Logo-Bio-Company.jpg" class="logo" />
<p><strong>Bio Company:<br /></strong><a href="http://www.biocompany.eu" target="_blank">www.biocompany.eu<br /><br /></a></p>
<div class="clear"></div>
<p>Die Bio Company ist der erste&nbsp;Partner von foodsharing und hat schon&nbsp;im April&nbsp;2012 begonnen unverk&auml;ufliche Lebensmittel an die LebensmittelretterInnen in Berlin zu geben. Auch bei der Crowdfunding Kampagne f&uuml;r foodsharing unterst&uuml;tze die Bio Supermarkt Kette die Plattfrom mit&nbsp;2000&euro;. Mittlerweile kooperieren&nbsp;die meisten der 35 Filialen neben Tafeln, Vereinen und anderen Einrichtungen mit foodsharing, damit m&ouml;glichst keine Lebensmittel mehr in die Tonne m&uuml;ssen. Der Gesch&auml;ftsf&uuml;hrer Georg Kaiser, ebnete mit seinem Vertrauen und seinem Engagement, den Weg f&uuml;r das heutige Netzwerk von &uuml;ber 7500 Foodsavern die bei &uuml;ber 1000 Betrieben Lebensmitteln vor der Vernichtung bewahren.</p>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner">
<h3><img src="/images/content/manitu_600.png" width="422" class="logo" /></h3>
<p><strong>Manitu:</strong><br /><a href="http://www.manitu.de/" target="_blank">www.manitu.de</a></p>
<div class="clear"></div>
<p>Da wir mittlerweile schon &uuml;ber eine drei Millionen Seitenaufrufe hatten&nbsp;und tagt&auml;glich mehr Menschen die Plattform nutzen, haben wir uns nach einem neuen Partner umgeschaut und einen ganz vorbildlichen Betrieb gefunden der uns mit einem eigenem Server unterst&uuml;tzt. Manitu arbeitet seit Jahren ausschlie&szlig;lich mit Strom aus erneuerbaren Energien und setzt sich ganzheitlich mit einer ethischen Firmenphilosophie f&uuml;r Nachhaltigkeit und mehr Menschlichkeit ein.</p>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner">
<h3><img src="https://foodsharing.de//images/content/ABundD_Signe_2_Ansicht_RGB_01.jpg" name="/Webseiten/Partner/ABundD_Signe_2_Ansicht_RGB_01.jpg" class="logo" /></h3>
<p><strong>ab&amp;d Rechtsanw&auml;lte:</strong><a href="http://www.abd-partner.de/" target="_blank">www.abd-partner.de</a></p>
<div class="clear"></div>
<p>Tobias Bystry und seine Kanzlei ab&amp;d Rechtsanw&auml;lte unterst&uuml;tzen foodsharing seit Fr&uuml;hling&nbsp;2013&nbsp;mit einer&nbsp;pro Bono Hilfe in allen&nbsp;Rechtsfragen rund&nbsp;um:&nbsp;Fair-Teiler, Lebensmittelspenderbetrieben und sonstigen Vereinbarungen und Rechtsangelegenheiten.</p>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="https://foodsharing.de//images/content/greensta-logo_2011.png" name="/Webseiten/Partner/greensta-logo_2011.png" class="logo" />
<p><strong>Greensta &Ouml;ko Webhosting:</strong><br /><a href="http://www.greensta.de/" target="_blank">www.greensta.de</a></p>
<div class="clear"></div>
<p>Seit Beginn im Sommer 2013, unterst&uuml;tzt Greensta mit Greenpeace Energy&nbsp;laufenden Server die kostenlose Freiwilligen Plattform von foodsharing. Damit geh&ouml;rt die Unterst&uuml;tzung von dem 100% mit erneuerbaren Energien arbeitenden Firma Greensta, zum elementaren Fundament der Lebensmittelrettenden Bewegung die ausschlie&szlig;lich auf unendgeltlichen Engagment fu&szlig;t.<br />Neben dem kostenfreien Server, unterst&uuml;tzt unser Parnter Greensta unsere&nbsp;Iniatiative gegen die Verschwendung von Lebensmitteln mit der &Uuml;bernahme der Kosten f&uuml;r die Domain lebensmittelretten.de</p>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="http://media.lebensmittelretten.de/files/Logos%20von%20Partnern/Logo_dUD_Webadresse_Claim_rechts.jpg" class="logo" />
<p><strong>dieUmweltDruckerei</strong><br /><a href="http://www.dieUmweltDruckerei.de" target="_blank">www.dieUmweltDruckerei.de</a></p>
<div class="clear"></div>
<p>Als nachhaltige Druckerei setzen wir auf ressourcenschonende Materialien und eine emissionsarme Produktion von Printmedien. Wir verwenden ausschlie&szlig;lich Recyclingpapiere. Bei den von uns eingesetzten veganen Druckfarben sind mineral&ouml;lhaltige Bestandteile weitestgehend durch Zutaten auf Basis nachwachsender Rohstoffe ersetzt. Wir arbeiten mit Strom aus erneuerbaren Energien. Alle unvermeidbaren CO2-Emissionen, die im gesamten Druckprozess und beim Versand entstehen, kompensieren wir und unsere Partner durch Investitionen in Klimaschutzprojekte.</p>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="https://foodsharing.de//images/content/PP%20Logo.jpg" width="170" name="/Webseiten/Partner/PP Logo.jpg" class="logo" />
<p><strong>Planet Friendly Printing:</strong><br /><a href="http://www.print-pool.com" target="_blank">www.print-pool.com</a></p>
<div class="clear"></div>
<p>Print Pool ist eine der &ouml;koligischsten Druckereien in Deutschland und unser starker Partner f&uuml;r den Printbereich.&nbsp;</p>
<p>Verantwortung f&uuml;r Umwelt-Themen und Schonung von Ressourcen bilden das Fundament dieser nachhaltigen Druckerei beim umweltfreundlichen Drucken. Flyer aus Recyclingpapier oder Visitenkarten aus FSC-Mix geh&ouml;ren zum nachhaltigen Standard. Gedruckt wird&nbsp;mit mineral&ouml;lfreien Druckfarben auf Pflanzen&ouml;lbasis. Die verwendeten Bindeleime sind kasein- und gelatinefrei und entsprechen veganen Standards.</p>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="http://media.lebensmittelretten.de/files/Logos%20von%20Partnern/govinda-logo-500px.png" width="140" class="logo" />
<p><strong>Govinda Natur&nbsp;GmbH:</strong><br /><a href="http://www.govindanatur.de" target="_blank">www.govindanatur.de</a></p>
<div class="clear"></div>
<p>Die Unternehmensphilosophie von Govinda Natur basiert auf der Wertsch&auml;tzung von Mensch und Umwelt. Geleitet von der Idee einer Kreislaufwirtschaft bem&uuml;ht sich der Naturkosthersteller um eine nachhaltige und ressourcenschonende Erzeugung der Produkte. Das Unternehmen engagiert sich seit vielen Jahren in Fair Trade Initiativen und unterst&uuml;tzt soziale und &ouml;kologische Projekte im In- und Ausland. Foodsharing f&ouml;rdert einen verantwortungsvollen Umgang mit Lebensmitteln und setzt sich aktiv gegen Lebensmittelverschwendung ein. Govinda Natur ist von der vorbildlichen Arbeit tief beeindruckt und unterst&uuml;tzt die Initiative sehr gerne mit Lebensmitteln.</p>
<div class="shortcode-spacer-1">&nbsp;</div>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="https://foodsharing.de//images/content/beiersdorf.png" class="logo" />
<p><strong>Beiersdorf AG:</strong><br /><a href="http://www.beiersdorf.de" target="_blank">www.beiersdorf.de</a></p>
<div class="clear"></div>
<p>Die Beiersdorf AG stieg unter dem Motto &bdquo;We care, you share&ldquo; als erstes Gro&szlig;unternehmen in die Zusammenarbeit mit Foodsharing e. V. ein. Die Initiative von Beiersdorf gr&uuml;ndet auf der Umsetzung der Nachhaltigkeitsstrategie &bdquo;We care.&ldquo; und unterst&uuml;tzt verantwortungsvolle Ressourcennutzung. Seit Juni 2013 spendet Beiersdorf regelm&auml;&szlig;ig nicht verbrauchte Speisen aus dem Hamburger Betriebsrestaurant &ndash; vom Auberginenmus bis zur Zitronencreme &ndash; an soziale Einrichtungen der Hansestadt und lebt vor, wie die Vermeidung von &Uuml;berproduktion im Catering und der Gemeinschaftsversorgung funktionieren kann.</p>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="https://foodsharing.de//images/content/gekko.png" width="195" name="/Webseiten/Partner/gekko.png" class="logo" />
<p><strong>Gekko Getr&auml;nke- &amp; Handelskollektiv:</strong><br /><a href="http://www.gekko-berlin.de" target="_blank">www.gekko-berlin.de </a></p>
<div class="clear"></div>
<p>Gekko setzt sich&nbsp;seit dem Start von foodsharing gegen die Verschwendung von noch genie&szlig;baren Getr&auml;nken ein. &Uuml;ber ein Duzend Paletten Getr&auml;nke konnten so schon seit Beginn der Kooperation vor der Vernichtung bewahrt werden.<br />Gekko&nbsp;arbeitet mit verschiedenen Getr&auml;nkeherstellern zusammen, wobei die Gro&szlig;zahl der&nbsp;Partner kleine bzw. Kleinsthersteller oder Unternehmensgr&uuml;nder sind, die regional, biologisch oder per Handherstellung produzieren, kollektiv arbeiten, oder fair handeln.</p>
<div class="shortcode-spacer-1">&nbsp;&nbsp;</div>
</div>
<div class="partner"><img src="https://foodsharing.de//images/content/SBM_Logo_RGB-300dpi_Projektionen%20u.%20HOMEPAGE.jpg" name="/Webseiten/Partner/SBM_Logo_RGB-300dpi_Projektionen u. HOMEPAGE.jpg" class="logo" />
<h3></h3>
<p><strong>Super Bio Markt:</strong><br /><a href="http://www.superbiomarkt.de" target="_blank">www.superbiomarkt.de</a></p>
<div class="clear"></div>
<p><span>Als Naturkostfachh&auml;ndler mit tief verwurzelten &ouml;kologischen Werten ist es Teil der Unternehmensphilosophie der&nbsp;</span><span>SuperBioMarkt</span><span>&nbsp;AG, sich gegen die Verschwendung von Lebensmitteln einzusetzen. Neben weiteren Ma&szlig;nahmen in diesem Bereich kooperiert das Unternehmen seit Anfang 2014 mit den foodsharing. Nach einer erfolgreichen Pilotphase in verschiedenen St&auml;dten wird nun die Zusammenarbeit schrittweise auf s&auml;mtliche M&auml;rkte</span><span>&nbsp;ausgeweitet. Au&szlig;erdem unterst&uuml;tzen wir verschiedene Fair-Teiler mit&nbsp;</span><span>kostenlosen K&uuml;hlger&auml;ten.</span></p>
<p></p>
<div class="shortcode-spacer-1">&nbsp;</div>
</div>
<div class="partner"><br />
<h3><img src="/images/content/psw.png" width="325" /></h3>
<p><strong>PSW GROUP:</strong><br /><a href="http://www.psw-group.de" target="_blank">www.psw-group.de</a></p>
<div class="clear"></div>
<p>Bereits seit vielen Jahren engagiert sich die&nbsp;PSW&nbsp;GROUP aktiv f&uuml;r soziale Projekte. Wichtig ist es uns hierbei, sowohl regional als auch deutschlandweit soziale Verantwortung zu &uuml;bernehmen und Entwicklungen zu f&ouml;rdern. Als Unternehmen welches seit September 2000 erfolgreich als Experte f&uuml;r Internet-Security &uuml;berzeugt, sehen wir es als unsere Pflicht an effektive Projekte zu unterst&uuml;tzen die langfristig und zielbewusst angelegt sind.</p>
<div class="shortcode-spacer-1">&nbsp;</div>
</div>
<div class="partner"><img src="https://foodsharing.de//images/content/555184_508663249174838_916437538_n.jpg" name="/Webseiten/Partner/555184_508663249174838_916437538_n.jpg" class="logo" />
<p><strong>Erdkorn:<br /></strong><a href="http://www.erdkorn.de" target="_blank">www.erdkorn.de</a></p>
<div class="clear"></div>
<p>Die Biomarktkette Erdkorn stellt Lebensmittel, Fr&uuml;chte und Gem&uuml;se, die aufgrund des abgelaufenen Mindesthaltbarkeitsdatums bzw. mangelnder Frische in einer Filiale nicht mehr verkauft werden, Foodsavern zum Fairteilen und Verwerten zur Verf&uuml;gung. Die meisten der deutschlandweit 9 Filialen kooperieren bereits. Hier&nbsp;&auml;u&szlig;ert sich Erdkorn zur Zusammenarbeit und ihrem Engagement gegen die Verschwendung von Lebensmitteln.&nbsp;<a href="http://www.erdkorn.de/cms/index.php/soziale-verantwortung/654-foodsharingde" target="_blank">Link</a></p>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="https://foodsharing.de//images/content/2-lemonaid-charitea-logo.jpg" name="/Webseiten/Partner/lemonaid-charitea-logo.jpg" class="logo" />
<h3></h3>
<p><strong>LemonAid:</strong><br /><a href="http://www.lemonaid.de" target="_blank">www.lemonaid.de </a></p>
<div class="clear"></div>
<div>Lemonaid &amp; ChariTea machen Fairtrade-Limonaden &amp; Eistees aus nat&uuml;rlichen Zutaten. Mit jeder verkauften Flaschen unterst&uuml;tzen sie Entwicklungsprojekte in den Anbauregionen.</div>
<div>Sie helfen foodharing seit Beginn des Projektes im Jahre 2012 mit der kostenfreien Bereitstellung von K&uuml;hlschr&auml;nken f&uuml;r verschiedene&nbsp;Fair-Teiler in ganz Deutschland.</div>
<div class="shortcode-spacer-1">&nbsp;</div>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="http://media.lebensmittelretten.de/files/Logos%20von%20Partnern/KL_Logo_Claim_sRGB_DE.png" width="140" name="/Webseiten/Partner/kaufland-logo.jpg" class="logo" />
<h3></h3>
<p><strong>Kaufland:</strong><br /><a href="http://www.kaufland.de" target="_blank">www.Kaufland.de </a></p>
<div class="clear"></div>
<div>Die &Uuml;bernahme von &ouml;kologischer und sozialer Verantwortung ist f&uuml;r Kaufland wichtiger Bestandteil der Unternehmenspolitik. Dies beginnt bei einer verantwortungsvollen Gestaltung des Sorti- ments und setzt sich mit dem Engagement f&uuml;r gesellschaftliche und &ouml;kologische Belange fort. Ein besonderes Anliegen ist Kaufland der verantwortungsvolle Umgang mit Lebensmitteln, wozu auch die Vermeidung von Lebensmittelabf&auml;llen geh&ouml;rt. Gemeinsam mit foodsharing engagiert sich Kaufland daher aktiv gegen Lebensmittelverschwendung.</div>
<div class="shortcode-spacer-1">&nbsp;</div>
</div>
<div class="partner"><img src="https://foodsharing.de//images/content/Aronia.jpg.png" name="/Webseiten/Partner/Aronia.jpg.png" class="logo" />
<h3><strong><br /></strong><strong>Aronia Original</strong><strong><br /></strong></h3>
<p><a href="http://www.aronia-original.de" target="_blank">www.aronia-original.de</a></p>
<div class="clear"></div>
<p>Das junge&nbsp;Bio Unternehmen m&ouml;chte keine S&auml;fte, Nahrungserg&auml;nzungsmitteln usw. wegschmei&szlig;en und freut sich &uuml;ber die Zusammenarbeit mit den Lebensmittelrettenden, damit alle noch genie&szlig;baren Waren dort landen, wohin sie geh&ouml;ren.</p>
<div class="shortcode-spacer-1">&nbsp;</div>
</div>
<div class="partner"><img src="https://foodsharing.de//images/content/budni_300.jpg" width="170" class="logo" />
<h3></h3>
<p><strong>Budni Bio Markt:</strong><br /><a href="http://www.budni.de" target="_blank">www.budni.de </a></p>
<div class="clear"></div>
<div>Das Hamburger Drogeriemarktunternehmen BUDNIKOWSKY unterst&uuml;tzt die Initiative Lebensmittelretten gerne mit Lebensmittelspenden aus verschiedenen BUDNI-Filialen. Mehr zu BUDNIs Engagement: <a href="http://www.budni.de/gutes-tun" target="_blank">http://www.budni.de/gutes-tun</a></div>
<div class="shortcode-spacer-1">&nbsp;</div>
</div>
<div class="partner">
<p><strong>Reformhaus Engelhardt:</strong><br /><a href="http://www.reformhaus-engelhardt.de" target="_blank">www.reformhaus-engelhardt.de</a></p>
<div class="clear"></div>
<div>Ein verantwortungsbewusster Umgang mit Ressourcen ist in unserer Unternehmensphilosophie fest verankert. Wir integrieren diesen Gedanken in unserer t&auml;glichen Arbeit und richten unsere Entscheidungen fest danach aus. Das Projekt foodsharing erf&auml;hrt unsere Unterst&uuml;tzung, weil es auf die Bedeutsamkeit von Lebensmitteln aufmerksam macht und ihnen besondere Wertsch&auml;tzung entgegenbringt. Das gro&szlig;artige soziale und nachhaltige Engagement, welches die Beteiligten aufbringen ist au&szlig;erordentlich und sollte eine weitaus gr&ouml;&szlig;ere gesellschaftliche Anerkennung erfahren als bisher. Wir freuen uns auch weiterhin den gemeinsamen Gedanken weiterzutragen und die Projektentwicklung durch unsere Beitr&auml;ge zu begleiten. In unseren Gesch&auml;ften werden foodsharing auch in Zukunft die T&uuml;ren offen sein.</div>
<div class="shortcode-spacer-1">&nbsp;</div>
</div>
<div class="partner">
<p><strong>Ethiquable:</strong><br /><a href="http://www.ethiquable.de" target="_blank">www.ethiquable.de</a></p>
<div class="clear"></div>
<div>Ethiquable ist eine Genossenschaft die sich ganzheitlich um einen fairen, ethischen Umgang mit Menschen, Tieren und Ressourcen bem&uuml;ht. Dabei ist den Menschen von Ethiquable auch wichtig, keine Lebensmittel wegzuschmei&szlig;en und achten darauf, r&uuml;cksichtsvoll und nachhaltig mit den Erzeugnissen umzugehen. Bleibt mal was &uuml;brig, was sich nicht mehr verkaufen l&auml;sst, werden die Lebensmittel an die Mitarbeitenden bzw. an foodsharing verschenkt.</div>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="https://foodsharing.de//images/content/badgematic_300.jpg" class="logo" />
<p><strong>Badgematic:<br /></strong><a href="http://www.badgematic.de/" target="_blank">www.badgematic.de</a></p>
<div class="clear"></div>
<p>Die Badgematic Button GmbH vertreibt alle n&ouml;tigen Materialien rund um die (eigene) Buttonherstellung und spendete f&uuml;r das Internationale Treffen erstmals 500 Buttonrohlinge, damit sich Foodsaver unterwegs auch wiedererkennen k&ouml;nnen. So sind sie seit April 2015 Partner von foodsharing und wir danken herzlich f&uuml;r die Unterst&uuml;tzung!</p>
</div>
<div class="shortcode-spacer-1">&nbsp;</div>
<div class="partner"><img src="https://foodsharing.de/images/content/s4f_300.png" width="250" class="logo" />
<p><strong>Share4Friends:<br /></strong><a href="http://goo.gl/WfPeVJ" target="_blank">Share4Friends<br /><br /></a></p>
<div class="clear"></div>
<p>Hast Du au&szlig;er Lebensmittel andere Sachen, die Du teilen oder verschenken m&ouml;chtest?<br /> Was Du nicht mehr brauchst, macht andere Menschen gl&uuml;cklich!</p>
</div>
<div class="partner"><img src="/img/partner/tictex.png" width="272" />
<p><strong>TicTex:</strong></p>
<p><a href="http://www.tictex.com/?pk_campaign=foodsharing&amp;pk_kwd=foodsharing&amp;utm_source=foodsharing&amp;utm_medium=foodsharing&amp;utm_campaign=foodsharing" target="_blank">www.tictex.com</a></p>
<p><br />TicTex ist&nbsp;der Onlineshop&nbsp;f&uuml;r Basic-Fashion und Textilveredelung. <br />Entgegen dem Trend der schnelllebigen Mode vertreiben wir Basics, die nicht nach 3 Monaten aussortiert werden, weil sie nicht mehr \'in\' sind.<br />Ganz besonders freut es uns, verst&auml;rkt Hersteller im Sortiment zu haben, die auf faire Produktion, Recycling und Biobaumwolle Wert legen &ndash; wie zum Beispiel EarthPositive und Salvage.<br />foodsharing unterst&uuml;tzen wir mit Textilien f&uuml;r Veranstaltungen und Promotionzwecke, weil wir daran glauben, dass Nachhaltigkeit mehr als ein Schlagwort sein sollte.</p>
<br />&nbsp;</div>
<div class="shortcode-spacer-1"></div>
<div class="partner"><img src="/img/partner/myey.gif" width="422" class="logo" />
<p><strong>MyEy:<br /></strong><a href="http://www.myey.info/" target="_blank">www.myey.de</a></p>
<div class="clear"></div>
<p>MyEy ist die wertvolle Alternative zu tierischem Ei beim Backen, Braten und Kochen. Im Jahr 2014 erhielt MyEy den peta progress award als "richtungsweisendes vorbildliches Unternehmen" mit seinen "fortschrittlichen Produkten f&uuml;r einen ethischen Lebensstil." Der Ei-Ersatz von MyEy ist nicht nur AUFschlagbar, sondern dar&uuml;ber hinaus auch noch VEGAN-zertifiziert und BIO-zertifiziert. Vegane Produkte sind die Grundlage f&uuml;r einen verantwortungsvollen Umgang mit Ressourcen auf unserem Planeten, daher unterst&uuml;tzen wir gerne das Projekt foodsharing.de.</p>
</div>
<div class="shortcode-spacer-1"></div>
<div class="partner"><img src="/img/partner/vetzi.jpg" width="118" class="logo" />
<p><strong>VETZI:<br /></strong><a href="http://www.vegane-schnitzel-selber-machen.de/" target="_blank">www.vetzi.de</a></p>
<div class="clear"></div>
<p>Nachhaltigkeit und ein bewusster und fairer Umgang mit Lebensmitteln sind ein wichtiger Teil der veganen Bewegung! Diese Ideen motivieren auch uns. Deswegen unterst&uuml;tzen wir von VETZI &ndash; "vegane Schnitzel selber machen" die Foodsharing Initiative. Ihr leistet einen unsch&auml;tzbaren Beitrag gegen Lebensmittelverschwendung und f&uuml;r eine soziale und &ouml;kologische Herangehensweise an das Thema Essen. Es ist inspirierend und ermutigend zu sehen wie viel schon in so kurzer Zeit erreicht wurde! Macht weiter so!</p>
</div>
<div class="shortcode-spacer-1"></div>
<div class="partner"><img src="/img/partner/byodo.jpg" width="275" class="logo" />
<p><strong>Byodo:<br /></strong><a href="http://www.byodo.de/" target="_blank">www.byodo.de</a></p>
<div class="clear"></div>
<div class="clear"><span>Bio-Qualit&auml;t, die man schmeckt, riecht, auf dem Gaumen f&uuml;hlt und genie&szlig;t &ndash; daf&uuml;r steht die Byodo Naturkost GmbH. Seit mehr als 30 Jahren stellt das inhabergef&uuml;hrte Unternehmen mit Sitz in M&uuml;hldorf am Inn Bio-Feinkost in h&ouml;chster 100% Bio-Qualit&auml;t und mit bestem Geschmack her. Die Produkte werden nur &uuml;ber den Bio-Fachhandel und Online-Shop vertrieben. Unsere Ressourcen sind kostbar und kein Lebensmittel sollte verschwendet werden. Daher unterst&uuml;tzen wir die wertvolle Arbeit von Foodsharing sehr gerne.</span></div>
<p></p>
</div>
<div class="shortcode-spacer-1"></div>
<div class="partner"><img src="/img/partner/klintec.jpg" width="337" class="logo" />
<p><strong>Klin-Tec:</strong> <br /><a href="http://klin-tec.de/" target="_blank">www.klin-tec.de</a></p>
<div class="clear"></div>
<p>Die Marke KLIN-TEC&reg; steht f&uuml;r einen vorausschauenden und verantwortungsbewussten Umgang mit unserem wichtigsten Rohstoff Wasser. Auch in Zukunft muss jeder Mensch freien Zugang zu sauberem, trinkf&auml;higem Wasser haben. Um hierf&uuml;r nicht noch mehr Tonnen von Plastikflaschen produzieren zu m&uuml;ssen und die Umwelt weiter zu belasten, haben wir den KLIN-TEC&reg; Wasserfilter entwickelt. Wir unterst&uuml;tzen die Veranstaltungen des &sbquo;foodsharing-Projekts&lsquo; sehr gerne mit unseren Produkten.</p>
</div>
<div class="shortcode-spacer-1"></div>
<div class="partner">
<p><strong>Landlinie:</strong> <br /><a href="http://www.landlinie.de/" target="_blank">www.landlinie.de</a></p>
<div class="clear"></div>
<p>Die LANDLINIE Lebensmittel&ndash;Vertrieb GmbH mit Sitz in H&uuml;rth bei K&ouml;ln ist ein Lebensmittel&ndash;Gro&szlig;handel f&uuml;r biologisch erzeugte Produkte und Spezialist im Bio Obst&ndash; und Gem&uuml;se-Bereich. Wir sind seit &uuml;ber 25 Jahren erfolgreich deutschlandweit t&auml;tig, seit 1991 Demeter Vertragsh&auml;ndler. Wir beliefern ca. 500 Kunden regelm&auml;&szlig;ig mit einer Auswahl von rund 3.000 Lebensmitteln durch unseren eigenen Fuhrpark und Logistik&ndash;Partner. Eine punktgenaue Lieferung, eine optimale Beratung durch unsere Mitarbeiter im Au&szlig;en&ndash; und Innendienst sowie die Qualit&auml;t unserer Bio-Produkte bilden die Basis unseres Erfolges.</p>
</div>
<div class="shortcode-spacer-1"></div>
<div class="partner">
<p><strong>Prime Inventions:</strong> <br /><a href="http://www.prime-inventions.de/" target="_blank">www.prime-inventions.de</a></p>
<div class="clear"></div>
<p>Prime Inventions entwickelt und vertreibt weltweit innovative Produkte rund um das Thema sauberes Wasser. Unter den eigenen eingetragenen Marken Aquawhirler, AquaKalko, AquaAvanti und YaraOvi sind die Produkte weltweit bekannt. Es ist Prime Inventions ein besonderes Anliegen Nutzer zu helfen ihr eigenes Wasser vor Ort zur filtern und damit kostbare Ressourcen zu sparen und unn&ouml;tigen Abfall zu vermeiden. Prime Inventions setzt sich ebenso f&uuml;r foodsharing ein und freut sich &uuml;ber jedes gerettete Lebensmittel und hat dies sogar ins Firmenleitbild mit aufgenommen.</p>
</div>
<div class="shortcode-spacer-1"></div>
<div class="partner"><img src="http://media.lebensmittelretten.de/files/Logos%20von%20Partnern/Barnhouse%20Logo%20neu%20color.jpg" width="337" class="logo" />
<p><strong>Barnhouse:</strong> <br /><a href="http://www.barnhouse.de/" target="_blank">www.barnhouse.de</a></p>
<div class="clear"></div>
<p>Seit unserer Firmengr&uuml;ndung vor 36 Jahren sind wir zu 100% dem Bio-Gedanken bei der Herstellung unserer Krunchys verpflichtet. F&uuml;r uns ist ein biologisch erzeugtes Produkt immer noch das bestm&ouml;gliche aller Lebensmittel &ndash; nie nur Trend oder Mode oder eine M&ouml;glichkeit, schnell Geld zu verdienen. Diese Achtung vor Nahrungsmitteln findet sich auch bei Foodsharing.</p>
</div>
<div class="shortcode-spacer-1"></div>
<div class="partner"><img src="http://media.lebensmittelretten.de/files/Logos von Partnern/naturgut logo.png" width="272" />
<p><strong>Naturgut: <br /><a href="http://www.naturgut.net" target="_blank">www.naturgut.net</a></strong></p>
<p></p>
<p>NATURGUT ist der f&uuml;hrende Anbieter von Bio-Produkten in Stuttgart und Umgebung. Die 11 Filialen werden t&auml;glich mit frischer Ware beliefert - wann immer m&ouml;glich saisonal und regional. Es gibt 75 regionale Lieferanten, zu denen eine langj&auml;hrige Partnerschaft besteht. Der Bio-Supermarkt wei&szlig; die M&ouml;glichkeit sehr zu sch&auml;tzen, dass noch gute, aber nicht mehr verkaufbare Lebensmittel nicht in die Tonne wandern m&uuml;ssen, sondern &uuml;ber Foodsharing noch verteilt und gegessen werden k&ouml;nnen. So k&ouml;nnen hochwertige Bio-Produkte auf weiterem Wege interessierten Menschen nahe gebracht werden.</p>
<br />&nbsp;</div>
<div class="shortcode-spacer-1"></div>
<div class="partner"><img src="http://media.lebensmittelretten.de/files/Logos%20von%20Partnern/Bildschirmfoto 2016-07-05 um 17.50.00.png" width="372" />
<p><strong>Sticker-Ticker.de:<br /></strong><a href="http://www.sticker-ticker.de/" target="_blank">www.Sticker-Ticker.de</a></p>
<p><br />Da wir selber in der Foodsharing Community aktiv sind, lag es f&uuml;r uns nahe, das Projekt auch mit Aufklebern tatkr&auml;ftig zu unterst&uuml;tzen. Generell ist bei uns ein verantwortungsbewusster Umgang mit allen Ressourcen selbstverst&auml;ndlich. Zudem verwenden wir fast ausschlie&szlig;lich Verpackungsmaterialen von befreundeten Unternehmen wieder, was nicht nur g&uuml;nstiger, sondern (ganz &auml;hnlich wie das Foodsharing) &auml;u&szlig;erst sinnvoll ist!</p>
<strong></strong></div>
<div class="partner"><a href="http://www.drucknatuer.ch" target="_blank"><img src="http://www.drucknatuer.ch/bundles/webmanufaktursitedrucknatuer/images/logo.svg" width="400" /></a><br /><strong>Drucknat&uuml;r</strong><br /> Drucknat&uuml;r.ch ist der Drucksachen-Webshop von Druckform (www.Leidenschaft.ch). Seit der Gr&uuml;ndung von Druckform (1997) ist die &ouml;kologische Produktion der Hauptpfeiler in unserer Ausrichtung. VOC-freie Reinigungsmittel und Druckfarben auf pflanzlicher Basis sowie Recycling-Papiere setzen wir seit Beginn ein. Wir produzieren alle unsere Drucksachen klimaneutral und kompensieren unseren nicht vermeidbaren CO2-Ausstoss mit Solafrica als Partner. Die Menschen, die sich f&uuml;r das Projekt engagieren, kennen wir pers&ouml;nlich. Die Organisation ist klein aber fein, genau wie wir. Interessante weiterf&uuml;hrende Infos auf:&nbsp;<a href="http://www.Solafrica.ch" target="_blank">www.Solafrica.ch</a> / <strong></strong><a href="http://www.drucknatuer.ch/" target="_blank">www.drucknatuer.ch/</a></div>
<div class="partner"><a href="http://www.galerieslafayette.de/" target="_blank"><img src="http://static.galerieslafayette.com/media/endeca2/header/logo-galeries-lafayette-16092015.png" width="400" /></a><br /> <strong>Galeries Lafayette</strong><br /><a href="http://www.galerieslafayette.de/" target="_blank">www.galerieslafayette.de<br /><br /></a>Seit 1996 kommt auch Berlin in den Genuss franz&ouml;sischer Delikatessen &ndash; bei Galeries Lafayette in der Friedrichstra&szlig;e im Herzen der Hauptstadt. Hier ist die erste und auch die einzige deutsche Dependance beheimatet &ndash; und l&auml;ngst zu einem beliebten Treffpunkt aller Gourmets geworden. <br /> Die Kooperation mit Foodsharing besteht seit Anfang 2016. Seitdem werden t&auml;glich Obst, Gem&uuml;se, Feinkost, Backwaren und viele weitere K&ouml;stlichkeiten vor der Tonne gerettet und vor allem an soziale Abgabestellen weitergegeben. So freuen sich beispielsweise die Diakonie Neuk&ouml;lln, die Bahnhofsmission, diverse Fl&uuml;chtlingsheime und die Obdachlosen am Alex immer wieder &uuml;ber die Delikatessen, die von Galeries Lafayette gespendet wurden.</div>
<div class="partner"><a href="http://www.cap-markt.de//" target="_blank"><img src="http://www.cap-markt.de/fileadmin/user_upload/caplogo.png" width="400" /></a><br /><strong>CAP-Lebensmittelm&auml;rkte</strong><br /><a href="http://www.cap-markt.de/" target="_blank">www.cap-markt.de</a> | <a href="http://www.nintegra.de/" target="_blank">NintegrA gGmbH</a> | <a href="http://www.neuearbeit.de/" target="_blank">Neue Arbeit gGmbH<br /><br /></a>Seit September 2016 unterst&uuml;tzen die CAP-Lebensmittelm&auml;rkte der NintegrA gGmbH und des Sozialunternehmens Neue Arbeit GmbH die Initiative Foodsharing e.V. Bereits seit &uuml;ber zehn Jahren liefern die CAP-M&auml;rkte Lebensmittel mit sehr kurzem Mindesthaltbarkeitsdatum an die Tafeln der Region. Mit der Zusammenarbeit von CAP und Foodsharing e.V. gelingt es nun fast vollst&auml;ndig, auf das Wegwerfen von Lebensmitteln zu verzichten. <br />Als diakonisches Unternehmen verpflichtet uns unser Satzungsauftrag zur Bewahrung der Sch&ouml;pfung und damit einhergehend, alles Erdenkliche gegen Lebensmittelverschwendung zu tun. In unseren M&auml;rkten arbeiten mit einem Anteil von mindestens 40 Prozent Menschen mit einer Schwerbehinderung. <br /> Unser sozialer Auftrag wird durch die Kooperation mit Foodsharing e.V. damit &ouml;kologisch in idealer Weise erg&auml;nzt.</div>
<div class="partner"><a href="https://www.bmbf.de/" target="_blank"><img src="http://waldorfweb.net/prototype/bmbf.png" /></a> <br /><strong>Bundesministerium f&uuml;r Bildung und Forschung</strong><br /><a href="https://www.bmbf.de/" target="_blank">www.bmbf.de</a></div>
<div class="shortcode-spacer-1"></div>
<p><br /><br /><br /></p>
<div class="partner"><a href="https://prototypefund.de/" target="_blank"><img src="http://waldorfweb.net/prototype/p.png" /></a> <br /><strong>Prototype Fund</strong><br /> <a href="https://prototypefund.de/" target="_blank">www.prototypefund.de</a></div>
<div class="partner"><a href="http://www.hobbybrauerversand.de/" target="_blank"><img src="http://www.hobbybrauerversand.de/bilder/intern/shoplogo/jtlshoplogo.png" /></a> <br /><strong>Hopfen und mehr</strong><br /> <a href="http://www.hobbybrauerversand.de/" target="_blank">http://www.hobbybrauerversand.de/</a><br /> Bio-Zertifikat - Umweltschutz lebt vom mitmachen - Unser Partner - Hopfen und mehr - spendet uns regelm&auml;ssig Malzs&auml;cke zum hygienischen und umweltfreundlichen Verpacken von geretteten Lebensmitteln.</div>
<p>.<br /><br /><br />.</p>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>
<div class="shortcode-spacer-1"></div>',
                    'last_mod' => '2017-04-14 15:34:42',
                ),
            10 =>
                array (
                    'id' => 11,
                    'name' => 'statistik',
                    'title' => 'Statistik',
                    'body' => '
<div>{STAT_GESAMT}</div>
<div class="shortcode-spacer-1">&nbsp;</div>
',
                    'last_mod' => '2014-02-21 19:48:43',
                ),
            11 =>
                array (
                    'id' => 12,
                    'name' => 'quiz-description',
                    'title' => 'Anleitung Quiz',
                    'body' => '<ul><li>Fragen und Antworten sorgf&auml;ltig durchlesen</li>
<li>Die (Deiner Meinung nach richtigen) Antworten durch draufklicken ausw&auml;hlen (mehrere Antworten k&ouml;nnen richtig sein)</li>
<li>Nach dem Beantworten der Frage, bekommst Du eine Zwischenauswertung mit Erkl&auml;rung zu den jeweiligen Antworten, was Dir dabei hilft zu verstehen, was warum richtig oder falsch ist.&nbsp;Lies Dir bitte alle Erkl&auml;rungen sorgf&auml;ltig durch und hinterlasse einen&nbsp;Kommentar, wenn etwas unlogisch, nicht verst&auml;ndlich oder der gleichen vorkommt.</li>
<li>Am Ende bekommst Du direkt ein Feedback, ob Du bestanden hast, welche Fehler Du wo genau gemacht hast und kannst noch mal in Ruhe&nbsp;die Begr&uuml;ndungen dazu durchlesen.</li>
</ul><p></p>',
                    'last_mod' => '2014-11-26 17:44:24',
                ),
            12 =>
                array (
                    'id' => 13,
                    'name' => 'quiz-failed',
                    'title' => 'Du hast es leider nicht geschafft',
                    'body' => '<p>nein leider nicht...</p>',
                    'last_mod' => '2014-07-05 16:39:32',
                ),
            13 =>
                array (
                    'id' => 14,
                    'name' => 'confirm-fs',
                    'title' => 'Bestätigung Foodsaver',
                    'body' => '<p>Herzlichen Gl&uuml;ckwunsch, Du hast das Quiz zum Foodsaver bestanden!</p>
<p><span>Um das Upgrade abzuschlie&szlig;en, gehe bitte bis zum Ende der Seite und best&auml;tige, dass Du die Rechtsvereinbarung gelesen und akzeptiert hast. Mit einem Klick auf Best&auml;tigen wirst Du dann zum Foodsaver.</span></p>
<p><span>W&auml;hle einen Bezirk aus und der/die f&uuml;r dich zust&auml;ndige&nbsp;</span>BotschafterIn wird sich innerhalb der n&auml;chsten Tage mit Dir in Verbindung setzen.</p>
<p>Zun&auml;chst werden die 3 Einf&uuml;hrungsabholungen (<a href="http://wiki.lebensmittelretten.de/Einf%C3%BChrungsabholungen)" target="_blank">http://wiki.lebensmittelretten.de/Einf%C3%BChrungsabholungen)</a>&nbsp;gemacht, daf&uuml;r schl&auml;gt der/die&nbsp;jeweilige BotschafterIn bzw. Vertrauensperson Termine f&uuml;r die Abholungen vor, die rechtzeitig (min. 24 Stunden) vor dem Termin von Dir best&auml;tigt werden. Du wirst dann&nbsp;informiert, wann und wo man sich trifft und wie man sich erkennt.&nbsp;</p>
<p>Teile weiter Deine &uuml;bersch&uuml;ssigen Lebensmittel,&nbsp;schau Dich auf der Karte um, lerne andere Foodsaver kennen, besuche Fair-Teiler und lese Dich weiter ins Wiki ein!</p>
<p>Sollte sich der oder die BotschafterIn von Dir nicht melden, suche auf der Karte nach den n&auml;chsten BotschafterInnen und schreibe sie an.</p>
<p></p>
<p>Willkommen&nbsp;in der Welt des Lebensmittelrettens! Viele Freude bei allem und auf einen guten Start!</p>
<p>Herzlich&nbsp;das&nbsp;gesamte foodsharing Team</p>',
                    'last_mod' => '2015-03-06 01:10:12',
                ),
            14 =>
                array (
                    'id' => 15,
                    'name' => 'confirm-bip',
                    'title' => 'Bestätigung BetriebsverantwortlicheR',
                    'body' => '<p>Herzlichen Gl&uuml;ckwunsch, Du hast das Quiz zum betriebsverantwortlichen Foodsaver bestanden... bitte best&auml;tigen</p>',
                    'last_mod' => '2014-08-13 01:07:13',
                ),
            15 =>
                array (
                    'id' => 16,
                    'name' => 'confirm-bot',
                    'title' => 'Bestätigung BotschafterIn',
                    'body' => '<p>Herzlichen Gl&uuml;ckwunsch, Du hast das Quiz zur/zum BotschafterIn bestanden.</p>
<p>Bitte nimm Dir noch ein paar Minuten Zeit und f&uuml;lle die nachfolgenden Fragen aus.</p>
<p></p>',
                    'last_mod' => '2014-08-13 01:08:05',
                ),
            16 =>
                array (
                    'id' => 17,
                    'name' => 'quiz-starttext',
                    'title' => 'Jetzt geht es los - folgendes ist zu beachten',
                    'body' => '<p></p>
<ul><li>Bist Du sicher, dass Du alle aufgef&uuml;hrten Wiki Dokumente aufmerksam durchgelesen und verinnerlicht hast? Ohne das Wissen und die Erfahrungen welche im Wiki&nbsp;innerhalb von 2,5 Jahren zusammen getragen wurden, ist ein Bestehen des Quizes nicht m&ouml;glich.</li>
<li>W&auml;hrend des Quizes darf Dir nicht geholfen werden, suche Dir deswegen einen ruhigen Ort in dem Du ungest&ouml;rt das Quiz machen kannst.</li>
<li>Bitte alle Fragen und Antworten sorgf&auml;ltig durchlesen.</li>
<li>
<p>Beachte, dass auch mehrere Antworten richtig sein k&ouml;nnen.</p>
</li>
<li>Nach dem Beantworten jeder einzelnen&nbsp;Frage, bekommst Du eine Zwischenauswertung mit Erkl&auml;rung zu den jeweiligen Antworten, was Dir dabei hilft&nbsp;zu verstehen, was warum richtig oder falsch ist.&nbsp;Lies Dir bitte alle Erkl&auml;rungen sorgf&auml;ltig durch und hinterlasse ein Kommentar, wenn etwas unlogisch, nicht verst&auml;ndlich oder der gleichen vorkommt.</li>
<li>Am Ende bekommst Du direkt ein Feedback, ob Du bestanden hast, welche Fehler Du wo genau gemacht hast und kannst&nbsp;noch mal in Ruhe&nbsp;die Begr&uuml;ndungen dazu durchlesen.</li>
</ul><p><strong>Hinweis:</strong><br><span>Alle hier aufgef&uuml;hrten Beschreibungen basieren auf F&auml;llen aus dem echten Foodsaver Leben. Eine m&ouml;gliche Anlehnung an Ereignisse, die sich so oder so &auml;hnlich zugetragen haben, ist gewollt.</span></p>
<p></p>',
                    'last_mod' => '2014-12-24 13:44:12',
                ),
            17 =>
                array (
                    'id' => 18,
                    'name' => 'quiz-popup',
                    'title' => 'Quiz - Jetzt geht\'s los!',
                    'body' => '<p>Hallo ihr Lieben,</p>
<p>In den letzten Monaten ist sehr viel Energie &amp; Zeit in die Restrukturierung&nbsp;der Plattform&nbsp;geflossen. Ein elementarer Teil ist es, alle Foodsaver mit den richtigen Informationen zu versorgen.</p>
<p>Deswegen haben wir ein&nbsp;Quiz entworfen, bei dem&nbsp;alle n&ouml;tigen Informationen vom&nbsp;<a href="http://wiki.lebensmittelretten.de" target="_blank">foodsharing WIKI</a>&nbsp;abgefragt werden und fortan f&uuml;r alle Foodsaver verplichtend ist.</p>
<p>Du hast nun bis einschlie&szlig;lich dem&nbsp;12. Januar&nbsp;2015 Zeit Dich in die notwendigen Wiki Dokumente&nbsp;einzulesen und das Quiz zu absolvieren. Du hast dabei 3 Chancen und danach nach einem Monat Lernpause noch mal 2 Versuche, wobei es nicht schwer ist und die meisten Menschen es nach dem gr&uuml;ndlichen lesen der Wiki Dokumente es auf Anhieb schaffen.</p>
<p>Alles liebe Dir und vielen Dank f&uuml;r Dein Engagement! Weiterhin viel Freude beim Retten!<br><br>Dein Foodsharing Team</p>',
                    'last_mod' => '2015-01-07 02:10:38',
                ),
            18 =>
                array (
                    'id' => 19,
                    'name' => 'quiz-failed-fs-try1',
                    'title' => 'Diesmal hat es leider nicht geklappt',
                    'body' => '<p><span>Vielen Dank f&uuml;r Dein Bem&uuml;hen.</span></p>
<p><span>Doch leider hast Du mehr Fehlerpunkte gemacht, als es sein d&uuml;rfen -&nbsp;</span>aber kein Grund zur Sorge, das war ja erst Dein erster Versuch.</p>
<p><span>Bitte informiere Dich &uuml;ber </span><a href="http://wiki.lebensmittelretten.de" target="_blank" style="text-decoration: none;"><span>wiki.lebensmittelretten.de</span></a><span> und dann kannst Du es noch mal versuchen.</span></p>
<p><span>Gern kannst Du ein Problem auch mit deiner/deinem BotschafterIn besprechen.</span></p>
<p><span>Alles Liebe,</span></p>
<p><span>Dein Foodsharing Team</span></p>',
                    'last_mod' => '2014-11-10 17:52:24',
                ),
            19 =>
                array (
                    'id' => 20,
                    'name' => 'quiz-failed-fs-try2',
                    'title' => 'Diesmal hat es leider nicht geklappt',
                    'body' => '<p><span>Vielen Dank f&uuml;r Dein Bem&uuml;hen.</span></p>
<p><span>Doch leider hast Du mehr Fehlerpunkte gemacht, als es sein d&uuml;rfen -</span></p>
<p><span>und das leider zum zweiten Mal.</span></p>
<p><span>Wom&ouml;glich solltest Du das Wiki (</span><a href="http://www.wiki.lebensmittelretten.de" target="_blank" style="text-decoration: none;"><span>www.wiki.lebensmittelretten.de</span></a><span>) genauer lesen und es dann noch ein letztes Mal versuchen. Solltest Du ein weiteres Mal zu viele Fehlerpunkte erreichen, erh&auml;ltst Du leider einen Monat Lernpause, bis Du das Quiz erneut durchf&uuml;hren darfst.</span></p>
<p></p>
<p><span>Gern kannst Du ein Problem auch mit deiner/deinem BotschafterIn besprechen.</span></p>
<p></p>
<p><span>Alles Liebe,</span></p>
<p><span>Dein Foodsharing Team</span></p>',
                    'last_mod' => '2014-11-10 17:52:54',
                ),
            20 =>
                array (
                    'id' => 21,
                    'name' => 'quiz-failed-fs-try3',
                    'title' => 'Diesmal hat es leider nicht geklappt',
                    'body' => '<p><span>Vielen Dank f&uuml;r Dein Bem&uuml;hen - doch leider hast Du erneut mehr als 2 Fehlerpunkte gemacht.</span></p>
<p><span>Damit m&ouml;glichst viele Lebensmittel gerettet werden k&ouml;nnen, ist Zuverl&auml;ssigkeit, Sicherheit und Professionalit&auml;t bei den Betrieben und im Team unverzichtbar.</span></p>
<p><span>Die Antworten, die Du gegeben hast, vermitteln dieses zum jetzigen Zeitpunkt leider nicht.</span></p>
<p><span>Daher bekommst Du </span><span>einen Monat Lernpause</span><span> und dann kannst Du Dich erneut an dem Quiz versuchen.</span></p>
<p></p>
<p><span>Gern kannst Du ein Problem auch mit deiner/deinem BotschafterIn besprechen.</span></p>
<p></p>
<p><span>Alles Liebe,</span></p>
<p><span>Dein Foodsharing Team</span></p>',
                    'last_mod' => '2014-11-10 17:53:24',
                ),
            21 =>
                array (
                    'id' => 22,
                    'name' => 'quiz-failed-bi-try1',
                    'title' => 'Diesmal hat es leider nicht geklappt',
                    'body' => '<p>Vielen Dank f&uuml;r Dein Bem&uuml;hen.</p>
<p>Doch leider hast Du mehr Fehlerpunkte gemacht, als es sein d&uuml;rfen -&nbsp;aber kein Grund zur Sorge, das war ja erst Dein erster Versuch beim Betriebsverantworltichen Quiz.</p>
<p>Bitte lese Dir&nbsp;noch mal alle Wiki-Dokumente die zu der <a href="http://wiki.lebensmittelretten.de/Betriebsverantwortliche" target="_blank">Betrieverantwortlichkeit</a>&nbsp;dazugeh&ouml;ren, durch und wenn Du diese verinnerlicht hast und hinter ihnen steh&szlig;t, dann&nbsp;kannst Du das Quiz&nbsp;noch mal versuchen.</p>
<p></p>
<p>Alles Liebe,</p>
<p>Dein Foodsharing Team</p>',
                    'last_mod' => '2014-12-05 01:03:49',
                ),
            22 =>
                array (
                    'id' => 23,
                    'name' => 'quiz-failed-bi-try2',
                    'title' => 'Diesmal hat es leider nicht geklappt',
                    'body' => '<p><span>Vielen Dank f&uuml;r den 2. Versuch vom Betriebsverantwortlichen Quiz.</span></p>
<p><span>Leider hast Du mehr Fehlerpunkte gemacht, als es sein d&uuml;rfen - bitte besch&auml;ftige Dich noch mal ausf&uuml;hrlich mit der Thematik und mache dann den 3. Versuch zum Betriebsverantwortlichen Quiz.</span></p>
<p><span>Bitte lese Dir noch mal alle Wiki-Dokumente die zu der </span><a href="http://wiki.lebensmittelretten.de/Betriebsverantwortliche" target="_blank"><span>Betrieverantwortlichkeit</span></a><span> dazugeh&ouml;ren, durch und wenn Du diese vollkommen verinnerlicht hast und hinter ihnen stehst, dann kannst Du das Quiz noch mal versuchen.</span></p>
<p><span>&nbsp;</span></p>
<p><span>Alles Liebe,</span></p>
<p><span><span>Dein Foodsharing Team</span></span></p>',
                    'last_mod' => '2014-12-05 01:56:10',
                ),
            23 =>
                array (
                    'id' => 24,
                    'name' => 'quiz-failed-bi-try3',
                    'title' => 'Auch diesmal hat es leider nicht geklappt',
                    'body' => '<p><span>Vielen Dank f&uuml;r den 3. Versuch vom Betriebsverantwortlichen Quiz.</span></p>
<p><span>Leider hast Du auch diesmal mehr Fehlerpunkte gemacht, als es sein d&uuml;rfen. Du bekommst jetzt nach einer einmonatigen &ldquo;Lernpause&rdquo; erneut die M&ouml;glichkeit das Betriebsverantwortlichen Quiz zu bestehen.</span></p>
<p><span>Bitte lese Dir dazu gr&uuml;ndlich und sorgsam abermals alle Wiki-Dokumente die zu der </span><a href="http://wiki.lebensmittelretten.de/Betriebsverantwortliche" target="_blank"><span>Betrieverantwortlichkeit</span></a><span> dazugeh&ouml;ren durch und nutze diese &ldquo;Lernzeit&rdquo;. Sobald Du das gemacht hast und garnicht vollkommen verinnerlicht habe und hinter ihnen stehst, dann kannst Du das Quiz noch mal versuchen.</span></p>
<p><span>&nbsp;</span></p>
<p><span>Alles Liebe,</span></p>
<p><span><span>Dein Foodsharing Team</span></span></p>',
                    'last_mod' => '2014-12-05 01:59:01',
                ),
            24 =>
                array (
                    'id' => 25,
                    'name' => 'quiz-failed-bot-try1',
                    'title' => 'Diesmal hat es leider nicht geklappt',
                    'body' => '',
                    'last_mod' => '2014-11-10 14:35:46',
                ),
            25 =>
                array (
                    'id' => 26,
                    'name' => 'quiz-failed-bot-try2',
                    'title' => 'Diesmal hat es leider nicht geklappt',
                    'body' => '',
                    'last_mod' => '2014-11-10 14:36:11',
                ),
            26 =>
                array (
                    'id' => 27,
                    'name' => 'quiz-failed-bot-try3',
                    'title' => 'Diesmal hat es leider nicht geklappt',
                    'body' => '',
                    'last_mod' => '2014-11-10 14:36:31',
                ),
            27 =>
                array (
                    'id' => 28,
                    'name' => 'datenschutz',
                    'title' => 'Datenschutzerklärung',
                    'body' => '<p>Die personenbezogenen Informationen, die Du uns mitteilst, werden von foodsharing e.V., Marsiliusstr 36, 50937 K&ouml;ln, gespeichert und verarbeitet. Dieser ist die verantwortliche&nbsp; Stelle im Sinne des BDSG. Wir speichern und verarbeiten deine pers&ouml;nlichen Daten ausschlie&szlig;lich zur Organisation von Foodsharing. Eine Weitergabe deiner Daten an Dritte erfolgt nur mit deiner Einwilligung. Du kannst jederzeit Auskunft &uuml;ber die zu deiner Person gespeicherten Daten erhalten. Hierzu gen&uuml;gt eine formlose Mitteilung an foodsharing e.V. Marsiliusstr 36, 50937 K&ouml;ln oder per Mail an <a href="mailto:botschafter@foodsharing.de" target="_blank">botschafter@foodsharing.de</a>.</p>
<p class="p1"></p>
<p class="p1"><span>Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten m&ouml;glich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder eMail-Adressen) erhoben werden, erfolgt dies, soweit m&ouml;glich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdr&uuml;ckliche Zustimmung nicht an Dritte weitergegeben.</span></p>
<p class="p1"><span>Wir weisen darauf hin, dass die Daten&uuml;bertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitsl&uuml;cken aufweisen kann. Ein l&uuml;ckenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht m&ouml;glich.</span></p>
<p class="p1"><span>Der Nutzung von im Rahmen der Impressumspflicht ver&ouml;ffentlichten Kontaktdaten durch Dritte zur &Uuml;bersendung von nicht ausdr&uuml;cklich angeforderter Werbung und Informationsmaterialien wird hiermit ausdr&uuml;cklich widersprochen. Die Betreiber der Seiten behalten sich ausdr&uuml;cklich rechtliche Schritte im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch Spam-Mails, vor.</span></p>
<p class="p1"><span><b>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Google Analytics</b></span></p>
<p class="p1"><span>Diese Website benutzt Google Analytics, einen Webanalysedienst der Google Inc. ("Google"). Google Analytics verwendet sog. "Cookies", Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website durch Sie erm&ouml;glichen. Die durch den Cookie erzeugten Informationen &uuml;ber Ihre Benutzung dieser Website werden in der Regel an einen Server von Google in den USA &uuml;bertragen und dort gespeichert. Im Falle der Aktivierung der IP-Anonymisierung auf dieser Webseite wird Ihre IP-Adresse von Google jedoch innerhalb von Mitgliedstaaten der Europ&auml;ischen Union oder in anderen Vertragsstaaten des Abkommens &uuml;ber den Europ&auml;ischen Wirtschaftsraum zuvor gek&uuml;rzt.</span></p>
<p class="p1"><span>Nur in Ausnahmef&auml;llen wird die volle IP-Adresse an einen Server von Google in den USA &uuml;bertragen und dort gek&uuml;rzt. Im Auftrag des Betreibers dieser Website wird Google diese Informationen benutzen, um Ihre Nutzung der Website auszuwerten, um Reports &uuml;ber die Websiteaktivit&auml;ten zusammenzustellen und um weitere mit der Websitenutzung und der Internetnutzung verbundene Dienstleistungen gegen&uuml;ber dem Websitebetreiber zu erbringen. Die im Rahmen von Google Analytics von Ihrem Browser &uuml;bermittelte IP-Adresse wird nicht mit anderen Daten von Google zusammengef&uuml;hrt.</span></p>
<p class="p1"><span>Sie k&ouml;nnen die Speicherung der Cookies durch eine entsprechende Einstellung Ihrer Browser-Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht s&auml;mtliche Funktionen dieser Website vollumf&auml;nglich werden nutzen k&ouml;nnen. Sie k&ouml;nnen dar&uuml;ber hinaus die Erfassung der durch das Cookie erzeugten und auf Ihre Nutzung der Website bezogenen Daten (inkl. Ihrer IP-Adresse) an Google sowie die Verarbeitung dieser Daten durch Google verhindern, indem sie das unter dem folgenden Link verf&uuml;gbare Browser-Plugin herunterladen und installieren: <a href="http://tools.google.com/dlpage/gaoptout?hl=de" target="_blank"><span>http://tools.google.com/dlpage/gaoptout?hl=de</span></a>.</span></p>',
                    'last_mod' => '2016-01-19 14:00:32',
                ),
            28 =>
                array (
                    'id' => 29,
                    'name' => 'rv-foodsharer',
                    'title' => 'Rechtsvereinbarung',
                    'body' => '<p>Die Foodsaver erkl&auml;ren gegen&uuml;ber dem Foodsharing e.V. das Folgende: Ich werde im Rahmen von Foodsharing e.V. als Foodsaver t&auml;tig. Ich werde bei Lebensmittelspendern Lebensmittel abholen und diese an Dritte weiterverschenken. Ich verzichte gegen&uuml;ber dem Foodsharing e.V. und gegen&uuml;ber dem Lebensmittelspender auf die Geltendmachung jeglichen Schadensersatzes, auch deren Lieferanten gegen&uuml;ber. Jede Haftung des Lebensmittelspenders, auch f&uuml;r Fahrl&auml;ssigkeit jeden Grades, ist ausgeschlossen. Ich verpflichte mich, die Lebensmittelspenden ausschlie&szlig;lich unentgeltlich weiterzugeben und vor der Weitergabe nach bestem Wissen und Gewissen auf ihre Unbedenklichkeit zu &uuml;berpr&uuml;fen. Die Verhaltensanweisungen im Ratgebers des Foodsharing e.V., insbesondere zu verderblichen Lebensmitteln, habe ich zur Kenntnis genommen und werde sie befolgen. Mir ist bekannt, dass der Foodsharing e.V. selbst nicht Vertragspartner der Lebensmittelspenden wird und keine Haftung daf&uuml;r &uuml;bernimmt. Alles was abgeholt wird, darf ausschlie&szlig;lich nicht kommerziell weitergegeben werden. Die Foodsaver behalten, wenn sie wollen, so viele Lebensmittel f&uuml;r sich wie sie essen bzw. an private Kontakte fairteilen k&ouml;nnen. Alles andere wird auf foodsharing.de eingestellt bzw. an Suppenk&uuml;chen, Tafeln, Bahnhofsmissionen, gemeinn&uuml;tzige Vereine etc. verteilt. Das oberste Ziel ist es alle noch genie&szlig;baren abgeholten Lebensmittel vor der Vernichtung zu bewahren und sie dem menschlichen Verzehr zuzuf&uuml;hren. Alle Lebensmittelspenderbetriebe, Vereine, Bauernh&ouml;fe etc., die Essen abgeben, werden von jeglicher Haftung f&uuml;r die Genie&szlig;barkeit bzw. gesundheitliche Unbedenklichkeit der Ware entbunden, die Foodsaver tragen damit die volle Verantwortung f&uuml;r die Lebensmittel die sie abholen und m&uuml;ssen selbst entscheiden, ob diese f&uuml;r den Verzehr bzw. die Weitergabe noch geeignet sind. Die Lebensmittelspender erkl&auml;ren sich bereit, K&uuml;hlware und leicht verderblichere Lebensmittel soweit nach eigenem Ermessen m&ouml;glich bis zur Abholung durch die Foodsaver weiter sachgerecht zu lagern und andernfalls die Foodsaver auf Ausnahmen, z.B. nicht ausreichende K&uuml;hlung infolge von Platzmangel, aufmerksam zu machen. Als Foodsaver garantiere ich, mich verantwortlich und fachgerecht um die Entsorgung der nicht mehr genie&szlig;baren Lebensmittel, aber auch Verpackungen, Kartons etc. zu k&uuml;mmern. Au&szlig;erdem verpflichten sich die Foodsaver den Ort, an dem die Ware entgegengenommen bzw. getrennt wird, mindestens so sauber zu hinterlassen, wie er vorgefunden wurde. Die Lebensmittel werden zu den Zeiten abgeholt, zu denen es der Lebensmittelspender w&uuml;nscht. Normalerweise sind dies feste Zeiten, allerdings stehen die Foodsaver auch bereit um au&szlig;erterminlich Lebensmittel abzuholen. Jede Person, Verein oder Gruppe kann Lebensmittel abholen, solange sie die in dieser Vereinbarung festgelegten Regeln beachten. Die Foodsaver handeln ehrenamtlich aus sozialen, ethischen und &ouml;kologischen Gr&uuml;nden, um die Lebensmittelverschwendung und damit den Hunger, die Ressourcenverschwendung, den Klimawandel usw. zu minimieren. Die Foodsaver sind eine effiziente, lokale und zeitnahe Erg&auml;nzung zu anderen gemeinn&uuml;tzigen Organisationen wie den Tafeln. Das Ziel ist es auch kleinen Lebensmittelspendern wie B&auml;ckereien, Biol&auml;den, Restaurants etc. durch die Kooperation mit den Foodsavern zu erm&ouml;glichen, dass &uuml;berhaupt keine Lebensmittel, die noch genie&szlig;bar sind, weggeworfen werden m&uuml;ssen. Ziel ist es, eine Abholquote von 100% zu erreichen um diese zu gew&auml;hrleisten, sind alle Foodsaver immer gut vernetzt und bei unerwartetem Ausfall wie z.B. durch Krankheit etc. dazu verpflichtet, sich um eine(n) Ersatzfoodsaver der/die am besten schon mal bei dem Lebensmittelspenderbetrieb abgeholt hat, zu k&uuml;mmern. Das Suchen nach einem Ersatz sollte sp&auml;testens 18 Stunden vor dem Abholtermin via Telefon und Email beginnen. Jeder Lebensmittelspenderbetrieb, der keine Lebensmittel mehr wegwirft, bekommt einen 14cm radiusgro&szlig;en Sticker mit der Aufschrift: &ldquo;Wir machen mit foodsharing.de bei uns kommen keine Lebensmittel in die Tonne&rdquo;&Iacute;&frac34; au&szlig;erdem wird in dem Betrieb angeboten, Flyer und Plakate aufzuh&auml;ngen/auszuh&auml;ndigen und den Betrieb auch &ouml;ffentlich auf foodsharing.de zu erw&auml;hnen.</p>',
                    'last_mod' => '2014-11-12 00:00:31',
                ),
            29 =>
                array (
                    'id' => 30,
                    'name' => 'rv-foodsaver',
                    'title' => 'Rechtsvereinbarung für Foodsaver',
                    'body' => '<p><strong>Eigenerkl&auml;rung - Verhaltenskodex und Sorgfaltspflichten</strong></p>
<p><span>Ich erkl&auml;re das Folgende:<br><br></span>Ich werde im Rahmen von foodsharing als Foodsaver t&auml;tig werden. Das hei&szlig;t, ich hole bei LebensmittelspenderInnen Lebensmittel ab und verpflichte mich, diese entweder selbst zu verbrauchen oder ausschlie&szlig;lich unentgeltlich an Dritte weiterzugeben (privat, Suppenk&uuml;chen, Tafeln, Bahnhofsmissionen, gemeinn&uuml;tzige Vereine, Fair-Teiler, online als Essenskorb etc.).<br><br>Das oberste Ziel ist es, alle noch genie&szlig;baren Lebensmittel vor der Vernichtung zu bewahren und sie dem menschlichen Verzehr zuzuf&uuml;hren. Als Foodsaver handle ich ehrenamtlich aus sozialen, ethischen und &ouml;kologischen Gr&uuml;nden, um die Lebensmittelverschwendung und damit den Hunger, die Ressourcenverschwendung und den Klimawandel uvm. zu minimieren.<br><br>Die Foodsaver sind eine effiziente, lokale und zeitnahe Erg&auml;nzung zu anderen gemeinn&uuml;tzigen Organisationen wie z.B. den Tafeln. Zielsetzung ist es, neben gro&szlig;en Lebensmittelh&auml;nderInnen, m&ouml;glichst allen kleinen LebensmittelspenderInnen wie B&auml;ckereien, Biol&auml;den, Restaurants etc. die Kooperation mit den Foodsavern zu erm&ouml;glichen, sodass unabh&auml;ngig von der Gr&ouml;&szlig;e des Lebensmittelbetriebes keine noch genie&szlig;baren Lebensmittel weggeworfen werden m&uuml;ssen.<br><br>Die umfassende Zufriedenheit unserer Kooperationsbetriebe ist ein elementarer Teil des Lebensmittelrettens. Ich verpflichte mich, mich daf&uuml;r mit zuverl&auml;ssigem, freundlichem und aufgeschlossenem Verhalten gegen&uuml;ber den Menschen und Betrieben auf allen Ebenen einzusetzen.<br><br>Ich verpflichte mich, keine Betriebe anzusprechen bzw. Kooperationen aufzubauen, so lange ich nicht das Quiz zum Betriebsverantwortlichen bestanden habe. Generell ist es nur in Absprache mit dem Betriebskettenteam gestattet, Betriebe mit mehr als 2 Filialen anzusprechen.<br><br>Ziel ist es, eine Abholquote von 100% zu erreichen. Um diese zu gew&auml;hrleisten, bin ich als</p>
<p><span>Foodsaver dazu angehalten, alle Abholtermine auf der Website einzutragen und gut mit anderen Foodsavern vernetzt zu sein.&nbsp;Bei unerwartetem Ausfall wie z.B. durch Krankheit etc. bin ich dazu verpflichtet, mich schnellstm&ouml;glich aus dem Kalender auszutragen und mich um einen Ersatzfoodsaver zu k&uuml;mmern, der schon mal bei dem Lebensmittelspendebetrieb abgeholt hat und nur im Notfall einen Foodsaver zu w&auml;hlen, der bei dem Betrieb noch nie abgeholt hat. Sollte sich bis 24 Stunden vor dem Abholtermin kein Ersatz gefunden haben, muss das Suchen nach einem Ersatz via Telefon und E-Mail fortgef&uuml;hrt werden, bis jemand gefunden wird. Ist die Suche auch bis zu einer Stunde vor Abholtermin nicht erfolgreich, muss die Filiale umgehend telefonisch informiert werden, dass an dem betreffenden Tag keine Abholung vorgenommen werden kann. </span></p>
<p><span>In den Ausnahmesituationen, in denen trotz aller Bem&uuml;hungen keine Abholung stattfinden konnte, muss das Team des Betriebes per Pinnwandeintrag &uuml;ber das Nichterscheinen informiert werden sowie das Nichtabholen als eigener Versto&szlig; gemeldet werden.<br><br></span>Als Foodsaver sichere ich zu, K&uuml;hlware und leicht verderbliche Lebensmittel&nbsp;bis zur &Uuml;bergabe an Dritte sachgerecht zu lagern bzw. zu k&uuml;hlen und andernfalls solche Lebensmittel nicht an Dritte weiterzugeben.<br><br>Als Foodsaver garantiere ich, w&auml;hrend der Abholungen oder danach keine noch essbaren Lebensmittel zu entsorgen und mich verantwortlich und fachgerecht um die Entsorgung der nicht mehr genie&szlig;baren Lebensmittel, aber auch Verpackungen, Kartons etc. zu k&uuml;mmern.<br><br>Desweiteren verpflichte ich mich, den Ort, an dem die Ware entgegengenommen bzw. getrennt wird, mindestens so sauber zu hinterlassen, wie ich ihn vorgefunden habe.<br><br><span>Die Lebensmittel werden zu den Zeiten abgeholt, zu welchen es die Lebensmittelspenderbetriebe</span><span> </span><span>w&uuml;nschen. Normalerweise sind dies feste Zeiten, allerdings stehen die Foodsaver auch</span><span> </span><span>bereit, um au&szlig;erterminlich Lebensmittel abzuholen.<br><br></span><span>Ich best&auml;tige, die </span><a href="http://wiki.lebensmittelretten.de/Verhaltensregeln" target="_blank"><span>Verhaltensregeln</span></a><span> und andere </span><a href="http://wiki.lebensmittelretten.de" target="_blank"><span>foodsharing-Wiki-Dokumente</span></a><span> gelesen und verstanden zu haben und verpflichte mich, mich nach diesen zu verhalten. Wenn ich Kenntnis davon erlange, dass diese Verhaltensregeln von anderen Foodsavern, Betriebsverantwortlichen oder BotschafterInnen nicht eingehalten werden, melde ich diese Verst&ouml;&szlig;e &uuml;ber das Formular "Versto&szlig; melden" im Profil des jeweiligen Users.<br><br></span>Als Foodsaver erkl&auml;re ich, die in dieser Vereinbarung festgehaltenen Werte zu achten und foodsharing nicht zu sch&auml;digen. Dies beinhaltet insbesondere die Pflicht, jegliche diskreditierenden Aussagen gegen foodsharing, ihren BotschafterInnen, Foodsavern und anderen Unterst&uuml;tzerInnen, auch nach Beendigung meiner Teilnahme als Foodsaver, zu unterlassen. Ich nehme zur Kenntnis, dass ich bei Versto&szlig; gegen diese Erkl&auml;rung, insbesondere wenn ich foodsharing durch meine Handlungen oder Aussagen vors&auml;tzlich oder grob fahrl&auml;ssig sch&auml;dige, von einer Teilnahme als Foodsaver ausgeschlossen werde bzw. mir die Teilnahme als Foodsaver untersagt wird.<br><br>Ich verpflichte mich auch, mich &uuml;ber aktuelle Informationen und Neuigkeiten auf dem Laufenden zu halten (Regelm&auml;&szlig;ige foodsharing-Treffen aufsuchen, Newsletter lesen, Foren auf der Homepage besuchen, Mails lesen).<br><br>foodsharing ist&nbsp;in erster Linie parteipolitisch neutral.&nbsp;<span>Ich verpflichte mich, mich diesbez&uuml;glich an die Regeln und Vorgaben im Dokument </span><a href="http://wiki.lebensmittelretten.de/Foodsharing_und_Politik" target="_blank"><span>&bdquo;Foodsharing und Politk&ldquo;</span></a><span> zu halten.</span></p>',
                    'last_mod' => '2015-01-07 18:20:28',
                ),
            30 =>
                array (
                    'id' => 31,
                    'name' => 'rv-biebs',
                    'title' => 'Rechtsvereinbarung',
                    'body' => '<p><strong>Zusatzrechtsvereinbarung f&uuml;r Betriebsverantwortliche bei foodsharing:</strong></p>
<p><strong>&nbsp;</strong></p>
<p><span>Zus&auml;tzlich bin ich als BetriebsverantwortlicheR daf&uuml;r verantwortlich, nur Betriebe anzusprechen, bei denen ich auch garantieren kann, dass gen&uuml;gend Foodsaver bereit stehen, die notfalls auch 7 Tage die Woche ab Erstkontakt Lebensmittel abholen k&ouml;nnen.<br><br></span>Bevor ich als BetriebsverantwortlicheR aktiv werde, verpflichte ich mich, mit den BotschafterInnen meiner Region in Kontakt zu treten und erst nach Absprache mit ihnen neue KooperationspartnerInnen zu suchen. Dabei versichere ich, nur inhaberInnengef&uuml;hrte Betriebe anzusprechen und f&uuml;r alle Betriebe mit mehr als 2 Filialen das Betriebskettenteam zu kontaktieren.</p>
<p><span><br></span>Noch bevor ich einen Betrieb anspreche, &uuml;berpr&uuml;fe ich, ob der Betrieb nicht bereits eingetragen wurde. Nach jedem Kontakt zum Betrieb trage ich alle relevanten Informationen noch am selben Tag bei foodsharing ein bzw. aktualisiere alle in Erfahrung gebrachten Informationen, die bei der Betriebseintragung abgefragt werden.</p>
<p><span><br></span>Alle Betriebe, die von mir im Rahmen von foodsharing angelegt und angesprochen werden, sind Teil des foodsharing-Netzwerkes. Wird mir aufgrund von Verst&ouml;&szlig;en gegen die foodsharing-Regeln die Betriebsverantwortlichkeit entzogen, &uuml;bernimmt bis zur Ernennung eines neuen Betriebsverantwortlichen der/die zust&auml;ndige BotschafterIn die Betriebsverantwortlichkeit. Das Gleiche gilt nach freiwilligem R&uuml;ckzug als BetriebsverantwortlicheR. Es ist nicht gestattet, nach freiwilligem oder unfreiwilligem Verlassen des Betriebes weiterhin Lebensmittel in diesem Betrieb abzuholen. Des Weiteren ist es untersagt, die Kooperation zwischen foodsharing und einem Betrieb ohne Einverst&auml;ndnis und Absprache mit den BundeslandbotschafterInnen bzw. des Orgateams zu beenden.</p>
<p><span><br>Ich habe daf&uuml;r Sorge zu tragen, dass es bei allen Betrieben, bei denen ich die Betriebsverantwortlichkeit innehabe, eine gute Stimmung gibt und sich alle Beteiligten - Foodsaver sowie Angestellten - wohlf&uuml;hlen. Damit Problemen vorgebeugt wird bzw. entstandene Probleme schnell gel&ouml;st werden, werde ich ausreichend Kommunikation betreiben.<br><br></span>Ich verplichte mich, jeden Versto&szlig; gegen die Verhaltensregeln zu &uuml;berpr&uuml;fen und ggf. Konsequenzen zu ziehen, zu schlichten und einzelne Foodsaver, nach Absprache mit den zugeh&ouml;rigen BotschafterInnen, aus dem Team zu nehmen.<br><br>Au&szlig;erdem werde ich alle wichtigen Informationen zum Status der Kooperation sowie &Auml;nderungen umgehend auf die Pinnwand schreiben bzw. unter &ldquo;Betrieb&rdquo; einarbeiten.</p>
<p><span><br></span>Zus&auml;tzlich erkl&auml;re ich mich als BetriebsverantwortlicheR bereit, foodsharing&nbsp;immer verantwortungsbewusst und motiviert zu repr&auml;sentieren. Ich bin mir bewusst, dass ich im Hinblick auf die Foodsaver, Betriebsverantwortlichen und BotschafterInnenkollegInnen eine Vorbildfunktion innehabe, die mir Freude bereitet und die ich ernstnehme. Das <a href="http://wiki.lebensmittelretten.de/Betriebsverantwortliche" target="_blank">Wiki-Dokument</a>&nbsp;bez&uuml;glich meiner Aufgaben und anderen Verpflichtungen als BetriebsverantwortlicheR habe ich gelesen, verinnerlicht und stehe dahinter.</p>
<p></p>
<p></p>',
                    'last_mod' => '2015-01-05 17:42:02',
                ),
            31 =>
                array (
                    'id' => 32,
                    'name' => 'rv-botschafter',
                    'title' => 'Rechtsvereinbarung',
                    'body' => '<p>Derzeit keine, werden noch bearbeitet und dann nachgereicht.&nbsp;</p>',
                    'last_mod' => '2015-01-07 05:32:12',
                ),
            32 =>
                array (
                    'id' => 33,
                    'name' => 'quiz-hinweis',
                    'title' => 'Wichtiger Hinweis:',
                    'body' => '<div class="ace-line">
<p><span>Liebe*r&nbsp;{NAME},<br><br></span>sch&ouml;n, dass Du dabei bist und Dich gegen die Lebensmittelverschwendung einsetzen willst!<br>Willst Du in Zukunft wie schon tausende andere&nbsp;<strong>Foodsaver werden und Lebensmittel bei B&auml;ckereien, Superm&auml;rkten, Restaurants etc.&nbsp;retten?</strong><br>Vielleicht sogar BetriebsverantwortlicheR werden oder Dich bei einen der unz&auml;hligen Arbeitsgruppen einbringen? Solltest Du&nbsp;Lust auf noch mehr Verantwortung haben und Deine Region mitaufbauen wollen bzw. bestehende BotschafterInnen unterst&uuml;tzen wollen, kannst Du Dich auch als&nbsp;foodsharing BotschafterIn bewerben. Lese Dich jetzt in die notwendigen <a href="http://wiki.lebensmittelretten.de/Foodsaver" target="_blank">Dokumente im Wiki</a>&nbsp;ein, um dann <a href="/?page=settings&amp;sub=upgrade/up_fs" target="_blank">das kleine Quiz</a> zu absolvieren.<br><br>Du hast die M&ouml;glichkeit zwischen dem Quiz mit 10 Fragen und Zeitlimit oder dem&nbsp;<span>Quiz mit 20 Fragen ohne Zeitlimit.<br><br></span><strong>Sch&ouml;n, dass Du dabei bist und Dich einbringen willst! Wir freuen uns auf Deine Unterst&uuml;tzung!</strong></p>
<span><span>Herzlich Dein&nbsp;foodsharing Orgateam</span></span></div>',
                    'last_mod' => '2015-05-20 21:17:00',
                ),
            33 =>
                array (
                    'id' => 34,
                    'name' => 'quiz-popup-bieb',
                    'title' => 'Betriebsverantwortlichen - Quiz',
                    'body' => '<p>Lieber Foodsaver,</p>
<p>da Du einen oder mehrere <strong>Betriebsverantwortlichkeiten</strong> tr&auml;gst - und wir uns nicht der Entscheidung anma&szlig;en wollen, wer das Quiz belegen sollte und wer nicht - ist es auch f&uuml;r Dich an der Zeit, das Quiz f&uuml;r das Upgrade zum Betriebsverantwortlichen zu machen.</p>
<p>Wie gewohnt findest du alle Informationen im foodsharing&nbsp;<a href="http://wiki.lebensmittelretten.de/Betriebsverantwortliche" target="_blank">WIKI</a></p>
<p>Damit Wir alle auf dem aktuellen Stand sind, bitten wir auch Dich das Quiz bis zum <strong>12. Januar 2015</strong> zu machen.&nbsp;</p>
<p></p>
<p>Alles liebe Dir und vielen Dank f&uuml;r Dein Engagement! Weiterhin viel Freude beim Retten!<br><br>Dein Foodsharing Team</p>',
                    'last_mod' => '2014-12-22 14:01:38',
                ),
            34 =>
                array (
                    'id' => 35,
                    'name' => 'quiz-popup-bot',
                    'title' => 'Quiz - Jetzt geh\'s los!',
                    'body' => '<p>Hallo ihr Lieben,</p>
<p>In den letzten Monaten ist sehr viel Energie &amp; Zeit in die Restrukturierung von lebensmittelretten.de geflossen. Ein elementarer Teil ist es, alle Foodsaver mit den richtigen Informationen zu versorgen.</p>
<p>Dazu wurde ganz zentral ein Quiz entworfen, &uuml;ber das ihr best&auml;tigen d&uuml;rft, dass ihr alle n&ouml;tigen Informationen gelesen habt. Als gro&szlig;er Informationspool ist ab sofort das foodsharing&nbsp;<a href="http://wiki.lebensmittelretten.de" target="_blank">WIKI</a> die 1. Anlaufstelle.</p>
<p>Nun ist das Quiz online und fest in das Anmeldeverfahren f&uuml;r Foodsaver eingebaut, damit wir alle auf dem aktuellen Stand sind, bitten wir auch Dich das Quiz bis zum <strong>12. Janauar&nbsp;2015</strong>&nbsp;zu machen.&nbsp;</p>
<p>Alles liebe Dir und vielen Dank f&uuml;r Dein Engagement! Weiterhin viel Freude beim Retten!<br><br>Dein Foodsharing Team</p>',
                    'last_mod' => '2014-12-22 14:00:56',
                ),
            35 =>
                array (
                    'id' => 36,
                    'name' => 'bot-last-quiz-popup',
                    'title' => 'Wichtig: BotschafterInnen Quiz jetzt machen',
                    'body' => '<div>Liebe*r {NAME}</div>
<div>hiermit erinnern wir Dich an das BotschafterInnen Quiz f&uuml;r welches Du noch bis einschlie&szlig;lich dem 12.01 Zeit hast. Bitte lese Dir Dir dazu alle n&ouml;tigen Wiki-Dokumente durch, solltest Du das Foodsaver und/oder&nbsp;Betriebsverantwortlichen Quiz noch nicht gemacht haben, musst Du diese erst bestehen um das BotschafterInnen Quiz machen zu k&ouml;nnen.</div>
<div></div>
<div>Vielen Dank dir Dir f&uuml;r Deinen Einsatz, wir sind Dir sehr dankbar und nun gutes gelingen beim Quiz!</div>
<div></div>
<div>Einen wunderbaren Einstieg in die BotschafterInnen Welt</div>
<div></div>
<div>Herzlich Euer fooddsharing Orgateam</div>',
                    'last_mod' => '2015-01-07 11:55:48',
                ),
            36 =>
                array (
                    'id' => 37,
                    'name' => 'myfoodsharing-at-mai',
                    'title' => 'Myfoodsharing.at Hauptseite',
                    'body' => '<div class="biglogo">
<div class="centerblock"><img src="/img/gabel.png" width="25%"><p>Teile Lebensmittel,</p>
<p class="small">anstatt sie wegzuwerfen!</p>
<h1>foodsharing<span>.at</span></h1>
</div>
</div>',
                    'last_mod' => '2015-05-04 22:46:48',
                ),
            37 =>
                array (
                    'id' => 38,
                    'name' => 'foodsharing-de-main',
                    'title' => 'foodsharing.de Hauptseite',
                    'body' => '<div class="biglogo">
<div class="centerblock"><img src="/img/gabel.png" width="25%" />
<p>Teile Lebensmittel,</p>
<p class="small">anstatt sie wegzuwerfen!</p>
<h1><span>food</span>sharing<span>.de</span></h1>
</div>
</div>
<div class="biglogo">
<h1><span>Willst Du uns unterst&uuml;tzen?</span></h1>
<br />
<p class="small"><a href="https://foodsharing.de/unterstuetzung" target="_blank">zum Aufruf</a></p>
</div>',
                    'last_mod' => '2017-04-02 15:58:21',
                ),
            38 =>
                array (
                    'id' => 39,
                    'name' => 'team-header',
                    'title' => 'Kontakt',
                    'body' => '<div class="head ui-widget-header ui-corner-top">Kontaktanfragen:</div>
<div class="ui-widget ui-widget-content corner-bottom margin-bottom ui-padding">
<p>Auf dieser Seite stellt sich der Vorstand des foodsharing e.V. vor.<br />Der aktuelle Vorstand setzt sich aus dem gesch&auml;ftsf&uuml;hrenden und dem erweiterten Vorstand zusammen und ist die Fusion von dem "alten" gesch&auml;ftsf&uuml;hrenden Vorstand und dem ehemaligen <a href="http://wiki.lebensmittelretten.de/Orgateam" target="_blank">Orgateam.</a><br /><br /> Du kannst sehen, wer in welcher Funktion dabei ist; es gibt kurze Infos zu den einzelnen Personen und dar&uuml;ber hinaus gibt es die M&ouml;glichkeit mit Einzelnen Kontakt aufzunehmen. <br />Wir m&ouml;chten Dich aber bitten, Dein Anliegen nur an eine Person zu schreiben! F&uuml;r allgemeine Anfragen&nbsp;wende Dich bitte an&nbsp;<a href="mailto:info@foodsharing.de" target="_blank">info@foodsharing.de</a>. Hier vermitteln wir Dich auch gerne an die passende AnsprechpartnerIn in Deiner N&auml;he.&nbsp;</p>
<p><span><span>Folgende L&auml;nder/St&auml;dte&nbsp;kannst Du direkt anschreiben:&nbsp;</span></span></p>
<p><strong>Deutschland: </strong>Berlin: <a href="mailto:berlin@lebensmittelretten.de" target="_blank">berlin@lebensmittelretten.de</a>, Bonn: <a href="mailto:bonn@lebensmittelretten.de" target="_blank">bonn@lebensmittelretten.de</a>, Chemnitz: <a href="mailto:chemnitz@lebensmittelretten.de," target="_blank">chemnitz@lebensmittelretten.de</a>, Hamburg: <a href="mailto:Hamburg@lebensmittelretten.de" target="_blank">hamburg@lebensmittelretten.de</a>, Frankfurt: <a href="mailto:frankfurt.am.main@lebensmittelretten.de" target="_blank">frankfurt.am.main@lebensmittelretten.de</a>, Freiburg: <a href="mailto:freiburg@lebensmittelretten.de" target="_blank">freiburg@lebensmittelretten.de</a>, K&ouml;ln: <a href="mailto:Koeln@lebensmittelretten.de" target="_blank">koeln@lebensmittelretten.de</a>, Stuttgart: <a href="mailto:stuttgart@lebensmittelretten.de" target="_blank">stuttgart@lebensmittelretten.de</a>, M&uuml;nchen: <a href="mailto:Muenchen@lebensmittelretten.de" target="_blank">muenchen@lebensmittelretten.de</a></p>
<p><strong>&Ouml;sterreich: </strong>Wien: <a target="_blank">wien@lebensmittelretten.de</a></p>
<p><strong>Schweiz: </strong>Schweiz: <a href="mailto:info@foodsharingschweiz.ch" target="_blank">info@foodsharingschweiz.ch</a></p>
<p>Hast Du Probleme mit der Website oder Deinem Account, wende Dich bitte an&nbsp;<a href="mailto:it@lebensmittelretten.de" target="_blank">it@lebensmittelretten.de</a>.</p>
</div>',
                    'last_mod' => '2016-12-15 09:52:01',
                ),
            39 =>
                array (
                    'id' => 40,
                    'name' => 'int_signup_de',
                    'title' => 'EINLADUNG INTERNATIONALES FOODSHARING TREFFEN vom 30.04-03.05. 2015 IN BERLIN',
                    'body' => '<p><strong><a href="https://foodsharing.de/?page=register&amp;lang=en" target="_blank">English version of the registration here.</a></strong></p>
<p></p>
<p><strong>Liebe Freunde und Freundinnen von foodsharing,<br><br></strong>wir laden Euch recht herzlich zum Internationalen foodsharing Treffen in Berlin ein!<br><br>F&uuml;r das mittlerweile <strong>4. Internationale foodsharing Treffen</strong> erwarten wir ca. 500 Menschen,<br>die sich gegen Lebensmittelverschwendung einsetzen m&ouml;chten.<br><br>Unser oberstes Ziel ist es, die Lebensmittelverschwendung von derzeit 50 Prozent zu minimieren<br>und dabei so effektiv und dezentral wie nur m&ouml;glich zu agieren. Mit Hilfe von neuen Ideen,<br>wie wir noch mehr Lebensmittel retten und neue engagierte Menschen gewinnen k&ouml;nnen,<br>m&ouml;chten wir ein st&auml;rkeres Bewusstsein f&uuml;r die Thematik schaffen.<br><span><strong><br>Wann</strong>: </span><span><span> </span></span><span>Do. 30.04.2015 (16:00 Uhr) bis So. 03.05.2015 (16:00 Uhr) [Mitteleurop&auml;ische Zeit]<br></span><span><strong>Wo:</strong> &nbsp;&nbsp;</span><span><span>&nbsp;&nbsp;</span></span><span>Freizeit-und Erholungszentrum FEZ<br></span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Stra&szlig;e zum FEZ 2,&nbsp;12459 Berlin</p>
<p><span>Das Treffen wird mit der Anreise am Donnerstag und &bdquo;Tanz in den Mai&ldquo; am Abend starten.<br></span>Zwischen Freitag und Sonntag werden verschiedene Workshops, Vortr&auml;ge, Diskussionen, Gruppentreffen, Kinofilme<br>und andere Angebote f&uuml;r Neulinge und Erfahrene stattfinden.</p>
<p></p>
<p>Folgende Workshops sind schon geplant: <a href="http://wiki.lebensmittelretten.de/Event_Workshops" target="_blank">Workshops.</a></p>
<p></p>
<p><span><span>Alle Workshops sind aus <strong>rein ehrenamtlichem Engagement</strong> von Foodsavern oder den externen Organisationen entstanden.<br> Wir danken an dieser Stelle herzlichst daf&uuml;r!</span></span></p>
<p></p>
<p><span>Das Treffen ist f&uuml;r Euch komplett kostenfrei und inklusive Verpflegung.&nbsp;</span><span><br></span><span>Lediglich die An- und Abreise muss selbst organisiert werden.&nbsp;<br><br></span>Folgende &Uuml;bernachtungsm&ouml;glichkeiten stehen zur Verf&uuml;gung:<br>- in eigenen Zelten (Isomatte + Schlafsack bitte mitbringen)<br>- in Bungalows (muss selbst bezahlt und organisiert werden)<br>&nbsp; <a href="http://fuchsbau-berlin-wuhlheide.de/#preise" target="_blank">http://fuchsbau-berlin-wuhlheide.de/#preise<br></a><a href="http://fuchsbau-berlin-wuhlheide.de/#preise" target="_blank"></a>- ggf. bei BerlinerInnen auf der Couch (bitte bei der Anmeldung im Kommentarfeld angeben, falls gew&uuml;nscht)<br>-&gt; geschlechtergetrennte Gro&szlig;raumduschen sowie Toiletten stehen ebenfalls zur Verf&uuml;gung.&nbsp;</p>
<p><span><span><span><strong>Ein Hinweis f&uuml;r BerlinerInnen:</strong> Da wir nur begrenzt Schlafpl&auml;tze haben, m&ouml;chten<br></span></span></span>wir Euch bitten bei Euch zu Hause zu schlafen.&nbsp;<br>Nur so k&ouml;nnen wir sicherstellen, dass alle, die von ausw&auml;rts anreisen, einen Schlafplatz bekommen.&nbsp;<br><span>Wenn zur Veranstaltung noch gen&uuml;gend Schlafpl&auml;tze frei sind, werden wir Euch rechtzeitig informieren,<br></span><span>dann seid Ihr nat&uuml;rlich&nbsp;</span>herzlichst willkommen mit allen Anderen auf dem Gel&auml;nde zu &uuml;bernachten!</p>
<p><strong>Eltern aufgepasst!</strong> Wir werden auch f&uuml;r Kinderbetreuung sorgen.<br>Solltet Ihr diese nutzen wollen, macht bitte Eure Angaben in der Anmeldung. <br><span></span></p>
<p><span>Toll w&auml;re auch, wenn Du jetzt schon <strong>haltbare Lebensmittel</strong> (MHD) sammelst, die Du zum Treffen mitbringst. Wenn es sich um gr&ouml;&szlig;ere Mengen handelt, die du selbst oder jemand aus deinem Team, nicht transportieren kann, melde Dich einfach bei uns!</span></p>
<p><br>Weitere Angebote vor Ort:<br>- Hallenbad (kostenpflichtig) / Badesee (wetterabh&auml;ngig, kostenpflichtig)<br>- viel Wald zum Spazieren<br>- Naturkunde-H&auml;user<br>- Spielpl&auml;tze<br>- Kr&auml;utergarten<br>- diverse Sportm&ouml;glichkeiten<br><span>noch mehr unter:&nbsp;</span><span><a href="http://www.fez-berlin.de" target="_blank">http://www.fez-berlin.de</a></span></p>
<p><strong>Um so pr&auml;zise wie m&ouml;glich planen zu k&ouml;nnen, bitten wir um eine fr&uuml;hzeitige verbindliche Anmeldung, da die Teilnehmerzahl begrenzt ist.</strong></p>
<p></p>
<p><strong>Alle Infos mit Wegbeschreibungen und Programmplanung findet ihr hier: <a href="http://wiki.lebensmittelretten.de/Event" target="_blank">Webseite - Internationales Treffen</a>.</strong></p>',
                    'last_mod' => '2015-04-21 14:22:42',
                ),
            40 =>
                array (
                    'id' => 41,
                    'name' => 'int_signup_en',
                    'title' => ' Invitation to the International Foodsharing event / Meetup from 30.04 -03.05.2015 in Berlin',
                    'body' => '<p><span><strong>Dear foodsharing friends</strong>,</span></p>
<p><span>you are hereby cordially invited to our international foodsharing meetup in Berlin! For the <strong>4th international foodsharing event</strong> we expect up to 500 participants, who want to campaign against food waste.<br></span>Our ultimate goal is to minimize the current 50 % food wastage and to be as effective and decentralized as possible. With new ideas how to save more food and gain new dedicated people, we strive to create a greaterwish to achieve a greater awareness for thisouraround this cause.</p>
<p><span><strong>When:</strong>&nbsp; </span><span><span> </span></span><span> Thurs 30.04.2015 (04:00 pm) till Sun 03.05.2015 (04:00 pm) [Central European Time]<br></span><span><strong>Wo:</strong> &nbsp;&nbsp;</span><span><span>&nbsp;&nbsp;</span></span><span> Freizeit - und Erholungszentrum FEZ<br></span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; Stra&szlig;e zum FEZ 2, 12459 Berlin</p>
<p><span>Our meeting starts on the day of arrival with the traditional &ldquo;Tanz in den Mai&rdquo; (dance into May) event.<br></span>From Friday to Sunday various workshops, lectures, discussions, group events, movies and other special events will be held<span> for beginners as well as for more experienced people.&nbsp;</span></p>
<p><span></span></p>
<p><span>The following workshops are <a href="http://wiki.lebensmittelretten.de/Event_Workshops_engl" target="_blank">available</a>. </span></p>
<p><span>The exact times will be included in the another mail to all registered people.</span></p>
<p>All workshops will be held by foodsharing volunteers or external organisators. Thanks you all for your commitment!<br><span><span>The event is completely free of charge including meals. </span></span><span></span><span>You only need to arrange your </span><span>arrival and departure on your own</span>.<br>The following accomodations options are available to you:</p>
<ul><li>in your own tent ( please bring your own sleeping pad + sleeping bag)</li>
<li><span>in bungalows ( need to be paid and organised on your own)&nbsp;</span><span><a href="http://fuchsbau-berlin-wuhlheide.de/#preise" target="_blank">http://fuchsbau-berlin-wuhlheide.de/#preise</a><a href="about:blank" target="_blank"></a></span></li>
<li>at someones\' place in berlin (please leave us a note if you prefer this)</li>
</ul><p><span>Gender-separate showers, as well as toilets are also available.<br></span>Note to all people from in Berlin: Since our sleeping accomodations are limited, we would like to ask you to sleep in your own home.<br>Only then we will be able to ensure that all travelers from outside of Berlin get a place to sleep.<br>If there are still enough sleeping places available once the event starts, we will contact you in due time and In that case you are welcome to stay overnight with all the others (on the site)!<br>A note to parents: We will also arrange childcare.<br>If you want to use this service please include this information in your registration.&nbsp;</p>
<p>Other local services include:</p>
<ul><li>an indoor swimming pool and lake (both with costs)</li>
<li>a lot of forest for taking walks</li>
<li>natural study information points</li>
<li>playgrounds</li>
<li>a herb garden</li>
<li>various sport options</li>
</ul><p><br>More information here: <span><a href="http://www.fez-berlin.de" target="_blank">http://www.fez-berlin.de</a><a href="http://www.fez-berlin.de" target="_blank"></a></span></p>
<p><strong>Please register in good time since there is only a limited number of spots available!</strong></p>
<p></p>
<p><strong><strong>All informations with time schedule available here: <a href="http://wiki.lebensmittelretten.de/Event" target="_blank">Website - International gathering</a>.</strong></strong></p>',
                    'last_mod' => '2015-04-17 11:10:31',
                ),
            41 =>
                array (
                    'id' => 42,
                    'name' => 'unterstuetzungseite',
                    'title' => 'Unterstützung',
                    'body' => '<h3><a href="https://youtu.be/wpwo9-I1rGU" target="_blank"><span><img src="https://wiki.foodsharing.de/images/1/11/Spendenvideo.jpg" width="500" /></span></a></h3>
<p><a href="https://youtu.be/wpwo9-I1rGU" target="_blank">- zur Videobotschaft von Raphael Fellmer und Valentin Thurn - </a></p>
<h3><span>SPENDENAUFRUF </span></h3>
<p><span>Liebe MitretterInnen und liebe foodsharing-Begeisterte,<br /><br />foodsharing w&auml;chst und w&auml;chst &ndash; das ist wunderbar! Es ist unfassbar, was wir seit 2012 gemeinsam geschafft haben! Es gibt keine andere Organisation in der Gr&ouml;&szlig;enordnung, die ausschlie&szlig;lich ehrenamtlich funktioniert &ndash; darauf d&uuml;rfen wir stolz sein.<br /><br />Doch so ganz ohne Geld funktioniert es leider nicht, und das schnelle Wachstum bringt neue Herausforderungen mit sich: wir m&uuml;ssen dringend eine neue und dezentrale Struktur aufbauen, um gleichzeitig Verantwortung zu teilen und den Ortsgruppen mehr Freiheiten zu gew&auml;hren. Hierf&uuml;r ben&ouml;tigen wir finanzielle Mittel f&uuml;r eine Organisationsentwicklung, Rechtsberatungen, feste Ausgaben wie Versicherungen oder Aktionen und Veranstaltungen.<br /><br />Der Foodsharing e.V., der u.a. diese Plattform betreibt, ist finanziell allerdings sehr schlecht aufgestellt - zeitweise musste sogar der Versand von Werbematerial eingestellt werden, weil kein Geld f&uuml;r Porto vorhanden war.<br /><br />Deshalb freuen wir uns &uuml;ber Spenden in jeglicher H&ouml;he - somit wird foodsharing auch dank Dir weiterhin kostenlos bleiben! Bist Du dabei?<br /><br />Ganz lieben Dank im Voraus,<br />Euer foodsharing e.V. Vorstand <br /></span></p>
<h2>SPENDEN</h2>
<p><span>F&uuml;r Spenden auf unser Konto oder &uuml;ber&nbsp;<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=CLPZCSCKGNXE4" target="_blank">PayPal (hier klicken)</a> k&ouml;nnen wir steuerwirksame Zuwendungsbest&auml;tigungen ausstellen.<br /></span>Unsere Gemeinn&uuml;tzigkeit ist vom Finanzamt K&ouml;ln-S&uuml;d mit dem Freistellungsbescheid 219/5882/2317 <span>vom 29.10.2012</span> best&auml;tigt.<br /><br /><span>foodsharing e.V.<br /> Kontonummer: 4063815600<br /></span>BLZ: 430 609 67<br />IBAN: DE66 4306 0967 4063 8156 00<br />BIC: GENODEM1GLS<br />GLS Bank</p>
<p><span>Bei einer Spende bis zu 200 Euro wird ihr Einzahlungsbeleg oder Kontoauszug&nbsp;von Ihrem Finanzamt bei Ihrer Einkommensteuer-Erkl&auml;rung steuermindernd anerkannt.<br />Wenn Ihre Spende gro&szlig;z&uuml;giger ausf&auml;llt, senden wir Ihnen gern eine steuerwirksame Spendenquittung zu. Bitte vermerken Sie in diesem Falle unbedingt Ihre Postanschrift auf der &Uuml;berweisung, damit wir wissen, wohin wir die Quittung senden sollen.<br />Weil manche Banken leider nicht den gesamten Verwendungszweck an uns &uuml;bertragen, bitten wir Sie um eine E-Mail an info@foodsharing.de, falls die Spendenquittung nicht innerhalb von acht Wochen nach Abbuchung bei Ihnen sein sollte.</span></p>
<p><span>Hier noch einige Informationen f&uuml;r Sie zur Spendenhaftung:<br /></span></p>
<h4><span>SPENDENHAFTUNG<br /></span></h4>
<p><span>Mit dem Jahresteuergesetz 2009 wurde die Haftung bei Fehlverwendung von Spendenmitteln klargestellt.<br /> K&uuml;nftig haftet der Vorstand pers&ouml;nlich, wenn die Haftungssumme beim Verein nicht einzutreiben ist.<br /></span>Die Haftung soll dem Missbrauch mit Zuwendungsbest&auml;tigungen entgegenwirken.<br />Dies ist z.B. dann der Fall, wenn</p>
<ul>
<li>eine nicht spendenbeg&uuml;nstigte K&ouml;rperschaft Zuwendungsbest&auml;tigungen ausstellt,</li>
<li>der Wert der Spende in der Best&auml;tigung zu hoch angegeben wird,</li>
<li>die Best&auml;tigungen &uuml;ber nicht gezahlte Spenden ausgestellt werden.</li>
<li>Mitgliedsbeitr&auml;ge als Spenden deklariert wurden Best&auml;tigungen &uuml;ber Spenden f&uuml;r <br />einen steuerpflichtigen wirtschaftlichen Gesch&auml;ftsbetrieb ausgestellt werden.</li>
</ul>
<h4><span>AUSSTELLERHAFTUNG</span></h4>
<p><span>Die Ausstellerhaftung bezieht sich auf unrichtig ausgestellte Spendenbest&auml;tigungen. Das kann<br /> sich sowohl auf die Zahlung als solche (d. h. den ausgewiesenen Betrag) als auch auf die Best&auml;tigung<br /> des Spendenzweckes durch den Empf&auml;nger beziehen. Das betrifft:</span></p>
<ul>
<li>auf die H&ouml;he des zugewendeten Betrags (tats&auml;chlich wurde ein niedrigerer Betrag gespendet, Gef&auml;lligkeitsbescheinigungen)</li>
<li>den beabsichtigten Verwendungszweck (z. B. f&uuml;r den steuerpflichtigen Bereich)</li>
<li>und den steuerbeg&uuml;nstigten Status des Spendenempf&auml;ngers (keine g&uuml;ltiger Freistellungsbescheid)</li>
</ul>
<p><span>Voraussetzung f&uuml;r, die Ausstellerhaftung greift, ist ein vors&auml;tzliches oder grob fahrl&auml;ssiges Verschulden<br /> des Ausstellenden.</span></p>
<h4><span>VERANLASSERHAFTUNG</span></h4>
<p><span>Haftungstatbestand ist hier die zweckentfremdete Verwendung von Zuwendungen. Die "Veranlassung" <br />geschieht in der Regel durch die Vorst&auml;nde. Die Veranlasserhaftung erfasst Fehlverhalten des Empf&auml;ngers<br /> in Zusammenhang mit der Spendenverwendung. Eine Fehlverwendung liegt z. B. dann vor, wenn die <br />Zuwendung in einem steuerpflichtigen wirtschaftlichen Gesch&auml;ftsbetrieb verwendet wird, etwa zur<br /> Verlustabdeckung.</span></p>
<p><span>Eine Fehlverwendung und damit eine Spendenhaftung sind jedoch nicht gegeben, wenn der Empf&auml;nger<br /> die Zuwendung zu dem in der Best&auml;tigung angegebenen steuerbeg&uuml;nstigten Zweck verwendet hat, auch<br /> wenn nicht als gemeinn&uuml;tzig anerkannt wird.</span></p>
<h4><span>WER HAFTET?</span></h4>
<p><span>Die Ausstellerhaftung trifft grunds&auml;tzlich nur die K&ouml;rperschaft, da &sect; 50 Abs. 1 EStDV ausdr&uuml;cklich anordnet, <br />dass Zuwendungsbest&auml;tigungen vom Empf&auml;nger auszustellen sind.<br /><span>Gegen&uuml;ber einer nat&uuml;rlichen Person greift die Ausstellerhaftung allenfalls dann ein, wenn die Person<br /> au&szlig;erhalb des ihr zugewiesenen Wirkungskreises gehandelt hat.<br /><span>Auch bei der Veranlasserhaftung wird die K&ouml;rperschaft (der Verein) in Haftung genommen, da durch die <br />Haftung ein Fehlverhalten des Empf&auml;ngers der Zuwendung im Zusammenhang mit der Spendenverwendung<br /> sanktioniert werden soll. Hier ist aber nach bisheriger Rechtsprechung eine Durchgriffshaftung auf die <br />Vorstandsmitglieder m&ouml;glich.<br /><span>Mit dem Jahressteuergesetz 2009 hat der Gesetzgeber die Haftungsreihenfolge bei der Veranlasserhaftung<br /> klargestellt: Vorrangig haftet der Empf&auml;nger der Zuwendungen (die gemeinn&uuml;tzige K&ouml;rperschaft). Eine<br /> Inanspruchnahme der gesetzlichen Vertreter (Vorstand) ist erst zul&auml;ssig, wenn die Inanspruchnahme der<br /> K&ouml;rperschaft erfolg- bzw. aussichtslos ist, der Haftungsanspruch also weder durch Zahlung, Aufrechnung, Erlass oder<br /> Verj&auml;hrung erloschen ist noch Vollstreckungsma&szlig;nahmen gegen ihn zum Erfolg f&uuml;hren.<br /><br /><span>Nach &sect; 10b Abs. 4 des Einkommensteuergesetzes haftet der Vereinsvertreter f&uuml;r die Richtigkeit der Angaben auf<br /> der Spendenbest&auml;tigung. Die entgangene Steuer wird mit 30% des zugewendeten Betrags angesetzt.<br /><br /><span>F&uuml;r die entgangene Steuer haftet, wer vors&auml;tzlich oder grob fahrl&auml;ssig eine unrichtige Spendenbest&auml;tigung <br />ausstellt (</span><span>Ausstellerhaftung</span><span>) oder wer veranlasst, dass Zuwendungen nicht zu den in der Best&auml;tigung angegebenen <br />steuerbeg&uuml;nstigten Zwecken verwendet werden (</span><span>Veranlasserhaftung</span><span>). Die Inanspruchnahme zur Haftung setzt <br />voraus, dass beim Spender Vertrauensschutz gem&auml;&szlig; - er also nicht um die Unrichtigkeit der Spendenbest&auml;tigung <br />wusste.<br /><br /><span>&sect; 50 Abs. 1 EStDV<br /><a href="http://dejure.org/gesetze/EStDV/50.html" target="_blank"><span>http://dejure.org/gesetze/EStDV/50.html</span></a></span></span></span></span></span></span></span></p>
<p><span>Gesetze zur F&ouml;rderung b&uuml;rgerlichen Engagements<br /><a href="http://www.bgbl.de/Xaver/start.xav?startbk=Bundesanzeiger_BGBl&amp;start=//*%5B@attr_id=\'bgbl107s2332.pdf\'%5D" target="_blank">http://www.bgbl.de/Xaver/start.xav?startbk=Bundesanzeiger_BGBl&amp;start=//*[@attr_id=\'bgbl107s2332.pdf\']</a></span></p>
<p><span>&sect; 10b Abs. 4<br /><a href="http://www.vereinsbesteuerung.info/frameestg.htm#%C2%A7%2010b" target="_blank">http://www.vereinsbesteuerung.info/frameestg.htm#&sect; 10b</a></span></p>
<p></p>
<p></p>
<h3>EINKAUFEN UND SPENDEN &Uuml;BER SCHULENGEL.DE</h3>
<h4>HILF&rsquo; UNS DABEI MEHR SPENDEN ZU GENERIEREN... WIR Z&Auml;HLEN AUF DICH!</h4>
<p>Liebe Community , wir machen jetzt bei Schulengel.de mit. Ihr k&ouml;nnt Foodsharing unterst&uuml;tzen, indem ihr f&uuml;r Eure<br /> Online-Eink&auml;ufe in Zukunft einen Umweg von zwei Klicks macht. Das klappt mit den meisten Online-Shops. Wenn<br /> ihr etwas &uuml;ber unsere Seite bei Schulengel.de einkauft bekommen wir als Dankesch&ouml;n eine Provision als Spende<br /> &uuml;berwiesen. Euch kostet es keinen Cent mehr und wir k&ouml;nnen mit neuen Mitteln weiter an der Verbesserung der von<br /> foodsharing.de arbeiten.</p>
<p><strong>Wir z&auml;hlen auf eure Unterst&uuml;tzung, viele Gr&uuml;&szlig;e euer Foodsharing-Team.</strong></p>
<h4>WICHTIGE LINKS:</h4>
<p>So funktioniert es:&nbsp;<br /><a href="https://www.schulengel.de/de/spenden/sogehts/" target="_blank">https://www.schulengel.de/de/spenden/sogehts/</a></p>
<p>Los geht&rsquo;s:<br /><a href="https://www.schulengel.de/de/start/helfen-ohne-registrierung/?idEinrichtung=5599" target="_blank">https://www.schulengel.de/de/start/helfen-ohne-registrierung/?idEinrichtung=5599</a></p>
<p>Unsere Seite auf Schulengel.de:<br /><a href="https://www.schulengel.de/de/einrichtungen/einrichtung-anzeigen/spendenstand/profil/foodsharing-ev/" target="_blank">https://www.schulengel.de/de/einrichtungen/einrichtung-anzeigen/spendenstand/profil/foodsharing-ev/</a></p>
<p>&Uuml;ber Schulengel.de:<br /><a href="https://www.schulengel.de/de/ueberuns/wer-ist-schulengel/" target="_blank">https://www.schulengel.de/de/ueberuns/wer-ist-schulengel/</a></p>
<p>FAQs:<br /><a href="https://www.schulengel.de/de/ueberuns/fragen-und-antworten/" target="_blank">https://www.schulengel.de/de/ueberuns/fragen-und-antworten/</a></p>
<p>Argumentation f&uuml;r Z&ouml;gerer:<br /><a href="https://www.schulengel.de/de/info/hilfe/mehr-geld/erfolgreich-mitschulengel/argumente-fuer-zoegerer/" target="_blank">https://www.schulengel.de/de/info/hilfe/mehr-geld/erfolgreich-mitschulengel/argumente-fuer-zoegerer/</a></p>
<p>Schulengel Add-On:&nbsp;<br /><a href="https://www.schulengel.de/de/spenden/shop-engel/" target="_blank">https://www.schulengel.de/de/spenden/shop-engel/</a><a href="https://www.schulengel.de/de/spenden/shop-engel/" target="_blank"></a></p>
<p></p>
<h2>Kassenbericht 2014:&nbsp;</h2>
<h2></h2>
<p>Die Einnahmen des Vereins bestehen aus Spenden, Einnahmen von der Welthungerhilfe f&uuml;r den Essensretter Brunch und aus dem Verkauf von Foodsharing T-Shirts. Die &Uuml;berschussrechnung weist Einnahmen 2014 insgesamt 10.393,75 &euro; auf.&nbsp;</p>
<p><span>Dem gegen&uuml;ber stehen Ausgaben in H&ouml;he von 11.531,29 &euro; gegen&uuml;ber, so dass sich ein Unterschuss von 1,137,54 &euro;.&nbsp;</span></p>
<p></p>
<h4><span>Ausgaben</span></h4>
<p><span>F&uuml;r den Minijob der Gesch&auml;ftsf&uuml;hrerin wurden 3.536, 76 &euro; ausgegeben.&nbsp;</span></p>
<p><span>Betriebsausgaben f&uuml;r die Homepage und Internet 3.495,67 &euro;. Dieser Posten wird 2015 entfallen, weil durch die Internet Plattform Fusion vom 12.12.2014 mit den Lebensmittelrettern die Internetseite kostenlos programmiert wird.&nbsp;</span></p>
<p>Portokosten 507,21 &euro;&nbsp;<br />Reisekosten 619,70 &euro;&nbsp;<br />Rechtskosten 262,69 &euro;&nbsp;<br />Miete B&uuml;ro Foodsharing 225,00 - dieser Betrag wird 2015 entfallen Miete Treffen Leverkusen 141,00&euro;&nbsp;<br />Werbekosten 761,46 &euro;&nbsp;<br />Mitgliedschaft K&ouml;ln Agenda 51,00 &euro;&nbsp;<br />Honorar Referent beim Internationalem Treffen in Leverkusen 250,00 &euro;&nbsp;<br />Kontof&uuml;hrung 35,60&nbsp;</p>
<p><span>Das Minus zum 31.12.2014 erkl&auml;rt sich dadurch, dass die F&ouml;rdermitgliedsbeitr&auml;ge im M&auml;rz 2014 nicht eingezogen wurden.&nbsp;</span></p>
<p><span>Die Beitr&auml;ge wurden im Mai 2015 dem Vereinskonto gutgeschrieben. Das Konto befindet sich derzeit im Guthaben.&nbsp;</span></p>
<p><span>Stand 12.12.2015</span></p>',
                    'last_mod' => '2017-02-18 22:25:27',
                ),
            42 =>
                array (
                    'id' => 43,
                    'name' => 'int_workshop_de',
                    'title' => 'Anmeldung zu den Workshops für das Internationale foodsharing Treffen',
                    'body' => '<h3>Der Anmeldezeitraum ist leider abgelaufen. Bitte setze Dich vor Ort mit dem Organisationsteam in Verbindung, um an Workshops teilzunehmen.</h3>
<!-- - <p><span>Die folgenden Workshops sind aus rein </span><span>ehrenamtlichen Engagement</span><span> der externen Organisationen oder den Foodsavern entstanden.</span></p>
<p><span>Wir freuen uns riesig auf die Beteiligung und w&uuml;nschen viel Spa&szlig;.</span>&nbsp;</p>
<p><span>Vor Ort erfahrt Ihr, wo der jeweilige Workshop stattfindet.</span></p>
<p><span>&nbsp;</span></p>
<p><span>Prozedere:</span><span><strong> Bis zum 27.04. k&ouml;nnt Ihr Euren Erst- , Zweit- und Drittwunsch ausw&auml;hlen und ggf. auch noch &auml;ndern, falls Ihr Euch umentscheidet.</strong>&nbsp;Du erf&auml;hrst auf dem Treffen, an welchen Workshops Du teilnehmen kannst.</span></p>
<p><span>Wir ber&uuml;cksichtigen aus Gr&uuml;nden der Fairness nur maximal zwei Teilnahmen pro Person.</span></p>
<p><span><br /><a href="http://wiki.lebensmittelretten.de/Datei:Workshops_bild.jpg" target="_blank">Hier findest Du einen &Uuml;bersichtsplan &uuml;ber die stattfindenden Workshops</a><br /></span></p>
<p></p>
<p><a href="http://wiki.lebensmittelretten.de/Event_Workshops" target="_blank">Alle Erkl&auml;rungen zu den Workshops findet Ihr hier.</a></p>
<p></p>
<p>{{FORM}}</p>
<p></p>
<p><span>Bitte beachtet, dass pro Teilnehmer vorerst </span><strong>max. 2 Workshops</strong><span> vorangemeldet- &nbsp;werden k&ouml;nnen.</span></p>
<p>Am Infopoint findet Ihr noch einmal eine &Uuml;bersicht wann Euer Workshop stattfinden wird und vor allem in welchem Raum Ihr Euch treffen werdet. <br />Bitte seid<strong> mindestens 5 min.</strong> vor Workshopbeginn beim jeweiligen Treffpunkt, damit dieser auch p&uuml;nktlich starten kann. Solltet Ihr spontan an einem Workshop doch nicht teilnehmen, meldet Euch bitte beim Infopoint rechtzeitig ab.</p>
<p>Du m&ouml;chtest vielleicht sogar selbst einen Workshop anleiten?</p>
<p><span>Ideen f&uuml;r weitere Workshops sind bereits da - nur die entsprechenden Leute fehlen f&uuml;r:</span></p>
<p><span>Petition (z.B. zum Thema Lebensmittelverschwendungs-Verbot) oder </span></p>
<p><span>&Ouml;ffentlichkeitswirksames FairTeilen</span></p>
<p>Wenn Du selbst einen Workshop anbieten m&ouml;chtest, so schreibe bitte eine Email an&nbsp;<a href="mailto:spring2015@lebensmittelretten.de" target="_blank">spring2015@lebensmittelretten.de</a><a href="mailto:spring2015@lebensmittelretten.de" target="_blank"></a></p>
<p></p>
<p><span>T&auml;glich werden 50 - 100 SchnipplerInnen gesucht. Bitte meldet Euch an der Anmeldung, ob ihr Freitag 15 bis 18 Uhr oder Samstag 15 bis 18 Uhr schnippeln k&ouml;nnt / wollt. F&uuml;r Donnerstag werden die SchnipplerInnen bereits im Anmeldeformular gesucht.</span></p>
<p><span>&nbsp;</span></p>
<p><span>Vielen Dank f&uuml;r Deine Anmeldung!</span></p>
<p><span>&nbsp;</span></p>
<p><span>Alles Liebe</span></p>
<p><span>Euer Foodsharing Orgateam f&uuml;rs Internationale Treffen</span></p>
<p><span>&nbsp;</span></p>
<p></p>
<p></p>
<p></p> -->',
                    'last_mod' => '2015-04-28 01:03:47',
                ),
            43 =>
                array (
                    'id' => 44,
                    'name' => 'int_workshop_en',
                    'title' => 'Workshop registration for International foodsharing meeting',
                    'body' => '<h3>Workshop signup is not possible anymore, please contact us on place.</h3>
<!--<p><span>The following workshops evolved from a purely </span><span>voluntary engagement</span><span> of external organisations or Foodsavers.</span></p>
<p><span>We are very much looking forward to the participation and hope you will have a lot of fun.</span></p>
<p><span>We will inform you on site, where the respective workshop will take place.</span></p>
<p></p>
<p><span>Procedure: </span><strong>You can select your first, second and third choice until April 27 and change it, if necessary, in case you will change your mind. </strong>We will tell you on the events, which workshops you may attend.</p>
<p><span>For reasons of fairness, we will only consider a maximum of two participations per person.</span></p>
<p><span><br /><a href="http://wiki.lebensmittelretten.de/Datei:Workshops_img.jpg" target="_blank">See an overview of all available workshops here</a><br /></span></p>
<p></p>
<p><span><a href="http://wiki.lebensmittelretten.de/Event_Workshops_engl" target="_blank">Detailed information about the workshops here.</a></span></p>
<p></p>
<p><span>{{FORM}}</span></p>
<p></p>
<p><span>Please note that a <strong>maximum of 2 workshops</strong> can be registered per participant, so far. You will find a workshop overview and information about the rooms at the info desk. Please be 5 minutes before the beginning on place so all workshops can start on time. Please also consider telling us if you cannot manage to take part in a workshop you are subscribed to.</span></p>
<p></p>
<p><span>You want to have your own workshop?</span></p>
<p><span>There are already ideas for further workshops, but there is lack of (wo)manpower for:</span></p>
<p><span>petition (e.g. for banning the waste of food) or public-oriented fair sharing.</span></p>
<p>If you want to organize a workshop yourself, please write to&nbsp;<a href="mailto:spring2015@lebensmittelretten.de" target="_blank">spring2015@lebensmittelretten.de</a><a href="mailto:spring2015@lebensmittelretten.de" target="_blank"></a></p>
<p></p>
<p>Additionally, we need people help preparing the food (Friday and Saturday 15:00-18:00). Please tell us at the info point if you are able to help.</p>
<p></p>
<p><span>Thank you for your registration.</span></p>
<p></p>
<p><span>Best wishes</span></p>
<p><span>Your foodsharing organisation team for the international meeting </span></p>
<p><span>&nbsp;</span></p>
<p></p>
<p></p>
<p></p>-->',
                    'last_mod' => '2015-04-28 01:02:46',
                ),
            44 =>
                array (
                    'id' => 45,
                    'name' => 'not_verified_for_bie',
                    'title' => 'Noch nicht verifiziert',
                    'body' => '<p></p>
<p>Dein Botschafter muss dich erst Verifizieren, anschlie&szlig;end kannst du das Betriebsverantwortlichen Quiz machen.</p>
<p>Bitte spreche deinen Botschafter auf deine Verifizierung an.&nbsp;</p>',
                    'last_mod' => '2015-05-04 17:39:44',
                ),
            45 =>
                array (
                    'id' => 46,
                    'name' => 'leere-tonne-info',
                    'title' => 'Leere Tonne - Wegwerfstopp für Supermärkte!',
                    'body' => '<p><img src="http://media.lebensmittelretten.de/files/Materialienkatalog/Sonstiges/Banner%20Webseite.png" width="965" /></p>
<p><span></span><span><span>Superm&auml;rkte und andere H&auml;ndler*innen verursachen 14% der Lebensmittelverschwendung&sup1;! Was sie dabei ungern zugeben: &Uuml;ber 90% davon k&ouml;nnte vermieden werden! Da auf freiwilliger Basis bisher sehr wenig passiert ist, fordern wir eine gesetzliche L&ouml;sung nach franz&ouml;sischem und wallonischem Vorbild, um die Verschwendung zu reduzieren. </span><strong>Unsere Forderung kannst du in 30 Sekunden unter <a href="http://www.leeretonne.de/" target="_blank" style="text-decoration: none;">leeretonne.de</a> unterschreiben:</strong></span></p>
<p>&ldquo;(...) Super&shy;m&auml;rkte und andere Lebens&shy;mit&shy;tel&shy;h&auml;nd&shy;ler sind zu ver&shy;pflich&shy;ten, alle unver&shy;k&auml;uf&shy;li&shy;chen, aber noch genie&szlig;&shy;ba&shy;ren Lebens&shy;mit&shy;tel an Orga&shy;ni&shy;sa&shy;tio&shy;nen abzu&shy;ge&shy;ben, die dem Gemein&shy;wohl ver&shy;pflich&shy;tet sind, oder ihren Mit&shy;ar&shy;bei&shy;tern oder Kun&shy;den zu schenken. Was nicht mehr f&uuml;r den mensch&shy;li&shy;chen Ver&shy;zehr geeig&shy;net ist, sollte an Tiere ver&shy;f&uuml;t&shy;tert wer&shy;den. Kom&shy;pos&shy;tie&shy;rung und &bdquo;Ener&shy;ge&shy;ti&shy;sche Ver&shy;wer&shy;tung&ldquo;, wie die Ver&shy;bren&shy;nung oder Ver&shy;g&auml;&shy;rung zu Bio&shy;gas, soll nur m&ouml;g&shy;lich sein, wenn die Lebens&shy;mit&shy;tel weder f&uuml;r Mensch noch Tier geeig&shy;net sind.&rdquo;</p>
<p><span>Die Kampagne wird von foodsharing, </span><a href="https://www.aktion-agrar.de/wegwerfstopp/" target="_blank" style="text-decoration: none;"><span>Aktion Agrar</span></a><span>, der </span><a href="http://www.bundjugend.de/blog/kampagne/leere-tonne/" target="_blank" style="text-decoration: none;"><span>BUNDjugend</span></a><span> und </span><a href="http://slowfoodyouth.de/leere-tonne-kampagne/" target="_blank" style="text-decoration: none;"><span>Slow Food Youth</span></a><span> getragen. Wir konzentrieren uns auf den Handel, weil er eine Scharnierfunktion hat: Einerseits werden dort eine Menge Lebensmittel weggeworfen und andererseits ent&shy;schei&shy;det der Handel durch die Beschaf&shy;fungs&shy;pra&shy;xis mit dar&shy;&uuml;ber, wieviel Gem&uuml;se als unver&shy;k&auml;uf&shy;lich auf den &Auml;ckern ver&shy;bleibt. Durch seine Wer&shy;bung und Kauf&shy;an&shy;reize mit&shy;tels Son&shy;der&shy;an&shy;ge&shy;bo&shy;ten und Gro&szlig;&shy;ge&shy;bin&shy;den steu&shy;ert er, was und wie&shy;viel Kon&shy;su&shy;men&shy;t*in&shy;nen mehr nach Hause tra&shy;gen, als sie eigent&shy;lich ben&ouml;&shy;ti&shy;gen. Das f&uuml;hrt zu Kon&shy;sum&shy;rausch und ver&shy;sch&auml;rft die &Uuml;ber&shy;pro&shy;duk&shy;tion ent&shy;lang der gesam&shy;ten Produktionskette.</span></p>
<p><span>Wenn Du mehr Informationen haben m&ouml;chtest, warum wir aktiv sind, dann besuch uns gerne unter </span><a href="http://www.leeretonne.de/" target="_blank" style="text-decoration: none;"><span>leeretonne.de</span></a><span>. Bei Fragen steht Dir das foodsharing-Team der Leeren Tonne unter </span><a href="mailto:leeretonne@lebensmittelretten.de" target="_blank" style="text-decoration: none;"><span>leeretonne@lebensmittelretten.de</span></a><span> zur Verf&uuml;gung - wir suchen auch noch Mitarbeitende, die sich f&uuml;r den Wegwerfstopp einsetzen wollen und spannende Aktionen mitplanen m&ouml;chten!</span></p>
<p></p>
<p><strong>Was bisher geschah:</strong></p>
<p><span>Im Juli haben wir eine Aktion vor der REWE-Zentrale in K&ouml;ln gestartet. Wir gehen davon aus, dass die meisten Supermarkt-Ketten die B&auml;ckereien im Eingangsbereich vertraglich dazu verpflichten, bis Ladenschluss f&uuml;r volle Regale zu sorgen. Das f&uuml;hrt zu einer Verschwendung aller Backwaren, die dann noch &uuml;brig sind, denn insgesamt landen 25% der Backwaren in Deutschland auf dem M&uuml;ll! Im Juli haben wir eine Demonstration vor der REWE-Zentrale in K&ouml;ln gestartet, da foodsharing einen solchen Knebelvertrag zwischen REWE und einer B&auml;ckerei offen legen konnte. Die Aktion hatte ein gro&szlig;es Medienecho, was uns sehr gefreut hat, denn dadurch haben wir viele Menschen erreicht!</span></p>
<p><img src="http://www.leeretonne.de/wp-content/uploads/2015/07/IMG_7483.jpeg?50fee3" width="400" /></p>
<p><span>Zum Weltern&auml;hrungstag am 16.10. haben wir Bundestagsabgeordnete zu einer gro&szlig;en Tafel aus geretteten Lebensmitteln eingeladen, um erlebbar zu machen, wie viel Essen im M&uuml;ll landet!</span></p>
<p><span><img src="http://www.leeretonne.de/wp-content/uploads/2015/10/Bild_ganz_Leere_tonne.jpg?50fee3" width="400" /></span></p>
<p><span><span>In der Vorweihnachtszeit 2015 sind in &uuml;ber 20 St&auml;dten Weihnachtsm&auml;nner in M&uuml;lltonnen auf die Stra&szlig;e gegangen und haben gegen den Wegwerfwahn protestiert: Vermutlich kennst Du das auch, dass Du bei Abholungen nach Weihnachten ganz viel Weihnachtsschokolade abholst? Sie wird nur aussortiert (und landet ohne foodsharing &amp; Tafel im M&uuml;ll), weil die Saison vorbei ist - und mit ihr wird auch der wertvolle Kakao aus dem globalen S&uuml;den entsorgt. Deswegen wurden Postkarten unterschrieben und an Bundestagsabgeordnete &uuml;bergeben - mit der Forderung nach einem bundesweiten Gesetz!</span></span></p>
<p><span><img src="http://www.leeretonne.de/wp-content/uploads/2015/07/IMG_8110-copy.jpg?50fee3" width="400" /></span></p>
<p><span>Alle weiteren News findest Du </span><a href="http://www.leeretonne.de/news/" target="_blank" style="text-decoration: none;"><span>hier.</span></a></p>
<p><strong>Statement von Valentin Thurn, foodsharing-Gr&uuml;nder und Filmemacher (&lsquo;Taste the Waste&rsquo;)</strong></p>
<p><span>Don\'t waste it &mdash; taste it!</span></p>
<p><span>Es ist ein Skan&shy;dal, dass die H&auml;lfte aller Lebens&shy;mit&shy;tel ver&shy;schwen&shy;det wird. Wir suchen mit ver&shy;ant&shy;wor&shy;tungs&shy;be&shy;wu&szlig;&shy;ten H&auml;nd&shy;lern nach L&ouml;sungen.</span></p>
<p><span><img src="http://www.leeretonne.de/wp-content/uploads/2015/07/leeretonne_Valentin.jpg?50fee3" width="200" /></span></p>
<p><strong>Statement von Raphael Fellmer, Gr&uuml;nder von Lebensmittelretten</strong></p>
<p><span>Ein Ach&shy;tel der Welt&shy;be&shy;v&ouml;l&shy;ke&shy;rung lei&shy;det an Hun&shy;ger. Dabei m&uuml;ss&shy;ten sie es gar nicht, denn die welt&shy;weite Pro&shy;duk&shy;tion von Lebens&shy;mit&shy;teln gen&uuml;gt, um 14 Mil&shy;li&shy;ar&shy;den Men&shy;schen satt zu machen. Und doch wird ein Drit&shy;tel der glo&shy;ba&shy;len Land&shy;wirt&shy;schaft ver&shy;schwen&shy;det. Dem kann und will ich nicht mehr taten&shy;los zuse&shy;hen. Die Ver&shy;ant&shy;wor&shy;tung f&uuml;r die 1,3 Mil&shy;li&shy;ar&shy;den Ton&shy;nen weg&shy;ge&shy;wor&shy;fe&shy;ner Lebens&shy;mit&shy;tel liegt in unse&shy;ren H&auml;nden!</span></p>
<p><span>Des&shy;we&shy;gen setze ich mich seit &uuml;ber 5 Jah&shy;ren ehren&shy;amt&shy;lich gegen die Ver&shy;schwen&shy;dung von Lebens&shy;mit&shy;teln ein und bin dank&shy;bar, dass das Thema end&shy;lich auf den Tisch kommt und es die Peti&shy;tion Leere Tonne gibt. Es ist ein Zei&shy;chen f&uuml;r einen klei&shy;nen, aber bedeu&shy;ten&shy;den Schritt auf dem Weg zur&uuml;ck zur Wert&shy;sch&auml;t&shy;zung der Lebensmittel.</span></p>
<p><span>Ich bin &uuml;ber&shy;zeugt, dass die Aktion Leere Tonne ein wich&shy;ti&shy;ger Bestand&shy;teil sein wird, um Lebens&shy;mit&shy;tel in Zukunft auf geson&shy;derte Weise zu ent&shy;sor&shy;gen. N&auml;m&shy;lich wo sie hin&shy;ge&shy;h&ouml;&shy;ren: in unse&shy;re M&auml;gen.</span></p>
<p><img src="http://www.leeretonne.de/wp-content/uploads/2015/07/Raphael_testimonial.jpg?50fee3" width="200" /></p>
<p></p>
<p>Quelle:</p>
<p>&sup1; <a href="http://www.wwf.de/fileadmin/fm-wwf/Publikationen-PDF/WWF_Studie_Das_grosse_Wegschmeissen.pdf" target="_blank" style="text-decoration: none;">http://www.wwf.de/fileadmin/fm-wwf/Publikationen-PDF/WWF_Studie_Das_grosse_Wegschmeissen.pdf</a><span> </span></p>',
                    'last_mod' => '2015-12-30 09:49:07',
                ),
            46 =>
                array (
                    'id' => 47,
                    'name' => 'foodsharingschweiz-t',
                    'title' => 'wird ignoriert',
                    'body' => '<div class="biglogo">
<div class="centerblock"></div>
<div class="centerblock"><img src="/img/gabel.png" width="20%" />
<p>Teile Lebensmittel,</p>
<p class="small">anstatt sie wegzuwerfen!</p>
<h1><span>food</span>sharing<span></span></h1>
<p></p>
</div>
<p class="small">foodsharing.de | foodsharingschweiz.ch</p>
<p class="small"><a target="_blank">info@foodsharingschweiz.ch</a></p>
<p class="small">St&auml;dtekontakte: <a href="mailto:info@foodsharingschweiz.ch" target="_blank">Basel</a>&nbsp;| <a href="mailto:bern@lebensmittelretten.de" target="_blank">Bern</a>&nbsp;| <a href="mailto:luzern@lebensmittelretten.de" target="_blank">Luzern</a>&nbsp;| <a href="mailto: zuerich@lebensmittelretten.de" target="_blank">Z&uuml;rich</a>&nbsp;| <a href="mailto:zug@lebensmittelretten.de" target="_blank">Zug</a></p>
<p class="small">Direktlinks: <a href="https://www.youtube.com/watch?v=dqsVjuK3rTc&amp;feature=youtu.be" target="_blank">Erkl&auml;rungsvideo</a> |&nbsp;<a href="http://wiki.lebensmittelretten.de/Hauptseite" target="_blank">Info-Wiki</a> |&nbsp;<a href="https://foodsharingschweiz.ch/karte" target="_blank">Karte</a></p>
<p class="small"><a href="https://www.facebook.com/FoodsharingCH" target="_blank">Facebook</a></p>
</div>',
                    'last_mod' => '2016-10-02 22:32:50',
                ),
            47 =>
                array (
                    'id' => 48,
                    'name' => 'beta-foodsharing-mai',
                    'title' => 'Beta foodsharing Startseite',
                    'body' => '<div class="biglogo">
<div class="centerblock"><img src="/img/gabel.png" width="25%" />
<p>Teile Lebensmittel,</p>
<p class="small">anstatt sie wegzuwerfen!</p>
<h1><span>food</span>sharing<span>.de</span></h1>
</div>
</div>
<div class="biglogo">
<h1><span>Willst Du uns unterst&uuml;tzen?</span></h1>
<br />
<p class="small"><a href="https://foodsharing.de/unterstuetzung" target="_blank">zum Aufruf</a> <span>oder</span> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=CLPZCSCKGNXE4" target="_blank">direkt zu PayPal</a></p>
</div>',
                    'last_mod' => '2017-02-03 17:28:36',
                ),
            48 =>
                array (
                    'id' => 49,
                    'name' => 'aktion-fairteiler',
                    'title' => 'Rette die Fair-Teiler!',
                    'body' => '<h2><img src="http://media.lebensmittelretten.de/files/Upload%20sonstiges/1.png" width="400" /></h2>
<p>Die Berliner Lebensmittel&auml;mter m&ouml;chten <a href="http://www.berliner-zeitung.de/berlin/petition-fuer--fairteiler--gegruendet-foodsharing-initiative-wehrt-sich-gegen-auflagen-der-lebensmittelaufsicht,10809148,33732024.html" target="_blank"><span>Auflagen f&uuml;r foodsharing Fair-Teiler vorschreiben</span></a><span>, weil sie die Fair-Teiler als Lebensmittelbetrieb einstufen. Das w&uuml;rde uns dazu zwingen, viele Fair-Teiler in Berlin zu schlie&szlig;en! Allerdings betreibt foodsharing inzwischen &uuml;ber 350 Fair-Teiler - und an keinem anderen Ort wird der Einsatz von tausenden Ehrenamtlichen gegen die Lebensmittelverschwendung so torpediert! Deswegen fordern wir eine realistische Einsch&auml;tzung der Sachlage durch die Beh&ouml;rden und einen gut ausgearbeiteten Leitfaden f&uuml;r Fair-Teiler vom Berliner Senat. </span><strong>Wenn Du uns unterst&uuml;tzen und die Fair-Teiler retten m&ouml;chtest</strong><span><span><strong>,</strong> dann <span> </span><a href="https://weact.campact.de/p/fair-teiler-retten" target="_blank" style="text-decoration: none;"><span>unterschreibe unsere Petition</span></a><span> und</span>&nbsp;<a href="mailto:Eva-maria.Milke@ba-fk.berlin.de,Torsten.Kuehne@ba-pankow.berlin.de,sabine.toepfer-kataw@senjust.berlin.de,ordvetleb1@ba-pankow.berlin.de,staatssekretaerin@senjust.berlin.de?bcc=petition@lebensmittelretten.de&amp;subject=Beschwerde&amp;body=Sehr%20geehrte%20Frau%20Staatssekret%C3%A4rin%20Toepfer-Kataw%2C%20Herr%20Stadtrat%20K%C3%BChne%2C%20Herr%20Dr.%20Zengerling%20und%20Frau%20Milke%2C%0A%0A%0A" target="_blank">schicke eine Mail an die verantwortlichen Personen</a> (siehe Vorlage weiter unten), damit deutlich wird, wie viele Menschen den Protest unterst&uuml;tzen!</span></span></p>
<p>A) Unsere Forderungen <br /> B) Was passierte <br /> C) Was die Beh&ouml;rden von uns fordern<br /> D) Warum wir Fair-Teiler brauchen <br />E) Wie kann ich unterst&uuml;tzen? <br />F) Presseecho <br />G) Mail-Vorlage</p>
<h2><strong>A) Unsere Forderungen</strong></h2>
<ul>
<li><span>Das Lebensmittelamt in Berlin soll Fair-Teiler als privaten &Uuml;bergabeort und nicht als Lebensmittelbetrieb einstufen - wie andere St&auml;dte auch!</span></li>
<li><span>Der Senat soll einen Leitfaden mit foodsharing zum Betreiben von Fair-Teilern erarbeiten. Schon jetzt hat foodsharing ausgereifte Regelungen - wenn diese mit dem Senat verfeinert werden, hat das Lebensmittelamt eine Richtlinie, an die es sich halten kann. Dar&uuml;ber hinaus m&ouml;ge sich der Senat auf EU-Ebene f&uuml;r eine eindeutigere Gesetzeslage einsetzen, so dass Fair-Teiler ohne Zweifel europaweit als private &Uuml;bergabeorte gelten!</span></li>
</ul>
<h2><strong>B) Was passierte</strong></h2>
<p><span>Wir sind sehr entt&auml;uscht &uuml;ber die Vorgehensweise vom Lebensmittelaufsichtsamt und dem Senat! Bei einem pers&ouml;nlichen Treffen am 7.1.2016 im Amt haben wir gemeinsam mit Herrn Dr. Zengerling und Frau Milke&nbsp;<span>(Lebensmittelaufsicht)</span> Auflagen ausgearbeitet. Diese Absprachen wurden in den Auflagen ignoriert! Dar&uuml;ber hinaus hat Frau Staatssekret&auml;rin T&ouml;pfer-Kataw </span><a href="http://www.morgenpost.de/berlin/article206992037/Oeffentliche-Kuehlschraenke-koennten-bald-verboten-werden.html" target="_blank"><span>nur die Presse</span></a><span> &uuml;ber die neuen Auflagen informiert, ohne uns in Kenntnis zu setzen - mit einem Monat Versp&auml;tung wurden uns die Auflagen offiziell zugesandt!<br /><br /> Das Lebensmittelaufsichtsamt in Berlin-Pankow unter der Leitung von Herrn Dr. Zengerling hat uns mitgeteilt, dass Bu&szlig;gelder von bis zu 50.000&euro; gefordert werden k&ouml;nnen, wenn Auflagen nicht erf&uuml;llt w&uuml;rden. Bis jetzt wurden bereits mehrere Fair-Teiler geschlossen. Herr Dr. Zengerling sieht in den Fair-Teilern, so wie wir sie bisher betreiben, ein hohes gesundheitliches Risiko und m&ouml;chte sich selber vor rechtlichen Konsequenzen absichern, da er bei Schadensf&auml;llen nicht wegen Fahrl&auml;ssigkeit belangt werden m&ouml;chte. Wir k&ouml;nnen diese Sorge nicht nachvollziehen: Die </span><a href="http://wiki.lebensmittelretten.de/images/f/fd/Fairteiler_regeln.pdf" target="_blank" style="text-decoration: none;"><span>foodsharing-Regelungen</span></a><span> wurden mit mehreren f&uuml;hrenden LebensmittelkontrolleurInnen ausgearbeitet und schr&auml;nken die gesundheitlichen Risiken so weit es geht ein, so dass das nur ein kleines, unvermeidbares Restrisiko bleibt! Dar&uuml;ber hinaus konnten die Giftkeksangriffe (die nichts mit unseren Fair-Teilern zu tun hatten) in Berlin trotz strenger Richtlinien nicht durch das Lebensmittelamt vermieden werden und werden durch eine R&uuml;ckverfolgbarkeit nicht ausgeschlossen.</span></p>
<h2><strong>C) Was die Beh&ouml;rden von uns fordern</strong></h2>
<ul>
<li>Fair-Teiler m&uuml;ssen unter st&auml;ndiger Aufsicht einer verantwortlichen Person stehen</li>
<li>Nur diese Person darf Lebensmittel in den Fair-Teiler legen und muss die Lebensmittel vorher &uuml;berpr&uuml;fen und kennzeichnen</li>
<li>Wir m&uuml;ssen eine R&uuml;ckverfolgbarkeit gew&auml;hrleisten, also eine Liste f&uuml;hren, wer? wann? was? f&uuml;r Lebensmittel durch die Fair-Teiler in den Verkehr gebracht werden.</li>
</ul>
<p><span>Diese Auflagen sind f&uuml;r uns im privaten, ehrenamtlichen Bereich - wie bei Fair-Teilern -<span> nicht umsetzbar. Sie</span>&nbsp;w&uuml;rden daf&uuml;r sorgen, dass Fair-Teiler geschlossen werden m&uuml;ssen.<br />Deswegen setzen wir uns daf&uuml;r ein, dass Fair-Teiler weiterhin bestehen k&ouml;nnen!</span></p>
<p><span>Erst Ende Februar wurden diese Auflagen offiziell <a href="http://www.berlin.de/sen/verbraucherschutz/aufgaben/gesundheitlicher-verbraucherschutz/lebensmittelretter/artikel.445869.php" target="_blank">von der Senatsverwaltung ver&ouml;ffentlicht</a>. Die Argumentation beruft sich auf eine Verordnung, in der es hei&szlig;t: &bdquo;Lebensmittelunternehmen sind alle Unternehmen, (...) die eine mit der Produktion, der Verarbeitung und dem Vertrieb von Lebensmitteln zusammenh&auml;ngende T&auml;tigkeit ausf&uuml;hren.&ldquo; - Wir sind kein Unternehmen, Foodsaver*innen nicht einmal Mitglied des Vereins und deswegen auch kein Lebensmittelunternehmen! Deswegen halten wir die Argumentation f&uuml;r absolut hinf&auml;llig.</span></p>
<h2><span><strong>D) Warum wir Fair-Teiler brauchen</strong></span></h2>
<p><span>Die foodsharing-&Uuml;bergabeorte tragen zur Reduzierung der Lebensmittelverschwendung in Privathaushalten bei! Die Bundesregierung hat 2012 beschlossen, die Verschwendung bis 2020 zu halbieren und eine teure Kampagne adressiert an Privatpersonen gestartet: &ldquo;Zu gut f&uuml;r die Tonne&rdquo;. Jetzt stellen sich Verantwortliche aus den eigenen Reihen der CDU gegen diesen Beschluss, indem sie Fair-Teiler als innovativen Weg nicht mehr erm&ouml;glichen!<br />Dar&uuml;ber hinaus sind Fair-Teiler ein sozialer Treffpunkt im Kiez und erm&ouml;glichen Bed&uuml;rftigen, ohne Stigmatisierung und Diskriminierung Essen zu beziehen - wie allen anderen auch!<br />Wir m&ouml;chten mit Fair-Teilern einen Beitrag f&uuml;r eine zukunftsf&auml;hige Welt schaffen, indem wir uns f&uuml;r Ressourcenschonung und ein solidarisches Miteinander engagieren - und deswegen k&auml;mpfen wir daf&uuml;r, dass Fair-Teiler weiterhin bestehen k&ouml;nnen!</span></p>
<h2><strong>E) Wie kann ich unterst&uuml;tzen?</strong></h2>
<p><span>Wir protestieren gegen diese Einsch&auml;tzungen. Um deutlich zu machen, wie viele wir sind,&nbsp;<span>haben wir </span><a href="https://weact.campact.de/p/fair-teiler-retten" target="_blank" style="text-decoration: none;"><span>eine Petition gestartet</span></a><span> und senden <a href="mailto:Eva-maria.Milke@ba-fk.berlin.de,Torsten.Kuehne@ba-pankow.berlin.de,sabine.toepfer-kataw@senjust.berlin.de,ordvetleb1@ba-pankow.berlin.de,staatssekretaerin@senjust.berlin.de?bcc=petition@lebensmittelretten.de&amp;subject=Beschwerde&amp;body=Sehr%20geehrte%20Frau%20Staatssekret%C3%A4rin%20Toepfer-Kataw%2C%20Herr%20Stadtrat%20K%C3%BChne%2C%20Herr%20Dr.%20Zengerling%20und%20Frau%20Milke%2C%0A%0A%0A" target="_blank">E-Mails an die Verantwortlichen!</a></span><a href="mailto:Eva-maria.Milke@ba-fk.berlin.de,Torsten.Kuehne@ba-pankow.berlin.de,sabine.toepfer-kataw@senjust.berlin.de,ordvetleb1@ba-pankow.berlin.de,staatssekretaerin@senjust.berlin.de?bcc=petition@lebensmittelretten.de&amp;subject=Beschwerde&amp;body=Sehr%20geehrte%20Frau%20Staatssekret%C3%A4rin%20Toepfer-Kataw%2C%20Herr%20Stadtrat%20K%C3%BChne%2C%20Herr%20Dr.%20Zengerling%20und%20Frau%20Milke%2C%0A%0A%0A" target="_blank"> Die Vorlage</a> findest Du weiter unten - ver&auml;ndere sie gerne und signiere mit Deinem Namen!&nbsp;<br />Bitte teile den Aufruf zur Rettung der Fair-Teiler! </span></p>
<p><span>Dank Dir f&uuml;r Deine Unterst&uuml;tzung!<br />Herzlich, Dein foodsharing Team <br />(Aktive aus Berlin, dem Vorstand und Orgateam - bei Fragen wende Dich gerne an <a href="mailto:fairteiler.berlin@lebensmittelretten.de" target="_blank">fairteiler.berlin@lebensmittelretten.de</a>)</span></p>
<p><span></span></p>
<p><span>Weiterf&uuml;hrende Infos stehen <a href="http://wiki.lebensmittelretten.de/Fair-Teiler#Aktuelles_-_Probleme_in_Berlin" target="_blank">auch im Wiki</a>.<br /></span><span>--- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- </span></p>
<h1>F) Presseecho</h1>
<p><a href="http://media.lebensmittelretten.de/files/Upload%20sonstiges/5.2.2016%20Pressemitteilung%20foodsharing%20-%20Fair-Teiler.pdf" target="_blank">Pressemitteilung von foodsharing</a>, 05-Feb</p>
<p>07-Feb -&nbsp;<a href="http://www.berliner-zeitung.de/berlin/petition-fuer--fairteiler--gegruendet-foodsharing-initiative-wehrt-sich-gegen-auflagen-der-lebensmittelaufsicht,10809148,33732024.html" target="_blank">Berliner Zeitung</a> <br />03-Feb - <a href="https://news.utopia.de/behoerden-wollen-foodsharing-stoppen-11863/" target="_blank">Utopia</a> <br />01-Feb - <a href="http://www.morgenpost.de/berlin/article206992037/Oeffentliche-Kuehlschraenke-koennten-bald-verboten-werden.html" target="_blank">Morgenpost </a><br /><span>--- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- --- </span></p>
<h1><strong>G) Mail-Vorlage</strong></h1>
<p><strong>Achtung</strong>: Die Mail wird inzwischen von den Beh&ouml;rden als Spam eingestuft und gefiltert! Aber es&nbsp;hilft, ein paar S&auml;tze und den Betreff zu &auml;ndern und die Empf&auml;nger*innen in den BCC zu sortieren!<br /><span>Bitte erg&auml;nze Deinen Namen am Ende der Mail und &auml;ndere die Schreibeweise von "Fair-Teiler" und "foodsharing", sind auch schon hier in der Vorlage absichtlich falsch geschrieben weil die&nbsp;<span>Mail inzwischen als Spam erkannt</span>&nbsp;wird!<br />Also werdet bitte kreativ (z.B. "foo dsharing", "fodsharing", "fooodsharing", "fudsharing", "fo&ograve;dsharing" etc. hauptsache eigene Kreationenen, sonst fischen die wieder die Mails raus und wir wollen ja, dass die Beschwerdemails ankommen!<br />Die beste Idee ist wahrscheinlich, eine ganz pers&ouml;nliche&nbsp;Mail zu verfassen, ohne viele S&auml;tze. Das bringt am meisten, denn sie m&uuml;ssen die Mail lesen und k&ouml;nnen sie nicht rausfiltern! Aber auch hier zur Sicherheit foodsharing und Fair-Teiler anders schreiben. Daf&uuml;r hier eine <a href="mailto:Eva-maria.Milke@ba-fk.berlin.de,Torsten.Kuehne@ba-pankow.berlin.de,sabine.toepfer-kataw@senjust.berlin.de,ordvetleb1@ba-pankow.berlin.de,staatssekretaerin@senjust.berlin.de?bcc=petition@lebensmittelretten.de&amp;subject=Beschwerde&amp;body=Sehr%20geehrte%20Frau%20Staatssekret%C3%A4rin%20Toepfer-Kataw%2C%20Herr%20Stadtrat%20K%C3%BChne%2C%20Herr%20Dr.%20Zengerling%20und%20Frau%20Milke%2C%0A%0A%0A" target="_blank">Mailvorlage</a>&nbsp;ohne Inhalt, aber mit Betreff, Adressat und erster Zeile: Sehr geehrte ... )</span></p>
<p></p>
<h3>Hier die Mailvorlage noch mit Inhalt, als Inspiration (foodsharing und Fair-Teiler sind absichtlich falsch geschrieben)</h3>
<p></p>
<h3><strong>Betreff</strong><span>: Beschwerde</span></h3>
<p><strong>An</strong><span>: </span><a href="mailto:Eva-maria.Milke@ba-fk.berlin.de" target="_blank" style="text-decoration: none;"><span>Eva-maria.Milke@ba-fk.berlin.de,</span></a><span></span><a href="mailto:Torsten.Kuehne@ba-pankow.berlin.de" target="_blank" style="text-decoration: none;"><span>Torsten.Kuehne@ba-pankow.berlin.de,</span></a><span></span><a href="mailto:sabine.toepfer-kataw@senjust.berlin.de" target="_blank" style="text-decoration: none;"><span>sabine.toepfer-kataw@senjust.berlin.de,</span></a><span></span><a href="mailto:ordvetleb1@ba-pankow.berlin.de" target="_blank" style="text-decoration: none;"><span>ordvetleb1@ba-pankow.berlin.de</span></a>,<a href="mailto:staatssekretaerin@senjust.berlin.de" target="_blank">staatssekretaerin@senjust.berlin.de</a></p>
<p><strong>BCC</strong><span>: </span><a href="mailto:petition@lebensmittelretten.de" target="_blank" style="text-decoration: none;"><span>petition@lebensmittelretten.de</span></a> (Blindkopie, damit wir z&auml;hlen k&ouml;nnen, wie viele Mails versandt wurden)</p>
<p><span>Sehr geehrte Frau Staatssekret&auml;rin Toepfer-Kataw, Herr Stadtrat K&uuml;hne, Herr Dr. Zengerling und Frau Milke,</span></p>
<p></p>
<p><br /><span>die Einstufung der Fai r Teiler als Lebensmittelbetriebe wird dazu f&uuml;hren, dass viele Fai r Teiler in Berlin geschlossen werden m&uuml;ssen. Diese drastische Vorgehensweise ist einmalig in Deutschland. Das finde ich unverantwortlich und fordere Sie deswegen zu einer realistischeren Beurteilung der Sachlage auf!</span><br /><span>Fai r Teiler sind private &Uuml;bergabeorte von Lebensmitteln und gleichzeitig ein sozialer Beitrag zur Reduktion der Lebensmittelverschwendung.</span><span></span><span>&nbsp;Sie f&ouml;rdern das Bewusstsein f&uuml;r diese Thematik in der Bev&ouml;lkerung und fungieren als soziale Treffpunkte in der Nachbarschaft. Fodsharing Deutschland hat dabei eine innovative Vorreiterrolle eingenommen. Mittlerweile wurde diese Idee u.a. von L&auml;ndern wie der Schweiz, Brasilien, Spanien und S&uuml;dkorea &uuml;bernommen. In &Ouml;sterreich werden Fai r Teiler sogar durch das Lebensmittelministerium unterst&uuml;tzt und gef&ouml;rdert. Dar&uuml;ber hinaus erreichen Nahrungsmittel durch Fai r Teiler sehr viele Menschen und direkt auch Bed&uuml;rftige, die sich ohne Stigmatisierung bedienen k&ouml;nnen. Ich halte die Regelungen von fodsharing f&uuml;r die Fai r Teiler f&uuml;r absolut ausreichend und die gesundheitlichen Gefahren f&uuml;r gering, was die Tatsache belegt, dass es bisher keinerlei Vorf&auml;lle an den &uuml;ber 350 Fai r Teiler gab.</span><br /><br /><span>Herr Dr. Zengerling und Frau Milke, durch Ihre ungerechtfertigte Einstufung von Fai r Teiler als Lebensmittelunternehmen und die damit verbundenen Auflagen ist eine Fortf&uuml;hrung dieser innovativen Idee in Berlin nicht mehr m&ouml;glich. Ich fordere Sie deswegen auf, Fai r Teiler so zu bewerten, wie es andere Lebensmittel&auml;mter auch tun: als privaten &Uuml;bergabeort f&uuml;r Lebensmittel!</span><br /><br /><span>Auf Bundesebene hat die Regierung 2012 unter der CDU/CSU beschlossen, den Lebensmittelm&uuml;ll bis 2020 um die H&auml;lfte zu reduzieren. Um dieses Ziel in Privathaushalten zu erreichen, wurde die Informationskampagne &ldquo;Zu gut f&uuml;r die Tonne&rdquo; ins Leben gerufen und jeder B&uuml;rger/in aufgerufen, aktiv in diesem Sinne zu wirken.</span><br /><br /><span>Mit Ihren bisherigen Forderungen stellen Sie sich gegen die erkl&auml;rte Politik der Bundesregierung, Herr Stadtrat K&uuml;hne! Es entt&auml;uscht mich sehr, dass Sie zivilgesellschaftliches Engagement gegen Essensverschwendung und f&uuml;r die w&uuml;rdige Versorgung Bed&uuml;rftiger blockieren.</span><br /><br /><span>Frau Staatssekret&auml;rin Toepfer-Kataw und Herr Stadtrat K&uuml;hne, unterst&uuml;tzen Sie das Lebensmittelamt, indem Sie gemeinsam mit fodsharing einen Leitfaden f&uuml;r die Fai r Teiler erstellen, damit diese einmalige Initiative von tausenden Freiwilligen weiter bestehen kann!</span><br /><br /><span>Mit freundlichen Gr&uuml;&szlig;en</span></p>',
                    'last_mod' => '2016-02-26 16:20:20',
                ),
            49 =>
                array (
                    'id' => 50,
                    'name' => 'infos-basel',
                    'title' => 'Infos für Basel',
                    'body' => '<h1>Test</h1>
<p>sdsds sd sd sd sd</p>',
                    'last_mod' => '2016-07-23 21:54:45',
                ),
            50 =>
                array (
                    'id' => 51,
                    'name' => 'broadcast-info',
                    'title' => 'broadcast-info',
                    'body' => '',
                    'last_mod' => '2017-05-07 22:58:45',
                ),
            51 =>
                array (
                    'id' => 52,
                    'name' => 'bezirkliste',
                    'title' => 'Hier findet ihr Foodsharing Gemeinschaften',
                    'body' => '<h1>Foodsharing Gemeinschaften in Deutschland, &Ouml;sterreich und Schweiz</h1>
<p></p>
<ul>
<li>
<h2>Deutschland</h2>
<ul>
<li>
<h3>Hessen</h3>
<ul>
<li>Frankfurt &nbsp;<a href="mailto:frankfurt@lebensmittelretten.de" target="_blank">frankfurt@lebensmittelretten.de</a></li>
<li>Gie&szlig;en&nbsp;<a href="mailto:Giessen@lebensmittelretten.de" target="_blank">Giessen@lebensmittelretten.de</a><a href="mailto:Giessen@lebensmittelretten.de" target="_blank"></a></li>
</ul>
</li>
<li>
<h2>Rheinland-Pfalz</h2>
<ul>
<li>Mainz&nbsp;<a href="mailto:Mainz@lebensmittelretten.de" target="_blank">Mainz@lebensmittelretten.de</a></li>
</ul>
</li>
</ul>
</li>
</ul>',
                    'last_mod' => '2017-02-21 11:28:06',
                ),
            52 =>
                array (
                    'id' => 53,
                    'name' => 'team-aktive-header',
                    'title' => 'Aktive',
                    'body' => '<div class="head ui-widget-header ui-corner-top">Aktive</div>
<div class="ui-widget ui-widget-content corner-bottom margin-bottom ui-padding">Nachfolgend alle flei&szlig;igen Helfer und Helferinnen, auf die wir uns immer verlassen d&uuml;rfen!</div>
<div class="ui-widget ui-widget-content corner-bottom margin-bottom ui-padding">&lt;div id="aktive"&gt;&lt;/div&gt;</div>',
                    'last_mod' => '2017-06-30 22:34:40',
                ),
            53 =>
                array (
                    'id' => 54,
                    'name' => 'team-ehemalige-heade',
                    'title' => 'Ehemalige',
                    'body' => '<div class="head ui-widget-header ui-corner-top">Ehemalige</div>
<div class="ui-widget ui-widget-content corner-bottom margin-bottom ui-padding">Unsere ehemaligen Helferinnen und Helfer, die mitgeholfen haben, Foodsharing gro&szlig; zu machen!</div>',
                    'last_mod' => '2017-06-07 14:44:08',
                ),
        ));
    }
}