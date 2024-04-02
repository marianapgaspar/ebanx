<?php 

namespace App\Layout\Rules\Cards;

use App\Layout\Rules\AComponent;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Components\ACard;
use App\Layout\Rules\Factory;

abstract class ACards extends AComponent{
    protected array $cards = [];
    protected array $sizes = [];
    protected Factory $factory;


    public function __construct(ALayout $layout,Factory $factory)
    {
        parent::__construct($layout);
        $this->factory = $factory;
    }

    function card(string $name, int $size = 6):ACard{
        $card = $this->factory->card($this->layout,$name);
        $this->addCard($card,$size);
        return $card;
    }
    function addCard(ACard $card, int $size = 6):self{
        $this->cards[$card->getName()] = $card;
        $this->sizes[$card->getName()] = $size;
        return $this;
    }
    function getComponents():array{
        return $this->cards;
    }
    function getSizes():array{
        return $this->sizes;
    }
}