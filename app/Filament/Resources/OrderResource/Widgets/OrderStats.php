<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', OrderStatusEnum::New)->count()),
            Stat::make('Orders Processing', Order::query()->where('status', OrderStatusEnum::Processing)->count()),
            Stat::make('Orders Shipped', Order::query()->where('status', OrderStatusEnum::Shipped)->count()),
            Stat::make('Average Price', Number::currency(Order::query()->avg('grand_total'), 'USD')),
        ];
    }
}
