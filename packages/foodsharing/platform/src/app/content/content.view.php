<?php
class ContentView extends View
{
	public function simple($cnt)
	{
		return '
		<div class="page ui-padding ui-widget-content corner-all">
			<h1>'.$cnt['title'].'</h1>
			'.$cnt['body'].'
		</div>';
	}

	public function partner($cnt)
	{
		return '
		<div class="page ui-padding ui-widget-content corner-all">
			<h1>'.$cnt['title'].'</h1>
			'.$cnt['body'].'
		</div>';
	}
	
	public function impressum($cnt)
	{
		return '
		<div class="page ui-padding ui-widget-content corner-all">
			<h1>'.$cnt['title'].'</h1>
			'.$cnt['body'].'
		</div>';
	}
	
	public function about($cnt)
	{
		return '
		<div class="page ui-padding ui-widget-content corner-all">
			<h1>'.$cnt['title'].'</h1>
			'.$cnt['body'].'
		</div>';
	}
	
	public function faq($faqs)
	{
		$out = '';
		$i = 1;
		foreach ($faqs as $f)
		{
			$out .= '
			<div class="faq ui-padding corner-all">
				<h3>'.$i.'. '.$f['name'].'</h3>
				<p>'.nl2br($f['answer']).'</p>
			</div>';
			$i++;
		}
		
		return $out;
	}
	
	public function ratgeberRight()
	{
		
		$list = '';
		
		$items = array(
			array('title' => 'Sei ehrlich','cnt' => 'Wir alle, die wir Foodsharing entwickelt haben, nehmen unsere Aufgabe sehr ernst und befolgen Gesetze und Auflagen. Sei auch Du bitte ehrlich beim Ausfüllen Deiner Daten und bei der Beschreibung des Essenskorbes.'),
			array('title' => 'Beachte die Regeln','cnt' => 'Wir weisen ausdrücklich darauf hin, dass wir das Anbieten und Teilen bestimmter Lebensmittel und anderer Waren aus rechtlichen Gründen nicht gestatten. Verderbliche Lebensmittel wie Fisch, Geflügel, Fleisch, rohe Eierspeisen und zubereitete Lebensmittel sowie Medikamente (auch homöopathische Medikamente) sind von foodsharing.de ausgeschlossen. Auch Kleidung, Kosmetika, Haushaltschemie, Spielzeug und andere Non-Food-Produkte können über foodsharing.de nicht getauscht oder geteilt werden. Foodsharing.de behält sich vor, derartige Angebote zu löschen.'),
			array('title' => 'Sei verantwortungsvoll','cnt' => '30 % alle Lebensmittel landen im Müll. Damit soll nun endlich SCHLUSS sein. Wir möchten nichts mehr wegwerfen! Wir wollen verantwortungsvoll mit Lebensmittel umgehen und freuen uns, dass Du mitmachst'),
			array('title' => 'Sei zuverlässig','cnt' => 'Wir haben Hotspots eingerichtet, dort kann man sich treffen und tauschen. Oder Ihr macht selber einen Foodsharing/Ort mit Eurem Partner aus. Bitte seid zuverlässig und pünktlich, lasst keinen im „Regen“ stehen.'),
			array('title' => 'Melde Verstöße','cnt' => 'Wir haben das Mindesthaltbarkeitsdatum, aber auch ein gutes Auge, eine feine Nase und das gute Gewissen keine verschimmelten, verdorbenen Lebensmittel anzubieten. Also bitte nicht nur das Kreuz bei „Lebensmittelrecht gelesen“  machen, sondern den Ratgeber sorgsam durchlesen. Denn wer will schon aus der Foodsharing/Community rausgeworfen werden?'),
			array('title' => 'Mach Vorschläge','cnt' => 'Wir wollen uns weiterentwickeln, immer besser werden. Dazu brauchen wir Euch mit vielen guten Ideen und Tipps. Die schickt Ihr an  ideen@foodsharing.de')
		);
		
		foreach ($items as $i => $v)
		{
			$list .= '<h5><span>'.($i+1).'</span> '.$v['title'].'</h5><p>'.$v['cnt'].'</p>';
		}
		
		return v_field('<div class="reddot">'.$list.'</div>','foodsharing Etikette',array('class'=> 'ui-padding'));
	}
	
