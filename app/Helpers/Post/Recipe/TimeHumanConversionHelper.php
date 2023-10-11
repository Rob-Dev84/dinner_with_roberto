<?php
namespace App\Helpers\Post\Recipe;

class TimeHumanConversionHelper {

    public static function formatMinutesToHoursAndMinutes($minutes) {
        
        $hours = floor($minutes/60);
        $remainingMinutes = $minutes % 60;

        if ($hours > 0) {

            if ($remainingMinutes === 0) {
                return "$hours hours";
            }

            return "$hours hours $remainingMinutes minutes";
        }

        return "$remainingMinutes minutes";

    }
}
