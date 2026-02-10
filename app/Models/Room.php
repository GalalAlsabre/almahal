<?php

namespace app\Models;

use core\Model;

class Room extends Model {
    protected $table = 'rooms';

    public function getWithDetails() {
        return $this->query("SELECT r.*, rt.name as type_name, rt.base_price
                             FROM rooms r
                             JOIN room_types rt ON r.type_id = rt.id")->fetchAll();
    }
}
