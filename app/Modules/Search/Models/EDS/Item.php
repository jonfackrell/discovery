<?php

namespace App\Modules\Search\Models\EDS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Item extends \App\Item
{
    protected $record;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function setRecord($record)
    {
        $this->record = $record;

        return $this;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'index', 'relevancy', 'name', 'author',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    protected $appends = [
        'index',
        'database',
        'database_label',
        'an',
        'format',
        'title',
        'author',
        'publication_date',
        'publication',
        'abstract',
        'detail_link',
        'link_type',
        'full_text_link',
        'thumbnail',
    ];

    public function getDetailLinkAttribute()
    {
        return route('item.view', ['item' => 'EDS:' . $this->database . '|' . $this->an]);
    }

    public function getFullTextLinkAttribute()
    {
        $info = null;
        if ($this->link_type == 'pdflink' || $this->link_type == 'ebook-epub' || $this->link_type == 'ebook-pdf') {
            return [
                'label' => 'Full Text',
                'url' => route('item.fulltext', ['item' => 'EDS:' . $this->database . '|' . $this->an]),
                'info' => $info,
            ];
        } elseif ($this->database == 'cat03146a') {
            switch (strtolower($this->format)) {
                case 'ebook':
                    $link = $this->ebook_link;
                    $text = 'View EBook';
                    if (Str::contains($link, 'overdrive.com')) {
                        $text = 'View EBook on OverDrive';
                    }
                    if (Str::contains($link, 'ebrary.com')) {
                        $text = 'View EBook on Ebrary';
                    }
                    break;
                case 'audiobook':
                    $link = $this->ebook_link;
                    $text = 'View EBook';
                    if (Str::contains($link, 'overdrive.com')) {
                        $text = 'View Audiobook on OverDrive';
                        $info = '<div class="p-4 bg-gray-50 border-black"><img class="w-20 h-20 float-left mr-4" src="https://help.overdrive.com/en-us/resources/images/siteui/libby-app-icon.svg"/><p class="text-sm">Use Libby to borrow and download audiobooks and ebooks from OverDrive to your mobile device.</p><p><a href="https://play.google.com/store/apps/details?id=com.overdrive.mobile.android.libby&hl=en_US&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" target="_blank"><img class="mr-6 inline" alt="Get it on Google Play" src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png" style="height: 60px; width: auto;"/></a><a href="https://apps.apple.com/us/app/libby-by-overdrive/id1076402606?mt=8" target="_blank"><img class="mr-6 inline" alt="Get it on iOS App Store" src="https://linkmaker.itunes.apple.com/en-us/badge-lrg.svg?releaseDate=2016-12-12&kind=iossoftware&bubble=ios_apps" style="height: 40px; width: auto;"/></a></p></div>';
                    }
                    break;
                default:
                    $an = explode('.', $this->an);
                    $link = 'https://byui.ent.sirsi.net/client/en_US/beta/search/detailnonmodal/ent:$002f$002fSD_ILS$002f0$002fSD_ILS:' . end($an) . '/ada';
                    $text = 'View in Catalog';
            }
            return [
                'label' => $text,
                'url' => $link,
                'info' => $info,
            ];
        } else {
            return [
                'label' => 'View ' . $this->format . ' Online',
                'url' => $this->custom_link,
                'info' => $info,
            ];
        }
    }

    public function getLinkTypeAttribute()
    {
        $name = '';
        try {
            $name = $this->record['FullText']['Links'][0]['Type'];
        } catch (\Exception $e) {
        }
        return $name;
    }

    public function getEbookLinkAttribute()
    {
        $url = '';
        try {
            $url = collect($this->record['Items'])->where('Name', 'URL')->first()['Data'];
            preg_match('/(?<=linkTerm=&quot;)(.*?)(?=&quot;)/', $url, $matches);
            if (count($matches) >= 2) {
                $url = $matches[1];
            }
        } catch (\Exception $e) {
        }
        return $url;
    }

    public function getCustomLinkAttribute()
    {
        $name = '';
        try {
            $name = $this->record['FullText']['CustomLinks'][0]['Url'];
        } catch (\Exception $e) {
        }
        return $name;
    }

    public function getPdfLinkAttribute()
    {
        $name = '';
        try {
            $name = $this->record['FullText']['Links'][0]['Url'];
        } catch (\Exception $e) {
        }
        return $name;
    }

    public function getPPermaLinkAttribute()
    {
        $name = '';
        try {
            $name = $this->record['PLink'];
        } catch (\Exception $e) {
        }
        return $name;
    }

    public function getIndexAttribute()
    {
        return 'EDS';
    }

    public function getDatabaseAttribute()
    {
        $name = '';
        try {
            $name = $this->record['Header']['DbId'];
        } catch (\Exception $e) {
        }
        return $name;
    }

    public function getDatabaseLabelAttribute()
    {
        $name = '';
        try {
            $name = $this->record['Header']['DbLabel'];
        } catch (\Exception $e) {
        }
        return $name;
    }

    public function getAnAttribute()
    {
        $name = '';
        try {
            $name = $this->record['Header']['An'];
        } catch (\Exception $e) {
        }
        return $name;
    }

    public function getDetailsAttribute()
    {
        $name = '';
        try {
            $name = collect($this->record['Items']);
        } catch (\Exception $e) {
        }
        return $name;
    }

    public function getTitleAttribute()
    {
        $name = '';
        try {
            $name = collect($this->record['Items'])->where('Name', 'Title')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $name;
    }

    public function getAuthorAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'Author')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }


