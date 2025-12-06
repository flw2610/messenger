<?php
namespace Model;
use JsonSerializable;
class User implements JsonSerializable
{
    private $username;

    public function __construct($username = null)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setStatusAccepted()
    {
        $this->status = "accepted";
    }

    public function setStatusDismissed()
    {
        $this->status = "dismissed";
    }


    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public static function fromJson(object $json)
    {
        $user = new User();

        foreach ($json as $key => $value) {

            $user->{$key} = $value;
        }

        return $user;
    }
}
?>