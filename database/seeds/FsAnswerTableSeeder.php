<?php

use Illuminate\Database\Seeder;

class FsAnswerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_answer')->delete();
        
        \DB::table('fs_answer')->insert(array (
            0 => 
            array (
                'id' => 1,
                'question_id' => 1,
                'text' => 'Ich melde den Verstoß gegen die Verhaltensregeln.',
                'explanation' => 'Richtig, wir sind alle verantwortlich jeglichen Verstoß gegen die Verhaltensregeln zu melden, damit sich nicht zugelassene Verhaltensweisen erst gar nicht etablieren und geklärt werden können, bevor ein großes Problem entsteht. Das Eintragen aller Abholungen, wer wann mit wem abholt, ist essenziell, um zu gewährleisten, dass Probleme früh erkannt werden und ist auch die einzige Garantie, dass der Ruf von foodsharing gewahrt bleibt und unser Versprechen an die Betriebe, dass nur Menschen, die die Rechtsvereinbarung und die Verhaltensregeln akzeptieren und einhalten, abholen können, auch eingehalten wird. Das unterstreicht die Zuverlässigkeit und Ernsthaftigkeit des Projektes foodsharing, mit der wir die Lebensmittelverschwendung beenden wollen und unterbindet außerdem Filzbildung, freundschaftliches Wegschauen, Themen runterschlucken etc.',
                'right' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'question_id' => 1,
                'text' => 'Ich melde den Verstoß gegen die Verhaltensregeln und setze mich mit dem Inhaber bzw. den Mitarbeitenden des Betriebes in Kontakt und erkläre, dass der Betriebsverantwortliche sich nicht an die Regeln hält.',
            'explanation' => 'Falsch, grundsätzlich dürfen keine Probleme, Meinungsverschiedenheiten oder überhaupt irgendwelche Interna an die Mitarbeitenden sowie die/den InhaberIn herangetragen werden. Es ist wichtig, dass wir die Betriebe voll zufriedenstellen und dementsprechend keine internen Unklarheiten oder andere Informationen an sie herantragen. Das Sprechen über Probleme, Ungereimtheiten und alle anderen Themen ist Aufgabe der/des Betriebsverantwortliche(n) bzw. der BotschafterInnen. Was natürlich nicht bedeutet, dass Foodsaver sich nicht mit den Mitarbeitenden unterhalten sollen, nur eben nicht über die besagten Themen und immer mit Fingerspitzengefühl, ob die Mitarbeitenden gerade Lust und Zeit haben.
Richtig ist hingegen das Melden des Verstoßes, denn wir sind alle dafür verantwortlich, jeglichen Verstoß gegen die Verhaltensregeln zu melden, damit sich nicht zugelassene Verhaltensweisen erst gar nicht etablieren und geklärt werden können, bevor ein großes Problem entsteht. Das Eintragen aller Abholungen, wer wann mit wem abholt, ist essenziell, um zu gewährleisten, dass Probleme früh erkannt werden und ist auch die einzige Garantie, dass der Ruf von Foodsharing gewahrt bleibt und unser Versprechen an die Betriebe, dass nur Menschen, die die Rechtsvereinbarung und die Verhaltensregeln akzeptieren und einhalten abholen können, auch eingehalten wird. Das unterstreicht die Zuverlässigkeit und Ernsthaftigkeit des Projektes Foodsharing, mit der wir die Lebensmittelverschwendung beenden wollen und unterbindet außerdem Filzbildung, freundschaftliches Wegschauen, Themen runterschlucken etc.',
                'right' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'question_id' => 1,
            'text' => 'Ich kenne den/die Bezirksverantwortliche(n) persönlich und habe einen guten Draht zu ihm/ihr, deswegen frage ich ihn/sie einfach, ob ich nicht auch abholen kann ohne die Abholzeiten einzutragen, weil das in dem Betrieb nicht notwendig ist.',
                'explanation' => 'Falsch, in jedem Betrieb, bei dem feste Abholtage eingetragen bzw. ausgemacht worden sind, müssen diese auch über die Plattform gefüllt werden. Das Eintragen aller Abholungen, wer wann mit wem abholt, ist essenziell, um zu gewährleisten, dass Probleme früh erkannt werden und ist auch die einzige Garantie, dass der Ruf von Foodsharing gewahrt bleibt und unser Versprechen an die Betriebe, dass nur Menschen, die die Rechtsvereinbarung und die Verhaltensregeln akzeptieren und einhalten abholen können, auch eingehalten wird.Teil der Verhaltensregeln ist es auch, dass wir alle verantwortlich sind, jeglichen Verstoß gegen die Verhaltensregeln zu melden, damit sich nicht zugelassene Verhaltensweisen erst gar nicht etablieren und geklärt werden können, bevor ein großes Problem entsteht. Das unterstreicht die Zuverlässigkeit und Ernsthaftigkeit des Projektes Foodsharing, mit der wir die Lebensmittelverschwendung beenden wollen und unterbindet außerdem Filzbildung, freundschaftliches Wegschauen, Themen runterschlucken etc.',
                'right' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'question_id' => 1,
                'text' => 'Ich melde den Verstoß gegen die Verhaltensregeln und setze mich dann umgehend mit meinem/r BotschafterIn in Kontakt, um über das nicht angebrachte Verhalten von dem Betriebsverantwortlichen zu sprechen.',
            'explanation' => 'Nicht 100% richtig, grundsätzlich werden alle Verstöße, die gemeldet werden, automatisch an den/die verantwortliche BotschafterIn übermittelt, diese kümmern sich innerhalb von einer Woche um den Vorfall und wenn nicht, dann wird der Verstoß an die nächste Instanz, also dem/der BotschafterIn weitergeleitet. Es ist also nicht erforderlich, Deine(n) oder irgendeinen anderen BotschafterIn anzusprechen, das würde für Dich und den/die BotschafterIn nur extra Zeit und Energie kosten und höchstwahrscheinlich zur Verwirrung sorgen, wer sich jetzt um den Fall kümmern muss. Richtig ist hingegen das Melden des Verstoßes, denn wir sind alle verantwortlich jeglichen Verstoß gegen die Verhaltensregeln zu melden, damit sich nicht zugelassene Verhaltensweisen erst gar nicht etablieren und geklärt werden können, bevor ein großes Problem entsteht. Das Eintragen aller Abholungen, wer wann mit wem abholt, ist essenziell, um zu gewährleisten, dass Probleme früh erkannt werden und ist auch die einzige Garantie, dass der Ruf von Foodsharing gewahrt bleibt und unser Versprechen an die Betriebe, dass nur Menschen, die die Rechtsvereinbarung und die Verhaltensregeln akzeptieren und einhalten abholen können, auch eingehalten wird. Das unterstreicht die Zuverlässigkeit und Ernsthaftigkeit des Projektes Foodsharing, mit der wir die Lebensmittelverschwendung beenden wollen und unterbindet außerdem Filzbildung, freundschaftliches Wegschauen, Themen runterschlucken etc.',
                'right' => 2,
            ),
            4 => 
            array (
                'id' => 5,
                'question_id' => 2,
                'text' => 'Ich mache gar nichts, weil es ja 2 andere Foodsaver gibt, die auch auf der Liste stehen.',
                'explanation' => 'Falsch, denn eine kurze Info an die anderen Abholer stellt sicher, dass diese dann am Abholtermin nicht unnötig warten. Zudem kann leicht der Eindruck von Unzuverlässigkeit entstehen wenn keine Info an die anderen weitergeleitet wird.',
                'right' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'question_id' => 2,
                'text' => 'Ich rufe im Betrieb an und sage dem/der SupermarktleiterIn, ob er/sie bitte den anderen Foodsavern sagen könnte, dass ich nicht komme, weil ich mich nicht so gut fühle.',
                'explanation' => 'Falsch, unsere Aufgabe ist es, die Betriebe zu entlasten und ihnen möglichst viel Arbeit abzunehmen und keinen Mehraufwand zu verursachen, deswegen grundsätzlich den Filialverantwortlichen nur dann ansprechen, wenn etwas Grundlegendes falsch läuft und vorher immer mit dem Betriebsverantwortlichen sprechen.',
                'right' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'question_id' => 2,
                'text' => 'Ich trage mich aus sobald ich absehen kann, dass ich es nicht zu einem Abholtermin schaffe, mindestens aber 24 Stunden vorher. 
In der automatischen auftauchenden Teamnachricht schreibe ich ggf. warum ich nicht kann und noch nach ErsatzabholerInnen im Team suche.',
                'explanation' => 'Richtig, wichtig ist dabei zu beachten, dass Du nachkontrollierst, ob sich jemand für Deine Abholzeit eingetragen hat und wenn nicht, dass du den zwei anderen Foodsavern eine Nachricht schreibst, sodass die sich drauf einstellen können, dass sie nur zu zweit sind und auf niemand warten müssen. Solltest Du 4 Stunden vor Abholungstermin immer noch kein Feedback auf Deine Nachricht bekommen haben, musst Du Dich bei den Abholenden per Telefon oder Handy melden.',
                'right' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'question_id' => 2,
                'text' => 'Ich habe einen sehr zuverlässigen Mitbewohner, der auch schon immer mal abholen wollte, aber noch keine Zeit gefunden hat, sich anzumelden. Ich erkläre ihm kurz den Ablauf und lasse ihn statt meiner gehen.',
                'explanation' => 'Das ist rechtlich verboten, denn wenn Deinem Mitbewohner etwas passieren sollte und er ohne Anmeldung auch nicht die Rechtsvereinbarung unterschrieben hat, steht Foodsharing mit seinem Namen gegenüber den Betrieben nicht gut da, weil wir ja dem Betrieb garantiert haben, dass nur von uns akkreditierte und verifizierte Foodsaver abholen dürfen.
Desweiteren fühlen sich die anderen Foodsaver, die mit Deinem Mitbewohner abholen gehen, evtl. übergangen was nicht positiv für die Teamgeist ist.',
                'right' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'question_id' => 3,
                'text' => 'Ich rufe den Foodsaver an und erkundige mich ob er noch kommt, bevor ich den Laden betrete - in Zweifelsfall fange ich schon mal an, alles zu sortieren und nehme ggf. auch alles alleine mit.',
                'explanation' => 'Richtig, es ist immer gut in Vorfeld Klarheit zu schaffen, ob die anderen Foodsaver noch kommen. Wenn Du im Laden versuchst, die anderen zu erreichen, wirkt das unkoordiniert und unprofessionell. Solltest Du niemanden erreichen, ist es vollkommen legitim alleine loszulegen. Wichtig ist dabei, dass unentschuldigtes Fehlen gemeldet werden muss, damit die Wichtigkeit und Ernsthaftigkeit der Teamarbeit klar wird und bei wiederholtem Verstoß gegen die Verhaltensregeln unzuverlässige Foodsaver nicht mehr alleine abholen dürfen bzw. bei häufigem Missachten der Verhaltensregeln auch eine Sperrung des Foodsavers von der Plattform bedeutet. Ziel ist es, durch ein transparentes System so früh wie möglich auf Problemfälle hinzuweisen, damit es erst gar nicht zu negativen Auswirkungen kommt.',
                'right' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'question_id' => 3,
            'text' => 'Ich habe lange genug gewartet(15 min) und da ich den anderen Foodsaver nicht telefonisch erreichen konnte, hole ich die Lebensmittel ab, gehe nach Hause und melde das Nichterscheinen des anderen Foodsavers als Verstoß gegen die Verhaltensregeln.',
                'explanation' => 'Richtig, selbstverständlich sind alle Verstöße gegen die Verhaltensregeln zu melden, doch noch schöner ist es, es gar nicht dazu kommen zu lassen. Also vorher per Telefon klären ob der/diejenige noch kommt und vor allem, wie dem Betrieb versprochen, alle abzuholenden Waren abnehmen, auch wenn man einen Moment später dran ist.
Wichtig ist, dass unentschuldigtes Fehlen gemeldet werden muss, damit die Wichtigkeit und Ernsthaftigkeit der Teamarbeit klar wird und bei wiederholtem Verstoß gegen die Verhaltensregeln unzuverlässige Foodsaver nicht mehr alleine abholen dürfen. Bei häufigem Missachten der Verhaltensregeln kann es auch eine Sperrung des Foodsavers von der Plattform bedeuten. Ziel ist es, durch ein transparentes System so früh wie möglich auf Problemfälle hinzuweisen, damit es erst gar nicht zu negativen Auswirkungen kommt.
Was Du auf jeden Fall machen musst, ist, wie abgesprochen, die Lebensmittel vom Supermarkt abzuholen und was dann noch gut für die Teambildung ist: du kannst eine liebe Nachricht an den/die nicht aufgetauchte Foodsaver schreiben, dass eine Kiste abholbereit bei Dir zu Hause steht.',
                'right' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'question_id' => 3,
                'text' => 'Nachdem ich den Foodsaver nicht per Handy erreichen kann, aber den Ablauf im Betrieb ja kenne, sortiere ich alles und lasse eine Kiste für den vielleicht später kommenden Foodsaver stehen. Damit die Angestellten sich nicht wundern, sage ich ihnen Bescheid, dass der andere Foodsaver wahrscheinlich später kommt.',
                'explanation' => 'Falsch, es ist zwar lieb, an den anderen Foodsaver zu denken, aber wir wollen den Angestellten unter keinen Umständen zusätzliche Arbeit verursachen bzw. auch keine Ungewissheit schaffen, die evtl. bei den Angestellten aufkommen könnte: “Kommt der andere Foodsaver jetzt oder nicht?”, “Was sagt mein Chef zu dieser Kiste?”, “Wie lange soll ich warten bis ich die Kiste samt Inhalt entsorgen muss?” etc.
Was Du machen kannst und auch gut für die Teambildung ist, ist eine liebe Nachricht an den/die nicht aufgetauchte Foodsaver zu schreiben, dass eine Kiste abholbereit bei Dir zu Hause steht. 
Du musst allerdings in jedem Fall das Nichterscheinen von dem Foodsaver als Verstoßmeldung melden, wenn Du dabei die Begründung anführst warum dieser nicht erschienen ist, ist das von Vorteil.',
                'right' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'question_id' => 3,
                'text' => 'Nachdem ich den Foodsaver telefonisch nicht erreichen kann, frage ich die Angestellten, ob der Foodsaver vielleicht schon abholen war.',
            'explanation' => 'Falsch, unsere Aufgabe ist es, die Betriebe zu entlasten und ihnen möglichst viel Arbeit abzunehmen und keinen Mehraufwand zu verursachen. Deswegen grundsätzlich die Angestellten sowie den/die GeschäftsleiterIn nur ansprechen, wenn etwas Grundlegendes falsch läuft und vorher immer mit dem/der Betriebsverantwortliche(n) sprechen.
Es ist also nicht von Vorteil, preiszugeben, dass ein Foodsaver sich verspätet und sich nicht abmeldet, deswegen lieber so tun, als ob Du heute eben nur alleine abholst.
Was Du im Nachhinein machen kannst und auch vorteilhaft für die Teambildung ist, ist eine liebe Nachricht an den/die nicht aufgetauchte Foodsaver zu schreiben, dass eine Kiste abholbereit bei Dir zu Hause steht. Trotzdem musst Du das Nichterscheinen von dem Foodsaver als Verstoßmeldung melden, wenn Du dabei die Begründung anführst warum dieser nicht erschienen ist, ist das von Vorteil. Sollte jemand unbekanntes abgeholt haben, schreibe dies auf die Betriebspinnwand und kläre das mit dem Betriebsverantwortlichen ab, so dass bei mehrmaligen auftreten von dem Problem eine foodsharing Ausweiskontrolle in dem Betrieb eingeführt wird. Das verhindert das sich Foodsaver oder andere Menschen außerhalb des foodsharing Netzwerk unangemeldet abholen gehen.',
                'right' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'question_id' => 5,
                'text' => 'auf der Strasse weiterverkaufen.',
                'explanation' => 'Falsch, die geretteten Lebensmittel werden ausschließlich nicht kommerziell weitergegeben und auch nicht getauscht. Nicht kommerziell bedeutet: sie werden verschenkt über Foodsharing.de, in deinem Umfeld, an gemeinnützigen Vereinen etc. gebracht und selbstverständlich selbst konsumiert.',
                'right' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'question_id' => 5,
                'text' => 'selbst konsumieren oder an Dritte weiterschenken.',
                'explanation' => 'Richtig, du kannst die Lebensmittel selber konsumieren oder an Dritte weiterverschenken. Dies kann z B. über Foodsharing.de geschehen. Du kannst die Lebensmittel aber auch in deinem Umfeld verteilen oder sie zu gemeinnützigen Vereinen etc. bringen.',
                'right' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'question_id' => 5,
                'text' => 'selber konsumieren und alles was ich nicht essen will oder schaffe, kann ich entsorgen.',
                'explanation' => 'Falsch, die geretteten Lebensmittel werden ausschließlich nicht kommerziell weitergegeben, sprich: verschenkt über foodsharing.de, in deinem Umfeld, an gemeinnützige Vereine etc. oder selbstverständlich auch selbst konsumiert.',
                'right' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'question_id' => 5,
                'text' => 'online weiter verkaufen.',
                'explanation' => 'Falsch, die geretteten Lebensmittel werden ausschließlich nicht kommerziell weitergegeben, sprich: verschenkt über Foodsharing.de, in deinem Umfeld, an gemeinnützige Vereine etc. oder werden selbstverständlich selbst konsumiert.',
                'right' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'question_id' => 6,
                'text' => 'Es ist grundsätzlich untersagt, die geretteten Lebensmittel zu verkaufen, oder gegen Sachspenden zu tauschen.',
                'explanation' => 'Richtig, es ist eine essentielle Grundlage von foodsharing nicht kommerziell zu handeln. Dies beinhaltet auch jegliche Veräußerung oder Vergütung - und zwar nicht nur aus steuertechnischen und bürokratischen Gründen, sondern weil wir Lebensmitteln einen ideellen Wert beimessen und dieser nicht in Geld aufgewogen werden kann. Außerdem ist es, wie auch bei foodsharing, verboten, egal welche Lebensmittel oder Getränke zu veräußern. Ausnahme sind: Flaschen-, Kisten-, Behälter- und andere Pfandwaren, die an Lebensmittelbetriebe bezahlt werden mussten. In diesen Fällen darf die jeweils ausgelegte Summe von Privatpersonen oder Vereinen nach Absprache verlangt werden.',
                'right' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'question_id' => 6,
                'text' => 'Bei hohen Fahrtkosten und großen Mengen geretteter Lebensmittel ist es legitim, den Vereinen, die man mit den geretteten Waren beliefert, eine kleine Rechnung zu stellen, so lange diese nicht auf Gewinn zielt, sondern nur die entstandenen Kosten decken soll.',
                'explanation' => 'Falsch, es ist eine essentielle Grundlage von foodsharing, nicht kommerziell zu handeln. Dies beinhaltet auch jegliche Veräußerung oder Vergütung - nicht nur aus steuertechnischen und bürokratischen Gründen, sondern weil wir Lebensmitteln einen ideellen Wert beimessen und dieser nicht in Geld aufgewogen werden kann. Außerdem ist es, wie auch bei foodsharing, verboten egal welche Lebensmittel oder Getränke zu veräußern. Ausnahme sind: Flaschen-, Kisten-, Behälter- und Andere Pfandwaren die an Lebensmittelbetriebe bezahlt werden mussten. In diesen Fällen darf die jeweils ausgelegte Summe von Privatpersonen oder Vereinen nach Absprache entgegen genommen werden.',
                'right' => 0,
            ),
            18 => 
            array (
                'id' => 19,
                'question_id' => 6,
            'text' => 'Wenn Pfand an den Lebensmittelbetrieb bezahlt werden musste (z.B. Flaschen-, Kisten-, Behälter- und andere Pfandwaren), darf die jeweils ausgelegte Summe von Privatpersonen oder Vereinen bei der Weitergabe der Artikel verlangt werden.',
                'explanation' => 'Richtig, bei Flaschen-, Kisten-, Behälter- und anderen Pfandwaren, die an Lebensmittelbetriebe bezahlt werden mussten, darf die jeweils ausgelegte Summe von Privatpersonen oder Vereinen verlangt werden. Dies ist allerdings die einzige Ausnahme, ansonsten gilt: Es ist eine essentielle Grundlage gerettete Lebensmittel nicht zu veräußern und zwar nicht nur aus steuertechnischen und bürokratischen Gründen, sondern weil wir Lebensmitteln einen ideellen Wert beimessen und dieser nicht in Geld aufgewogen werden kann.',
                'right' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'question_id' => 6,
                'text' => 'Wenn die geretteten Waren einen tadellosen Zustand haben und so aussehen wie neu, ist es den Foodsavern, die knapp bei Kasse sind, erlaubt, diese auch zu verkaufen.',
                'explanation' => 'Falsch, es spielt keine Rolle, wie viel Geld jemand hat, es ist eine essentielle Grundlage von Lebensmittelretten.de und foodsharing nicht kommerziell zu handel. Dies beinhaltet auch jegliche Veräußerung oder Vergütung - nicht nur aus steuertechnischen und bürokratischen Gründen, sondern weil wir Lebensmitteln einen ideellen Wert beimessen und dieser nicht in Geld aufgewogen werden kann. Außerdem ist es, wie auch bei foodsharing, verboten, egal welche Lebensmittel oder Getränke zu veräußern. Ausnahme sind: Flaschen-, Kisten-, Behälter- und andere Pfandwaren, die an Lebensmittelbetriebe bezahlt werden mussten. In diesen Fällen darf die jeweils ausgelegte Summe von Privatpersonen oder Vereinen verlangt werden.',
                'right' => 0,
            ),
            20 => 
            array (
                'id' => 21,
                'question_id' => 7,
                'text' => 'Zu den Abholungen in den Betrieben gehen in der Regel nicht mehr als 2 Personen. Mehr Leute würden auch für mehr Aufmerksamkeit sorgen. Dies hat schon zu Abbrüchen von Kooperationen geführt. Ausnahmen können u.a. Markstände bzw. Wochenmärkte sein, wo auch mehr Foodsaver auf einmal retten gehen. ',
            'explanation' => 'Richtig, bitte achtet generell darauf dass Ihr unauffällig, höflich und nett auftretet. Sollte es immer sehr viel abzuholen sein, dann kann auch nach Absprache mit dem Filialverantworltichen des Betriebes, in Erwägung gezogen werden, ob im Hof oder dem Parkplatz 3 oder 4 Personen auf einmal zum Abholen bzw. sortieren kommen können. Sollte dies nicht gewünscht sein, ist es wichtig, wie bei allem, den Wünschen der kooperierenden Betriebe Folge zu leisten. Sollte es dennoch zu viel zum Abholen geben, kann ein Treffpunkt außerhalb der Sichtweite des Betriebes und der Kunden gefunden werden, an dem ein auf eine fixe Uhrzeit und begrenzte Zeit die Lebensmittel (untereinander) fairteilt werden. Bitte jedoch nur unter maximal 8 Foodsavern, um Chaos zu vermeiden.',
                'right' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'question_id' => 7,
                'text' => 'Jeder nimmt sich nur seinen Eigenbedarf mit und schmeißt den Rest weg.',
                'explanation' => 'Falsch, alle Lebensmittel werden immer fair untereinander aufgeteilt, mitgenommen und an Dritte weitergeschenkt.',
                'right' => 0,
            ),
            22 => 
            array (
                'id' => 23,
                'question_id' => 7,
            'text' => 'Beim Abholen als Team aufzutreten und sich auch als Teamplayer mit dem Betrieb sehen: also immer pünktlich, bei Betrieben gemeinsam reingehen (in der Regel max. 2 Foodsaver), wobei es bei großen Betrieben auch vorkommen kann, das andere Foodsaver in der Nähe des Betriebes warten. Desweiteren freundlich, lieb grüßend und offen mit den MitarbeiterInnen umgehen, sowie niemals (um Essen) streiten, laut werden oder Dreck hinterlassen.',
            'explanation' => 'Richtig, oberstes Ziel ist es, die Lebensmittelverschwendung zu reduzieren und dafür brauchen wir ein gutes Team, einen liebevollen Umgang miteinander sowie mit den Angestellten. Achtet generell darauf dass Ihr unauffällig, höflich und nett auftretet. Sollte es immer sehr viel abzuholen sein, dann kann auch nach Absprache mit dem Filialverantworltichen des Betriebes, in Erwägung gezogen werden, ob im Hof oder dem Parkplatz 3 oder 4 Personen auf einmal zum Abholen bzw. sortieren kommen können. Sollte dies nicht gewünscht sein, ist es wichtig, wie bei allem, den Wünschen der kooperierenden Betriebe Folge zu leisten. Sollte es dennoch zu viel zum Abholen geben, kann ein Treffpunkt außerhalb der Sichtweite des Betriebes und der Kunden gefunden werden, an dem ein auf eine fixe Uhrzeit und begrenzte Zeit die Lebensmittel (untereinander) fairteilt werden. Bitte jedoch nur unter maximal 8 Foodsavern, um Chaos zu vermeiden.',
                'right' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'question_id' => 7,
                'text' => 'Die geretteten Lebensmittel werden nicht im Laden, direkt vor dem Laden oder generell vor den Augen der Kundschaft geteilt.',
                'explanation' => 'Richtig, bitte verteilt die geretteten Lebensmittel an einem Ort außerhalb der Sichtweite des Ladens und abseits der Kundschaft, um Ärgernisse mit dem Betrieb zu vermeiden. Auch wenn 2 Foodsaver gemeinsam im Laden abholen, sollten die Lebensmittel erst außerhalb des Ladens untereinander aufgeteilt werden.',
                'right' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'question_id' => 8,
                'text' => 'Auch wenn es nicht Deine Art ist, schreibst Du auch im scharfen Stil zurück, aber nicht im Forum, sondern in einer privaten Nachricht.',
                'explanation' => 'Falsch, Du musst Dich schriftlich wie auch mündlich unter Kontrolle haben können und stets auf einen höflichen und respektvollen Umgangston achten. Du schreibst also der betreffenden Person eine persönliche Nachricht und versuchst die Angelegenheit ruhig und sachlich zu klären. Sollte das, aus welchen Gründen auch immer, nicht möglich sein oder scheitern, wendest Du Dich an den/die BotschafterIn deiner Region oder an orgateam@lebensmittelretten.de und bittest um eine Vermittlung, die bestenfalls persönlich mit allen Beteiligten erfolgen wird.	
Sollte das im Forum geschriebene gegen die Verhaltensregeln verstoßen, ist es wichtig, auch diesen kleinen Verstoß zu melden. Nur so ist es möglich, sich später auf diesen zu beziehen, wenn z.B. der/die FoodsaverIn an einen anderen Ort zieht oder Du als BotschafterIn umziehst. Nur so ist gewährleistet, dass auch andere zukünftige BotschafterInnen, das Verstoßmeldungs- und das Orgateam einen Überblick über alle Regelverstöße des Foodsavers haben um bei wiederholten Auftreten dieser sofort einzugreifen, bevor sich ein größeres Problem entwickelt.',
                'right' => 0,
            ),
            25 => 
            array (
                'id' => 26,
                'question_id' => 8,
                'text' => 'Du schreibst die betreffende Person persönlich per Mail an und versuchst die Angelegenheit ruhig und sachlich zu klären. Sollte dies, aus welchen Gründen auch immer, nicht möglich sein oder scheitern, wendest Du Dich an den/die BotschafterIn deiner Region oder an die Schlichtungsteamgruppe und bittest um eine Vermittlung, die bestenfalls persönlich mit allen Beteiligten erfolgen wird.',
            'explanation' => 'Richtig, versuche immer erst im direkten Kontakt das Problem zu lösen. Sollte dies nicht möglich sein, wende Dich an die nächst höhere Stufe, also den/die Betriebsverantwortliche, Deine(n) BotschafterIn bzw. eben das Orgateam orgateam@lebensmittelretten.de).
Sollte das im Forum geschriebene gegen die Verhaltensregeln verstoßen, ist es wichtig, auch diesen kleinen Verstoß zu melden. Nur so ist es möglich, sich später auf diesen zu beziehen, wenn z.B. der/die Foodsaver an einen anderen Ort zieht oder Du als BotschafterIn umziehst. Dann ist gewährleistet, dass auch andere zukünftige BotschafterInnen, das Verstoßmeldungs- und das Orgateam einen Überblick über alle Regelverstöße des Foodsavers haben um bei wiederholtem Auftreten dieser sofort einzugreifen, bevor sich ein größeres Problem entwickelt.',
                'right' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'question_id' => 8,
                'text' => 'Du erstellst ein neues Thema im Forum, in dem Du den Betreffenden anprangerst, denn schließlich hast Du ja nicht angefangen und bist daher im Recht.',
                'explanation' => 'Falsch, das wäre wirklich sehr kindisch und lächerlich und entspricht in keinster Weise unseren Verhaltensregeln, denn Du musst Dich schriftlich wie auch mündlich unter Kontrolle haben können und stets auf einen höflichen und respektvollen Umgangston achten. Es geht also darum, schlichtend zu wirken und nie auf einen Verstoß mit noch einem zu reagieren.
Idealerweise versuche die Unstimmigkeiten persönlich zu klären, da Geschriebenes auch sehr einfach falsch interpretiert werden kann. Daher ist es immer besser ein persönliches Gespräch zu suchen. Sollte das nicht funktionieren, schreibst Du der betreffenden Person eine persönliche Nachricht und versuchst die Angelegenheit dort ruhig und sachlich zu klären. Sollte das, aus welchen Gründen auch immer, nicht möglich sein oder scheitern, wendest Du Dich an den/die BotschafterIn Deiner Region oder an orgateam@lebensmittelretten.de und bittest um eine Vermittlung, die bestenfalls persönlich mit allen Beteiligten erfolgen wird.	
Sollte das im Forum geschriebene gegen die Verhaltensregeln verstoßen, ist es wichtig, auch diesen kleinen Verstoß zu melden. Nur so ist es möglich, sich später auf diesen zu beziehen, wenn z.B. der/die Foodsaver an einen anderen Ort zieht oder Du als BotschafterIn umziehst. Dann ist gewährleistet, dass auch andere zukünftige BotschafterInnen, das Verstoßmeldungs- und das Orgateam einen Überblick über alle Regelverstöße des Foodsavers haben um bei wiederholtem Auftreten dieser sofort einzugreifen, bevor sich ein größeres Problem entwickelt.',
                'right' => 0,
            ),
            27 => 
            array (
                'id' => 28,
                'question_id' => 8,
                'text' => 'Du rufst die Person an und versuchst das Problem in einem ruhigen Gespräch zu klären.',
                'explanation' => 'Richtig, versuche die Unstimmigkeiten persönlich zu klären, da Geschriebenes auch sehr einfach falsch interpretiert werden kann. Da ist es immer besser, ein persönliches Gespräch zu suchen.
Sollte das nicht funktionieren, schreibst Du der betreffenden Person eine persönliche Nachricht und versuchst die Angelegenheit dort ruhig und sachlich zu klären. Sollte das, aus welchen Gründen auch immer, nicht möglich sein oder scheitern, wendest Du Dich an den/die BotschafterIn Deiner Region oder an orgateam@lebensmittelretten.de und bittest um eine Vermittlung, die bestenfalls persönlich mit allen Beteiligten erfolgen wird.	
Sollte das im Forum geschriebene gegen die Verhaltensregeln verstoßen, ist es wichtig, auch diesen kleinen Verstoß zu melden. Nur so ist es möglich, sich später auf diesen zu beziehen, wenn z.B. der/die Foodsaver an einen anderen Ort zieht oder Du als BotschafterIn umziehst. Dann ist gewährleistet, dass auch andere zukünftige BotschafterInnen, das Verstoßmeldungs- und das Orgateam einen Überblick über alle Regelverstöße des Foodsavers haben um bei wiederholtem Auftreten dieser sofort einzugreifen, bevor sich ein größeres Problem entwickelt.',
                'right' => 2,
            ),
            28 => 
            array (
                'id' => 29,
                'question_id' => 9,
                'text' => 'Ich sortiere die vom Supermarkt bereitgestellten, aussortierten Lebensmittel selbstständig in noch-essbare und nicht-mehr-essbare Lebensmittel.',
                'explanation' => 'Richtig, Du entscheidest nach eigenem Ermessen, ob Du die Lebensmittel noch als verzehrbar einschätzt oder nicht. Dabei verlässt Du Dich auf Deine Sinne und kannst keinen anderen dafür haftbar machen, wenn es Dir nach dem Verzehr gesundheitlich schlecht geht. Im Zweifel lieber etwas wegschmeißen, wo Du Dir nicht ganz sicher bist, anstatt Dir den Magen zu verdrehen.',
                'right' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'question_id' => 9,
                'text' => 'Ich erläutere den MitarbeiterInnen, die mir über den Weg laufen, die derzeitige Lebensmittelverschwendung.',
                'explanation' => 'Falsch, wir legen zwar den Fokus auf die Lebensmittelverschwendung, wollen aber nicht mit erhobenem Zeigefinger auftreten. Das gilt insbesondere für die kooperierenden Betriebe. Denn diese fühlen sich schnell durch belehrende Worte belästigt und das ist kontraproduktiv, um mehr Bewusstsein im Bezug auf das Thema Lebensmittelverschwendung zu schaffen. Die Erfahrung hat gezeigt, dass auch ohne Belehrungen und Missionierungsversuche immer mehr Menschen sich mit der Thematik auseinandersetzen. Meist ist das Engagement gegen die Verschwendung wie Deines als Foodsaver, das Beste, was Du den Mitarbeitenden sowie Deinem persönlichen Umfeld vorleben kannst.',
                'right' => 0,
            ),
            30 => 
            array (
                'id' => 31,
                'question_id' => 9,
                'text' => 'Ich entsorge die verdorbenen Lebensmittel sowie die anfallenden Verpackungen, Kartons, Papiere etc. sachgerecht in die Supermarkt-Mülltonnen, oder bei mir zu Hause.',
                'explanation' => 'Richtig, je nach Vorgabe der Betriebe kannst Du die verdorbenen Lebensmittel sowie Verpackungen vor Ort entsorgen oder Du nimmst sie mit zur Dir nach Hause und entsorgst sie dort. Bitte bedenke, dass wir uns nach den Wünschen der Kooperationspartner richten.',
                'right' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'question_id' => 9,
                'text' => 'Immer ehrlich sein: z.B. den Angstellten auch offen zu sagen, dass ich nicht alles esse, weil ich mich rein pflanzlich ernähre oder mir manches einfach nicht schmeckt. So kann der Betrieb ggf. ein paar Dinge schon im Vorhinein entsorgen, weil es keinen Unterschied macht,  ob sie es wegschmeißen oder ich zu Hause.',
                'explanation' => 'Falsch, erstens ist es unsere Aufgabe, immer komplett alles an noch Essbarem mitzunehmen und auch wenn einem irgendetwas nicht schmeckt/verträgt oder man es nicht essen will, dann ist es trotzdem unser Anliegen, diese Lebensmittel mitzunehmen und weiter zu verschenken. Zweitens ist es uns sehr wichtig, den Betrieben zu zeigen, dass wir alle Lebensmittel wertschätzen und uns darum kümmern, dies unter allen Umständen vor der Tonne zu bewahren und nicht verantwortlich für den Wurf in die Tonne zu sein.',
                'right' => 0,
            ),
            32 => 
            array (
                'id' => 33,
                'question_id' => 10,
                'text' => 'Ich bin ein ehrlicher Mensch und sage, dass ich die letzten Male auch immer die Laibbrote bekam und frage, ob es denn heute keine gäbe.',
                'explanation' => 'Bitte nie Forderungen stellen und auch keine fordernde Haltung bzw. den Ton einnehmen. Sprich, immer nur Hilfe anbieten z.B. “Gibt es heute sonst noch irgendwas abzuholen?”, “Sind das alle abzugebenden Lebensmittel?“, “Generell nehmen wir von Foodsharing alles, was noch genießbar ist, auch halbe oder heruntergefallene Backwaren”. Noch besser ist diese Haltung: “Das ist ja wunderbar, dass heute nur so wenig übrig geblieben ist. Es freut mich, dass ihr da so gut kalkuliert!”.',
                'right' => 0,
            ),
            33 => 
            array (
                'id' => 34,
                'question_id' => 10,
                'text' => 'Ich freue mich dass der Betrieb so gut kalkuliert hat und damit etwas gegen die Lebensmittelverschwendung macht..',
                'explanation' => 'Richtig, unser Ziel ist es, die Lebensmittelverschwendung zu reduzieren und wenn Betriebe besser wirtschaften bzw. die MitarbeiterInnen mehr mitnehmen oder andere Organisationen abholen - dann dürfen wir uns freuen, dass wir dort weniger zu tun haben und uns anderen Betrieben widmen können, wo noch viel weggeschmissen wird.',
                'right' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'question_id' => 10,
                'text' => 'Ich kenne die Mitarbeiterin und sage: “Da fehlen doch noch die Brote, oder?”',
                'explanation' => 'Bitte nie Forderungen stellen und auch keine fordernde Haltung bzw. den Ton einnehmen. Sprich, immer nur Hilfe anbieten z.B. “Gibt es heute sonst noch irgendwas abzuholen?”, “Sind das alle abzugebenden Lebensmittel?“, “Generell nehmen wir von Foodsharing alles, was noch genießbar ist, auch halbe oder heruntergefallene Backwaren”. Noch besser ist diese Haltung: “Das ist ja wunderbar, dass heute nur so wenig übrig geblieben ist. Es freut mich, dass ihr da so gut kalkuliert!”.',
                'right' => 0,
            ),
            35 => 
            array (
                'id' => 36,
                'question_id' => 10,
                'text' => 'Ich hatte genau an dem Abend Freunde zu mir nach Hause eingeladen und bin ein wenig aufgeschmissen und sage: “Oh, das ist ja echt wenig. Ich hatte heute eigentlich extra mit den Broten gerechnet, weil ich Besuch zu Hause habe”.',
                'explanation' => 'Falsch, bitte nie Forderungen stellen und auch keine fordernde Haltung bzw. den Ton einnehmen. Sprich, immer nur Hilfe anbieten z.B. “Gibt es heute sonst noch irgendwas abzuholen?”, “Sind das alle abzugebenden Lebensmittel?“, “Generell nehmen wir von Foodsharing alles, was noch genießbar ist, auch halbe oder heruntergefallene Backwaren”. Noch besser ist diese Haltung: “Das ist ja wunderbar, dass heute nur so wenig übrig geblieben ist. Es freut mich, dass ihr da so gut kalkuliert!”.',
                'right' => 0,
            ),
            36 => 
            array (
                'id' => 37,
                'question_id' => 11,
                'text' => 'Ich nehme so viel mit, wie es geht und schmeiße das ohnehin etwas schrumplige Obst und Gemüse einfach in die Biotonne',
                'explanation' => 'Falsch, es ist sehr wichtig, immer alle noch nutz- und essbaren Waren, die uns zur Abholung bereitgestellt werden, mitzunehmen. Noch genießbares schrumpliges Obst oder Gemüse nehmen wir deswegen auch mit. Alles andere schadet dem Ruf von Foodsharing.',
                'right' => 0,
            ),
            37 => 
            array (
                'id' => 38,
                'question_id' => 11,
                'text' => 'Ich rufe den betriebsverantwortlichen Foodsaver an und frage, ob er/sie mir helfen kann bzw. ob er/sie einen Foodsaver kennt, der spontan mithelfen könnte. ',
            'explanation' => 'Richtig, das ist am besten, wenn Menschen, die ohnehin aus dem Betriebsteam sind und sich auskennen, dazustoßen und mithelfen. Möglich ist aber auch, einen Foodsaver, der nicht in der Filiale aktiv ist bzw. ein(e) nicht angemeldete FreundIn zum Tragenhelfen zu holen - da Du weiterhin die Verantwortung für die Waren trägst.',
                'right' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'question_id' => 11,
                'text' => 'Ich rufe einen Freund an, der mir bei dem Transport der abzuholenden Waren helfen kann.',
            'explanation' => 'Richtig, selbst wenn es ein(e) FreundIn ist, die noch nicht angemeldet ist, trägst Du weiterhin die Verantwortung für die Waren und kannst so ohne Probleme auf Unterstützung aus Deinem Freundeskreis zählen. Erst solltest Du es aber bei anderen Foodsavern bzw. dem Betriebsverantwortlichen versuchen. Wenn möglich, schaffst Du die Lebensmittel schon mal raus und wartest um die Ecke auf Deine(n) FreundIn, damit die mit dem Betrieb ausgemachte Abholzeit nicht hinausgezögert wird. (Außerdem sollen ja keine Leute bei der Abholung im Laden dabei sein, die keinen Haftungsausschluss unterschrieben haben.)',
                'right' => 2,
            ),
            39 => 
            array (
                'id' => 40,
                'question_id' => 11,
                'text' => 'Ich nehme so viel mit, wie es geht und sage den MitarbeiterInnen, dass sie den Rest selbst mitnehmen können.',
                'explanation' => ' Falsch, es ist sehr wichtig, immer alle noch nutz- und essbaren Waren, die uns zur Abholung bereitgestellt werden, mitzunehmen. In manchen Betrieben ist es auch verboten, dass MitarbeiterInnen abgeschriebene Lebensmittel mitnehmen. Außerdem ist auch nicht garantiert, dass sie, wenn sie die abgeschriebenen Waren mitnehmen dürfen, dies auch tatsächlich tun. Also schadet das dem Ruf von foodsharing.',
                'right' => 0,
            ),
            40 => 
            array (
                'id' => 41,
                'question_id' => 12,
                'text' => 'Wir haben das mit dem/der FilialleiterIn ausgemacht, dass alles was neben dem Einkaufswagen steht, auch für die Foodsaver ist und nehme die Kiste mit.',
                'explanation' => 'Falsch, es kann immer mal passieren, dass sich der Betrieb getäuscht hat und auch wenn es den Mitarbeitenden ein wenig Zeit kostet, sich Deine Frage anzuhören, ist das Vertrauen, dass Du damit schaffst, viel wichtiger. Deswegen lohnt es sich in den seltenen Fällen, wo Du Ware in ausgesprochen guter Qualität bereitgestellt bekommst - besonders solche, die noch nicht abgelaufen ist - nachzufragen, denn es kann immer mal passieren, dass auch die MitarbeiterInnen einen Fehler machen und wenn wir da freundlich nachfragen, stärkt das die Verbundenheit zu Foodsharing bzw. zu Dir.',
                'right' => 0,
            ),
            41 => 
            array (
                'id' => 42,
                'question_id' => 12,
                'text' => 'Ich nehme an, dass es ein Irrtum sein muss und lasse die Kiste einfach stehen.',
                'explanation' => 'Falsch, es kann gut sein, dass aufgrund von neuem Design oder Herausnehmen aus dem Sortiment, Waren noch nicht abgelaufen sind, aber nicht mehr verkauft werden. Es macht sich immer gut, bei ungewöhnlich guter Qualität von Lebensmitteln oder besonders vielen Waren, die noch nicht abgelaufen sind, nachzufragen, denn es kann immer mal passieren, dass auch die MitarbeiterInnen einen Fehler machen und wenn wir da freundlich nachfragen, stärkt das das Vertrauen in uns.',
                'right' => 0,
            ),
            42 => 
            array (
                'id' => 43,
                'question_id' => 12,
                'text' => 'Ich gehe mit dem Kaffee in den Verkaufsraum und belehre die Mitarbeiterin, dass man den Kaffee nicht wegschmeißen sollte, da das MHD noch nicht abgelaufen ist.',
                'explanation' => 'Falsch, es kann gut sein, dass aufgrund von neuem Design oder Herausnehmen aus dem Sortiment, Waren noch nicht abgelaufen sind, aber nicht mehr verkauft werden. Es macht sich immer gut, bei ungewöhnlich guter Qualität von Lebensmitteln oder besonders vielen Waren, die noch nicht abgelaufen sind, nachzufragen, denn es kann immer mal passieren, dass auch die MitarbeiterInnen einen Fehler machen. Wenn wir da freundlich nachfragen, stärkt das das Vertrauen in uns. Und wir belehren die Mitarbeitenden nicht!',
                'right' => 0,
            ),
            43 => 
            array (
                'id' => 44,
                'question_id' => 12,
                'text' => 'Obwohl wir mit dem/der FilialleiterIn ausgemacht haben, dass alles was neben dem Einkaufswagen steht, auch für die Foodsaver ist, frage ich einen Mitarbeiter bzw. den/die Filialverantwortlichen, ob der Kaffee wirklich für die Foodsaver bestimmt ist, obwohl er noch nicht abgelaufen ist.',
                'explanation' => 'Richtig, es macht sich immer gut, bei ungewöhnlich guter Qualität von Lebensmitteln oder besonders vielen Waren, die noch nicht abgelaufen sind, nachzufragen. Es kann immer mal passieren, dass auch die MitarbeiterInnen einen Fehler machen und wenn wir da freundlich nachfragen, stärkt dies das Vertrauen in Foodsharing bzw. in Dich.',
                'right' => 1,
            ),
            44 => 
            array (
                'id' => 45,
                'question_id' => 13,
                'text' => 'Ich trage mich nicht aus den Abholerteminen in meinen Betrieben aus, weil es noch andere Foodsaver gibt, die an den Tagen, wo ich eingetragen bin, abholen gehen.',
                'explanation' => 'Falsch, wenn Du Deine Abholtermine nicht einhalten kannst, schreibst Du eine Nachricht an das Team, sodass schnellstmöglich für Ersatz gesorgt werden kann. Wie auch bei allen anderen Abholterminen trägst Du Dich aus sobald Du es absehen kannst, dass Du den Termin nicht wahrnehmen kannst. Damit ist gewährleistet, dass die anderen Foodsaver sich einstellen können wer kommt, außerdem ist der Platz sonst von dir belegt und es kann zu Missverständnissen kommen. Grundsätzlich tragen wir uns nur dann zu Abholterminen ein, wenn wir auch wirklich sicher sind, dass wir zu diesem Zeitpunkt auch abholen können. Sich aus einem Termin austragen ist jederzeit möglich, die Option sollte aber wirklich nur selten genutzt werden, weil es sonst zu Unstimmigkeiten und Unmut im Team führt.',
                'right' => 0,
            ),
            45 => 
            array (
                'id' => 46,
                'question_id' => 13,
                'text' => 'Ich trage mich rechzeitig aus und sorge für Ersatz, indem ich eine Nachricht an das Team und ggf. an die Springer sende. Falls ein Springer übernimmt, schreibe ich diese Information auf die Pinnwand der Betriebsseite.',
                'explanation' => 'Richtig, wichtig ist, dass Du anschließend sichergehst, dass jemand auf deinen Aufruf reagiert, deine Termine übernimmt und dies kommunziert wird.',
                'right' => 1,
            ),
            46 => 
            array (
                'id' => 47,
                'question_id' => 13,
                'text' => 'Ich fahre in den Urlaub, ohne die anderen Foodsaver meines Team zu informieren, da ich ja mich erholen möchte und mich nicht vor der Reise damit stressen möchte. Es ist die Aufgabe des Betriebsverantwortlichen andere Foodsaver zu finden während ich weg bin.',
            'explanation' => 'Falsch, auch wenn es mehr Arbeit und Stress bedeutet, muss rechtzeitig vor dem Urlaub ein Ersatz gesucht werden, damit auch weiterhin eine verlässliche Abholung stattfinden kann. Das heißt Du ziehst Dir eine Schlafmütze für die Zeit auf (unter Einstellungen) und benachrichtigst auf der Pinnwand des Betriebes Dein Team über den Zeitraum in dem Du nicht abholen wirst.',
                'right' => 0,
            ),
            47 => 
            array (
                'id' => 48,
                'question_id' => 13,
                'text' => 'Ich frage Freunde, die nicht bei foodsharing als Foodsaver angemeldet sind, aber Zeit hätten, ob sie meine Abholungen übernehmen.',
                'explanation' => 'Falsch, alle Abholer müssen akkreditierte Foodsaver sein, damit die Rechtsvereinbarung gesichert ist. Richtig ist, sich rechzeitig auszutragen und für  Ersatz zu sorgen, indem Du eine Nachricht an das Team und ggf. an die Springer sendest. Dabei ist es wichtig, dass Du anschließend sichergehst, dass jemand auf deinen Aufruf reagiert, deine Termine übernimmt und du diese Information auf der Pinnwand des Betriebes teilst.',
                'right' => 0,
            ),
            48 => 
            array (
                'id' => 49,
                'question_id' => 14,
                'text' => 'Ich gehe einfach mal zum Laden und frage nach, wie der aktuelle Stand mit Foodsharing ist und wann abgeholt wird.',
            'explanation' => 'Falsch, der/die Betriebsverantwortliche/r (und bitte nur diese/r) pflegt den direkten Kontakt zu dem Betrieb, alles andere führt zu Chaos.',
                'right' => 0,
            ),
            49 => 
            array (
                'id' => 50,
                'question_id' => 14,
                'text' => 'Ich mache erst mal gar nichts und warte.',
            'explanation' => 'Falsch, besser ist es, wenn Du Dich mit einer kurzen Nachricht an den/die Betriebsverantwortliche/n wendest und nachfragst. Sollte diese(r) nicht reagieren, wendest Du Dich an den/die BotschafterIn von Dir.',
                'right' => 2,
            ),
            50 => 
            array (
                'id' => 51,
                'question_id' => 14,
                'text' => 'Ich schreibe dem/der BetriebsverantwortlicheN Foodsaver eine Nachricht.',
            'explanation' => 'Richtig, so kannst Du direkt und auf dem schnellsten Weg nachfragen, warum Du noch nicht angenommen wurdest (auch Betriebsverantwortliche machen mal Urlaub ;-))',
                'right' => 1,
            ),
            51 => 
            array (
                'id' => 52,
                'question_id' => 14,
                'text' => 'Ich gehe mit meinem Foodsaver Ausweis zum Laden und sage, dass ich von Foodsharing bin und die überschüssigen Lebensmitteln abholen möchte.',
                'explanation' => 'Falsch, Lebensmittel werden zu vereinbarten Tagen und Uhrzeiten von den dafür auf foodsharing eingetragenen Foodsavern gerettet. Wenn jede/r einfach so zu einem Betrieb geht, dann wirkt das unprofessionell, unstrukturiert und könnte das Ende der Kooperation bedeuten.',
                'right' => 0,
            ),
            52 => 
            array (
                'id' => 53,
                'question_id' => 15,
                'text' => 'Bio Company und Alnatura sind Hauptsponsoren und zahlen neben der Programmierarbeit auch Server und Domainkosten.',
            'explanation' => 'Falsch, der foodsharing Verein hilft hier und da mal aus, wenn es um das Bezahlen von Versicherungen oder Heizkosten für große Treffen von Lebensmittelrettenden und interessierten an Foodsharing geht. Alles andere wie die Programmierung, Webdesign, Gestaltung und Organisation der Plattform wird unentgeltlich und ehrenamtlich geleistet; ferner gibt es auch Spenden in Form von Sachleistungen (Domain-, Server- und Rechtsanwaltleistungen etc.).',
                'right' => 0,
            ),
            53 => 
            array (
                'id' => 54,
                'question_id' => 15,
                'text' => 'Foodsharing e.V. ist ein durch Spenden finanzierter Verein und hilft hier und da mal aus, wenn es um das Bezahlen von Versicherungen oder Heizkosten für große foodsharing Treffen geht. Derzeit gibt es nur eine bezahlte Minijobstelle, die der Geschäftsführung des foodsharing e.V., alles andere wird ehrenamtlich geleistet bzw. werden Sachspenden angenommen.',
            'explanation' => 'Richtig, der foodsharing Verein hilft hier und da mal aus, wenn es um das Bezahlen von Versicherungen oder Heizkosten für große Treffen von Lebensmittelrettenden und interessierten an foodsharing geht. Alles andere wie die Programmierung, Webdesign, Gestaltung und Organisation der Plattform wird unentgeltlich und ehrenamtlich geleistet; ferner gibt es auch Spenden in Form von Sachleistungen (Domain-, Server- und Rechtsanwaltleistungen etc.).',
                'right' => 1,
            ),
            54 => 
            array (
                'id' => 55,
                'question_id' => 15,
                'text' => 'Über eine gut angelegte Crowdfunding Kampagne.',
            'explanation' => 'Zur Anfangszeit von foodsharing wurde neben anderen Einnahmen auch knapp 12.000 € durch eine crowdfunding Kampagne finanziert. Die Gelder daraus wurden zum größten Teil für die alte foodsharing Webseite genutzt, die es inzwischen gar nicht mehr gibt. Heute läuft Programmierung, Webdesign, Gestaltung und Organisation der Plattform unentgeltlich und ehrenamtlich; ferner gibt es auch Spenden in Form von Sachleistungen (Domain-, Server- und Rechtsanwaltleistungen etc.). Nur die Geschäftsführung bekommt derzeit noch durch eine Minijobstelle Geld.',
                'right' => 2,
            ),
            55 => 
            array (
                'id' => 56,
                'question_id' => 15,
                'text' => 'Alle Foodsharing BotschafterInnen finanzieren mit einem freiwilligen Beitrag, der monatlich auf ein Ökokonto überwiesen wird, die Community und die Plattform.',
            'explanation' => 'Falsch, der foodsharing Verein hilft hier und da mal aus, wenn es um das Bezahlen von Versicherungen oder Heizkosten für große Treffen von Lebensmittelrettenden und interessierten an Foodsharing geht. Alles andere wie die Programmierung, Webdesign, Gestaltung und Organisation der Plattform wird unentgeldlich und ehrenamtlich geleistet; ferner gibt es auch Spenden in Form von Sachleistungen (Domain-, Server- und Rechtsanwaltleistungen etc.).',
                'right' => 0,
            ),
            56 => 
            array (
                'id' => 57,
                'question_id' => 16,
                'text' => 'Ich rufe sofort den Betrieb an und sage dort Bescheid.',
            'explanation' => 'Falsch, ich bin verpflichtet selbstständig nach einem geeigneten Ersatz (möglichst aus dem bestehenden Team) zu  suchen, dies sollte spätestens 24 Stunden vor der Abholung passieren, wenn irgendwie möglich jedoch früher.',
                'right' => 0,
            ),
            57 => 
            array (
                'id' => 58,
                'question_id' => 16,
                'text' => 'Ich mache nichts, wird schon keinem auffallen, außerdem werfen die dort eh kaum etwas weg.',
            'explanation' => 'Falsch, ich bin verpflichtet selbstständig nach einem geeigneten Ersatz (aus dem bestehenden Team bzw. den SpringerInnen - nur in Notfällen andere Foodsaver) zu suchen. Dies sollte spätestens 24 Stunden vor der Abholung passieren.
',
                'right' => 0,
            ),
            58 => 
            array (
                'id' => 59,
                'question_id' => 16,
                'text' => 'Ich trage mich sofort aus der Abholung aus, da die Suche nach einem Ersatz spätestens 24 Stunden vor dem Abholtermin beginnen muss, wobei ein Telefonat die schnellste Möglichkeit ist einen Ersatz zu finden.',
                'explanation' => 'Richtig, außerdem bin ich verpflichtet, selbstständig nach einem Ersatz zu suchen, wobei es immer sinnvoll ist erst einmal im bereits bestehenden Team bzw. den SpringerInnen zu suchen nur in Notfällen andere Foodsaver.',
                'right' => 1,
            ),
            59 => 
            array (
                'id' => 60,
                'question_id' => 16,
            'text' => 'Ich bin verpflichtet, selbstständig nach einem geeigneten Ersatz (ein Foodsaver bzw. SpringerIn aus dem Abholteam des Betriebes) zu suchen.',
                'explanation' => 'Richtig, dies muss bis spätestens 24 Stunden vor dem Abholtermin geschehen, danach musst Du per Telefon versuchen nach einem Foodsaver aus dem Abholteam des Betriebes suchen die Dich für die Abholung ersetzen können.',
                'right' => 1,
            ),
            60 => 
            array (
                'id' => 61,
                'question_id' => 17,
                'text' => 'Der foodsharing Verein übernimmt in solchen Fällen die komplette Verantwortung.',
                'explanation' => 'Falsch, der foodsharing Verein übernimmt keinerlei Verantwortung für Aktivitäten der Foodsaver. Die Rechtsvereinbarung, die alle Foodsaver mit der Anmeldung akzeptiert haben, beinhaltet, dass wir die Betriebe von jeglicher Verantwortung für die abgegeben Waren befreien, insbesondere aller Waren, bei denen das MHD überschritten bzw. das Verfallsdatum abgelaufenen ist. Unser Ziel ist es, möglichst viele Lebensmittel vor der Vernichtung zu bewahren und deswegen ist es nicht in unserem Interesse Lebensmittelbetriebe, die ihre unverkäufliche Waren weitergeben, in irgendeiner Weise zu schädigen, denn das wäre kontraproduktiv für foodsharing sowie alle Organisationen, Initiativen und Vereine, die sich gegen die Verschwendung einsetzen.
Selbst der Versuch, die Lebensmittelspenderbetriebe oder foodsharing in die Verantwortung für negative gesundheitlichen Folgen zu nehmen, die möglicherweise auf gespendete Lebensmittel zurückzuführen sind, bremst die Bereitschaft von Betrieben, weiterhin Lebensmittel zu spenden bzw. auch das Engagement vom foodsharing Verein. 	
Alle Foodsaver übernehmen selbst die Verantwortung für die gespendeten Lebensmittel und entsorgen im Zweifel lieber gerettete Lebensmitteln, anstatt das Risiko von einer Lebensmittelvergiftung einzugehen. Somit verpflichtet sich jeder Foodsaver, jegliche rechtliche Schritte gegen Lebensmittelspenderbetriebe und andere Foodsaver zu unterlassen.',
                'right' => 0,
            ),
            61 => 
            array (
                'id' => 62,
                'question_id' => 17,
                'text' => 'Der foodsharing Verein hat extra eine Versicherung für solche Fälle und kann den Schadensersatz des geschädigten Nachbarn begleichen.',
                'explanation' => 'Falsch, der foodsharing Verein hat keine Versicherung und übernimmt keinerlei Verantwortung für Aktivitäten der Foodsaver. Die Rechtsvereinbarung, die alle Foodsaver mit der Anmeldung akzeptiert haben, beinhaltet, dass wir die Betriebe von jeglicher Verantwortung für die abgegeben Waren befreien, insbesondere aller Waren, bei denen das MHD überschritten bzw. das Verfallsdatum abgelaufenen ist. Unser Ziel ist es, möglichst viele Lebensmittel vor der Vernichtung zu bewahren und deswegen ist es nicht in unserem Interesse Lebensmittelbetriebe, die ihre unverkäufliche Waren weitergeben, in irgendeiner Weise zu schädigen, denn das wäre kontraproduktiv für foodsharing sowie alle Organisationen, Initiativen und Vereine, die sich gegen die Verschwendung einsetzen.
Selbst der Versuch, die Lebensmittelspenderbetriebe oder foodsharing in die Verantwortung für negative gesundheitlichen Folgen zu nehmen, die möglicherweise auf gespendete Lebensmittel zurückzuführen sind, bremst die Bereitschaft von Betrieben, weiterhin Lebensmittel zu spenden bzw. auch das Engagement vom foodsharing Verein. 	
Alle Foodsaver übernehmen selbst die Verantwortung für die gespendeten Lebensmittel und entsorgen im Zweifel lieber gerettete Lebensmitteln, anstatt das Risiko von einer Lebensmittelvergiftung einzugehen. Somit verpflichtet sich jeder Foodsaver, jegliche rechtliche Schritte gegen Lebensmittelspenderbetriebe und andere Foodsaver zu unterlassen.',
                'right' => 0,
            ),
            62 => 
            array (
                'id' => 63,
                'question_id' => 17,
                'text' => 'Die Supermarktkette ist für alle Lebensmittel, die sie an die Foodsaver bzw. auch andere Organisationen abgibt, verantwortlich und hat eine entsprechende Versicherung, die in solchen Fällen einspringt.',
                'explanation' => 'Falsch, die Betriebe haben keine solche Versicherung. Die Rechtsvereinbarung, die alle Foodsaver mit der Anmeldung akzeptiert haben, beinhaltet, dass wir die Betriebe von jeglicher Verantwortung für die abgegeben Waren befreien, insbesondere aller Waren bei denen das MHD überschritten bzw. das Verfallsdatum abgelaufenen ist. Unser Ziel ist es, möglichst viele Lebensmittel vor der Vernichtung zu bewahren. Deswegen ist es nicht in unserem Interesse, Lebensmittelbetriebe, die ihre unverkäufliche Waren weitergeben, in irgendeiner Weise zu schädigen. Das wäre kontraproduktiv für foodsharing sowie alle Organisationen, Initiativen und Vereinen, die sich gegen die Verschwendung einsetzen.
Selbst der Versuch, die Lebensmittelspenderbetriebe in die Verantwortung für negative gesundheitlichen Folgen, die möglicherweise auf gespendete Lebensmittel zurückzuführen sind, zu ziehen, bremst die Bereitschaft von Betrieben weiterhin Lebensmittel zu spenden.
Alle Foodsaver übernehmen selbst die Verantwortung für die gespendeten Lebensmittel und entsorgen im Zweifel lieber gerettete Lebensmitteln, anstatt das Risiko von einer Lebensmittelvergiftung einzugehen, somit verpflichtet sich jeder Foodsaver, jegliche rechtliche Schritte gegen Lebensmittelspenderbetriebe und andere Foodsaver zu unterlassen.',
                'right' => 0,
            ),
            63 => 
            array (
                'id' => 64,
                'question_id' => 17,
            'text' => 'Als Foodsaver tragen wir selber die Verantwortung für Lebensmittel, die wir weiter verschenken. Lebensmittel mit einem überschrittenen Verbrauchsdatum dürfen nicht weitergegeben werden, sondern nur Lebensmittel mit einem Mindesthaltbarkeitsdatum (MHD).',
                'explanation' => 'Richtig, der foodsharing Verein sowie auch die Betriebe übernehmen keinerlei Verantwortung für gespendeten Lebensmittel. Die Rechtsvereinbarung, die alle Foodsaver mit der Anmeldung akzeptiert haben, beinhaltet, dass wir die Betriebe von jeglicher Verantwortung für die abgegebenen Waren befreien, auch aller Waren bei denen das MHD überschritten bzw. das Verbrauchsdatum abgelaufenen ist. 
Wenn Lebensmittel gerettet werden, welche das Verbrauchsdatum überschritten haben, dürfen sie NUR selber konsumiert, nicht aber weitergegeben werden!
Alle Foodsaver übernehmen selbst die Verantwortung für die gespendeten Lebensmittel und entsorgen im Zweifel lieber gerettete Lebensmitteln, anstatt das Risiko von einer Lebensmittelvergiftung einzugehen.',
                'right' => 1,
            ),
            64 => 
            array (
                'id' => 65,
                'question_id' => 19,
                'text' => 'Der Dokumentarfilmer Valentin Thurn.',
                'explanation' => 'Richtig, Valentin Thurn. Ein Film von ihm - der die Lebensmittelverschwendung betrachtet heißt “Taste the Waste”.',
                'right' => 1,
            ),
            65 => 
            array (
                'id' => 66,
                'question_id' => 19,
                'text' => 'Die Bundesregierung
',
            'explanation' => 'Falsch, der Dokumentarfilmer Valentin Thurn (u.a. Taste the Waste) ',
                'right' => 0,
            ),
            66 => 
            array (
                'id' => 67,
                'question_id' => 19,
                'text' => 'Raphael Fellmer',
            'explanation' => 'Nicht ganz richtig, Raphael Fellmer hat zwar von Anfang an bei dem Verein mitgewirkt und die Lebensmittelretten Bewegung der Foodsaver initiiert, ist jedoch kein Grüdungsmitglied des foodsharing Vereins. Der offizielle Gründer des Vereins ist der Dokumentarfilmer Valentin Thurn (u.a. Taste the Waste)
',
                'right' => 2,
            ),
            67 => 
            array (
                'id' => 68,
                'question_id' => 19,
                'text' => 'Ilse Aigner persönlich
',
            'explanation' => 'Falsch, der Dokumentarfilmer Valentin Thurn (u.a. Taste the Waste)
',
                'right' => 0,
            ),
            68 => 
            array (
                'id' => 69,
                'question_id' => 20,
                'text' => 'Am 11.11.11',
                'explanation' => 'Falsch, die Homepage ging am 12.12.12 online.
',
                'right' => 0,
            ),
            69 => 
            array (
                'id' => 70,
                'question_id' => 20,
                'text' => 'Am 13.13.13
',
                'explanation' => 'Falsch, die Homepage ging am 12.12.12 online.
',
                'right' => 0,
            ),
            70 => 
            array (
                'id' => 71,
                'question_id' => 20,
                'text' => 'Am 12.12.12
',
                'explanation' => 'Richtig',
                'right' => 1,
            ),
            71 => 
            array (
                'id' => 72,
                'question_id' => 20,
                'text' => 'Am 14.14.14
',
                'explanation' => 'Falsch, die Homepage ging am 12.12.12 online.
',
                'right' => 0,
            ),
            72 => 
            array (
                'id' => 73,
                'question_id' => 21,
                'text' => 'Bei den Dreharbeiten zu “Plastic Planet”.
',
                'explanation' => 'Falsch, entstand bei den Dreharbeiten zu “Taste the Waste”, Dokumentarfilm zum Thema Lebensmittelverschwendung von Valentin Thurn.
',
                'right' => 0,
            ),
            73 => 
            array (
                'id' => 74,
                'question_id' => 21,
                'text' => 'Es hatte gar nicht mit Dreharbeiten zu tun, sondern war ein Zufallsprodukt einer langen Nacht.
',
                'explanation' => 'Falsch, entstand bei den Dreharbeiten zu “Taste the Waste”, Dokumentarfilm zum Thema Lebensmittelverschwendung von Valentin Thurn.
',
                'right' => 0,
            ),
            74 => 
            array (
                'id' => 75,
                'question_id' => 21,
                'text' => 'Dreharbeiten zu einem Film, der die Vorteile und das Gute von Monsanto ans Licht bringt.
',
                'explanation' => 'Falsch, entstand bei den Dreharbeiten zu “Taste the Waste”, Dokumentarfilm zum Thema Lebensmittelverschwendung von Valentin Thurn.',
                'right' => 0,
            ),
            75 => 
            array (
                'id' => 76,
                'question_id' => 21,
                'text' => 'Bei den Dreharbeiten zu “Taste the Waste”
',
                'explanation' => 'Richtig, "Taste the Waste" ist ein Dokumentarfilm zum Thema Lebensmittelverschwendung von Valentin Thurn.
',
                'right' => 1,
            ),
            76 => 
            array (
                'id' => 77,
                'question_id' => 22,
                'text' => 'Spendeneinnahmen wurden auf der Straße gesammelt.
',
                'explanation' => 'Falsch, das Startkapital für den Verein stammte vor allem von der Crowdfunding Kampagne, außerdem spendeten das Bundesland NRW sowie verschiedene Supermarktketten und auch Privatpersonen.',
                'right' => 0,
            ),
            77 => 
            array (
                'id' => 78,
                'question_id' => 22,
                'text' => 'Lottogewinn',
                'explanation' => 'Falsch, das Startkapital für den Verein stammt vor allem von der Crowdfunding Kampagne, außerdem spendeten das Bundesland NRW sowie verschiedene Supermarktketten und auch Privatpersonen.',
                'right' => 0,
            ),
            78 => 
            array (
                'id' => 79,
                'question_id' => 22,
                'text' => 'Crowdfunding Kampagne',
            'explanation' => 'Richtig, das Startkapital für den Verein stammtr vor allem von der Crowdfunding Kampagne (über startnext.de), außerdem spendeten das Bundesland NRW sowie verschiedene Supermarktketten und Privatspenden. ',
                'right' => 1,
            ),
            79 => 
            array (
                'id' => 80,
                'question_id' => 22,
                'text' => 'Aus Spenden von Privatpersonen, dem Bundesland NRW sowie verschiedenen Supermarktketten.',
                'explanation' => 'Richtig, das Startkapital für den Verein stammte vor allem von der Crowdfunding Kampagne, außerdem spendeten das Bundesland NRW sowie verschiedene Supermarktketten und auch Privatpersonen.',
                'right' => 1,
            ),
            80 => 
            array (
                'id' => 85,
                'question_id' => 24,
                'text' => 'Bio Company und Alnatura sind Hauptsponsoren und zahlen neben der Programmierarbeit auch Server und Domainkosten.',
            'explanation' => 'Falsch, der foodsharing Verein wurde zwar ursprünglich auch aus Crowdfunding Mitteln finanziert. Die knapp 12.000€ die im Jahr 2012 aus der Crowdfunding Kampagne eingenommen wurden sind, wurden jedoch bereits ausgegeben. Aktuell bezieht der foodsharing e.V. jedoch seine Finanzierung aus politischen Kampagnen wie "Genießt uns!" und über private Spenden. Der Größte Teil aller Ausgaben von foodsharing konnte jedoch in den letzten Jahren komplett von Partnerbetrieben übernommen werden wie: Werbematerial (Flyer, Poster, Sticker etc.), Domain, Server, Räumlichkeiten, Rechtsanwaltleistungen. Das besondere ist, dass sowohl durch ehrenamtlichen Einsatz die Programmierung, Webdesign, Gestaltung und Organisation der Plattform durch das Orgateam unentgeldlich geleistet wird bzw. die Ganze Koordination durch dei hunderten foodsharing BotschafterInnen.',
                'right' => 0,
            ),
            81 => 
            array (
                'id' => 86,
                'question_id' => 24,
                'text' => 'Über eine gut angelegte Crowdfunding Kampagne.
',
            'explanation' => 'Falsch, der foodsharing Verein wurde zwar ursprünglich auch aus Crowdfunding Mitteln finanziert. Die knapp 12.000€ die im Jahr 2012 aus der Crowdfunding Kampagne zusammen kamen, wurden jedoch bereits ausgegeben. Aktuell bezieht der foodsharing e.V. jedoch seine Finanzierung aus politischen Kampagnen wie "Genießt uns!" und über private Spenden. Der Größte Teil aller Ausgaben von foodsharing konnte jedoch in den letzten Jahren komplett von Partnerbetrieben übernommen werden wie: Werbematerial (Flyer, Poster, Sticker etc.), Domain, Server, Räumlichkeiten, Rechtsanwaltleistungen aber vor allem durch ehrenamtlichen Einsatz bei der Programmierung, Webdesign, Gestaltung und Organisation der Plattform usw.',
                'right' => 0,
            ),
            82 => 
            array (
                'id' => 87,
                'question_id' => 24,
                'text' => 'Alle foodsharing BotschafterInnen finanzieren mit einem freiwilligen Beitrag, der monatlich auf ein Ökokonto überwiesen wird, die Community und die Plattform.',
            'explanation' => 'Falsch, der foodsharing Verein wurde zwar ursprünglich auch aus Crowdfunding Mitteln finanziert. Die knapp 12.000€ die im Jahr 2012 aus der Crowdfunding Kampagne eingenommen wurden sind, wurden jedoch bereits ausgegeben. Aktuell bezieht der foodsharing e.V. jedoch seine Finanzierung aus politischen Kampagnen wie "Genießt uns!" und über private Spenden. Der Größte Teil aller Ausgaben von foodsharing konnte jedoch in den letzten Jahren komplett von Partnerbetrieben übernommen werden wie: Werbematerial (Flyer, Poster, Sticker etc.), Domain, Server, Räumlichkeiten, Rechtsanwaltleistungen. Das besondere ist, dass sowohl durch ehrenamtlichen Einsatz die Programmierung, Webdesign, Gestaltung und Organisation der Plattform durch das Orgateam unentgeldlich geleistet wird bzw. die Ganze Koordination durch dei hunderten foodsharing BotschafterInnen.',
                'right' => 0,
            ),
            83 => 
            array (
                'id' => 88,
                'question_id' => 24,
            'text' => 'foodsharing e.V. ist ein Verein und bezahlte bis dato Werbematerial (Flyer, Poster, Sticker etc.) und hilft hier und da mal aus, wenn es um das Bezahlen von Versicherungen oder Heizkosten für große Treffen von Lebensmittelrettenden und Interessierten an foodsharing geht, bis auf die Minijobstelle der Geschäftführung des foodsharing e.V. wird alles ehrenamtlich geleistet bzw. werden Sachspenden angenommen.',
            'explanation' => 'Richtig, der foodsharing Verein wurde zwar ursprünglich auch aus Crowdfunding Mitteln finanziert. Die knapp 12.000€ die im Jahr 2012 aus der Crowdfunding Kampagne eingenommen wurden sind, wurden jedoch bereits ausgegeben. Aktuell bezieht der foodsharing e.V. jedoch seine Finanzierung aus politischen Kampagnen wie "Genießt uns!" und über private Spenden. Der Größte Teil aller Ausgaben von foodsharing konnte jedoch in den letzten Jahren komplett von Partnerbetrieben übernommen werden wie: Werbematerial (Flyer, Poster, Sticker etc.), Domain, Server, Räumlichkeiten, Rechtsanwaltleistungen. Das besondere ist, dass sowohl durch ehrenamtlichen Einsatz die Programmierung, Webdesign, Gestaltung und Organisation der Plattform durch das Orgateam unentgeldlich geleistet wird bzw. die Ganze Koordination durch dei hunderten foodsharing BotschafterInnen.',
                'right' => 1,
            ),
            84 => 
            array (
                'id' => 89,
                'question_id' => 25,
                'text' => 'Wurde ein repräsentatives Bild hochgeladen?
',
                'explanation' => 'Richtig, ein Foto, auf dem das Gesicht klar erkenntlich ist, ist wichtig, damit die Person auf dem Ausweis auch identifiziert werden kann.',
                'right' => 1,
            ),
            85 => 
            array (
                'id' => 90,
                'question_id' => 25,
                'text' => 'Ob der Foodsaver krankenversichert ist.',
                'explanation' => 'Falsch, wir fragen nicht nach persönlichen Informationen der Foodsaver, es ist somit allen Menschen von foodsharing selbst überlassen wie und ob sie versichert sind.',
                'right' => 0,
            ),
            86 => 
            array (
                'id' => 91,
                'question_id' => 25,
                'text' => 'Passen die Angaben zu Geburtsdatum, Straße etc.?
',
                'explanation' => 'Richtig, so können Scherzanmeldungen und Spams erkannt werden.
',
                'right' => 1,
            ),
            87 => 
            array (
                'id' => 92,
                'question_id' => 25,
                'text' => 'Du rufst den Foodsaver an, um zu überprüfen, ob die Telefonnummer stimmt und er vertrauenswürdig ist.
',
                'explanation' => 'Falsch, es ist nicht möglich per Telefon herauszufinden, ob eine Person vertrauenswürdig ist oder nicht, dafür sind die Einführungsabholungen da.',
                'right' => 0,
            ),
            88 => 
            array (
                'id' => 93,
                'question_id' => 26,
                'text' => 'Ich muss nichts machen, denn der Foodsaver kann sich alle Informationen über das Forum und das foodsharing Wiki besorgen.
',
                'explanation' => 'Falsch, die Person erhält von mir eine Begrüßungsmail mit den allgemeinen Verhaltensregeln, der Information, wann das nächste Treffen im Bezirk/der Region stattfindet, außerdem erkläre ich ihr, wie es mit den Einführungsabholungen abläuft.
',
                'right' => 0,
            ),
            89 => 
            array (
                'id' => 94,
                'question_id' => 26,
                'text' => 'Die Person erhält von mir eine Begrüßungsmail mit der Information, wann das nächste Treffen im Bezirk/der Region stattfindet, außerdem erkläre ich ihr, wie es mit den Einführungsabholungen abläuft.
',
                'explanation' => 'Richtig, damit der neue Foodsaver bestens vorbereitet ist und genau weiß, wie die weitere Vorgehensweise ist, schicke ihm eine Begrüßungsmail mit allen relevanten Daten.	
',
                'right' => 1,
            ),
            90 => 
            array (
                'id' => 95,
                'question_id' => 26,
                'text' => 'Ich schicke der Person eine Nachricht mit meiner Nummer und bitte sie, mich persönlich anzurufen, damit ich ihr alles weitere erklären kann.
',
                'explanation' => 'Ist auch möglich, auf jeden Fall sollte die Person immer auch eine Begrüßungsmail mit Informationen, wann das nächste Treffen im Bezirk/der Region stattfindet und wie es mit den Einführungsabholungen abläuft.
',
                'right' => 2,
            ),
            91 => 
            array (
                'id' => 96,
                'question_id' => 26,
                'text' => 'Ich schicke der Person eine Liste mit Betrieben und den jeweiligen Abholzeiten, bei denen aktuell gerade noch dringend Abholende gesucht werden und bitte sie, am besten möglichst schnell dort anzufangen abzuholen.
',
                'explanation' => 'Falsch, das ist natürlich nicht möglich, denn zunächst muss jeder Foodsaver die 3 Einführungsabholungen machen und dann kann er auch erst verifiziert werden und sich selbständig zum Abholen eintragen. 
',
                'right' => 0,
            ),
            92 => 
            array (
                'id' => 97,
                'question_id' => 27,
                'text' => 'Er muss die ausgedruckte Rechtsvereinbarung unterschreiben und bei mir abliefern.
',
                'explanation' => 'Falsch, er muss drei Einführungsabholungen gemacht haben, die Rechtsvereinbarung wurde schon bei der Onlineanmeldung rechtskräftig.
',
                'right' => 0,
            ),
            93 => 
            array (
                'id' => 98,
                'question_id' => 27,
                'text' => 'Er muss bei einem Bezirks/Regionstreffen anwesend gewesen sein.
',
                'explanation' => 'Das ist zwar schön und wünschenswert, aber keine Voraussetzung, ein Muss sind die drei Einführungsabholungen.
',
                'right' => 2,
            ),
            94 => 
            array (
                'id' => 99,
                'question_id' => 27,
                'text' => 'Er muss das Foodsaver Quiz bestehen und drei Einführungsabholungen gemacht haben.
',
                'explanation' => 'Richtig, die Einführungsabholungen müssen bei Dir oder Vertrauenspersonen von Dir gemacht werden und Du ein Feedback dazu erhalten um im Bilde zu sein, ob bei den Einführungsabholungen alles gepasst hat.
',
                'right' => 1,
            ),
            95 => 
            array (
                'id' => 100,
                'question_id' => 27,
                'text' => 'Er muss der Facebook-Gruppe beigetreten sein.
',
                'explanation' => 'Falsch, er muss drei Einführungsabholungen gemacht haben.
',
                'right' => 0,
            ),
            96 => 
            array (
                'id' => 101,
                'question_id' => 28,
                'text' => 'Die Einführungsabholungen muss ich bei niemandem ankündigen. Ich erkundige mich einfach, wo und wann Abholungen in meiner Nähe stattfinden.
',
                'explanation' => 'Falsch, unangekündigt darf sowieso nie irgendwo einfach abgeholt werden, alle Abholungen müssen auf der Plattform eingetragen werden und für alle nachvollziehbar sein. Die 3 Einführungsabholungen müssen mit BotschafterInnen oder deren Vertrauenspersonen durchgeführt werden, sodass der neue Foodsaver auch Fragen stellen kann und gut vorbereitet die Abholungen auch später bei anderen Betrieben durchführen kann.
',
                'right' => 0,
            ),
            97 => 
            array (
                'id' => 102,
                'question_id' => 28,
                'text' => 'Mit einer BotschafterIn oder einer geeigneten Vertrauensperson von dem/der BotschafterIn.
',
                'explanation' => 'Richtig, der neue Foodsaver sollte mit einer BotschafterIn oder einer geeigneten Vertrauensperson die Einführungsabholungen durchführen, damit dieser auch Fragen stellen kann und gut vorbereitet die Abholungen auch später bei anderen Betrieben durchführen kann.
',
                'right' => 1,
            ),
            98 => 
            array (
                'id' => 103,
                'question_id' => 28,
                'text' => 'Mit einem Foodsaver seiner/ihrer Wahl.',
                'explanation' => 'Falsch, die Einführungsabholungen müssen mit BotschafterInnen oder deren Vertrauenspersonen durchgeführt werden, sodass der neue Foodsaver auch Fragen stellen kann und gut vorbereitet die Abholungen auch später bei anderen Betrieben durchführen kann.
',
                'right' => 0,
            ),
            99 => 
            array (
                'id' => 104,
                'question_id' => 28,
                'text' => 'Mit niemandem, die neuen Foodsaver können gleich alleine durchstarten.
',
                'explanation' => 'Falsch, die Einführungsabholungen müssen mit BotschafterInnen oder deren Vertrauenspersonen durchgeführt werden, sodass der neue Foodsaver auch Fragen stellen kann und gut vorbereitet die Abholungen auch später bei anderen Betrieben durchführen kann.
',
                'right' => 0,
            ),
            100 => 
            array (
                'id' => 105,
                'question_id' => 29,
                'text' => 'Ich bringe unsere Argumente ohne Vorwurfscharakter und ohne Anspruchshaltung an.',
                'explanation' => 'Richtig, immerhin wollen wir eine Kooperation mit dem Betrieb erreichen. Wir wollen einen professionellen, sicheren Eindruck schaffen und wenn sich die Geschäftsleitung dabei in die Ecke gedrängt fühlt, ist das hierfür kontraproduktiv. Ein Vortragen der Argumente mit dem Ziel zu informieren und nicht mit dem Ziel der überredenden Manipulation, wird am ehesten eine Einwilligung erzeugen.
',
                'right' => 1,
            ),
            101 => 
            array (
                'id' => 106,
                'question_id' => 29,
                'text' => 'Ich werde deutlich und drohe der Geschäftsleitung mich mit Bildern von meinen nächtlichen Containertouren an die Presse zu wenden. Desweiteren erwähne ich, dass wir eine große Community erreichen und es für ihn/sie doch sicherlich nicht von Vorteil wäre, wenn sich seine/ihre fehlende Kooperationsbereitschaft dort verbreiten würde.

',
                'explanation' => 'Falsch, bitte bring unsere Argumente stets ohne Vorwurfscharakter und ohne Anspruchshaltung an. Durch Druck / Androhungen wird eher weitere Abwehr erzeugt. Immerhin wollen wir eine Kooperation mit dem Betrieb erreichen. Wir wollen einen professionellen, sicheren Eindruck schaffen und wenn sich die Geschäftsleitung dabei in die Ecke gedrängt fühlt, ist das hierfür kontraproduktiv. Ein Vortragen der Argumente mit dem Ziel zu informieren und nicht mit dem Ziel der überredenden Manipulation, wird am ehesten eine Einwilligung erzeugen.',
                'right' => 0,
            ),
            102 => 
            array (
                'id' => 107,
                'question_id' => 29,
            'text' => 'Ich berichte der Geschäftsleitung von bereits bestehenden Kooperationen (eventuell mit einem Beispiel aus der Presse).',
            'explanation' => 'Richtig, bring dazu bitte immer neben der Rechtsvereinbarung und Deinem Ausweis auch einen Ausdruck von dem LMR-Pressetext und von einer Erfolgsstory (zum Beispiel BioCompany) mit. Positivbeispiele können Vertrauen und Mut erzeugen.
',
                'right' => 1,
            ),
            103 => 
            array (
                'id' => 108,
                'question_id' => 29,
                'text' => 'Ich ignoriere es, suche mir bei der nächsten Gelegenheit eine/n der Mitarbeitenden und überzeuge diese/n, damit sie/er auch die Geschäftsleitung überzeugt.
',
                'explanation' => 'Falsch, die Absprache muss immer mit der Geschäftslleitung erfolgen, da nur diese solche Entscheidungen treffen kann. Außerdem ist die Übersprache hintenrum psychologisch ungünstig. 
',
                'right' => 0,
            ),
            104 => 
            array (
                'id' => 109,
                'question_id' => 30,
                'text' => 'Ich schicke sofort eine Mail an das bundesweite Orgateam, da diese für solche Probleme zuständig sind.
',
                'explanation' => 'Falsch, bitte versuche entweder das Problem selbstständig zu lösen oder wende dich an die zuständigen BotschafterInnen, bei größeren Schwierigkeiten steht Dir auch das Orgateam zur Verfügung.
',
                'right' => 0,
            ),
            105 => 
            array (
                'id' => 110,
                'question_id' => 30,
                'text' => 'Ich ignoriere es und sitze es aus.',
                'explanation' => 'Falsch, bitte versuche entweder das Problem selbstständig zu lösen oder wende dich an die zuständigen BotschafterInnen, bei größeren Schwierigkeiten steht Dir auch das Orgateam zur Verfügung.
',
                'right' => 0,
            ),
            106 => 
            array (
                'id' => 111,
                'question_id' => 30,
                'text' => 'Ich tausche das komplette Team aus.',
                'explanation' => 'Falsch, bitte versuche entweder das Problem selbstständig zu lösen oder wende dich an die zuständigen BotschafterInnen, bei größeren Schwierigkeiten steht Dir auch das Orgateam zur Verfügung.
',
                'right' => 0,
            ),
            107 => 
            array (
                'id' => 112,
                'question_id' => 30,
                'text' => 'Ich versuche selber die Kooperation zu stärken und Probleme aus dem Weg zu schaffen. Sollte mir dies nicht möglich sein, wende ich mich an die für mich zuständigen BotschafterInnen und bitte um Hilfe.
',
                'explanation' => 'Richtig, am sinnvollsten ist es immer, wenn man versucht das Problem direkt zu klären. Sollte dieses nicht funktionieren dann an die nächste Ebene wenden. Bei größeren Schwierigkeiten steht Dir auch das Orgateam zur Verfügung.

',
                'right' => 1,
            ),
            108 => 
            array (
                'id' => 113,
                'question_id' => 31,
                'text' => 'Ich gebe die Kooperationen nur in gute, zuverlässige und vertrauensvolle Hände ab.',
                'explanation' => 'Richtig, um bestehende Kooperationen nicht zu gefährden, achte bitte genau darauf, an welchen betriebsverantwortlichen Foodsaver Du diese Aufgabe weitergibst. 
',
                'right' => 1,
            ),
            109 => 
            array (
                'id' => 114,
                'question_id' => 31,
                'text' => 'Ich gebe nur die Kooperationen ab, welche bereits ohne Probleme laufen.
',
                'explanation' => 'Richtig, bitte immer nur Kooperationen abgeben, welche bereits ohne Probleme laufen und keine, bei denen es noch zu Engpässen oder anderen kleinen Problemen kommt.',
                'right' => 1,
            ),
            110 => 
            array (
                'id' => 115,
                'question_id' => 31,
                'text' => 'Ich gebe die Kooperationen ab, welche mich nerven und meinen Eigenbedarf nicht decken.',
                'explanation' => 'Falsch, es werden nur Kooperationen abgegeben, welche bereits ohne Probleme laufen. Um bestehende Kooperationen nicht zu gefährden, achte bitte genau darauf, an wen Du die Aufgabe als betriebsverantwortlicher Foodsaver weitergibst.
',
                'right' => 0,
            ),
            111 => 
            array (
                'id' => 116,
                'question_id' => 31,
                'text' => 'Ich gebe die Kooperation ab, bei der es im Team gerade kriselt.
',
                'explanation' => 'Falsch, es werden nur Kooperationen abgegeben, welche bereits ohne Probleme laufen. Um bestehende Kooperationen nicht zu gefährden, achte bitte genau darauf, an welchen betriebsverantwortlichen Foodsaver Du diese Aufgabe weitergibst. ',
                'right' => 0,
            ),
            112 => 
            array (
                'id' => 117,
                'question_id' => 32,
            'text' => 'Image Aufwertung (falls erwünscht wird der Betrieb auf der Homepage erwähnt, Presse, Sticker).
',
            'explanation' => 'Richtig, neben der Einsparung von Müllkosten (da wir den zu rettenden Teil mitnehmen) und der Einsparung von Arbeitszeit ist auch dies ein Vorteil für den Betrieb. Durch die Sticker “Bei uns kommen keine Lebensmittel in die Tonne”, durch die Erwähnung des Betriebes auf der Hompage und durch mögliche Presseartikel kann der Betrieb einen Imagegewinn erfahren.
',
                'right' => 1,
            ),
            113 => 
            array (
                'id' => 118,
                'question_id' => 32,
                'text' => 'Einsparung von Müllkosten',
                'explanation' => 'Richtig, dadurch, dass wir einen Großteil der Lebensmittel mitnehmen, die zuvor in den Müll gingen, sparen die Betriebe beträchtlich an Müllkosten.
',
                'right' => 1,
            ),
            114 => 
            array (
                'id' => 119,
                'question_id' => 32,
                'text' => 'Einsparung von Arbeitsaufwand.
',
            'explanation' => 'Richtig, die Foodsaver übernehmen die Mülltrennung und Müllentsorgung (da wir den zu rettenden Teil mitnehmen) , wodurch Arbeitsaufwand von Mitarbeitenden eingespart wird.
',
                'right' => 1,
            ),
            115 => 
            array (
                'id' => 120,
                'question_id' => 32,
                'text' => 'Möglichkeit des kurzfristigen Abholens auf Abruf, da wir dezentral organisiert sind.
',
                'explanation' => 'Richtig, diese Flexibilität ist ein großer Vorteil, wodurch wir auch prima als Ergänzung zu anderen Organisationen fungieren können. 
',
                'right' => 1,
            ),
            116 => 
            array (
                'id' => 121,
                'question_id' => 33,
                'text' => 'Ich löse das alte Team auf und bilde ein neues Team.
',
                'explanation' => 'Falsch, bitte wende Dich an den/die zuständigeN BotschafterIn oder an Orgateam@lebensmittelretten.de
',
                'right' => 0,
            ),
            117 => 
            array (
                'id' => 122,
                'question_id' => 33,
                'text' => 'Ich wende mich an den/die zuständigeN BotschafterIn und bitte um Hilfe.
',
                'explanation' => 'Richtig, solltet ihr die Krise gemeinsam nicht bewältigt bekommen, dann wende Dich an mediation@lebensmittelretten.de
',
                'right' => 1,
            ),
            118 => 
            array (
                'id' => 123,
                'question_id' => 33,
                'text' => 'Ich wende mich an orgateam@lebensmittelretten.de und bitte um Hilfe.',
                'explanation' => 'Richtig, dort wirst Du passende Unterstützung finden.
',
                'right' => 1,
            ),
            119 => 
            array (
                'id' => 124,
                'question_id' => 33,
                'text' => 'Ich werfe das Handtuch, sollen die doch gucken, wie sie alleine klarkommen.
',
                'explanation' => 'Falsch, bitte wende Dich an den/die zuständigeN BotschafterIn oder an orgateam@lebensmittelretten.de',
                'right' => 0,
            ),
            120 => 
            array (
                'id' => 125,
                'question_id' => 34,
                'text' => 'Ich mache ein wenig Druck auf die Geschäftsleitung. Ich erkläre, dass es zu einer Beendigung der Kooperation kommt, wenn  nicht alles, was abgeschrieben wird, an uns auch abgegeben wird. Schließlich geht es uns um einen vollständigen Stopp der Verschwendung.',
                'explanation' => 'Falsch, wir treten nicht mit einer Anspruchshaltung auf, sondern freuen uns über alles was wir retten dürfen.
',
                'right' => 0,
            ),
            121 => 
            array (
                'id' => 126,
                'question_id' => 34,
                'text' => 'Ich mache gar nichts, weil es nicht mein Aufgabenbereich ist, in so einer Situation etwas zu unternehmen.
',
                'explanation' => 'Falsch, die direkte Kommunikation mit dem Betrieb ist Aufgabenbereich des/der BetriebsverantwortlicheN. Eine höfliche Nachfrage bei der Geschäftsleitung würde vielleicht etwas bewirken. Du erwähnst, dass wir von lebensmittelretten.de alles nehmen was abgeschrieben wurde, also auch abgelaufene MHD Produkte, verunreinigte Proben/Tester, beschädigte Packungen sowie gekühlte und gefrorene Lebensmittel.
',
                'right' => 0,
            ),
            122 => 
            array (
                'id' => 127,
                'question_id' => 34,
                'text' => 'Ich spreche die Geschäftsleitung höflich an und biete an, dass wir alles nehmen, was abgeschrieben wurde, also auch abgelaufene MHD Produkte, verunreinigte Proben/Tester, beschädigte Packungen sowie gekühlte und gefrorene Lebensmittel.
',
                'explanation' => 'Richtig, teilweise dauert es ein wenig, bis sich die Geschäftsleitungen auch “trauen” uns die abgelaufenen MHD Waren usw. zu geben. Ein erneuter Hinweis auf die Rechtsvereinbarung mit dem Haftungsausschluss kann hilfreich sein.',
                'right' => 1,
            ),
            123 => 
            array (
                'id' => 128,
                'question_id' => 34,
                'text' => 'Ich kontrolliere die Mülltonnen und wenn ich dort noch genießbare Lebensmittel oder andere Produkte finde, die noch verwertbar sind, mache ich die Geschäftsleitung höflich darauf aufmerksam, dass sie in Zukunft nichts mehr wegschmeißen dürfen, weil wir nur mit Betrieben kooperieren, die alle abgeschriebenen Waren abgeben.',
                'explanation' => 'Falsch, wir treten nicht mit einer Anspruchshaltung auf, sondern freuen uns über alles, was wir retten dürfen. Ein Vertrauensbruch und damit absolut falsch ist es die Tonnen zu durchsuchen. Manchmal braucht es etwas Zeit, bis uns die Läden alle Lebensmittel geben, die in der Tonne landen würden.
',
                'right' => 0,
            ),
            124 => 
            array (
                'id' => 129,
                'question_id' => 35,
                'text' => 'Da es sein kann, dass die täglich abzuholende Menge den persönlichen Bedarf übersteigt, suche ich das Gespräch mit ihm/ihr, um sicherzugehen, dass das Abgeholte verwertet wird und der “Überschuss” nicht weggeworfen wird. Am Besten triffst Du Dich bei ihr/ihm. Dann könntest Du auch gleich die Mülltonne kontrollieren. Es ist wichtig, dass wir so aufeinander achtgeben.
',
                'explanation' => 'Falsch, generell hat Jede/r hier im Sinn, keine Lebensmittel wegzuwerfen. Da ist es wichtig, dass wir uns einander Vertrauen schenken. Möglicherweise verteilt er/sie die Lebensmittel an Freunde und Nachbarn. Ein Gespräch ist trotzdem wichtig, um verständlich zu machen, dass er/sie somit sehr viele Abholplätze belegt. Es ist schön, auch neuen Foodsavern im Team eine Chance zu geben und Termine freizugeben bzw. helfen neue Foodsaver einzuführen.
',
                'right' => 0,
            ),
            125 => 
            array (
                'id' => 130,
                'question_id' => 35,
                'text' => 'Um auch neuen Foodsavern im Team eine Chance zu geben, spreche ich mit ihm/ihr, dass es gut wäre, Termine freizugeben bzw. zu helfen neue Foodsaver einzuführen.
',
                'explanation' => 'Richtig, der direkte Kontakt ist in so einer Situation auf jeden Fall der beste Weg, so kann man gemeinsam nach einer geeigneten Lösung suchen. 
',
                'right' => 1,
            ),
            126 => 
            array (
                'id' => 131,
                'question_id' => 35,
                'text' => 'Mein/e BotschafterIn soll mir sagen, ob es Handlungsbedarf gibt.',
                'explanation' => 'Falsch, hier eine Lösung zu finden ist definitiv Aufgabe des/der BetriebsverantwortlicheN und nicht Aufgabe des/der BotschafterIn.
Ein Gespräch ist trotzdem wichtig, um verständlich zu machen, dass er/sie somit sehr viele Abholplätze belegt. Es ist schön, auch neuen Foodsavern im Team eine Chance zu geben und Termine freizugeben bzw. helfen neue Foodsaver einzuführen.
',
                'right' => 0,
            ),
            127 => 
            array (
                'id' => 132,
                'question_id' => 35,
                'text' => 'Es liegt nicht in meinem Aufgabenbereich zu kontrollieren, was der Foodsaver mit den Lebensmitteln macht. Ich kann sie jedoch darauf hinweisen, dass übrig gebliebene Lebensmittel als Essenskörbe auf foodsharing.de, an Menschen im nahen Umfeld oder an soziale Einrichtungen weitergegeben werden können.
',
                'explanation' => 'Richtig, es liegt nicht in unserem Interesse die Foodsaver zu kontrollieren, sondern wir haben Vertrauen, dass alle am selben Strang gegen die Lebensmittelverschwendung ziehen. Wir sollten unsere Energien lieber in die direkte Lebensmittelrettung stecken, anstatt in kleinliche, gegenseitige Kontrollen.
Ein Gespräch ist trotzdem wichtig, um verständlich zu machen, dass er/sie somit sehr viele Abholplätze belegt. Es ist schön, auch neuen Foodsavern im Team eine Chance zu geben und Termine freizugeben bzw. helfen neue Foodsaver einzuführen.
',
                'right' => 1,
            ),
            128 => 
            array (
                'id' => 133,
                'question_id' => 36,
                'text' => 'Ich nehme telefonisch Kontakt zu den anderen Teammitgliedern bzw. notfalls auch zu den SpringerInnen auf und frage, ob sie abholen können. 
',
                'explanation' => 'Richtig, aber im Normalfall musst Du als BetriebsverantwortlicheR aber überhaupt keine Notrufaktionen machen, weil Du die Kooperation so gut organisiert hast, dass überhaupt nur ein Notruf nötig ist wenn sich jemand sehr kurzfristig austrägt. Wenn Du ein gut aufgestelltes Team hast und sich ein Foodsaver mal kurzfristig austrägt, findet dieser eigentlich auch schnell einen zuverlässigen Ersatz.',
                'right' => 1,
            ),
            129 => 
            array (
                'id' => 134,
                'question_id' => 36,
                'text' => 'Nachdem ich telefonisch Kontakt zu den Foodsavern aus dem Team bzw. der /die SpringerInnen aufgenommen habe und wirklich niemand einspringen kann, sogar ich selbst nicht, sage ich dem Betrieb ein paar Stunden vor dem abgemachten Abholzeit im Vorhinein ab und entschuldige mich. Dies sollte aber eine absolute Ausnahme bleiben!
',
                'explanation' => 'Eine offene und ehrliche Kommunikation mit den Betrieben ist natürlich immer wichtig, aber wir garantieren eine 100%ige Abholquote, daher bist Du dafür verantwortlich, dass auch an diesem Tag eine Abholung stattfindet. Eine Absage sollte daher wirklich nur dann erfolgen, wenn es wirklich gar nicht anders geht und die Absolute Ausnahme bleiben.
',
                'right' => 1,
            ),
            130 => 
            array (
                'id' => 135,
                'question_id' => 36,
                'text' => 'Ich trage mich ein und hole selbst ab.
',
                'explanation' => 'Richtig, trotzdem sollte ein kurzfristiges Einspringen von Dir nur selten der Fall sein, denn die Aufgabe des/der BetriebsverantwortlicheN ist es, ein so gut aufgestelltes Team zusammenzustellen, dass schnell ein zuverlässiger Ersatz gefunden wird',
                'right' => 1,
            ),
            131 => 
            array (
                'id' => 136,
                'question_id' => 36,
                'text' => 'Wir haben ein gutes Verhältnis zu der Geschäftsleitung und die findet es auch nicht schlimm, wenn wir mal nicht abholen gehen, deswegen unternehme ich nichts.',
                'explanation' => 'Leider falsch, denn auch wenn man ein super Verhältnis zu den Mitarbeitenden oder verantwortlichen Personen eines Betriebes hat, wollen wir keine Lebensmittel, die wir abholen dürfen in der Tonne sehen und kümmern uns deswegen immer um eine zuverlässige Abholung.',
                'right' => 0,
            ),
            132 => 
            array (
                'id' => 137,
                'question_id' => 37,
                'text' => 'Ich nehme vorsichtshalber beide aus dem Team, um den Streit so früh wie möglich zu beenden, bevor es sich zwischen zwei registrierten Foodsaver hochschaukelt.',
                'explanation' => 'Falsch, da Du bei den Situationen nicht anwesend warst, kannst Du auch nicht über diese Situation urteilen. Oft entstehen Konflikte aus Missverständnissen. Daher gilt es zum Wohle der Harmonie unter allen Foodsavern diese Missverstänisse aufzudecken und friedlich zu klären.',
                'right' => 0,
            ),
            133 => 
            array (
                'id' => 138,
                'question_id' => 37,
                'text' => 'Ich fühle mich in die Situation der beiden Foodsaver hinein und rufe den Foodsaver an, der den besser nachzuvollziehenden Bericht geschrieben hat.
',
                'explanation' => 'Falsch. Am besten ist es, dass Du das persönliche Gespräch mit beiden Foodsavern suchst, um so den Konflikt zwischen den Foodsavern zu klären.
',
                'right' => 0,
            ),
            134 => 
            array (
                'id' => 139,
                'question_id' => 37,
                'text' => 'Ich suche dass Gespräch mit beiden Foodsavern und versuche das Missverständnis aufzuklären, eine mögliche Annäherung der beiden Positionen und eine Einigung/Versöhnung zu erreichen.
',
                'explanation' => 'Richtig, so kann eine Lösung zur Zufriedenheit aller gefunden werden. Ist dieses nicht möglich, wende Dich die BotschafterInnen oder ans Orgateam.
',
                'right' => 1,
            ),
            135 => 
            array (
                'id' => 140,
                'question_id' => 37,
                'text' => 'Wenn ich mich nicht im Stande sehe, den Streit selbst zu lösen, wende ich mich an meine BotschafterInnen oder das orgateam von foodsharing und bitte um Unterstützung.',
                'explanation' => 'Richtig, wenn Du Dich bei dieser Sache überfordert fühlst, oder dein Schlichtungsversuch scheitert, kannst Du die BotschafterInnen oder das Orgateam gern um Unterstützung bitten.
',
                'right' => 1,
            ),
            136 => 
            array (
                'id' => 141,
                'question_id' => 38,
                'text' => 'Du bist ab jetzt dafür verantwortlich, dass die Abholungen reibungslos funktionieren und falls es zu kurzfristigen Ausfällen kommt, solltest Du zeitnah reagieren können, um für Ersatz zu sorgen.
',
                'explanation' => 'Richtig, da Du verantwortlich bist, solltest Du auch bei kurzfristigen Ausfällen für Ersatz sorgen. Daher solltest Du auch gut erreichbar sein, wenn es zu Problemen kommt.
',
                'right' => 1,
            ),
            137 => 
            array (
                'id' => 142,
                'question_id' => 38,
                'text' => 'Sorge dafür, dass es eine 100%ige Transparenz gibt: Alles, was es an Problemen oder Besonderheiten beim Abholen gibt, kommunizierst Du über die Pinnwand der Teamseite, so dass alle anderen Abholenden auch einen Überblick haben, was passiert. Wenn Du im Urlaub bist, teile dies frühzeitig dem Team mit und suche einen Ersatz.
',
                'explanation' => 'Richtig, damit alle Teammitglieder gut informiert sind, sollten alle Änderungen, Besonderheiten und Probleme auf der Pinnwand hinterlegt sein, so dass alle auf dem aktuellen Stand sind.
',
                'right' => 1,
            ),
            138 => 
            array (
                'id' => 143,
                'question_id' => 38,
                'text' => 'Wenn Du Leute aus Deinem Team nicht kennst, lerne sie kennen, biete ihnen Hilfe an und unterstütze sie.
',
                'explanation' => 'Richtig, damit Du auch ein gutes Vertrauensverhältnis zu den Foodsavern aus dem Team aufbauen kannst, lerne diese kennen und stehe ihnen bei Fragen hilfsbereit zur Seite.     ',
                'right' => 1,
            ),
            139 => 
            array (
                'id' => 144,
                'question_id' => 38,
                'text' => 'Achte darauf, dass immer alle zuverlässig sind und hake noch mal nach, falls es Probleme gab. Mache allen klar, dass eine 100%ige Abholung das Ziel ist und es sehr unangenehm für das ganze Team ist, wenn ein Abholtermin verschlafen oder nicht pünktlich wahrgenommen wird, da deine Kooperation sonst schnell gefährdet ist. Du trägst dafür Sorge, dass vereinbarte Abholzeiten und Abmachungen unbedingt eingehalten werden. Das heißt, dass auch niemand unangemeldet zur Abholung kommen darf.',
                'explanation' => 'Richtig, kontrolliere regelmäßig, ob alle Abholtermine besetzt sind und biete neuen Foodsavern auch Hilfe an, wenn sie das erste Mal abholen und noch Fragen haben.',
                'right' => 1,
            ),
            140 => 
            array (
                'id' => 145,
                'question_id' => 39,
                'text' => 'Ich rufe den Foodsaver an und erkundige mich noch vor dem Betreten des Ladens, ob er noch kommt - unabhängig davon, ob ich ihn erreiche oder nicht, fange ich schon mal an, ggf. alles zu sortieren und nehme nach Möglichkeit auch alles alleine mit.',
                'explanation' => 'Richtig, wenn,	wie in diesem Fall, die Lebensmittel nach Ladenschluss abgeholt werden, ist es sehr wichtig, einander rechtzeitig zu treffen, damit ein Fernbleiben eines Foodsavers frühzeitig geklärt werden und die Abholung trotz allem stattfinden kann. Es ist immer gut im Vorfeld Klarheit zu schaffen, ob der/die anderen Foodsaver noch kommen. Wenn man im Laden versucht, die anderen zu erreichen, wirkt das unkoordiniert und unprofessionell, deswegen auf jeden Fall außerhalb des Betriebes telefonieren. Solltest Du niemand erreichen, ist es vollkommen legitim, alleine anzufangen. Wichtig ist dabei, das unentschuldigtes Fehlen gemeldet werden muss, damit die Wichtigkeit und Ernsthaftigkeit der Teamarbeit klar wird und bei wiederholtem Verstoß gegen die Verhaltensregeln unzuverlässige Foodsaver nicht mehr alleine abholen dürfen bzw. bei häufigem Missachten der Verhaltensregeln auch eine Sperrung des Foodsavers von der Plattform bedeutet. Ziel ist es, durch ein transparentes System so früh wie möglich auf Problemfälle hinzuweisen, damit es erst gar nicht zu negativen Auswirkungen kommt.',
                'right' => 1,
            ),
            141 => 
            array (
                'id' => 146,
                'question_id' => 39,
                'text' => 'Ich habe genug gewartet, gehe einfach nach Hause und melde das Nichterscheinen des anderen Foodsavers als Verstoß gegen die Verhaltensregeln.',
                'explanation' => 'Falsch, selbstverständlich sind alle Verstöße gegen die Verhaltensregeln zu melden, doch noch schöner ist, es gar nicht dazu kommen zu lassen. Also vorher per Telefon klären, ob der/diejenige noch kommt und vor allem, wie dem Betrieb versprochen, alle abzuholenden Waren abnehmen, auch wenn man einen Moment später dran ist. Wichtig ist, dass unentschuldigtes Fehlen gemeldet werden muss, damit die Wichtigkeit und Ernsthaftigkeit der Teamarbeit klar wird und bei wiederholtem Verstoß gegen die Verhaltensregeln unzuverlässige Foodsaver nicht mehr alleine abholen dürfen bzw. bei häufigem Missachten der Verhaltensregeln auch eine Sperrung des Foodsavers von der Plattform bedeutet. Ziel ist es, durch ein transparentes System so früh wie möglich auf Problemfälle hinzuweisen, damit es erst gar nicht zu negativen Auswirkungen kommt. Was Du auf jeden Fall machen musst, ist wie abgesprochen die Lebensmitel vom Supermarkt abzuholen und was dann noch vorteilhaft für die Teambildung ist, eine liebe Nachricht an den/die nicht aufgetauchte Foodsaver zu schreiben, dass bei Dir zu Hause eine Kiste abholbereit steht.',
                'right' => 0,
            ),
            142 => 
            array (
                'id' => 147,
                'question_id' => 39,
                'text' => 'Nachdem ich den Foodsaver nicht per Handy erreichen kann, den Ablauf im Betriebe jedoch kenne, sortiere ich alles schön und lass eine Kiste für den vielleicht später kommenden Foodsaver stehen. Damit die Angestellten sich nicht wundern, sage ich ihnen Bescheid, dass der andere Foodsaver wahrscheinlich später kommt.',
                'explanation' => 'Falsch, es ist zwar lieb an den anderen Foodsaver zu denken, aber wir wollen den Angestellten unter keinen Umständen mehr Arbeit bereiten bzw. auch keine Ungewissheit verursachen die evtl. bei den Angestellten aufkommen könnte: “Kommt der andere Foodsaver jetzt oder nicht?”, “Was sagt mein Chef zu dieser Kiste?”, “Wie lange soll ich warten bis ich die Kiste samt Inhalt entsorgen muss?” etc. Was Du machen kannst und was auch vorteilhaft für die Teambildung ist, ist eine liebe Nachricht an den/die nicht aufgetauchte Foodsaver zu schreiben, dass bei Dir zu Hause eine Kiste abholbereit steht.',
                'right' => 0,
            ),
            143 => 
            array (
                'id' => 148,
                'question_id' => 39,
                'text' => 'Nachdem ich ihn*sie nicht auf dem telefonischen Weg erreichen konnte, frage ich die Angestellten, ob er*sie vielleicht schon abholen war.',
                'explanation' => 'Falsch, unsere Aufgabe ist es, die Betriebe zu entlasten und ihnen möglichst viel Arbeit abzunehmen und kein Mehraufwand zu sein. Deswegen grundsätzlich die Angestellten sowie den/die Filialverantwortlichen nur ansprechen, wenn etwas Grundlegendes falsch läuft und vorher immer mit dem Betriebsverantwortlichen sprechen. Es sollte den Angstellten also im besten Fall nicht auffallen, dass ein Foodsaver sich verspätet und sogar einen Abholtermin gänzlich verschwitzt hat. Deswegen lieber so tun, als ob Du zur Abholung eben nur alleine kommst. Was Du machen kannst und auch vorteilhaft für die Teambildung ist, ist eine liebe Nachricht an den/die nicht aufgetauchte Foodsaver zu schreiben, dass bei Dir zu Hause eine Kiste abholbereit steht. Den Verstoß des nicht kommens muss der Foodsaver selber als Verstoß melden, aber auch Du als die Person die es mitbekommen hat, muss den Verstoß melden, vorteilhaft ist natürlich von dem Foodsaver zu erfahren, warum dieser nicht gekommen ist und das mit in die Verstoßmeldung schreiben.
In Ausnahmefällen und vor allem bei kleinen Betrieben zu denen ein ausgezeichnetes Verhältnis existiert, kann auch kurz nachgefragt werden, ob schon jemand da war, dies ist bei größeren Betrieben und besonders Ketten nicht möglich, weil dadurch der Eindruck entsteht, wir würden uns nicht gut absprechen, halten uns nicht untereinander an Abmachungen oder sind eben schlicht unpünktlich.',
                'right' => 0,
            ),
            144 => 
            array (
                'id' => 153,
                'question_id' => 41,
                'text' => 'Der Foodsaver muss die ausgedruckte Rechtsvereinbarung unterschreiben und seine/m BotschafterIn übergeben.',
                'explanation' => 'Die Rechtsvereinbarung ist ja bereits mit der Anmeldung unterschrieben und ist mit der Verifizierung gültig. Auf jeden Fall muss er/sie drei Einführungsabholungen gemacht haben.',
                'right' => 2,
            ),
            145 => 
            array (
                'id' => 155,
                'question_id' => 41,
                'text' => 'Der Ausweis darf nur an Foodsaver übergeben werden, die schon bei Bezirks- oder Regionstreffen waren.',
                'explanation' => 'Falsch, er/sie muss drei Einführungsabholungen gemacht haben. Eine Teilnahme an Bezirkstreffen ist nicht generell verpflichtend, jedoch wird es in manchen Bezirken so gehandhabt, dass die Ausweise bei einem Gruppentreffen vergeben werden. Das ist dann aber die Entscheidung der dort zuständigen BotschafterInnen.',
                'right' => 0,
            ),
            146 => 
            array (
                'id' => 157,
                'question_id' => 41,
                'text' => 'Er/Sie muss drei Einführungsabholungen gemacht haben.',
                'explanation' => 'Richtig, solltest Du nicht automatisch ein Feedback dazu erhalten haben, erkundige dich bitte, ob bei den Einführungsabholungen alles gepasst hat.',
                'right' => 1,
            ),
            147 => 
            array (
                'id' => 159,
                'question_id' => 41,
                'text' => 'Er/Sie muss der Facebook-Gruppe beigetreten sein.',
                'explanation' => 'Falsch, er/sie muss drei Einführungsabholungen gemacht haben.',
                'right' => 0,
            ),
            148 => 
            array (
                'id' => 161,
                'question_id' => 43,
                'text' => 'Wir wollen den Betrieb bei unseren Abholungen immer zufriedenstellen und alles sauber hinterlassen.',
                'explanation' => 'Richtig, denn nur so entsteht eine gute Vertrauensbasis und eine stabile Kooperation.',
                'right' => 1,
            ),
            149 => 
            array (
                'id' => 162,
                'question_id' => 43,
                'text' => 'Wir wollen unseren Eigenbedarf decken und unsere Kosten für Lebensmittel auf € 0.- herunterschrauben.',
                'explanation' => 'Falsch, wir wollen Lebensmittel vor der Tonne retten. Wenn dabei der Eigenbedarf reduziert wird, ist das natürlich schön, aber das Hauptziel ist es definitiv nicht.',
                'right' => 0,
            ),
            150 => 
            array (
                'id' => 164,
                'question_id' => 43,
                'text' => '100%ige Abholzuverlässigkeit und Annahme von Lebensmitteln, welche nicht mehr verkauft werden können, aber noch brauchbar sind.  ',
            'explanation' => '100%ige Abholzuverlässigkeit ist durch ein gutes Team zu gewährleisten. Außerdem wollen wir auch erreichen, dass wir alle anderen Waren (Tierfutter, Schnuller, Kosmetika, Molkereiprodukte etc.) retten dürfen und so nichts noch Brauchbares oder Genießbares in der Tonne landet. 

In den meisten Betrieben dürfen wir vor Ort alles noch genießbare von den ungenießbaren Lebensmitteln trennen und direkt beim Betrieb in deren Abfallcontainer entsorgen (natürlich trennen wir dabei Plastik, Papier, Kompost etc.). Es gibt aber auch Betriebe wo wir alles in Kisten oder Kartons mitnehmen müssen und keine Möglichkeit besteht vor Ort zu trennen. Wir richten uns da ganz nach den Betrieben und deren Wünsche, wobei natürlich gefragt werden kann ob es vor Ort möglich ist.',
                'right' => 1,
            ),
            151 => 
            array (
                'id' => 166,
                'question_id' => 43,
                'text' => 'Wir wollen uns auf das Retten der Lebensmittel konzentrieren und ein schönes respektvolles Verhältnis zu den Angestellten pflegen.',
                'explanation' => 'Richtig, wir wollen ein gutes Verhältnis und einen guten Umgang zu allen Angestellten haben. Dabei ist es immer wichtig die Angestellten nicht unnötig aufzuhalten und genau abzuspüren ob sie jetzt gerade Zeit haben für ein kurzes Gespräch oder lieber nicht. Nebenbei: oft haben die Mitarbeitenden selber ein Problem mit der Lebensmittelverschwendung und sind sehr glücklich über unser Tun.',
                'right' => 1,
            ),
            152 => 
            array (
                'id' => 167,
                'question_id' => 45,
                'text' => 'Ich bin hoch motiviert und spreche weitere Läden an, 13 Foodsaver reichen garantiert dafür aus um 3 und mehr Läden abzudecken.',
            'explanation' => 'Falsch, bitte immer einen Betrieb nach dem anderen dazugewinnen. Im ungünstigsten Fall müsstest Du als betriebsverantwortlicher Foodsaver alle Abholungen (im Zweifelsfall jeden Tag) alleine abdecken. Warte, bis Du genügend unterstützende Leute für das Team gefunden hast.',
                'right' => 0,
            ),
            153 => 
            array (
                'id' => 169,
                'question_id' => 45,
                'text' => 'Ich kontaktiere die anderen 13 Foodsaver, um von ihnen zu erfahren, an welchen Tagen sie abholen könnten, um regelmäßige Abholungen gewährleisten zu können.',
            'explanation' => 'Richtig, so erhältst Du ein realistisches Bild der Situation und kannst einschätzen, ob es gerade Sinn macht noch weitere Läden anzusprechen. Sonst könnte es im ungünstigsten Fall dazu führen, dass Du als betriebsverantwortlicher Foodsaver alle Abholungen (im Zweifelsfall jeden Tag) alleine abdecken musst. Warte mit der Akquise von neuen Läden, bis Du genügend unterstützende Leute für das Team gefunden hast.',
                'right' => 1,
            ),
            154 => 
            array (
                'id' => 171,
                'question_id' => 45,
            'text' => 'Ich warte, bis die 3 neuen Läden gut angelaufen sind (festes Team, Abholtage sind abgedeckt etc.) und spreche dann neue Betriebe an.',
            'explanation' => 'Richtig, versuche organisch zu wachsen, indem Du die 3 Betriebe erst einmal ausgelastet bekommst, sodass eine 100% Abholrate gewährleistet ist. Sonst könnte es im ungünstigsten Fall dazu führen, dass Du als betriebsverantwortlicher Foodsaver alle Abholungen (im Zweifelsfall jeden Tag) alleine abdecken musst. Warte mit der Akquise von neuen Läden, bis Du genügend unterstützende Leute für das Team gefunden hast.',
                'right' => 1,
            ),
            155 => 
            array (
                'id' => 172,
                'question_id' => 45,
                'text' => 'Ich versuche noch mehr Leute zu motivieren sich aktiv als Foodsaver gegen die Lebensmittelverschwendung einzusetzen, so können wir nach und nach immer mehr Betriebe anfragen und Kooperationen starten.',
            'explanation' => 'Richtig, je mehr Foodsaver desto mehr Kooperationen können geschlossen und abgedeckt werden. Sonst könnte es im ungünstigsten Fall dazu führen, dass Du als betriebsverantwortlicher Foodsaver alle Abholungen (im Zweifelsfall jeden Tag) alleine abdecken musst. Warte mit der Akquise von neuen Läden, bis Du genügend unterstützende Leute für das Team gefunden hast.',
                'right' => 1,
            ),
            156 => 
            array (
                'id' => 173,
                'question_id' => 46,
                'text' => 'Ich schreibe dem/der BotschafterIn sofort eine Nachricht, um nachzufragen was geplant ist.',
                'explanation' => 'Richtig, der/die BotschafterIn kann Dir am besten Informationen über den aktuellen Stand deines Bezirkes/deiner Region geben. Bekommst Du innerhalb von 7 Tagen keine Antwort, schreibe den/die nächst höhere BotschafterIn an und erläutere die Situation - ggf. kannst Du selbst die BotschafterInnenrolle übernehmen und den/die nicht aktive BotschafterIn ablösen bzw. unter die Arme greifen. Sollte sich auch auf der nächst höheren BotschafterInnenebene niemand melden, kontaktiere das BotschafterInnenbegrüßungsteam.',
                'right' => 2,
            ),
            157 => 
            array (
                'id' => 174,
                'question_id' => 46,
                'text' => 'Ich warte circa eine Woche ab, denn es kann immer mal vorkommen, dass der/die BotschafterIn verhindert ist und vergessen hat, dies durch eine virtuelle "Schlafmütze" im Profilbild erkenntlich zu machen. Wenn sich dann niemand gemeldet hat werde ich selber aktiv und schreibe noch einmal an den/die zuständigeN BotschafterIn.',
                'explanation' => 'Richtig, normalerweise meldet sich der/die Botschafterin bei den neu angemeldeten Foodsavern, sollte dies einmal nicht der Fall sein, dann gerne Eigeninitiative zeigen.',
                'right' => 1,
            ),
            158 => 
            array (
                'id' => 175,
                'question_id' => 46,
                'text' => 'Wenn sich nach mehr als einer Woche und mehrmaligen Kontaktversuchen keinE BotschafterIn zurückmeldet, dann schreibe ich den anderen in meinem Bezirk/Region eingetragenen Foodsavern um herauszufinden warum mir keiner antwortet.',
                'explanation' => 'Richtig, bitte aber zunächst immer an den/die zuständige/n Botschafter/in wenden, da diese/r den besten Überblick hat, es kann immer sein, dass jemand eine Nachricht übersieht, deswegen ruhig 2-3 schreiben und eine Woche Geduld haben. Sollte sich dort keiner melden, schreibe die anderen Foodsaver an, um zu erfahren, ob der/die BotschafterIn noch aktiv ist.
Ggf. kannst Du selbst die BotschafterInnenrolle übernehmen und den/die nicht aktive BotschafterIn ablösen bzw. unter die Arme greifen. Sollte sich auch auf der nächst höheren BotschafterInnenebene niemand melden, kontaktiere das BotschafterInnenbegrüßungsteam.',
                'right' => 2,
            ),
            159 => 
            array (
                'id' => 176,
                'question_id' => 47,
                'text' => 'Ich werfe beide aus dem Team. Konflikte kann die Lebensmittelrettung nicht gebrauchen.',
                'explanation' => 'Falsch, da Du bei den Situationen nicht dabei warst, kannst Du nicht über diese Situation urteilen. Oft entstehen Konflikte aus Missverständnissen, die es für die Harmonie unter allen Foodsavern, zu klären gilt.',
                'right' => 0,
            ),
            160 => 
            array (
                'id' => 177,
                'question_id' => 46,
                'text' => 'Ich schreibe einen Beitrag ins Forum, mit Sicherheit wird mir dort jemand antworten.',
                'explanation' => 'Auch möglich, aber auf jeden Fall auch den/die nächst höhere/n BotschafterIn der Stadt oder Region anschreiben.',
                'right' => 2,
            ),
            161 => 
            array (
                'id' => 178,
                'question_id' => 47,
                'text' => 'Da die mich kritisierenden Nachrichten unbegründet sind, melde ich die beiden Foodsaver über die entsprechende Funktion.',
                'explanation' => 'Falsch. Als erstes suchst Du das persönliche Gespräch und versuchst den Konflikt auf diesem Wege zu klären. Erst wenn eine Klärung nicht möglich ist und Du Dich bei dieser Sache überfordert fühlst, kannst Du die BotschafterInnen und das Orgateam gern um Unterstützung bitten.',
                'right' => 0,
            ),
            162 => 
            array (
                'id' => 179,
                'question_id' => 48,
                'text' => 'Der Foodsaver schlägt Termine vor, bei denen er/sie Zeit hat.',
                'explanation' => 'Falsch, der/die BotschafterIn oder die geeignete Vertrauensperson schlägt Termine vor, welche von dem Foodsaver rechtzeitig bestätigt werden sollen.',
                'right' => 0,
            ),
            163 => 
            array (
                'id' => 180,
                'question_id' => 47,
                'text' => 'Ich suche das Gespräch mit beiden Foodsavern und versuche, das Missverständnis aufzuklären und eine mögliche Annäherung zu erreichen. Weiterhin kann ich darauf hinweisen, dass wir unsere Energie auf das Retten von Lebensmitteln und nicht auf Konflikte verwenden sollten.',
                'explanation' => 'Richtig, so kann eine Lösung zur Zufriedenheit aller gefunden werden. Ist diese noch nicht gefunden, wende dich an Deine BotschafterInnen oder das Orgateam.',
                'right' => 1,
            ),
            164 => 
            array (
                'id' => 181,
                'question_id' => 48,
                'text' => 'Der/die BotschafterIn oder die geeignete Vertrauensperson schlägt Termine vor, welche von dem Foodsaver rechtzeitig bestätigt werden sollen.
',
                'explanation' => 'Richtig, damit der neue Foodsaver schnell in die Strukturen eingeführt werden kann, ist es sinnvoll mögliche Termine für die Einführungsabholungen ihm/ihr zügig mitzuteilen. Die BotschafterIn erhält so auch einen ersten Eindruck von dem neuen Foodsaver, wie schnell dieser die Termine bestätigt.',
                'right' => 1,
            ),
            165 => 
            array (
                'id' => 182,
                'question_id' => 48,
                'text' => 'Der Foodsaver trägt sich selber in Abholungen ein, bei denen die Abholung zu zweit stattfinden.
',
                'explanation' => 'Falsch, der/die BotschafterIn oder die geeignete Vertrauensperson schlägt Termine vor, welche von dem Foodsaver rechtzeitig bestätigt werden sollen. Sich selber eintragen können die Foodsaver erst wenn sie von ihrer/m BotschafterIn verifiziert worden sind.',
                'right' => 0,
            ),
            166 => 
            array (
                'id' => 183,
                'question_id' => 47,
                'text' => 'Ich wende mich ggf. an das Orgateam und bitte um Unterstützung.',
                'explanation' => 'Möglich, wenn Du Dich bei dieser Sache überfordert fühlst, kannst Du das Orgateam gern um Unterstützung bitten.',
                'right' => 1,
            ),
            167 => 
            array (
                'id' => 184,
                'question_id' => 48,
                'text' => 'Der Foodsaver sucht sich einen Betrieb aus und spricht die Einführungsabholungen mit dem betriebsverantwortlichen Foodsaver ab.',
                'explanation' => 'Falsch, der/die BotschafterIn oder die geeignete Vertrauensperson schlägt Termine vor welche von dem Foodsaver rechtzeitig bestätigt werden sollen.',
                'right' => 0,
            ),
            168 => 
            array (
                'id' => 185,
                'question_id' => 50,
                'text' => 'Ich bin froh, dass ich meinen Foodsaver Ausweis dabei habe und zeige ihm der MitarbeiterIn mit den Worten: “Ich bin von foodsharing und könnte sofort alles mitnehmen?”',
                'explanation' => 'Falsch, bitte nie einen Laden im Namen von foodsharing/Lebensmittelretten ansprechen, wenn Du nicht vorher in Erfahrung gebracht hast, wie die aktuelle Abholsituation ist: sprich - wer wann wie was von den Foodsavern abholt. Das wirkt sonst unprofessionell und nicht koordiniert.',
                'right' => 0,
            ),
            169 => 
            array (
                'id' => 186,
                'question_id' => 49,
                'text' => 'Weil der Foodsaver sich dort über die Pinnwand bzw. unter "Besonderheiten" über die wichtigsten Informationen erkundigen kann.',
                'explanation' => 'Richtig, und weil der Foodsaver nach den Einführungsabholungen eventuell auch gleich in diesem Team bleiben und abholen kann.',
                'right' => 1,
            ),
            170 => 
            array (
                'id' => 187,
                'question_id' => 49,
                'text' => 'Weil man so das ganze Team darüber informieren kann, wenn der neue Foodsaver etwas falsch gemacht hat.',
                'explanation' => 'Falsch, der/die BotschafterIn oder die geeignete Vertrauensperson schlägt Termine vor, welche der Foodsaver rechtzeitig bestätigen soll und weil der Foodsaver nach den Einführungsabholungen eventuell auch gleich in diesem Team bleiben und abholen kann.',
                'right' => 0,
            ),
            171 => 
            array (
                'id' => 188,
                'question_id' => 49,
                'text' => 'Weil der Foodsaver dann weiß, was er/sie schon mal nicht für die nächste Woche zu kaufen braucht.',
                'explanation' => 'Falsch, der/die BotschafterIn oder die geeignete Vertrauensperson schlägt Termine vor, welche der Foodsaver rechtzeitig bestätigen soll und weil der Foodsaver nach den Einführungsabholungen eventuell auch gleich in diesem Team bleiben und abholen kann.',
                'right' => 0,
            ),
            172 => 
            array (
                'id' => 189,
                'question_id' => 49,
                'text' => 'Weil der Foodsaver nach den Einführungsabholungen eventuell auch gleich in diesem Team bleibt und nach erfolgreichen Einführungsabholungen dort weiter abholen wird.',
                'explanation' => 'Richtig, und weil der Foodsaver sich dort über die Pinnwand über die wichtigsten Informationen erkundigen kann.',
                'right' => 1,
            ),
            173 => 
            array (
                'id' => 190,
                'question_id' => 50,
                'text' => 'Ich frage die MitarbeiterIn, ohne zu erwähnen dass ich von foodsharing bin: “Entschuldigung, aber können sie mir verraten, was sie mit den abgeschriebenen Lebensmitteln machen?”',
                'explanation' => 'Richtig, so erfährt man mehr über den Laden und nutzt die Gelegenheit mit dem/der Mitarbeitenden bzw. Filialverantwortlichen allgemein über das Thema zu reden. DU kannst ggf. auf erfolgreiche Kooperationspartner von foodsharing hinweisen und später den Betrieb eintragen, oder dem Betriebsverantwortichen schreiben, was Du in Erfahrung gebracht hast. Wichtig ist es, dabei als Privatperson aufzutreten und nicht als Repräsentant des Netzwerks.',
                'right' => 1,
            ),
            174 => 
            array (
                'id' => 191,
                'question_id' => 50,
                'text' => 'Ich beobachte das Geschehen ohne irgendwas zu sagen.',
                'explanation' => 'Generell nicht falsch, aber immer eine schöne Gelegenheit die Mitarbeitenden/Filialleitung auf das Thema hinzuweisen und in Erfahrung zu bringen, wie sie damit umgehen. Diese Informationen ggf. auf die Betriebspinnwand schreiben bzw. dem/der Filialverantwortlichen mitteilen. Wichtig ist es, dabei als Privatperson aufzutreten und nicht als Repräsentant des Netzwerks.  Bitte nie ohne Absprache mit dem/der zuständigen BotschafterIn eineN Mitarbeitende/Filialleitung im Namen von foodsharing/Lebensmittelretten ansprechen. Das wirkt unprofessionell und nicht koordiniert.',
                'right' => 2,
            ),
            175 => 
            array (
                'id' => 192,
                'question_id' => 50,
                'text' => 'Ich bin selbst BetriebsverantworlticheR für einen Betrieb und frage die Filialleitung, ob er schon was von foodsharing gehört hat und ob er mitmachen möchte?',
                'explanation' => 'Falsch, grundsätzlich bitte immer alle Kooperationsanfragen mit den zuständigen BotschafterInnen absprechen. Sonst kann es gegenüber der Filialleitung unprofessionell und unkoordiniert wirken.
Du kannst natürlich ohne foodsharing zu erwähnen, die Gelegenheit nutzen und Mitarbeitende bzw. Filialverantwortliche fragen, was mit den Abschriften passiert und ggf. auf erfolgreiche Kooperationspartner von foodsharing hinweisen und später den Betrieb eintragen, oder der betriebsverantworltichen Person schreiben, was Du in Erfahrung gebracht hast. Wichtig ist es, dabei als Privatperson aufzutreten und nicht als Repräsentant des Netzwerks, höchstens wenn sie z.B. foodsharing erwähnen und froh sind über eine etwaige Zusammenarbeit.',
                'right' => 0,
            ),
            176 => 
            array (
                'id' => 193,
                'question_id' => 51,
                'text' => 'Der Foodsaver wird freundlich begrüßt.',
                'explanation' => 'Richtig, da wir uns über jeden neuen Foodsaver freuen, der Lebensmittel retten möchte, begrüßen wir diesen freundlich.',
                'right' => 1,
            ),
            177 => 
            array (
                'id' => 194,
                'question_id' => 51,
                'text' => 'Dem Foodsaver wird der Ablauf der Abholung erklärt und danach wird gemeinsam abgeholt. Außerdem wird der Foodsaver gefragt ob er oder sie alle Dokumente vom Wiki die für die Foodsaver Rolle verpflichtend sind zu lesen, verstanden hat und ob es dazu oder zu anderen Themen bzgl. foodsharing noch Fragen oder Unklarheiten gibt.',
                'explanation' => 'Richtig, damit die Abholung reibungslos funktioniert, wird dem neuen Foodsaver der Ablaufvorgang genau erklärt, denn bedenke, dass der neue Foodsaver noch nie eine Abholung durchgeführt hat und dementsprechend auch unsicher ist, was dort auf ihn/sie zukommt. Auch andere Unklarheiten bzgl. foodsharing im Allgemeinen werden besprochen und geklärt.',
                'right' => 1,
            ),
            178 => 
            array (
                'id' => 195,
                'question_id' => 51,
                'text' => 'Dem Foodsaver wird der Ablauf erklärt, danach kann er/sie die Abholung alleine machen.',
                'explanation' => 'Falsch, der Foodsaver wird herzlich begrüßt, danach wird ihm/ihr der Ablauf erklärt und dann wird gemeinsam die Abholung durchgeführt. Nebenbei bitte erklären, dass die Besonderheiten der Betriebe immer in der Beschreibung stehen.',
                'right' => 0,
            ),
            179 => 
            array (
                'id' => 196,
                'question_id' => 51,
                'text' => 'Der Foodsaver wird darüber informiert, dass Besonderheiten zu jedem Betrieb immer in der Beschreibung des Betriebs zu lesen sind.',
                'explanation' => 'Richtig, damit der neue Foodsaver auch bei späteren Abholungen genau weiß, worauf er/sie achten muss, wird auf die Besonderheiten hingewiesen, die Teil der Betriebsbeschreibung sind.
',
                'right' => 1,
            ),
            180 => 
            array (
                'id' => 197,
                'question_id' => 53,
                'text' => 'Ich ignoriere die Neuanmeldung.',
                'explanation' => 'Falsch, es ist wichtig, dass wir den Tatendrang der Lebensmittelretter nicht durch einen solchen bürokratischen Grund zum Versiegen bringen, bitte kläre dem Foodsaver mit, dass er alle Daten korrekt eintragen muss und erst dann die Einführungsabholungen begonnen werden können.',
                'right' => 0,
            ),
            181 => 
            array (
                'id' => 198,
                'question_id' => 53,
                'text' => 'Ich lade die Person zu Einführungsabholungen ein und schicke ihr eine Nachricht in der ich sie darum bitte, die Daten zeitnah zu ergänzen.',
                'explanation' => 'Falsch, es ist wichtig, die Person sofort auf nicht vorhandene oder unkorrekte Daten bei der Anmeldung hinzuweisen, weil die Person es vielleicht versehentlich getan hat und wir nicht darauf vertrauen können, dass diese dann auch nachgetragen werden, deswegen lädts Du die Person erst nach der Änderungen der falschen Daten zu den Einführungsabholungen ein.',
                'right' => 0,
            ),
            182 => 
            array (
                'id' => 199,
                'question_id' => 53,
                'text' => 'Ich schicke der Person eine Nachricht in der ich auf die falschen Daten hinweise und sie bitte diese zu ändern bzw. zu ergänzen.',
                'explanation' => 'Richtig, es ist wichtig, die Person sofort auf nicht vorhandene oder unkorrekte Daten bei der Anmeldung hinzuweisen, weil die Person es vielleicht versehentlich getan hat und wir nicht darauf vertrauen können, dass diese dann auch nachgetragen werden.',
                'right' => 1,
            ),
            183 => 
            array (
                'id' => 200,
                'question_id' => 53,
                'text' => 'Wenn ich mir ziemlich sicher bin, dass es sich um eine Fake-Anmeldung handelt, dann lösche ich den Acount umgehend.',
                'explanation' => 'Falsch, es ist wichtig, die Person sofort auf nicht vorhandene oder unkorrekte Daten bei der Anmeldung hinzuweisen, weil die Person es vielleicht versehentlich getan hat und wir nicht darauf vertrauen können, dass diese dann auch nachgetragen werden. Erst wenn Du Dir 100% sicher bist, dass es sich um eine Fake-Anmeldung handelt kannst Du diese Person löschen.',
                'right' => 0,
            ),
            184 => 
            array (
                'id' => 201,
                'question_id' => 54,
                'text' => 'Nichts, denn ich bin ja schon BotschafterIn und teile einfach meine Zugangsdaten mit ihr und erkläre ihr wie alles läuft, damit es auch zu keinen Problemen kommen kann.
',
            'explanation' => 'Falsch, es ist grundlegend nicht gestattet, Deine Zugangsdaten anderen Menschen zur Verfügung zu stellen, da die Daten der Foodsaver geschützt sind. Richtig ist es, den/die angehende BotschafterIn zu erklären, wie er/sie sich über Avatar (Profilbild oben rechts) und dann unter Einstellungen über den Button “Werde Botschafter” als BotschafterIn anmelden kann. Das BotschafterInnenbegrüßungsteam bzw. Du als BotschafterIn für die Stadt, wird die BotschafterInnenanfrage bearbeiten bzw. bestätigen. Sobald dieses geschehen ist, setzt Du Dich mit der/dem neuen BotschafterIn in Verbindung und informierst sie/ihn über die Gegebenheiten der Stadt, damit er/sie einen guten Start hinlegen kann und das erste foodsharing Bezirkstreffen organisieren kann.',
                'right' => 0,
            ),
            185 => 
            array (
                'id' => 202,
                'question_id' => 54,
                'text' => 'Der Foodsaver muss sich durch das BotschafterInnen Quiz für die Aufgabe qualifizieren und mit Dir über die Gegebenheiten der Stadt unterhalten, damit er/sie einen guten Start hinlegen kann.',
            'explanation' => 'Richtig, nachdem der/die angehende BotschafterIn sich über das BotschafterInnen Quiz qualifiziert hat: “Werde Botschafter” (in den Einstellungen), wird das BotschafterInnenbegrüßungsteam bzw. Du als BotschafterIn für die Stadt, die BotschafterInnenanfrage bearbeiten bzw. bestätigen. Sobald dies geschehen ist, setzt Du Dich mit der/dem neuen BotschafterIn in Verbindung und informierst sie/ihn über die Gegebenheiten der Stadt, damit er/sie einen guten Start hinlegen kann und das erste foodsharing Bezirkstreffen organisieren kann.
',
                'right' => 1,
            ),
            186 => 
            array (
                'id' => 203,
                'question_id' => 54,
                'text' => 'Ich sage dem/der BotschafteranwärterIn, dass ich derzeit alles alleine hinbekomme und keine Hilfe brauche.
',
                'explanation' => 'Falsch, vor allem, wenn es sich um etwas größere Städte bzw. Regionen handelt, wird es spätestens ab 20 Foodsavern wichtig, den Arbeitsaufwand mit anderen BotschafterInnen zu teilen, da eine Person alleine es nicht mehr stemmen kann. So kannst Du die Verantwortung für den Bezirk an eine/n kompetente/n und motivierte/n BotschafterIn abgeben und dich verstärkt um die anderen Bezirke kümmern.
',
                'right' => 0,
            ),
            187 => 
            array (
                'id' => 204,
                'question_id' => 54,
                'text' => 'Ich treffe mich mit dem Foodsaver und erkläre erst mal, was es bedeutet, BotschafterIn in Deiner Stadt zu werden und frage dann noch mal, ob er/sie sich das vorstellen kann.',
                'explanation' => 'Richtig, teile dem Foodsaver den ungefähren zeitlichen Aufwand mit und mache ihn/sie vertraut mit dem Dokument “Aufgaben der Botschafter”, erzähle am besten auch von deinen Erfahrungen und evtl. aufgetretenen Problemen.
',
                'right' => 1,
            ),
            188 => 
            array (
                'id' => 205,
                'question_id' => 55,
            'text' => 'Ausweise drucken, laminieren (lassen) und ausgeben.
',
            'explanation' => 'Richtig, neben der Kommunikation zwischen den Foodsavern/ Betriebsverantwortlichen etc. und dem Organisieren von regelmäßigen Treffen, gehört auch dies zu Deinen Aufgaben. Alle BotschafterInnen können auch foodsharing bei Messen, Events, Presse und Vorträgen repräsentieren - müssen es aber nicht und können entsprechende Anfragen an die jeweilige Gruppe (Messen, Events, Presse und Vorträge) weiterleiten.
',
                'right' => 1,
            ),
            189 => 
            array (
                'id' => 206,
                'question_id' => 55,
                'text' => 'foodsharing bei Messen, Events, Presse, Vorträge repräsentieren.
',
                'explanation' => 'Richtig, alle BotschafterInnen können sich auch in diesen Bereichen engagieren - müssen es aber nicht und können entsprechende Anfragen an die jeweilige Gruppe weiterleiten. Zu den Hauptaufgaben gehören die Kommunikation zwischen den Foodsavern/Betriebsverantwortlichen etc., das Organisieren von regelmäßigen Treffen und das Erstellen der Ausweise.',
                'right' => 2,
            ),
            190 => 
            array (
                'id' => 207,
                'question_id' => 55,
                'text' => 'Die Kommunikation zwischen den Foodsavern, Betriebsverantwortlichen, etc. aufrecht zu erhalten und regelmäßige Treffen organisieren.
',
                'explanation' => 'Richtig, neben dem Erstellen der Ausweise, dem Organisieren von regelmäßigen Treffen und der Kommunikation zwischen den Foodsavern/Betriebsverantwortlichen etc., gehört auch dies zu Deinen Aufgaben.  Alle BotschafterInnen können auch foodsharing bei Messen, Events, Presse und Vorträgen repräsentieren - müssen es aber nicht und können entsprechende Anfragen an die jeweilige Gruppe weiterleiten.
',
                'right' => 1,
            ),
            191 => 
            array (
                'id' => 208,
                'question_id' => 55,
                'text' => 'Bei bestehenden Kooperationsbetrieben in Deinem Bezirk/Region in die Tonnen regelmäßig kontrollieren, ob dort noch genießbare Lebensmittel vorzufinden sind.',
                'explanation' => 'Falsch, generell gilt, wir schauen nicht in die Tonnen, die Tonnen nach Lebensmitteln zu durchsuchen ist ein absolutes No-Go, ein Vertrauensbruch und kann zum Ende der Kooperation führen. ',
                'right' => 0,
            ),
            192 => 
            array (
                'id' => 209,
                'question_id' => 56,
                'text' => 'Damit sich die anderen BotschafterInnen nicht immer einen anderen Namen merken müssen.',
                'explanation' => 'Ja, auch das ist nicht falsch, aber vor allem richtig ist, dass ein kurzfristiges Wegfallen eines/r Botschafters/in ohne vorherige Ankündigung und der Suche nach einem/r Nachfolger/in zu einem Chaos in der Region führen könnte und dies eventuell negative Auswirkungen hat.',
                'right' => 2,
            ),
            193 => 
            array (
                'id' => 210,
                'question_id' => 56,
                'text' => 'Weil es mühsam ist, immer alles auf der Homepage umzutragen.',
                'explanation' => 'Ja, auch das ist richtig, aber vor allem weil ein kurzfristiges Wegfallen eines/r Botschafters/in ohne vorherige Ankündigung und der Suche nach einer/m Nachfolger/in zu einem Chaos in der Region führen könnte und dies eventuell negative Auswirkungen hat.
',
                'right' => 2,
            ),
            194 => 
            array (
                'id' => 211,
                'question_id' => 56,
                'text' => 'Weil ein kurzfristiges Wegfallen von einem/r Botschafter/in ohne vorherige Ankündigung und der Suche nach einem/r Nachfolger/in zu einem Chaos in der Region führen könnte und dies eventuell negative Auswirkungen hat.
',
                'explanation' => 'Richtig, darum sorge bitte frühzeitig nach einer passenden Vertretung und informiere sie über  Aufgaben, Projekte, Kooperationen etc.
',
                'right' => 1,
            ),
            195 => 
            array (
                'id' => 212,
                'question_id' => 56,
                'text' => 'Weil eine gewisse Kontinuität für ein gemeinsames, produktives Arbeiten mit allen Foodsavern & BotschafterInnen wichtig ist.
',
                'explanation' => 'Richtig, darum sorge bitte frühzeitig nach einer passenden Vertretung und informiere sie über Aufgaben, Projekte, Kooperationen etc.
',
                'right' => 1,
            ),
            196 => 
            array (
                'id' => 213,
                'question_id' => 52,
                'text' => 'Es ist mir total peinlich und trage mich für die nächsten Abholungen aus diesem Betrieb raus, damit mir sowas nicht noch mal passiert.',
                'explanation' => 'Falsch, natürlich ist es für das Team und die Angestellten von dem Betrieb ärgerlich, wenn sowas passiert, denn wir müssen uns dann erklären warum jemand nicht gekommen ist und im schlimmsten Fall wurden an dem Tag die uns zur Abholung gestellten Lebensmittel weggeschmissen, aber es ist kein Grund nicht weiter abzuholen. Wichtig ist, dass Fehler immer offen mit dem ganzen Team kommuniziert werden, also auf der Pinnwand des Betriebes sowie den Betriebsverantwortlichen Foodsaver direkt per Nachricht. Außerdem musst Du Dich selber melden, also Deinen Verstoß gegen die Verhaltensregeln eintragen, ganz einfach unter Deinem Profil bei “Verstoß melden”.',
                'right' => 0,
            ),
            197 => 
            array (
                'id' => 214,
                'question_id' => 57,
                'text' => 'Erst einmal bin ich als FilialverantwortlicheR verantwortlich für die Erstellung eines Teams, muss eventuell eine Teambesprechung organisieren und fungiere als Ansprechperson für den Betrieb.
',
                'explanation' => 'Richtig, wenn Du eine Kooperation beginnst, übernimmst Du die volle Verantwortung für diese Kooperation. Das heißt nicht, dass Du alles alleine machen musst, aber dass Du die Verantwortung trägst. Bevor Du einen neuen Laden ansprichst, musst Du zuerst auf der Karte nachschauen, ob der Betrieb schon eingetragen ist, damit es nicht zum mehrfachen Ansprechen kommt. Es kann auch hilfreich sein, wenn Du bei den ersten Abholungen mitgehst, um die Foodsaver mit der Abholsituation vertraut zu machen und auf Änderungswünsche der Filialleitung schnellstmöglich reagieren zu können.',
                'right' => 1,
            ),
            198 => 
            array (
                'id' => 215,
                'question_id' => 57,
                'text' => 'Wenn sich in meiner Region noch nicht genügend Leute angemeldet haben, kann es sein, dass ich die ersten Abholungen komplett alleine bewältigen muss.',
                'explanation' => 'Richtig. Da Du als BetriebsverantwortlicheR die Verantwortung für eine 100%ige Abholqoute trägst, musst Du im Notfall selber einspringen. Beziehe diesen Punkt in Deine Planung zur Ansprache neuer Betriebe mit ein, sodass Du später nicht überfordert bist. Es kann auch vorkommen, dass der angesprochene Betrieb sofort am nächsten Tag mit der Kooperation beginnen möchte, also informiere Dich frühzeitig über die Abholkapazitäten der anderen Foodsaver.',
                'right' => 1,
            ),
            199 => 
            array (
                'id' => 216,
                'question_id' => 57,
                'text' => 'Keine, nach Beendigung der Kooperationsgespräche kann ich mich neuen Dingen widmen.',
                'explanation' => 'Falsch, da Du verantwortlich bist für die Filiale sollte diese auch reibungslos laufen, bevor Du andere Betriebe ansprichst, da wir eine verlässliche Abholung gewährleisten wollen. Es geht darum, ein gut abgesprochenes Team zusammenzustellen, das sich untereinander und dem Betrieb gegenüber verantwortungsbewusst und verbunden fühlt. Wenn Du an irgendeinem Punkt die Filialverantwortung abgeben möchtest, musst Du erst nach einem adäquaten, zuverlässigen und vertrauensvollen Ersatz suchen.',
                'right' => 0,
            ),
            200 => 
            array (
                'id' => 217,
                'question_id' => 57,
                'text' => 'Wenn ich die Filialverantwortung abgeben möchte, muss ich nach einem adäquaten, zuverlässigen und vertrauensvollen Ersatz suchen.',
                'explanation' => 'Richtig, da der Kontakt zu den Betrieben vielfach auf Vertrauen basiert, solltest Du den neuen betriebsverantwortlichen Foodsaver auch der Filialleitung vorstellen und ihn ausführlich einweisen, damit es zu keinen Komplikationen kommt.',
                'right' => 1,
            ),
            201 => 
            array (
                'id' => 218,
                'question_id' => 52,
                'text' => 'Es ist mir total peinlich und schreibe mein Fehlverhalten umgehend dem Betriebsverantwortlichen.',
                'explanation' => 'Richtig, natürlich ist es für das Team und die Angestellten von dem Betrieb ärgerlich, wenn sowas passiert, denn wir müssen uns dann erklären warum jemand nicht gekommen ist, außerdem wurden an dem Tag die uns zur Abholung gestellten Lebensmittel wahrscheinlich weggeschmissen und im schlimmsten Fall beendet der Betrieb wegen Unzuverlässigkeit die Kooperation. Wichtig ist, dass neben der Nachricht an den Betriebsverantwortlichen Foodsavers das Nichterscheinen auch offen mit dem ganzen Team kommuniziert wird, also auch auf der Pinnwand des Betriebes. Außerdem musst Du Dich selber melden, also Deinen Verstoß gegen die Verhaltensregeln eintragen, ganz einfach unter Deinem Profil bei “Verstoß melden”.',
                'right' => 1,
            ),
            202 => 
            array (
                'id' => 219,
                'question_id' => 57,
                'text' => 'Ich muss an jedem Abholtag selber vor Ort sein.',
                'explanation' => 'Falsch. Wenn Du eine Kooperation beginnst, übernimmst Du zwar die volle Verantwortung für diese Kooperation, aber das heißt nicht, dass Du die Abholungen vor Ort betreuen bzw. alleine machen musst. Wichtig ist, dass Du schon vor dem Beginn der Abholungen ein Team so gut aufstellst, dass eine gleichmäßig verteilte Abholquote gewährleistet ist. Es geht darum, ein gut abgesprochenes Team zusammenzustellen, das sich untereinander und dem Betrieb gegenüber verantwortungsbewusst und verbunden fühlt.',
                'right' => 0,
            ),
            203 => 
            array (
                'id' => 220,
                'question_id' => 58,
                'text' => 'Ich muss zuerst auf der Karte nachschauen, ob der Betrieb schon eingetragen ist.',
                'explanation' => 'Richtig. Dies ist wichtig, damit es nicht zu Überschneidungen kommt oder Läden  angesprochen werden, die bereits geäußert haben, dass sie nicht kooperieren wollen.',
                'right' => 1,
            ),
            204 => 
            array (
                'id' => 221,
                'question_id' => 58,
                'text' => 'Damit es nicht zu Überschneidungen kommt, muss ich den Betrieb bei foodsharing auf der Plattform eintragen.',
                'explanation' => 'Richtig, es ist uns wichtig, dass Betriebe nicht doppelt oder dreifach angesprochen werden, denn dieses vermittelt keine Professionalität. Also prüfe lieber einmal zu viel, ob der Betrieb schon eingetragen ist.',
                'right' => 1,
            ),
            205 => 
            array (
                'id' => 222,
                'question_id' => 52,
                'text' => 'Es ist mir total peinlich und schreibe einem anderen Foodsaver, dass er mein Verhaltensregelverstoß umgehend meldet.',
                'explanation' => 'Falsch, natürlich muss das Fehlverhalten gemeldet werden, aber das kannst Du selber machen und solltest dafür niemand anderes beauftragen. Unser Ziel ist es eine hundertprozentige Abholquote zu erreichen, weil ein solches Verhalten für das Team und die Angestellten von dem Betrieb ärgerlich ist, denn wir müssen uns dann erklären warum jemand nicht gekommen ist und im schlimmsten Fall wurden an dem Tag die uns zur Abholung gestellten Lebensmittel weggeschmissen. Wichtig ist, dass Fehler immer offen mit dem ganzen Team kommuniziert werden, also auf der Pinnwand des Betriebes sowie den Betriebsverantwortlichen Foodsaver per Privatnachricht. Außerdem musst Du Dich selber melden, also Deinen Verstoß gegen die Verhaltensregeln eintragen, ganz einfach unter Deinem Profil bei “Verstoß melden”.',
                'right' => 0,
            ),
            206 => 
            array (
                'id' => 223,
                'question_id' => 58,
                'text' => 'Ich sollte mich über das Wiki mit der Thematik von “Lebensmittelretten” auseinandergesetzt haben.',
                'explanation' => 'Richtig, es ist wichtig, dass Du Dich mit dem Kontext auskennst, um entsprechend kompetent über das Thema sprechen zu können. Du solltest gut vorbereitet die Betriebe ansprechen, denn die Filialleitung hat teilweise auch viele Fragen, wenn sie noch nicht mit foodsharing zusammengearbeitet hat und diese solltest Du problemlos beantworten können.',
                'right' => 1,
            ),
            207 => 
            array (
                'id' => 224,
                'question_id' => 58,
                'text' => 'Nichts, Kooperationen schließen dürfen alle.',
            'explanation' => 'Falsch, Du solltest nur gut vorbereitet neue Betriebe ansprechen, denn alles andere wirkt unprofessionell und schafft kein Vertrauen und kann Konsequenzen für weitere Kooperationen haben (darum bitte auch nicht ohne Nachfrage Ketten ansprechen). Dadurch wird es auch für Dich schwieriger einen Betrieb für Lebensmittelretten.de zu gewinnen. Der erste Schritt ist das Informieren über die Vorgehensweise des Aufbaus einer Kooperation. Dies ist wichtig, da das durchdachte Vorgehen entscheidend für den erfolgreichen Aufbau einer Kooperation ist.',
                'right' => 0,
            ),
            208 => 
            array (
                'id' => 225,
                'question_id' => 58,
                'text' => 'Ich sollte mir das “Ansprecher-Video” angeschaut haben.',
                'explanation' => 'Richtig, damit Du einen Eindruck von möglichen Fragen bekommst, ist es wichtig, dass Du Dir das Video vorher anschaust. Zumal es noch die wichtigsten Informationen enthält, die fast immer gefragt werden.',
                'right' => 1,
            ),
            209 => 
            array (
                'id' => 226,
                'question_id' => 58,
                'text' => 'Ich muss mich im Wiki über den Abschnitt “Kooperationen” informiert haben und mich um die Checkliste gekümmert haben.',
            'explanation' => 'Richtig, Es ist wichtig, dass Du Dich mit dem Kontext auskennst, um entsprechend kompetent über das Thema sprechen zu können. Du solltest gut vorbereitet, mit allen Unterlagen im Gepäck) die Betriebe ansprechen, denn die Filialleitung hat teilweise auch viele Fragen, wenn sie noch nicht mit foodsharing zusammengearbeitet hat und diese solltest Du problemlos beantworten können.',
            'right' => 1,
        ),
        210 => 
        array (
            'id' => 227,
            'question_id' => 52,
            'text' => 'Es ist mir total peinlich, aber ich kenne die Leute von dem Betrieb und bringe ihnen bei der nächsten Abholung eine Tafel Schokolade mit und entschuldige mich für mein Verhalten.',
            'explanation' => 'Neutral, also sich bei dem Betrieb und Deinem Team zu entschuldigen ist natürlich richtig, aber mit einer Tafel Schokolade oder einem anderem Geschenk ist es nicht getan, denn es ist für Dein Team und die Angestellten von dem Betrieb ärgerlich, wenn sowas passiert, denn wir müssen uns dann erklären warum jemand nicht gekommen ist und im schlimmsten Fall wurden an dem Tag die uns zur Abholung gestellten Lebensmittel weggeschmissen.

Wichtig ist, dass Fehler immer offen mit dem ganzen Team kommuniziert werden, also auf der Pinnwand des Betriebes sowie den Betriebsverantwortlichen Foodsaver per Privatnachricht. Außerdem musst Du Dich selber melden, also Deinen Verstoß gegen die Verhaltensregeln eintragen, ganz einfach unter Deinem Profil bei “Verstoß melden”.',
            'right' => 2,
        ),
        211 => 
        array (
            'id' => 228,
            'question_id' => 59,
            'text' => 'Weil dann alle wissen, dass ich hier ein Vorrecht auf die Lebensmittel habe.',
            'explanation' => 'Falsch, es gibt kein Vorrecht auf Lebensmittel nur weil Du FilialverantwortlicheR bist. Unser Ziel ist es die Lebensmittelverschwendung zu verringern und nicht selbstsüchtig zu handeln.',
            'right' => 0,
        ),
        212 => 
        array (
            'id' => 229,
            'question_id' => 52,
            'text' => 'Es ist mir total peinlich und ich melde mich selber in meinem Profil unter “Verstoß melden. ',
            'explanation' => 'Richtig, natürlich ist es für das Team und die Angestellten von dem Betrieb ärgerlich, wenn sowas passiert, denn wir müssen uns dann erklären warum jemand nicht gekommen ist und im schlimmsten Fall wurden an dem Tag die uns zur Abholung gestellten Lebensmittel weggeschmissen. 
Wichtig ist, dass Fehler immer offen mit dem ganzen Team kommuniziert werden, also auf der Pinnwand des Betriebes sowie den Betriebsverantwortlichen Foodsaver per Privatnachricht. Außerdem musst Du Dich selber melden, also Deinen Verstoß gegen die Verhaltensregeln eintragen, ganz einfach unter Deinem Profil bei “Verstoß melden”.',
            'right' => 1,
        ),
        213 => 
        array (
            'id' => 230,
            'question_id' => 59,
            'text' => 'Weil sich so bereits vor dem Beginn einer Kooperation die Foodsaver in das Team eintragen können.',
            'explanation' => 'Richtig, manchmal startet eine Kooperation von einem auf den anderen Tag und dafür ist es wichtig, dass sich schon vorher ein Team gefunden hat, von denen Du im besten Fall auch schon weißt, wer an welchen Tagen abholen könnte.',
            'right' => 1,
        ),
        214 => 
        array (
            'id' => 231,
            'question_id' => 59,
            'text' => 'Weil es so nicht zu Überschneidungen bei dem Ansprechen der Betriebe kommt.',
            'explanation' => 'Richtig, so kann eine doppelte Anfrage vermieden werden, da dieses ansonsten unprofessionell wirkt.',
            'right' => 1,
        ),
        215 => 
        array (
            'id' => 232,
            'question_id' => 59,
            'text' => 'Muss ich nicht, ich kann den Betrieb auch erst nach der Anfrage eintragen. Wichtig ist nur, dass ich vorher dem/r Botschafter/in Bescheid gebe.',
            'explanation' => 'Falsch, der Betrieb muss, um Überschneidungen zu verhindern, immer VOR der ersten Anfrage auf Lebensmittelretten.de eingetragen werden.',
            'right' => 0,
        ),
        216 => 
        array (
            'id' => 233,
            'question_id' => 60,
            'text' => 'Es ist ausschliesslich die Aufgabe des Orgateams.',
            'explanation' => 'Falsch, selbstverständlich ist es Deine Aufgabe, wie die aller anderen Foodsaver auch, sämtliche Verhaltensregelverstöße zeitnah zu melden. ',
            'right' => 0,
        ),
        217 => 
        array (
            'id' => 234,
            'question_id' => 61,
            'text' => 'Meinen Foodsaver-Ausweis',
            'explanation' => 'Richtig, damit die Filialleitung auch erfährt, wie wir organisiert sind, ist es hilfreich, wenn Du den Ausweis dabei hast, außerdem kannst Du den eigenen Ausweis auch gleich als Beispiel vorzeigen.',
            'right' => 1,
        ),
        218 => 
        array (
            'id' => 235,
            'question_id' => 61,
        'text' => 'Infomaterial, wenn vorhanden, Flyer oder ein Original / Kopie einer “Erfolgsstory” (BioCompany, Bericht in der “Schrot und Korn” etc.).',
            'explanation' => 'Richtig. Denk daran, dass die Filialleitungen meistens noch nichts von foodsharing gehört haben und dafür ist ein Flyer/Artikel sehr hilfreich, da dort die wichtigsten Informationen noch einmal nachgelesen werden können. Um den Betrieb zu überzeugen, kannst Du auf schon erfolgreiche Kooperationen hinweisen. ',
            'right' => 1,
        ),
        219 => 
        array (
            'id' => 236,
            'question_id' => 61,
        'text' => 'Deine ausgedruckte Foodsaver-Visitenkarte (kann hinterlegt werden, falls doch mal was anfällt).',
            'explanation' => 'Richtig, falls Du nur eineN MitarbeitendeN ansprechen konntest, kann dieseR die Visitenkarte an die Filialleitung weitergeben, sodass man Dich kontaktieren kann. Manchmal gibt es auch keine regelmäßigen Abholungen, sodass man Dich anrufen würde, wenn was anfällt, sodass eine Visitenkarte sehr sinnvoll ist.',
            'right' => 1,
        ),
        220 => 
        array (
            'id' => 237,
            'question_id' => 61,
            'text' => 'Die Rechtsvereinbarung',
            'explanation' => 'Richtig, damit die Filialleitung auch nachlesen kann, dass sie von jeglicher Haftung befreit sind, musst Du eine Kopie der Rechtsvereinbarung mit Unterschrift von Deinem/r Botschafter/in & Dir mit aushändigen.',
            'right' => 1,
        ),
        221 => 
        array (
            'id' => 238,
            'question_id' => 62,
            'text' => 'Bei ganz normalen Supermärkten wie Aldi, Lidl, REWE etc.',
            'explanation' => 'Falsch. Bei größeren Ketten ab 2+ Filialen wird auf höheren Ebenen verhandelt. Hier haben einzelnen FilialleiterInnen keine Entscheidungshoheit über Kooperationen. Daher wird hier von der “Betriebsketten”-Gruppe in höherer Instanz verhandelt. Wenn Du Dich informieren möchtest, was der Stand der Dinge ist, kannst Du dies im Wiki nachlesen. Wenn Du Kontakte zu einer Kette hast, sende bitte eine Mail an betriebsketten@lebensmittelretten.de und die Gruppe “Betriebsketten” wird sich bei dir melden.',
            'right' => 0,
        ),
        222 => 
        array (
            'id' => 239,
            'question_id' => 62,
            'text' => 'Bei Ketten welche mehr als 2 Filialen umfassen.',
            'explanation' => 'Falsch, bei größeren Ketten ab 2+ Filialen wird auf höheren Ebenen verhandelt. Hier haben einzelnen FilialleiterInnen keine Entscheidungshoheit über Kooperationen. Daher wird hier von der “Betriebsketten”-Gruppe in höherer Instanz verhandelt.
Wenn Du Dich informieren möchtest, was der Stand der Dinge ist, kannst Du dies im Wiki nachlesen. Wenn Du Kontakte zu einer Kette hast, sende bitte eine Mail an betriebsketten@lebensmittelretten.de und die Gruppe “Betriebsketten” wird sich bei dir melden.',
            'right' => 0,
        ),
        223 => 
        array (
            'id' => 240,
            'question_id' => 62,
            'text' => 'Bei den “kleinen Fischen” wie z.B. privat geführten Bäckereien, Märkten, Lebensmittelgeschäften usw.',
            'explanation' => 'Richtig, bei kleinen und privat geführten Betrieben kannst Du gerne anfragen. Bei kleinen Geschäften können die InhaberInnen meist direkt entscheiden, was mit dem Überschuss passiert. Hier ist es außerdem einfacher, eine persönliche Verbindung aufzubauen.',
            'right' => 1,
        ),
        224 => 
        array (
            'id' => 241,
            'question_id' => 62,
            'text' => 'Bei allen, bei denen ich auch schon Containern war. Hier kann ich gleich anmerken, dass ich weiß, wie viel weggeschmissen wird.',
            'explanation' => 'Falsch, auch wenn Du leider weißt, dass es bei bestimmten Betrieben zu einer Lebensmittelverschwendung kommt. Die direkte Konfrontation mit dem Wegwerfverhalten des Betriebes kann als angreifend empfunden werden. Beim Aufbau einer neuen Kooperation solltest Du als Teil von foodsharing auftreten und nicht als containernde Privatperson. Wenn Du Dich informieren möchtest, was der Stand der Akquise ist, kannst Du dies im Wiki nachlesen.
',
            'right' => 0,
        ),
        225 => 
        array (
            'id' => 243,
            'question_id' => 60,
            'text' => 'Es ist ausschliesslich die Aufgabe des Regelverstoßaufspürungsteams.',
            'explanation' => 'Falsch, dieses “Aufspürteam” gibt es garnicht, selbstverständlich ist es aber die Aufgabe aller Foodsaver, sämtliche Verhaltensregelverstöße zu melden. ',
            'right' => 0,
        ),
        226 => 
        array (
            'id' => 244,
            'question_id' => 60,
            'text' => 'Es ist die Aufgabe des Regelverstoßaufspürungsteams und des Orgateams, damit sich Foodsaver nicht von “normalen” Foodsavern gegen den Kopf gestoßen fühlen könnten.',
            'explanation' => 'Falsch, selbstverständlich ist es die Aufgabe von Dir und von allen anderen Foodsavern auch, sämtliche Verhaltensregelverstöße zu melden.  ',
            'right' => 0,
        ),
        227 => 
        array (
            'id' => 245,
            'question_id' => 62,
            'text' => 'Bei kleinen Restaurants, Catering-Services, Hotels, Online-Versandhäusern von Lebensmitteln, etc.',
            'explanation' => 'Richtig, bei kleinen und privat geführten Betrieben kannst Du gerne anfragen. Bei kleinen Geschäften können die InhaberInnen meist direkt entscheiden, was mit dem Überschuss passiert. Hier ist es außerdem einfacher, eine persönliche Verbindung aufzubauen.',
            'right' => 1,
        ),
        228 => 
        array (
            'id' => 246,
            'question_id' => 63,
            'text' => 'Weil diese normalerweise so gut organisiert sind, dass sie nichts wegschmeißen.',
            'explanation' => 'Falsch. Gerade bei größeren Betrieben wird viel aussortiert. Allerdings haben hier einzelne FilialleiterInnen keine Entscheidungshoheit über Kooperationen mit Lebensmittelretten. Bei größeren Ketten ab 2+ Filialen wird auf höheren Ebenen entschieden und daher wird dort von der “Betriebsketten”-Gruppe in höherer Instanz verhandelt.',
            'right' => 0,
        ),
        229 => 
        array (
            'id' => 247,
            'question_id' => 60,
            'text' => 'Es ist die Aufgabe aller Foodsaver, sämtliche Verstöße gegen die Verhaltensregeln zu melden, auch wenn Du den selben Verstoß bei einem Foodsaver zum 2. Mal meldest weil er sich wiederholt hat oder Du selbst einen Verstoß begangen hast, den Du dann auch selbständig meldest.',
            'explanation' => 'Richtig, auch wenn Du dasselbe Fehlverhalten bereits als Verstoß gemeldet hast, ist es auch die Aufgabe von allen Foodsavern, Betriebsverantwortlichen und BotschafterInnen, alle Regelverstöße unabhängig von wiederholtem Auftreten, Freundschaften, persönlichen Beziehungen oder Ähnlichem zu melden, denn nur wenn wir auch kleine Vergehen gegen die Verhaltensregeln als Verstoß melden, ist es möglich sich auf diese zu beziehen, wenn z.B. der/die Foodsaver an einen anderen Ort zieht, der/die BotschafterIn umzieht oder später weitere Regelverstöße auftreten. ',
            'right' => 1,
        ),
        230 => 
        array (
            'id' => 248,
            'question_id' => 63,
            'text' => 'Weil große Unternehmen nach eigenen Gesetzmäßigkeiten und Regeln handeln und darum grundsätzlich nicht mit uns kooperieren werden.',
        'explanation' => 'Falsch, es gibt teilweise auch schon Ketten (z.B. Bio Company), die mit uns kooperieren.',
            'right' => 0,
        ),
        231 => 
        array (
            'id' => 249,
            'question_id' => 63,
            'text' => 'Weil hier die Firmenzentralen erst einmal überzeugt werden müssen, und dies übernimmt die Gruppe “Betriebsketten”.',
            'explanation' => 'Richtig, gerade bei Ketten muss mehr Überzeugungsarbeit geleistet werden und es muss zentral angefragt werden. ',
            'right' => 1,
        ),
        232 => 
        array (
            'id' => 250,
            'question_id' => 63,
            'text' => 'Weil sie höchstwahrscheinlich schon mit der Tafel kooperieren.',
            'explanation' => 'Falsch. Die Tafel kann längst nicht alle Betriebe abdecken. Außerdem kann die Tafel nicht am Wochenende abholen und kann nicht spontan bei größeren Mengen einspringen – das sind Lücken, die wir füllen können.',
            'right' => 0,
        ),
        233 => 
        array (
            'id' => 251,
            'question_id' => 64,
            'text' => 'Die ganz Großen, denn die werfen ja auch am meisten weg. Hier ist das Abholen am effizientesten.',
            'explanation' => 'Falsch. Bedenke, dass bei Ketten täglich sehr große Mengen anfallen können, die teilweise nur mit dem Auto transportiert werden können. Dafür brauchst Du Unterstützung von anderen Foodsavern. Daher stelle zunächst ein Team zusammen, welche die Mengen auch abholen könnten. Zu beachten ist, dass eine 100%ige Abholquote gewährleistet sein muss. Diese könnte bei nur einer abholenden Person durch Urlaub, Krankheit o.ä. nicht garantiert werden.',
            'right' => 0,
        ),
        234 => 
        array (
            'id' => 252,
            'question_id' => 64,
            'text' => 'Diejenigen, welche ich, solange ich noch alleine bin, auch alleine bewältigen kann.',
            'explanation' => 'Falsch. Alleine lässt sich eine 100%ige Abholquote nicht zuverlässig gewährleisten - zum Beispiel wenn Du Urlaub hast. Erzähle deinen Freunden von Lebenmittelretten.de, organisiere eine Infoveranstaltung etc., damit ihr in eurer Region größer werdet. Erst ab einer bestimmten Anzahl an Menschen können Unregelmäßigkeiten wie Krankheit, Urlaub, stressige Phasen zuverlässig ausgeglichen werden.',
            'right' => 0,
        ),
        235 => 
        array (
            'id' => 253,
            'question_id' => 64,
            'text' => 'Betriebe, zu denen ich mit meinem Auto eine halbe Stunde hinfahre, so ist ein seriöser, räumlicher Abstand gewährleistet.',
            'explanation' => 'Falsch. Ist eine Wegstrecke mit dem Auto nötig, wird der positiven Umweltbilanz des Abholens entgegen gewirkt. Sprich nur Betriebe in deiner nächsten Nähe / entlang deiner normalen Wege an.',
            'right' => 0,
        ),
        236 => 
        array (
            'id' => 254,
            'question_id' => 64,
            'text' => 'Keine. Alleine lässt sich eine 100%ige Abholquote nicht zuverlässig gewährleisten.',
            'explanation' => 'Erzähle deinen Freunden von Lebenmittelretten.de, organisiere eine Infoveranstaltung etc., damit ihr in eurer Region größer werdet. Erst ab einer bestimmten Anzahl an Menschen können Unregelmäßigkeiten wie Krankheit, Urlaub, stressige Phasen zuverlässig ausgeglichen werden.',
            'right' => 1,
        ),
        237 => 
        array (
            'id' => 255,
            'question_id' => 65,
            'text' => 'Ich schicke eine Mail und bitte um Rückruf.',
        'explanation' => 'Falsch, wir wollen in jeder Hinsicht den Betrieben Arbeit abnehmen und nicht noch mehr Arbeit machen. Darum bitte persönlich vorbeigehen oder telefonisch einen Termin ausmachen. Außerdem ist dies ist ein unpersönlicher Erstkontakt, der zudem das weitere Vorankommen von dem Betrieb anhängig macht (Rückruf, etc.).',
            'right' => 0,
        ),
        238 => 
        array (
            'id' => 256,
            'question_id' => 66,
            'text' => 'Wenn ein Foodsaver mindestens 1 Jahr angemeldet ist.',
            'explanation' => 'Falsch, denn es gibt auch Karteileichen, die sich schon vor langer Zeit angemeldet haben und seit dem gar nicht in Aktion getreten sind. Die Dauer der Zugehörigkeit sagt auch nichts über die grundsätzliche Zuverlässigkeit eines Foodsavers aus.',
            'right' => 0,
        ),
        239 => 
        array (
            'id' => 257,
            'question_id' => 65,
            'text' => 'Ich gehe persönlich vorbei und frage nach der Geschäftsleitung.',
            'explanation' => 'Richtig, bei einem persönlichen Gespräch kann man die Geschäftsleitung am besten überzeugen, Vertrauen gewinnen und für Lebensmittelretten begeistern. Bitte immer mit der Geschäftsleitung sprechen, da sie die Entscheidungen treffen.',
            'right' => 1,
        ),
        240 => 
        array (
            'id' => 258,
            'question_id' => 66,
            'text' => 'Wenn ich einen Foodsaver als zuverlässig und vertrauenswürdig erlebe. Also wenn er die Verhaltensregeln einhält, pünktlich und engagiert ist.',
            'explanation' => 'Richtig, wenn ein Foodsaver sich an die Verhaltensregeln hält, pünktlich, zuverlässig und engagiert ist, macht es Sinn ihm eine Vertrauensbanane zu schenken. Dadurch können die Betriebsverantwortlichen, BotschafterInnen und andere sehen, dass dieser Foodsaver zuverlässig und vertrauenswürdig ist. Das stärkt die Community und hilft den Betriebsverantwortlichen zu entscheiden, wer sich fürs Abholen eignet und wer evtl. nicht.',
            'right' => 1,
        ),
        241 => 
        array (
            'id' => 259,
            'question_id' => 65,
            'text' => 'Ich rufe im Vorfeld beim Betrieb an, frage nach der Geschäftsleitung und mach mit ihr einen Termin aus.',
            'explanation' => 'Richtig, der Anruf mit Terminaufnahme schafft Verbindlichkeit. Bei einem persönlichen Treffen kannst Du dann auch gleich die ganzen Unterlagen vorzeigen und ein Vertrauensverhältnis zur Geschäftsleitung aufbauen.',
            'right' => 1,
        ),
        242 => 
        array (
            'id' => 260,
            'question_id' => 66,
            'text' => 'Wenn ich jemand schon länger kenne, also auch bevor ich mit dem Foodsaver gemeinsam abholen war.',
            'explanation' => 'Falsch, die Vertrauensbanane sollte nicht aus persönlicher Sympathie vergeben werden, sondern sollte an Foodsaver vergeben werden die sich an die Verhaltensregeln halten, auf die man sich verlassen kann, die engagiert sind usw. Du solltest die Vertrauensbanane nur vergeben, wenn Du ein paar Mal mit dem Foodsaver abholen warst und ihn vlt. auch bei anderen Aktivitäten in der foodsharing Community erlebt hast.',
            'right' => 0,
        ),
        243 => 
        array (
            'id' => 261,
            'question_id' => 65,
            'text' => 'Ich lege ihnen beim Containern einen Brief auf die Tonnen.',
            'explanation' => 'Falsch, stelle den Kontakt persönlich her, denn wir wollen die Lebensmittel ja vor der Entsorgung in die Tonnen abholen. Außerdem kann die direkte Konfrontation mit dem Wegwerfverhalten des Betriebes als angreifend empfunden werden. Beim Aufbau einer neuen Kooperation solltest Du als Teil von Lebensmittelretten offiziell im Betrieb auftreten und nicht als containernde Privatperson.',
            'right' => 0,
        ),
        244 => 
        array (
            'id' => 262,
            'question_id' => 67,
            'text' => 'Ich überzeuge ihn davon, dass wir viel besser, zuverlässiger und attraktiver sind.',
        'explanation' => 'Falsch, wir sind glücklich, wenn es schon eine bestehende Kooperation mit einer anderen Organisation gibt und hinterlassen, wenn gewünscht eine Visitenkarte, falls die andere Organisation ausfällt. Lebensmittelretten.de steht in keiner Konkurrenz (zu z.B. der Tafel), sondern sieht sich als eine flexible, lückenfüllende Organisation, die spontan, am Wochenende, nur kleine Menge und auch abgelaufene Lebensmittel abholen kann.',
            'right' => 0,
        ),
        245 => 
        array (
            'id' => 263,
            'question_id' => 67,
            'text' => 'Ich sage ihm, dass ich aber regelmäßig in der Nacht seine Tonnen durchwühlt habe und er wohl nicht die Wahrheit sagt, weil der Inhalt der Tonnen eine andere Sprache spricht.',
        'explanation' => 'Falsch, die direkte Konfrontation mit dem Wegwerfverhalten des Betriebes kann als angreifend empfunden werden. Beim Aufbau einer neuen Kooperation solltest Du als Teil von Lebensmittelretten offiziell im Betrieb auftreten und nicht als containernde Privatperson. Auch wenn Du weißt, dass teilweise noch Lebensmittel weggeschmissen werden, bleibst Du freundlich und fragst hier zu einem späteren Zeitpunkt noch einmal nach. Gerne kannst Du der Geschäftsleitung auch mitteilen, dass wir alles mitnehmen (MHD, geöffnete Verpackungen etc.) und eine Visitenkarte hinterlassen.',
            'right' => 0,
        ),
        246 => 
        array (
            'id' => 264,
            'question_id' => 67,
            'text' => 'Ich erkläre ihm, dass wir uns auf keinen Fall zwischen bereits bestehende Kooperationen drängen wollen!',
            'explanation' => 'Richtig, wir sind auf keinen Fall Konkurrenz für andere, bereits bestehende Kooperationen, sondern bieten uns für noch bestehende Lücken an.',
            'right' => 1,
        ),
        247 => 
        array (
            'id' => 265,
            'question_id' => 66,
            'text' => 'Wenn mich ein Foodsaver immer wieder dazu drängt, ihm eine Vertrauensbanane zu geben.',
            'explanation' => 'Falsch, die Vertrauensbananen sollten auf jeden Fall freiwillig vergeben werden. Wenn ein Foodsaver Dir gegenüber fordern wird, wirft das kein gutes Licht auf ihn und Du solltest Dir gut überlegen ob er eine Vertrauensbanane wirklich verdient. Außerdem kannst Du den Foodsaver eine Verstoßmeldung schreiben, weil es sich nicht gehört Menschen zum Vertrauensbananen schenken zu drängeln.',
            'right' => 0,
        ),
        248 => 
        array (
            'id' => 266,
            'question_id' => 67,
            'text' => 'Ich teile ihm meine Freude darüber mit, dass hier bereits Vorkehrungen gegen die Lebensmittelverschwendung getroffen wurden.',
            'explanation' => 'Richtig, unser Ziel ist es etwas gegen die Lebensmittelverschwendung zu unternehmen. Wenn sich Geschäftsleitungen vorher schon Gedanken darüber gemacht und Lösungen gefunden haben, ist das super und lobenswert.',
            'right' => 1,
        ),
        249 => 
        array (
            'id' => 267,
            'question_id' => 67,
            'text' => 'Ich trage den Betrieb auf Lebensmittel mit dem Status “spendet an Tafel etc. und wirft nichts weg” ein.',
            'explanation' => 'Richtig. Dies ist wichtig, damit es nicht zu Überschneidungen oder Dopplungen bei den Anfragen kommt.',
            'right' => 1,
        ),
        250 => 
        array (
            'id' => 269,
            'question_id' => 67,
            'text' => 'Ich frage nach, ob die andere Organisation auch Lebensmittel nimmt, welche das Mindesthaltbarkeitsdatum überschritten haben und ob sie auch am Samstag abholt. Sollte dies nicht der Fall sein, so biete ich uns als Ergänzung an.',
            'explanation' => 'Richtig. Wir wollen alles uns mögliche gegen Lebensmittelverschwendung tun und bieten uns gerne für noch bestehende Lücken in der Lebensmittelrettung an.',
            'right' => 1,
        ),
        251 => 
        array (
            'id' => 273,
            'question_id' => 69,
            'text' => 'Ich schicke ihm keine Informationen, wer so unfreundlich ist, der wird sich garantiert auch nicht überzeugen lassen.',
            'explanation' => 'Falsch, bitte bedenke, dass auch die Geschäftsleitung unter Zeitdruck stehen kann und sich die Informationen vielleicht gerne in Ruhe durchlesen möchte. Schicke der Geschäftsleitung die gewünschten Informationen, damit diese gut informiert sind und sich bei Fragen an Dich wenden können.',
            'right' => 0,
        ),
        252 => 
        array (
            'id' => 274,
            'question_id' => 69,
            'text' => 'Ich rege mich fürchterlich auf und poste das auch gleich auf Facebook.',
            'explanation' => 'Falsch, es kann immer passieren, dass die Geschäftsleitung nicht so viel Zeit hat, daher schicke dieser die gewünschten Informationen und biete an, dass man sich bei Fragen gerne an Dich wenden kann.',
            'right' => 0,
        ),
        253 => 
        array (
            'id' => 275,
            'question_id' => 69,
            'text' => 'Ich sage ihm noch vor Ort, dass ich nie wieder bei ihm einkaufen werde und ab sofort alles in der Nacht aus seinen Tonnen retten werde.',
            'explanation' => 'Falsch, wir reagieren stets freundlich, auch wenn die Geschäftsleitung kaum Zeit für uns hat, denn dieses kann andere Ursachen haben und wir nehmen das dann nicht persönlich, sondern senden die gewünschten Unterlagen an die Geschäftsleitung.',
            'right' => 0,
        ),
        254 => 
        array (
            'id' => 276,
            'question_id' => 69,
            'text' => 'Ich schicke ihm umgehend per Mail die gewünschten Informationen zu und biete ihm an, bei Unklarheiten auch gerne noch mal persönlich bei ihm vorbei zu kommen.',
        'explanation' => 'Richtig, so kann sich die Geschäftsleitung erst einmal in Ruhe die Unterlagen durchlesen und sich ein Bild von unserer Arbeit machen. Die entsprechenden Informationen, (Rechtsvereinbarung, Text zu foodsharing, Kopie Bericht Bio Company, eventuell Liste der Vorteile) finde ich im Wiki von Lebensmittelretten.de.',
            'right' => 1,
        ),
        255 => 
        array (
            'id' => 277,
            'question_id' => 70,
            'text' => 'Eine mögliche Pärchenbildung.',
            'explanation' => 'Falsch, Bildung von Teamgeist, Vernetzung der Freiwilligen untereinander, Verteilen von Aufgaben sind der Sinn der Treffen.',
            'right' => 0,
        ),
        256 => 
        array (
            'id' => 278,
            'question_id' => 70,
            'text' => 'Bildung von Teamgeist.',
            'explanation' => 'Richtig, neben der Vernetzung der Freiwilligen untereinander und dem Verteilen von Aufgaben ist dies ein weiterer Punkt.',
            'right' => 1,
        ),
        257 => 
        array (
            'id' => 279,
            'question_id' => 70,
            'text' => 'persönliches Kennenlernen der Foodsaver untereinander.',
            'explanation' => 'Richtig, neben der Bildung eines Teamgeistes und dem Verteilen von Aufgaben ist dies ein weiterer Punkt.',
            'right' => 1,
        ),
        258 => 
        array (
            'id' => 280,
            'question_id' => 71,
            'text' => 'Den muss ich mit dabei haben? Den habe ich nie mit dabei.',
            'explanation' => 'Falsch, damit Du ein Vertrauensverhältnis aufbauen kannst und auch von unserer Professionalität überzeugen kannst, ist es wichtig, dass Du den Foodsaver-Ausweis dabei hast.',
            'right' => 0,
        ),
        259 => 
        array (
            'id' => 281,
            'question_id' => 70,
        'text' => 'Verteilen von Aufgaben (anstehende Messen, Verantwortung für Fair-Teiler etc.)',
            'explanation' => 'Richtig, neben der Vernetzung der Freiwilligen untereinander und der Bildung eines Teamgeistes ist dies ein weiterer Punkt.',
            'right' => 1,
        ),
        260 => 
        array (
            'id' => 282,
            'question_id' => 71,
            'text' => 'Weil ich so meinem Gegenüber erkläre, dass sich alle unsere Foodsaver mit einem Ausweis ausweisen können.',
            'explanation' => 'Richtig, nur Personen mit Foodsaver-Ausweis sind Teil des Freiwilligen-Netzwerks und haben definitv die Rechtsvereinbarung unterschrieben. So kann bereits vom ersten Treffen an eine gute Vertrauensbasis aufgebaut werden.',
            'right' => 1,
        ),
        261 => 
        array (
            'id' => 283,
            'question_id' => 71,
            'text' => 'Weil es Seriosität, Verbindlichkeit und Zuverlässigkeit vermittelt.',
            'explanation' => 'Richtig, so kann bereits vom ersten Treffen an eine gute Vertrauensbasis aufgebaut werden. Nur Personen mit Foodsaver-Ausweis sind Teil des Freiwilligen-Netzwerks und haben definitiv die Rechtsvereinbarung unterschrieben.',
            'right' => 1,
        ),
        262 => 
        array (
            'id' => 284,
            'question_id' => 71,
            'text' => 'Der Foodsaver Ausweis belegt, dass uns der entsprechende Betrieb aufgrund von Rechtsvereinbarungen seine abgeschriebenen Lebensmittel übergeben muss.',
            'explanation' => 'Falsch, der Foodsaver Ausweis bestätigt lediglich, dass Du die Rechtsvereinbarung zur Kenntnis genommen hast und somit bei Abholung von Lebensmitteln jede Verantwortung darüber auf Dich übertragen wird. Die Betriebe sind nie verpflichtet dazu uns ihre Überschüsse auszuhändigen somit stellen wir auch niemals Forderungen an die Betriebe.',
            'right' => 0,
        ),
        263 => 
        array (
            'id' => 285,
            'question_id' => 71,
            'text' => 'Ich zeige meinen Personalausweis, das wird für das erste Gespräch schon ausreichen.',
            'explanation' => 'Falsch, bitte nimm deinen Foodsaver-Ausweis mit und zeige diesen vor, so hat dein Gegenüber gleich einen guten Eindruck unserer Arbeitsweise. Nur Personen mit Foodsaver-Ausweis sind Teil des Freiwilligen-Netzwerks und haben definitv die Rechtsvereinbarung unterschrieben.',
            'right' => 0,
        ),
        264 => 
        array (
            'id' => 286,
            'question_id' => 72,
            'text' => 'Ruhm, Ehre und die Dankbarkeit seitens der Betriebe bei denen wir Essen retten.',
            'explanation' => 'Falsch, um die Lebensmittelverschwendung und damit den Hunger, die Ressourcenverschwendung, den Klimawandel usw. zu minimieren.',
            'right' => 0,
        ),
        265 => 
        array (
            'id' => 287,
            'question_id' => 73,
            'text' => 'Ich gebe ihm keine, denn entweder “ganz oder gar nicht”.',
            'explanation' => 'Falsch, wir sind glücklich, wenn schon von anderen Organisationen abgeholt wird und überreichen gerne eine Visitenkarte, um bei Engpässen oder Ausfällen der anderen Organisation spontan abholen zu können.',
            'right' => 0,
        ),
        266 => 
        array (
            'id' => 288,
            'question_id' => 73,
            'text' => 'Ich gebe ihm eine und schaue nach, ob die Beschreibung für den Betrieb noch auf dem aktuellen Stand ist.',
            'explanation' => 'Richtig, überreiche Deine Visitenkarte mit dem Hinweis, dass wir auch kurzfristig einspringen können, wenn es zu Ausfällen kommt. Hinterlasse einen aktualisierten Statusbericht auf der entsprechenden Teamseite auf lebensmittelretten.de.',
            'right' => 1,
        ),
        267 => 
        array (
            'id' => 289,
            'question_id' => 73,
            'text' => 'Ich gebe ihm eine und schau, ob sich für eine spontane Anfrage bereits ein Team gebildet hat.',
            'explanation' => 'Richtig, überreiche Deine Visitenkarte mit dem Hinweis, dass wir auch kurzfristig einspringen können, wenn es zu Ausfällen kommt. Bilde hierfür am besten ein möglichst spontanes / flexibles Team und schreibe den aktuellen Stand auf die Pinnwand auf lebensmittelretten.de.',
            'right' => 1,
        ),
        268 => 
        array (
            'id' => 290,
            'question_id' => 73,
            'text' => 'Ich gebe ihm eine, sage ihm aber gleich, dass ich schwer beschäftigt bin und bei kurzfristigen Notfallabholungen für nichts garantieren kann.',
            'explanation' => 'Falsch, wenn Du ihm deine Telefonnummer gibst, solltest Du auch in der Lage sein, bei kurzfristigen Abholungen entweder selber abzuholen oder schnell einen anderen Ersatz zu organisieren.',
            'right' => 0,
        ),
        269 => 
        array (
            'id' => 291,
            'question_id' => 73,
            'text' => 'Ich erkläre, dass ich keine Visitenkarte dabei habe, ihm aber gerne die Telefonnummer meines Botschafters überreichen kann.',
            'explanation' => 'Falsch, bitte achte darauf, dass Du für solche Situationen Visitenkarten von dir dabei hast. Solltest ausversehen deine Visitenkarte vergessen haben, so gib auf jeden Fall dennoch deine Telefonnummer weiter, nicht die von Deinem/r Botschafter/in.',
            'right' => 0,
        ),
        270 => 
        array (
            'id' => 292,
            'question_id' => 72,
            'text' => 'Um Gleichgesinnte kennen zu lernen und sich zu vernetzen.',
            'explanation' => 'Nicht direkt, sondern um unser oberstes Ziel zu erreichen, die Lebensmittelverschwendung und damit den Hunger, die Ressourcenverschwendung, den Klimawandel usw. zu minimieren. Dafür ist es wichtig, dass wir uns gegenseitig kennen, um gemeinsam effektiver daran zu arbeiten und vor allem auch mit Freude und Elan bei dem Ganzen dabei zu sein.',
            'right' => 2,
        ),
        271 => 
        array (
            'id' => 293,
            'question_id' => 72,
            'text' => 'Die Lebensmittelverschwendung und damit den Hunger, die Ressourcenverschwendung, den Klimawandel usw. zu minimieren.',
            'explanation' => 'Richtig, dafür engagieren wir uns!',
            'right' => 1,
        ),
        272 => 
        array (
            'id' => 294,
            'question_id' => 74,
        'text' => 'Waren über dem Mindesthaltbarkeits(MHD)-Datum',
            'explanation' => 'Richtig. Sowohl Trockenwaren, Tiefkühlwaren, als auch Frischwaren etc. können von uns abgeholt werden. Andere Organisationen dürfen teilweise keine MHD-Ware annehmen. Wichtig ist unser Bewusstsein, dass wir mit der Abholung verantwortlich für die Lebensmittel und deren Auswirkungen werden. Daher ist es unsere Entscheidung, ob bestimmte Produkte noch genießbar sind.',
            'right' => 1,
        ),
        273 => 
        array (
            'id' => 295,
            'question_id' => 74,
            'text' => 'abgelaufene Milchprodukte',
            'explanation' => 'Richtig. Auf abgelaufene Milchprodukte sind häufig noch genießbar. Wichtig ist unser Bewusstsein, dass wir mit der Abholung verantwortlich für die Lebensmittel und deren Auswirkungen werden. Daher ist es unsere Entscheidung, ob bestimmte Produkte noch genießbar sind.',
            'right' => 1,
        ),
        274 => 
        array (
            'id' => 296,
            'question_id' => 74,
            'text' => 'an Samstagen',
            'explanation' => 'Richtig. Wir sind nicht an feste Abholzeiten gebunden und können von daher zu allen Tageszeiten und an allen Wochentagen abholen, solange sich Foodsaver dazu bereit erklären. Viele andere Organisationen holen nur an Werktagen ab.',
            'right' => 1,
        ),
        275 => 
        array (
            'id' => 297,
            'question_id' => 74,
            'text' => 'an Sonntagen',
            'explanation' => 'Richtig. Wir sind nicht an feste Abholzeiten gebunden und können von daher zu allen Tageszeiten und an allen Wochentagen abholen, solange sich Foodsaver dazu bereit erklären. Viele andere Organisationen holen nur an Werktagen ab.',
            'right' => 1,
        ),
        276 => 
        array (
            'id' => 298,
            'question_id' => 75,
            'text' => 'Ich verpflichte mich, mich um die fachgerechte Entsorgung von nicht mehr genießbaren Lebensmitteln, aber auch von Verpackungsmaterial etc. zu kümmern.',
            'explanation' => 'Richtig, wenn nicht mehr genießbare Lebensmittel und Verpackungsreste anfallen, dann sollten diese sachgerecht entsorgt werden, andere Foodsaver aus dem Team des Betriebes weisen Dich ein wie und wo der Abfall entsorgt wird. Es kann auch vorkommen, dass Betriebe wünschen, dass auch ungenießbare Lebensmittel mitgenommen werden, Du also Kisten mit genießbaren und Müll mitnehmen musst.',
            'right' => 1,
        ),
        277 => 
        array (
            'id' => 299,
            'question_id' => 74,
            'text' => 'Kurzfristige Abholungen',
            'explanation' => 'Richtig. Auch kurzfristige und größere Abholmengen können von uns bewältigt werden. Da wir dezentral organisiert sind, können wir bei kurzfristigen Abholungen schnell Leute vor Ort informieren und aktivieren.',
            'right' => 1,
        ),
        278 => 
        array (
            'id' => 300,
            'question_id' => 75,
            'text' => 'Ich verpflichte mich, den Ort, an dem die Ware entgegengenommen bzw. getrennt wird, mindestens so sauber zu hinterlassen, wie er vorgefunden wurde.',
            'explanation' => 'Richtig, wir wollen den Betrieben Arbeit abnehmen und nicht noch zusätzlich verursachen, daher hinterlassen wir den Ort auch mindestens so sauber wie wir ihn vorgefunden haben und fragen gegebenenfalls nach einem Besen etc.',
            'right' => 1,
        ),
        279 => 
        array (
            'id' => 301,
            'question_id' => 74,
            'text' => 'Wir bieten uns nicht als “Lückenfüller” an, sondern handeln nach dem Prinzip “ganz oder gar nicht”.',
            'explanation' => 'Falsch, um der Lebensmittelverschwendung entgegen zu wirken, übernehmen wir gerne auch die Lücken.',
            'right' => 0,
        ),
        280 => 
        array (
            'id' => 302,
            'question_id' => 75,
            'text' => 'Ich verpflichte mich dazu, den gesamten Innenbereich des Betriebes noch kurz zu reinigen.',
            'explanation' => 'Falsch, der gesamte Innenbereich wird nicht von uns gereinigt, sondern es wird nur der Ort, wo wir die Ware abgeholt und sortiert haben, mindestens genauso sauber hinterlassen, wie wir ihn vorgefunden haben.',
            'right' => 0,
        ),
        281 => 
        array (
            'id' => 303,
            'question_id' => 75,
            'text' => 'Ich verpflichte mich dazu, den Abfallcontainer an die Straße zu stellen, damit der Entsorgungsbetrieb diese sofort entleeren kann.',
            'explanation' => 'Falsch, dafür bist Du nicht zuständig, sondern nur für sachgemäße Entsorgung der anfallenden ungenießbaren Lebensmittel und Verpackungsreste und ein sauberes Hinterlassen des Ortes. 

Auch wenn es in der Rechtsvereinbarung nicht verplichtend ist, können wir aber den Betrieben ggf. diesen Gefallen tun, wenn dieser das wünscht. Darüber wirst Du ggf. aber von den Foodsavern des Betriebs informiert.',
            'right' => 2,
        ),
        282 => 
        array (
            'id' => 304,
            'question_id' => 76,
        'text' => 'Geld und Arbeitskraftersparnis für die Entsorgung und ein besseres Ansehen bei der Kundschaft durch Werbung (wenn gewünscht).',
        'explanation' => 'Richtig, da wir (und keineR der Mitarbeitenden) die Lebensmittel gegebenenfalls richtig in die Tonnen entsorgen und es durch uns zu einer Verringerung der Entsorgungskosten kommt, da weniger weggeschmissen wird. Des Weiteren kann der Betrieb auf seine nachhaltige Entsorgung verweisen (Sticker etc.).',
            'right' => 1,
        ),
        283 => 
        array (
            'id' => 305,
            'question_id' => 76,
            'text' => 'Unsere Flexibilität: Wir können auch am Wochenende abholen, können auch bei Ausfall der Tafeln etc. einspringen.',
            'explanation' => 'Richtig, durch eine dezentrale Struktur können wir schnell und flexibel reagieren und Leute informieren und organisieren.',
            'right' => 1,
        ),
        284 => 
        array (
            'id' => 306,
            'question_id' => 76,
        'text' => '100% Abholquote: Wir holen neben allen noch genießbaren Lebensmitteln über MHD, offene Packungen usw. auch alle anderen Waren (Tiernahrung, Kosmetika etc.) ab welche ansonsten in der Tonne landen würden.',
            'explanation' => 'Richtig, wir streben nach einer 100% igen Abholquote, bei der dann auch Non-Food Produkte mit abgeholt werden dürfen.',
            'right' => 1,
        ),
        285 => 
        array (
            'id' => 307,
            'question_id' => 76,
            'text' => 'Keine rechtlichen Risiken durch den Haftungsausschluss.',
            'explanation' => 'Richtig, durch den Haftungsausschluss in der Rechtsvereinbarung geht die Haftung von der Filiale an den abholenden Foodsaver über.',
            'right' => 1,
        ),
        286 => 
        array (
            'id' => 308,
            'question_id' => 77,
            'text' => 'Von der Spendenverpflichtung gegenüber foodsharing.',
            'explanation' => 'Natürlich falsch, denn die Betriebe haben natürlich nie eine Spendenverpflichtung und können also auch nicht von dieser entbunden werden, sondern von jeglicher Haftung für die Genießbarkeit bzw. gesundheitliche Unbedenklichkeit der Waren.',
            'right' => 0,
        ),
        287 => 
        array (
            'id' => 309,
            'question_id' => 77,
            'text' => 'Von der Pflicht zur korrekten Lagerung der Lebensmittel im Betrieb wie z.B. der Einhaltung der Kühlkette bei Kühlwaren.',
            'explanation' => 'Falsch, natürlich sollen die Betriebe für die korrekte Lagerung und die Einhaltung der Kühlkette bis zur Übergabe dieser an die Foodsaver sorgen. Die Betriebe werden nicht von einer korrekten Lagerung mit der Rechtsvereinbarung entbunden.
Entbunden werden die Betriebe von jeglicher Haftung für die Genießbarkeit bzw. gesundheitliche Unbedenklichkeit der Waren.',
            'right' => 0,
        ),
        288 => 
        array (
            'id' => 310,
            'question_id' => 78,
            'text' => 'Durch Einsparungen bei den Müllkosten.',
            'explanation' => 'Richtig, da es durch uns zu einer Verringerung der Entsorgungskosten kommt, da ja weniger weggeschmissen wird und wir die Lebensmittel mitnehmen, welche noch verwertbar sind.',
            'right' => 1,
        ),
        289 => 
        array (
            'id' => 311,
            'question_id' => 77,
            'text' => 'Von jeglicher Haftung für die Genießbarkeit bzw. gesundheitliche Unbedenklichkeit der Waren.',
            'explanation' => 'Richtig, darum überprüfe die Waren bitte nach bestem Wissen und Gewissen auf ihre Unbedenklichkeit.',
            'right' => 1,
        ),
        290 => 
        array (
            'id' => 312,
            'question_id' => 77,
            'text' => 'Von ihrem ökologischen Fußabdruck.',
            'explanation' => 'Falsch, von jeglicher Haftung für die Genießbarkeit bzw. gesundheitliche Unbedenklichkeit der Waren.',
            'right' => 0,
        ),
        291 => 
        array (
            'id' => 313,
            'question_id' => 78,
            'text' => 'Er spart sich eineN MitarbeitendeN weil der abholende Foodsaver im Laden die Regale und Kühlschränke nach den Produkten, welche das MHD überschritten haben sucht und diese aussortiert.',
        'explanation' => 'Falsch, die abholenden Foodsaver sollen nicht selber die Waren nach MHD sortieren. Üblicherweise wird mit dem Betrieb ausgemacht, dass er die Waren weiterhin kühlt (Kühllager oder ähnliches) und einE MitarbeitendeR sie auf Nachfrage dem Foodsaver in die Hand drückt.',
            'right' => 0,
        ),
        292 => 
        array (
            'id' => 314,
            'question_id' => 78,
            'text' => 'Durch die Tatsache, dass nicht die Angestellten, sondern wir die Mülltrennung der zur Verfügung gestellten Lebensmittel vornehmen.',
            'explanation' => 'Richtig, da wir die Mülltrennung von den für uns zur Verfügung gestellten Lebensmittel in Kisten die wir vor Ort oder auf Wunsch von dem Betrieb extern sortieren, brauchen die Angestellten des Betriebes dieses nicht übernehmen und kann andere Aufgaben erledigen, wodurch der Betrieb Geld einspart, Ressourcen geschont werden und unser Verhalten als positiv wahrgenommen wird.',
            'right' => 1,
        ),
        293 => 
        array (
            'id' => 315,
            'question_id' => 78,
            'text' => 'Es sollte dem Betrieb ausschließlich darum gehen, dass die Lebensmittelverschwendung verringert wird und nicht, dass er Geld mit unseren Abholungen sparen kann.',
            'explanation' => 'Falsch, wir wollen den Fokus zwar auf die Lebensmittelverschwendung richten, jedoch ist ein Betrieb auch ein Wirtschaftsunternehmen und wenn wir den Betrieb mit wirtschaftlichen Argumenten überzeugen können und dadurch Lebensmittel retten können, freuen wir uns darüber.',
            'right' => 2,
        ),
        294 => 
        array (
            'id' => 316,
            'question_id' => 80,
            'text' => 'Nach den Wünschen des Kooperationspartners.',
            'explanation' => 'Richtig, wir richten uns grundsätzlich nach den Wünschen des Kooperationspartners, sollte sich die Wunschzeit von dem Betrieb als sehr ungünstigen Zeitpunkt erweisen wo wir derzeit nicht genügend zuverlässige Foodsaver zum Abholen finden, kann unter diesen Umständen auch vorsichtig gefragt werden ob die Abholungen auch zu einer anderen Uhrzeit, stattfinden könnten. Dabei sollte jedoch wirklich sicher sein, dass es unter keinen Umständen möglich ist der Wunschabholzeit des Betriebes nachzukommen.',
            'right' => 1,
        ),
        295 => 
        array (
            'id' => 317,
            'question_id' => 80,
            'text' => 'Nach den Wünschen des Teams.',
            'explanation' => 'Falsch, nach den Wünschen des Kooperationspartners.',
            'right' => 0,
        ),
        296 => 
        array (
            'id' => 318,
            'question_id' => 80,
            'text' => 'Nach meinen eigenen Wünschen.',
            'explanation' => 'Falsch, nach den Wünschen des Kooperationspartners.',
            'right' => 0,
        ),
        297 => 
        array (
            'id' => 319,
            'question_id' => 80,
            'text' => 'Nach Ebbe und Flut.',
            'explanation' => 'Falsch, nach den Wünschen des Kooperationspartners.',
            'right' => 0,
        ),
        298 => 
        array (
            'id' => 320,
            'question_id' => 81,
            'text' => 'Feste Tage und Zeiten um Regelmäßigkeit und Zuverlässigkeit für Lebensmittelspenderbetrieb und Foodsaver zu erreichen.',
            'explanation' => 'Richtig, so ist es für alle Beteiligten am einfachsten und das Vertrauen in unsere Arbeit wächst.',
            'right' => 1,
        ),
        299 => 
        array (
            'id' => 321,
            'question_id' => 81,
            'text' => 'Flexible Tage und Zeiten, welche wöchentlich neu zwischen Team und Betrieb besprochen werden.',
            'explanation' => 'Falsch, es sollten feste Tage und Zeiten vereinbart werden, um Regelmäßigkeit und Zuverlässigkeit für Lebensmittelspenderbetrieb und Foodsaver zu gewährleisten und den Betrieb nicht zu belasten.',
            'right' => 0,
        ),
        300 => 
        array (
            'id' => 322,
            'question_id' => 81,
            'text' => 'Abholungen möglichst früh am Morgen da wir fast nur StudentInnen bei Lebensmittelretten haben und diese haben am Vormittag immer Zeit und wollen abends Party machen.',
            'explanation' => 'Falsch, es sollten feste Tage und Zeiten vereinbart werden, um Regelmäßigkeit und Zuverlässigkeit für Lebensmittelspendebetrieb und Foodsaver zu gewährleisten und den Betrieb nicht zu belasten.',
            'right' => 0,
        ),
        301 => 
        array (
            'id' => 323,
            'question_id' => 81,
            'text' => 'Flexible Abholungen nach vorheriger telefonischer Absprache.',
            'explanation' => 'Falsch, es sollten feste Tage und Zeiten vereinbart werden, um Regelmäßigkeit und Zuverlässigkeit für Lebensmittelspendebetrieb und Foodsaver zu gewährleisten und den Betrieb nicht zu belasten.',
            'right' => 0,
        ),
        302 => 
        array (
            'id' => 324,
            'question_id' => 82,
            'text' => 'Ich sortiere selbstständig die vom Supermarkt aussortierten Lebensmittel in noch-essbar und nicht-mehr-essbar.',
            'explanation' => 'Richtig. Wir können nicht erwarten, immer nur komplett genießbare Lebensmittel zu bekommen. Es müssen immer alle Lebensmittel abgenommen werden, auch solche, welche nicht mehr genießbar sind, abgelaufen sind, oder nicht dem eigenen Geschmack entsprechen.',
            'right' => 1,
        ),
        303 => 
        array (
            'id' => 325,
            'question_id' => 82,
            'text' => 'Habe ich keine Möglichkeit die Lebensmittel beim Betrieb zu sortieren, erkläre ich mich auch bereit, nicht mehr genießbares in meinem eigenen Hausmüll zu entsorgen.',
            'explanation' => 'Richtig, es ist nicht immer gewährleistet das uns die Mitarbeitenden es ermöglichen Lebensmittel vor Ort zu sortieren, auch hier können wir nicht die Erwartung an den Betrieb stellen uns das zu ermöglichen, also nehmen wir erst einmal mit, was uns gegeben wird und kümmern uns an einem anderen Ort um die korrekte Entsorgung.',
            'right' => 1,
        ),
        304 => 
        array (
            'id' => 326,
            'question_id' => 82,
            'text' => 'Ich ordne die vom Supermarkt aussortierten Lebensmittel selbstständig in über MHD und unter MHD. Nur die unter MHD nehme ich rückstandslos mit.',
            'explanation' => 'Falsch. Das Kriterium ist die Genießbarkeit und nicht das MHD oder der eigene Geschmack. Lebensmittel, die nicht dem eigenen Geschmack entsprechen, können weiterverschenkt werden.',
            'right' => 0,
        ),
        305 => 
        array (
            'id' => 327,
            'question_id' => 82,
            'text' => 'Ich sortiere die vom Supermarkt aussortierten Lebensmittel selbstständig in “möchte ich in der nächsten Zeit essen” und “möchte ich nicht essen.” Die leckeren Lebensmittel nehme ich rückstandslos mit.',
            'explanation' => 'Falsch. Das Kriterium ist die Genießbarkeit und nicht das MHD oder der eigene Geschmack. Lebensmittel, die nicht dem eigenen Geschmack entsprechen, können weiterverschenkt werden.',
            'right' => 0,
        ),
        306 => 
        array (
            'id' => 328,
            'question_id' => 79,
            'text' => 'Das oberste Ziel ist es, alle noch genießbaren abgeholten Lebensmittel vor der Vernichtung zu bewahren und sie dem menschlichen Verzehr zuzuführen.',
            'explanation' => 'Richtig, uns ist daran gelegen alle noch verzehrbaren Lebensmittel für Menschen zu retten, alle anderen Lebensmittel wie welke Salatblätter und ähnliches kann natürlich sehr gerne an Tiere verfüttert werden. Uns ist aber daran gelegen, dass keine für den menschlichen Verzehr noch geeigneten Lebensmittel an Tiere verfüttert werden.',
            'right' => 1,
        ),
        307 => 
        array (
            'id' => 329,
            'question_id' => 82,
            'text' => 'Ich entsorge die verdorbenen Lebensmittel sowie die anfallenden Verpackungen, Kartons, Papiere, etc. sachgerecht in die Supermarkt-Mülltonnen oder bei mir zu Hause.',
            'explanation' => 'Richtig. Wichtig ist es vor allem, den Sortierplatz sauber und ordentlich zu hinterlassen. Die Entsorgung der sortierten Verpackungen, etc. richtet sich nach Absprache mit dem jeweiligen Betrieb. Nicht alle haben frei zugängliche Tonnen und schließen diese extra für uns auf, im Zweifelsfall müssen Abfälle auch mit nach Hause genommen werden.',
            'right' => 1,
        ),
        308 => 
        array (
            'id' => 330,
            'question_id' => 83,
            'text' => 'Den Betrieb bei foodsharing.de aktualisieren. Dabei wird alles, was besprochen wurde und mit wem, auf die Teamseite des Betriebes geschrieben, außerdem wird der Status angepasst.',
            'explanation' => 'Richtig, ich teile dem Team den aktuellen Stand auf der Pinnwand mit und informiere dieses gegebenenfalls über die nächsten Schritte. Außerdem passe ich den Status an.',
            'right' => 1,
        ),
        309 => 
        array (
            'id' => 331,
            'question_id' => 83,
            'text' => 'Ich wende mich neuen Betrieben zu und überlasse den Rest dem Team.',
            'explanation' => 'Falsch, als Betriebsverantwortlicher bist Du dafür verantwortlich nach erster Kontaktaufnahme den Betrieb auf lebensmittelretten.de zu aktualisieren, das Team zu informieren und den Status zu ändern.',
            'right' => 0,
        ),
        310 => 
        array (
            'id' => 332,
            'question_id' => 83,
            'text' => 'Ich poste meinen Erfolg sofort auf Facebook und lasse mich feiern.',
            'explanation' => 'Falsch, manche Kooperationen möchten “im Stillen” mit uns kooperieren und nicht öffentlich erwähnt werden.',
            'right' => 0,
        ),
        311 => 
        array (
            'id' => 333,
            'question_id' => 83,
            'text' => 'Wenn es mit dem Kooperationspartner ausgemacht wurde, schicke ich ihm die gewünschten Informationen.',
        'explanation' => 'Richtig, übersende die gewünschten Informationen und biete Deine Hilfe an, wenn noch Fragen offen sind (z.B. Haftungsausschluss, Vorteile für Lebensmittelspenderbetriebe).',
            'right' => 1,
        ),
        312 => 
        array (
            'id' => 334,
            'question_id' => 79,
            'text' => 'Das oberste Ziel ist es, die persönlichen Ausgaben für Lebensmittel zu minimieren.',
            'explanation' => 'Falsch, das oberste Ziel ist es, alle noch genießbaren abgeholten Lebensmittel vor der Vernichtung zu bewahren und sie dem menschlichen Verzehr zuzuführen.',
            'right' => 0,
        ),
        313 => 
        array (
            'id' => 335,
            'question_id' => 84,
            'text' => 'Immer ein Auge auf die Abholungen haben, wenn es Lücken gibt, sorge ich dafür, dass diese geschlossen werden.',
            'explanation' => 'Richtig, da Du für den Betrieb verantwortlich bist, solltest Du einen Überblick über die Auslastung der Abholtage haben und bei Engpässen eine Nachricht an das Team senden.',
            'right' => 1,
        ),
        314 => 
        array (
            'id' => 336,
            'question_id' => 84,
            'text' => 'Kommunikation mit dem Betrieb und Kommunikation mit dem Team.',
            'explanation' => 'Richtig, Du bist die Verbindung zwischen dem Betrieb und dem Team, daher ist es wichtig, dass Du wichtige Informationen oder Veränderungen auf die Pinnwand schreibst, damit das Team bestens informiert ist.',
            'right' => 1,
        ),
        315 => 
        array (
            'id' => 337,
            'question_id' => 79,
            'text' => 'Das oberste Ziel ist es, eine spaßige Community aufzubauen, welche viele Events und Belustigungen veranstaltet.',
        'explanation' => 'Falsch, das oberste Ziel ist es, alle noch genießbaren abgeholten Lebensmittel vor der Vernichtung zu bewahren und sie dem menschlichen Verzehr zuzuführen, dass wir dabei noch viel Freude haben ist klar, aber nicht das oberste Ziel ;)',
        'right' => 0,
    ),
    316 => 
    array (
        'id' => 338,
        'question_id' => 84,
        'text' => 'Sollte vom Betrieb der Wunsch geäussert werden, kann ich bei Nachhaltigskeitsfragen beratend behilflich sein.',
        'explanation' => 'Richtig, gerne kannst Du auf Wunsch oder Nachfrage durch die Geschäftsleitung bei Fragen bezüglich der Nachhaltigkeit beratend zur Seite stehen.',
        'right' => 1,
    ),
    317 => 
    array (
        'id' => 339,
        'question_id' => 84,
        'text' => 'Ich belehre ungefragt die Mitarbeitenden und die Chefin über die Möglichkeiten das Nachhaltigkeitsbestreben weiterhin zu verbessern.',
        'explanation' => 'Falsch, Du kannst Deine Hilfe freundlich anbieten. Doch wenn die Geschäftsleitung zu dem Zeitpunkt kein Interesse bekundet, dann reagiere freundlich und frage zu einem späteren Zeitpunkt noch einmal nach.',
        'right' => 0,
    ),
    318 => 
    array (
        'id' => 340,
        'question_id' => 79,
        'text' => 'Das oberste Ziel ist es, mit dem Projekt bei der nächsten Bundestagswahl 2017 teilzunehmen, dafür brauchen wir viele engagierte Foodsaver.',
        'explanation' => 'Falsch, das oberste Ziel ist es, alle noch genießbaren abgeholten Lebensmittel vor der Vernichtung zu bewahren und sie dem menschlichen Verzehr zuzuführen.',
        'right' => 0,
    ),
    319 => 
    array (
        'id' => 341,
        'question_id' => 85,
        'text' => 'Die Lebensmittel vor der Übergabe an Dritte nach bestem Wissen und Gewissen auf ihre Unbedenklichkeit zu überprüfen.',
        'explanation' => 'Richtig, lies Dir dazu bitte die Verhaltensanweisungen im Ratgeber des Foodsharing e.V. durch.',
        'right' => 1,
    ),
    320 => 
    array (
        'id' => 342,
        'question_id' => 85,
        'text' => 'Regelmäßig zu Treffen meiner Region, Stadt oder Bezirks zu erscheinen.',
        'explanation' => 'Deine regelmäßige Teilnahme an den Treffen wird von uns erwünscht, sind aber nicht verpflichtend. Bei den Treffen werden immer wichtige und aktuelle Themen besprochen, außerdem lernst Du auf diesen Treffen die anderen Foodsaver kennen, was entscheidend ist für den Teamgeist, da wir ja gemeinsam die Lebensmittelverschwendung reduzieren wollen. 

Du verpflichtest Dich, die Lebensmittel vor der Übergabe an Dritte nach bestem Wissen und Gewissen auf ihre Unbedenklichkeit zu überprüfen und diese ausschließlich zu verschenken und vor dem Wurf in die Tonne zu bewahren.  Jedes weitere Engagement für foodsharing ist natürlich sehr erwünscht aber nicht verpflichtend. Wir freuen uns wenn Du Dich mal in den Gruppen umschaust (oben in der Menüleiste) wo Du Dich noch einbringen kannst bzw. BetriebsverantwortlicheR oder sogar als BotschafterIn mitwirkst! ',
        'right' => 2,
    ),
    321 => 
    array (
        'id' => 343,
        'question_id' => 85,
        'text' => 'Mich über die Abholungen hinaus aktiv einzubringen, also z.B. bei der Suche nach Kooperationspartnern, Organisation von Treffen etc.',
    'explanation' => 'Nein, nicht unbedingt. Du verpflichtest Dich, die Lebensmittel vor der Übergabe an Dritte nach bestem Wissen und Gewissen auf ihre Unbedenklichkeit zu überprüfen und diese ausschließlich zu verschenken und vor dem Wurf in die Tonne zu bewahren und regelmäßig zu Treffen Deiner Region/Deines Bezirks zu erscheinen. Jedes weitere Engagement für foodsharing ist natürlich sehr erwünscht aber nicht verpflichtend. Wir freuen uns wenn Du Dich mal in den Gruppen umschaust (oben in der Menüleiste) wo Du Dich noch einbringen kannst bzw. BetriebsverantwortlicheR oder sogar als BotschafterIn mitwirkst! ',
        'right' => 2,
    ),
    322 => 
    array (
        'id' => 344,
        'question_id' => 85,
        'text' => 'Die Lebensmittel ausschließlich unentgeltlich weiter zu geben oder selbst zu verzehren.',
        'explanation' => 'Richtig, die geretteten Lebensmittel dürfen ausschließlich nicht kommerziell weiter gegeben werden, also nicht verkauft werden.',
        'right' => 1,
    ),
    323 => 
    array (
        'id' => 345,
        'question_id' => 86,
        'text' => 'Ich sorge für eine gute Informationsweitergabe zwischen dem teilnehmenden Betrieb und den Abholenden meines Teams.',
        'explanation' => 'Richtig, Du bist die Verbindung zwischen dem Betrieb und dem Team, daher ist es wichtig, dass Du wichtige Informationen oder Veränderungen auf die Pinnwand schreibst, damit das Team bestens informiert ist. Auch freuen sich die Mitarbeitenden über einen Kuchen etc.',
        'right' => 1,
    ),
    324 => 
    array (
        'id' => 346,
        'question_id' => 86,
        'text' => 'Bei wichtigen Dingen, Vorfällen, Wünschen usw. suche ich die Kommunikation mit der Geschäftsleitung.',
        'explanation' => 'Richtig, versuche alle Probleme oder Vorfälle mit der Geschäftsleitung in einem persönlichen Gespräch zu klären, sodass einer weiteren vertrauensvollen Zusammenarbeit nichts im Wege steht.',
        'right' => 1,
    ),
    325 => 
    array (
        'id' => 347,
        'question_id' => 86,
        'text' => 'Um eine professionelle Distanz zu wahren, erfolgen Gespräche entweder telefonisch oder über Mailverkehr.',
        'explanation' => 'in den meisten fällen es ist besser ein persönliches Gespräch zu suchen, da man dann auch besser und schneller auf Wünsche und Probleme eingehen kann. In Einzelfällen kann aber auch eine Kommunikation über Telefon oder E-Mail sinvoll sein, z.B. wenn es sich um einen großen Betrieb handelt und die Geschäftsleitung nur gelegentlich im direkt im Betrieb anzutreffen ist.',
        'right' => 2,
    ),
    326 => 
    array (
        'id' => 348,
        'question_id' => 86,
        'text' => 'Keinen, immerhin entsorgen wir deren Müll, da müssen eigentlich sie uns Dankbarkeit entgegenbringen.',
        'explanation' => 'Falsch, es ist sehr wichtig, dass die Kommunikation mit der Geschäftsleitung reibungslos verläuft, auch wenn wir zur Reduzierung des anfallenden Mülls beitragen.',
        'right' => 0,
    ),
    327 => 
    array (
        'id' => 349,
        'question_id' => 87,
        'text' => 'Wir wollen den Betrieb bei unseren Abholungen immer zufriedenstellen und alles  sauber hinterlassen. Außerdem wollen wir für ein gutes Verhältnis mit den Angestellten sorgen.',
        'explanation' => 'Richtig, denn nur so entsteht eine gute Vertrauensbasis und eine stabile Kooperation.',
        'right' => 1,
    ),
    328 => 
    array (
        'id' => 350,
        'question_id' => 87,
        'text' => 'Wir wollen unseren Eigenbedarf decken und unsere Kosten für Lebensmittel auf € 0.- runterschrauben.',
        'explanation' => 'Falsch, wir wollen Lebensmittel vor der Tonne retten. Wenn dabei der Eigenbedarf reduziert wird, ist das natürlich schön, aber das Hauptziel ist es definitiv nicht.',
        'right' => 0,
    ),
    329 => 
    array (
        'id' => 351,
        'question_id' => 88,
        'text' => 'darauf, Verantwortung für mein eigenes Verhalten zu übernehmen.',
        'explanation' => 'Falsch, selbstverständlich bist Du auch nach dem Akzpetieren von der Rechtsvereinbarung verantwortlich für Dein Handeln. Außerdem verzichtest Du auf Spendenbescheinigung sowie Schadensersatzansprüchen.',
        'right' => 0,
    ),
    330 => 
    array (
        'id' => 352,
        'question_id' => 87,
        'text' => '100%ige Abholzuverlässigkeit und Annahme von allem, was nicht mehr verkauft werden kann.',
    'explanation' => 'Richtig, eine 100%ige Abholzuverlässigkeit ist durch ein gutes Team zu gewährleisten, außerdem wollen wir auch erreichen, dass wir alle anderen Waren (Tierfutter, Schnuller, Kosmetika, Molkereiprodukte etc.) retten dürfen und so nichts noch brauchbares in der Tonne landet.',
        'right' => 1,
    ),
    331 => 
    array (
        'id' => 353,
        'question_id' => 88,
        'text' => 'auf alles',
        'explanation' => 'Falsch, Du verzichtest auf jegliche Schadensersatzansprüche.',
        'right' => 0,
    ),
    332 => 
    array (
        'id' => 354,
        'question_id' => 88,
        'text' => 'auf jegliche Schadensersatzansprüche.',
        'explanation' => 'Richtig, darum überprüfe die Waren vor Weitergabe bitte nach bestem Wissen und Gewissen auf ihre Genießbarkeit.',
        'right' => 1,
    ),
    333 => 
    array (
        'id' => 355,
        'question_id' => 88,
        'text' => 'auf nichts.',
        'explanation' => 'Falsch, Du verzichtest auf jegliche Schadensersatzansprüche.',
        'right' => 0,
    ),
    334 => 
    array (
        'id' => 356,
        'question_id' => 87,
        'text' => 'Wir wollen uns auf das Retten der Lebensmittel konzentrieren und keinerlei Beziehung zu den Angestellten aufbauen.',
        'explanation' => 'Falsch, wir wollen ein gutes Verhältnis und einen guten Umgang zu allen Angestellten haben. Nebenbei: oft haben die Mitarbeitenden selber ein Problem mit der Lebensmittelverschwendung und sind sehr glücklich über unser Tun.',
        'right' => 0,
    ),
    335 => 
    array (
        'id' => 357,
        'question_id' => 90,
        'text' => 'Die Gruppenzusammensetzung sollte im Idealfall stabil sein. Um eine vertrauensvolle, langfristige Beziehung mit einem Betrieb aufzubauen, ist eine Kontinuität der Abholenden wichtig.',
        'explanation' => 'Richtig, darum teile Neuigkeiten zeitnah über die Pinnwand mit und reagiere sofort, wenn Foodsaver zu Abholungen nicht erschienen sind oder es allgemein Probleme im Team oder mit der Kooperation gibt.',
        'right' => 1,
    ),
    336 => 
    array (
        'id' => 358,
        'question_id' => 89,
        'text' => 'Ich nehme sie in einem Einkaufskorb mit und bringe sie zum/zur FilialleiterIn und sage ihm/ihr, dass wir diese Lebensmittel auch gerne mitnehmen würden, weil sie ja schon abgelaufen sind.',
        'explanation' => 'Falsch, die Angestellten werden ihre Gründe haben, warum die Lebensmittel dort noch stehen. Eine solche Nachfrage danach könnte als Dreistigkeit gewertet werden.',
        'right' => 0,
    ),
    337 => 
    array (
        'id' => 359,
        'question_id' => 90,
        'text' => 'Alle Mitglieder sind im Besitz eines Autos und sind jederzeit auf ihrem Handy erreichbar.',
        'explanation' => 'Falsch, es ist keine Voraussetzung, dass Teammitglieder ein Auto oder ein Handy besitzen, jedoch sollte man im Normalfall mindestens alle 1-2 Tage seine eMails kontrollieren und sich auf foodsharing einloggen, um über den aktuellen Stand der Dinge informiert zu sein bzw. Dein Team vom Betrieb zu informieren. Länger als 3 Tage solltest Du nicht ohne Schlafmütze und passendem Ersatz offline sein.',
        'right' => 0,
    ),
    338 => 
    array (
        'id' => 360,
        'question_id' => 89,
        'text' => 'Ich stecke sie einfach ein und erspare dem Supermarkt Arbeit, weil wir ja die abgelaufenen Lebensmittel ohnehin bekommen.',
        'explanation' => 'Falsch, dies entspricht einem Diebstahl und hätte für Dich und die Kooperation mit dem Betrieb sowie dem Ruf von foodsharing sehr negative Folgen!',
        'right' => 0,
    ),
    339 => 
    array (
        'id' => 361,
        'question_id' => 90,
        'text' => 'Die Teammitglieder haben keinen weiten Anfahrtsweg zu dem Betrieb, sondern wohnen/arbeiten in der Nähe oder der Betrieb liegt auf ihrem Weg.',
        'explanation' => 'Richtig, die Teammitglieder sollten nicht allzu lange Wege haben, damit sie auch kurzfristig einspringen können und es auch umweltschonend ist.',
        'right' => 1,
    ),
    340 => 
    array (
        'id' => 362,
        'question_id' => 90,
        'text' => 'Die Mitglieder kennen sich alle untereinander und gehen einmal die Woche nen Kaffee trinken.',
        'explanation' => 'Generell nicht falsch, aber die Teammitglieder müssen sich nicht regelmäßig zum Kaffeetrinken treffen, jedoch wäre es schön und sinnvoll, wenn sich die Teammitglieder kennen würden, um eine Vertrauensbasis zu schaffen, lediglich der oder die Fillialverantwortliche sollte im Idealfall alle Abholer kennen.',
        'right' => 2,
    ),
    341 => 
    array (
        'id' => 363,
        'question_id' => 89,
        'text' => 'Sollte es ein wirklich gutes Verhältnis zu den Angestellten geben, erwähne ich die abgelaufene Ware ohne fordernd zu wirken. Ansonsten erwähne ich dieses gegenüber den Mitarbeitern nicht.',
        'explanation' => 'Das ist möglich, aber wirklich nur wenn ein super Verhältnis zu dem Betrieb besteht und wenn das Nachfragen ganz vorsichtige und höflich passiert aber wirklich nur wenn die Waren schon abgelaufen sind und nicht erst in 1,2 oder mehr Tagen ablaufen. Generell ist es nicht unsere Aufgabe im Laden nach abgelaufenen Lebensmittel zu suchen, das kann von den Angestellten schnell als anstrengend und besserwisserisch rüberkommen.',
        'right' => 2,
    ),
    342 => 
    array (
        'id' => 364,
        'question_id' => 89,
        'text' => 'Ich rufe noch im Laden den Betriebsverantwortlichen an und frage nach, ob ich die Lebensmittel mitnehmen kann oder nicht.',
    'explanation' => 'Falsch, der Betriebsverantwortliche wird für diese Situation aus der Entfernung keine geeignete Antwort parat haben. Bitte wende Dich nur wenn ein wirklich ausgesprochen gutes Verhältniss zu den Angstellten gibt an eine(n) der/die Angestellten und erwähne die abgelaufene Ware ohne fordernd zu wirken - aber nur, wenn Du zu den Mitarbeitern ein gutes Verhältnis hast, sodass auch bestimmt keine schlechte Stimmung aufkommt und sie sich nicht genervt fühlen durch Dein Fragen. Generell ist es nicht unsere Aufgabe im Laden nach abgelaufenen Lebensmittel zu suchen, das kann von den Angestellten schnell als anstrengend und besserwisserisch rüberkommen.',
        'right' => 0,
    ),
    343 => 
    array (
        'id' => 365,
        'question_id' => 91,
        'text' => 'Auch wenn bei der Abholung mehr Foodsaver dabei sind, sollten im Idealfall nicht mehr als zwei Personen in den Betrieb zum abholen gehen.',
        'explanation' => 'Richtig, Erfahrungen haben gezeigt, dass durch viele Menschen beim Abholen ein unorganisierter Eindruck seitens der Foodsaver entstehen kann und manche Läden auf eine Kooperation keine Aufmerksamkeit erregen wollen. Durch Fehlverhalten an dieser Stelle wurden leider auch bereits bestehende Kooperationen beendet.',
        'right' => 1,
    ),
    344 => 
    array (
        'id' => 366,
        'question_id' => 91,
        'text' => 'Alle nehmen sich nur für den Eigenbedarf mit, der Rest wird weggeschmissen.',
        'explanation' => 'Falsch, natürlich nehmen sich alle Foodsaver Lebensmittel für den Eigenbedarf mit, doch um die “Fair-Teilung” der restlichen Lebensmittel muss sich auch gekümmert werden. Ob der Foodsaver die Lebensmittel über Foodshsaring.de, einen Fairteiler oder eine soziale Einrichtung etc. weitergibt, steht ihm selbstverständlich frei.',
        'right' => 0,
    ),
    345 => 
    array (
        'id' => 367,
        'question_id' => 91,
        'text' => 'Wir lassen uns von den Mitarbeitenden kostenlos Tüten für den Transport der geretteten Lebensmittel geben.',
        'explanation' => 'Falsch, selbstverständlich kümmern sich die Foodsaver immer selbst um die Transportutensilien der Abholung. Man sollte lieber besser ausgestattet zur Abholung kommen, da wir nichts vor Ort lassen.',
        'right' => 0,
    ),
    346 => 
    array (
        'id' => 368,
        'question_id' => 91,
        'text' => 'Die geretteten Lebensmittel werden nicht im Laden, direkt vor dem Laden oder generell vor den Augen der Kundschaft geteilt.',
        'explanation' => 'Richtig, manche Läden wollen auf keinen Fall auf ihre Kooperation aufmerksam machen, da sie befürchten Kundschaft zu verlieren. Durch Fehlverhalten an dieser Stelle wurden leider auch bereits bestehende Kooperationen beendet.',
        'right' => 1,
    ),
    347 => 
    array (
        'id' => 369,
        'question_id' => 92,
        'text' => 'Ich gebe ihr recht, dass wenn es nur so unregelmäßig etwas abzuholen gibt, dann macht es keinen Sinn eine Zusammenarbeit anzufangen und trage auf der Plattform einfach ein “Betrieb ist nicht bereit zu spenden”.',
        'explanation' => 'Falsch, natürlich bieten wir den Betrieben an auch zu unregelmäßigen Terminen und somit nach Absprache die Lebensmittel abzuholen. Schreibt ein Betrieb nur wenige Lebensmittel ab, so ist das natürlich als positiv anzusehen und somit holt ein Foodsaver auch gerne die nur noch sehr wenigen Reste ab.',
        'right' => 0,
    ),
    348 => 
    array (
        'id' => 370,
        'question_id' => 93,
    'text' => 'Mich nach Möglichkeit bei der ersten Abholung persönlich bei dem/der GeschäftsleiterIn oder Angestellten vorstellen (oder von einem anderen Foodsaver vorstellen lassen) und ihm/ihr meinen Foodsharing Ausweis zeigen.',
        'explanation' => 'Richtig, das Vorzeigen des Ausweises vermittelt Professionalität und garantiert den MitarbeiterInnen, dass Du Mitglied bei foodsharing.de bist. Ein freundliches, offenes Auftreten der Foodsaver setzen wir voraus! Bei größeren Betrieben ist das jedoch meist nicht möglich mit dem/der GeschäftsleiterIn zu sprechen, dafür aber bei einem Angestellten.',
        'right' => 1,
    ),
    349 => 
    array (
        'id' => 371,
        'question_id' => 92,
        'text' => 'Ich zeige meine Freude über so viel Bewusstsein zu dem Thema und vor allem das nur so wenig übrig bleibt. Ich biete aber trotzdem an, auch kleinste Mengen abzuholen. Ich erkläre noch mal klar, dass gerade für solche geringen Mengen das dezentrale Abholsystem von Lebensmittelretten sehr effektiv ist.',
        'explanation' => 'Richtig, natürlich bieten wir den Betrieben an auch zu unregelmäßigen Terminen und somit nach Absprache die Lebensmittel abzuholen. Schreibt ein Betrieb nur wenige Lebensmittel ab, so ist das natürlich als positiv anzusehen und somit holt ein Foodsaver auch gerne die nur noch sehr wenigen Reste ab.',
        'right' => 1,
    ),
    350 => 
    array (
        'id' => 372,
        'question_id' => 93,
        'text' => 'Ein paar Euro als Dank für die Lebensmittel einem/r MitarbeiterIn geben.',
        'explanation' => 'Falsch, da mit dem Betrieb eine kostenlose Abholung der Lebensmittel vereinbart wurde. Als Dankeschön freuen sich die Angestellten z.B. über einen Kuchen.',
        'right' => 0,
    ),
    351 => 
    array (
        'id' => 373,
        'question_id' => 92,
        'text' => 'Ich wiederhole, dass wir sehr gerne abholen würden, aber mindestens einen fixen Termin pro Woche brauchen, anders würden wir keine Kooperation anfangen können, weil es am Ende mehr aufwand als nutzen hat.',
        'explanation' => 'Falsch, Natürlich bieten wir den Betrieben an auch zu unregelmäßigen Terminen und somit nach Absprache die Lebensmittel abzuholen. Schreibt ein Betrieb nur wenige Lebensmittel ab, so ist das natürlich als positiv anzusehen und somit holt ein Foodsaver auch gerne die nur noch sehr wenigen Reste ab.',
        'right' => 0,
    ),
    352 => 
    array (
        'id' => 374,
        'question_id' => 93,
        'text' => 'Vorher auf der Pinnwand im Team nachlesen, wie die Abholkonditionen sind bzw. ob sich etwas geändert hat.',
        'explanation' => 'Richtig, auf der Pinnwand sind immer die aktuellsten Neuigkeiten zu finden. Sollte sich kurzfristig etwas geändert haben, findest Du es dort. Bitte auch speziell auf der rechten Seite unter “Besonderheiten” nachlesen.',
        'right' => 1,
    ),
    353 => 
    array (
        'id' => 375,
        'question_id' => 92,
        'text' => 'Ich empfehle die wenigen Dinge einfach an Obdachlose zu verteilen, die freuen sich immer.',
        'explanation' => 'Falsch, natürlich bieten wir den Betrieben an auch zu unregelmäßigen Terminen und somit nach Absprache die Lebensmittel abzuholen. Schreibt ein Betrieb nur wenige Lebensmittel ab, so ist das natürlich als positiv anzusehen und somit holt ein Foodsaver auch gerne die nur noch sehr wenigen Reste ab.',
        'right' => 0,
    ),
    354 => 
    array (
        'id' => 376,
        'question_id' => 93,
        'text' => 'Wenn die anderen abholenden Foodsaver ein paar Minuten nach der verabredeten Zeit immer noch nicht eingetroffen sind, einfach schon mal in den Laden gehen und im Lager anfangen die Lebensmittel zu sortieren. Um sicherzugehen, ob sie wirklich nichts wegwerfen, werde ich auch noch die Tonnen nach Lebensmitteln durchsuchen.',
        'explanation' => 'Falsch, generell gilt: Wir gehen gemeinsam, wenn auch verspätet, in die Läden, um Professionalität zu zeigen. Absolutes No-Go ist es, die Tonnen nach Lebensmitteln zu durchsuchen - das ist verboten und ein Vertrauensbruch und kann das Ende der Kooperation bedeuten.',
        'right' => 0,
    ),
    355 => 
    array (
        'id' => 377,
        'question_id' => 94,
        'text' => 'Warten bis einE AndereR das übernimmt oder die BotschafterIn wird schon noch was machen.',
        'explanation' => 'Falsch, wenn keiner aktiv etwas unternimmt wird es keine Veränderung der Situation geben. Bei inaktiven Botschaftern bitte eine Mail an welcome@lebensmittelretten.de.',
        'right' => 0,
    ),
    356 => 
    array (
        'id' => 378,
        'question_id' => 94,
        'text' => 'Da die BotschafterIn anscheinend inaktiv ist, werde ich das Orgateam kontaktieren.',
        'explanation' => 'Fast ganz richtig, bitte melde Dich bei inaktiven Botschaftern bitte per Mail an welcome@lebensmittelretten.de .das Botschafterbegrüßungsteam, welches aber auch teilweise vom Orgateam betreut wird.',
        'right' => 2,
    ),
    357 => 
    array (
        'id' => 379,
        'question_id' => 94,
        'text' => 'Da es in meinem Bezirk/Region noch keineN BotschafterIn gibt, nehme ich über das Forum Kontakt zu den anderen angemeldeten Foodsavern auf und versuche ein Treffen zu organisieren, bei dem sich dann jemand findet, die diese Funktion übernehmen möchte und sich dann an das BotschafterInnenbegrüßungsteam wendet.',
        'explanation' => 'Richtig, so kannst Du auch gleich die anderen Freiwilligen kennenlernen und ihr könnt gemeinsam jemanden suchen, der die Aufgaben eines/einer BotschafterIn übernimmt.',
        'right' => 1,
    ),
    358 => 
    array (
        'id' => 380,
        'question_id' => 94,
    'text' => 'Ich informiere mich über die Aufgaben der BotschafterIn, falls ich diese erfüllen kann und möchte, wende ich mich an das BotschafterInnen-Begrüßungsteam (botschafterInnen@lebensmittelretten.de) mit der Bitte, mich nach Bestehen des BotschafterInnen-Quiz als BotschafterIn freizuschalten.',
        'explanation' => 'Richtig, das BotschafterInnenbegrüßungsteam würde sich dann im nächsten Schritt an Dich wenden und Dich beim Aufbau des neuen Bezirks/Region unterstützen.',
        'right' => 1,
    ),
    359 => 
    array (
        'id' => 381,
        'question_id' => 95,
        'text' => 'Weil Foodsaver kein Auto benutzen dürfen.',
        'explanation' => 'Falsch, natürlich steht es Dir frei, ein Auto zu benutzen. Schöner ist es allerdings, wenn Du es ohne schaffst. Lange Anfahrtswege machen aus ökologischen, ökonomischen und organisatorischen Gründen keinen Sinn, auch weil es teilweise wirklich keinen geeigneten Parkplatz vor den Betrieben gibt.',
        'right' => 0,
    ),
    360 => 
    array (
        'id' => 382,
        'question_id' => 95,
        'text' => 'Weil es bei Ausfall der öffentlichen Verkehrsmitteln, Stau etc. zu Verspätungen kommen könnte.',
        'explanation' => 'Richtig, da wir zuverlässig und pünktlich bei Abholungen auftreten wollen, ist dies Gift für eine bestehende Kooperation.',
        'right' => 1,
    ),
    361 => 
    array (
        'id' => 383,
        'question_id' => 95,
        'text' => 'Weil wir so eine deutlich größere Flexibilität bei Abholungen garantieren können.',
    'explanation' => 'Richtig, vor allem bei kurzfristigen Anfragen ist dies von großem Vorteil (Zeit & Energie).',
        'right' => 1,
    ),
    362 => 
    array (
        'id' => 384,
        'question_id' => 95,
        'text' => 'Weil ein langer Anfahrtsweg weder ressourcen- noch zeiteffizient für Dich und die Erde ist.',
        'explanation' => 'Richtig, wir wollen für die Betriebe & die Öffentlichkeit ein Vorbild sein. Lange Anfahrtswege machen aus ökologischen, ökonomischen und organisatorischen Gründen keinen Sinn. Weil wir dezentral organisiert sein wollen und so eine Nähe zu den Betrieben brauchen, um auch unangekündigte Abholungen schnell und effizent gewährleisten können.',
        'right' => 1,
    ),
    363 => 
    array (
        'id' => 385,
        'question_id' => 96,
        'text' => 'Der Zeitraum zwischen der Herstellung eines Lebensmittelprodukts und dem angegebenen MHD ist gesetzlich genau vorgeschrieben. Lebensmittel mit abgelaufenem MHD sind nicht mehr für den Verzehr geeignet und müssen entsorgt werden.',
        'explanation' => 'Falsch, das MHD ist eine Garantie des Herstellers, dass bis zum angegebenen Zeitpunkt, in Verbindung mit der angegebenen Lagertemperatur, das Lebensmittel die vom Hersteller bestimmte Qualität und den mikrobiologischen Zustand behält. Ist das MHD abgelaufen, ist es so, als ob man das Produkt selber hergestellt hat und man auch die volle Verantwortung dafür trägt. Allerdings ist auch jedem bekannt, dass zum Beispiel bei einem Joghurt, welcher 7 Tage nach Ablauf des MHD’s verzehrt wird, sich vielleicht ein wenig Wasser abgesetzt hat oder die Farbe der Fruchtmischung durchscheint, genießbar ist er aber immer noch. Setzt also eure Sinne Sehen, Riechen, Schmecken ein. Die Lagertemperaturangabe ist einzuhalten. Der Kühlschrank sollte an der kältesten Temperaturangabe ausgerichtet sein. Vorsicht: Bitte nicht das MHD mit dem Verbrauchsdatum verwechseln!',
        'right' => 0,
    ),
    364 => 
    array (
        'id' => 386,
        'question_id' => 96,
    'text' => 'Diese Lebensmittel sind (ggf. unter Einhaltung der Kühlkette) zur Weitergabe geeignet.',
        'explanation' => 'Richtig, die Lagertemperaturangabe ist einzuhalten. Der Kühlschrank sollte an der kältesten Temperaturangabe ausgerichtet sein. Das MHD ist eine Garantie des Herstellers, dass bis zum angegebenen Zeitpunkt, in Verbindung mit der angegebenen Lagertemperatur, das Lebensmittel die vom Hersteller bestimmte Qualität und den mikrobiologischen Zustand behält. Ist das MHD abgelaufen, ist es so, als ob man das Produkt selber hergestellt hat und man auch die volle Verantwortung dafür trägt. Allerdings ist auch jedem bekannt, dass zum Beispiel bei einem Joghurt, welcher 7 Tage nach Ablauf des MHD’s verzehrt wird, sich vielleicht ein wenig Wasser abgesetzt hat oder die Farbe der Fruchtmischung durchscheint, genießbar ist er aber immer noch. Vorsicht: Bitte nicht das MHD mit dem Verbrauchsdatum verwechseln!',
        'right' => 1,
    ),
    365 => 
    array (
        'id' => 387,
        'question_id' => 96,
        'text' => 'Das MHD ist eine Garantie des Herstellers, dass bis zum angegebenen Zeitpunkt, in Verbindung mit der angegebenen Lagertemperatur, das Lebensmittel die vom Hersteller bestimmte Qualität und den mikrobiologischen Zustand behält.',
        'explanation' => 'Richtig, ist das MHD abgelaufen, ist es so, als ob man das Produkt selber hergestellt hat und man auch die volle Verantwortung dafür trägt. Allerdings ist auch jedem bekannt, dass zum Beispiel bei einem Joghurt, welcher 7 Tage nach Ablauf des MHD’s verzehrt wird, sich vielleicht ein wenig Wasser abgesetzt hat oder die Farbe der Fruchtmischung durchscheint, genießbar ist er aber immer noch. Setze also Deine Sinne Sehen, Riechen, Schmecken ein. Die Lagertemperaturangabe ist einzuhalten. Der Kühlschrank sollte an der kältesten Temperaturangabe ausgerichtet sein. Vorsicht: Bitte nicht das MHD mit dem Verbrauchsdatum verwechseln!',
        'right' => 1,
    ),
    366 => 
    array (
        'id' => 388,
        'question_id' => 96,
        'text' => 'Lebensmittel mit abgelaufenem MHD dürfen grundsätzlich nicht weiterverteilt werden, wenn deren Verpackung bereits geöffnet wurde.',
        'explanation' => 'Falsch, Lebensmittel in geöffneter Verpackung dürfen weitergegeben werden, wenn der Zeitpunkt des Öffnens bekannt ist, und nicht weit zurück liegt, besonders bei gekühlten Lebensmitteln. Nach dem Öffnen der Packungen mit MHD ist die Haltbarkeit meist erheblich kürzer. Setze also Deine Sinne Sehen, Riechen und Schmecken ein. Natürlich müssen auch diese Produkte ausreichend kühl gelagert werden. Bitte beachte hierfür die Angaben auf der Verpackung. Manche Lebensmittel müssen nur dann gekühlt werden, wenn die Verpackung bereits geöffnet wurde. Vorsicht: Bitte nicht das MHD mit dem Verbrauchsdatum verwechseln!',
        'right' => 0,
    ),
    367 => 
    array (
        'id' => 394,
        'question_id' => 98,
        'text' => 'Der/die BotschafterIn kann danach den neuen Foodsaver verifizieren und eine Ausweisvorlage per Mail zuschicken, damit diese ausgedruckt und laminiert wird.',
        'explanation' => 'Falsch, die Ausweise werden nie per Mail verschickt, sondern nur persönlich durch den/die BotschafterIn bzw. einer Vertrauensperson von ihr/ihm. Erst nach Kontrolle der Richtigkeit der Angaben mit einem Ausweisdokument, darf der Ausweis überreicht werden. ',
        'right' => 0,
    ),
    368 => 
    array (
        'id' => 395,
        'question_id' => 98,
        'text' => 'Er/Sie erkundigt sich, ob alles verstanden wurde oder es noch offene Fragen gibt.',
        'explanation' => 'Richtig, wenn es denn noch offene Fragen gibt, werden diese beantwortet.',
        'right' => 1,
    ),
    369 => 
    array (
        'id' => 396,
        'question_id' => 98,
        'text' => 'Nichts, alle weitere Schritte müssen vom Foodsaver ausgehen.',
        'explanation' => 'Falsch, der/die BotschafterIn setzt sich mit dem Foodsaver in Verbindung und dieser/diese erhält nach Kontrolle der Richtigkeit der Angaben mit einem Ausweisdokument seinen/ihren Ausweis',
        'right' => 0,
    ),
    370 => 
    array (
        'id' => 397,
        'question_id' => 98,
        'text' => 'Unpassendes Verhalten wie etwa Unpünktlichkeit, Raffgier oder unhöflichem Verhalten wird sofort als Verstoß gemeldet, so können Probleme gleich behoben werden und Fehlverhalten schleicht sich nicht ein. Neben der Verstoßmeldung ist es wichtig dem Neuling direkt bei der Einführungsabholung über sein Fehlverhalten zu informieren und zu erklären was falsch lief bzw. wie es richtig gemacht wird.',
        'explanation' => 'Richtig, so kann sofort reagiert werden und Probleme können gleich behoben werden, sodass sich ein Fehlverhalten erst gar nicht einschleicht. Auch die Meldung von kleineren Verstößen, die ohne direkte Konsequenzen für betroffene Foodsaver bleiben sollen, ist wichtig, damit Wiederholungsfälle später ggf. als solche erkennbar sind und entsprechend reagiert werden kann.',
        'right' => 1,
    ),
    371 => 
    array (
        'id' => 398,
        'question_id' => 99,
        'text' => 'Er bringt seine unterschriebene Rechtsvereinbarung zur BotschafterIn und bekommt dort seinen Ausweis.',
        'explanation' => 'Falsch, es ist nicht notwendig und gleichzeitig Papierverschwendung die Rechtsvereinbarung auszudrucken, aber der Foodsaver kann den Ausweis bei der/dem BotschafterIn erst entgegennehmen wenn die Daten mit den vom Personalausweis oder Reisepass abgeglichen wurden. Sollten die Daten übereinstimmen, kann der Ausweis ausgehändigt werden.',
        'right' => 0,
    ),
    372 => 
    array (
        'id' => 399,
        'question_id' => 99,
        'text' => 'Er kann ihn bei dem Botschafter abholen, dabei muss der Ausweis auf die Richtigkeit der Daten kontrolliert werden.',
        'explanation' => 'Richtig, der Foodsaverausweis muss mit einem Personalausweis oder Reisepass abgeglichen werden, sollten die Daten übereinstimmen, kann der Ausweis ausgehändigt werden.',
        'right' => 1,
    ),
    373 => 
    array (
        'id' => 400,
        'question_id' => 99,
        'text' => 'Er bekommt das pdf-Dokument zugemailt und kann dieses selber ausdrucken und laminieren.',
        'explanation' => 'Falsch, er kann ihn bei der ausstellenden Person abholen, dabei muss der Ausweis mit einem Personalausweis oder Reisepass abgeglichen werden, sollten die Daten übereinstimmen, kann der Foodsaverausweis ausgehändigt werden.',
        'right' => 0,
    ),
    374 => 
    array (
        'id' => 401,
        'question_id' => 99,
        'text' => 'Er kann sich beim Einwohnermeldeamt seines Wohnortes melden, da der Ausweis dort ausgestellt und die Identität geprüft wird. Ich muss ihn auf Lebensmittelretten.de nur auf verifiziert stellen, damit das Einwohnermeldeamt benachrichtigt wird.',
        'explanation' => 'Falsch, das Einwohnermeldeamt hat nichts mit foodsharing und Lebensmittelretten zu tun. Der Foodsaver kann ihn bei der ausstellenden Person abholen, dabei muss der Ausweis mit einem Personalausweis oder Reisepass abgeglichen werden, sollten die Daten übereinstimmen, kann der Foodsaverausweis ausgehändigt werden.',
        'right' => 0,
    ),
    375 => 
    array (
        'id' => 405,
        'question_id' => 101,
        'text' => 'Ich bin froh, dass ich meinen Foodsharing Ausweis dabei habe und zeige ihn der Mitarbeiterin mit den Worten: “Ich bin von Foodsharing und könnte sofort alles mitnehmen?”',
        'explanation' => 'Falsch, bitte nie einen Laden im Namen von foodsharing ansprechen, wenn Du nicht vorher in Erfahrung gebracht hast, wie die aktuelle Abholsituation ist: sprich - wer wann wie was von den Foodsavern abholt. Das wirkt sonst unprofessionell und nicht koordiniert.',
        'right' => 0,
    ),
    376 => 
    array (
        'id' => 407,
        'question_id' => 101,
        'text' => 'Ich frage die Mitarbeiterin, ohne zu erwähnen, dass ich von Foodsharing bin: “Entschuldigung, aber können sie mir verraten, was sie mit den abgeschriebenen Lebensmitteln machen?”',
        'explanation' => 'Dies wäre der Idealfall! So erfährt man mehr über den Laden und nutzt die Gelegenheit mit der Mitarbeiterin bzw. Filialverantwortlichen allgemein über das Thema zu reden. Du kannst ggf. auf erfolgreiche Kooperationspartner von Foodsharing hinweisen und später den Betrieb eintragen, oder dem Betriebsverantwortichen schreiben, was Du in Erfahrung gebracht hast. Wichtig ist es, dabei als Privatperson aufzutreten und nicht als Repräsentant des Netzwerks.',
        'right' => 1,
    ),
    377 => 
    array (
        'id' => 408,
        'question_id' => 101,
        'text' => 'Ich beobachte das Geschehen, ohne irgendwas zu sagen.',
        'explanation' => 'Grundsätzlich richtig, aber immer eine schöne Gelegenheit die/den MitarbeiterIn/FilialleiterIn auf das Thema hinzuweisen und in Erfahrung zu bringen, wie sie damit umgehen. Diese Informationen ggf. auf die Betriebspinnwand schreiben bzw. dem/der Filialverantwortlichen mitteilen. Wichtig ist es, dabei als Privatperson aufzutreten und nicht als RepräsentantIn des Netzwerks. Bitte nie ohne Absprache mit dem/der zuständigen BotschafterIn eine Mitarbeiterin/Filialleitung im Namen von Foodsharing/Lebensmittelretten ansprechen. Das wirkt unprofessionell und nicht koordiniert.',
        'right' => 2,
    ),
    378 => 
    array (
        'id' => 409,
        'question_id' => 101,
        'text' => 'Ich bin selbst bei foodsharing Betriebsverantwortlicher für einen Betrieb und frage die Geschäftsleitung, ob sie schon was von foodsharing gehört hat und ob sie mitmachen möchte?',
        'explanation' => 'Falsch. Grundsätzlich bitte immer alle Kooperationsanfragen mit den zuständigen BotschafterInnen absprechen. Sonst kann es gegenüber der Geschäftsleitung unprofessionell und unkoordiniert wirken.
Du kannst natürlich, ohne foodsharing zu erwähnen, die Gelegenheit nutzen und Mitarbeitende bzw. die Geschäftsleitung fragen, was mit den Abschriften passiert und ggf. auf erfolgreiche Kooperationspartner von foodsharing hinweisen und später den Betrieb eintragen oder dem bereits vorhandenen Betriebsverantwortlichen schreiben, was Du in Erfahrung gebracht hast. Wichtig ist es, dabei als Privatperson aufzutreten und nicht als Repräsentant des Netzwerks. Höchstens, wenn sie z. B. foodsharing erwähnen und froh sind über eine etwaige Zusammenarbeit.',
        'right' => 0,
    ),
    379 => 
    array (
        'id' => 410,
        'question_id' => 102,
        'text' => 'Ich melde den Verstoß gegen die Verhaltensregeln und warte bis sich jemand vom Orgateam um den Botschafter kümmert.',
        'explanation' => 'Falsch, da Du als BotschafterIn für alle BotschafterInnen, Filialverantwortlichen und Foodsaver in Deiner Region/Stadt oder Bezirk verantwortlich bist, musst Du Dich, nachdem Du den Verstoß gemeldet hast, selber um den Fall kümmern. Dafür setzt Du Dich schnellstmöglich mit dem/der betreffenden BezirksbotschafterIn in Kontakt und erklärst, dass, wie in den Verhaltensregeln beschrieben, alle Abholungen ausschließlich über die Plattform laufen dürfen. Das Eintragen aller Abholungen, wer wann mit wem abholt, ist essenziell um zu gewährleisten, dass Probleme früh erkannt werden und ist auch die einzige Garantie, dass der Ruf von foodsharing bewahrt bleibt und unser Versprechen an die Betriebe, dass nur Menschen, die die Rechtsvereinbarung angenommen haben, abholen können, auch eingehalten wird.',
        'right' => 0,
    ),
    380 => 
    array (
        'id' => 411,
        'question_id' => 102,
        'text' => 'Ich melde den Verstoß gegen die Verhaltensregeln und setze mich schnellstmöglich mit diesem Bezirksbotschafter in Kontakt, um das Vergehen gegen die Verhaltensregeln zu erläutern.',
        'explanation' => 'Richtig, Du als BotschafterIn bist für alle BotschafterInnen, Filialverantwortlichen und Foodsaver in Deiner Region/Stadt oder Bezirk verantwortlich und musst Dich, nachdem Du den Verstoß gemeldet hast, selber um den Fall kümmern. Dafür setzt Du Dich schnellstmöglich mit dem Bezirksbotschafter in Kontakt und erklärst, dass, wie in den Verhaltensregeln beschrieben, alle Abholungen ausschließlich über die Plattform laufen dürfen. Das Eintragen aller Abholungen, wer wann mit wem abholt, ist essenziell um zu gewährleisten, dass Probleme früh erkannt werden und ist auch die einzige Garantie, dass der Ruf von foodsharing bewahrt bleibt und unser Versprechen an die Betriebe, dass nur Menschen, die die Rechtsvereinbarung angenommen haben, abholen können, auch eingehalten wird.',
        'right' => 1,
    ),
    381 => 
    array (
        'id' => 412,
        'question_id' => 102,
        'text' => 'Ich kenne den Bezirksbotschafter persönlich und habe einen guten Draht zu ihm, deswegen unternehme ich nichts, weil ich vollstes Vertrauen in ihn habe und er außerdem 4 Vertrauensbananen hat.',
        'explanation' => 'Falsch, da Du als BotschafterIn für alle BotschafterInnen, Filialverantwortlichen und Foodsaver in Deiner Region/Stadt oder Bezirk verantwortlich bist, musst Du den Verstoß melden und Dich dann selber um den Fall kümmern. Dafür setzt Du Dich schnellstmöglich mit demjenigen Bezirksbotschafter in Kontakt und erklärst, dass, wie in den Verhaltensregeln beschrieben, alle Abholungen ausschließlich über die Plattform laufen dürfen. Das Eintragen aller Abholungen, wer wann mit wem abholt, ist essenziell um zu gewährleisten, dass Probleme früh erkannt werden und ist auch die einzige Garantie, dass der Ruf von foodsharing bewahrt bleibt und unser Versprechen an die Betriebe, dass nur Menschen, die die Rechtsvereinbarung angenommen haben, abholen können, auch eingehalten wird. Die Anzahl der Vertrauensbananen des Botschafters sagt nichts über die Zuverlässigkeit der Menschen aus, die irgendwo, ohne auf der Plattform registriert zu sein, bzw. die Verhaltensregeln nicht ganzheitlich begriffen haben, Lebensmittel bei diesem Betrieb abholen.',
        'right' => 0,
    ),
    382 => 
    array (
        'id' => 413,
        'question_id' => 102,
        'text' => 'Ich mache erst mal gar nichts und schaue noch mal in 1-2 Wochen auf der Betriebsseite vorbei und hoffe, dass sich bis dahin alles von alleine gelöst hat. Sollte sich aber bis dahin immer noch nichts geändert haben, würde ich einen Verstoß gegen die Verhaltensregeln melden und mich mit dem Botschafter in Kontakt setzen, um das Problem zu besprechen.',
        'explanation' => 'Falsch, Verstöße gegen die Verhaltensregeln dürfen nie schleifen gelassen werden. Du als BotschafterIn bist für alle BotschafterInnen, Betriebsverantwortlichen und Foodsaver in Deiner Region/Stadt oder Bezirk verantwortlich und musst Dich, nachdem Du den Verstoß gemeldet hast, selber um den Fall kümmern. Dafür setzt Du Dich schnellstmöglich mit demjenigen Bezirksbotschafter in Kontakt und erklärst, dass, wie in den Verhaltensregeln beschrieben, alle Abholungen ausschließlich über die Plattform laufen dürfen. Das Eintragen aller Abholungen, wer wann mit wem abholt, ist essenziell um zu gewährleisten, dass Probleme früh erkannt werden und ist auch die einzige Garantie, dass der Ruf von foodsharing bewahrt bleibt und unser Versprechen an die Betriebe, dass nur Menschen, die die Rechtsvereinbarung angenommen haben, abholen können, auch eingehalten wird.',
        'right' => 0,
    ),
    383 => 
    array (
        'id' => 414,
        'question_id' => 103,
        'text' => 'Im Herbst 2012',
        'explanation' => 'Leider falsch, richtig ist, dass nach über 16 Monaten Organisation aller Lebensmittelretter vor allem in Berlin über Gmail Konten, Excel Tabellen, Telefonlisten und Ausweisen, die in mühevoller Arbeit in Word manuell editiert wurden, Raphael Wintrich, im Frühjahr 2013 mit der Programmierung einer kleinen Software anfing, die nach monatelanger Entwicklung im August 2013 in der Betaversion online ging.',
        'right' => 0,
    ),
    384 => 
    array (
        'id' => 415,
        'question_id' => 103,
        'text' => 'Zeitgleich mit dem Start von foodsharing.de im Jahr 2012',
        'explanation' => 'Leider falsch, richtig ist, dass nach über 16 Monaten Organisation aller Lebensmittelretter vor allem in Berlin über Gmail Konten, Excel Tabellen, Telefonlisten und Ausweisen, die in mühevoller Arbeit in Word manuell editiert wurden, Raphael Wintrich, im Frühjahr 2013 mit der Programmierung einer kleinen Software anfing, die nach monatelanger Entwicklung im August 2013 in der Betaversion online ging.',
        'right' => 0,
    ),
    385 => 
    array (
        'id' => 416,
        'question_id' => 103,
        'text' => 'Im Sommer 2013',
        'explanation' => 'Richtig, nach über 16 Monaten Organisation aller LebensmittelretterInnen vor allem in Berlin durch Raphael Fellmer, über Gmail Konten, Excel Tabellen, Telefonlisten und Ausweisen, die in mühevoller Arbeit in Word manuell editiert wurden, fing im Frühjahr 2013 Raphael Wintrich mit der Programmierung einer kleinen Software an, die nach monatelanger Entwicklung im August 2013 in der Betaversion online ging.',
        'right' => 1,
    ),
    386 => 
    array (
        'id' => 417,
        'question_id' => 103,
        'text' => 'zu Weihnachten 2013',
        'explanation' => 'Leider falsch, richtig ist, dass nach über 16 Monaten Organisation aller Lebensmittelretter vor allem in Berlin, über Gmail Konten, Excel Tabellen, Telefonlisten und Ausweisen, die in mühevoller Arbeit in Word manuell editiert wurden, Raphael Wintrich, im Frühjahr 2013 mit der Programmierung einer kleinen Software anfing, die nach monatelanger Entwicklung im August 2013 in der Betaversion online ging.',
        'right' => 0,
    ),
    387 => 
    array (
        'id' => 418,
        'question_id' => 104,
        'text' => 'Seit Jahren ist das Abholen von nicht verkäuflichen Lebensmitteln gängige Praxis, der Ursprung des Lebensmittelrettens liegt jedoch in Berlin, wo Sabine Werth im Jahr 1994 die 1. Tafel in Deutschland gründete.',
        'explanation' => 'Falsch, obwohl die Tafeln schon seit 1994 Millionen Tonnen von Lebensmitteln vor der Vernichtung bewahrt haben, basiert dagegen die Idee der Tafeln auf dem Abholen von unverkäuflichen Lebensmitteln, die von einem Betrieb an einem Verein weitergegeben werden, die anschließend ausschließlich an Bedürftige weitergegeben bzw. verkauft werden dürfen. Richtig ist: Raphael Fellmer entwickelte in Berlin in Dank der Zusammenarbeit mit der Bio Company das Konzept des heutigen Lebensmittelrettens. Zunächst wurde ihm zugebilligt, an einer Filiale, die vorher von ihm aus der Tonne geholten abgeschriebenen Waren, zukünftig legal abzuholen. Später erarbeitete er mit einer Anwaltskanzlei eine nicht auf einem Betrieb festgelegte Rechtsvereinbarung, welche von allen Lebensmittelrettenden unterschrieben werden muss, in der die Haftungsbeschränkung für die Lebensmittelspenderbetriebe gesichert wurde. Dieses wurde die Grundlage für das heutige Konzept des Rettens von unverkäuflichen Waren, wobei die Lebensmittelrettenden die Verantwortung tragen und eigenständig die Genießbarkeit der Waren überprüfen und bei Weitergabe sowie Eigenkonsum keine Regressansprüche stellen können. Raphael Fellmer organisierte die sich in Berlin rasant wachsende Gruppe von Lebensmittelrettenden und bekam immer mehr Hilfe von anderen Freiwilligen, die sich gegen die Verschwendung einsetzen wollten. Die Effizienz der Organisation war mäßig und erst dank der genialen Programmierkünste von Raphael Wintrich, der die Plattform Lebensmittelretten.de zusammen mit Raphael Fellmer für den gesamten deutschsprachigen Raum entwickelte, konnte das Konzept massentauglich werden.',
        'right' => 0,
    ),
    388 => 
    array (
        'id' => 419,
        'question_id' => 104,
        'text' => 'Ein innovativer Verein in Potsdam hat im Jahr 2011 das Konzept in Zusammenarbeit mit der lokalen Tafel entwickelt.',
        'explanation' => 'Falsch, Raphael Fellmer entwickelte in Berlin in Zusammenarbeit mit der Bio Company das Konzept des heutigen Lebensmittelrettens. Zunächst wurde ihm zugebilligt, an einer Filiale die vorher von ihm aus der Tonne geholten abgeschriebenen Waren, zukünftig legal abzuholen. Später erarbeitete er mit einer Anwaltskanzlei eine nicht auf einem Betrieb festgelegte Rechtsvereinbarung, welche von allen Lebensmittelrettenden unterschrieben werden muss, in der die Haftungsbeschränkung für die Lebensmittelspenderbetriebe gesichert wurde. Dieses wurde die Grundlage für das heutige Konzept des Rettens von unverkäuflichen Waren, wobei die Lebensmittelrettenden die Verantwortung tragen und eigenständig die Genießbarkeit der Waren überprüfen und bei Weitergabe sowie Eigenkonsum keine Regressansprüche stellen können. Raphael Fellmer organisierte die sich in Berlin rasant wachsende Gruppe von Lebensmittelrettenden und bekam immer mehr Hilfe von anderen Freiwilligen, die sich gegen die Verschwendung einsetzen wollten. Die Effizienz der Organisation war mäßig und erst dank der genialen Programmierkünste von Raphael Wintrich, der die Plattform Lebensmittelretten.de zusammen mit Raphael Fellmer für den gesamten deutschsprachigen Raum entwickelte, konnte das Konzept massentauglich werden.',
        'right' => 0,
    ),
    389 => 
    array (
        'id' => 420,
        'question_id' => 104,
        'text' => 'Valentin Thurn hat sich im Laufe seiner Dreharbeiten zu dem Film “Taste the Waste”, mit verschiedenen Organisationen zusammengeschlossen, um ein nachhaltiges, effizientes und dezentrales Konzept gegen die Verschwendung von Lebensmitteln zu entwerfen, daraus entstanden ist die Idee des Lebensmittelrettens wie es heute bei foodsharing praktiziert wird.',
        'explanation' => 'Falsch, Raphael Fellmer entwickelte in Berlin in Zusammenarbeit mit der Bio Company das Konzept des heutigen Lebensmittelrettens. Zunächst wurde ihm zugebilligt, an einer Filiale die vorher von ihm aus der Tonne geholten abgeschriebenen Waren, zukünftig legal abzuholen. Später erarbeitete er mit einer Anwaltskanzlei eine nicht auf einem Betrieb festgelegte Rechtsvereinbarung, welche von allen Lebensmittelrettenden unterschrieben werden muss, in der die Haftungsbeschränkung für die Lebensmittelspenderbetriebe gesichert wurde. Dieses wurde die Grundlage für das heutige Konzept des Rettens von unverkäuflichen Waren, wobei die Lebensmittelrettenden die Verantwortung tragen und eigenständig die Genießbarkeit der Waren überprüfen und bei Weitergabe sowie Eigenkonsum keine Regressansprüche stellen können. Raphael Fellmer organisierte die sich in Berlin rasant wachsende Gruppe von Lebensmittelrettenden und bekam immer mehr Hilfe von anderen Freiwilligen, die sich gegen die Verschwendung einsetzen wollten. Die Effizienz der Organisation war mäßig und erst dank der genialen Programmierkünste von Raphael Wintrich, der die Plattform Lebensmittelretten.de zusammen mit Raphael Fellmer für den gesamten deutschsprachigen Raum entwickelte, konnte das Konzept massentauglich werden.',
        'right' => 0,
    ),
    390 => 
    array (
        'id' => 421,
        'question_id' => 104,
        'text' => 'Nach jahrelangem Containern hatte ein Mülltaucher die Idee, die nicht mehr verkäuflichen Lebensmittel, die tagtäglich von Betrieben entsorgt werden, durch ein innovatives Konzept in Zusammenarbeit mit einem Supermarkt vor dem Wurf in die Tonne zu bewahren.',
        'explanation' => 'Richtig, Raphael Fellmer entwickelte in Berlin in Zusammenarbeit mit der Bio Company das Konzept des heutigen Lebensmittelrettens. Zunächst wurde ihm zugebilligt, an einer Filiale die vorher von ihm aus der Tonne geholten abgeschriebenen Waren, zukünftig legal abzuholen. Später erarbeitete er mit einer Anwaltskanzlei eine nicht auf einem Betrieb festgelegte Rechtsvereinbarung, welche von allen Lebensmittelrettenden unterschrieben werden muss, in der die Haftungsbeschränkung für die Lebensmittelspenderbetriebe gesichert wurde. Dieses wurde die Grundlage für das heutige Konzept des Rettens von unverkäuflichen Waren, wobei die Lebensmittelrettenden die Verantwortung tragen und eigenständig die Genießbarkeit der Waren überprüfen und bei Weitergabe sowie Eigenkonsum keine Regressansprüche stellen können. Raphael Fellmer organisierte die sich in Berlin rasant wachsende Gruppe von Lebensmittelrettenden und bekam immer mehr Hilfe von anderen Freiwilligen, die sich gegen die Verschwendung einsetzen wollten. Die Effizienz der Organisation war mäßig und erst dank der genialen Programmierkünste von Raphael Wintrich, der die Plattform Lebensmittelretten.de zusammen mit Raphael Fellmer für den gesamten deutschsprachigen Raum entwickelte, konnte das Konzept massentauglich werden.',
        'right' => 1,
    ),
    391 => 
    array (
        'id' => 422,
        'question_id' => 105,
        'text' => 'Ja, damit sich der Verhaltensregelverstoß nicht wiederholt und dem Foodsaver bewusst wird, dass es sich bei dem Lebensmittelretten um eine ernste Sache handelt, und nur durch ein faires Miteinander eine schöne Atmosphäre unter den Engagierten von foodsharing herrschen kann. ',
        'explanation' => 'Richtig, nur wenn wir auch kleine Vergehen gegen die Verhaltensregeln als Verstoß melden, ist es möglich, sich auf diese zu beziehen, wenn z.B. der/die Foodsaver an einen anderen Ort zieht oder Du als BotschafterIn umziehst. Das persönliche Gespräch mit dem Foodsaver der einen Regelverstoß begangen hat ist gewünscht, damit es von erst garnicht zu größeren Missverständnissen kommt. Außerdem ist nur durch das Melden des Verstoßes gewährleistet, dass ein Überblick über alle Regelverstöße des Foodsavers für das Verstoßmeldungsteam vorhanden sind, um bei wiederholtem Auftreten sofort eingreifen zu können, bevor sich ein größeres Problem entwickelt.',
        'right' => 1,
    ),
    392 => 
    array (
        'id' => 423,
        'question_id' => 105,
        'text' => 'Nein, das Melden von Verhaltensregelverstößen ist nur wichtig, wenn ich die Person nicht so gut kenne.',
        'explanation' => 'Falsch, auch wenn wir die Person, die sich nicht den Verhaltensregeln entsprechend verhalten hat kennen, ist es wichtig, auch kleine Verstöße gegen die Verhaltensregeln als Verstoß melden, nur so ist es möglich, sich auf diese später zu beziehen, wenn z.B. der/die Foodsaver an einen anderen Ort zieht oder Du als BotschafterIn umziehst. Nur so ist gewährleistet, dass das Verstoßmeldungsteam einen Überblick über alle Regelverstöße des Foodsavers hat, um bei wiederholtem Auftreten sofort eingreifen zu können, bevor sich ein größeres Problem entwickelt.',
        'right' => 0,
    ),
    393 => 
    array (
        'id' => 424,
        'question_id' => 105,
        'text' => 'Nein, das Melden von Verhaltensregelverstößen von Foodsavern aus meiner Region/Stadt, ist nicht meine Aufgabe, da die Foodsaver sich gegen den Kopf gestoßen fühlen könnten.',
        'explanation' => 'Falsch, alle Verstoßmeldungen werden exklusiv angezeigt und sind nicht für alle anderen sichtbar. Selbstverständlich ist es aber Deine Aufgabe, wie alle anderen Foodsaver auch, sämtliche Verhaltensregelverstöße zu melden. Nur so ist gewährleistet, dass das Verstoßmeldungsteam einen Überblick über alle Regelverstöße des Foodsavers hat, um bei wiederholtem Auftreten sofort eingreifen zu können, bevor sich ein größeres Problem entwickelt.',
        'right' => 0,
    ),
    394 => 
    array (
        'id' => 425,
        'question_id' => 105,
        'text' => 'Ja, es ist wichtig, alle Verstöße gegen die Verhaltensregeln zu melden, aber da ich den gleichen Verhaltensregelverstoß bei dieser Person bereits gemeldet habe, muss ich das Wiederholen von einem gleichen Fehlverhalten nicht doppelt melden.',
        'explanation' => 'Falsch, auch wenn Du dasselbe Fehlverhalten bereits als Verstoß gemeldet hast, ist es auch die Aufgabe von allen Foodsavern, Betriebsverantwortlichen und BotschafterInnen, alle Regelverstöße unabhängig von wiederholtem Auftreten, Freunschaften, persönlichen Beziehungen oder Ähnliches zu melden, denn nur wenn wir auch kleine Vergehen gegen die Verhaltensregeln als Verstoß melden, ist es möglich, sich auf diese zu beziehen, wenn z.B. der/die Foodsaver an einen anderen Ort zieht, Du als BotschafterIn umziehst oder später weitere Regelverstöße auftreten. Nur so ist gewährleistet, dass das Verstoßmeldungsteam einen Überblick über alle Regelverstöße des Foodsavers hat, um bei wiederholtem Auftreten sofort eingreifen zu können, bevor sich ein größeres Problem entwickelt.',
        'right' => 0,
    ),
    395 => 
    array (
        'id' => 426,
        'question_id' => 106,
        'text' => 'Der Foodsaver muss die Gebühr für den Ausweis bezahlt haben.',
        'explanation' => 'Falsch, der Foodsaver erhält seinen Ausweis natürlich kostenlos.',
        'right' => 0,
    ),
    396 => 
    array (
        'id' => 427,
        'question_id' => 106,
        'text' => 'Der Foodsaver muss drei Einführungsabholungen durchgeführt haben.',
        'explanation' => 'Richtig, die drei Einführungsabholungen führe ich entweder persönlich mit dem neuen Foodsaver durch, oder eine von mir ernannte Vertrauensperson übernimmt dies.',
        'right' => 1,
    ),
    397 => 
    array (
        'id' => 428,
        'question_id' => 107,
        'text' => 'Ich mache gar nichts, weil ich nicht für das Verhalten der Foodsaver verantwortlich bin.',
        'explanation' => 'Falsch, große Ketten werden nur vom Betriebsketten-Team angesprochen. Versuche den Foodsaver, wenn möglich durch einen Anruf noch aufzuhalten, denn als BotschafterIn trägst Du durchaus auch Verantwortung für deine Foodsaver.',
        'right' => 0,
    ),
    398 => 
    array (
        'id' => 429,
        'question_id' => 106,
        'text' => 'Der Foodsaver muss sich über den Personalausweis oder Reisepass ausweisen können.',
        'explanation' => 'Richtig, es ist wichtig dass die Foodsaver auch ganz sicher die sind die sie vorgeben zu sein. Das hat rechtliche Gründe u.A. für die Gültigkeit der Rechtsvereinbarung.',
        'right' => 1,
    ),
    399 => 
    array (
        'id' => 430,
        'question_id' => 107,
        'text' => 'Ich rufe sofort bei dem Betrieb an und teile den Mitarbeitenden mit, dass jemand von foodsharing vorbeikommen wird, um nach Lebensmitteln zu fragen, damit sie darauf vorbereitet sind.',
        'explanation' => 'Falsch, große Ketten werden nur vom Betriebsketten-Team angesprochen. Versuche den Foodsaver, wenn möglich, noch telefonisch aufzuhalten, denn als Botschafter trägst Du durchaus auch Verantwortung für deine Foodsaver.',
        'right' => 0,
    ),
    400 => 
    array (
        'id' => 431,
        'question_id' => 107,
        'text' => 'Ich versuche, den Foodsaver telefonisch zu erreichen, um ihn aufzuhalten. Ist er nicht erreichbar, versuche ich, wenn es mir möglich ist, mich zu dem Supermarkt zu begeben, um den Foodsaver noch aufzuhalten.',
        'explanation' => 'Neutral, also wir müssen nicht um jeden Preis den Kontaktversuch unterbinden, aber wenn es möglich ist wäre es natürlich von Vorteil.',
        'right' => 2,
    ),
    401 => 
    array (
        'id' => 432,
        'question_id' => 107,
        'text' => 'Ich freue mich, dass der Foodsaver Eigeninitiative ergreift und einen neuen Betrieb als Kooperationspartner gewinnt. Da er den Betrieb noch nicht von foodsharing angesprochen und noch nicht eingetragen ist, übernehme ich dies.',
        'explanation' => 'Falsch, große Ketten werden nur vom Betriebsketten-Team angesprochen. Versuche den Foodsaver, wenn möglich telefonisch, noch aufzuhalten.',
        'right' => 0,
    ),
    402 => 
    array (
        'id' => 433,
        'question_id' => 107,
        'text' => 'Ich freue mich und fahre sofort los, um den Foodsaver dabei zu unterstützen, da ich im Dokument “Betriebe ansprechen” gelesen habe, dass es besser ist, wenn man einen Betrieb zu zweit bzw. noch besser mit einem/einer BotschafterIn anspricht.',
        'explanation' => 'Falsch, große Ketten werden nur vom Betriebsketten-Team angesprochen. Versuche den Foodsaver, wenn möglich, noch aufzuhalten.',
        'right' => 0,
    ),
    403 => 
    array (
        'id' => 434,
        'question_id' => 108,
        'text' => 'Ich setze mich mit dem Botschafterbegrüßungsteam in Verbindung und erklären meine ungeplante Abwesenheit, damit diese schnellstmöglich eine Vertretung finden können.',
    'explanation' => 'Falsch, um eine Vertretung musst Du Dich selbst kümmern und sie einarbeiten. Wenn ihr in der Stadt/Region ein großes und sehr belastbares BotschafterInnen-Team habt, kann das Team Deine Abwesenheit vielleicht auch ohne Vertretung ausgleichen. Das solltet ihr aber auf jeden Fall gemeinsam absprechen. Für die Zeit in der Du Abwesend bist ziehst Du dir eine Schlafmütze an (möglich unter Einstellungen).',
        'right' => 0,
    ),
    404 => 
    array (
        'id' => 435,
        'question_id' => 108,
        'text' => 'Wir sind ein Team von mehreren BotschafterInnen in meiner Stadt und ergänzen uns gut. Deshalb können diese auch ohne mich weiterhin gut die Situation managen.',
    'explanation' => 'Evtl. richtig, aber Du musst auf jeden Fall deine Abwesenheit kommunizieren und sichergehen, dass die anderen BotschafterInnen deines Bezirks/Region ohne Deine Hilfe auskommen. Andernfalls musst Du eine Vertretung finden. Für die Zeit in der Du Abwesend bist ziehst Du dir eine Schlafmütze an (möglich unter Einstellungen).',
        'right' => 2,
    ),
    405 => 
    array (
        'id' => 436,
        'question_id' => 108,
        'text' => 'Einem mir vertrauten Foodsaver gebe ich meine Zugangsdaten und eine Einführung. Außerdem erkläre ihm, auf was er während meiner Abwesenheit besonders zu achten hat.',
    'explanation' => 'Falsch, gib Deine Zugangsdaten nicht an Andere weiter. Der Foodsaver sollte sich als BotschafterIn bewerben und muss das Quiz bestehen. Nach einer Einweisung von Dir kann er die BotschafterInnen-Rolle übernehmen. Für die Zeit in der Du abwesend bist ziehst Du dir eine Schlafmütze an (möglich unter Einstellungen).',
        'right' => 0,
    ),
    406 => 
    array (
        'id' => 437,
        'question_id' => 108,
        'text' => 'Ich informiere die Foodsaver und anderen BotschafterInnen in meinem Bezirk/Region im Forum über meine Abwesenheit.',
    'explanation' => 'Richtig, Transparenz und Kommunikation sind wichtig, damit das Vertrauen erhalten bleibt und niemand überrascht/überrumpelt wird. Du musst Dich um eine Vertretung kümmern und diese einarbeiten. Für die Zeit in der Du Abwesend bist ziehst Du dir eine Schlafmütze an (möglich unter Einstellungen).',
        'right' => 1,
    ),
    407 => 
    array (
        'id' => 438,
        'question_id' => 108,
        'text' => 'Wenn es in meinem Bezirk/Region einen aktiven Foodsaver gibt, dem ich die Aufgabe zutraue, frage ich ihn, ob er sich als BotschafterIn upgraden will und mich in meiner Abwesenheit vertreten kann.',
    'explanation' => 'Richtig, das kannst Du machen, informiere aber in jedem Fall die anderen BotschafterInnen Deiner Bezirk/Region und weise den/die neue BotschafterIn gut ein. Für die Zeit in der Du Abwesend bist ziehst Du dir eine Schlafmütze an (möglich unter Einstellungen).',
        'right' => 1,
    ),
    408 => 
    array (
        'id' => 439,
        'question_id' => 109,
        'text' => 'Anders als Foodsaver werde ich als BotschafterIn zum Mitglied des foodsharing Vereins, trotzdem erhalte ich aber keine Bezahlung, doch der foodsharing Verein zahlt für mich Beiträge in die Rentenkasse.',
        'explanation' => 'Falsch, eine finanzielle Vergütung in irgendeiner Form bietet foodsharing nicht, die Plattform funktioniert auf einer geldfreien Basis und dadurch, dass sich die Menschen aus innerer Motivation einbringen.',
        'right' => 0,
    ),
    409 => 
    array (
        'id' => 440,
        'question_id' => 109,
        'text' => 'Foodsaver gelten als ehrenamtliche HelferInnen, als BotschafterIn bin ich jedoch als VollzeithelferIn berechtigt einen gewissen finanziellen Zuschuss vom foodsharing Verein zu erhalten. ',
        'explanation' => 'Falsch, eine finanzielle Vergütung in irgendeiner Form gibt es bei foodsharing nicht, die Plattform funktioniert auf einer geldfreien Basis und dadurch, dass sich die Menschen aus innerer Motivation einbringen.',
        'right' => 0,
    ),
    410 => 
    array (
        'id' => 441,
        'question_id' => 109,
        'text' => 'Sollte ich eines Tages arbeitslos werden und nicht mehr für meinen Unterhalt sorgen können, gibt es einen Notpott vom foodsharing Verein der BotschafterInnen in Notlage zur Verfügung steht, bis ich wieder eine Arbeit gefunden habe.',
        'explanation' => 'Falsch, der foodsharing Verein ist nicht dafür da ein komplettes soziales Sicherungssystem bereitzustellen, dafür gibt es andere Institutionen. Das oberste Ziel ist es, die Lebensmittelverschwendung zu beenden. Die Plattform funktioniert auf einer geldfreien Basis und darauf, dass sich die Menschen aus innerer Motivation einbringen.',
        'right' => 0,
    ),
    411 => 
    array (
        'id' => 442,
        'question_id' => 109,
        'text' => 'Du bist Teil einer inspirierenden und engagierten Gemeinschaft, welches Dein Leben in unterschiedlichsten Aspekten bereichern kann.',
        'explanation' => 'Richtig, Du arbeitest mit Menschen zusammen die sich dem Ziel verpflichtet fühlen, die Lebensmittelverschwendung zu beenden. foodsharing funktioniert auf einer geldfreien Basis und darauf, dass sich die Menschen aus innerer Motivation einbringen.',
        'right' => 1,
    ),
    412 => 
    array (
        'id' => 443,
        'question_id' => 110,
    'text' => 'foodsharing und Lebensmittelretten sind unterschiedliche Bezeichnungen (jeweils Englisch und Deutsch) für die selbe Sache.',
        'explanation' => 'Falsch, auf foodsharing.de konnte man ursprünglich nur Essen verschenken welches man selbst nicht mehr benötigt. Lebensmittelretten.de hingegen war das Netzwerk, um Kooperationen mit Supermärkten, Bäckereien, Catering-Unternehmen usw. einzugehen und Lebensmittel, die sonst weggeworfen worden wären, vor der Tonne zu retten sowie die Freiwilligen Foodsaver zu koordinieren, Treffen zu veranstalten usw.',
        'right' => 0,
    ),
    413 => 
    array (
        'id' => 444,
        'question_id' => 110,
    'text' => 'In den ersten Jahren hieß das ganze noch foodsharing, wurde später aber umbenannt, da viele (vor allem ältere Menschen) mit dem Englischen Wort nichts anfangen konnten.',
        'explanation' => 'Falsch, auf foodsharing.de konnte man ursprünglich nur Essen verschenken welches man selbst nicht mehr benötigt. Lebensmittelretten.de hingegen war das Netzwerk, um Kooperationen mit Supermärkten, Bäckereien, Catering-Unternehmen usw. einzugehen und Lebensmittel, die sonst weggeworfen worden wären, vor der Tonne zu retten sowie die Freiwilligen Foodsaver zu koordinieren, Treffen zu veranstalten usw.',
        'right' => 0,
    ),
    414 => 
    array (
        'id' => 445,
        'question_id' => 110,
        'text' => 'Bei ”foodsharing.de” ging es um die Weitergabe von Lebensmitteln von Privatpersonen an andere Privatpersonen und obwohl es auch Betrieben möglich war Lebensmittel anzubieten, machten durch den Mehraufwand nur wenig davon gebrauch. Bei ”Lebensmittelretten.de” wurden auch Handel, Gastronomie, etc. mit eingebunden.',
        'explanation' => 'Richtig, auf foodsharing.de konnte man ursprünglich nur Essen verschenken welches man selbst nicht mehr benötigt. Lebensmittelretten.de hingegen war das Netzwerk, um Kooperationen mit Supermärkten, Bäckereien, Catering-Unternehmen usw. einzugehen und Lebensmittel, die sonst weggeworfen worden wären, vor der Tonne zu retten sowie die Freiwilligen Foodsaver zu koordinieren, Treffen zu veranstalten usw.',
        'right' => 1,
    ),
    415 => 
    array (
        'id' => 446,
        'question_id' => 110,
        'text' => '”Lebensmittelretten.de” war früher die Freiwilligen Plattform von ”foodsharing.de”',
        'explanation' => 'Richtig, auf foodsharing.de konnte man ursprünglich nur Essen verschenken welches man selbst nicht mehr benötigt. Lebensmittelretten.de hingegen war das Netzwerk, um Kooperationen mit Supermärkten, Bäckereien, Catering-Unternehmen usw. einzugehen und Lebensmittel, die sonst weggeworfen worden wären, vor der Tonne zu retten sowie die Freiwilligen Foodsaver zu koordinieren, Treffen zu veranstalten usw.',
        'right' => 1,
    ),
    416 => 
    array (
        'id' => 447,
        'question_id' => 111,
    'text' => 'Ich setze meine Sinne (Sehen, Riechen, Schmecken) ein, um zu bewerten, ob die Lebensmittel noch genießbar sind.
Ich darf sie selbst verzehren bzw. privat direkt weitergeben, wobei ich auf ein evtl. überschrittenes Verbrauchsdatum und die damit verbundenen Risiken hinweise und für evtl. gesundheitliche Folgen die volle Verantwortung trage. Dabei ist es wichtig, dass dies unverzüglich passiert und die riskanten Lebensmittel innerhalb von wenigen Stunden verzehrt werden. 
Ich weiß, dass die in der Frage genannten Lebensmittel generell nicht über foodsharing geteilt werden (dürfen).',
    'explanation' => 'Richtig, grundsätzlich sollte man nichts weitergeben, das man selbst nicht essen würde. Wenn das Verbrauchsdatum (“zu verbrauchen bis…”) abgelaufen ist dürfen die Lebensmittel auch nicht mehr über foodsharing weitergegeben werden.',
        'right' => 1,
    ),
    417 => 
    array (
        'id' => 448,
        'question_id' => 111,
        'text' => 'Ich esse sie lieber nicht selbst, sondern schenke sie Anderen.',
        'explanation' => 'Falsch, wenn Du sie selbst nicht essen würdest solltest Du sie auch nicht an Andere weitergeben. Außerdem bist Du verantwortlich für die Lebensmittel, die Du weitergibst und bürgst für ihre Genießbarkeit. Etwas anderes ist es natürlich, wenn du bestimmte Lebensmittel grundsätzlich nicht isst, aufgrund von Allergien oder weil du dich z.B. vegetarisch oder vegan ernährst. Wenn du sie als bedenkenlos einstufst, solltest du bei der Weitergabe explizid darauf hinweisen, dass du diese vorher nicht probiert hast.',
        'right' => 0,
    ),
    418 => 
    array (
        'id' => 449,
        'question_id' => 111,
        'text' => 'Ich schmeiße lieber alles weg.',
        'explanation' => 'Falsch, natürlich solltest Du nichts weitergeben oder selbst verzehren bei dem Du Zweifel hast, ob es noch genießbar ist. Du solltest aber nicht alles ungesehen wegschmeißen, sondern Deine Sinne wie Sehen, Riechen, Schmecken einsetzen, um noch genießbare Lebensmittel zu finden und auf das Verbrauchsdatum schauen. ',
        'right' => 0,
    ),
    419 => 
    array (
        'id' => 450,
        'question_id' => 111,
    'text' => 'Wenn das Produkt ein Verbrauchsdatum hat (“zu verbrauchen bis…”), welches abgelaufen ist, darf ich es auf keinen Fall über foodsharing weiter teilen bzw. verschenken. Dies gilt nicht für das Mindesthaltbarkeitsdatum (MHD).',
        'explanation' => 'Richtig, Lebensmittel, deren Verbrauchsdatum abgelaufen ist, dürfen nicht mehr über foodsharing weitergegeben werden.',
        'right' => 1,
    ),
    420 => 
    array (
        'id' => 451,
        'question_id' => 112,
    'text' => 'Die Angabe "Verbrauchsdatum" ist gleichbedeutend mit dem Mindeshaltbarkeitsdatum (MHD).',
        'explanation' => 'Falsch, das Verbrauchsdatum und das Mindesthaltbarkeitsdatum unterscheiden sich stark. Auf den Packungen steht dann „zu verbrauchen bis...“ gekoppelt an eine Lagertemperatur, die einzuhalten ist sowie ein Datum. Die Haltbarkeitsdauer der Lebensmittel mit einem Verbrauchsdatum ist meistens schon so weit ausgereizt, dass nach Ablauf des Verbrauchsdatums eine nachteilige mikrobiologische Veränderung sehr gut möglich ist. Zwischen Mindesthaltbarkeitsdatum und Verbrauchsdatum sollte deshalb genau unterschieden werden. Lebensmittel, deren Verbrauchsdatum abgelaufen ist, dürfen nicht mehr weitergegeben werden.',
        'right' => 0,
    ),
    421 => 
    array (
        'id' => 453,
        'question_id' => 112,
        'text' => 'Es befindet sich auf hygienisch riskanten Lebensmitteln und gibt das Datum an, bis zu dem diese verzehrt werden können.',
        'explanation' => 'Richtig, wenn das Verbrauchsdatum abgelaufen ist, dürfen die Lebensmittel nicht mehr verzehrt und natürlich auch nicht weitergegeben werden. Die Weitergabe solcher Lebensmittel würde ein zu großes Gesundheitsrisiko mit sich bringen. Dasselbe gilt auch für andere verarbeitete Speisen, die nicht aus dem Privathaushalt stammen. Es handelt sich z.B. um rohen Fisch, rohe Eierspeisen, Geflügel, Hackfleisch und anderes Fleisch sowie zubereitete Lebensmittel, wie z.B. abgepacktem Schnittsalat, Sandwiches und vegetarischem Sushi.
ACHTUNG: Ob verpackte Lebensmittel weitergegeben werden dürfen, deren Verbrauchsdatum noch NICHT überschritten ist, sehen die Behörden je nach Region unterschiedlich. Bitte erkundige Dich bei Deiner/Deinem BotschafterIn wie das in Deiner Region gehandhabt wird.',
        'right' => 1,
    ),
    422 => 
    array (
        'id' => 454,
        'question_id' => 112,
        'text' => 'Kühlpflichtige Lebensmittel mit einem Verbrauchsdatum oder Mindesthaltbarkeitsdatum müssen in geeigneten Transportbehältern transportiert werden.',
    'explanation' => 'Richtig, um die Garantie für kühlungspflichtige Lebensmittel vom Hersteller nicht zu verlieren, darf die Kühlkette nicht unterbrochen werden. Es ist also notwendig, die kühlungspflichtigen Lebensmittel in einer Kühltasche, oder bei größeren Mengen, in einer Thermobox, so schnell wie möglich in den heimischen Kühlschrank zu bringen. Kurzfristig (30-60 Min.) darf sogar von der angegebenen Temperatur abgewichen werden - dies aber nur für maximal 3°C. Also Lebensmittel, die bei -18°C zu lagern sind, dürfen kurzfristig bei -15°C transportiert werden, ein Lebensmittel, welches bei 5°C zu lagern ist, bei 8°C usw. 
Hier geht es nicht ausschließlich darum, die Garantie zu bewahren, auch in Sachen Qualität, Frische und Lagerdauer kann man hier eigentlich nur gewinnen. Thermotaschen oder Styroporboxen, die man einfach auswischen kann, sorgen für ein einfaches, gut funktionierendes und mehrfach verwendbares Transportprinzip.',
        'right' => 1,
    ),
    423 => 
    array (
        'id' => 455,
        'question_id' => 112,
        'text' => 'Es ist auf der Verpackung gekennzeichnet mit „verbrauchen bis …“.',
        'explanation' => 'Richtig, damit unterscheidet es sich vom Mindesthaltbarkeitsdatum, das ist gekennzeichnet mit “mindestens haltbar bis …”. ',
        'right' => 1,
    ),
    424 => 
    array (
        'id' => 456,
        'question_id' => 113,
        'text' => '"Ja, na klar - ausschließlich!"',
        'explanation' => 'Falsch, die primären Ziele von Lebensmittelretten.de sind es, Aufmerksamkeit auf die Lebensmittelverschwendung zu richten, diese einzudämmen und damit einen Beitrag zu leisten unsere kostbaren Ressourcen zu schonen. Beim Umsetzen dieser Ziele kann es den tollen Nebeneffekt geben, dass durch die geretteten Lebensmittel zufällig auch Bedürftige und unterstützenswerte Projekte gefördert werden. Allerdings möchten wir uns nicht anmaßen, zu entscheiden, welche Menschen nun bedürftig sind oder welche Projekte nun unterstützenswerter sind als andere.',
        'right' => 0,
    ),
    425 => 
    array (
        'id' => 457,
        'question_id' => 113,
        'text' => '"Das geht Sie überhaupt nichts an. Sobald die Lebensmittel von mir gerettet sind muss ich Ihnen darüber keine Rechenschaft abliefern"',
        'explanation' => 'Falsch, man kann bei solch einer Fragen den Leuten wunderbar erklären, dass bei uns jede/r von den geretteten Lebensmitteln profotieren kann, sei es über eigenes Engagement, über die Essenskörbe, Fair-Teiler etc.',
        'right' => 0,
    ),
    426 => 
    array (
        'id' => 458,
        'question_id' => 113,
        'text' => '"Wir wollen gern allen Menschen die geretteten Lebensmittel zur Verfügung stellen. Deswegen werden auch Bedürftige davon profitieren, jedoch nicht ausschließlich - auch Freunde, Bekannte und Menschen, die sich Essenskörbe abholen"',
        'explanation' => 'Richtig, das ist eine der guten Antworten, die Du geben kannst.',
        'right' => 1,
    ),
    427 => 
    array (
        'id' => 459,
        'question_id' => 113,
        'text' => '"Ja. Wir möchten gern alle Bedürftigen mit Lebensmitteln versorgen, damit diese nicht weiter hungern"',
    'explanation' => 'Falsch, dies ist keine Antwort, die Du beim Vorstellen der Organisation “Lebensmitelretten.de” geben kannst. Die primären Ziele von Lebensmittelretten.de sind es, Aufmerksamkeit auf die Lebensmittelverschwendung zu richten, diese einzudämmen und damit einen Beitrag zu leisten unsere kostbaren Ressourcen zu schonen. Beim Umsetzen dieser Ziele kann es den tollen Nebeneffekt geben, dass durch die geretteten Lebensmittel zufällig auch Bedürftige und unterstützenswerte Projekte gefördert werden.  Der Begriff der Bedürftigkeit ist in §1602 Abs. 1 BGB, sowie in § 9 SGB II ("Hilfebedürftigkeit") definiert ist. Allerdings möchten wir uns nicht anmaßen, zu entscheiden welche Menschen nun bedürftig sind oder welche Projekte nun unterstüzenswerter sind als andere. Das ist nicht die Aufgabe unserer Organisation. Wir möchten damit auch die mit der Deklarierung als Bedürftig einhergehenden Gefahr der Stigmatisierung vermeiden. Aus diesen Gründen gilt bei uns, dass jedes Mitglied die geretteten Lebensmittel in Anspruch nehmen darf.',
        'right' => 0,
    ),
    428 => 
    array (
        'id' => 460,
        'question_id' => 114,
        'text' => 'Das solltest Du verbieten, weil Abholen mit dem Auto nicht nachhaltig ist.',
    'explanation' => 'Falsch, wenn es viele Lebensmittel sind und/oder dieser Betrieb ohnehin auf dem Weg des Foodsavers lag, solltest Du das nicht unterbinden. Schöner ist natürlich, wenn wir die Nachhaltigkeit auf allen Ebenen leben, also zum Beispiel mit einem Fahrrad(anhänger) Lebensmittel retten. Auch das etwas schickere Auto stellt kein Problem dar. Wir möchten gerne , dass sich alle Menschen an der Eindämmung der Lebensmittelverschwendung beteiligen können - ohne stigmatisiert zu werden.',
        'right' => 0,
    ),
    429 => 
    array (
        'id' => 461,
        'question_id' => 114,
        'text' => 'Ich akzeptiere das und freue mich, dass die Lebensmittel gerettet werden. Ökologischer ist natürlich eine Abholung mit dem Fahrrad.',
        'explanation' => 'Richtig, das ist eine Haltung, die Du wahren kannst. Die primären Ziele von foodsharing sind es, Aufmerksamkeit auf die Lebensmittelverschwendung zu richten, diese einzudämmen und damit einen Beitrag zu leisten unsere kostbaren Ressourcen zu schonen. Solange diese Rechnung aufgeht, ist es sekundär, wer die Lebensmittel abholt, aber selbstverständlich ist nachhaltiger, wenn das Retten möglichst nur wenn es notwendig ist mit einem Auto erledigt wird.',
        'right' => 1,
    ),
    430 => 
    array (
        'id' => 462,
        'question_id' => 114,
        'text' => 'Sowas kümmert mich gar nicht und die Leute sollen mich mit solchen Fragen nicht belästigen. ',
        'explanation' => 'Falsch, auch wenn Dich das persönlich vielleicht nicht interessiert, solltest Du dazu Stellung nehmen können. Foodsavern sollte es egal sein, wer Lebensmittel rettet. Es sollte nicht egal sein, womit die anderen Foodsaver Lebensmittel retten. Mit einem Fahrrad Lebensmittel zu retten ist natürlich viel ökologischer. Jedoch: wenn sich der Foodsaver mit einem Auto ohnehin auf einem Weg befindet, ist das irrelevant.',
        'right' => 0,
    ),
    431 => 
    array (
        'id' => 463,
        'question_id' => 114,
        'text' => 'Ich erkläre, dass wir das Auto brauchen, um diese Kooperation bewerkstelligen zu können.',
        'explanation' => 'Richtig, es wäre schade, wenn eine große Kooperation nicht zu stande kommen kann, wenn allein mit Fahrrädern nicht alles weg gebracht werden kann. Wir empfehlen sonst natürlich mit dem Fahrrad zu kommen, doch in einer solchen Situation freuen wir uns über die motorisierte Unterstützung.',
        'right' => 1,
    ),
));
        
        
    }
}