    public function getPublicationAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'TitleSource')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getDateAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['RecordInfo']['BibRecord']['BibRelationships']['IsPartOfRelationships']['BibEntity']['Dates'])->where('Type', 'published')->first()['Y'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getAbstractAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'Abstract')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getFormatAttribute()
    {
        $author = '';
        try {
            $author = $this->record['Header']['PubType'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getThumbnailAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['ImageInfo'])->where('Size', 'thumb')->first()['Target'];
        } catch (\Exception $e) {
            if (in_array($this->format, ['Book', 'eBook'])) {
                if ($this->identifier) {
                    $author = 'https://syndetics.com/index.aspx?isbn=' . $this->identifier . '/sc.gif&client=byuia&upc=&oclc=' . $this->oclc;
                }
            }
        }
        return $author;
    }

    public function getIdentifierAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'ISBN')->first()['Data'];
            $author = explode(' ', $author)[0];
            if (empty($author)) {
                $author = collect($this->record['RecordInfo']['BibRecord']['BibRelationships']['IsPartOfRelationships'][0]['BibEntity']['Identifiers'])->where('Type', 'isbn-print')->first()['Value'];
            }
            //Log::info('ISBN: ' . $author);
        } catch (\Exception $e) {
            /*$author = collect($this->record['RecordInfo']['BibRecord']['BibRelationships']['IsPartOfRelationships'][0]['BibEntity']['Identifiers'])->where('Type', 'isbn-print')->first()['Value'];
            Log::error('ISBN: ' . $author);*/
        }
        return $author;
    }

    public function getOclcAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Label', 'OCLC')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getLanguageAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'Language')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    /*public function getAuthorsAttribute()
    {
        $author = '';
        try{
            // Todo: Use real Authors
            $author = collect($this->record['Items'])->where('Name', 'Author')->first()['Data'];
        }catch(\Exception $e){

        }
        return $author;
    }*/

    public function getPublicationInfoAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'PubInfo')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getPublicationDateAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'DatePub')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getPhysicalDescriptionAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'PhysDesc')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getDocumentTypeAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'TypeDocument')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getSubjectsAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['RecordInfo']['BibRecord']['BibEntity']['Subjects'])->pluck('SubjectFull');
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getPersonSubjectsAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'SubjectPerson')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getContentNotesAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'TOC')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getNotesAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Items'])->where('Name', 'Note')->first()['Data'];
        } catch (\Exception $e) {
        }
        return $author;
    }

    public function getCallNumberAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Holdings'][0]['HoldingSimple']['CopyInformationList'])->first()['ShelfLocator'];
        } catch (\Exception $e) {
            $author = "notfound";
        }
        return $author;
    }

    public function getCollectionAttribute()
    {
        $author = '';
        try {
            $author = collect($this->record['Holdings'][0]['HoldingSimple']['CopyInformationList'])->first()['Sublocation'];
        } catch (\Exception $e) {
            $author = "notfound";
        }
        return $author;
    }
}
