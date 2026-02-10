<?php

namespace app\Models;

use core\Model;

class Booking extends Model {
    protected $table = 'bookings';

    public function getActiveWithDetails() {
        return $this->query("SELECT b.*, g.name as guest_name, r.room_number
                             FROM bookings b
                             JOIN guests g ON b.guest_id = g.id
                             JOIN rooms r ON b.room_id = r.id
                             WHERE b.status = 'active'")->fetchAll();
    }
}
