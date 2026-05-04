<?php

namespace App\Console\Commands;

use App\Services\MonthlyPaymentService;
use Illuminate\Console\Command;

class GenerateMonthlyMembershipPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:generate-monthly-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate current month payment records for active general members';

    /**
     * Execute the console command.
     */
    public function handle(MonthlyPaymentService $monthlyPaymentService): int
    {
        $created = $monthlyPaymentService->generateCurrentMonthPaymentsForActiveMembers();

        $this->info("Generated {$created} monthly payment record(s).");

        return self::SUCCESS;
    }
}
