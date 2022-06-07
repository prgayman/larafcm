<?php
namespace Prgayman\LaraFcm\Message;

use Illuminate\Contracts\Support\Arrayable;

class DataBuild implements Arrayable
{
    private $data;

    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    public function toArray():array
    {
        return $this->data->getData();
    }
}
