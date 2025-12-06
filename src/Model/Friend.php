<?php
namespace Model;
use JsonSerializable;
class Friend implements JsonSerializable
{
    private $username;
    private $status;

    public function __construct($username = null)
    {
        $this->username = $username;
        $this->status = null;
    }

    public function getUsername()
    {
        return $this->username;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public static function fromJson(object $json)
    {
        $friend = new Friend();

        foreach ($json as $key => $value) {

            $friend->{$key} = $value;
            
        }

        return $friend;
    }
}
?>