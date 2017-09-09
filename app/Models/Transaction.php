<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model {

    /**
     * @return int
     */
    public static function wholeCash() {

        // Brings the user's id.
        $user = Auth::id();

        // Brings the current user's expenses.
        $expenses = Transaction::where('borrower', $user)->get();

        // Brings the current user's incomes.
        $incomes = Transaction::where('lender', $user)->get();

        $outcome = 0;
        foreach ($expenses as $expense) {
            $outcome = $outcome + $expense->amount;
        }

        $salary = 0;
        foreach ($incomes as $income) {
            $salary = $salary + $income->amount;
        }

        $cash = $salary - $outcome;
        return $cash;
    }

    /**
     * @return int
     */
    public static function moneyPerDay() {

        $wholeMoney = self::wholeCash();

        $moneyPerDay = $wholeMoney/(cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y")) - date("d"));

        return $moneyPerDay;
    }
}
