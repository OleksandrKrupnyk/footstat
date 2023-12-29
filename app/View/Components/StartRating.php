<?php
declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class StartRating
 *
 *
 * @package App\View\Components
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class StartRating extends Component
{
    private const DefaultCount = 5;
    private const DefaultSize = 5;
    private const SMALL = 5;
    private const NORMAL = 10;
    private const BIG = 15;

    private int|float $baseValue = 0.0;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $id,
        public int    $count = 5,
        public int    $maxValue = 5,
        public bool   $readonly = false,
        public int    $value = 0,
        public string $size = 'small'
    )
    {
        if ($this->count <= 0) {
            $this->count = self::DefaultCount;
        }
        if ($this->count > $this->maxValue) {
            $this->maxValue = $this->count;
        }


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sizes = [
            'small' => self::SMALL,
            'normal' => self::NORMAL,
            'big' => self::BIG,
        ];
        $sizeValue = $sizes[$this->size] ?? self::DefaultSize;

        $this->baseValue = round($this->maxValue / $this->count);
        return view('components.start-rating', [
            'baseValue' => $this->baseValue,
            'value' => $this->value,
            'sizeValue' => $sizeValue,
        ]);
    }
}
