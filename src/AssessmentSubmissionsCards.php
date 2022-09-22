<?php

namespace Pixelfusion\AssessmentSubmissionsCards;

use App\Models\AssessmentSubmission;
use Laravel\Nova\Card;

class AssessmentSubmissionsCards extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = parent::FULL_WIDTH;

    public $height = parent::DYNAMIC_HEIGHT;

    public $model;

    public function __construct($model)
    {
        parent::__construct();

        $this->model = $model;
    }

    public function statusList()
    {
        $defaultStatusCounts = collect(AssessmentSubmission::STATUS)
            ->mapWithKeys(
                function ($item, $key) {
                    return [
                        $key => 0
                    ];
                }
            );

        $actualStatusCounts = AssessmentSubmission::all()
            ->groupBy('submission_status')
            ->mapWithKeys(
                function ($item, $key) {
                    return [
                        $key => $item->count()
                    ];
                }
            );

        $mergedCounts = $defaultStatusCounts->merge($actualStatusCounts);
        // get sum count
        $allCount = $actualStatusCounts->sum();
        // append total sum
        $mergedCounts->prepend($allCount, 'all');

        return $this->withMeta([
            'counts' => $mergedCounts->map(function ($count, $key) {
                return [
                    'count'  => $count,
                    'urikey' => strtolower($key),
                    'title'  => AssessmentSubmission::STATUS[$key] ?? ucfirst($key),
                ];
            })
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'assessment-submissions-cards';
    }
}