	public function ratgeber()
	{
		
		$accordion = new vAccordion(array(
			'collapsible' => true, 
			'active' => false,
			'heightStyle' => 'content',
			'animate' => false
		));
		
		$accordion->addPanel('Kühlschrank-Management','
        <p>Amerikanische Studien haben ergeben, dass es im Kühlschrank oft mikrobiologisch belasteter ist als auf der Toilette. Reinigen allein hilft da nicht unbedingt, auch die Aufbewahrung der Lebensmittel und die richtige Wahl der Reinigungsmittel sowie der Reinigungsintervall sind von entscheidender Bedeutung. Klar ist, das Küchenlappen und Tücher, die mehrere Tage benutzt wurden, den Kühlschrank eher schmutziger machen als sauber, weil sie ideale Vermehrungsbedingungen für Mikroorganismen darstellen (feucht, warm, Nahrung, viel Zeit sich zu vermehren...). Wischtücher müssen mindestens bei 60<span style="white-space:nowrap">&thinsp;</span>°C waschbar sein, besser heißer. Hier sollte man also frisch gewaschene benutzen. </p>
        <p>Kondenswasser ist ein ebenso ein ideales Nährmedium für Mikroorganismen. An der Rückwand des Kühlschrankes oder in dem Obst-und Gemüsefach gibt es davon oft reichlich. </p>
        <p>Die Oberflächen im Kühlschrank sind oft stark verkeimt, da verschiedenste Produkte hinein- und hinaustransportiert werden. Und so ein ständiger Austausch verschiedenster Kleinstlebewesen stattfindet. Wenn etwas ausläuft oder sich Kondenswasser beim Auftauen von Lebensmitteln auf den Einlegeböden niederlässt, fühlen sich Mikroorganismen noch wohler und können sich gut vermehren, gerade, wenn man den Kühlschrank evtl. noch zu warm betreibt, 5<span style="white-space:nowrap">&thinsp;</span>°Csind hier eine gute Temperatur (Siehe hierzu auch Punkt Lebensmitteltransport, MHD, Verbrauchsdatum!). Denn ab 7<span style="white-space:nowrap">&thinsp;</span>°C vermehren sich Mikroorganismen schon relativ schnell. </p>
        <p>Grundsätzlich sollte man im Kühlschrank alles abgedeckt haben. Es gibt Verpackungen, die man wiederverschließen kann. Dies funktioniert mal besser mal weniger gut. Besser ist es, Angebrochenes oder Offenes (Erdbeeren) in verschlossenen Plastikbehältern aufzubewahren. Dadurch können z.<span style="white-space:nowrap">&thinsp;</span>B. Schimmelpilze keine anderen Lebensmittel befallen. Das spart Geld, weil man nichts wegwerfen muss und ist gut für die Gesundheit. Man sollte hineinschauen können, damit man die Menge und Zustand schon von außen begutachten kann, ohne diese immer öffnen zu müssen. Kann man diese gut stapeln, nutzt man den Platz und die Energie zum Betreiben des Kühlschrankes optimal aus. Eine gewisse Ordnung im Kühlschrank erleichtert das Lebensmittelhandling und auch das Reinigen. </p>
        <p>Einen „Lebensmittelcheck“ sollte man mindestens wöchentlich durchführen, um zu schauen, ob verdorbenes oder falsch gelagertes sich in ihm befindet. Vor dem Einkaufen in den Kühlschrank zu gucken bietet sich an, um Doppelkäufe zu vermeiden.</p>
        <p>Gründlich reinigen sollte man den Kühlschrank mindestens einmal im Monat. Dazu gibt man 2 Tassen Essigessenz auf einen Liter Wasser und wischt damit den Kühlschrank aus. Sich selbst sollte man dabei durch Handschuhe schützen. Aber Vorsicht, nicht mit dem Essigwasser die Dichtungsgummis reinigen, das löst die Weichmacher heraus und macht die Gummis brüchig. Für die Dichtungsgummis kann man gut eine saubere Zahnbürste nehmen, dann muss man die Gummis nicht unnötig auseinanderbiegen. Dann diese mit heißem Wasser und Spülmittel oder Ascorbinsäure (gibt es in Pulverpäckchen in Drogerien) vermischt mit etwas Wasser säubern. </p>
        <p>Nicht mit den Reinigungsmitteln übertreiben, die angegebenen Möglichkeiten erfüllen ihren Zweck. Pestizide, Desinfektionsmittel sind in der Regel nicht nötig, außer man ist selbst oder ein Familienmitglied ist erkrankt (Siehe Krankheiten!).</p>');
		
		$accordion->addPanel('Unempfindliche und empfindliche Lebensmittel', '
        <p>Lebensmittel lassen sich in zwei Gruppen einteilen, in die unempfindlichen und die empfindlichen. Zu den unempfindlichen Lebensmitteln zählen unter anderem Obst, Gemüse, Brot, Kleingebäck ohne Sahne-/ Cremefüllung, Konfitüren und Fruchtaufstriche, Getränke, sowie Soßen und Dips in Fertigpackungen. Bei diesen Produkten ist die Lagerung, sowie die Handhabung sehr einfach. Sie mögen es gern dunkel, trocken und kühl. Bestimmte Temperaturen müssen meist erst, wie auf der Verpackung angegeben, nach Anbruch eingehalten werden.</p>
        <p>Zu den empfindlichen Lebensmitteln zählen Fleisch, Geflügel und Erzeugnisse daraus, Milch und Milcherzeugnisse, Fisch, Krebse oder andere Weichtieren, Eiprodukte, Säuglings- und Kindernahrung, Speiseeis und Speiseeishalberzeugnisse, Backwaren mit nicht durchgebackener/durcherhitzter Füllung oder Auflage, Feinkost-, Rohkost- und Kartoffelsalate, Marinaden und Mayonnaisen. Bei diesen Produkten sollte ein besonderes Augenmerk auf die Lagerung gelegt werden. Die Kühlkette sollte unbedingt eingehalten werden, um so das Mindesthaltbarkeitsdatum bzw. Verbrauchsdatum gewährleisten zu können. Die optimalen Temperaturen hierzu lauten:</p>
        <ul>
        <li>Fleisch +2<span style="white-space:nowrap">&thinsp;</span>°C bis +7<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Geflügel &amp; Erzeugnisse daraus +2<span style="white-space:nowrap">&thinsp;</span>°C bis +4<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Milch &amp; Milcherzeugnisse +2<span style="white-space:nowrap">&thinsp;</span>°C bis +10<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Fisch, Fischereierzeugnisse +2<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Fischereierzeugnisse vakuumverpackt +2<span style="white-space:nowrap">&thinsp;</span>°C bis +7<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Eier (ab 1. Tag nach dem Legen) (siehe empfindliche Lebensmittel „Eier“ )</li>
        <li>Flüssigei, Eiprodukte +4<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Roheihaltige Lebensmittel +2<span style="white-space:nowrap">&thinsp;</span>°C bis +7<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Speiseeis in Fertigpackungen -18<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Backwaren mit nicht durcherhitzter Füllung +7<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Feinkost-, Rohkost- &amp; Kartoffelsalate +2<span style="white-space:nowrap">&thinsp;</span>°C bis +7<span style="white-space:nowrap">&thinsp;</span>°C</li>
        <li>Marinaden und Mayonnaisen +2<span style="white-space:nowrap">&thinsp;</span>°C bis +7<span style="white-space:nowrap">&thinsp;</span>°C</li>
        </ul>
        <p>Unter den Punkten Lebensmitteltransport, MHD und Verbrauchsdatum sind Informationen zu Abweichungen enthalten.</p>
        <p>Im folgenden Text sind nähere Informationen zu den besonders empfindlichen Lebensmitteln Hackfleisch, Geflügel, Fisch und Eier aufgeführt.</p>');
		
		$accordion->addPanel('Besonders empfindliche Lebensmittel', '
        <h4>Hackfleisch</h4>
        <p>Hackfleisch ist ein sehr sensibles Lebensmittel. Es ist Fleisch das zerkleinert wurde. In Muskelfleisch befindet sich fast kein Sauerstoff, welcher mit als Hauptnahrungsquelle für Mikroorganismen dient. Wenn man ein Steak brät, tötet man dadurch die Mikroorganismen auf der Oberfläche ab. Im Innern gibt es fast keine. Deshalb können wir sogar „englisch“ gebratenenes (im Innern roh) Fleisch essen. Bringt man allerdings durch zerkleinern, die an der Oberfläche von Fleisch angesiedelten Mikroorganismen in das Innere, vergrößert man dadurch die Oberfläche, Sauerstoff kann gut wirken. Man zerreißt Fleischfasern, Fleischsaft läuft aus und so schafft man ideale Vermehrungsbedingungen für Mikroorganismen. Deshalb ist Hackfleisch ein so empfindliches Lebensmittel. Es darf nur aus frischem Fleisch zubereitet werden und sollte bei einer Temperatur von +2<span style="white-space:nowrap">&thinsp;</span>°C gelagert werden. Ist das Hackfleisch jedoch unter Schutzgasatmosphäre und somit vakuumverpackt worden, kann es mehrere Tage verkauft werden. Die Lagertemperatur sollte hier bei +2<span style="white-space:nowrap">&thinsp;</span>°C nicht überschreiten und das Hackfleisch sollte vor dem Verzehr durcherhitzt werden.</p>
        <h4>Geflügel</h4>
        <p>Campylobakter und Salmonellen sind die Mikroorganismen, die besonders oft auf Geflügelfleisch vorkommen und schlecht für die menschliche Gesundheit sein können. Verarbeitet man Geflügel, sollte man darauf achten, dass hierfür ein eigenes, ausschließlich genutztes Schneidebrett und Schneide- oder Zerlegewerkzeug benutzt wird. Um andere Lebensmittel nicht zu verunreinigen. Hände müssen nach der Bearbeitung von Geflügel sofort gewaschen werden und Wischlappen, mit denen Fleischsaft oder Auftauwasser aufgenommen wurden, dürfen nicht mehr weiter verwendet verwenden. Nur durch Hitze wird Geflügelfleisch wieder keimfrei. Deshalb muss man darauf achten, dass Geflügelfleisch immer gut durcherhitzt wird. </p>
        <h4>Fisch</h4>
        <p>Fisch ist eines der Lebensmittel, das von den Konsumenten eine immer höhere Wertschätzung bekommt. Er enthält Jod, Vitamin D, wichtige Omega 3 – Fettsäuren, sowie hochwertiges Eiweiß. Man bekommt Fisch in den Angebotsformen Frischfisch, Tiefgefroren, in Konserven, Geräuchert oder als Fischereierzeugnisse in der Kühlung. Beim Einkauf von Frischfisch sollte man allerdings auf folgende Qualitätskriterien achten:</p>
        <ul>
        <li>die Kiemen sollten hellrot bis dunkelrosa sein</li>
        <li>der Fisch sollte frisch riechen und nicht nach “Fisch“</li>
        <li>die Augen müssen klar und glänzend sein</li>
        <li>das Fleisch muss fest sein, es dürfen keine Druckstellen zurück bleiben</li>
        <li>die Schuppen sollten fest anliegen</li>
        <li>die Schleimschicht sollte klar sein und nicht trüb</li>
        </ul>
        <p>Sind diese Kriterien erfüllt, kann davon ausgegangen werden, dass es sich wirklich um Frischfisch handelt. Fisch ist auf Grund seiner lockeren Zellstruktur leicht verderblich. Ist der Fisch vorher tiefgefroren worden, muss eine Kennzeichnung am Produkt “aufgetaut“ erfolgen. Ebenso sollte man beim Kauf von Frischfisch darauf achten, dass der Fisch auf Eis gelagert wird. So hält er seine Temperatur und trocknet nicht so schnell aus. Auch bei diesem Lebensmittel sollte wieder ein besonderes Auge auf die Temperatur bei der Lagerung, sowie das Verbrauchsdatum, welches sich vor allem auf Lachs befindet, haben.</p>
        <h4>Eier</h4>
        <p>Unter dem Begriff „Eier“ versteht man ausschließlich Eier von Huhn. Eier von anderen Tierarten müssen die Angabe des Tieres bei ihrer Kennzeichnung enthalten. Einfluss auf den Frischezustand des Eies haben die Lagerdauer, Lagerbedingungen, die Intaktheit der Schale und die Sauberkeit der Schale. Jedoch kommen Eier aufgrund ihrer Beschaffenheit der Schale nicht gewaschen in den Verkauf. Sie sind wegen ihrer Schutzschicht, eine Oberhaut, die das Ei umschließt, ungekühlt gut 2 Wochen haltbar. Ab dem 18. Tag nach dem Legen müssen sie gekühlt werden, da sich dann diese Oberhaut abbaut und so die Vermehrung von Verderbnis- &amp; Krankheitserregern schneller voran schreitet. Nach Ablauf des Mindesthaltbarkeitsdatums müssen Eier auf mindestens 70<span style="white-space:nowrap">&thinsp;</span>°C erhitzt werden.</p>');
		
		$accordion->addPanel('Transport von Lebensmitteln ', '
        <p>Um die Garantie für kühlungspflichtige Lebensmittel vom Hersteller nicht zu verlieren, darf die Kühlkette nicht unterbrochen werden. Es ist also notwendig, die kühlungspflichtigen Lebensmittel in einer Kühltasche, oder bei größeren Mengen, in einer Thermobox, so schnell wie möglich in den heimischen Kühlschrank zu bringen. Kurzfristig (30-60 Min.) darf sogar von der angegebenen Temperatur abgewichen werden. Dies aber nur für 3<span style="white-space:nowrap">&thinsp;</span>°C maximal. Also Lebensmittel, die bei -18<span style="white-space:nowrap">&thinsp;</span>°C zu lagern sind, dürfen kurzfristig bei -15<span style="white-space:nowrap">&thinsp;</span>°C transportiert werden, ein Lebensmittel, welches bei 5<span style="white-space:nowrap">&thinsp;</span>°C zu lagern ist, bei 8<span style="white-space:nowrap">&thinsp;</span>°C usw. </p>
        <p>Hier geht es nicht ausschließlich darum, die Garantie zu bewahren, auch in Sachen Qualität, Frische und Lagerdauer kann man hier eigentlich nur gewinnen. Thermotaschen oder Styroporboxen, die man einfach auswischen kann, sorgen für ein einfaches, gut funktionierendes und mehrfach verwendbares Transportprinzip. </p>');
		
		$accordion->addPanel('Mindesthaltbarkeitsdatum', '
        <p>Das Mindesthaltbarkeitsdatum sorgt oft für Verwirrung in Haushalten und ist Grund dafür, dass Lebensmittel früher weggeschmissen werden als nötig. Zum Beispiel befindet sich ein Mindesthaltbarkeitsdatum (MHD) von 2 Jahren auch auf „Millionen Jahre altem Steinsalz“ ... Gekennzeichnet ist das Mindesthaltbarkeitsdatum auf den Lebensmittelpackungen folgendermaßen: Mindestens haltbar bis: Datum und einer Lagertemperaturangabe. Die Lagertemperaturangabe ist einzuhalten. Der Kühlschrank sollte an der kältesten Temperaturangabe (Siehe hier auch Verbrauchsdatum) ausgerichtet sein. Das (MHD) ist eine Garantie des Herstellers, dass bis zum angegebenen Zeitpunkt, in Verbindung mit der angegebenen Lagertemperatur, das Lebensmittel die vom Hersteller bestimmte Qualität und den mikrobiologischen Zustand behält.</p>
        <p>Ist das MHD abgelaufen, ist es so, als ob man das Produkt selber hergestellt hat und man auch die volle Verantwortung dafür trägt. Allerdings ist auch jedem bekannt, dass zum Beispiel bei einem Joghurt, welcher 7 Tage nach Ablauf des MHD’ s verspeist wird, sich vielleicht ein wenig Wasser abgesetzt hat oder die Farbe der Fruchtmischung durchscheint, genießbar ist er aber immer noch. Auch weitergegeben können abgelaufene Produkte, hierbei ist der Punkt „Sensorik“ eine Hilfe. Beide Parteien (der/die Abholende und der/die Anbieter/in) sollten in der Lage sein, das Produkt auf Verzehrsfähigkeit nach Ablauf des MHD’ s überprüfen zu können. </p>
        <p>Nach dem Öffnen der Packungen mit MHD ist die Haltbarkeit meist erheblich kürzer. Lebensmittel in geöffneter Verpackung sollten nur dann weitergegeben werden, wenn der Zeitpunkt des Öffnens bekannt ist, und nicht weit zurück liegt. </p>');
		
		$accordion->addPanel('Verbrauchsdatum', '
        <p>Anders als beim Mindesthaltbarkeitsdatum verhält es sich beim Verbrauchsdatum. Auf den Packungen steht dann „zu verbrauchen bis...“gekoppelt an eine Lagertemperatur die einzuhalten ist sowie ein Datum. </p>
        <p>Die Haltbarkeitsdauer der Lebensmittel mit einem Verbrauchsdatum ist meistens schon so weit ausgereizt, dass nach Ablauf des Verbrauchsdatums eine nachteilige mikrobiologische Veränderung sehr gut möglich ist. Oder es handelt sich um ein sehr empfindliches Lebensmittel (Siehe besonders empfindliche Lebensmittel). Zwischen Mindesthaltbarkeitsdatum und Verbrauchsdatum sollte deshalb genau unterschieden werden.</p>
        <p>Lebensmittel, deren Verbrauchsdatum abgelaufen ist, dürfen nicht mehr weitergegeben werden. </p>');
		
		$accordion->addPanel('Sensorik', '
        <p>Bei Lebensmitteln, gekühlt als auch ungekühlt, treten aufgrund ihrer Beschaffenheit und dem voranschreitenden Reifezustand nach gewissen Zeiträumen sensorische Veränderungen auf. Das heißt, dass Lebensmittel verändert sich in seinen sensorischen Merkmalen Aussehen, Geruch, Geschmack und Konsistenz. Es ist eine negative Veränderung, auch Verderb genannt, die damit zusammen hängt, dass im Lebensmittel selbst ein natürlicher Wasserverlust, das Vorkommen von Mikroorganismen (Bakterien, Hefen &amp; Schimmelpilze) und somit ein innerer Qualitätsverlust aufgrund von Alterung (Reifzustand) stattfindet. Durch diese bestimmenden Punkte verändern sich die Lebensmittel. Sie weisen Verfärbungen auf, werden weich, verändern ihren arteigenen Geruch und Geschmack. Diese sensorischen Qualitätsmerkmale stehen im Zusammenhang mit der Lagerung der Lebensmittel. Eine wichtige Rolle hierbei spielen die Temperatur, der Feuchtigkeitsgehalt, sowie der vorhanden pH- Wert den das Lebensmittel aufweist. Weist ein Lebensmittel Veränderungen wie Druckstellen oder Quetschungen auf, heißt dies jedoch nicht sofort, dass das Lebensmittel nicht mehr für den Verzehr geeignet ist, es ist lediglich in seinem Wert gemindert und es kann dazu führen, dass der Verderb schneller voranschreitet, da mehr Angriffsfläche für Mikroorganismen zur Verfügung steht.</p>
        <p>Bei der Feststellung von sensorischen Abweichungen der Lebensmittel, die angeboten werden, sollten diese als Information mit angegeben werden. Das könnte z.<span style="white-space:nowrap">&thinsp;</span>B. heißen, dass sie nicht mehr richtig knackig sind oder verblassen. Um möglichst lang frische Lebensmittel genießen zu können und eine unsachgemäße Lagerung der Lebensmittel zu vermeiden, wird hier auf den Punkt Kühlkette/Temperaturzonen verwiesen.</p>
        <p>Die Lebensmittel die starke Auffälligkeiten im Bereich Aussehen, Geruch &amp; Konsistenz aufweisen, sind nicht mehr zur Weitergabe geeignet. Dies kann bei Obst, Gemüse, Fleisch, Fisch, Brot, Gebäck, Fruchtaufstrichen, sowie Milch und Milchprodukten eine große Rolle spielen. Die meisten Verderbniserscheinungen können sensorisch festgestellt werden. Aussehen und Farbe: Verfärbung, Trübung, Austrocknung, Gefrierbrand und Schimmel. Konsistenz, Struktur und Oberfläche: Schmierige Oberfläche, Schleimbildung, Verflüssigung, Verhärtung, Entmischung, Gasbildung und Gerinnung und in Sachen Geruch und Geschmack: Faul, sauer, dumpf, muffig, alt, ranzig, tranig, gärig, fischig und seifig. </p>');
		
		$accordion->addPanel('Krankheiten und Lebensmittelabgabe', '
        <p>Beim Umgang mit Lebensmitteln ist auf große Sorgfalt zu achten. Dies gilt besonders im Bereich der persönlichen Hygiene, sowie beim Umgang mit Lebensmitteln bei Erkrankungen. Oberstes Ziel ist es den Konsumenten, in diesem Falle der Abnehmer der angebotenen Ware, zu schützen. Bei Lebensmittelunternehmen wird der Verbraucherschutz durch eine von vielen Vorsorgemaßnahmen, nämlich Schulungen der Mitarbeiter nach dem Infektionsschutzgesetz und Hygieneschulungen vorbeugend gewährleistet. Um auch bei dieser Form der Abgabe von Lebensmitteln durch die Konsumenten selbst, einen Schutz vor übertragbaren Krankheiten durch Lebensmittel zu erreichen, werden nachfolgend die wichtigsten Erreger, Ihr Vorkommen und ihre Symptome kurz aufgeführt.</p>
        <p>In folgenden Lebensmitteln können sich Krankheitserreger, aufgrund ihrer Beschaffenheit, besonders leicht vermehren:</p>
        <ul>
        <li>Fleisch, Geflügel &amp; Erzeugnisse daraus</li>
        <li>Milch &amp; Milcherzeugnisse</li>
        <li>Fisch, Krebse oder andere Weichtieren</li>
        <li>Eiprodukte</li>
        <li>Säuglings- &amp; Kindernahrung</li>
        <li>Speiseeis &amp; Speiseeishalberzeugnisse</li>
        <li>Backwaren mit nicht durchgebackener / durcherhitzter Füllung oder Auflage</li>
        <li>Feinkost-, Rohkost- &amp; Kartoffelsalate, Marinaden, Mayonnaisen</li>
        </ul>
        <p>Diese Lebensmittel sind die so genannten leicht verderblichen und somit empfindlichen Produkte. Es ist ein besonderes Augenmerk auf ihre Lagerung und Handhabung, sowie das Mindesthaltbarkeitsdatum und Verbrauchsdatum zu legen.</p>
        <p>Typische Erreger die durch die Lebensmittel übertragen werden sind:</p>
        <ul>
        <li>Salmonellen, Campylobacter, Listerien, Staphylokokken, Bacillus cereus, E.- Coli (EHEC/ VTEC), Clostridium botulinum, Clostridium perfringens</li>
        </ul>
        <p>Sie sind Auslöser für folgende Krankheitserscheinungen:</p>
        <ul>
        <li>Akute infektiöse Gastroenteritis (plötzlich auftretender, ansteckender Durchfall) ausgelöst durch Salmonellen, Shigellen, Cholerabakterien, Staphylokokken, Campylobacter, Rotarviren oder anderen Durchfallerreger</li>
        <li>Fieber</li>
        <li>Übelkeit &amp; Erbrechen</li>
        <li>Typhus oder Paratyphus</li>
        <li>Virushepatitis A oder E (Leberentzündung)</li>
        </ul>
        <p>Bei infizierten Wunden oder Hauterkrankungen bei denen die Möglichkeit besteht, dass Krankheitserreger über Lebensmittel auf andere Menschen übertragen werden können, wird von einer Weitergabe der Lebensmittel abgeraten. Ein Hinweis dafür, das Wunden oder offene Stellen von Hauterkrankungen infiziert sind kann sein, wenn diese gerötet, schmierig belegt, nässend oder geschwollen sind.</p>
        <p>Denn der Erfolg und auch das Gelingen von Foodsharing hängt vom respektvollen und achtsamen Umgang mit allen Lebensmittelnab!</p>
        <p>Es sollte bei der Abgabe von Lebensmitteln durch foodsharing darauf geachtet werden, dass die Anbieter selbst, sich über die aufgeführten Punkte im Klaren sind und beim Auftreten bestimmter Krankheitssymptome keine Lebensmittel anbieten.</p>');
		
		return '
		<div class="page ui-padding ui-widget-content corner-all">
			<h1>Ratgeber</h1>
			<h2>Einleitung</h2>
			<p>Da Lebensmittel uns am Leben erhalten, sollte man mit ihnen auch respektvoll umgehen. Gegen die Lebensmittelverschwendung etwas zu tun, ist eine Möglichkeit Respekt zu zeigen. Um den Lebensmitteltausch oder die Lebensmittelabgabe für alle Teilnehmer so sicher wie möglich zu gestalten, haben wir die wichtigsten Voraussetzungen im folgenden Leitfaden zusammengefasst. Lebensmittel an andere weiterzugeben ist eine sehr menschliche aber auch verantwortungsvolle Situation. Grundsätzlich gilt wohl immer: „Nichts an andere weitergeben, was man selbst nicht mehr essen würde“. Die nun aufgeführten Punkte, sollen die Entscheidung erleichtern. </p>
			'.v_info('Nicht gestattet ist das Anbieten und Teilen hygienisch riskanter Lebensmittel. Dazu gehören alle Lebensmittel, die ein Verbrauchsdatum tragen („zu verbrauchen bis…“), wie auch roher Fisch, Geflügel und anderes Fleisch, insbesondere Hackfleisch, rohe Eierspeisen und zubereitete Lebensmittel, die Fleisch oder Fisch enthalten, es sei denn es kann durch Lieferscheine sichergestellt werden, dass die Kühlkette lückenlos war. Foodsharing.de behält sich vor, derartige Angebote zu löschen. Unproblematisch sind hingegen Lebensmittel mit einem Mindesthaltbarkeitsdatum („mindestens haltbar bis…“), auch nach Ablauf dieses Datums.','Beachte die Regeln!').'
			
			'.$accordion->render().'
		</div>';
	}
}
