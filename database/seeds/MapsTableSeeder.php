<?php

use App\Modules\Stackmaps\Models\Map;
use Illuminate\Database\Seeder;


class MapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // 1st Floor Popular Books
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'Popular Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('Z'),
            'range_start' => 'A',
            'range_end' => 'Z',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/popular.jpg'),
        ]);

        // 1st Floor Issues
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => '1st Floor Rm 140 (Commons) - 2 day check-out',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('Z'),
            'range_start' => 'A',
            'range_end' => 'Z',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/issues.jpg'),
        ]);

        // 1st Floor DVD
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'Service Desk - DVDs',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('Z'),
            'range_start' => 'A',
            'range_end' => 'Z',
            'description' => "DVD cases can be found directly acrosss from the main Circulation Desk on the 1st floor of the library. Bring the case to the Circulation Desk to checkout the desired DVD.",
            'image' => \Illuminate\Support\Facades\Storage::url('maps/dvd.jpg'),
        ]);

        // 1st Floor CD
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'Service Desk - CDs',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('Z'),
            'range_start' => 'A',
            'range_end' => 'Z',
            'description' => 'CD cases can be found directly acrosss from the main Circulation Desk on the 1st floor of the library. Bring the case to the Circulation Desk to checkout the desired CD.',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/cd.jpg'),
        ]);

        // 1st Floor Oversize
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'Oversize Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('Z'),
            'range_start' => 'A',
            'range_end' => 'Z',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/oversize.jpg'),
        ]);

        // 1st Floor Maps
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'Maps - 1st Floor East Wing',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('Z'),
            'range_start' => 'A',
            'range_end' => 'Z',
            'description' => 'All of the Maps are located in a set of stacked drawers on the 1st floor straight back from the main entrance.',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/maps.jpg'),
        ]);

        // 1st Floor Periodicals
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'Periodicals - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('Z'),
            'range_start' => 'A',
            'range_end' => 'Z',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/periodicals.jpg'),
        ]);


        // 1st Floor General Book Collection
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('BF635'),
            'range_start' => 'A',
            'range_end' => 'BF635',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap-01.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('BF637'),
            'end' => Map::generateSortKey('BL2530'),
            'range_start' => 'BF637',
            'range_end' => 'BL2530',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_2.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('BL2530'),
            'end' => Map::generateSortKey('BS651'),
            'range_start' => 'BL2530',
            'range_end' => 'BS651',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_3.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('BS651'),
            'end' => Map::generateSortKey('BX8235'),
            'range_start' => 'BS651',
            'range_end' => 'BX8235',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_4.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('BX8235'),
            'end' => Map::generateSortKey('BX8631'),
            'range_start' => 'BX8235',
            'range_end' => 'BX8631',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_5.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('BX8631'),
            'end' => Map::generateSortKey('BX8670'),
            'range_start' => 'BX8631',
            'range_end' => 'BX8670',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_6.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('BX8670'),
            'end' => Map::generateSortKey('CJ59'),
            'range_start' => 'BX8670',
            'range_end' => 'CJ59',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_7.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('CJ81'),
            'end' => Map::generateSortKey('D755'),
            'range_start' => 'CJ81',
            'range_end' => 'D755',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_8.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('D755'),
            'end' => Map::generateSortKey('DA356'),
            'range_start' => 'D755',
            'range_end' => 'DA356',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_9.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('DA356'),
            'end' => Map::generateSortKey('DD256'),
            'range_start' => 'DA356',
            'range_end' => 'DD256',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_10.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('DD256'),
            'end' => Map::generateSortKey('DP68'),
            'range_start' => 'DD256',
            'range_end' => 'DP68',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_11.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('DP96'),
            'end' => Map::generateSortKey('DS526'),
            'range_start' => 'DP96',
            'range_end' => 'DS526',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_12.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('DS526'),
            'end' => Map::generateSortKey('DT72'),
            'range_start' => 'DS526',
            'range_end' => 'DT72',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_13.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('DT73'),
            'end' => Map::generateSortKey('E83'),
            'range_start' => 'DT73',
            'range_end' => 'E83',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_14.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('E83'),
            'end' => Map::generateSortKey('E185'),
            'range_start' => 'E83',
            'range_end' => 'E185',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_15.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('E185'),
            'end' => Map::generateSortKey('E409'),
            'range_start' => 'E185',
            'range_end' => 'E409',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_16.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('E409'),
            'end' => Map::generateSortKey('E696'),
            'range_start' => 'E409',
            'range_end' => 'E696',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_17.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('E697'),
            'end' => Map::generateSortKey('F122'),
            'range_start' => 'E697',
            'range_end' => 'F122',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_18.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('F122'),
            'end' => Map::generateSortKey('F596'),
            'range_start' => 'F122',
            'range_end' => 'F596',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/1stfloor-a-f-stackmap_19.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('F596'),
            'end' => Map::generateSortKey('F834'),
            'range_start' => 'F596',
            'range_end' => 'F834',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/stackmaps-master-aug2019-01.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('F834'),
            'end' => Map::generateSortKey('F1219'),
            'range_start' => 'F834',
            'range_end' => 'F1219',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/stackmaps-master-aug2019-02.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey('F1219'),
            'end' => Map::generateSortKey('FC3662'),
            'range_start' => 'F1219',
            'range_end' => 'FC3662',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/stackmaps-master-aug2019-03.jpg'),
        ]);


        // 2nd Floor General Book
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('G63'),
            'end' => Map::generateSortKey('GV199'),
            'range_start' => 'G63',
            'range_end' => 'GV199',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-01.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('GV200'),
            'end' => Map::generateSortKey('HB501'),
            'range_start' => 'GV200',
            'range_end' => 'HB501',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-02.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('HB501'),
            'end' => Map::generateSortKey('HD9677'),
            'range_start' => 'HB501',
            'range_end' => 'HD9677',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-03.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('HD9681'),
            'end' => Map::generateSortKey('HG179'),
            'range_start' => 'HD9681',
            'range_end' => 'HG179',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-04.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('HG179'),
            'end' => Map::generateSortKey('HT151'),
            'range_start' => 'HG179',
            'range_end' => 'HT151',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-05.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('HT151'),
            'end' => Map::generateSortKey('JF851'),
            'range_start' => 'HT151',
            'range_end' => 'JF851',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-06.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('JF1001'),
            'end' => Map::generateSortKey('KF8742'),
            'range_start' => 'JF1001',
            'range_end' => 'KF8742',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-07.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('KF8742'),
            'end' => Map::generateSortKey('LC3993'),
            'range_start' => 'KF8742',
            'range_end' => 'LC3993',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-08.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('LC3993'),
            'end' => Map::generateSortKey('M1734'),
            'range_start' => 'LC3993',
            'range_end' => 'M1734',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-09.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('M1734'),
            'end' => Map::generateSortKey('ML1030'),
            'range_start' => 'M1734',
            'range_end' => 'ML1030',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-10.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('ML1030'),
            'end' => Map::generateSortKey('N6888'),
            'range_start' => 'ML1030',
            'range_end' => 'N6888',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-11.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('N6915'),
            'end' => Map::generateSortKey('P120'),
            'range_start' => 'N6915',
            'range_end' => 'P120',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-12.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('P120'),
            'end' => Map::generateSortKey('PE1574'),
            'range_start' => 'P120',
            'range_end' => 'PE1574',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-13.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('PE1574'),
            'end' => Map::generateSortKey('PL914'),
            'range_start' => 'PE1574',
            'range_end' => 'PL914',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-14.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('PL914'),
            'end' => Map::generateSortKey('PN2189'),
            'range_start' => 'PL914',
            'range_end' => 'PN2189',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master-15.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('PN2189'),
            'end' => Map::generateSortKey('PQ2257'),
            'range_start' => 'PN2189',
            'range_end' => 'PQ2257',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_16.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('PQ2258'),
            'end' => Map::generateSortKey('PR1175'),
            'range_start' => 'PQ2258',
            'range_end' => 'PR1175',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_17.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('PR1175'),
            'end' => Map::generateSortKey('PR5360'),
            'range_start' => 'PR1175',
            'range_end' => 'PR5360',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_18.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('PR5360'),
            'end' => Map::generateSortKey('PS549'),
            'range_start' => 'PR5360',
            'range_end' => 'PS549',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_19.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('PS551'),
            'end' => Map::generateSortKey('PS3515'),
            'range_start' => 'PS551',
            'range_end' => 'PS3515',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_20.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('PS3515'),
            'end' => Map::generateSortKey('PT2351'),
            'range_start' => 'PS3515',
            'range_end' => 'PT2351',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_21.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('PT2351'),
            'end' => Map::generateSortKey('QA76'),
            'range_start' => 'PT2351',
            'range_end' => 'QA76',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_22.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('QA76'),
            'end' => Map::generateSortKey('QC16'),
            'range_start' => 'QA76',
            'range_end' => 'QC16',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_23.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('QC16'),
            'end' => Map::generateSortKey('QE508'),
            'range_start' => 'QC16',
            'range_end' => 'QE508',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_24.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('QE508'),
            'end' => Map::generateSortKey('QL583'),
            'range_start' => 'QE508',
            'range_end' => 'QL583',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_25.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('QL583'),
            'end' => Map::generateSortKey('R850'),
            'range_start' => 'QL583',
            'range_end' => 'R850',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_26.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('R850'),
            'end' => Map::generateSortKey('RT85'),
            'range_start' => 'R850',
            'range_end' => 'RT85',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_27.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('RT85'),
            'end' => Map::generateSortKey('TH7413'),
            'range_start' => 'RT85',
            'range_end' => 'TH7413',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_28.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('TH7413'),
            'end' => Map::generateSortKey('TR849'),
            'range_start' => 'TH7413',
            'range_end' => 'TR849',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_29.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 2nd Floor',
            'location' => '2nd Floor',
            'start' => Map::generateSortKey('TR849'),
            'end' => Map::generateSortKey('ZA4482'),
            'range_start' => 'TR849',
            'range_end' => 'ZA4482',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/G-Z-Stackmaps-master_Artboard_30.jpg'),
        ]);


        // 2nd Floor Special Collections
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'Special',
            'location' => '2nd Floor',
            'range_start' => 'A',
            'range_end' => 'Z',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/special-collections.jpg'),
        ]);


        // 3rd Floor JUVenile Literature
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('F1965.3'),
            'range_start' => 'A',
            'range_end' => 'F1965.3',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-12.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('F2161.5'),
            'end' => Map::generateSortKey('PS3569'),
            'range_start' => 'F2161.5',
            'range_end' => 'PS3569',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-12.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('PS3569'),
            'end' => Map::generateSortKey('PZ7 .B81'),
            'range_start' => 'PS3569',
            'range_end' => 'PZ7 .B81',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-11.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('PZ7 .B81'),
            'end' => Map::generateSortKey('PZ7 .D93'),
            'range_start' => 'PZ7 .B81',
            'range_end' => 'PZ7 .D93',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-05.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('PZ7.D93'),
            'end' => Map::generateSortKey('PZ7.H74'),
            'range_start' => 'PZ7.D93',
            'range_end' => 'PZ7.H74',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-04.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('PZ7.H74'),
            'end' => Map::generateSortKey('PZ7.M42'),
            'range_start' => 'PZ7.H74',
            'range_end' => 'PZ7.M42',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-10.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('PZ7.M42'),
            'end' => Map::generateSortKey('PZ7.P52'),
            'range_start' => 'PZ7.M42',
            'range_end' => 'PZ7.P52',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-09.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('PZ7.P53'),
            'end' => Map::generateSortKey('PZ7.S73'),
            'range_start' => 'PZ7.P53',
            'range_end' => 'PZ7.S73',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-03.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('PZ7.S73'),
            'end' => Map::generateSortKey('PZ7.1.C49'),
            'range_start' => 'PZ7.S73',
            'range_end' => 'PZ7.1.C49',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-02.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('PZ7.1.C49'),
            'end' => Map::generateSortKey('PZ8.1.G13'),
            'range_start' => 'PZ7.1.C49',
            'range_end' => 'PZ8.1.G13',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-08.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('PZ8.1.G15'),
            'end' => Map::generateSortKey('QB802'),
            'range_start' => 'PZ8.1.G15',
            'range_end' => 'QB802',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-07.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'JUVenile Literature - 3rd Floor',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('QB803'),
            'end' => Map::generateSortKey('Z1037'),
            'range_start' => 'QB803',
            'range_end' => 'Z1037',
            'description' => '',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-01.jpg'),
        ]);
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'Oversize Juvenile',
            'location' => '3rd Floor',
            'start' => Map::generateSortKey('A'),
            'end' => Map::generateSortKey('Z'),
            'range_start' => 'A',
            'range_end' => 'Z',
            'image' => \Illuminate\Support\Facades\Storage::url('maps/JUV-stackmap-01.jpg'),
        ]);

        /*
        factory(Map::class, 1)->create([
            'library' => 'David O. McKay Library',
            'collection' => 'General Books - 1st Floor',
            'location' => '1st Floor',
            'start' => Map::generateSortKey(''),
            'end' => Map::generateSortKey(''),
        ]);
        */
    }
}
