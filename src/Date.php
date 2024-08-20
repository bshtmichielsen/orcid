<?php

namespace ORCID;

class Date {

    public int $Year;

    public int $Month;

    public int $Day;

    public function __construct(int $year, int $month, int $day) {
        $this->Year = $year;
        $this->Month = $month;
        $this->Day = $day;
    }

    public function __toString() {
        return $this->Year . "-" . $this->Month . "-" . $this->Day; 
    }

    public function toMonthAndYear() {
        return date('M', mktime(0, 0, 0, $this->Month, 10)) . " " . $this->Year;
    }
}

?>