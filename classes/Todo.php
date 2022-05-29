<?php

class Todo{
    public $title;
    public $date;
    public $user_id;
    public $id;

    public function __construct($title, $date, $user_id, $id = 0) {

        if($id > 0) {
            $this->id = $id;
        }
        $this->title = $title;
        $this->date = $date;
        $this->user_id = $user_id;
    }

    public function __toString() {
        return "{$this->title} - {$this->date}";
    }
}