<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ShippingMethod: string implements HasLabel
{
    case ViettelPost = 'viettel-post';
    case GHN = 'ghn';
    case VietnamPost = 'vietnam-post';
    case GHTK = 'ghtk';
    case JT_Express = 'jt-express';
    case NinjaVan = 'ninja-van';

    public function getLabel(): ?string
    {
        // return $this->name;

        // or

        return match ($this) {
            self::ViettelPost => 'Viettel Post',
            self::GHN => 'Giao Hàng Nhanh',
            self::VietnamPost => 'Bưu điện Việt Nam (Vietnam Post)',
            self::GHTK => 'Giao Hàng Tiết Kiệm',
            self::JT_Express => 'J&T Express',
            self::NinjaVan => 'Ninja Van',
        };
    }
}
