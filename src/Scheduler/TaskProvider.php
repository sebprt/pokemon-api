<?php

namespace App\Scheduler;

use App\Scheduler\Message\UpdateDailyPokemonTable;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;

#[AsSchedule]
class TaskProvider implements ScheduleProviderInterface
{
    public function getSchedule(): Schedule
    {
        $schedule = new Schedule();

        $schedule->with(
            RecurringMessage::cron('0 6 * * *', new UpdateDailyPokemonTable())
        );

        return $schedule;
    }
}
