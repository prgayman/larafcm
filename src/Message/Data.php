<?php
namespace Prgayman\LaraFcm\Message;

class Data
{
    /**
     * @internal
     *
     * @var array
     */
    protected array $data;

    /**
     * add data to existing data.
     *
     * @param array $data
     *
     * @return self
     */
    public function addData(array $data):self
    {
        $this->data = $this->data ?: [];

        $this->data = array_merge($data, $this->data);

        return $this;
    }

    /**
     * erase data with new data.
     *
     * @param array $data
     *
     * @return self
     */
    public function setData(array $data):self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Remove all data.
     */
    public function removeAllData()
    {
        $this->data = null;
    }

    /**
     * return data.
     *
     * @return array
     */
    public function getData():array
    {
        return $this->data;
    }

    /**
     * Build Payload data
     */
    public function build(): DataBuild
    {
        return new DataBuild($this);
    }
}
