<?php

class UserController {
    public function __construct(){
    }

    public function show() : void {
        $route = "show_user";
        require "templates/layout.phtml";
    }
    public function create() : void {
        $route = "create_user";
        require "templates/layout.phtml";
    }
    public function update() :void {
        $route = "update_user";
        require "templates/layout.phtml";
    }
    public function list() : void {
        $route = "list";
        require "templates/layout.phtml";
    }
}