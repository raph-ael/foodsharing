<?php

use Illuminate\Database\Seeder;

class FsBetriebKategorieTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fs_betrieb_kategorie')->delete();
        
        \DB::table('fs_betrieb_kategorie')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bio Supermarkt',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Kaffee',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Mensa/Kantine',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Gemüseladen',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Bäckerei',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Supermarkt',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Getränkeladen',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Restaurant',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Obst-/Gemüsehändler',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Hofladen',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Biohofladen',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Bioladen',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Naturkostladen',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Großhändler',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Geträngroßhandel',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Bio-Lieferservice',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Reformhaus',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Bistro',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Fast Food ohne Bullshit | Food Truck | Guerilla Ca',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Hotel',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Wochenmarkt',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Italienischer Feinkostladen',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Caffehaus',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'FreshFood / InternationalGrocery / FreshCharlyBean',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Ristorante / Bar / Catering',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Alimentari / Ristorante / Bar / Großhandel',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Veganversand',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Seniorenheim',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Marmeladen',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Gasthaus',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Catering',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Mahlzeit für Zuhause',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Verein',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'wohltätig und sportlich',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'vegetarisches Restaurant & Greisslerei',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Greisslerei',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'orientalische Spezialitäten',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Kochschule',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Restpostenmarkt',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Lieferservice',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Convenience-Food',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Drogerie',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Supermarkt',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Lebensmittelmarkt',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Metzgerei',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Kochsalon / Restaurant',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Delikatessen aus Wiese, Wald und Garten',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Holzofenbäckerei',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Regionale Bio-Frischprodukte',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Bio-Einkaufsgemeinschaft',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Festival',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Schokolade',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'umsonstladen',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Kiosk',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Tankstelle',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Bio-Bäckerei',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Türkischer Feinkostladen',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Biomarkt & Bistro',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Messestand',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Fabrik',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Backshop',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Feinkostladen',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Zahnpflege',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Konditorei',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Vegan',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Teeladen',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Wurstwaren',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Warenhaus',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Türkischer Supermarkt',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Discounter',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Veganes Café',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Versandhandel',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Confiserie ',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Indien Shop ',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Griechischer Feinkostladen',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'noname',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Biergarten',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Hostel / Cafe',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Türkische Backwaren',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Fairteiler',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Caritas',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Café',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Tankstellenshop',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Marktplatz',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Russische Lebensmittel/Getränke',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Vegetarisches Restaurant ',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Asiatische Restaurants ',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Delikatessen ',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'Übungsfirma',
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Garten',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Wohngemeinschaft',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Kinderprojekte ',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Lebensmitteldiscounter',
            ),
            93 => 
            array (
                'id' => 94,
            'name' => 'Saftladen :)',
        ),
        94 => 
        array (
            'id' => 95,
            'name' => 'Schnellimbiss',
        ),
        95 => 
        array (
            'id' => 96,
            'name' => 'Schnellimbiss',
        ),
        96 => 
        array (
            'id' => 97,
            'name' => 'Schnellimbiss',
        ),
        97 => 
        array (
            'id' => 98,
            'name' => 'Schnellimbiss',
        ),
        98 => 
        array (
            'id' => 99,
            'name' => 'Arabischer Supermarkt',
        ),
        99 => 
        array (
            'id' => 100,
            'name' => 'Indischer Supermarkt',
        ),
        100 => 
        array (
            'id' => 101,
            'name' => 'Indisches Restaurant ',
        ),
        101 => 
        array (
            'id' => 102,
            'name' => 'Pizzeria',
        ),
        102 => 
        array (
            'id' => 103,
            'name' => 'Dönerbude',
        ),
        103 => 
        array (
            'id' => 104,
            'name' => 'Hofladen und Wochenmärkte',
        ),
        104 => 
        array (
            'id' => 105,
            'name' => 'Hofladen und Wochenmärkte',
        ),
        105 => 
        array (
            'id' => 106,
            'name' => 'Feinkost',
        ),
        106 => 
        array (
            'id' => 107,
            'name' => 'Eiscafe',
        ),
        107 => 
        array (
            'id' => 108,
            'name' => 'Quartier-Lädeli',
        ),
        108 => 
        array (
            'id' => 109,
            'name' => 'Verpackungsfreier Bioladen',
        ),
        109 => 
        array (
            'id' => 110,
            'name' => 'Ei- und Geflügelhandel',
        ),
        110 => 
        array (
            'id' => 111,
            'name' => 'BIO Vertrieb',
        ),
        111 => 
        array (
            'id' => 112,
            'name' => 'Blumenhaus',
        ),
        112 => 
        array (
            'id' => 113,
            'name' => 'Tofumanufaktur',
        ),
        113 => 
        array (
            'id' => 114,
            'name' => 'Hotel/Restaurant',
        ),
        114 => 
        array (
            'id' => 115,
            'name' => 'Alten- und Pflegeheim',
        ),
        115 => 
        array (
            'id' => 116,
            'name' => 'Onlinehandel',
        ),
        116 => 
        array (
            'id' => 117,
            'name' => 'Patisserie',
        ),
        117 => 
        array (
            'id' => 118,
            'name' => 'Molkereiprodukte',
        ),
        118 => 
        array (
            'id' => 119,
            'name' => 'Geflügel',
        ),
        119 => 
        array (
            'id' => 120,
            'name' => 'Dampfnudelnbräterei',
        ),
        120 => 
        array (
            'id' => 121,
            'name' => 'Salatbar',
        ),
        121 => 
        array (
            'id' => 122,
            'name' => 'Asiatischer Supermarkt',
        ),
        122 => 
        array (
            'id' => 123,
            'name' => 'Kindertagesstätte',
        ),
        123 => 
        array (
            'id' => 124,
            'name' => 'Brot',
        ),
        124 => 
        array (
            'id' => 125,
            'name' => 'Weihnachtsmarkt',
        ),
        125 => 
        array (
            'id' => 126,
            'name' => 'Weltladen',
        ),
        126 => 
        array (
            'id' => 127,
            'name' => 'Plantage',
        ),
        127 => 
        array (
            'id' => 128,
            'name' => 'Bäckerei',
        ),
        128 => 
        array (
            'id' => 129,
            'name' => 'Bäckerei',
        ),
        129 => 
        array (
            'id' => 130,
            'name' => 'Tierfutterfachgeschäft',
        ),
        130 => 
        array (
            'id' => 131,
            'name' => 'Veganes Restaurant',
        ),
        131 => 
        array (
            'id' => 132,
            'name' => 'Haushaltsauflösungen und Entrümpelungen',
        ),
        132 => 
        array (
            'id' => 133,
            'name' => 'Bio-Bar',
        ),
        133 => 
        array (
            'id' => 134,
            'name' => 'Reformhaus mit regionalem Obst-/Gemüseangebot',
        ),
        134 => 
        array (
            'id' => 135,
            'name' => 'Café/Bistro/Bar',
        ),
        135 => 
        array (
            'id' => 136,
            'name' => 'Focacceria',
        ),
        136 => 
        array (
            'id' => 137,
            'name' => 'Trinkhalle',
        ),
        137 => 
        array (
            'id' => 138,
            'name' => 'Kulturzentrum',
        ),
        138 => 
        array (
            'id' => 139,
            'name' => 'Kaffee Rösterei',
        ),
        139 => 
        array (
            'id' => 140,
            'name' => 'Gaststätte, gut bürgerlich',
        ),
        140 => 
        array (
            'id' => 141,
            'name' => 'Fair-Teiler',
        ),
        141 => 
        array (
            'id' => 142,
            'name' => 'Suppenküche',
        ),
        142 => 
        array (
            'id' => 143,
            'name' => 'Pizza & Pasta',
        ),
        143 => 
        array (
            'id' => 144,
            'name' => 'Asia-Imbiss',
        ),
        144 => 
        array (
            'id' => 145,
            'name' => 'Gärtnerei',
        ),
        145 => 
        array (
            'id' => 146,
            'name' => 'Mall',
        ),
        146 => 
        array (
            'id' => 147,
            'name' => 'Take-Away',
        ),
        147 => 
        array (
            'id' => 148,
            'name' => 'Foodcourt',
        ),
        148 => 
        array (
            'id' => 149,
            'name' => 'Sammelstelle für Foodsaver',
        ),
        149 => 
        array (
            'id' => 150,
            'name' => 'Grunschule Catering',
        ),
        150 => 
        array (
            'id' => 151,
            'name' => 'Grundschule Catering',
        ),
        151 => 
        array (
            'id' => 152,
            'name' => 'Wochenmarkt',
        ),
        152 => 
        array (
            'id' => 153,
            'name' => 'Paninis, Wraps',
        ),
        153 => 
        array (
            'id' => 154,
            'name' => 'Säfte, Smoothies, Paninis, Wraps',
        ),
        154 => 
        array (
            'id' => 155,
            'name' => 'Gewürze',
        ),
        155 => 
        array (
            'id' => 156,
            'name' => 'Sozialer Verein',
        ),
        156 => 
        array (
            'id' => 157,
            'name' => 'aufstrich / Brötchen',
        ),
        157 => 
        array (
            'id' => 158,
            'name' => 'Fair-Teiler',
        ),
        158 => 
        array (
            'id' => 159,
            'name' => 'Expo & Messe',
        ),
        159 => 
        array (
            'id' => 160,
            'name' => 'Bio-Imbiss',
        ),
        160 => 
        array (
            'id' => 161,
            'name' => 'Bio-Imbiss',
        ),
        161 => 
        array (
            'id' => 162,
            'name' => 'Veranstaltungs- und Tagungsräume',
        ),
        162 => 
        array (
            'id' => 163,
            'name' => 'Gewürze ; Marmeladen , Hausgemachtes ',
        ),
        163 => 
        array (
            'id' => 164,
            'name' => 'veganes Bistro',
        ),
        164 => 
        array (
            'id' => 165,
            'name' => 'Landhandel',
        ),
        165 => 
        array (
            'id' => 166,
            'name' => 'Messestände',
        ),
        166 => 
        array (
            'id' => 167,
            'name' => 'Frühlingsmarkt',
        ),
        167 => 
        array (
            'id' => 168,
            'name' => 'Studentenwerk',
        ),
        168 => 
        array (
            'id' => 169,
            'name' => 'Bio-Bäckerei / Café',
        ),
        169 => 
        array (
            'id' => 170,
            'name' => 'Fleischerei',
        ),
        170 => 
        array (
            'id' => 171,
            'name' => 'Marktstand',
        ),
        171 => 
        array (
            'id' => 172,
            'name' => 'Gastronomie-Lieferant',
        ),
        172 => 
        array (
            'id' => 173,
            'name' => 'Bio-Velokurier',
        ),
        173 => 
        array (
            'id' => 174,
            'name' => 'Veganer Lebensmittelladen',
        ),
        174 => 
        array (
            'id' => 175,
            'name' => 'Süßwaren',
        ),
        175 => 
        array (
            'id' => 176,
            'name' => 'Bio Gärtnerei',
        ),
        176 => 
        array (
            'id' => 177,
            'name' => 'Kino m. Tagunszentrum ',
        ),
        177 => 
        array (
            'id' => 178,
            'name' => 'Schulverpflegung',
        ),
        178 => 
        array (
            'id' => 179,
            'name' => 'Veranstaltung',
        ),
        179 => 
        array (
            'id' => 180,
            'name' => 'Veranstaltung',
        ),
        180 => 
        array (
            'id' => 181,
            'name' => 'Kochschule',
        ),
        181 => 
        array (
            'id' => 182,
            'name' => 'Kantine',
        ),
        182 => 
        array (
            'id' => 183,
            'name' => 'Plastikfrei',
        ),
        183 => 
        array (
            'id' => 184,
            'name' => 'Moschee während Ramadan',
        ),
        184 => 
        array (
            'id' => 185,
            'name' => 'Gemüsegärtnerei',
        ),
        185 => 
        array (
            'id' => 186,
            'name' => 'Imbiss',
        ),
        186 => 
        array (
            'id' => 187,
            'name' => 'ägyptisches Restaurant',
        ),
        187 => 
        array (
            'id' => 188,
            'name' => 'Nudelhersteller',
        ),
        188 => 
        array (
            'id' => 189,
            'name' => 'Gemeinschaftsgarten und Fairteiler',
        ),
        189 => 
        array (
            'id' => 190,
            'name' => 'Spätkauf',
        ),
        190 => 
        array (
            'id' => 191,
            'name' => 'Eine Welt Laden ',
        ),
        191 => 
        array (
            'id' => 192,
            'name' => 'Bioware',
        ),
        192 => 
        array (
            'id' => 193,
            'name' => 'Lebensmittel Bio',
        ),
        193 => 
        array (
            'id' => 194,
            'name' => 'Demeter Gemüse',
        ),
        194 => 
        array (
            'id' => 195,
            'name' => 'Demeter',
        ),
        195 => 
        array (
            'id' => 196,
            'name' => 'Gemüsebau',
        ),
        196 => 
        array (
            'id' => 197,
            'name' => 'Bäckerei ',
        ),
        197 => 
        array (
            'id' => 198,
            'name' => 'ital. Süßwaren',
        ),
        198 => 
        array (
            'id' => 199,
            'name' => 'Messe Essen Trinken und mehr',
        ),
        199 => 
        array (
            'id' => 200,
            'name' => 'Bio- vegetarisches Schulessen',
        ),
        200 => 
        array (
            'id' => 201,
            'name' => 'Stadthofladen',
        ),
        201 => 
        array (
            'id' => 202,
            'name' => 'Vegane Indische Küche',
        ),
        202 => 
        array (
            'id' => 203,
            'name' => 'Vegane indische Küche ',
        ),
        203 => 
        array (
            'id' => 204,
            'name' => 'Tafel',
        ),
        204 => 
        array (
            'id' => 205,
            'name' => 'Bäckerei Konditorei   Cafe',
        ),
        205 => 
        array (
            'id' => 206,
            'name' => 'Türkischer Imbiss',
        ),
        206 => 
        array (
            'id' => 207,
            'name' => 'Türkischer Imbiss',
        ),
        207 => 
        array (
            'id' => 208,
            'name' => 'ORGABETRIEB',
        ),
        208 => 
        array (
            'id' => 209,
            'name' => 'Fischräucherei',
        ),
        209 => 
        array (
            'id' => 210,
            'name' => 'Tante-Emma-Laden',
        ),
        210 => 
        array (
            'id' => 211,
            'name' => 'Marktstand fertiges Essen',
        ),
        211 => 
        array (
            'id' => 212,
            'name' => 'Esslokal',
        ),
        212 => 
        array (
            'id' => 213,
            'name' => 'Organisation',
        ),
        213 => 
        array (
            'id' => 214,
            'name' => 'Mexikanisches Schnellrestaurant',
        ),
        214 => 
        array (
            'id' => 215,
            'name' => 'Produzent',
        ),
        215 => 
        array (
            'id' => 216,
            'name' => 'Studentenladen',
        ),
        216 => 
        array (
            'id' => 217,
            'name' => 'Thai Take Away',
        ),
        217 => 
        array (
            'id' => 218,
            'name' => 'Flüchtlingsunterkunft',
        ),
        218 => 
        array (
            'id' => 219,
            'name' => 'Mühle',
        ),
        219 => 
        array (
            'id' => 220,
            'name' => 'Mühle',
        ),
        220 => 
        array (
            'id' => 221,
            'name' => 'Internationales Restaurant',
        ),
        221 => 
        array (
            'id' => 222,
            'name' => 'Multimarket',
        ),
        222 => 
        array (
            'id' => 223,
            'name' => 'bio bäckerei',
        ),
        223 => 
        array (
            'id' => 224,
            'name' => 'Bio-Bäckerei mit Café',
        ),
        224 => 
        array (
            'id' => 225,
            'name' => 'Büro',
        ),
        225 => 
        array (
            'id' => 226,
            'name' => 'Freizeitpark',
        ),
        226 => 
        array (
            'id' => 227,
            'name' => 'Bio-Veganes Restaurant',
        ),
        227 => 
        array (
            'id' => 228,
            'name' => 'Pizza/Café',
        ),
        228 => 
        array (
            'id' => 229,
            'name' => 'Africa/China/India/SriLanka',
        ),
        229 => 
        array (
            'id' => 230,
            'name' => 'Vegetarische indische Küche',
        ),
        230 => 
        array (
            'id' => 231,
            'name' => 'Tee Import und Export',
        ),
        231 => 
        array (
            'id' => 232,
            'name' => 'Türkische Knabbereien und Trockenware',
        ),
        232 => 
        array (
            'id' => 233,
            'name' => 'Food Festival',
        ),
        233 => 
        array (
            'id' => 234,
            'name' => 'Landgasthof',
        ),
        234 => 
        array (
            'id' => 235,
            'name' => 'Abgabestelle',
        ),
        235 => 
        array (
            'id' => 236,
            'name' => 'Schiff',
        ),
        236 => 
        array (
            'id' => 237,
            'name' => 'Messe',
        ),
        237 => 
        array (
            'id' => 238,
            'name' => 'Sandwich-Restaurant',
        ),
        238 => 
        array (
            'id' => 239,
            'name' => 'Italienische Lebensmittel',
        ),
        239 => 
        array (
            'id' => 240,
            'name' => 'Bäckerei Konditorei',
        ),
        240 => 
        array (
            'id' => 241,
            'name' => 'Einführungsabholungen',
        ),
        241 => 
        array (
            'id' => 242,
            'name' => 'cafe bistro',
        ),
        242 => 
        array (
            'id' => 243,
            'name' => 'cafe bistro',
        ),
        243 => 
        array (
            'id' => 244,
            'name' => 'Wraps & Crêpes',
        ),
        244 => 
        array (
            'id' => 245,
            'name' => 'Volksfest',
        ),
        245 => 
        array (
            'id' => 246,
            'name' => 'Chinesisch Mongolisches Restaurant',
        ),
        246 => 
        array (
            'id' => 247,
            'name' => 'Putzbetrieb',
        ),
        247 => 
        array (
            'id' => 248,
            'name' => 'Cafè mit Mittagstisch',
        ),
        248 => 
        array (
            'id' => 249,
            'name' => 'Dorfladen',
        ),
        249 => 
        array (
            'id' => 250,
            'name' => 'Italienisches Restaurant',
        ),
        250 => 
        array (
            'id' => 251,
            'name' => 'Kino',
        ),
        251 => 
        array (
            'id' => 252,
            'name' => 'Käseladen',
        ),
        252 => 
        array (
            'id' => 253,
            'name' => 'Strandbar',
        ),
        253 => 
        array (
            'id' => 254,
            'name' => 'Lastenrad',
        ),
        254 => 
        array (
            'id' => 255,
            'name' => 'Unverpackt regional',
        ),
        255 => 
        array (
            'id' => 256,
            'name' => 'Abholort für Obst und Gemüse',
        ),
        256 => 
        array (
            'id' => 257,
            'name' => 'Öffentlichkeitsarbeit',
        ),
        257 => 
        array (
            'id' => 258,
            'name' => 'Fischgeschäft',
        ),
        258 => 
        array (
            'id' => 259,
            'name' => 'Keksfabrik',
        ),
        259 => 
        array (
            'id' => 260,
            'name' => 'Café und regionale Lebensmittel',
        ),
        260 => 
        array (
            'id' => 261,
            'name' => 'Club',
        ),
        261 => 
        array (
            'id' => 262,
            'name' => 'Gemüsebau / Landwirtschaft',
        ),
        262 => 
        array (
            'id' => 263,
            'name' => 'Senf & Saucen',
        ),
        263 => 
        array (
            'id' => 264,
            'name' => 'Beratungs Kanzlei',
        ),
        264 => 
        array (
            'id' => 265,
            'name' => 'Hofladen & Restaurant',
        ),
        265 => 
        array (
            'id' => 266,
            'name' => 'Vegane Feinkost',
        ),
        266 => 
        array (
            'id' => 267,
            'name' => 'Rehaeinrichtung',
        ),
        267 => 
        array (
            'id' => 268,
            'name' => 'Bürohaus mit Teeküchen',
        ),
        268 => 
        array (
            'id' => 269,
            'name' => 'Müsligeschäft',
        ),
        269 => 
        array (
            'id' => 270,
            'name' => 'Müsligeschäft',
        ),
        270 => 
        array (
            'id' => 271,
            'name' => 'Käsamanufaktur',
        ),
        271 => 
        array (
            'id' => 272,
            'name' => 'Obst,Gemüse&Döner',
        ),
        272 => 
        array (
            'id' => 273,
            'name' => 'Bauernladen',
        ),
        273 => 
        array (
            'id' => 274,
            'name' => 'Salat- und Fruchthaus',
        ),
        274 => 
        array (
            'id' => 275,
            'name' => 'Türkischer Obst- und Gemüseladen',
        ),
        275 => 
        array (
            'id' => 276,
            'name' => 'SoLaWi-Abholort',
        ),
        276 => 
        array (
            'id' => 277,
            'name' => 'Dönner&Pizza',
        ),
        277 => 
        array (
            'id' => 278,
            'name' => 'Wirtshaus',
        ),
        278 => 
        array (
            'id' => 279,
            'name' => 'Suppenbar',
        ),
        279 => 
        array (
            'id' => 280,
            'name' => 'Marktforschungsinstitut',
        ),
        280 => 
        array (
            'id' => 281,
            'name' => 'Cafeteria ',
        ),
        281 => 
        array (
            'id' => 282,
            'name' => 'Bio-vegetarische Küche',
        ),
        282 => 
        array (
            'id' => 283,
            'name' => 'Gasthaus / slow food / regional',
        ),
        283 => 
        array (
            'id' => 284,
            'name' => 'Gasthaus / Slow food / regional',
        ),
        284 => 
        array (
            'id' => 285,
            'name' => 'Volkshochschule',
        ),
        285 => 
        array (
            'id' => 286,
            'name' => 'Käserei und Lebensmittelladen',
        ),
        286 => 
        array (
            'id' => 287,
            'name' => 'Hofladen & Cafe',
        ),
        287 => 
        array (
            'id' => 288,
            'name' => 'Weltladen',
        ),
        288 => 
        array (
            'id' => 289,
            'name' => 'Fahrradanhänger/Lastenrad',
        ),
        289 => 
        array (
            'id' => 290,
            'name' => 'Bio-Wochenmarkt',
        ),
        290 => 
        array (
            'id' => 291,
            'name' => 'ayurvedisch-vegetarische Küche',
        ),
        291 => 
        array (
            'id' => 292,
            'name' => 'Italienische Küche, Kaffee und Gebäck',
        ),
        292 => 
        array (
            'id' => 293,
            'name' => 'Ludwigsburg',
        ),
        293 => 
        array (
            'id' => 294,
            'name' => 'Türkischer Lebensmittelladen',
        ),
        294 => 
        array (
            'id' => 295,
            'name' => 'Tagesbar',
        ),
        295 => 
        array (
            'id' => 296,
            'name' => 'Rechtsanwalts Kanzlei',
        ),
        296 => 
        array (
            'id' => 297,
            'name' => 'Verein',
        ),
        297 => 
        array (
            'id' => 298,
            'name' => 'Vegan-Vegetarischer Foodtruck',
        ),
    ));
        
        
    }
}