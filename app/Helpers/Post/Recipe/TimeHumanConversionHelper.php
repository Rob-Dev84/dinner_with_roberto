<?php
namespace App\Helpers\Post\Recipe;

class TimeHumanConversionHelper {

    //here we convert the amount total minutes in order to show to time to the user. E.g. 24 hours 25 minutes
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


    //here we split the amount total minutes in hours and minutes. E.g. from 1450 to 1440, 10. because I need to show them on select inside the edit.blade.php file 
    public static function convertMinutesToHoursAndMinutes($minutes) {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        // If hours/minutes are zero, just return it as an integer
        $hours = $hours == 0 ? (int)$hours : $hours;
        $remainingMinutes = $remainingMinutes == 0 ? (int)$remainingMinutes : $remainingMinutes;

        return ['hours' => $hours, 'minutes' => $remainingMinutes];
    }
}
