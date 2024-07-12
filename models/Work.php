<?php

namespace App\Models;

// A class that represents a ToDo task.
class Work
{
    public $id;
    public $name;
    public $status;
    public $starting_date;
    public $ending_date;

    public $status_work = [
        0 => 'Planning',
        1 => 'Doing',
        2 => 'Complete'
    ];
}
