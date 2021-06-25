<?php namespace App\Console\Commands;

use App\Model\Entities\CoinAddress;
use App\Services\TRXService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Cronjob2 extends Command
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
    protected $signature = 'deposit';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'Handle deposit transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle deposit transaction';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();
        try {


            DB::commit(); // all good
            return 1;
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }
        return 0;
    }
}