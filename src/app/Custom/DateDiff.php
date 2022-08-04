<?php

namespace App\Custom;

class DateDiffPesel
{
    private $pesel;
    private $diff;
    private $birthDate;

    public function __construct(string $pesel)
    {
        $this->pesel = $pesel;
    }

    public function calc()
    {
        $year = substr($this->pesel, 0, 2);
        $month = substr($this->pesel, 2, 2);
        $day = substr($this->pesel, 4, 2);
        
        $year = $month > 12 ? '20' . $year : '19' . $year;
        $month = $month > 12 ? '0' . ($month - 20) : $month;

        $now = new \DateTime();
        $this->birthDate = new \DateTime($year . '-' . $month . '-' . $day);
        $this->diff = $now->diff($this->birthDate);
    }

    public function getYear()
    {
        return $this->diff->format('%y');
    }

    public function adultTimeLeft()
    {
        $now = new \DateTime();
        $now->modify('-18 year');

        $diff = $now->diff($this->birthDate);

        return $diff->format('years: %y, months: %m, days: %d');
    }
}
