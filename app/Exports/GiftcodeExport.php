<?php

namespace App\Exports;

use App\Models\Admin\GiftBagInfo;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class GiftcodeExport implements FromCollection, WithColumnFormatting, WithHeadings, WithTitle, ShouldAutoSize, WithMapping
{

    use Exportable;

    /**
    * 
    */
    public function collection()
    {
        return GiftBagInfo::all()->each(function ($bag) {
            $bag->type = __(GiftBagInfo::BAG_TYPES[$bag->type]);
            $bag->valid = __(GiftBagInfo::BAG_STATUS[$bag->valid]);    
        });
    }

    public function title(): string {
        return '礼包码';
    }

    public function headings(): array {
        return [
            '礼包编码',
            '礼包名称',
            '礼品类型',
            '礼品数量',
            '可用次数',
            '发布人',
            '是否有效',
            '生效日期',
            '失效日期',
        ];    
    }

    public function map($giftbag):array {
        return [
            $giftbag->code,
            $giftbag->name,
            $giftbag->type,
            $giftbag->reward,
            $giftbag->number,
            $giftbag->owner,
            $giftbag->valid,
            $giftbag->beginDate,
            $giftbag->endDate,
        ];    
    }

    public function columnFormats(): array {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
        ];    
    }
}
