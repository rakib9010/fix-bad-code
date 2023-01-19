<?php

/**
 * Fixed code 
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\AccountingService;

class Tenant extends Model
{
	const STATUS_AWAITING_PAYMENT = 'awaiting-payment';
	const STATUS_PAID = 'paid';
	
	public function getInvoices(): array
	{
		return $this->getInvoicesWithStatus(self::STATUS_AWAITING_PAYMENT);
	}

	public function getOldInvoices(): array
	{
		return $this->getInvoicesWithStatus(self::STATUS_PAID);
	}

	private function getInvoicesWithStatus(string $status): array
	{
		$params = array('tenant_id' => $this->id, 'status' => $status);
		
		return app(AccountingService::class)->getAllInvoices($params);
	}
}

