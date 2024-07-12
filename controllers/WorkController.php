<?php

namespace App\Controllers;

use App\App\App;
use App\Models\Work;

class WorkController
{
    protected $status_work;
    protected $table;

    public function __construct()
    {
        $work = new Work();
        $this->status_work = $work->status_work;
        $this->table = 'works';
    }

    /**
     * Display a listing of the resource.
     *
     * @return view Renders a view with a list of works.
     */
    public function index()
    {
        $works = App::get('DB')->selectAll('works', Work::class, 'ORDER BY id DESC');
        $title = 'Works lists';
        $status = $this->status_work;

        return view('works.index', compact('works', 'title', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return view Renders a view for creating a new work.
     */
    public function create()
    {
        $title = 'Create new Work';
        $status = $this->status_work;

        return view('works.create', compact('title', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return redirect Redirects to the works index after storing the new work.
     */
    public function store()
    {
        $params = [
            'name'          => (empty($_POST['name'])) ? '' : trim(strip_tags($_POST['name'])),
            'starting_date' => (empty($_POST['starting_date'])) ? '' : trim(strip_tags($_POST['starting_date'])),
            'ending_date'   => (empty($_POST['ending_date'])) ? '' : trim(strip_tags($_POST['ending_date'])),
            'status'        => (empty($_POST['status'])) ? 0 : trim(strip_tags($_POST['status']))
        ];

        if (empty($params['name'])) {
            return redirect('works/create');
        }

        try {
            App::get('DB')->insert($this->table, $params);
        } catch (Exception $e) {
            require "views/500.php";
        }

        return redirect('works');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return view Renders a view for editing a specific work.
     */
    public function edit()
    {
        if (!isset($_GET['id'])) {
            require "views/404.php";
            exit(0);
        }

        $id = trim(strip_tags($_GET['id']));

        $work = App::get('DB')->first($this->table, Work::class, $id);
        if (empty($work)) {
            require "views/404.php";
            exit(0);
        }

        $work = $work[0];
        $title = $work->name . ' | Works edit';
        $status = $this->status_work;

        return view('works.update', compact('work', 'title', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return redirect Redirects to the works index after updating a work.
     */
    public function update()
    {
        if (!isset($_GET['id'])) {
            require "views/404.php";
            exit(0);
        }

        $id = trim(strip_tags($_GET['id']));

        $work = App::get('DB')->first($this->table, Work::class, $id);
        if (empty($work)) {
            require "views/404.php";
            exit(0);
        }

        $params = [
            'name' => (empty($_POST['name'])) ? '' : trim(strip_tags($_POST['name'])),
            'starting_date' => (empty($_POST['starting_date'])) ? '' : trim(strip_tags($_POST['starting_date'])),
            'ending_date' => (empty($_POST['ending_date'])) ? '' : trim(strip_tags($_POST['ending_date'])),
            'status' => (empty($_POST['status'])) ? 0 : trim(strip_tags($_POST['status']))
        ];

        if (empty($params['name'])) {
            require "views/500.php";
            exit(0);
        }

        try {
            App::get('DB')->update($this->table, $params, $id);
        } catch (Exception $e) {
            require "views/500.php";
        }

        return redirect('works');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return redirect Redirects to the works index after deleting a work.
     */
    public function delete()
    {
        if (!isset($_GET['id'])) {
            require "views/404.php";
        }

        $id = trim(strip_tags($_GET['id']));

        $work = App::get('DB')->first($this->table, Work::class, $id);
        if (!empty($work)) {
            App::get('DB')->delete($this->table, $id);
        }

        return redirect('works');
    }

    /**
     * Display a calendar view of works.
     *
     * @return view Renders a calendar view with works.
     */
    public function calendar()
    {
        $works = App::get('DB')->selectAll($this->table, Work::class);
        $title = 'Calendar';
        return view('works.calendar', compact('title', 'works'));
    }
}
