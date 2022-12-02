<?php

/**
 * Please, improve this class and fix all problems.
 *
 * You can change the Tenant class and its methods and properties as you want.
 * You can't change the AccountingService behavior.
 * You can choose PHP 7 or 8.
 * You can consider this class as an Eloquent model, so you are free to use
 * any Laravel methods and helpers.
 *
 * What is important:
 * - design (extensibility, testability)
 * - code cleanliness, following best practices
 * - consistency
 * - naming
 * - formatting
 *
 * Write your perfect code!
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\AccountingService;

class Tenant extends Model
{
	public function getInvoices(): array
	{
		return $this->getInvoicesWithStatus('awaiting-payment');
	}

	public function getOldInvoices(): array
	{
		return $this->getInvoicesWithStatus('paid');
	}

	private function getInvoicesWithStatus(string $status): array
	{
		$invoices = app(AccountingService::class)->getAllInvoices(['tenant_id' => $this->id]);

		return $invoices ? array_filter($invoices, fn($i) => $i['status'] === $status) : [];
	}
}
