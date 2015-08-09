<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExampleProduct extends Seeder
{

    /*
     *  Columns
     *
        increments('id');
        string('product_name');
        longText('description');
        integer('quantity');
        string('image_path');
        float('price');
        boolean('status'); //The status of the product. Can be set to false (disabled) or true (enabled).
        integer('times_ordered');
        integer('category_id');
        integer('manufacturers_id');
        timestamps();
        softDeletes();
    */

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Beispiel TV-Gerät',
                'description' => 'Beispiel Fernsehgerät mit Ultra HD Auflösung und 108cm Bilddiagonalen (42,5 Zoll)',
                'quantity' => '120',
                'image_path' => 'no_img.png',
                'price' => '189.90',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '2',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],[
                'name' => 'No Name Beamer',
                'description' => 'Voll Funktionsfähiger Beamer einer No Name Marke. Günstig im Preis, vielfältig einsetzbar und langlebig!',
                'quantity' => '60',
                'image_path' => 'no_img.png',
                'price' => '12.00',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '3',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'DVD-Player Terine',
                'description' => 'Der DVD_Player Terine ist das neueste Produkt aus dem hause Küche und überzeugt mit seinem leisen kugelgelagertem Laufwerk, dem Hochauflösendem Laser und dem geringen Stromverbrauch.',
                'quantity' => '45',
                'image_path' => 'no_img.png',
                'price' => '90.50',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '4',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'DerDa A60 Tablet',
                'description' => 'Dieses Tablet von DerDa hat eine FullHD auflösung und das neueste 20-Finger Display für Mehrbenutzer eingaben. Dazu kommt ein leistungsstarker ARM Prozessor und eine Starke eigens für dieses Gerät entwickelte Grafikeinheit.',
                'quantity' => '12',
                'image_path' => 'no_img.png',
                'price' => '344.98',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '6',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Paperback DR12',
                'description' => 'Der Paperback DR12 überzeugt mit seinem nauartigen Full-Paper Display und langer Akkulaufzeit.',
                'quantity' => '666',
                'image_path' => 'no_img.png',
                'price' => '2.20',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '7',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pawlett Erhardt PE 4320U',
                'description' => 'Leistungsstarkes Business-Notebook aus dem Hause Pawlett Erhardt mit einer Akkulaufzeit von 48h (Standby) und guter Portabilität durch das 15 Zoll HD Display.',
                'quantity' => '99',
                'image_path' => 'no_img.png',
                'price' => '429.79',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '11',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Laverno Eradikal Pro',
                'description' => 'Professionelles Gaming Notebook von Laverno mit Full-HD Display und 17 Zoll Bildschirmdiagonal. Zusammen mit dem Leisstungsstarken Imgel P6 und der Marveni 530K Grafikkarte ist dieses Notebook ideal für die nächste LAN-Party.',
                'quantity' => '42',
                'image_path' => 'no_img.png',
                'price' => '821.42',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '12',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Marcbook Devil Pro',
                'description' => 'Das Neueste von diesem Hersteller ausgestattet mit der neusten Technik und mit den neuesten Herstellungsverfahren Produziert. Alles zum günstigsten Preis, für Sie',
                'quantity' => '888',
                'image_path' => 'no_img.png',
                'price' => '2142.12',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '14',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Marcbook Narval Air',
                'description' => 'Das Neueste von diesem Hersteller ausgestattet mit der neusten Technik und mit den neuesten Herstellungsverfahren Produziert. Extra dünn und alles zum günstigsten Preis, für Sie',
                'quantity' => '222',
                'image_path' => 'no_img.png',
                'price' => '4142.12',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '15',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Andorra 24/7',
                'description' => 'All-in-One system von Andorra. Wirklich ALLES in einem.',
                'quantity' => '34',
                'image_path' => 'no_img.png',
                'price' => '999',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '18',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Armageddon Room 2016',
                'description' => 'Ein Komplettsystem das allen anforderungen gerecht wird, sei es zum Spielen, für Multimedia Anwendungen oder im Office-Bereich. Nicht nur die Verbaute Hardware, sondern auch die Beiliegende Peripherie ist High-End!',
                'quantity' => '21',
                'image_path' => 'no_img.png',
                'price' => '4999.99',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '19',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Kalarkinov Derwish 1230 Ultra',
                'description' => 'Du willst das beste und wirklich nur das Beste für den gaming Bereich? Du willst ganz oben Mitspielen? Dann ist dieser Desktop Gaming PC genau das Richtige für dich. Dieser High-End Rechner lässt dich überall oben mitspielen.',
                'quantity' => '99',
                'image_path' => 'no_img.png',
                'price' => '899.89',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '20',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'BlazierTech B500 2015Edit',
                'description' => 'Überarbeitet Version der BlackMouse 2012 mit verbessertem Sensor (22000 DPI) und überarbeiteter rutscshfester Oberfläche. Hält bis zu 12 Klicks!',
                'quantity' => '250',
                'image_path' => 'no_img.png',
                'price' => '75.00',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '22',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Merry Mecha 12 GoesRoundEdit',
                'description' => 'Lautlose Mechanische Tastatur mit Merry Blue Switches und Scheren Technologie. Die mechanischen Bauteile halten bis zu (infinity) Tastenanschägen durch und müsssen dabei weder gewartet noch gereinigt werden.',
                'quantity' => '45',
                'image_path' => 'no_img.png',
                'price' => '55.00',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '23',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Envius V14 E12',
                'description' => 'Full-HD-Monitor mit <1sek Reaktionszeit und Hohem kontrast. Perfekt zum Spielen und für die Bildbearbeitung. Speziell für diesen Bildschirm wurde eine Antihaftbeschichtung für Bildschirmoberfächen entwickelt, nie wieder lässtige Fingerabdrücke auf dem Bildschirm ',
                'quantity' => '320',
                'image_path' => 'no_img.png',
                'price' => '239.99',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '24',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pawlett Erhardt MaskJet E666',
                'description' => 'Der Bösartigste unter den Druckern. hat nie Papier und die Tinte ist auch immer leer. Sowas schenkt man nichtmal seinem ärgsten Feind',
                'quantity' => '266',
                'image_path' => 'no_img.png',
                'price' => '89.99',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '25',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Notebook Tasche Hermi',
                'description' => 'Wasserabweisend, Stoßfest, Groß. Die 17 Zoll Notebooktasche ist etwas für die Mobilen Notebookanutzer.',
                'quantity' => '42',
                'image_path' => 'no_img.png',
                'price' => '25.49',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '26',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Laverno Eradikal Business',
                'description' => 'Professionelles Business Notebook von Laverno mit Full-HD Display und 15 Zoll Bildschirmdiagonal. Zusammen mit dem Leisstungsstarken Imgel P3 ist dieses Notebook ideal für Mobile-Office geeignet.',
                'quantity' => '42',
                'image_path' => 'no_img.png',
                'price' => '821.42',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '11',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Beispiel Computer',
                'description' => 'Der allrounder für den kleinen Geldbeutel. Perfekt als erster PC für die kleinen oder zum Surfen für die Großen.',
                'quantity' => '42',
                'image_path' => 'no_img.png',
                'price' => '21.42',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '17',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Beispiel Business Notebook',
                'description' => 'Aufklappen, anschalten und arbeiten, egal wo, egal wann. Das und vieles mehr ist mit diesem Gerät möglich. ',
                'quantity' => '42',
                'image_path' => 'no_img.png',
                'price' => '21.42',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '11',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Marion M770',
                'description' => 'Das Beste für die beschäftigte Hausfrau, Mutter oder einfach nur Geschäftsleitung.',
                'quantity' => '25',
                'image_path' => 'no_img.png',
                'price' => '312.89',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '11',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Samson trayPhone FL2010',
                'description' => 'Das Smartphone für Kinder und Jugendliche 5,5Zoll Bildschirmdiagonale, perfekt zum spielen und surfen.',
                'quantity' => '123',
                'image_path' => 'no_img.png',
                'price' => '399.89',
                'status' => 'true',
                'times_ordered' => '0',
                'category_id' => '8',
                'manufacturers_id' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
