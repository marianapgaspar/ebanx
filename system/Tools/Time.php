<?php
namespace System\Tools;

use DateTime;

class Time{
    private static \DateTime $dateTime;

    private static $dateFormat = 'd/m/Y';
    private static $dateTimeFormat = 'd/m/Y H:i:s';

    static function updateDateTime(){
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        self::$dateTime = new DateTime(date("Y-m-d H:i:s"));
    }
    public static function getDateTime():\DateTime{
        return self::$dateTime;
    }

    static function dateFromDefaultToDB(string $date){
        return \DateTime::createFromFormat(self::$dateFormat,$date)->format('Y-m-d');
    }
    static function datetimeFromDefaultToDB(string $date){
        return \DateTime::createFromFormat('d/m/Y H:i:s',$date)->format('Y-m-d H:i:s');
    }

    static function dateFromDBToDefault(string $date){
        return \DateTime::createFromFormat('Y-m-d',$date)->format(self::$dateFormat);
    }
    static function datetimeFromDBToDefault(string $date){
        return \DateTime::createFromFormat('Y-m-d H:i:s',$date)->format(self::$dateTimeFormat);
    }
    static function dateDiffToday(string $date){
        $date = date_create_from_format('Y-m-d', $date);
        $today = date_create_from_format('Y-m-d', date('Y-m-d'));
        return (array) date_diff($date, $today);
    }
    static function getWorkDays(string $startDate, string $endDate):int{
        $begin = strtotime($startDate);
        $end   = strtotime($endDate);
        if ($begin > $end) {
            return 0;
        } else {
            $no_days  = 0;
            $weekends = 0;
            while ($begin <= $end) {
                $no_days++; // no of days in the given interval
                $what_day = date("N", $begin);
                if ($what_day > 5) { // 6 and 7 are weekend days
                    $weekends++;
                };
                $begin += 86400; // +1 day
            };
            $working_days = $no_days - $weekends;

            return $working_days;
        }
    }
}