<?php

use Illuminate\Database\Seeder;

class FsBetriebTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_betrieb')->delete();

        $betriebe = [
            [
                'id' => 1,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.90566497',
                'lon' => '6.96666287',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 1',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt1.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ],

            [
                'id' => 2,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.92075125',
                'lon' => '6.94928598',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 2',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt2.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ],

            [
                'id' => 3,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.92380675',
                'lon' => '6.94924662',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 3',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt3.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ],

            [
                'id' => 4,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.9111209',
                'lon' => '6.9370584',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 4',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt4.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ],

            [
                'id' => 5,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.90912779',
                'lon' => '6.96825644',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 5',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt5.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ],

            [
                'id' => 6,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.89821969',
                'lon' => '6.93651966',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 6',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt6.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ],

            [
                'id' => 7,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.90819089',
                'lon' => '6.96229577',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 7',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt7.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ],

            [
                'id' => 8,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.90525052',
                'lon' => '6.9450263',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 8',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt8.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ],

            [
                'id' => 9,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.92402396',
                'lon' => '6.92862057',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 9',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt9.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ],

            [
                'id' => 10,
                'betrieb_status_id' => 5,
                'bezirk_id' => 4,
                'added' => '2013-10-19',
                'plz' => '50969',
                'stadt' => 'Köln',
                'lat' => '50.90286551',
                'lon' => '6.96427447',
                'kette_id' => 3,
                'betrieb_kategorie_id' => 1,
                'name' => 'Supermarkt Nummer 10',
                'str' => 'Hauptstraße 5',
                'hsnr' => '5',
                'status_date' => '2017-03-15',
                'status' => 0,
                'ansprechpartner' => '',
                'telefon' => '03032513665',
                'fax' => '',
                'email' => 'info@supermarkt10.de',
                'begin' => '2012-04-03',
                'besonderheiten' => 'Wir holen um 13 Uhr ab. Wenn nicht anders vereinbart, ist der Treffpunkt vor dem Laden. Drinnen fragen wir an der Backtheke nach Backwaren von vor zwei Tagen und an der Käsetheke oder bei den verantwortlichen Mitarbeiter*innen nach Molkereiprodukten / anderen Kühlwaren. Das Obst und Gemüse steht hinten auf dem Parkplatz in einem Einkaufswagen oder in Kisten. 

*** WICHTIG: Pfand von Milchprodukten muss von uns an der Kasse bezahlt werden!!! 

*** Es muss immer mindestens eine erfahrene Person von den Foodsavern aus dem Team bei den Abholungen dabei sein.

*** Bei Austragungen MUSS selbst nach Ersatz gesucht werden, z.B. durch Anrufe, SMS, persönliche Nachrichten o.ä. - wenn das nicht passiert, melde ich kurzfristige Absagen als Verstoß.',
                'public_info' => 'Bitte bewerbt euch nur, wenn ihr mindestens alle zwei Wochen um die Mittagszeit Abholungen machen könnt.',
                'public_time' => 2,
                'ueberzeugungsarbeit' => 2,
                'presse' => 1,
                'sticker' => 1,
                'abholmenge' => 5,
                'team_status' => 1,
                'prefetchtime' => 2419200,
                'team_conversation_id' => NULL,
                'springer_conversation_id' => NULL,
                'deleted_at' => NULL,
            ]
        ];

        \DB::table('fs_betrieb')->insert($betriebe);

        /*
         * Link store admin as admin to stores add one user as team member also
         */
        $betrieb_admin_fs_id = 3;
        $betrie_team_member_id = 2;

        $betrieb_team = [];

        foreach ($betriebe as $b)
        {
            $betrieb_team[] = [
                'foodsaver_id' => $betrieb_admin_fs_id,
                'betrieb_id' => $b['id'],
                'verantwortlich' => 1,
                'active' => 1,
                'stat_last_update' => '2017-01-01 00:00:00',
                'stat_fetchcount' => 10,
                'stat_first_fetch' => '2017-01-01',
                'stat_last_fetch' => '2017-01-01 00:00:00',
                'stat_add_date' => '2017-01-01',
            ];

            $betrieb_team[] = [
                'foodsaver_id' => $betrie_team_member_id,
                'betrieb_id' => $b['id'],
                'verantwortlich' => 0,
                'active' => 1,
                'stat_last_update' => '2017-01-01 00:00:00',
                'stat_fetchcount' => 10,
                'stat_first_fetch' => '2017-01-01',
                'stat_last_fetch' => '2017-01-01 00:00:00',
                'stat_add_date' => '2017-01-01',
            ];
        }

        \DB::table('fs_betrieb_team')->insert($betrieb_team);
        
        
    }
}
