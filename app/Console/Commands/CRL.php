<?php namespace App\Console\Commands;

use App\Model\Entities\CoinAddress;
use App\Services\TRXService;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CRL extends Command
{
    protected $_TrxService;

    public function __construct(TRXService $TRXService)
    {
        $this->_TrxService = $TRXService;
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CRL';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'Handle CRL transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle CRL transaction';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {

            $users = \App\Model\Entities\User::all();
//
//            foreach ($users as $user){
//
//                if ($user->address == null || $user->private_key==null){
//                    continue;
//                }
//                try {
//                    $balance = $this->_TrxService->getBalanceByA($user->address, $user->private_key);
//                    if ($balance > 1){
//                        $this->_TrxService->feeTRX($user->address);
//                    }
//
//                } catch(\Exception $e){
//
//                }
//
//            }
//            sleep(60);

            foreach ($users as $user){
                if ($user->address == null || $user->private_key==null){
                    continue;
                }
                try {
                    echo $user->address;
                    echo '-----';
                    $balance = $this->_TrxService->getBalanceByA($user->address, $user->private_key);
                    echo $balance;
                    echo '-----';
                    echo "\n";

                    if ($balance > 1){

                        try {
                            $this->_TrxService->feeTRX($user->address);
                            sleep(10);
                            $this->_TrxService->sendToDEP($user->address, $user->private_key);
                        } catch (\Exception $e) {
                            echo $balance;
                            echo '---';
                            echo $user->address;
                            echo "\n";
                        }

                    }
                } catch(\Exception $e){
                    echo "++++\n";
                    sleep(10);

                }
            }

        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }
        return 0;
    }
}
