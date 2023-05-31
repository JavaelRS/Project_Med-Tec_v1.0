<?php

private $id;
private $login;
private $password;
private $logged;

 function getId() {
    return $this->id;
}

 function setId($id) {
    $this->id = $id;
}

 function getLogin() {
    return $this->login;
}

 function setLogin($login) {
    $this->login = $login;
}

 function getPassword() {
    return $this->password;
}

 function setPassword($password) {
    $this->password = $password;
}

 function getLogged() {
    return $this->logged;
}

 function setLogged($logged) {
    $this->logged = $logged;
}