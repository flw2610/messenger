<?php
namespace Model;
use JsonSerializable;
class User implements JsonSerializable
{
    private $username;
    private $lastname;
    private $coffeeOrTea;
    private $aboutYou;
    private $chatLayout;
    private $history;

    public function __construct($username = null)
    {
        $this->username = $username;
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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getCoffeeOrTea()
    {
        return $this->coffeeOrTea;
    }

    public function setCoffeeOrTea($coffeeOrTea)
    {
        $this->coffeeOrTea = $coffeeOrTea;
    }

    public function getAboutYou()
    {
        return $this->aboutYou;
    }

    public function setAboutYou($aboutYou)
    {
        $this->aboutYou = $aboutYou;
    }

    public function getChatLayout()
    {
        return $this->chatLayout;
    }

    public function setChatLayout($chatLayout)
    {
        $this->chatLayout = $chatLayout;
    }

    public function getHistory()
    {
        return $this->history;
    }

    public function setHistory($history)
    {
        $this->history = $history;
    }
}
?>