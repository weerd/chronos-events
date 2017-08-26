<?php

namespace Weerd\ChronosEvents\Models;

use Illuminate\Database\Eloquent\Model;

class ChronosEvent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'calendar_events';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date_time', 'end_date_time'];

    /**
     * Get the event's all day attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getAllDayAttribute($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set the event's all day attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setAllDayAttribute($value)
    {
        $this->attributes['all_day'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the end date string.
     *
     * @return string
     */
    public function getEndDateStringAttribute()
    {
        return $this->end_date_time->timezone($this->end_timezone)->toDateString();
    }

    /**
     * Get the end time string.
     *
     * @return string
     */
    public function getEndTimeStringAttribute()
    {
        return $this->end_date_time->timezone($this->end_timezone)->toTimeString();
    }

    /**
     * Get the start date string.
     *
     * @return string
     */
    public function getStartDateStringAttribute()
    {
        return $this->start_date_time->timezone($this->start_timezone)->toDateString();
    }

    /**
     * Get the start time string.
     *
     * @return string
     */
    public function getStartTimeStringAttribute()
    {
        return $this->start_date_time->timezone($this->start_timezone)->toTimeString();
    }
}
