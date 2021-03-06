<?php


use Illuminate\Database\Capsule\Manager as DB;
use Weerd\ChronosEvents\Models\ChronosEvent as CalendarEvent;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->setUpDatabase();
        $this->migrateTables();
    }

    protected function setUpDatabase()
    {
        $database = new DB;

        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    public function migrateTables()
    {
        DB::schema()->create('calendar_events', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }

    public function makeCalendarEvent()
    {
        $event = new CalendarEvent;
        $event->title = 'Some Event Title';
        $event->save();

        return $event;
    }
}
