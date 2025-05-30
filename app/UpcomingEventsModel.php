<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 10:07 AM
 */

namespace sccbakery;

use Illuminate\Database\Eloquent\Model;

class UpcomingEventsModel extends Model {
    protected $table    = 'upcoming_events';

    protected $dates    = ['events_date','start_date','end_date'];
}