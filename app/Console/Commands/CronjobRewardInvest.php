<?php namespace App\Console\Commands;

use App\Model\Entities\Deposit;
use App\Model\Entities\Invest;
use App\Model\Entities\Withdraw;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CronjobRewardInvest extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:reward-invest';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'Reward Invest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get reward invest';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $yesterday = Carbon::now()->subDays(1)->format('Y-m-d');
            $invest = Invest::delFlagOn()->with('package')->where('date_end', $yesterday)->get();
            if (count($invest) <= 0) {
                return;
            }

            $userDefault = getConfig('user_id_default');
            $currencyDefault = getConfig('currency_default');

            $dataDeposit = [];
            $dataWithdraw = [];

            foreach ($invest as $item) {
                $msg = transMessage('return_on_investment', ['month' => $item->tryGet('package')->type]);
                $number = $item->tryGet('package')->rate * $item->number / 100;

                $tmpDeposit = [
                    'user_id' => $item->user_id,
                    'from' => $userDefault,
                    'currency' => $currencyDefault,
                    'message' => $msg,
                    'number' => $number
                ];

                $tmpWithdraw = [
                    'user_id' => $userDefault,
                    'to' => $item->user_id,
                    'currency' => $currencyDefault,
                    'message' => $msg,
                    'number' => $number
                ];

                array_push($dataDeposit, $tmpDeposit);
                array_push($dataWithdraw, $tmpWithdraw);
            }

            Deposit::insert($dataDeposit);
            Withdraw::insert($dataWithdraw);
            DB::commit(); // all good
            return 1;
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }
        return 0;
    }
}