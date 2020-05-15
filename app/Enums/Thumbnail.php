<?php

namespace App\Enums;

use Illuminate\Support\Facades\Log;
use Rexlabs\Enum\Enum;
use Rexlabs\Enum\Exceptions\InvalidEnumException;

/**
 * The Thumbnail enum.
 *
 * @method static self AcademicJournals()
 * @method static self Articles()
 * @method static self Audiobook()
 * @method static self Book()
 * @method static self EBook()
 * @method static self News()
 * @method static self Periodicals()
 * @method static self Review()
 */
class Thumbnail extends Enum
{
    const academic_journal = '/img/formats/academic_journal.png';
    const audio = '/img/formats/audiobook.png';
    const audiobook = '/img/formats/audiobook.png';
    const biography = '/img/formats/biography.png';
    const book = '/img/formats/book.png';
    const chart = '/img/formats/chart.png';
    const conference = '/img/formats/conference_paper.png';
    const dissertation = '/img/formats/dissertation.png';
    const dissertation_thesis = '/img/formats/dissertation.png';
    const e_book = '/img/formats/e_book.png';
    const electronic_resource = '/img/formats/multimedia.png';
    const encylopedia = '/img/formats/encylopedia.png';
    const government_document = '/img/formats/government_document.png';
    const image = '/img/formats/image.png';
    const kit = '/img/formats/kit.png';
    const map = '/img/formats/map.png';
    const multimedia = '/img/formats/multimedia.png';
    const music_score = '/img/formats/music_score.png';
    const news = '/img/formats/news.png';
    const patent = '/img/formats/patent.png';
    const periodical = '/img/formats/periodical.png';
    const primary_source_document = '/img/formats/primary_source_document.png';
    const reference = '/img/formats/encylopedia.png';
    const report = '/img/formats/report.png';
    const review = '/img/formats/review.png';
    const short_story = '/img/formats/short_story.png';
    const transcript = '/img/formats/transcript.png';
    const unassigned = '/img/formats/unassigned.png';
    const video = '/img/formats/video.png';
    const video_recording = '/img/formats/video.png';

    /**
     * Get the key for the given constant name.
     *
     * @param string $name
     *
     * @return null|mixed|string
     * @throws InvalidEnumException
     */
    public static function keyForName(string $name)
    {
        $key = static::namesAndKeys()[$name] ?? null;
        if ($key === null) {
            //throw new InvalidEnumException("Invalid constant name: $name in " . static::class);
            $key = '/img/formats/unassigned.png';
            Log::notice('Missing Thumbnail: ' . $name);
        }

        return $key;
    }
}
