<?php

namespace App\Listeners;

use App\Events\ProductStockChanged;
use App\Mail\ProductOutOfStock;
use App\Mail\ProductStockLow;
use App\Product;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailStockNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ProductStockChanged $event
     *
     * @return void
     */
    public function handle(ProductStockChanged $event)
    {
        if ($this->isLowInStock($event->product)) {
            $mailable = $this->getStockMailable($event->product);
            foreach (User::shopAdmins()->get() as $admin) {
                \Mail::to($admin)->send($mailable);
            }
        }
    }

    protected function isLowInStock(Product $product)
    {
        return $product->stock_qty <= config('shop.low_stock_qty');
    }

    protected function getStockMailable(Product $product)
    {
        if ($product->stock_qty == 0) {
            return new ProductOutOfStock($product);
        }

        return new ProductStockLow($product);
    }
}
